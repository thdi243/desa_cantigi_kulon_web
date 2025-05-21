<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GaleriModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'galeri';

    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
        'status',
        'kategori_id',
        'user_id',
        'created_at',
        'updated_at',
    ];

    // Relasi dengan kategori
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriGaleriModel::class, 'kategori_id');
    }

    // Relasi dengan user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
