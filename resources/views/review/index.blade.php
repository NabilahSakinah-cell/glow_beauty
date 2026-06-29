<div class="max-w-4xl mx-auto p-8">
    <h2 class="text-2xl font-bold mb-6">Daftar Ulasan Pelanggan</h2>
    <table class="w-full bg-white rounded-xl shadow-sm border">
        <thead>
            <tr class="bg-rose-50 text-left">
                <th class="p-4">Pesanan</th>
                <th class="p-4">Rating</th>
                <th class="p-4">Komentar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $r)
            <tr class="border-t">
                <td class="p-4">#{{ $r->id_pesanan }}</td>
                <td class="p-4 text-amber-500">{{ $r->rating }} ★</td>
                <td class="p-4">{{ $r->komentar }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>