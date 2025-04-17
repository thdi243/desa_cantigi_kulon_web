<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KabarDesaModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $table = 'kabar_desa';

    protected $fillable = [
        'judul',
        'isi',
        'ringkasan',
        'kategori',
        'gambar',
        'status',
        'tgl_publish',
        'kategori_id',
        'user_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriBeritaModel::class, 'kategori_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
