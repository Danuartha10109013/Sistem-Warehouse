<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KodeBahanBaku extends Model
{
    protected $table = 'kode_produk_bb';

    protected $fillable = [
        'supplier',
        'kode_produk',
        'nama_produk',
        'kode_supplier',
        'kategori',
        'origin',
        'attribute_code',
        'jenis',
    ];

    /**
     * Mutators to ensure ALL stored values are uppercase
     */
    public function setSupplierAttribute($value)
    {
        $this->attributes['supplier'] = $value !== null ? strtoupper(trim($value)) : null;
    }

    public function setKodeProdukAttribute($value)
    {
        $this->attributes['kode_produk'] = $value !== null ? strtoupper(trim($value)) : null;
    }

    public function setNamaProdukAttribute($value)
    {
        $this->attributes['nama_produk'] = $value !== null ? strtoupper(trim($value)) : null;
    }

    public function setKodeSupplierAttribute($value)
    {
        $this->attributes['kode_supplier'] = $value !== null ? strtoupper(trim($value)) : null;
    }

    public function setJenisAttribute($value)
    {
        $this->attributes['jenis'] = $value !== null ? strtoupper(trim($value)) : null;
    }

    public function setAttributeCodeAttribute($value)
    {
        $this->attributes['attribute_code'] = $value !== null ? strtoupper(trim($value)) : null;
    }

    public function setOriginAttribute($value)
    {
        $this->attributes['origin'] = $value !== null ? strtoupper(trim($value)) : null;
    }

    public function setKategoriAttribute($value)
    {
        $this->attributes['kategori'] = $value !== null ? strtoupper(trim($value)) : null;
    }

    /**
     * Accessor for nama_supplier (alias of supplier)
     */
    public function getNamaSupplierAttribute()
    {
        return $this->supplier;
    }

    /**
     * Mutator for nama_supplier
     */
    public function setNamaSupplierAttribute($value)
    {
        $this->setSupplierAttribute($value);
    }

    /**
     * Accessor for kode_supplier: fallback to attribute_code if null
     */
    public function getKodeSupplierAttribute($value)
    {
        return $value ?? $this->attributes['attribute_code'] ?? null;
    }
}
