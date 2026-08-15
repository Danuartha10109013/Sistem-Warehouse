<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\CrcM;
use App\Models\M_OpenPackInspection;
use App\Models\M_OpenPackInspectionPhoto;
use Carbon\Carbon;

class FormReportOpenPack extends Component
{
    use WithFileUploads;

    public $searchQuery = '';
    public $suggestions = [];

    public $selectedAttribute = '';
    public $nomor_surat_jalan = '';
    public $nomor_coil_supplier = '';
    public $nama_supplier = '';
    public $tanggal_kedatangan = '';
    public $tanggal_open_pack = '';
    public $crc_id = null;

    public $grup = '';

    public $kondisi_awal = '';
    public $ada_temuan_awal = false;

    public $kondisi_setelah_open_pack = '';
    public $ada_temuan_setelah = false;

    public $keterangan = '';


    public $photo_awal_ws;
    public $photo_awal_ds;

    public $photo_temuan_awal_damaged;
    public $photo_temuan_awal_evidence;

    public $photo_ng_sidewall_ws;
    public $photo_ng_sidewall_ds;
    public $photo_ng_bawah;
    public $photo_ng_surface;

    public $photo_defect_sidewall_damaged;
    public $photo_defect_sidewall_evidence;

    public $photo_defect_id_od_damaged;
    public $photo_defect_id_od_evidence;

    public $photo_defect_karat_damaged;
    public $photo_defect_karat_evidence;

    public function mount()
    {
        $this->tanggal_open_pack = Carbon::now()->format('Y-m-d');
    }

    public function updatedSearchQuery()
    {
        if (strlen($this->searchQuery) < 2) {
            $this->suggestions = [];
            return;
        }

        // We search through checklist_data which is a JSON array
        $query = CrcM::whereNotNull('checklist_data')
            ->where('checklist_data', 'like', '%' . $this->searchQuery . '%')
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();

        $matched = [];
        foreach ($query as $row) {
            if (!$row->checklist_data)
                continue;
            $items = json_decode($row->checklist_data, true);
            if (!is_array($items))
                continue;

            foreach ($items as $item) {
                if (isset($item['attribute']) && stripos($item['attribute'], $this->searchQuery) !== false) {
                    $matched[] = [
                        'crc_id' => $row->id,
                        'attribute' => $item['attribute'],
                        'nomor_coil_supplier' => $item['supplier_lot_no'] ?? '',
                        'tanggal_kedatangan' => $row->date,
                        'nomor_surat_jalan' => $row->shift_leader,
                        'nama_supplier' => trim(str_replace(['[', ']', '"'], '', $row->supplier))
                    ];
                }
            }
        }

        $this->suggestions = array_slice($matched, 0, 10);
    }

    public function handleEnter()
    {
        $this->updatedSearchQuery();
        
        if (empty($this->searchQuery) || empty($this->suggestions)) {
            $this->dispatch('scan-not-found', message: 'Attribute / Coil ID tidak ditemukan!');
            $this->searchQuery = '';
            $this->suggestions = [];
            return;
        }

        foreach ($this->suggestions as $index => $sug) {
            // Jika ada yang persis sama dengan scan barcode
            if (strcasecmp($sug['attribute'], trim($this->searchQuery)) === 0) {
                $this->selectAttribute($index);
                return;
            }
        }

        // Jika hanya 1 suggestion, langsung pilih
        if (count($this->suggestions) === 1) {
            $this->selectAttribute(0);
        } else {
            // Jika lebih dari 1 dan tidak ada match persis, kosongkan agar tidak membingungkan
            // (atau biarkan list suggestion terbuka)
            $this->searchQuery = '';
            $this->suggestions = [];
        }
    }

    public function selectAttribute($index)
    {
        $item = $this->suggestions[$index];
        $this->selectedAttribute = $item['attribute'];
        $this->searchQuery = $item['attribute'];

        $this->crc_id = $item['crc_id'];
        $this->nomor_coil_supplier = $item['nomor_coil_supplier'];
        $this->tanggal_kedatangan = $item['tanggal_kedatangan'];
        $this->nomor_surat_jalan = $item['nomor_surat_jalan'];
        $this->nama_supplier = $item['nama_supplier'];

        $this->suggestions = [];
    }

