class OrderDetail extends Model
{
    protected $fillable = ['order_id','product_id','jumlah'];
    public function product() {
        return $this->belongsTo(Product::class);
    }
}
