<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengaduanModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pengaduan';

    protected $fillable = [
        'name',
        'nik',
        'category',
        'description',
        'location',
        'photo',
        'status',
        'user_id',
        'email_sent_at',
        'email_sent_by',
    ];

    protected $casts = [
        'email_sent_at' => 'datetime',
    ];

    public function getImageUrlAttribute()
    {
        return $this->photo ? Storage::url($this->photo) : null;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
