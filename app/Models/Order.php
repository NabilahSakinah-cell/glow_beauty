class Order extends Model
{
    protected $fillable = ['nama','alamat','telepon','email','tanggal'];
    public function details() {
        return $this->hasMany(OrderDetail::class);
    }
}

public function user()
{
    // Sesuaikan 'id_pelanggan' dengan nama kolom ID di tabel pesanan Anda
    return $this->belongsTo(User::class, 'id_pelanggan'); 
}