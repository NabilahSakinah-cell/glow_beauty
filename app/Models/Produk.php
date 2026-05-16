<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    // Mengunci nama tabel agar Laravel mencari tabel 'produk' di database kamu
    protected $table = 'produk'; 

    // Sesuaikan Primary Key tabel kamu (misal: 'id_produk' atau 'id')
    protected $primaryKey = 'id_produk'; 

    // Matikan timestamps jika tabelmu tidak punya kolom created_at & updated_at
    public $timestamps = false;
}