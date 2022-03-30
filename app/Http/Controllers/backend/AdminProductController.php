<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function addProduct()
    {
        return view('admin.products.addProduct');
    }

    public function storeProduct(Request $request)
    {
        $maxSize = env('MAX_SIZE', 5120);
        $megaByte = $maxSize / 1024;
        $request->validate(
            [
                'nameProduct' => 'required || max:255',
                'avatar' => ['nullable'],
                'avatar.*' => 'mimes:jpeg,png,jpg,gif|max:' . $maxSize,
                'verifications' => ['nullable'],
                'verifications.*' => 'mimes:jpeg,png,jpg,gif|max:' . $maxSize
            ],
            [
                'required' => ':attribute không được để trống'
            ],
            [
                'nameProduct' => 'Tên sản phẩm',
                'avatar.*.mimes' => 'Hình Ảnh phải có định dạng jpeg,png,jpg,gif',
                'avatar.*.max' => 'Hình Ảnh phải có dung lượng không vượt quá ' . $megaByte . 'MB',
                'verifications.*.mimes' => 'Hình kiểm định phải có định dạng jpeg,png,jpg,gif',
                'verifications.*.max' => 'Hình kiểm định phải có dung lượng không vượt quá ' . $megaByte . 'MB'
            ]
        );

        if ($request->input('slug')) {
            $slug = Str::slug($request->input('slug'));
        } else {
            $slug = Str::slug($request->input('nameProduct'));
        }

        $files = $request->file('verifications');
        $files = $this->saveListImages($files);

        $avatar = $request->file('avatar');
        $avatar = $this->saveListImages($avatar);

        $data = $request->all();
        if ($data) {
            Product::create([
                'nameProduct' => $data['nameProduct'],
                'slug' => $slug,
                'productCat_id' => $data['productCat_id'],
                'price' => $data['price'],
                'origin' => $data['origin'],
                'barcode' => $data['barcode'],
                'productionArea' => $data['productionArea'],
                'resource' => $data['resource'],
                'producer' => $data['producer'],
                'importers' => $data['importers'],
                'distributor' => $data['distributor'],
                'transporters' => $data['transporters'],
                'manager' => $data['manager'],
                'storageConditions' => $data['storageConditions'],
                'description' => $data['descProduct'],
                'contentProduct' => $data['contentProduct'],
                'ingredient' => $data['ingredient'],
                'usesProduct' => $data['usesProduct'],
                'userManual' => $data['userManual'],
                'avatar' => $avatar,
                'verifications' => $files,
                'status' => $data['status'],
            ]);

            return redirect(route('listProduct'))->with('status', 'Bạn đã thêm sản phẩm thành công');
        }
    }

    public function listProduct()
    {
        $products = Product::where('status', 1)->orderBy('id', 'desc')->get();
        return view('admin.products.listProduct', compact('products'));
    }

    public function editProduct($id)
    {
        $product = Product::find($id);
        if ($product->count() > 0) {
            return view('admin.products.editProduct', compact('product'));
        }
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::find($id);
        $maxSize = env('MAX_SIZE', 5120);
        $megaByte = $maxSize / 1024;
        $request->validate(
            [
                'nameProduct' => 'required || max:255',
                'avatar' => ['nullable'],
                'avatar.*' => 'mimes:jpeg,png,jpg,gif|max:' . $maxSize,
                'verifications' => ['nullable'],
                'verifications.*' => 'mimes:jpeg,png,jpg,gif|max:' . $maxSize
            ],
            [
                'required' => ':attribute không được để trống'
            ],
            [
                'nameProduct' => 'Tên sản phẩm',
                'avatar.*.mimes' => 'Hình Ảnh phải có định dạng jpeg,png,jpg,gif',
                'avatar.*.max' => 'Hình Ảnh phải có dung lượng không vượt quá ' . $megaByte . 'MB',
                'verifications.*.mimes' => 'Hình kiểm định phải có định dạng jpeg,png,jpg,gif',
                'verifications.*.max' => 'Hình kiểm định phải có dung lượng không vượt quá ' . $megaByte . 'MB'
            ]
        );

        if ($request->input('slug')) {
            $slug = Str::slug($request->input('slug'));
        } else {
            $slug = Str::slug($request->input('nameProduct'));
        }


        $files = $request->file('verifications');
        $files = $this->saveListImages($files);
        if($files){

            $verificationArray = json_decode($product->verifications, true);
            $files = json_decode($files, true);  
            
            $files =  array_merge($verificationArray, $files);
           
            return $files;

            // $files = json_decode($product->verifications, true);
            // foreach($files as $file){
            //     unlink('public/' . $file);
            // }
        }else{
            $files = $product->verifications;
        }  
        

        $avatar = $request->file('avatar');
        $avatar = $this->saveListImages($avatar);
        if($avatar){
            $avatar = json_decode($product->avatar, true);
            foreach($files as $file){
                unlink('public/' . $avatar);
            }
        }else{
            $avatar = $product->avatar;
        }   
        

        $data = $request->all();
        if ($data) {
            Product::where('id', $id)
            ->update([
                'nameProduct' => $data['nameProduct'],
                'slug' => $slug,
                'productCat_id' => $data['productCat_id'],
                'price' => $data['price'],
                'origin' => $data['origin'],
                'barcode' => $data['barcode'],
                'productionArea' => $data['productionArea'],
                'resource' => $data['resource'],
                'producer' => $data['producer'],
                'importers' => $data['importers'],
                'distributor' => $data['distributor'],
                'transporters' => $data['transporters'],
                'manager' => $data['manager'],
                'storageConditions' => $data['storageConditions'],
                'description' => $data['descProduct'],
                'contentProduct' => $data['contentProduct'],
                'ingredient' => $data['ingredient'],
                'usesProduct' => $data['usesProduct'],
                'userManual' => $data['userManual'],
                'avatar' => $avatar,
                'verifications' => $files,
                'status' => $data['status'],
            ]);

            return redirect(route('listProduct'))->with('status', 'Bạn đã cập nhật sản phẩm thành công');
        }
    }

    public function saveListImages($files)
    {
        if ($files && is_array($files)) {
            $arrayImage = [];
            foreach ($files as $file) {
                //tên file
                $file_name = $file->getClientOriginalName();
                //đổi tên file
                $name_image = current(explode('.', $file_name));
                $new_name = $name_image . rand(0, 99) . '.' . $file->getClientOriginalExtension();
                //lưu file
                $file->move('public/uploads/products', $new_name);
                //lưu file lên database
                $thumbnail = 'uploads/products/' . $new_name;
                $arrayImage[] = $thumbnail;
            }
        }
        if (!empty($arrayImage) && is_array($arrayImage)) {
            $files = json_encode($arrayImage);
            return $files;
        }
        // $arrayUpdate = array_merge($arrayImage, $arrayImageNew);
        // $files = json_decode($files, true);  
    }
}
