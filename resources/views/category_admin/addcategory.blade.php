@extends('admin.app')

@section('contents')
    <div class="container">
        <h1>Tambah Kategori Baru</h1>

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

        <form action="{{ route('categoryadmin.store') }}" method="POST">
            @csrf <!-- Token CSRF untuk melindungi dari serangan CSRF -->

            <div class="form-group pt-4">
                <label for="category_name">Nama Kategori</label>
                <input type="text" class="form-control" id="category_name" name="category_name" value="{{ old('category_name') }}" required>
            </div>


            <button type="submit" class="btn btn-primary">Buat Kategori</button>
            <a href="{{route ('categoryadmin.index')}}" class="btn btn-danger">Batal</a>
            
        </form>
    </div>
@endsection
