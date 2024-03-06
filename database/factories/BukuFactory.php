<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';
    use HasFactory;
    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'deskripsi',
        'gambar',
        'stok',
    ];


    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'buku_kategori');
    }
}
