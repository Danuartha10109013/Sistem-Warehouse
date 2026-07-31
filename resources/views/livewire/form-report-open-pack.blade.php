<div>
    @if (session()->has('message'))
        <div class="alert alert-success mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save">
        
        <!-- SECTION A: INFORMASI UMUM -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold" style="color: #03487c;">Informasi Umum</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Attribute / Coil ID</label>
                        <div class="position-relative">
                            @if($selectedAttribute)
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light" value="{{ $selectedAttribute }}" readonly>
                                    <button type="button" class="btn btn-outline-danger" wire:click="removeSelectedAttribute">Batal</button>
                                </div>
                            @else
                                <input type="text" class="form-control" wire:model.live.debounce.300ms="searchQuery" placeholder="Cari Attribute (min 2 huruf)...">
                                @if(!empty($suggestions))
                                    <ul class="list-group position-absolute w-100 mt-1 shadow" style="z-index: 1000; max-height: 200px; overflow-y: auto;">
                                        @foreach($suggestions as $index => $sug)
                                            <li class="list-group-item list-group-item-action cursor-pointer" wire:click="selectAttribute({{ $index }})">
                                                <strong>{{ $sug['attribute'] }}</strong> - {{ $sug['nama_supplier'] }}<br>
                                                <small class="text-muted">SJ: {{ $sug['nomor_surat_jalan'] }} | Tgl: {{ $sug['tanggal_kedatangan'] }}</small>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            @endif
                        </div>
                        @error('selectedAttribute') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Supplier</label>
                        <input type="text" class="form-control bg-light" wire:model="nama_supplier" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nomor Coil Supplier</label>
                        <input type="text" class="form-control bg-light" wire:model="nomor_coil_supplier" readonly>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nomor Surat Jalan</label>
                        <input type="text" class="form-control bg-light" wire:model="nomor_surat_jalan" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tanggal Kedatangan</label>
                        <input type="date" class="form-control bg-light" wire:model="tanggal_kedatangan" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tanggal Open Pack</label>
                        <input type="date" class="form-control bg-light" wire:model="tanggal_open_pack" readonly>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label fw-bold">Grup</label>
                        <div class="row g-3" role="group" aria-label="Pilih Grup">
                            <div class="col-6 col-sm-3">
                                <input type="radio" class="btn-check" wire:model="grup" value="A" id="grupA" autocomplete="off">
                                <label class="btn btn-outline-primary fw-bold w-100" for="grupA">A</label>
                            </div>
                            <div class="col-6 col-sm-3">
                                <input type="radio" class="btn-check" wire:model="grup" value="B" id="grupB" autocomplete="off">
                                <label class="btn btn-outline-primary fw-bold w-100" for="grupB">B</label>
                            </div>
                            <div class="col-6 col-sm-3">
                                <input type="radio" class="btn-check" wire:model="grup" value="C" id="grupC" autocomplete="off">
                                <label class="btn btn-outline-primary fw-bold w-100" for="grupC">C</label>
                            </div>
                            <div class="col-6 col-sm-3">
                                <input type="radio" class="btn-check" wire:model="grup" value="D" id="grupD" autocomplete="off">
                                <label class="btn btn-outline-primary fw-bold w-100" for="grupD">D</label>
                            </div>
                        </div>
                        @error('grup') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION B: KONDISI AWAL -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold" style="color: #03487c;">Kondisi Awal (CRC Sebelum Open Pack)</h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <label class="form-label fw-bold">Kondisi Packing</label>
                    <div class="d-flex gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" wire:model.live="kondisi_awal" value="OK" id="awalOK">
                            <label class="form-check-label text-success fw-bold" for="awalOK">OK <small class="text-muted fw-normal">(Packing tidak sobek, ID/OD tidak penyok)</small></label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" wire:model.live="kondisi_awal" value="NOT_GOOD" id="awalNG">
                            <label class="form-check-label text-danger fw-bold" for="awalNG">NOT GOOD <small class="text-muted fw-normal">(Packing sobek / ID OD penyok)</small></label>
                        </div>
                    </div>
                    @error('kondisi_awal') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                @if($kondisi_awal === 'NOT_GOOD')
                    <div class="p-3 bg-light border rounded mb-3">
                        <h6 class="fw-bold mb-3 text-danger"><i class="bi bi-camera"></i> Wajib: Dokumentasi CRC Sebelum Open Pack</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Foto WS (Wajib)</label>
                                <input type="file" class="form-control" wire:model="photo_awal_ws" accept="image/*" capture="environment">
                                @if ($photo_awal_ws) <img src="{{ $photo_awal_ws->temporaryUrl() }}" class="img-thumbnail mt-2" style="max-height: 150px"> @endif
                                @error('photo_awal_ws') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Foto DS (Wajib)</label>
                                <input type="file" class="form-control" wire:model="photo_awal_ds" accept="image/*" capture="environment">
                                @if ($photo_awal_ds) <img src="{{ $photo_awal_ds->temporaryUrl() }}" class="img-thumbnail mt-2" style="max-height: 150px"> @endif
                                @error('photo_awal_ds') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                @endif

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" role="switch" wire:model.live="ada_temuan_awal" id="switchTemuanAwal">
                    <label class="form-check-label fw-bold text-warning" for="switchTemuanAwal">Terdapat Temuan Ketidaksesuaian?</label>
                </div>

                @if($ada_temuan_awal)
                    <div class="p-3 border border-warning rounded bg-opacity-10 bg-warning">
                        <h6 class="fw-bold mb-3">Dokumentasi Temuan (Opsional)</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Foto Damaged</label>
                                <input type="file" class="form-control" wire:model="photo_temuan_awal_damaged" accept="image/*" capture="environment">
                                @if ($photo_temuan_awal_damaged) <img src="{{ $photo_temuan_awal_damaged->temporaryUrl() }}" class="img-thumbnail mt-2" style="max-height: 150px"> @endif
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Foto Evidence Supplier</label>
                                <input type="file" class="form-control" wire:model="photo_temuan_awal_evidence" accept="image/*">
                                @if ($photo_temuan_awal_evidence) <img src="{{ $photo_temuan_awal_evidence->temporaryUrl() }}" class="img-thumbnail mt-2" style="max-height: 150px"> @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- SECTION C: KONDISI SETELAH OPEN PACK -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold" style="color: #03487c;">Kondisi Setelah Open Pack</h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <label class="form-label fw-bold">Kondisi Aktual</label>
                    <div class="d-flex gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" wire:model.live="kondisi_setelah_open_pack" value="OK" id="setelahOK">
                            <label class="form-check-label text-success fw-bold" for="setelahOK">OK <small class="text-muted fw-normal">(Tidak ada sobek, penyok, atau karat)</small></label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" wire:model.live="kondisi_setelah_open_pack" value="NOT_GOOD" id="setelahNG">
                            <label class="form-check-label text-danger fw-bold" for="setelahNG">NOT GOOD <small class="text-muted fw-normal">(Sidewall sobek, ID/OD damaged, surface karat)</small></label>
                        </div>
                    </div>
                    @error('kondisi_setelah_open_pack') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                @if($kondisi_setelah_open_pack === 'NOT_GOOD')
                    <div class="p-3 bg-light border rounded mb-3">
                        <h6 class="fw-bold mb-3 text-danger"><i class="bi bi-camera"></i> Kriteria Dokumentasi (Wajib jika NG)</h6>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label small">Sidewall WS <br>(VCI masih di bawah)</label>
                                <input type="file" class="form-control form-control-sm" wire:model="photo_ng_sidewall_ws" accept="image/*" capture="environment">
                                @if ($photo_ng_sidewall_ws) <img src="{{ $photo_ng_sidewall_ws->temporaryUrl() }}" class="img-thumbnail mt-1" style="max-height: 100px"> @endif
                                @error('photo_ng_sidewall_ws') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small">Sidewall DS <br>(VCI masih di bawah)</label>
                                <input type="file" class="form-control form-control-sm" wire:model="photo_ng_sidewall_ds" accept="image/*" capture="environment">
                                @if ($photo_ng_sidewall_ds) <img src="{{ $photo_ng_sidewall_ds->temporaryUrl() }}" class="img-thumbnail mt-1" style="max-height: 100px"> @endif
                                @error('photo_ng_sidewall_ds') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small">Bagian Bawah CRC <br>(Potensi dent palet)</label>
                                <input type="file" class="form-control form-control-sm" wire:model="photo_ng_bawah" accept="image/*" capture="environment">
                                @if ($photo_ng_bawah) <img src="{{ $photo_ng_bawah->temporaryUrl() }}" class="img-thumbnail mt-1" style="max-height: 100px"> @endif
                                @error('photo_ng_bawah') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small">Surface Depan & Belakang <br>(Cek Karat)</label>
                                <input type="file" class="form-control form-control-sm" wire:model="photo_ng_surface" accept="image/*" capture="environment">
                                @if ($photo_ng_surface) <img src="{{ $photo_ng_surface->temporaryUrl() }}" class="img-thumbnail mt-1" style="max-height: 100px"> @endif
                                @error('photo_ng_surface') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                @endif

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" role="switch" wire:model.live="ada_temuan_setelah" id="switchTemuanSetelah">
                    <label class="form-check-label fw-bold text-warning" for="switchTemuanSetelah">Terdapat Temuan Defect / Ketidaksesuaian?</label>
                </div>

                @if($ada_temuan_setelah)
                    <div class="p-3 border border-warning rounded bg-opacity-10 bg-warning">
                        <h6 class="fw-bold mb-3">Rincian Temuan Defect (Opsional)</h6>
                        
                        <div class="row g-3 mb-3 border-bottom pb-3">
                            <p class="mb-1 fw-bold small text-muted">1. Defect Sidewall</p>
                            <div class="col-md-6">
                                <label class="form-label small">Dokumentasi Damaged</label>
                                <input type="file" class="form-control form-control-sm" wire:model="photo_defect_sidewall_damaged" accept="image/*" capture="environment">
                                @if ($photo_defect_sidewall_damaged) <img src="{{ $photo_defect_sidewall_damaged->temporaryUrl() }}" class="img-thumbnail mt-1" style="max-height: 100px"> @endif
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">Evidence VCI Supplier</label>
                                <input type="file" class="form-control form-control-sm" wire:model="photo_defect_sidewall_evidence" accept="image/*">
                                @if ($photo_defect_sidewall_evidence) <img src="{{ $photo_defect_sidewall_evidence->temporaryUrl() }}" class="img-thumbnail mt-1" style="max-height: 100px"> @endif
                            </div>
                        </div>

                        <div class="row g-3 mb-3 border-bottom pb-3">
                            <p class="mb-1 fw-bold small text-muted">2. Defect ID/OD</p>
                            <div class="col-md-6">
                                <label class="form-label small">Dokumentasi Damaged</label>
                                <input type="file" class="form-control form-control-sm" wire:model="photo_defect_id_od_damaged" accept="image/*" capture="environment">
                                @if ($photo_defect_id_od_damaged) <img src="{{ $photo_defect_id_od_damaged->temporaryUrl() }}" class="img-thumbnail mt-1" style="max-height: 100px"> @endif
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">Evidence Ring ID/OD Supplier</label>
                                <input type="file" class="form-control form-control-sm" wire:model="photo_defect_id_od_evidence" accept="image/*">
                                @if ($photo_defect_id_od_evidence) <img src="{{ $photo_defect_id_od_evidence->temporaryUrl() }}" class="img-thumbnail mt-1" style="max-height: 100px"> @endif
                            </div>
                        </div>

                        <div class="row g-3">
                            <p class="mb-1 fw-bold small text-muted">3. Defect Surface (Karat)</p>
                            <div class="col-md-6">
                                <label class="form-label small">Dokumentasi Karat</label>
                                <input type="file" class="form-control form-control-sm" wire:model="photo_defect_karat_damaged" accept="image/*" capture="environment">
                                @if ($photo_defect_karat_damaged) <img src="{{ $photo_defect_karat_damaged->temporaryUrl() }}" class="img-thumbnail mt-1" style="max-height: 100px"> @endif
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">Evidence VCI Supplier</label>
                                <input type="file" class="form-control form-control-sm" wire:model="photo_defect_karat_evidence" accept="image/*">
                                @if ($photo_defect_karat_evidence) <img src="{{ $photo_defect_karat_evidence->temporaryUrl() }}" class="img-thumbnail mt-1" style="max-height: 100px"> @endif
                            </div>
                        </div>

                    </div>
                @endif
            </div>
        </div>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <label class="form-label fw-bold">Keterangan Tambahan</label>
                <textarea class="form-control" wire:model="keterangan" rows="3" placeholder="Masukkan keterangan (opsional)..."></textarea>
            </div>
        </div>

        <div class="d-flex justify-content-end mb-5">
            <button type="submit" class="btn btn-primary px-4 py-2 fw-bold shadow-sm" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="save"><i class="bi bi-save me-2"></i> Simpan Laporan</span>
                <span wire:loading wire:target="save"><span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Menyimpan...</span>
            </button>
        </div>
    </form>
</div>
