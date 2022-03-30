@extends('layouts.admin')

@section('content')
    <style>
        .image-images,
        .image-cert-images,
        .image-verify-images,
        .image-business-images {
            width: 125px;
            height: 125px;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        #preview-verify-images {
            display: flex;
            margin-top: 10px;
        }

        .image-verify-images {
            padding: 10px 0px;
        }

        .hide {
            display: none;
        }


        .mt-10 {
            margin-top: 10px;
        }

        .hidden {
            display: block;
            opacity: 0;
        }

    </style>
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                CHỈNH SỬA SẢN PHẨM
            </div>
            <div class="card-body">
                <form action="{{ route('updateProduct', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @php
                        $maxSize = env('MAX_SIZE', 5120);
                        $megaByte = $maxSize / 1024;
                    @endphp
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label">Hình ảnh đại diện</label>
                            </div>
                            <div class="col-md-10">
                                <div class="col-md-12" style="margin-bottom: 10px">
                                    <button class="add-image btn btn-success green" type="button">Thêm</button>
                                    <button
                                        class="delete-image btn btn-danger red {{ !isset($business) || (isset($business) && !$business->verifications) ? 'hide' : '' }}"
                                        type="button">Xóa</button>
                                    <label class="control-label" style="color: red"><i>Lưu ý: Dung lượng tối đa cho 1 hình
                                            là {{ $megaByte }} MB</i> </label>
                                </div>

                                <div class="col-md-12 hide" id="list-input-images" style="margin-top: 10px">
                                </div>

                                <div id="preview-images" class="col-md-9">
                                    @php
                                        $productImage = json_decode($product->avatar, true);
                                    @endphp
                                    @if (isset($productImage))
                                        @if ($productImage && is_array($productImage))
                                            @foreach ($productImage as $img)
                                                <div class="col-md-2">
                                                    <input type="hidden" name="oldBusiness[]" class="oldBusiness"
                                                        value="{{ $img }}">
                                                    <img class="item-image image-business-images"
                                                        data-img="{{ $img }}" src="{{ asset($img) }}" alt="" />
                                                </div>
                                            @endforeach
                                        @endif
                                    @endif
                                </div>

                            </div>
                        </div>
                        @error('avatar')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">Tên sản phẩm <span class="text-danger">(*)</span></label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" placeholder="Nhập tên sản phẩm..." class="form-control"
                                    name="nameProduct" value="{{ $product->nameProduct }}">
                            </div>
                        </div>
                        @error('nameProduct')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">Slug</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" placeholder="Nhập slug..." class="form-control" name="slug"
                                    value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">Danh mục cấp 1</label>
                            </div>
                            <div class="col-md-10">
                                <select name="productCat_id" id="" class="form-control">
                                    <option value="">---Chọn danh mục cha---</option>
                                    <option value="1">Giống</option>
                                    <option value="2">Vật tư</option>
                                    <option value="3">Sản phẩm</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">Giá sản phẩm</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" placeholder="Nhập giá sản phẩm..." class="form-control" name="price"
                                    value="{{ $product->price }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">Xuất xứ</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" placeholder="Nhập xuất xứ..." class="form-control" name="origin"
                                    value="{{ $product->origin }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">Mã vạch</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" placeholder="Nhập mã vạch..." class="form-control" name="barcode"
                                    value="{{ $product->barcode }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">Vùng sản xuất</label>
                            </div>
                            <div class="col-md-10">
                                <select name="productionArea" id="" class="form-control">
                                    <option value="">---Chọn vùng sản xuất---</option>
                                    <option value="1">Gia lai</option>
                                    <option value="2">Cà mau</option>
                                    <option value="3">Nghệ an</option>
                                    <option value="4">Bắc ninh</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">Nguyên liệu</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" placeholder="Nhập nguyên liệu..." class="form-control" name="resource"
                                    value="{{ $product->resource }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">Nhà xưởng sản xuất</label>
                            </div>
                            <div class="col-md-10">
                                <select name="productionArea" id="" class="form-control">
                                    <option value="">---Chọn vùng sản xuất---</option>
                                    <option value="1">Gia lai</option>
                                    <option value="2">Cà mau</option>
                                    <option value="3">Nghệ an</option>
                                    <option value="4">Bắc ninh</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">Nhà sản xuất</label>
                            </div>
                            <div class="col-md-10">
                                <select name="producer" id="" class="form-control">
                                    <option value="">---Chọn vùng sản xuất---</option>
                                    <option value="1">Gia lai</option>
                                    <option value="2">Cà mau</option>
                                    <option value="3">Nghệ an</option>
                                    <option value="4">Bắc ninh</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">Nhà xuất khẩu</label>
                            </div>
                            <div class="col-md-10">
                                <select name="productionArea" id="" class="form-control">
                                    <option value="">---Chọn nhà xuất khẩu---</option>
                                    <option value="1">Gia lai</option>
                                    <option value="2">Cà mau</option>
                                    <option value="3">Nghệ an</option>
                                    <option value="4">Bắc ninh</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">Nhà nhập khẩu</label>
                            </div>
                            <div class="col-md-10">
                                <select name="importers" id="" class="form-control">
                                    <option value="">---Chọn nhà nhập khẩu---</option>
                                    <option value="1">Gia lai</option>
                                    <option value="2">Cà mau</option>
                                    <option value="3">Nghệ an</option>
                                    <option value="4">Bắc ninh</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">Nhà phân phối</label>
                            </div>
                            <div class="col-md-10">
                                <select name="distributor" id="" class="form-control">
                                    <option value="">---Chọn nhà phân phối---</option>
                                    <option value="1">Gia lai</option>
                                    <option value="2">Cà mau</option>
                                    <option value="3">Nghệ an</option>
                                    <option value="4">Bắc ninh</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">Nhà vận chuyển</label>
                            </div>
                            <div class="col-md-10">
                                <select name="transporters" id="" class="form-control">
                                    <option value="">---Chọn nhà vận chuyển---</option>
                                    <option value="1">Gia lai</option>
                                    <option value="2">Cà mau</option>
                                    <option value="3">Nghệ an</option>
                                    <option value="4">Bắc ninh</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">Người quản lý</label>
                            </div>
                            <div class="col-md-10">
                                <select name="manager" id="" class="form-control">
                                    <option value="">---Chọn vùng sản xuất---</option>
                                    <option value="1">Gia lai</option>
                                    <option value="2">Cà mau</option>
                                    <option value="3">Nghệ an</option>
                                    <option value="4">Bắc ninh</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">Điều kiện bảo quản</label>
                            </div>
                            <div class="col-md-10">
                                <textarea name="storageConditions" id="" class="form-control textAreaNot" cols="30" rows="10"
                                    placeholder="Nhập điều kiện bảo quản...">{{ $product->storageConditions }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">Mô tả sản phẩm</label>
                            </div>
                            <div class="col-md-10">
                                <textarea name="descProduct" id="" class="form-control" cols="30" rows="10"
                                    placeholder="Nhập mô tả sản phẩm...">{{ $product->desc }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">Chi tiết sản phẩm</label>
                            </div>
                            <div class="col-md-10">
                                <textarea name="contentProduct" id="" class="form-control" cols="30" rows="10"
                                    placeholder="Nhập chi tiết sản phẩm...">{{ $product->content }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">Thành phần</label>
                            </div>
                            <div class="col-md-10">
                                <textarea name="ingredient" id="" class="form-control textAreaNot" cols="30" rows="10"
                                    placeholder="Nhập thành phần sản phẩm...">{{ $product->ingredient }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">Công dụng</label>
                            </div>
                            <div class="col-md-10">
                                <textarea name="usesProduct" id="" class="form-control textAreaNot" cols="30" rows="10"
                                    placeholder="Nhập công dụng sản phẩm...">{{ $product->usesProduct }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">Hướng dẫn sử dụng</label>
                            </div>
                            <div class="col-md-10">
                                <textarea name="userManual" id="" class="form-control textAreaNot" cols="20" rows="10"
                                    placeholder="Nhập hướng dẫn sử dụng sản phẩm...">{{ $product->userManual }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label">Giấy kiểm định, kiểm nghiệm</label>
                            </div>
                            <div class="col-md-10">
                                <div class="col-md-12">
                                    <button class="add-verify btn btn-success green" type="button">Thêm</button>
                                    <button
                                        class="delete-verify btn btn-danger red {{ !isset($business) || (isset($business) && !$business->verifications) ? 'hide' : '' }}"
                                        type="button">Xóa</button>
                                    <label class="control-label" style="color: red"><i>Lưu ý: Dung lượng tối đa cho 1 hình
                                            là{{ $megaByte }} MB</i></label>
                                </div>

                                <div class="col-md-12 hide" id="list-input-verify-images" style="margin-top: 10px"></div>

                                <div id="preview-verify-images" class="col-md-12">
                                    @php
                                        $productImageVerify = json_decode($product->verifications, true);
                                    @endphp
                                    @if (isset($productImageVerify))
                                        @if ($productImageVerify && is_array($productImageVerify))
                                            @foreach ($productImageVerify as $img)
                                                <div class="col-md-2">
                                                    <input type="hidden" name="oldBusiness[]" class="oldBusiness"
                                                        value="{{ $img }}">
                                                    <img class="item-image image-business-images"
                                                        data-img="{{ $img }}" src="{{ asset($img) }}" alt="" />
                                                </div>
                                            @endforeach
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">Trạng thái</label>
                            </div>
                            <div class="col-md-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status1" value="0"
                                        checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Chờ duyệt
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status2" value="1">
                                    <label class="form-check-label" for="exampleRadios2">
                                        Công khai
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary w-25">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
