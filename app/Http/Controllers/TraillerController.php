<?php

namespace App\Http\Controllers;

use App\Exports\TraillerExportExcel;
use App\Models\TraillerM;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TraillerController extends Controller
{
    // [TAG: QUERY FILTER TRAILLER] Query dasar dengan pencarian dan filter tanggal inklusif
    private function buildTraillerQuery(Request $request)
    {
        $searchTerm = $request->input('search');
        $start = $request->get('start', null);
        $end = $request->get('end', null);

        $query = TraillerM::query();

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

    // [TAG: HALAMAN UTAMA] Menampilkan data respon trailer
    public function index(Request $request) {
        $searchTerm = $request->input('search');
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'desc');
        $start = $request->get('start', null);
        $end = $request->get('end', null);

        $query = $this->buildTraillerQuery($request);
        $data = $query->orderBy($sort, $direction)->paginate(10)->withQueryString();

        return view('Form-Check.pages.trailler.index', compact('data', 'searchTerm', 'sort', 'direction','start','end'));
    }


    public function add (){
        return view('Form-Check.pages.trailler.add');
    }
    public function create(Request $request)
{
    // dd($request->all());
    $validatedData = $request->validate([
        'user_id' => 'required|exists:users,id',
        'shift_leader' => 'nullable|string',
        'mtc' => 'nullable|string',
        'jenis_forklift' => 'nullable|string',
        'date' => 'nullable|date',
        'carrier' => 'nullable|string',
        'rantai' => 'nullable|string',
        'ban' => 'nullable|string',
        'cadangan' => 'nullable|string',
        'sein' => 'nullable|string',
        'rotating' => 'nullable|string',
        'stop' => 'nullable|string',
        'utama' => 'nullable|string',
        'kota' => 'nullable|string',
        'connector' => 'nullable|string',
        'accu' => 'nullable|string',
        'coolant' => 'nullable|string',
        'parking' => 'nullable|string',
        'brake' => 'nullable|string',
        'horn' => 'nullable|string',
        'mundur' => 'nullable|string',
        'clamp' => 'nullable|string',
        'terpal' => 'nullable|string',
        'rantai_pe' => 'nullable|string',
        'ganjal' => 'nullable|string',
        'pallet' => 'nullable|string',
        'apar' => 'nullable|string',
        'p3k' => 'nullable|string',
        'fancing' => 'nullable|string',
        'triangle' => 'nullable|string',
        'tools' => 'nullable|string',
        'catatan' => 'nullable|string',

        // Nullable ket fields
        'ket_carrier' => 'nullable|string',
        'ket_rantai' => 'nullable|string',
        'ket_ban' => 'nullable|string',
        'ket_cadangan' => 'nullable|string',
        'ket_sein' => 'nullable|string',
        'ket_rotating' => 'nullable|string',
        'ket_stop' => 'nullable|string',
        'ket_utama' => 'nullable|string',
        'ket_kota' => 'nullable|string',
        'ket_connector' => 'nullable|string',
        'ket_accu' => 'nullable|string',
        'ket_coolant' => 'nullable|string',
        'ket_parking' => 'nullable|string',
        'ket_brake' => 'nullable|string',
        'ket_horn' => 'nullable|string',
        'ket_mundur' => 'nullable|string',
        'ket_clamp' => 'nullable|string',
        'ket_terpal' => 'nullable|string',
        'ket_rantai_pe' => 'nullable|string',
        'ket_ganjal' => 'nullable|string',
        'ket_pallet' => 'nullable|string',
        'ket_apar' => 'nullable|string',
        'ket_p3k' => 'nullable|string',
        'ket_fancing' => 'nullable|string',
        'ket_triangle' => 'nullable|string',
        'ket_tools' => 'nullable|string',
        'other_sift_leader' => 'nullable|string|max:255', // Add validation for other shift leader input
    ]);

    $validatedData['shift_leader'] = $request->shift_leader == 'other' ? $request->other_sift_leader : $request->shift_leader;
    $validatedData['mtc_name']= $request->mtc;

    TraillerM::create($validatedData);

    if(Auth::user()->role == 0){

        return redirect()->route('Form-Check.admin.trailler')->with('success', 'Trailler record saved successfully.');
    }else{
        return redirect()->route('Form-Check.pegawai.trailler')->with('success', 'Trailler record saved successfully.');
    }
}

    public function print($id){
        $data = TraillerM::FindOrFail($id);
        return view('Form-Check.pages.trailler.print',compact('data'));
    }
    public function show($id){
        $data = TraillerM::FindOrFail($id);
        return view('Form-Check.pages.trailler.show',compact('data'));
    }

    // [TAG: EXPORT TRAILLER] Export data Trailer ke Excel sesuai filter
    public function export(Request $request){
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'desc');
        $data = $this->buildTraillerQuery($request)->orderBy($sort, $direction)->get();
        $date = now()->format('d-m-Y');

        return Excel::download(new TraillerExportExcel($data), $date.'_Trailler.xlsx');
    }

    public function destroy($id){
        $data = TraillerM::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Data berhasil Dihapus');
    }

}
