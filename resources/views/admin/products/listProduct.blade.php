@extends('layouts.admin')
@section('title', 'Danh sách video')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách sản phẩm</h5>
                <a href="{{ route('addProduct') }}" class="pt-1 pb-1 pl-3 pr-3 bg-danger rounded-sm text-white">Thêm
                    mới</a>
                <div class="form-search form-inline">
                    <form action="" class="d-flex">
                        <input type="" class="form-control form-search" placeholder="Tìm kiếm" name="keyword" value="">
                        <input onclick="return confirm('Bạn có chắc chắn thực hiện thao tác này không?')" type="submit"
                            name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="analytic">
                    <a href="{{ Request::url() }}?status=active" class="text-primary">Hoạt động<span
                            class="text-muted">1</span></a>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="form-action form-inline py-3">
                        <select class="form-control mr-1" id="act" name="act">
                            <option value="">Chọn</option>
                        </select>
                        <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                    </div>
                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <input name="checkall" type="checkbox">
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Mã truy xuất</th>
                                <th scope="col">Qrcode</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Doanh nghiệp tổ chức</th>
                                <th scope="col">Người tạo</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($products && $products->count() > 0)
                                @php
                                    $t = 0;
                                @endphp
                                @foreach ($products as $product)
                                    @php
                                        $t++;
                                    @endphp
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="list_check[]" value="">
                                        </td>
                                        <td scope="row">{{$t}}</td>
                                        <td>{{$product->nameProduct ? $product->nameProduct : ''}}</td>
                                        @php
                                            $avatar = json_decode($product->avatar);  
                                        @endphp
                                        <td><img style="width:150px; height:auto" src="{{$avatar ? asset($avatar[0]) : ''}}" alt=""></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{ date('d-m-Y', strtotime($product->created_at)) }}</td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="{{route('editProduct', $product->id)}}" onclick="return confirm('Bạn có chỉnh sửa sản phẩm này không?')"
                                                class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip"
                                                data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                            <button class="btn btn-danger btn-sm rounded-0 delete-media" data-id=""
                                                type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                    class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10">Không có bản ghi nào</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </form>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        phân trang
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
