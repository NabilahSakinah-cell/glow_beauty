@extends('layouts.app')
@section('content')
<div class="container">
  <h2>Laporan Penjualan Glow Beauty</h2>
  <table class="table table-bordered">
    <tr><th>Produk</th><th>Jumlah Terjual</th></tr>
    @foreach($laporan as $l)
    <tr>
      <td>{{ $l->product->nama }}</td>
      <td>{{ $l->total_terjual }}</td>
    </tr>
    @endforeach
  </table>
</div>
@endsection
