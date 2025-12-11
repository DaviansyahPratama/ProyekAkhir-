<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Proyek extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'mahasiswa_nim',
        'mahasiswa_nama',
        'dosen_pembimbing',
        'status',
        'tanggal_mulai',
        'tanggal_selesai',
        'progress',
        'catatan',
        'file_dokumen',
        'file_lampiran',
        'user_id',
    ];

    protected $casts = [
        'file_lampiran' => 'array',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    /**
     * Get the user (staff) that manages this project
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get status badge color
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'warning',
            'on_progress' => 'info',
            'completed' => 'success',
            'rejected' => 'danger',
            default => 'secondary',
        };
    }
}
