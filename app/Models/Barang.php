<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    protected $table = 'barang';
    use HasFactory;

      protected $fillable = [
        'harga',
        'stok_isi',
        'stok_kosong',
        'stok_bocor',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
