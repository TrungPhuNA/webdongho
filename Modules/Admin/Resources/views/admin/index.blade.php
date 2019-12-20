@extends('admin::layouts.master')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li><a href="#">Trang chủ</a></li>
            <li><a href="#">Admin</a></li>
            <li class="active">Danh sách</li>
        </ol>
    </div>
    <div class="table-responsive">
        <h2>Quản lý bài viết <a href="{{ route('admin.get.create.admin') }}" class="pull-right"><i class="fas fa-plus-circle"></i></a></h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th width="20%">Họ tên</th>
                    <th style="width: 100px">Email</th>
                    <th style="width: 300px">Số điện thoại</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                 @if (isset($admins))
                     @foreach($admins as $admin)
                         <tr>
                             <td>{{ $admin->id }}</td>
                             <td>
                                 {{ $admin->name }}
                             </td>
                             <td>
                                 {{ $admin->email }}
                             </td>
                             <td>
                                 {{ $admin->phone }}
                             </td>
                             <td>
                                 {{ $admin->created_at }}
                             </td>
                             <td>
                                 <a class="btn_customer_action" href="{{ route('admin.get.edit.admin',$admin->id) }}"><i class="fas fa-pen" ></i> Cập nhật</a>
                                 <a class="btn_customer_action" href="{{ route('admin.get.delete.admin',$admin->id) }}"><i class="fas fa-trash-alt"></i> Xoá</a>
                             </td>
                         </tr>
                     @endforeach
                 @endif
            </tbody>
        </table>
    </div>
@stop
