<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratTypeModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'surat_type';
    protected $fillable = [
        'nama_surat',
    ];

    public function surat()
    {
        return $this->hasMany(SuratModel::class, 'surat_type_id');
    }

    public function subSuratType()
    {
        return $this->hasMany(SubSuratTypeModel::class, 'surat_type_id');
    }
}
