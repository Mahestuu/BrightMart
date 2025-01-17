@extends('admin.app')

@section('contents')
    <div class="container">
        <h1>Edit Category</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('categoryadmin.update', $categories->category_id) }}">
            @csrf
            @method('PUT')

            <div class="form-group pt-2">
                <label for="category_name">Nama Kategori</label>
                <input type="text" name="category_name" id="category_name" class="form-control" value="{{ $categories->category_name }}" required>
            </div>
            

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{route ('categoryadmin.index')}}" class="btn btn-danger">Batal</a>
        </form>
    </div>
@endsection