<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriBeritaModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategori_berita';

    protected $fillable = [
        'nama_kategori',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function berita()
    {
        return $this->hasMany(KabarDesaModel::class, 'kategori_id');
    }
}
