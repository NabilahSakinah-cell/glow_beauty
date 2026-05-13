namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $laporan = OrderDetail::with('product')
            ->selectRaw('product_id, SUM(jumlah) as total_terjual')
            ->groupBy('product_id')
            ->get();

        return view('owner.laporan', compact('laporan'));
    }
}
