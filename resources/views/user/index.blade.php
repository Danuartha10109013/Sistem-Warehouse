@extends('user.layout.V_template')
@section('title', 'Kelola User Superadmin')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    /* Select2 custom styling for Bootstrap 5 feel */
    .select2-container--default .select2-selection--single {
        height: calc(2.8rem + 2px) !important;
        padding: 0.4rem 0.75rem;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        background-color: #fff;
        display: flex;
        align-items: center;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 100%;
        right: 12px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #1e293b;
        font-weight: 500;
        padding-left: 0;
    }
    .select2-dropdown {
        border: 1px solid #dee2e6;
        border-radius: 6px;
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
        background-color: #135b9f;
        color: white;
    }
    .select2-results__option {
        padding: 10px 14px;
        font-weight: 500;
    }
</style>
@endpush
@section('content')
<div class="container-fluid p-0">
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px; background: linear-gradient(to right, #ffffff, #f8f9fa);">
        <div class="card-body p-4">
            <h4 class="fw-bolder mb-2" style="color: #1e293b; letter-spacing: -0.5px;">Kelola User Superadmin</h4>
            <div class="text-muted" style="font-size: 14px;">
                Home <span class="mx-1">/</span> Administrator <span class="mx-1">/</span> Kelola User
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary flex-fill flex-md-grow-0" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                <i class="fas fa-plus me-1"></i> Add User
                            </button>
                            <a href="{{route('superadmin.Administrator.kelola-user.print')}}" class="btn btn-warning text-white flex-fill flex-md-grow-0">
                                <i class="fas fa-print me-1"></i> Print
                            </a>
                        </div>
                        <div class="d-flex align-items-center w-100" style="max-width: 350px;">
                            <div class="input-group shadow-sm w-100">
                                <span class="input-group-text bg-primary text-white border-primary"><i class="fas fa-search"></i></span>
                                <input type="text" class="form-control custom-dt-search border-primary" placeholder="Cari Cepat...">
                            </div>
                        </div>
                    </div>
                    
                    <h4 class="card-title">Daftar Pegawai</h4>
                    <div class="table-responsive">
                        <table class="table" id="dataTable">
                            <thead>
                                <tr>
                                    <th> No </th>
                                    <th> User </th>
                                    <th> Email </th>
                                    <th> Divisi </th>
                                    <th> Action </th>
                                    <th> Date Joined </th>
                                    <th> Role </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        <img src="{{ $d->profile ? asset('storage/'.$d->profile) : 'https://ui-avatars.com/api/?name='.urlencode($d->name).'&background=135b9f&color=fff' }}" 
                                             onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name={{ urlencode($d->name) }}&background=135b9f&color=fff';"
                                             class="me-2 rounded-circle shadow-sm" alt="image" style="width: 35px; height: 35px; object-fit: cover;"> 
                                        <span class="fw-semibold">{{$d->name}}</span>
                                    </td>
                                    <td> {{$d->email}} </td>
                                    <td> {{$d->division}} </td>
                                    <td>
                                        <div class="action-icons">
                                            <button type="button" class="action-icon-btn" title="Edit" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $d->id }}" style="border: none; background: transparent; padding: 0;">
                                                <i class="ti ti-edit"></i>
                                            </button>
                                            <form action="{{ route('superadmin.Administrator.kelola-user.delete', $d->id) }}" method="POST" style="display: inline;" class="delete-user-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="action-icon-btn delete-button btn-delete-user" title="Hapus" data-name="{{ $d->name }}">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    <td> {{$d->created_at}}</td>
                                    <td> {{$d->role == 0 ? 'Admin' : 'Pegawai'}}</td>
                                </tr>

                                <!-- Modal for Edit User -->
                                <div class="modal fade" id="editUserModal{{ $d->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $d->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
                                            <form action="{{ route('superadmin.Administrator.kelola-user.update', $d->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header bg-light border-bottom-0 px-4 py-3">
                                                    <h5 class="modal-title fw-bold text-primary" id="editUserModalLabel{{ $d->id }}"><i class="fas fa-edit me-2"></i>Edit User</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body px-4 py-4">
                                                    <div class="row g-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold text-dark mb-1">Nama Lengkap</label>
                                                            <input type="text" name="name" class="form-control" value="{{ $d->name }}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold text-dark mb-1">Username</label>
                                                            <input type="text" name="username" class="form-control" value="{{ $d->username }}" required>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold text-dark mb-1">Email</label>
                                                            <input type="email" name="email" class="form-control" value="{{ $d->email }}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold text-dark mb-1">Divisi</label>
                                                            <select name="division" class="form-select edit-division" data-id="{{ $d->id }}" required>
                                                                <option value="" disabled>-- Pilih Divisi --</option>
                                                                @foreach (\App\Models\DivisionM::all() as $div)
                                                                <option value="{{ $div->division }}" {{ $d->division == $div->division ? 'selected' : '' }}>{{ $div->division }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold text-dark mb-1">Role</label>
                                                            <select name="role" class="form-select edit-role" data-id="{{ $d->id }}" required>
                                                                <option value="0" {{ $d->role == 0 ? 'selected' : '' }}>Admin</option>
                                                                <option value="1" {{ $d->role == 1 ? 'selected' : '' }}>Pegawai</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold text-dark mb-1">Foto Profil <small class="text-muted fw-normal">(Opsional)</small></label>
                                                            <input type="file" name="avatar" class="form-control">
                                                        </div>

                                                        <div class="col-12 mt-4">
                                                            <label class="form-label fw-semibold text-dark mb-2">Hak Akses Tipe Dokumen</label>
                                                            <div class="card bg-light border-0">
                                                                <div class="card-body p-3">
                                                                    <div class="row g-2">
                                                                        <div class="col-md-4">
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input shadow-sm edit-type-checkbox all-role" type="checkbox" name="type[]" value="SP" {{ in_array('SP', json_decode($d->type, true) ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label">Shipping Mark</label>
                                                                            </div>
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input shadow-sm edit-type-checkbox all-role" type="checkbox" name="type[]" value="MP" {{ in_array('MP', json_decode($d->type, true) ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label">Mapping</label>
                                                                            </div>
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input shadow-sm edit-type-checkbox all-role form-check-only" type="checkbox" name="type[]" value="FC" {{ in_array('FC', json_decode($d->type, true) ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label">Form Check</label>
                                                                            </div>
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input shadow-sm edit-type-checkbox all-role" type="checkbox" name="type[]" value="OP" {{ in_array('OP', json_decode($d->type, true) ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label">Open Packing</label>
                                                                            </div>
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input shadow-sm edit-type-checkbox all-role" type="checkbox" name="type[]" value="SB" {{ in_array('SB', json_decode($d->type, true) ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label">Supply Bahan</label>
                                                                            </div>
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input shadow-sm edit-type-checkbox all-role" type="checkbox" name="type[]" value="PL" {{ in_array('PL', json_decode($d->type, true) ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label">Packing List</label>
                                                                            </div>
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input shadow-sm edit-type-checkbox pegawai-only" type="checkbox" name="type[]" value="CK" {{ in_array('CK', json_decode($d->type, true) ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label">Checklist Kendaraan</label>
                                                                            </div>
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input shadow-sm edit-type-checkbox pegawai-only" type="checkbox" name="type[]" value="SL" {{ in_array('SL', json_decode($d->type, true) ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label">Scan Layout</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input shadow-sm edit-type-checkbox all-role pegawai-only" type="checkbox" name="type[]" value="CD" {{ in_array('CD', json_decode($d->type, true) ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label">Coil Damage</label>
                                                                            </div>
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input shadow-sm edit-type-checkbox all-role form-check-only" type="checkbox" name="type[]" value="SIK" {{ in_array('SIK', json_decode($d->type, true) ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label">Surat Izin Keluar</label>
                                                                            </div>
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input shadow-sm edit-type-checkbox all-role form-check-only" type="checkbox" name="type[]" value="SO" {{ in_array('SO', json_decode($d->type, true) ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label">Stock Opname</label>
                                                                            </div>
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input shadow-sm edit-type-checkbox all-role pegawai-only" type="checkbox" name="type[]" value="SKE" {{ in_array('SKE', json_decode($d->type, true) ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label">Scan Koil EUP</label>
                                                                            </div>
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input shadow-sm edit-type-checkbox all-role pegawai-only" type="checkbox" name="type[]" value="LP" {{ in_array('LP', json_decode($d->type, true) ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label">Laporan Packing</label>
                                                                            </div>
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input shadow-sm edit-type-checkbox all-role pegawai-only" type="checkbox" name="type[]" value="ID" {{ in_array('ID', json_decode($d->type, true) ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label">IDOD</label>
                                                                            </div>
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input shadow-sm edit-type-checkbox all-role pegawai-only" type="checkbox" name="type[]" value="SW" {{ in_array('SW', json_decode($d->type, true) ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label">Sidewall</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input shadow-sm edit-type-checkbox all-role pegawai-only" type="checkbox" name="type[]" value="LR" {{ in_array('LR', json_decode($d->type, true) ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label">Laporan Repacking</label>
                                                                            </div>
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input shadow-sm edit-type-checkbox all-role pegawai-only" type="checkbox" name="type[]" value="SJ" {{ in_array('SJ', json_decode($d->type, true) ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label">Surat Jalan</label>
                                                                            </div>
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input shadow-sm edit-type-checkbox all-role pegawai-only" type="checkbox" name="type[]" value="RP" {{ in_array('RP', json_decode($d->type, true) ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label">Rekap PRD</label>
                                                                            </div>
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input shadow-sm edit-type-checkbox all-role pegawai-only" type="checkbox" name="type[]" value="MPR" {{ in_array('MPR', json_decode($d->type, true) ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label">Master Product</label>
                                                                            </div>
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input shadow-sm edit-type-checkbox all-role pegawai-only" type="checkbox" name="type[]" value="ST" {{ in_array('ST', json_decode($d->type, true) ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label">Kelola Stock</label>
                                                                            </div>
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input shadow-sm edit-type-checkbox all-role pegawai-only" type="checkbox" name="type[]" value="MK" {{ in_array('MK', json_decode($d->type, true) ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label">Modul Kapasitas</label>
                                                                            </div>
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input shadow-sm edit-type-checkbox all-role pegawai-only" type="checkbox" name="type[]" value="VT" {{ in_array('VT', json_decode($d->type, true) ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label">Verifikasi Timbangan</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-12 mt-3">
                                                            <label class="form-label fw-semibold text-dark mb-1">Password Baru <small class="text-muted fw-normal">(Opsional)</small></label>
                                                            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer bg-light border-top-0 px-4 py-3">
                                                    <button type="button" class="btn btn-light px-4 border" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-2"></i>Update User</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>
                    <!-- Pagination handled by DataTables -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Adding User -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
            <form action="{{ route('superadmin.Administrator.kelola-user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-light border-bottom-0 px-4 py-3">
                    <h5 class="modal-title fw-bold text-primary" id="addUserModalLabel"><i class="fas fa-user-plus me-2"></i>Tambah User Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 py-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-semibold text-dark mb-1">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Masukkan nama" required>
                        </div>
                        <div class="col-md-6">
                            <label for="username" class="form-label fw-semibold text-dark mb-1">Username</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan username" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-semibold text-dark mb-1">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan email" required>
                        </div>
                        <div class="col-md-6">
                            <label for="division" class="form-label fw-semibold text-dark mb-1">Divisi</label>
                            <select name="division" id="division" class="form-select" required>
                                <option value="" selected disabled>-- Pilih Divisi --</option>
                                @php
                                    $division = \App\Models\DivisionM::all();
                                @endphp
                                @foreach ($division as $div)
                                <option value="{{$div->division}}">{{$div->division}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="role" class="form-label fw-semibold text-dark mb-1">Role</label>
                            <select name="role" id="role" class="form-select" required>
                                <option value="0">Admin</option>
                                <option value="1">Pegawai</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="profile" class="form-label fw-semibold text-dark mb-1">Foto Profil <small class="text-muted fw-normal">(Opsional)</small></label>
                            <input type="file" name="avatar" class="form-control" id="profile">
                        </div>

                        <div class="col-12 mt-4">
                            <label class="form-label fw-semibold text-dark mb-2">Hak Akses Tipe Dokumen</label>
                            <div class="card bg-light border-0">
                                <div class="card-body p-3" id="type">
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input shadow-sm type-checkbox all-role" type="checkbox" name="type[]" value="SP" id="typeSP">
                                                <label class="form-check-label" for="typeSP">Shipping Mark</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input shadow-sm type-checkbox all-role" type="checkbox" name="type[]" value="MP" id="typeMP">
                                                <label class="form-check-label" for="typeMP">Mapping</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input shadow-sm type-checkbox all-role form-check-only" type="checkbox" name="type[]" value="FC" id="typeFC">
                                                <label class="form-check-label" for="typeFC">Form Check</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input shadow-sm type-checkbox all-role" type="checkbox" name="type[]" value="OP" id="typeOP">
                                                <label class="form-check-label" for="typeOP">Open Packing</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input shadow-sm type-checkbox all-role" type="checkbox" name="type[]" value="SB" id="typeSB">
                                                <label class="form-check-label" for="typeSB">Supply Bahan</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input shadow-sm type-checkbox all-role" type="checkbox" name="type[]" value="PL" id="typePL">
                                                <label class="form-check-label" for="typePL">Packing List</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input shadow-sm type-checkbox pegawai-only" type="checkbox" name="type[]" value="CK" id="typeCK">
                                                <label class="form-check-label" for="typeCK">Checklist Kendaraan</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input shadow-sm type-checkbox pegawai-only" type="checkbox" name="type[]" value="SL" id="typeSL">
                                                <label class="form-check-label" for="typeSL">Scan Layout</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input shadow-sm type-checkbox all-role pegawai-only" type="checkbox" name="type[]" value="CD" id="typeCD">
                                                <label class="form-check-label" for="typeCD">Coil Damage</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input shadow-sm type-checkbox all-role form-check-only" type="checkbox" name="type[]" value="SIK" id="typeSIK">
                                                <label class="form-check-label" for="typeSIK">Surat Izin Keluar</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input shadow-sm type-checkbox all-role form-check-only" type="checkbox" name="type[]" value="SO" id="typeSO">
                                                <label class="form-check-label" for="typeSO">Stock Opname</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input shadow-sm type-checkbox all-role pegawai-only" type="checkbox" name="type[]" value="SKE" id="typeSKE">
                                                <label class="form-check-label" for="typeSKE">Scan Koil EUP</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input shadow-sm type-checkbox all-role pegawai-only" type="checkbox" name="type[]" value="LP" id="typeLP">
                                                <label class="form-check-label" for="typeLP">Laporan Packing</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input shadow-sm type-checkbox all-role pegawai-only" type="checkbox" name="type[]" value="ID" id="typeID">
                                                <label class="form-check-label" for="typeID">IDOD</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input shadow-sm type-checkbox all-role pegawai-only" type="checkbox" name="type[]" value="SW" id="typeSW">
                                                <label class="form-check-label" for="typeSW">Sidewall</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input shadow-sm type-checkbox all-role pegawai-only" type="checkbox" name="type[]" value="LR" id="typeLR">
                                                <label class="form-check-label" for="typeLR">Laporan Repacking</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input shadow-sm type-checkbox all-role pegawai-only" type="checkbox" name="type[]" value="SJ" id="typeSJ">
                                                <label class="form-check-label" for="typeSJ">Surat Jalan</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input shadow-sm type-checkbox all-role pegawai-only" type="checkbox" name="type[]" value="RP" id="typeRP">
                                                <label class="form-check-label" for="typeRP">Rekap PRD</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input shadow-sm type-checkbox all-role pegawai-only" type="checkbox" name="type[]" value="MPR" id="typeMPR">
                                                <label class="form-check-label" for="typeMPR">Master Product</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input shadow-sm type-checkbox all-role pegawai-only" type="checkbox" name="type[]" value="ST" id="typeST">
                                                <label class="form-check-label" for="typeST">Kelola Stock</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input shadow-sm type-checkbox all-role pegawai-only" type="checkbox" name="type[]" value="MK" id="typeMK">
                                                <label class="form-check-label" for="typeMK">Modul Kapasitas</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input shadow-sm type-checkbox all-role pegawai-only" type="checkbox" name="type[]" value="VT" id="typeVT">
                                                <label class="form-check-label" for="typeVT">Verifikasi Timbangan</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-info d-flex align-items-center mt-4 mb-0 py-2 border-0" role="alert">
                        <i class="fas fa-info-circle me-2 fs-5"></i>
                        <div>
                            Password otomatis akan diset: <strong>"Tatametal123"</strong>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top-0 px-4 py-3">
                    <button type="button" class="btn btn-light px-4 border" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-2"></i>Simpan User</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Select2 for Add Modal
        $('#division, #role').select2({
            dropdownParent: $('#addUserModal'),
            minimumResultsForSearch: Infinity,
            width: '100%'
        });
        
        // Memastikan fitur filter kita mendengarkan perubahan dari select2
        $('#role, #division').on('select2:select', function (e) {
            this.dispatchEvent(new Event('change'));
        });

        // Initialize Select2 for all Edit Modals when they are shown
        $('.modal').on('shown.bs.modal', function () {
            $(this).find('.edit-division, .edit-role').select2({
                dropdownParent: $(this),
                minimumResultsForSearch: Infinity,
                width: '100%'
            }).on('select2:select', function (e) {
                this.dispatchEvent(new Event('change', { bubbles: true }));
            });
            
            // Trigger filter visibility for edit modal on load
            const roleSelect = this.querySelector('.edit-role');
            if (roleSelect) {
                roleSelect.dispatchEvent(new Event('change', { bubbles: true }));
            }
        });
    });