    public function removeSelectedAttribute()
    {
        $this->selectedAttribute = '';
        $this->searchQuery = '';
        $this->crc_id = null;
        $this->nomor_coil_supplier = '';
        $this->tanggal_kedatangan = '';
        $this->nomor_surat_jalan = '';
        $this->nama_supplier = '';
    }

    public function save()
    {
        $this->validate([
            'selectedAttribute' => 'required',
            'grup' => 'required|in:A,B,C,D',
            'kondisi_awal' => 'required|in:OK,NOT_GOOD',
            'kondisi_setelah_open_pack' => 'required|in:OK,NOT_GOOD',
        ]);

        if ($this->kondisi_awal === 'NOT_GOOD') {
            $this->validate([
                'photo_awal_ws' => 'required|image|max:5120',
                'photo_awal_ds' => 'required|image|max:5120',
            ]);
        }

        if ($this->kondisi_setelah_open_pack === 'NOT_GOOD') {
            $this->validate([
                'photo_ng_sidewall_ws' => 'required|image|max:5120',
                'photo_ng_sidewall_ds' => 'required|image|max:5120',
                'photo_ng_bawah' => 'required|image|max:5120',
                'photo_ng_surface' => 'required|image|max:5120',
            ]);
        }

        $inspection = M_OpenPackInspection::create([
            'crc_id' => $this->crc_id,
            'attribute' => $this->selectedAttribute,
            'nomor_coil_supplier' => $this->nomor_coil_supplier,
            'tanggal_kedatangan' => $this->tanggal_kedatangan,
            'nomor_surat_jalan' => $this->nomor_surat_jalan,
            'nama_supplier' => $this->nama_supplier,
            'tanggal_open_pack' => $this->tanggal_open_pack,
            'grup' => $this->grup,
            'kondisi_awal' => $this->kondisi_awal,
            'kondisi_setelah_open_pack' => $this->kondisi_setelah_open_pack,
            'keterangan' => $this->keterangan,
        ]);

        // Helper to save photo
        $savePhoto = function ($property, $key) use ($inspection) {
            if ($this->$property) {
                $filename = time() . '_' . $key . '.' . $this->$property->extension();
                // Store in public/storage/open_pack_photos
                $path = $this->$property->storeAs('open_pack_photos', $filename, 'public');
                M_OpenPackInspectionPhoto::create([
                    'open_pack_inspection_id' => $inspection->id,
                    'slot_key' => $key,
                    'file_path' => 'storage/' . $path
                ]);
            }
        };

        if ($this->kondisi_awal === 'NOT_GOOD') {
            $savePhoto('photo_awal_ws', 'awal_ws');
            $savePhoto('photo_awal_ds', 'awal_ds');
        }
        if ($this->ada_temuan_awal) {
            $savePhoto('photo_temuan_awal_damaged', 'temuan_awal_damaged');
            $savePhoto('photo_temuan_awal_evidence', 'temuan_awal_evidence');
        }
        if ($this->kondisi_setelah_open_pack === 'NOT_GOOD') {
            $savePhoto('photo_ng_sidewall_ws', 'ng_sidewall_ws');
            $savePhoto('photo_ng_sidewall_ds', 'ng_sidewall_ds');
            $savePhoto('photo_ng_bawah', 'ng_bawah');
            $savePhoto('photo_ng_surface', 'ng_surface');
        }
        if ($this->ada_temuan_setelah) {
            $savePhoto('photo_defect_sidewall_damaged', 'defect_sidewall_damaged');
            $savePhoto('photo_defect_sidewall_evidence', 'defect_sidewall_evidence');
            $savePhoto('photo_defect_id_od_damaged', 'defect_id_od_damaged');
            $savePhoto('photo_defect_id_od_evidence', 'defect_id_od_evidence');
            $savePhoto('photo_defect_karat_damaged', 'defect_karat_damaged');
            $savePhoto('photo_defect_karat_evidence', 'defect_karat_evidence');
        }

        session()->flash('message', 'Data Report Open Pack berhasil disimpan.');
        return redirect()->route('report-open-pack');
    }

    public function render()
    {
        return view('livewire.form-report-open-pack');
    }
}
