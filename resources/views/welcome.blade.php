<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Trang quản lý</h1>
            </div>
            <div class="col-md-12">
                <a href="{{route('addProduct')}}">Thêm sản phẩm</a>
                <a href="{{route('listProduct')}}">Danh sách sản phẩm</a>
            </div>
        </div>
    </div>
</body>
</html>