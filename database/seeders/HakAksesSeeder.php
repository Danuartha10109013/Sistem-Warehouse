<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HakAksesSeeder extends Seeder
{
    public function run()
    {
        // Fitur yang wajib terceklis (kode singkatan)
        $wajib = ['FC', 'SL', 'CD', 'SIK', 'LP', 'ID', 'SW', 'MK'];

        // Ambil semua user KECUALI id 1 (superadmin) dan id 14 (danuartha)
        $users = DB::table('users')->whereNotIn('id', [1, 14])->get();

        foreach ($users as $user) {
            // Decode json lama. Jika kosong, buat array kosong
            $typeLama = json_decode($user->type, true) ?? [];
            
            // Jika string "null" atau tidak valid, paksa jadi array
            if (!is_array($typeLama)) {
                $typeLama = [];
            }

            // Gabung yang lama dengan yang wajib
            $typeBaru = array_merge($typeLama, $wajib);

            // Hilangkan duplikat dan index ulang
            $typeBaru = array_values(array_unique($typeBaru));

            // Simpan ke database
            DB::table('users')
                ->where('id', $user->id)
                ->update(['type' => json_encode($typeBaru)]);
        }
    }
}
