@extends('admin.app')

@section('title', 'Data Category')

@section('contents')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('categoryadmin.create') }}" class="btn btn-primary"><i class="fas fa-plus"> </i> Tambah Kategori</a>
    </div>
    <div class="card-body">
        @if (Session::has ('success'))
            <div class="alert alert-success fw-semibold" role="alert">
                {{Session::get('success')}}
            </div>
        @endsession
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th class="text-center">Category Name</th>
                        <th class="text-center" style="width:35%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php($no = 1)
                    @foreach ( $data_category as $row )
                        <tr>
                            <th>{{$no++}}</th>
                            <td class="text-center">{{$row -> category_name}}</td>
                            <td class="text-center"> 
                                <a href="{{route ('categoryadmin.edit', $row->category_id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('categoryadmin.destroy', $row->category_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection