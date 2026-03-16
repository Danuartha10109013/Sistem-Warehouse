<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengecekan extends Model
{
    use HasFactory;
    protected $table = 'pengecekan';

        protected $fillable = [
            'pembeda',
            'awal_muat',
            'awal_muat1',
            'kota_negara',
            'ekspedisi',
            'lantai',
            'dinding',
            'pengunci_kontainer',
            'sapu',
            'vacum',
            'disemprot',
            'choke',
            'stopper',
            'silica_gel',
            'sling',
            'fumigasi',
            'selesai_muat',
            'cuaca',
            'kondisi_ban',
            'kondisi_lantai',
            'rangka',
            'radiasi',
            'rantai_webbing',
            'tonase',
            'terpal',
            'pegawai',
            'customer',
            'tare',
            'catatan',
            'tgl_gs',
            'no_mobil',
            'no_container',
            'tonase_tare',
            'checker',
            'signature',
            'signature1',
        ];
    
    // Digunakan di form pengecekan untuk menentukan
    // apakah tombol "Cetak" boleh dimunculkan
    public function isComplete(): bool
    {
        $requiredFields = [
            'awal_muat',
            'awal_muat1',
            'tgl_gs',
            'kota_negara',
            'customer',
            'lantai',
            'dinding',
            'pengunci_kontainer',
            'sapu',
            'vacum',
            'disemprot',
            'choke',
            'stopper',
            'sling',
            'silica_gel',
            'fumigasi',
            'selesai_muat',
            'cuaca',
            'kondisi_ban',
            'kondisi_lantai',
            'rangka',
            'radiasi',
            'rantai_webbing',
            'tonase',
            'terpal',
            'no_mobil',
            'no_container',
            'tonase_tare',
            'checker',
            'signature',
            'signature1',
        ];

        foreach ($requiredFields as $field) {
            $value = $this->{$field} ?? null;
            if ($value === null || $value === '') {
                return false;
            }
        }

        return true;
    }

}
