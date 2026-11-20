<?php

namespace Tests\Feature;

use App\Http\Middleware\RunScheduler;
use App\Models\ShipF;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ShipmentFTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:', 'session.driver' => 'array']);
        DB::purge('sqlite');
        (require database_path('migrations/2026_11_20_000001_create_shippmentf_table.php'))->up();
        (require database_path('migrations/2026_11_20_000002_add_attribute_to_shippmentf_table.php'))->up();
        $this->withoutMiddleware(RunScheduler::class);
    }

    private function signIn(int $role): void
    {
        $user = new User(['name' => 'Test User', 'role' => $role, 'type' => '["SP"]']);
        $user->id = 1;
        $this->actingAs($user);
    }

    private function spreadsheet(array $rows): UploadedFile
    {
        $file = UploadedFile::fake()->create('shipment.xlsx');
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet()->fromArray($rows);
        (new Xlsx($spreadsheet))->save($file->getRealPath());
        $spreadsheet->disconnectWorksheets();

        return $file;
    }

    public function test_manual_shipment_stores_and_displays_the_attribute(): void
    {
        $this->signIn(0);
        $this->post(route('Ship-Mark.admin.shipment-f-store'), [
            'no_so' => 'SOX26-26038', 'reference' => '23353 / V26-2407',
            'destination' => 'VANCOUVER BC, CANADA', 'attribute' => 'ATTR-001',
        ])->assertRedirect(route('Ship-Mark.admin.shipment-f'));

        $item = ShipF::firstOrFail();
        $this->assertSame('ATTR-001', $item->attribute);
        $this->get(route('Ship-Mark.admin.shipment-f-show', $item->id))->assertOk()->assertSee('ATTR-001');
        $this->get(route('Ship-Mark.admin.shipment-f-printone', $item->id))->assertOk()->assertSee('SOX26-26038 / ATTR-001');
    }

    public function test_print_uses_unicode_and_pod_with_so_attribute_outside_the_portrait_frame(): void
    {
        $this->signIn(0);
        $item = ShipF::create([
            'no_so' => 'SOX26-26038',
            'reference' => '23353 / V26-2407',
            'destination' => 'VANCOUVER BC, CANADA',
            'attribute' => 'ATTR-001',
        ]);

        $this->get(route('Ship-Mark.admin.shipment-f-printone', $item->id))
            ->assertOk()
            ->assertSee('@page { size: 10.19cm 23.95cm; margin: 0; }', false)
            ->assertSee('width: 7.45cm;', false)
            ->assertSee('height: 20.75cm;', false)
            ->assertSeeInOrder([
                '<div class="shipping-mark-title">SHIPPING MARK</div>',
                '<div class="unicode">23353 / V26-2407</div>',
                '<div class="pod">VANCOUVER BC, CANADA</div>',
                '<div class="origin">MADE IN INDONESIA</div>',
                '<small class="reference-code">SOX26-26038 / ATTR-001</small>',
            ], false)
            ->assertSee('right: .6cm;', false)
            ->assertSee('writing-mode: vertical-rl;', false)
            ->assertDontSee('PRODUCT')
            ->assertDontSee('NET/WEIGHT');
    }

    public function test_attribute_migration_preserves_existing_shipment_data(): void
    {
        Schema::drop('shippmentf');
        (require database_path('migrations/2026_11_20_000001_create_shippmentf_table.php'))->up();
        DB::table('shippmentf')->insert(['no_so' => 'LEGACY-SO', 'reference' => 'LEGACY-REF', 'destination' => 'CANADA']);
        (require database_path('migrations/2026_11_20_000002_add_attribute_to_shippmentf_table.php'))->up();

        $item = ShipF::where('no_so', 'LEGACY-SO')->firstOrFail();
        $this->assertSame('LEGACY-REF', $item->reference);
        $this->assertSame('CANADA', $item->destination);
        $this->assertNull($item->attribute);
        $this->signIn(0);
        $this->get(route('Ship-Mark.admin.shipment-f-printone', $item->id))->assertOk()->assertSee('LEGACY-SO')->assertDontSee('LEGACY-SO |');
    }

    public function test_long_shipment_identifiers_use_a_compact_print_style(): void
    {
        $this->signIn(0);
        $item = ShipF::create(['no_so' => str_repeat('W', 100), 'reference' => str_repeat('W', 100), 'destination' => str_repeat('W', 100), 'attribute' => str_repeat('W', 100)]);
        $this->get(route('Ship-Mark.admin.shipment-f-printone', $item->id))->assertOk()
            ->assertSee('class="reference-code reference-code--long"', false)
            ->assertSee('class="unicode unicode--long"', false)
            ->assertSee('class="pod pod--long"', false);
    }

    public function test_admin_and_pegawai_can_use_their_shipment_f_pages(): void
    {
        foreach (['admin' => 0, 'pegawai' => 1] as $role => $number) {
            $this->signIn($number);
        $this->get(route("Ship-Mark.$role.shipment-f"))->assertOk()->assertSee('Shipment F');
            $this->get(route("Ship-Mark.$role.shipment-f-add"))->assertOk()->assertSee('Unicode')->assertSee('Attribute');
        }
    }

    public function test_shipment_f_index_uses_the_shipment_e_page_layout(): void
    {
        $this->signIn(0);

        $this->get(route('Ship-Mark.admin.shipment-f'))
            ->assertOk()
            ->assertSeeInOrder(['Tambah Data', 'Impor Excel', 'All data of Shipment type F', 'Download Template', 'Search by no SO', 'Action']);
    }

    public function test_dashboard_shows_shipment_e_image_to_both_roles_without_a_broken_employee_link(): void
    {
        $this->signIn(0);
        $counts = ['a_count' => 0, 'b_count' => 0, 'c_count' => 0, 'd_count' => 0];
        $this->view('pegawai.index', $counts)->assertSee('E.png')->assertSee('F.svg')->assertSee(route('Ship-Mark.admin.shipment-e'));

        $this->signIn(1);
        $this->view('pegawai.index', $counts)->assertSee('E.png')->assertSee('F.svg')->assertSee('Shippment E')->assertDontSee('/pegawai/ShipmentE');
    }

    public function test_crud_search_and_print_use_the_correct_group(): void
    {
        $this->signIn(0);
        $this->post(route('Ship-Mark.admin.shipment-f-store'), [
            'no_so' => 'SOX26-26038', 'reference' => '23353 / V26-2407', 'destination' => 'VANCOUVER BC, CANADA', 'attribute' => 'ATTR-001',
        ])->assertRedirect(route('Ship-Mark.admin.shipment-f'));
        $item = ShipF::firstOrFail();
        $other = ShipF::create(['no_so' => 'SOX26-26038', 'reference' => 'OTHER REF', 'destination' => 'CANADA']);
        ShipF::create(['no_so' => 'OTHER-SO', 'reference' => 'OTHER GROUP', 'destination' => 'USA']);

        $this->get(route('Ship-Mark.admin.shipment-f', ['search' => '26038']))->assertOk()->assertSee('SOX26-26038')->assertDontSee('OTHER-SO');
        $this->get(route('Ship-Mark.admin.shipment-f-show', [$item->id, 'search' => '23353']))->assertOk()->assertSee('23353 / V26-2407')->assertDontSee('OTHER REF');
        $this->get(route('Ship-Mark.admin.shipment-f-print', $item->id))->assertOk()->assertSee('SHIPPING MARK')->assertSee('23353 / V26-2407')->assertSee('OTHER REF')->assertDontSee('OTHER GROUP')->assertSee('MADE IN INDONESIA');
        $this->get(route('Ship-Mark.admin.shipment-f-printone', $item->id))->assertOk()->assertSee('23353 / V26-2407')->assertDontSee('OTHER REF');
        $this->put(route('Ship-Mark.admin.shipment-f-update', $item->id), ['no_so' => $item->no_so, 'reference' => 'EDITED', 'destination' => 'CANADA', 'attribute' => 'ATTR-002'])->assertRedirect();
        $this->assertSame('EDITED', $item->fresh()->reference);
        $this->delete(route('Ship-Mark.admin.shipment-f-delete', $item->id))->assertRedirect(route('Ship-Mark.admin.shipment-f-show', $other->id));
        $this->assertNull(ShipF::find($item->id));
    }

    public function test_incomplete_manual_input_is_rejected(): void
    {
        $this->signIn(1);
        $this->post(route('Ship-Mark.pegawai.shipment-f-store'), ['no_so' => 'SOX26-26038'])->assertSessionHasErrors(['reference', 'destination', 'attribute']);
        $this->assertSame(0, ShipF::count());
    }

    public function test_roles_are_restricted_and_long_fields_are_rejected(): void
    {
        $this->signIn(1);
        $this->get(route('Ship-Mark.admin.shipment-f'))->assertForbidden();
        $this->post(route('Ship-Mark.pegawai.shipment-f-store'), [
            'no_so' => 'SO', 'reference' => str_repeat('W', 101), 'destination' => 'CANADA',
        ])->assertSessionHasErrors('reference');
        $this->assertSame(0, ShipF::count());
    }

    public function test_group_links_work_when_no_so_contains_a_slash(): void
    {
        $this->signIn(0);
        $item = ShipF::create(['no_so' => 'SO/123', 'reference' => 'REF', 'destination' => 'CANADA']);
        $this->get(route('Ship-Mark.admin.shipment-f'))->assertOk()->assertSee('SO/123');
        $this->get(route('Ship-Mark.admin.shipment-f-show', $item->id))->assertOk()->assertSee('REF');
    }

    public function test_excel_import_saves_rows_and_rejects_invalid_files_without_partial_writes(): void
    {
        $this->signIn(0);
        $headers = ['SO', 'UNICODE', 'POD', 'ATTRIBUTE'];
        $valid = $this->spreadsheet([$headers, ['SOX26-26038', '23353 / V26-2407', 'VANCOUVER BC, CANADA', 'ATTR-001']]);
        $this->post(route('Ship-Mark.admin.shipment-f-import'), ['file' => $valid])->assertSessionHasNoErrors();
        $this->assertSame('23353 / V26-2407', ShipF::firstOrFail()->reference);
        $this->assertSame('VANCOUVER BC, CANADA', ShipF::firstOrFail()->destination);
        $this->assertSame('ATTR-001', ShipF::firstOrFail()->attribute);

        $invalid = $this->spreadsheet([$headers, ['OTHER', 'VALID', 'CANADA', 'A'], ['OTHER', 'MISSING ATTRIBUTE', 'CANADA', '']]);
        $this->post(route('Ship-Mark.admin.shipment-f-import'), ['file' => $invalid])->assertSessionHasErrors('file');
        $this->assertSame(1, ShipF::count());

        $wrongHeader = $this->spreadsheet([['WRONG', 'UNICODE', 'POD', 'ATTRIBUTE'], ['SO', 'REF', 'DEST', 'A']]);
        $this->post(route('Ship-Mark.admin.shipment-f-import'), ['file' => $wrongHeader])->assertSessionHasErrors('file');
        $this->assertSame(1, ShipF::count());

        $tooLong = $this->spreadsheet([$headers, ['SO', str_repeat('W', 101), 'CANADA', 'A']]);
        $this->post(route('Ship-Mark.admin.shipment-f-import'), ['file' => $tooLong])->assertSessionHasErrors('file');
        $this->assertSame(1, ShipF::count());
    }

    public function test_downloadable_template_is_an_excel_file(): void
    {
        $this->signIn(0);
        $response = $this->get(route('Ship-Mark.admin.shipment-f-template'));
        $response->assertOk()->assertDownload('ShippmentF.xlsx');
        $sheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($response->baseResponse->getFile()->getPathname());
        $this->assertSame(['SO', 'UNICODE', 'POD', 'ATTRIBUTE'], array_values($sheet->getActiveSheet()->rangeToArray('A1:D1')[0]));
        $sheet->disconnectWorksheets();
    }
}
