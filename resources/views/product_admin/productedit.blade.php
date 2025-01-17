@extends('admin.app')

@section('contents')
    <div class="container">
        <h1>Edit Produk</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('productadmin.update', $data_product->product_id) }}">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="category_id">Nama Kategori</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">--> Pilih Kategori <--</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->category_id }}" {{ $data_product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->category_id }}" {{ $product->category_id == $category->category_id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div> --}}

            <div class="form-group pt-4">
                <label for="product_name">Nama Produk</label>
                <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $data_product->product_name }}" required>
            </div>

            <div class="form-group">
                <label for="product_description">Deskripsi</label>
                <input type="text" class="form-control" id="product_description" name="product_description" value="{{ $data_product->product_description }}" required>
            </div>

            <div class="form-group">
                <label for="product_price">Harga</label>
                <input type="number" class="form-control" id="product_price" name="product_price" value="{{ $data_product->product_price }}" required>
            </div>
            
            <div class="form-group">
                <label for="product_stock">Stok</label>
                <input type="number" class="form-control" id="product_stock" name="product_stock" value="{{ $data_product->product_stock }}" required>
            </div>

            <div class="form-group">
                <label for="product_image">Gambar Produk</label>
                <input type="file" name="product_image" id="product_image" class="form-control">
                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
            </div>
    
            <div class="form-group">
                <img src="{{ asset('products/' . $data_product->product_image) }}" alt="{{ $data_product->product_name }}" width="100px" class="mt-2">
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{route ('productadmin.index')}}" class="btn btn-danger">Batal</a>
        </form>
    </div>
@endsection