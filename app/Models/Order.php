class Order extends Model
{
    protected $fillable = ['nama','alamat','telepon','email','tanggal'];
    public function details() {
        return $this->hasMany(OrderDetail::class);
    }
}
