@extends('admin::layouts.master')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li><a href="#">Trang chủ</a></li>
            <li><a href="#">Nhà cung cấp</a></li>
            <li class="active">Danh sách</li>
        </ol>
    </div>
    <div class="table-responsive">
        <h2>Quản lý nhà cung cấp <a href="{{ route('admin.get.create.supplier') }}" class="pull-right"><i class="fas fa-plus-circle"></i></a></h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên nhà CC</th>
                    <th>Email</th>
                    <th>Phone / Fax</th>
                    <th>Website</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @if ( isset($suppliers))
                    @foreach($suppliers as $supplier)
                        <tr>
                            <td>{{ $supplier->id }}</td>
                            <td>{{ $supplier->s_name }}</td>
                            <td>{{ $supplier->s_email }}</td>
                            <td>{{ $supplier->s_phone }} {{ $supplier->s_fax }}</td>
                            <td>{{ $supplier->s_website }}</td>
                            <td>
                                <a href="{{ route('admin.get.edit.supplier',$supplier->id) }}">Edit</a>
                                <a href="{{ route('admin.get.delete.supplier',$supplier->id) }}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div>
        {!! $suppliers->links()  !!}
    </div>
@stop