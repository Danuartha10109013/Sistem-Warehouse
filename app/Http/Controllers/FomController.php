<?php

namespace App\Http\Controllers;

use App\Exports\CrcExportExcel;
use App\Exports\IngotExportExcel;
use App\Exports\ResinExportExcel;
use App\Models\CrcM;
use App\Models\Crc_imageM;
use App\Models\Ingot_imageM;
use App\Models\IngotM;
use App\Models\Resin_imageM;
use App\Models\ResinM;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class FomController extends Controller
{
    private const MATERIAL_TYPES = ['crc', 'ingot', 'resin'];

    private const MATERIAL_MODELS = [
        'crc' => CrcM::class,
        'ingot' => IngotM::class,
        'resin' => ResinM::class,
    ];

    private function authorizeFomcheckOwnership($model): void
    {
        if ((int) Auth::user()->role === 0) {
            return;
        }
        if ((int) $model->user_id !== (int) Auth::id()) {
            abort(403);
        }
    }

    public function index(Request $request)
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }
        $type = $request->get('type', 'crc');
        if (!in_array($type, self::MATERIAL_TYPES, true)) {
            $type = 'crc';
        }

        $searchTerm = $request->input('search');
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', $type === 'crc' ? 'desc' : 'asc');
        $start = $request->get('start');
        $end = $request->get('end');

        $data = $this->paginateMaterial(self::MATERIAL_MODELS[$type], $request);

        $users = User::whereIn('id', $data->getCollection()->pluck('user_id')->unique()->filter())
            ->pluck('name', 'id');

        return view('fomcheck.index', compact(
            'data',
            'type',
            'searchTerm',
            'sort',
            'direction',
            'start',
            'end',
            'users'
        ));
    }

    private function paginateMaterial(string $modelClass, Request $request)
    {
        $searchTerm = $request->input('search');
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'desc');
        $start = $request->get('start');
        $end = $request->get('end');

        $query = $modelClass::query();

        if ($searchTerm) {
            $userIds = User::where('name', 'LIKE', '%' . $searchTerm . '%')->pluck('id');

            $query->where(function ($q) use ($userIds, $searchTerm) {
                $q->whereIn('user_id', $userIds)
                    ->orWhere('shift_leader', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        if ($start && $end) {
            $query->whereBetween('created_at', [$start, $end]);
        } elseif ($start) {
            $query->whereDate('created_at', '>=', $start);
        } elseif ($end) {
            $query->whereDate('created_at', '<=', $end);
        }

        if (Auth::user()->role != 0) {
            $query->where('user_id', Auth::id());
        }

        return $query->orderBy($sort, $direction)->paginate(10)->withQueryString();
    }

    private function redirectAfterStore(Request $request, string $type, string $message)
    {
        if ($request->boolean('embed')) {
            return response()->view('fomcheck.embed-success', [
                'message' => $message,
                'type' => $type,
            ]);
        }

        return redirect()->route('fomcheck', ['type' => $type])->with('success', $message);
    }

    public function add_crc(Request $request)
    {
        return view('Form-Check.pages.material.crc.add', [
            'storeRoute' => route('fomcheck.crc.create'),
            'embed' => $request->boolean('embed'),
        ]);
    }

    public function show_crc(Request $request, $id)
    {
        $submission = CrcM::findOrFail($id);
        return view('Form-Check.pages.material.crc.show', [
            'submission' => $submission,
            'embed' => $request->boolean('embed'),
        ]);
    }

    public function edit_crc(Request $request, $id)
    {
        $submission = CrcM::findOrFail($id);
        $this->authorizeFomcheckOwnership($submission);

        return view('Form-Check.pages.material.crc.add', [
            'submission' => $submission,
            'updateRoute' => route('fomcheck.crc.update', $id),
            'respondenName' => User::find($submission->user_id)?->name ?? '—',
            'embed' => $request->boolean('embed'),
        ]);
    }

    public function create_crc(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'shift_leader' => 'required|string',
            'date' => 'required|date',
            'supplier' => 'required|array',
            'metode_unloading' => 'required|string',
            'ket_awal' => 'required|string',
            'cuaca' => 'nullable|string',
            'jalan' => 'required|string',
            'sesuai' => 'nullable|string',
            'baik' => 'nullable|string',
            'kering' => 'nullable|string',
            'kencang' => 'nullable|string',
            'jumlahin' => 'nullable|string',
            'wall' => 'nullable|string',
            'perganjalan' => 'nullable|string',
            'foto' => 'nullable|array',
            'foto1' => 'nullable|array',
            'foto2' => 'nullable|array',
            'foto3' => 'nullable|array',
            'foto4' => 'nullable|array',
            'foto5' => 'nullable|array',
            'foto6' => 'nullable|array',
            'foto7' => 'nullable|array',
            'ket_radiasi' => 'nullable',
            'radiasi' => 'nullable',
            'note_keseluruhan' => 'nullable|string',
            'time' => 'required',
            'time_last' => 'required',
        ]);

        $crc = CrcM::create([
            'user_id' => $request->input('user_id'),
            'shift_leader' => $request->input('shift_leader'),
            'date' => $request->input('date'),
            'supplier' => json_encode($request->input('supplier')),
            'metode_unloading' => $request->input('metode_unloading'),
            'ket_awal' => $request->input('ket_awal'),
            'cuaca' => $request->input('cuaca'),
            'jalan' => $request->input('jalan'),
            'keterangan' => $request->input('keterangan'),
            'sesuai' => $request->input('sesuai'),
            'keterangan1' => $request->input('keterangan1'),
            'baik' => $request->input('baik'),
            'keterangan2' => $request->input('keterangan2'),
            'kering' => $request->input('kering'),
            'keterangan3' => $request->input('keterangan3'),
            'kencang' => $request->input('kencang'),
            'keterangan4' => $request->input('keterangan4'),
            'jumlahin' => $request->input('jumlahin'),
            'keterangan5' => $request->input('keterangan5'),
            'alas' => $request->input('alas'),
            'keterangan6' => $request->input('keterangan6'),
            'wall' => $request->input('wall'),
            'keterangan7' => $request->input('keterangan7'),
            'radiasi' => $request->input('radiasi'),
            'ket_radiasi' => $request->input('ket_radiasi'),
            'perganjalan' => $request->input('perganjalan'),
            'time' => $request->input('time'),
            'time_last' => $request->input('time_last'),
            'note_keseluruhan' => $request->input('note_keseluruhan'),
        ]);

        $this->storeMaterialImages($request, $crc->id, 'crc', Crc_imageM::class, 'crc_id', [
            'foto', 'foto1', 'foto2', 'foto3', 'foto4', 'foto5', 'foto6', 'foto7',
        ]);

        return $this->redirectAfterStore($request, 'crc', 'Data CRC berhasil disimpan');
    }

    public function update_crc(Request $request, $id)
    {
        $crc = CrcM::findOrFail($id);
        $this->authorizeFomcheckOwnership($crc);

        $request->validate([
            'user_id' => 'required|integer',
            'shift_leader' => 'required|string',
            'date' => 'required|date',
            'supplier' => 'required|array',
            'metode_unloading' => 'required|string',
            'ket_awal' => 'required|string',
            'cuaca' => 'nullable|string',
            'jalan' => 'required|string',
            'sesuai' => 'nullable|string',
            'baik' => 'nullable|string',
            'kering' => 'nullable|string',
            'kencang' => 'nullable|string',
            'jumlahin' => 'nullable|string',
            'wall' => 'nullable|string',
            'perganjalan' => 'nullable|string',
            'foto' => 'nullable|array',
            'foto1' => 'nullable|array',
            'foto2' => 'nullable|array',
            'foto3' => 'nullable|array',
            'foto4' => 'nullable|array',
            'foto5' => 'nullable|array',
            'foto6' => 'nullable|array',
            'foto7' => 'nullable|array',
            'ket_radiasi' => 'nullable',
            'radiasi' => 'nullable',
            'note_keseluruhan' => 'nullable|string',
            'time' => 'required',
            'time_last' => 'required',
        ]);

        $crc->update([
            'shift_leader' => $request->input('shift_leader'),
            'date' => $request->input('date'),
            'supplier' => json_encode($request->input('supplier')),
            'metode_unloading' => $request->input('metode_unloading'),
            'ket_awal' => $request->input('ket_awal'),
            'cuaca' => $request->input('cuaca'),
            'jalan' => $request->input('jalan'),
            'keterangan' => $request->input('keterangan'),
            'sesuai' => $request->input('sesuai'),
            'keterangan1' => $request->input('keterangan1'),
            'baik' => $request->input('baik'),
            'keterangan2' => $request->input('keterangan2'),
            'kering' => $request->input('kering'),
            'keterangan3' => $request->input('keterangan3'),
            'kencang' => $request->input('kencang'),
            'keterangan4' => $request->input('keterangan4'),
            'jumlahin' => $request->input('jumlahin'),
            'keterangan5' => $request->input('keterangan5'),
            'alas' => $request->input('alas'),
            'keterangan6' => $request->input('keterangan6'),
            'wall' => $request->input('wall'),
            'keterangan7' => $request->input('keterangan7'),
            'radiasi' => $request->input('radiasi'),
            'ket_radiasi' => $request->input('ket_radiasi'),
            'perganjalan' => $request->input('perganjalan'),
            'time' => $request->input('time'),
            'time_last' => $request->input('time_last'),
            'note_keseluruhan' => $request->input('note_keseluruhan'),
        ]);

        $this->mergeMaterialImages($request, $crc->id, 'crc', Crc_imageM::class, 'crc_id', [
            'foto', 'foto1', 'foto2', 'foto3', 'foto4', 'foto5', 'foto6', 'foto7',
        ]);

        return $this->redirectAfterStore($request, 'crc', 'Data CRC berhasil diperbarui');
    }

    public function print_crc($id)
    {
        $submission = CrcM::findOrFail($id);
        $foto = Crc_imageM::where('crc_id', $submission->id)->first();
        return view('Form-Check.pages.material.crc.print', compact('submission', 'foto'));
    }

    public function add_ingot(Request $request)
    {
        return view('Form-Check.pages.material.ingot.add', [
            'storeRoute' => route('fomcheck.ingot.create'),
            'embed' => $request->boolean('embed'),
        ]);
    }

    public function show_ingot(Request $request, $id)
    {
        $submission = IngotM::findOrFail($id);
        return view('Form-Check.pages.material.ingot.detail', [
            'submission' => $submission,
            'embed' => $request->boolean('embed'),
        ]);
    }

    public function edit_ingot(Request $request, $id)
    {
        $submission = IngotM::findOrFail($id);
        $this->authorizeFomcheckOwnership($submission);

        return view('Form-Check.pages.material.ingot.add', [
            'submission' => $submission,
            'updateRoute' => route('fomcheck.ingot.update', $id),
            'respondenName' => User::find($submission->user_id)?->name ?? '—',
            'embed' => $request->boolean('embed'),
        ]);
    }

    public function create_ingot(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'shift_leader' => 'required|string',
            'jalan' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'time_awal_bongkar' => 'nullable|date_format:H:i',
            'time_akhir_bongkar' => 'nullable|date_format:H:i',
            'supplier' => 'required|array',
            'jenis' => 'nullable|string',
            'jumlah' => 'required|string|max:191',
            'cuaca' => 'nullable|string',
            'foto' => 'nullable|array',
            'keterangan' => 'nullable|string',
            'sesuai' => 'nullable|string',
            'foto1' => 'nullable|array',
            'keterangan1' => 'nullable|string',
            'kering' => 'nullable|string',
            'foto3' => 'nullable|array',
            'keterangan3' => 'nullable|string',
            'jumlahin' => 'nullable|string',
            'foto5' => 'nullable|array',
            'keterangan5' => 'nullable|string',
            'radiasi' => 'required',
            'ket_radiasi' => 'nullable|string',
        ]);

        $ingot = IngotM::create([
            'user_id' => $request->input('user_id'),
            'shift_leader' => $request->input('shift_leader'),
            'jalan' => $request->input('jalan'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'time_awal_bongkar' => $request->input('time_awal_bongkar'),
            'time_akhir_bongkar' => $request->input('time_akhir_bongkar'),
            'supplier' => json_encode($request->input('supplier')),
            'jenis' => $request->input('jenis'),
            'jumlah' => $request->input('jumlah'),
            'cuaca' => $request->input('cuaca'),
            'keterangan' => $request->input('keterangan'),
            'sesuai' => $request->input('sesuai'),
            'keterangan1' => $request->input('keterangan1'),
            'kering' => $request->input('kering'),
            'keterangan3' => $request->input('keterangan3'),
            'jumlahin' => $request->input('jumlahin'),
            'keterangan5' => $request->input('keterangan5'),
            'radiasi' => $request->input('radiasi'),
            'ket_radiasi' => $request->input('ket_radiasi'),
        ]);

        $this->storeMaterialImages($request, $ingot->id, 'ingot', Ingot_imageM::class, 'ingot_id', [
            'foto', 'foto1', 'foto3', 'foto5',
        ]);

        return $this->redirectAfterStore($request, 'ingot', 'Data INGOT berhasil disimpan');
    }

    public function update_ingot(Request $request, $id)
    {
        $ingot = IngotM::findOrFail($id);
        $this->authorizeFomcheckOwnership($ingot);

        $request->validate([
            'user_id' => 'required|integer',
            'shift_leader' => 'required|string',
            'jalan' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'time_awal_bongkar' => 'nullable|date_format:H:i',
            'time_akhir_bongkar' => 'nullable|date_format:H:i',
            'supplier' => 'required|array',
            'jenis' => 'nullable|string',
            'jumlah' => 'required|string|max:191',
            'cuaca' => 'nullable|string',
            'foto' => 'nullable|array',
            'keterangan' => 'nullable|string',
            'sesuai' => 'nullable|string',
            'foto1' => 'nullable|array',
            'keterangan1' => 'nullable|string',
            'kering' => 'nullable|string',
            'foto3' => 'nullable|array',
            'keterangan3' => 'nullable|string',
            'jumlahin' => 'nullable|string',
            'foto5' => 'nullable|array',
            'keterangan5' => 'nullable|string',
            'radiasi' => 'required',
            'ket_radiasi' => 'nullable|string',
        ]);

        $ingot->update([
            'shift_leader' => $request->input('shift_leader'),
            'jalan' => $request->input('jalan'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'time_awal_bongkar' => $request->input('time_awal_bongkar'),
            'time_akhir_bongkar' => $request->input('time_akhir_bongkar'),
            'supplier' => json_encode($request->input('supplier')),
            'jenis' => $request->input('jenis'),
            'jumlah' => $request->input('jumlah'),
            'cuaca' => $request->input('cuaca'),
            'keterangan' => $request->input('keterangan'),
            'sesuai' => $request->input('sesuai'),
            'keterangan1' => $request->input('keterangan1'),
            'kering' => $request->input('kering'),
            'keterangan3' => $request->input('keterangan3'),
            'jumlahin' => $request->input('jumlahin'),
            'keterangan5' => $request->input('keterangan5'),
            'radiasi' => $request->input('radiasi'),
            'ket_radiasi' => $request->input('ket_radiasi'),
        ]);

        $this->mergeMaterialImages($request, $ingot->id, 'ingot', Ingot_imageM::class, 'ingot_id', [
            'foto', 'foto1', 'foto3', 'foto5',
        ]);

        return $this->redirectAfterStore($request, 'ingot', 'Data INGOT berhasil diperbarui');
    }

    public function print_ingot($id)
    {
        $submission = IngotM::findOrFail($id);
        $foto = Ingot_imageM::where('ingot_id', $submission->id)->first();
        return view('Form-Check.pages.material.ingot.print', compact('submission', 'foto'));
    }

    public function add_resin(Request $request)
    {
        return view('Form-Check.pages.material.resin.add', [
            'storeRoute' => route('fomcheck.resin.create'),
            'embed' => $request->boolean('embed'),
        ]);
    }

    public function show_resin(Request $request, $id)
    {
        $submission = ResinM::findOrFail($id);
        return view('Form-Check.pages.material.resin.detail', [
            'submission' => $submission,
            'embed' => $request->boolean('embed'),
        ]);
    }

    public function edit_resin(Request $request, $id)
    {
        $submission = ResinM::findOrFail($id);
        $this->authorizeFomcheckOwnership($submission);

        return view('Form-Check.pages.material.resin.add', [
            'submission' => $submission,
            'updateRoute' => route('fomcheck.resin.update', $id),
            'respondenName' => User::find($submission->user_id)?->name ?? '—',
            'embed' => $request->boolean('embed'),
        ]);
    }

    public function create_resin(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'shift_leader' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'time_awal_bongkar' => 'nullable|date_format:H:i',
            'time_akhir_bongkar' => 'nullable|date_format:H:i',
            'supplier' => 'required|array',
            'jenis' => 'nullable|string',
            'jumlah' => 'required|string|max:191',
            'jalan' => 'required|string',
            'radiasi' => 'required',
            'ket_radiasi' => 'nullable|string',
            'cuaca' => 'nullable|string',
            'foto' => 'nullable|array',
            'keterangan' => 'nullable|string',
            'sesuai' => 'nullable|string',
            'foto1' => 'nullable|array',
            'keterangan1' => 'nullable|string',
            'kering' => 'nullable|string',
            'foto3' => 'nullable|array',
            'keterangan3' => 'nullable|string',
            'jumlahin' => 'nullable|string',
            'foto5' => 'nullable|array',
            'keterangan5' => 'nullable|string',
            'drum' => 'nullable|string',
            'foto6' => 'nullable|array',
            'keterangan6' => 'nullable|string',
        ]);

        $resin = ResinM::create([
            'user_id' => $request->input('user_id'),
            'shift_leader' => $request->input('shift_leader'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'time_awal_bongkar' => $request->input('time_awal_bongkar'),
            'time_akhir_bongkar' => $request->input('time_akhir_bongkar'),
            'supplier' => json_encode($request->input('supplier')),
            'jenis' => $request->input('jenis'),
            'jumlah' => $request->input('jumlah'),
            'jalan' => $request->input('jalan'),
            'cuaca' => $request->input('cuaca'),
            'keterangan' => $request->input('keterangan'),
            'sesuai' => $request->input('sesuai'),
            'keterangan1' => $request->input('keterangan1'),
            'kering' => $request->input('kering'),
            'keterangan3' => $request->input('keterangan3'),
            'jumlahin' => $request->input('jumlahin'),
            'keterangan5' => $request->input('keterangan5'),
            'drum' => $request->input('drum'),
            'keterangan6' => $request->input('keterangan6'),
            'radiasi' => $request->input('radiasi'),
            'ket_radiasi' => $request->input('ket_radiasi'),
        ]);

        $this->storeMaterialImages($request, $resin->id, 'resin', Resin_imageM::class, 'resin_id', [
            'foto', 'foto1', 'foto3', 'foto5', 'foto6',
        ]);

        return $this->redirectAfterStore($request, 'resin', 'Data RESIN berhasil disimpan');
    }

    public function update_resin(Request $request, $id)
    {
        $resin = ResinM::findOrFail($id);
        $this->authorizeFomcheckOwnership($resin);

        $request->validate([
            'user_id' => 'required|integer',
            'shift_leader' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'time_awal_bongkar' => 'nullable|date_format:H:i',
            'time_akhir_bongkar' => 'nullable|date_format:H:i',
            'supplier' => 'required|array',
            'jenis' => 'nullable|string',
            'jumlah' => 'required|string|max:191',
            'jalan' => 'required|string',
            'radiasi' => 'required',
            'ket_radiasi' => 'nullable|string',
            'cuaca' => 'nullable|string',
            'foto' => 'nullable|array',
            'keterangan' => 'nullable|string',
            'sesuai' => 'nullable|string',
            'foto1' => 'nullable|array',
            'keterangan1' => 'nullable|string',
            'kering' => 'nullable|string',
            'foto3' => 'nullable|array',
            'keterangan3' => 'nullable|string',
            'jumlahin' => 'nullable|string',
            'foto5' => 'nullable|array',
            'keterangan5' => 'nullable|string',
            'drum' => 'nullable|string',
            'foto6' => 'nullable|array',
            'keterangan6' => 'nullable|string',
        ]);

        $resin->update([
            'shift_leader' => $request->input('shift_leader'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'time_awal_bongkar' => $request->input('time_awal_bongkar'),
            'time_akhir_bongkar' => $request->input('time_akhir_bongkar'),
            'supplier' => json_encode($request->input('supplier')),
            'jenis' => $request->input('jenis'),
            'jumlah' => $request->input('jumlah'),
            'jalan' => $request->input('jalan'),
            'cuaca' => $request->input('cuaca'),
            'keterangan' => $request->input('keterangan'),
            'sesuai' => $request->input('sesuai'),
            'keterangan1' => $request->input('keterangan1'),
            'kering' => $request->input('kering'),
            'keterangan3' => $request->input('keterangan3'),
            'jumlahin' => $request->input('jumlahin'),
            'keterangan5' => $request->input('keterangan5'),
            'drum' => $request->input('drum'),
            'keterangan6' => $request->input('keterangan6'),
            'radiasi' => $request->input('radiasi'),
            'ket_radiasi' => $request->input('ket_radiasi'),
        ]);

        $this->mergeMaterialImages($request, $resin->id, 'resin', Resin_imageM::class, 'resin_id', [
            'foto', 'foto1', 'foto3', 'foto5', 'foto6',
        ]);

        return $this->redirectAfterStore($request, 'resin', 'Data RESIN berhasil diperbarui');
    }

    public function print_resin($id)
    {
        $submission = ResinM::findOrFail($id);
        $foto = Resin_imageM::where('resin_id', $submission->id)->first();
        return view('Form-Check.pages.material.resin.print', compact('submission', 'foto'));
    }

    public function destroy_crc($id)
    {
        $model = CrcM::findOrFail($id);
        $this->authorizeFomcheckOwnership($model);
        $model->delete();
        return redirect()->route('fomcheck', ['type' => 'crc'])->with('success', 'Data berhasil dihapus');
    }

    public function destroy_ingot($id)
    {
        $model = IngotM::findOrFail($id);
        $this->authorizeFomcheckOwnership($model);
        $model->delete();
        return redirect()->route('fomcheck', ['type' => 'ingot'])->with('success', 'Data berhasil dihapus');
    }

    public function destroy_resin($id)
    {
        $model = ResinM::findOrFail($id);
        $this->authorizeFomcheckOwnership($model);
        $model->delete();
        return redirect()->route('fomcheck', ['type' => 'resin'])->with('success', 'Data berhasil dihapus');
    }

    public function crc_export()
    {
        $date = now()->format('d-m-Y');
        return Excel::download(new CrcExportExcel, $date . '_CrC.xlsx');
    }

    public function ingot_export()
    {
        $date = now()->format('d-m-Y');
        return Excel::download(new IngotExportExcel, $date . '_Ingot.xlsx');
    }

    public function resin_export()
    {
        $date = now()->format('d-m-Y');
        return Excel::download(new ResinExportExcel, $date . '_Resin.xlsx');
    }

    private function storeMaterialImages(
        Request $request,
        int $parentId,
        string $folder,
        string $imageModelClass,
        string $foreignKey,
        array $fileInputs
    ): void {
        try {
            $fileNames = [];

            foreach ($fileInputs as $inputName) {
                if (!$request->hasFile($inputName)) {
                    continue;
                }

                $uploadedFileNames = [];
                foreach ($request->file($inputName) as $file) {
                    if ($file instanceof \Illuminate\Http\UploadedFile && $file->isValid()) {
                        $name = now()->format('d-m-Y') . '/' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $file->storeAs($folder, $name, 'public');
                        $uploadedFileNames[] = $name;
                    }
                }

                if ($uploadedFileNames) {
                    $fileNames[$inputName] = json_encode($uploadedFileNames);
                }
            }

            if ($fileNames) {
                $imageModelClass::create(array_merge($fileNames, [$foreignKey => $parentId]));
            }
        } catch (Exception $e) {
            abort(500, $e->getMessage());
        }
    }

    private function mergeMaterialImages(
        Request $request,
        int $parentId,
        string $folder,
        string $imageModelClass,
        string $foreignKey,
        array $fileInputs
    ): void {
        try {
            $existing = $imageModelClass::where($foreignKey, $parentId)->orderBy('id')->first();
            $updates = [];

            foreach ($fileInputs as $inputName) {
                if (!$request->hasFile($inputName)) {
                    continue;
                }

                $existingArr = [];
                if ($existing) {
                    $existingJson = $existing->{$inputName} ?? null;
                    if ($existingJson) {
                        $decoded = json_decode($existingJson, true);
                        $existingArr = is_array($decoded) ? $decoded : [];
                    }
                }

                $uploadedFileNames = [];
                foreach ($request->file($inputName) as $file) {
                    if ($file instanceof \Illuminate\Http\UploadedFile && $file->isValid()) {
                        $name = now()->format('d-m-Y') . '/' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $file->storeAs($folder, $name, 'public');
                        $uploadedFileNames[] = $name;
                    }
                }

                if ($uploadedFileNames) {
                    $merged = array_values(array_merge($existingArr, $uploadedFileNames));
                    $updates[$inputName] = json_encode($merged);
                }
            }

            if (!$updates) {
                return;
            }

            if ($existing) {
                foreach ($updates as $column => $value) {
                    $existing->{$column} = $value;
                }
                $existing->save();
            } else {
                $imageModelClass::create(array_merge($updates, [$foreignKey => $parentId]));
            }
        } catch (Exception $e) {
            abort(500, $e->getMessage());
        }
    }
}
