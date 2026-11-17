<?php

namespace App\Http\Controllers;

use App\Exports\CrcExportExcel;
use App\Exports\IngotExportExcel;
use App\Exports\ResinExportExcel;
use App\Models\CraneM;
use App\Models\CrcM;
use App\Models\Crc_imageM;
use App\Models\Ingot_imageM;
use App\Models\IngotM;
use App\Models\Resin_imageM;
use App\Models\ResinM;
use App\Models\TraillerM;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class MaterialController extends Controller
{

    // [TAG: QUERY FILTER MATERIAL] Query dasar dengan pencarian dan filter tanggal inklusif
    private function buildMaterialQuery(string $modelClass, Request $request)
    {
        $searchTerm = $request->input('search');
        $start = $request->get('start', null);
        $end = $request->get('end', null);

        $query = $modelClass::query();

        if ($searchTerm) {
            $results = User::where('name', 'LIKE', '%' . $searchTerm . '%')->pluck('id');
            $query->where(function ($q) use ($results, $searchTerm) {
                $q->whereIn('user_id', $results)
                  ->orWhere('shift_leader', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        // [TAG: FILTER TANGGAL] Filter rentang tanggal inklusif hari penuh (created_at dan date)
        if (!empty($start) && !empty($end)) {
            $startDate = Carbon::parse($start)->startOfDay();
            $endDate = Carbon::parse($end)->endOfDay();
            if ($startDate->gt($endDate)) {
                $temp = $startDate;
                $startDate = $endDate->copy()->startOfDay();
                $endDate = $temp->copy()->endOfDay();
            }
            $startStr = $startDate->format('Y-m-d H:i:s');
            $endStr = $endDate->format('Y-m-d H:i:s');
            $dateStart = $startDate->format('Y-m-d');
            $dateEnd = $endDate->format('Y-m-d');

            $query->where(function ($q) use ($startStr, $endStr, $dateStart, $dateEnd) {
                $q->whereBetween('created_at', [$startStr, $endStr])
                  ->orWhereBetween('date', [$dateStart, $dateEnd]);
            });
        } elseif (!empty($start)) {
            $startDate = Carbon::parse($start)->startOfDay();
            $startStr = $startDate->format('Y-m-d H:i:s');
            $dateStart = $startDate->format('Y-m-d');

            $query->where(function ($q) use ($startStr, $dateStart) {
                $q->where('created_at', '>=', $startStr)
                  ->orWhere('date', '>=', $dateStart);
            });
        } elseif (!empty($end)) {
            $endDate = Carbon::parse($end)->endOfDay();
            $endStr = $endDate->format('Y-m-d H:i:s');
            $dateEnd = $endDate->format('Y-m-d');

            $query->where(function ($q) use ($endStr, $dateEnd) {
                $q->where('created_at', '<=', $endStr)
                  ->orWhere('date', '<=', $dateEnd);
            });
        }

        if (Auth::user()->role != 0) {
            $query->where('user_id', Auth::user()->id);
        }

        return $query;
    }

    // [TAG: HALAMAN UTAMA CRC]
    public function index_crc(Request $request) {
        $searchTerm = $request->input('search');
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'desc');
        $start = $request->get('start', null);
        $end = $request->get('end', null);

        $query = $this->buildMaterialQuery(CrcM::class, $request);
        $data = $query->orderBy($sort, $direction)->paginate(10)->withQueryString();

        return view('Form-Check.pages.material.crc.index', compact('data','searchTerm', 'sort', 'direction','start','end'));
    }


    public function add_crc (){
        return view('Form-Check.pages.material.crc.add');
    }

    public function show_crc ($id){
        $submission = CrcM::find($id);
        return view('Form-Check.pages.material.crc.show',compact('submission'));
    }


    public function create_crc(Request $request)
    {

        // dd($request->all());
        // Validate the request
        $validated = $request->validate([
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

        $data = [
            'user_id' => $request->input('user_id'),
            'shift_leader' => $request->input('shift_leader'),
            'date' => $request->input('date'),
            'supplier' => json_encode($request->input('supplier')), // Convert array to JSON
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
        ];

        $crc = CrcM::create($data);
        // dd($crc)

        try {
            $fileNames = [];
            $fileInputs = ['foto', 'foto1', 'foto2','foto3','foto4','foto5','foto6','foto7' ];

            foreach ($fileInputs as $inputName) {
                if ($request->hasFile($inputName)) {
                    $files = $request->file($inputName);
                    $uploadedFileNames = [];

                    foreach ($files as $file) {
                        if ($file instanceof \Illuminate\Http\UploadedFile && $file->isValid()) { // Validate the file
                            $date = now()->format('d-m-Y');
                            $name = $date . '/' . uniqid() . '.' . $file->getClientOriginalExtension();
                            $file->storeAs('crc', $name, 'public');

                            $uploadedFileNames[] = $name;
                        }
                    }

                    $fileNames[$inputName] = json_encode($uploadedFileNames);
                }
            }

            // Prepare data for database
            $crc_image_data = array_merge($fileNames, ['crc_id' => $crc->id]); // Add `crc_id` here

            // Save to database
            Crc_imageM::create($crc_image_data);
        } catch (Exception $e) {
            // Handle exception
            return response()->json(['error' => $e->getMessage()], 500);
        }

        if (Auth::user()->role == 0){
            return redirect()->route('Form-Check.admin.crc')->with('succes', 'Submission complite');
        }else{
            return redirect()->route('Form-Check.pegawai.crc')->with('succes', 'Submission complite');
        }

    }

    public function print_crc($id){

        $submission = CrcM::find($id);
        $same = $submission->id;
        $ids = Crc_imageM::where('crc_id',$same)->value('id');
        $foto= Crc_imageM::find($ids);
        // dd($foto);
        return view('Form-Check.pages.material.crc.print',compact('submission','foto'));
    }

    // [TAG: HALAMAN UTAMA INGOT]
    public function index_ingot(Request $request) {
        $searchTerm = $request->input('search');
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'desc');
        $start = $request->get('start', null);
        $end = $request->get('end', null);

        $query = $this->buildMaterialQuery(IngotM::class, $request);
        $data = $query->orderBy($sort, $direction)->paginate(10)->withQueryString();

        return view('Form-Check.pages.material.ingot.index', compact('data','searchTerm', 'sort', 'direction','start','end'));
    }

    public function add_ingot (){
        return view('Form-Check.pages.material.ingot.add');
    }
    public function show_ingot ($id){
        $submission = IngotM::find($id);
        return view('Form-Check.pages.material.ingot.detail',compact('submission'));
    }

    public function create_ingot(Request $request)
    {

        // dd($request->all());
        // Validate the request
        $validated = $request->validate([
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

        $data = [
            'user_id' => $request->input('user_id'),
            'shift_leader' => $request->input('shift_leader'),
            'jalan' => $request->input('jalan'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'time_awal_bongkar' => $request->input('time_awal_bongkar'),
            'time_akhir_bongkar' => $request->input('time_akhir_bongkar'),
            'supplier' => json_encode($request->input('supplier')), // Convert array to JSON
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

        ];

        $crc = IngotM::create($data);

        try {
            $fileNames = [];
            $fileInputs = ['foto', 'foto1','foto3','foto5'];

            foreach ($fileInputs as $inputName) {
                if ($request->hasFile($inputName)) {
                    $files = $request->file($inputName);
                    $uploadedFileNames = [];

                    foreach ($files as $file) {
                        if ($file instanceof \Illuminate\Http\UploadedFile && $file->isValid()) { // Validate the file
                            $date = now()->format('d-m-Y');
                            $name = $date . '/' . uniqid() . '.' . $file->getClientOriginalExtension();
                            $file->storeAs('ingot', $name, 'public');

                            $uploadedFileNames[] = $name;
                        }
                    }

                    $fileNames[$inputName] = json_encode($uploadedFileNames);
                }
            }

            // Prepare data for database
            $crc_image_data = array_merge($fileNames, ['ingot_id' => $crc->id]); // Add `crc_id` here

            // Save to database
            Ingot_imageM::create($crc_image_data);
        } catch (Exception $e) {
            // Handle exception
            return response()->json(['error' => $e->getMessage()], 500);
        }

        if (Auth::user()->role == 0){
            return redirect()->route('Form-Check.admin.ingot')->with('succes', 'Submission complite');
        }else{
            return redirect()->route('Form-Check.pegawai.ingot')->with('succes', 'Submission complite');
        }

    }

    public function print_ingot($id){
        $submission= IngotM::find($id);
        $same = $submission->id;
        $ids = Ingot_imageM::where('ingot_id',$same)->value('id');
        $foto= Ingot_imageM::find($ids);
        // dd($foto);

        return view('Form-Check.pages.material.ingot.print',compact('submission','foto'));
    }
    public function print_resin($id){
        $submission= ResinM::find($id);
        $same = $submission->id;
        $ids = Resin_imageM::where('resin_id',$same)->value('id');
        $foto= Resin_imageM::find($ids);
        // dd($ids);

        return view('Form-Check.pages.material.resin.print',compact('submission','foto'));
    }

    public function show_resin($id){
        $submission= ResinM::find($id);
        return view('Form-Check.pages.material.resin.detail',compact('submission'));
    }

    // [TAG: HALAMAN UTAMA RESIN]
    public function index_resin(Request $request) {
        $searchTerm = $request->input('search');
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'desc');
        $start = $request->get('start', null);
        $end = $request->get('end', null);

        $query = $this->buildMaterialQuery(ResinM::class, $request);
        $data = $query->orderBy($sort, $direction)->paginate(10)->withQueryString();

        return view('Form-Check.pages.material.resin.index', compact('data','searchTerm', 'sort', 'direction','start','end'));
    }

        public function add_resin (){
            return view('Form-Check.pages.material.resin.add');
        }

        public function create_resin(Request $request)
    {

        // dd($request->all());
        // Validate the request
        $validated = $request->validate([
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

        $data = [
            'user_id' => $request->input('user_id'),
            'shift_leader' => $request->input('shift_leader'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'time_awal_bongkar' => $request->input('time_awal_bongkar'),
            'time_akhir_bongkar' => $request->input('time_akhir_bongkar'),
            'supplier' => json_encode($request->input('supplier')), // Convert array to JSON
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

        ];

        $crc = ResinM::create($data);
        // dd($crc->id);
        try {
            $fileNames = [];
            $fileInputs = ['foto', 'foto1','foto3','foto5','foto6'];

            foreach ($fileInputs as $inputName) {
                if ($request->hasFile($inputName)) {
                    $files = $request->file($inputName);
                    $uploadedFileNames = [];

                    foreach ($files as $file) {
                        if ($file instanceof \Illuminate\Http\UploadedFile && $file->isValid()) { // Validate the file
                            $date = now()->format('d-m-Y');
                            $name = $date . '/' . uniqid() . '.' . $file->getClientOriginalExtension();
                            $file->storeAs('resin', $name, 'public');

                            $uploadedFileNames[] = $name;
                        }
                    }

                    $fileNames[$inputName] = json_encode($uploadedFileNames);
                }
            }

            // Prepare data for database
            $crc_image_data = array_merge($fileNames, ['resin_id' => $crc->id]);

            // Save to database
            Resin_imageM::create($crc_image_data);
        } catch (Exception $e) {
            // Handle exception
            return response()->json(['error' => $e->getMessage()], 500);
        }

        if (Auth::user()->role == 0){
            return redirect()->route('Form-Check.admin.resin')->with('succes', 'Submission complite');
        }else{
            return redirect()->route('Form-Check.pegawai.resin')->with('succes', 'Submission complite') ;
        }

    }

    public function destroy_crc($id){
        $data = CrcM::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Data berhasil Dihapus');
    }
    public function destroy_ingot($id){
        $data = IngotM::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Data berhasil Dihapus');
    }
    public function destroy_resin($id){
        $data = ResinM::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Data berhasil Dihapus');
    }


    // [TAG: EXPORT RESIN]
    public function resin_export(Request $request){
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'desc');
        $data = $this->buildMaterialQuery(ResinM::class, $request)->orderBy($sort, $direction)->get();
        $date = now()->format('d-m-Y');
        return Excel::download(new ResinExportExcel($data), $date . '_Resin.xlsx');
    }

    // [TAG: EXPORT INGOT]
    public function ingot_export(Request $request){
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'desc');
        $data = $this->buildMaterialQuery(IngotM::class, $request)->orderBy($sort, $direction)->get();
        $date = now()->format('d-m-Y');
        return Excel::download(new IngotExportExcel($data), $date . '_Ingot.xlsx');
    }

    // [TAG: EXPORT CRC]
    public function crc_export(Request $request){
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'desc');
        $data = $this->buildMaterialQuery(CrcM::class, $request)->orderBy($sort, $direction)->get();
        $date = now()->format('d-m-Y');
        return Excel::download(new CrcExportExcel($data), $date . '_CrC.xlsx');
    }
    public function uploadChecklistExcel(Request $request){
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        try {
            Excel::import(new \App\Imports\CrcChecklistImport, $request->file('file'));
            return redirect()->back()->with('success', 'Data checklist berhasil diimport dan dicocokkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat import: ' . $e->getMessage());
        }
    }

    public function updateChecklistManual(Request $request, $id){
        $crc = CrcM::find($id);
        if(!$crc){
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $produk = $request->input('produk', []);
        $attribute = $request->input('attribute', []);
        $supplier_lot_no = $request->input('supplier_lot_no', []);
        $berat = $request->input('berat', []);

        $checklist_data = [];
        foreach ($produk as $index => $prod) {
            if (!empty($prod) || !empty($attribute[$index])) {
                $checklist_data[] = [
                    'produk' => $prod,
                    'attribute' => $attribute[$index] ?? null,
                    'supplier_lot_no' => $supplier_lot_no[$index] ?? null,
                    'berat' => $berat[$index] ?? null,
                ];
            }
        }

        $crc->update([
            'checklist_data' => count($checklist_data) > 0 ? json_encode($checklist_data) : null
        ]);

        return redirect()->back()->with('success', 'Data checklist manual berhasil disimpan!');
    }
}