</script>
<script>
    // Logic dinamis khusus untuk Edit Modal menggunakan Event Delegation
    document.addEventListener("change", function(e) {
        if (e.target.classList.contains('edit-role') || e.target.classList.contains('edit-division')) {
            const modal = e.target.closest('.modal');
            if (!modal) return;
            
            const roleSelect = modal.querySelector('.edit-role');
            const divisionSelect = modal.querySelector('.edit-division');
            if (!roleSelect || !divisionSelect) return;
            
            const roleValue = roleSelect.value;
            const divisionValue = divisionSelect.value;
            
            // Sembunyikan semua
            modal.querySelectorAll(".edit-type-checkbox").forEach(el => {
                el.closest('.form-check').style.display = 'none';
            });
            
            // Tampilkan selalu form-check-only
            modal.querySelectorAll(".form-check-only").forEach(el => {
                el.closest('.form-check').style.display = 'block';
            });
            
            if (divisionValue === 'Produksi') return;
            
            if (divisionValue === 'Warehouse' || divisionValue === '') {
                if (roleValue === '0') {
                    modal.querySelectorAll(".all-role").forEach(el => {
                        el.closest('.form-check').style.display = 'block';
                    });
                } else if (roleValue === '1') {
                    modal.querySelectorAll(".pegawai-only").forEach(el => {
                        el.closest('.form-check').style.display = 'block';
                    });
                }
            } else {
                modal.querySelectorAll(".all-role, .pegawai-only").forEach(el => {
                    el.closest('.form-check').style.display = 'block';
                });
            }
        }
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const roleSelect = document.getElementById("role");
        const divisionSelect = document.getElementById("division");

        function updateTypeVisibility() {
            if (!roleSelect || !divisionSelect) return;
            const roleValue = roleSelect.value;
            const divisionValue = divisionSelect.value;

            // Sembunyikan semua type terlebih dahulu
            const allTypes = document.querySelectorAll("#addUserModal .type-checkbox");
            allTypes.forEach(el => {
                el.closest('.form-check').style.display = 'none';
                el.checked = false; // Reset checked status when hidden
            });

            // Tampilkan selalu Form Check (FC), SIK, SO di semua kondisi (tergantung class form-check-only)
            document.querySelectorAll("#addUserModal .form-check-only").forEach(el => {
                el.closest('.form-check').style.display = 'block';
            });

            if (divisionValue === 'Produksi') {
                return;
            }

            if (divisionValue === 'Warehouse' || divisionValue === '') {
                if (roleValue === '0') {
                    // Admin: tampilkan semua
                    document.querySelectorAll("#addUserModal .all-role").forEach(el => {
                        el.closest('.form-check').style.display = 'block';
                    });
                } else if (roleValue === '1') {
                    // Pegawai: tampilkan pegawai-only + form-check-only
                    document.querySelectorAll("#addUserModal .pegawai-only").forEach(el => {
                        el.closest('.form-check').style.display = 'block';
                    });
                }
            } else {
                // Divisi lain-lain: tampilkan all-role dan pegawai-only
                document.querySelectorAll("#addUserModal .all-role, #addUserModal .pegawai-only").forEach(el => {
                    el.closest('.form-check').style.display = 'block';
                });
            }
        }

        updateTypeVisibility();
        roleSelect.addEventListener("change", updateTypeVisibility);
        divisionSelect.addEventListener("change", updateTypeVisibility);
    });
</script>
<script>
    $(document).ready(function() {
        // Use event delegation for DataTables compatibility
        $('#dataTable').on('click', '.btn-delete-user', function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            var userName = $(this).data('name');
            
            window.showCustomConfirm({
                iconClass: 'fas fa-trash-alt',
                title: 'Hapus User?',
                text: 'Data user <strong style="color: #1e293b;">' + userName + '</strong> akan dihapus permanen.',
                confirmText: 'Ya, Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush

@endsection