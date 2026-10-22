<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Login endpoint untuk Mobile App (Flutter).
     * Membatasi hanya role Admin (0) dan Pegawai (1) yang aktif dan punya hak akses.
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login'    => 'required_without:username|string',
            'username' => 'required_without:login|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Input tidak valid',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $login = $request->input('login') ?? $request->input('username');
        $user = User::where('email', $login)
            ->orWhere('username', $login)
            ->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau username tidak ditemukan.',
            ], 404);
        }

        // Cek status keaktifan user (1 = aktif, 2 = tidak aktif)
        if ($user->status == 2) {
            return response()->json([
                'success' => false,
                'message' => 'Akun Anda berstatus non-aktif. Hubungi administrator.',
            ], 403);
        }

        // Batasi role: hanya Admin (0), Pegawai (1), atau Super Admin (5)
        if (!in_array($user->role, [0, 1, 5])) {
            return response()->json([
                'success' => false,
                'message' => 'Role akun Anda tidak memiliki akses ke aplikasi mobile.',
            ], 403);
        }

        // Cek kecocokan password
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password yang dimasukkan salah.',
            ], 401);
        }

        // Cek hak akses modul (kolom type)
        $rawType = json_decode($user->type, true);
        $userPermissions = is_array($rawType) ? $rawType : (empty($user->type) ? [] : [$user->type]);

        // Cek apakah punya akses PL2 (atau 'all' atau admin)
        $hasPL2 = in_array('all', $userPermissions) || in_array('PL2', $userPermissions) || $user->role == 0 || $user->role == 5;

        if (!$hasPL2) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki hak akses untuk modul Packing List 2.0.',
            ], 403);
        }

        // Buat Sanctum token untuk sesi mobile
        $token = $user->createToken('flutter-mobile-app')->plainTextToken;

        // Label role yang ramah pembaca
        $roleLabel = match ((int) $user->role) {
            0 => 'Admin',
            5 => 'Super Admin',
            default => 'Pegawai',
        };

        // Modul dinamis untuk mobile: saat ini HANYA modul PL2 yang dimunculkan
        $activeModules = [];
        if ($hasPL2) {
            $activeModules[] = [
                'code'        => 'PL2',
                'name'        => 'Packing List 2.0',
                'description' => 'Validasi & Scanner Koil Lapangan',
                'icon'        => 'format_list_bulleted',
                'is_active'   => true,
            ];
        }

        // Catat aktivitas login
        \App\Services\LogActivity::record(
            action: 'LOGIN_MOBILE',
            module: 'Mobile API',
            description: "User {$user->name} ({$roleLabel}) berhasil login dari aplikasi Flutter"
        );

        return response()->json([
            'status'  => true,
            'success' => true,
            'message' => 'Login berhasil.',
            'token'   => $token,
            'user'    => [
                'id'         => $user->id,
                'name'       => $user->name,
                'username'   => $user->username,
                'email'      => $user->email,
                'role'       => (int) $user->role,
                'role_label' => $roleLabel,
                'division'   => $user->division,
            ],
            'active_modules' => $activeModules,
        ]);
    }

    /**
     * Profil user saat ini dan daftar modul yang dapat diakses.
     */
    public function me(Request $request)
    {
        $user = $request->user();

        $roleLabel = match ((int) $user->role) {
            0 => 'Admin',
            5 => 'Super Admin',
            default => 'Pegawai',
        };

        $rawType = json_decode($user->type, true);
        $userPermissions = is_array($rawType) ? $rawType : (empty($user->type) ? [] : [$user->type]);
        $hasPL2 = in_array('all', $userPermissions) || in_array('PL2', $userPermissions) || $user->role == 0 || $user->role == 5;

        $activeModules = [];
        if ($hasPL2) {
            $activeModules[] = [
                'code'        => 'PL2',
                'name'        => 'Packing List 2.0',
                'description' => 'Validasi & Scanner Koil Lapangan',
                'icon'        => 'format_list_bulleted',
                'is_active'   => true,
            ];
        }

        return response()->json([
            'success' => true,
            'user'    => [
                'id'         => $user->id,
                'name'       => $user->name,
                'username'   => $user->username,
                'email'      => $user->email,
                'role'       => (int) $user->role,
                'role_label' => $roleLabel,
                'division'   => $user->division,
            ],
            'active_modules' => $activeModules,
        ]);
    }

    /**
     * Logout dan cabut token mobile.
     */
    public function logout(Request $request)
    {
        $user = $request->user();
        if ($user && $user->currentAccessToken()) {
            $user->currentAccessToken()->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil logout dari aplikasi mobile.',
        ]);
    }
}
