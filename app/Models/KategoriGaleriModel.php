<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriGaleriModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategori_galeri';

    protected $fillable = [
        'nama_kategori',
        'slug',
    ];

    // Relasi ke galeri
    public function galeri()
    {
        return $this->hasMany(GaleriModel::class, 'kategori_id');
    }
}
