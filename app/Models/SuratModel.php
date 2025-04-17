<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'surat';

    protected $fillable = [
        'nik',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'agama',
        'pekerjaan',
        'keperluan',
        'sub_surat_type_id',
        'data',
        'status',
        'user_id'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'data' => 'json',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function suratType(): BelongsTo
    {
        return $this->belongsTo(SuratTypeModel::class, 'surat_type_id');
    }

    public function subSuratType(): BelongsTo
    {
        return $this->belongsTo(SubSuratTypeModel::class, 'sub_surat_type_id');
    }
}
