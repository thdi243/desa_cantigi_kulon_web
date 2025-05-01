<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class SuratModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'surat';

    protected $fillable = [
        'sub_surat_type_id',
        'nomor_surat',
        'tgl_surat',
        'data_pemohon',
        'data_surat',
        'status',
        'user_id',
        'pdf_path',
        'email_sent_at',
        'email_sent_by',
        'pdf_downloads'
    ];

    protected $casts = [
        'tgl_surat' => 'date',
        'data_pemohon' => 'array',
        'data_surat' => 'array',
        'email_sent_at' => 'datetime',
    ];

    public function getDataJsonAttribute($value)
    {
        return is_string($value) ? json_decode($value, true) : $value;
    }

    public function setDataPemohonAttribute($value)
    {
        // Pastikan selalu disimpan sebagai JSON
        $this->attributes['data_pemohon'] = is_array($value)
            ? json_encode($value)
            : $value;
    }

    public function setDataSuratAttribute($value)
    {
        // Pastikan selalu disimpan sebagai JSON
        $this->attributes['data_surat'] = is_array($value)
            ? json_encode($value)
            : $value;
    }


    // relation
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
