<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubSuratTypeModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sub_surat_type';

    protected $fillable = [
        'surat_type_id',
        'nama_sub_surat',
    ];

    public function suratType()
    {
        return $this->belongsTo(SuratTypeModel::class, 'surat_type_id');
    }

    public function surat()
    {
        return $this->hasMany(SuratModel::class, 'sub_surat_type_id');
    }
}
