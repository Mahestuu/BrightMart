@extends('admin.app')

@section('contents')
    <div class="container">
        <h1>Tambah Produk Baru</h1>

        <!-- Tampilkan error validasi jika ada -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('productadmin.store') }}"  enctype="multipart/form-data" method="POST">
            @csrf <!-- Token CSRF untuk melindungi dari serangan CSRF -->

            <div class="form-group">
                <label for="category_id">Kategori</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->category_id }}" {{old('category_id')== $category->category_id ? 'selected' : null}}>{{ $category->category_name }}</option>
                        {{-- <option value="">1.dsjfksn</option> --}}
                    @endforeach
                </select>
            </div>

            <div class="form-group pt-4">
                <label for="product_name">Nama Produk</label>
                <input type="text" class="form-control" id="product_name" name="product_name" value="{{ old('product_name') }}" required>
            </div>

            
            <div class="form-group">
                <label for="product_description">Deskripsi</label>
                <input type="text" class="form-control" id="product_description" name="product_description" value="{{ old('product_description') }}" required>
            </div>

            <div class="form-group">
                <label for="product_price">Harga</label>
                <input type="number" class="form-control" id="product_price" name="product_price" value="{{ old('product_price') }}" required>
            </div>
            
            <div class="form-group">
                <label for="product_stock">Stok</label>
                <input type="number" class="form-control" id="product_stock" name="product_stock" value="{{ old('product_stock') }}" required>
            </div>

            <div class="form-group">
                <label for="product_image" class="form-label">Gambar Produk</label>
                <input class="form-control" type="file" id="product_image" name="product_image" required>
            </div>

            <button type="submit" class="btn btn-primary">Tambah Produk</button>
            <a href="{{route ('productadmin.index')}}" class="btn btn-danger">Batal</a>
            
        </form>
    </div>
@endsection
