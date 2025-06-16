@extends('admin.app')

@section('title', 'Data Product')

@section('contents')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('productadmin.create') }}" class="btn btn-primary"><i class="fas fa-plus"> </i>  Tambah Produk</a>
    </div>
    <div class="card-body">
        @if (Session::has ('success'))
            <div class="alert alert-success fw-semibold" role="alert">
                {{Session::get('success')}}
            </div>
        @endsession
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead >
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Nama Produk</th>
                        <th>Deskripsi Produk</th>
                        <th>Harga Produk</th>
                        <th class="text-center">Stok Produk</th>
                        <th class="text-center">Gambar Produk</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody >
                    @php($no = 1)
                    @foreach ( $data_product as $row )
                        <tr>
                            <th class="align-middle">{{$no++}}</th>
                            <td class="align-middle">{{$row -> category->category_name}}</td>
                            <td class="align-middle">{{$row -> product_name}}</td>
                            <td class="align-middle">{{$row -> product_description}}</td>
                            <td class="align-middle">Rp. {{ number_format($row->product_price, 0, ',', '.') }}</td>
                            <td class="text-center align-middle">{{$row -> product_stock}}</td>
                            <td class=" text-center">
                                <img src="{{ asset('products/' . $row->product_image) }}" alt="{{ $row->product_name }}" width="100px">
                            </td>                            
                            <td class="text-center align-middle">
                                <a href="{{ route('productadmin.edit', $row->product_id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('productadmin.destroy', $row->product_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection