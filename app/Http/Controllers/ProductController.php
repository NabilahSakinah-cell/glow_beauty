namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'harga'=>'required|numeric',
            'stok'=>'required|integer',
        ]);

        Product::create($request->all());
        return redirect()->route('produk.index')->with('success','Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama'=>'required',
            'harga'=>'required|numeric',
            'stok'=>'required|integer',
        ]);

        $product->update($request->all());
        return redirect()->route('produk.index')->with('success','Produk berhasil diupdate!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('produk.index')->with('success','Produk berhasil dihapus!');
    }
}
