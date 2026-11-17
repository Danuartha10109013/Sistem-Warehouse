<?php

namespace App\Http\Controllers;

use App\Exports\EupExportExcel;
use App\Models\EupM;
use App\Models\ForkliftM;
use App\Models\Resin_imageM;
use App\Models\ResinM;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class EUPController extends Controller
{
    // [TAG: QUERY FILTER EUP] Query dasar dengan pencarian dan filter tanggal inklusif
    private function buildEupQuery(Request $request)
    {
        $searchTerm = $request->input('search');
        $start = $request->get('start', null);
        $end = $request->get('end', null);

        $query = EupM::query();

        if ($searchTerm) {
            $results = User::where('name', 'LIKE', '%' . $searchTerm . '%')->pluck('id');
            $query->whereIn('user_id', $results);
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

    // [TAG: HALAMAN UTAMA] Menampilkan data respon EUP
    public function index(Request $request) {
        $searchTerm = $request->input('search');
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'desc');
        $start = $request->get('start', null);
        $end = $request->get('end', null);

        $query = $this->buildEupQuery($request);
        $data = $query->orderBy($sort, $direction)->paginate(10)->withQueryString();
        $suppliers = ['a','b'];
        return view('Form-Check.pages.eup.index', compact('data','suppliers', 'searchTerm', 'sort', 'direction','start','end'));
    }

    public function add (){
        return view('Form-Check.pages.eup.add');
    }
    public function create(Request $request)
{
    // dd($request->all());
    // Validate form inputs
    $request->validate([
        'user_id' => 'required',
        'date' => 'required|date',
        'jenis' => 'required',
        'kaki_pallet' => 'array|nullable',
        'permukaan_pallet' => 'nullable',
        'ketebalan_pallet' => 'nullable',
        'paku_pallet' => 'nullable',
        'keluar_pallet' => 'nullable',
        'sesuai' => 'required',
        'action' => 'required',
        'foto7.*' => 'nullable|file|mimes:jpg,png,jpeg', // Max 2MB per file
    ]);

    // Handle file uploads
    $uploadedFiles = [];
    if ($request->hasFile('foto7')) {
        foreach ($request->file('foto7') as $file) {
            $date = now()->format('d-m-Y');
            $name = $date . '/' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('eup', $name, 'public');
            $uploadedFiles[] = $name;
        }
    }

    // Create a new record in EupM model
    $crc = new EupM();
    $crc->user_id = $request->user_id;
    $crc->date = $request->date;
    $crc->jenis = $request->jenis;
    $crc->kaki_pallet = implode('|', $request->kaki_pallet ?? []);
    $crc->permukaan_pallet = $request->permukaan_pallet;
    $crc->ketebalan_pallet = $request->ketebalan_pallet;
    $crc->paku_pallet = $request->paku_pallet;
    $crc->keluar_pallet = $request->keluar_pallet;
    $crc->sesuai = $request->sesuai;
    $crc->action = $request->action;
    $crc->foto7 = implode('|', $uploadedFiles);
    $crc->kaba_simetris = $request->kaba_simetris;
    $crc->kaba_asimetris = $request->kaba_asimetris;
    $crc->papan_pecah = $request->papan_pecah;
    $crc->papan_patah = $request->papan_patah;
    // Save the CRC record
    $crc->save();

    // Redirect based on user role
    if (Auth::user()->role == 0) {
        return redirect()->route('Form-Check.admin.eup')->with('success', 'Submission completed');
    } else {
        return redirect()->route('Form-Check.pegawai.eup')->with('success', 'Submission completed');
    }
}

public function destroy($id){
    $data = EupM::find($id);
    $data->delete();
    return redirect()->back()->with('success', 'Data berhasil Dihapus');
}

    public function show($id){
        $submission = EupM::find($id);
        return view('Form-Check.pages.eup.show',compact('submission'));
    }

    public function print($id){
        $submission = EupM::find($id);
        return view('Form-Check.pages.eup.print',compact('submission'));
    }

    // [TAG: EXPORT EUP] Export data EUP ke Excel sesuai filter
    public function export(Request $request){
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'desc');
        $data = $this->buildEupQuery($request)->orderBy($sort, $direction)->get();
        $date = now()->format('d-m-Y'); 
        return Excel::download(new EupExportExcel($data), $date . '_Eup.xlsx');
    }

}
    