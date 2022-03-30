<?php

namespace App\Http\Controllers\Product;

use File;
use DataTables;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Product\Products;
use App\Models\Category\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Product\ProductRequest;
use PDF;


class Product extends Controller
{
    # products list
    public function index() {
        $p_data = [];
        $p_data['url'] = 'products';
        return view('dashboard.product.index', $p_data);
    }
    public function product_list() {

    }
    # add
    public function add() {

        $p_data = [];
        $p_data['url'] = 'add product';
        $p_data['categories'] = Category::all();
        return view('dashboard.product.add', $p_data);
    }
    # store
    public function store(ProductRequest $request) {
        # product id generator


        # single image
        $file_name = " ";
        if($request->hasfile('image')) {
            $single_image = $request->file('image');
            $file_name = time().rand(1,100).'.'.$single_image->extension();
            $single_image->move(public_path('upload/images/product'), $file_name);
        }
        # multiple image
        $multiple_image = [];
        if($request->hasfile('image_gallery')) {
            foreach($request->file('image_gallery') as $file)
            {
                $name = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path('upload/images/product/gallery'), $name);
                $multiple_image[] = $name;
            }
        }
        $product_id = Helper::IDGenerator($this->product_model, 'product_id', 4, 'PRO'); /** Generate id */
        $product_data = $this->product_model;
        $product_data->code             = $request->code;
        $product_data->name             = $request->name;
        $product_data->category_id      = $request->category_id;
        $product_data->weight           = $request->weight ? $request->weight : 0;
        $product_data->cost             = $request->cost ? $request->cost : 0;
        $product_data->price            = $request->price;
        $product_data->quantity_alert   = $request->quantity_alert ? $request->quantity_alert : 0;
        $product_data->quantity         = $request->quantity ? $request->quantity : 0;
        $product_data->image            = 'upload/images/product/'.$file_name;
        $product_data->details          = $request->product_details ? $request->product_details : '';
        $product_data->created_by       = Auth::user()->id;
        $product_data->product_id       = $product_id;
        $count = count($multiple_image);
        $gallery_data = [];
        $q = $product_data->save();
        $galleries = $request->file('image_gallery');
        if ($q) {
            for($i = 0 ; $i < $count; $i++) {
                $gallery_data[] = [
                    'product_id'    => $product_data->id,
                    'image'         => 'upload/images/product/gallery/'.$multiple_image[$i]
                ];
            }
            DB::table('product_photos')->insert($gallery_data);
            return back()->with('success', 'product added successfully');
        }
        else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    # product list
    public function show() {
        if(Auth::user()->hasRole(['supper-admin', 'admin'])) {
            $product_list = $this->product_model::join('categories', 'categories.id', '=', 'products.category_id', 'left')
                            ->join('users', 'users.id', '=', 'products.created_by')
                            ->orderBy('products.name', 'asc')
                            ->get(['products.*','categories.name AS category_name', 'users.id AS user_id', 'users.name AS created_by']);
        }
        if(Auth::user()->hasRole(['user', 'user-staff'])) {
            $product_list = $this->product_model::join('categories', 'categories.id', '=', 'products.category_id', 'left')
                            ->where('created_by', Auth::user()->id)
                            ->orderBy('products.name', 'asc')
                            ->get(['products.*','categories.name AS category_name']);
        }
        return DataTables::of($product_list)
                ->addIndexColumn()
                ->addColumn('actions', function($data) {
                    $link_1 = '<i class="fa fa-edit"></i> Edit Product';
                    $link_2 = '<i class="fa fa-images"></i> Add Product Gallery';
                    $link_3 = '<i class="fa fa-trash"></i> Delete';
                    if(Auth::user()->hasRole(['supper-admin', 'admin'])) {
                        $delete_link = '<a href="'.url('admin/product/'.$data->id.'/delete').'" class="dropdown-item delete_product" data-id="'.$data->id.'">' . $link_3 . '</a>';
                    }
                    if(Auth::user()->hasRole(['user', 'user-staff'])) {
                        $delete_link = '';
                    }
                    $action =
                        '<div class="text-center dropdown role_actions"><div class="btn-group dropleft text-left">'
                            . '<button class="btn btn-xs btn_logo dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                            <div class="dropdown-menu pull-right" role="menu">
                                <a href="'.url('admin/product/'.$data->id.'/edit').'" class="dropdown-item edit_role" data-id="'.$data->id.'">' . $link_1 . '</a>
                                <a class="dropdown-item add_product_gallery" data-id="'.$data->id.'">' . $link_2 . '</a>
                                '.$delete_link.'
                            </div>
                        </div>';

                    return $action;
                })
                // ->addColumn('checkbox', function($data){
                //     $checkbox_content = '<input type="checkbox" class="checkbox multi-select" name="product_id[]" value="'.$data->id.'" id="info'.$data->id.'">';
                //     return $checkbox_content;
                // })
                # image render
                ->addColumn('product_image', function($data){
                    if($data->image != "upload/images/product/ ") {
                        $product_image = '<div class="product_image">
                                            <img src="'.url('/'.$data->image).'"/>
                                        </div>';
                    } else {
                        $product_image = '<div class="product_image">
                                            <img src="'.asset('upload/images/product/main-logo.png').'"/>
                                        </div>';
                    }

                    return $product_image;
                })
                ->addColumn('created_at', function($data){
                    $created_at = '<div class="label_date">
                                            <div>'.$data->created_at->diffForHumans().'</div>
                                        </div>';
                    return $created_at;
                })
                # render
                ->addColumn('created_by', function($data){
                    if($data->user_id == Auth::user()->id) {
                        $created_by = '<div class="label_created_by me">
                                            <div>Me</div>
                                        </div>';
                        return $created_by;
                    } else {
                        $created_by = '<div class="label_created_by">
                                            <div>'.$data->created_by.'</div>
                                        </div>';
                        return $created_by;
                    }

                })

                ->rawColumns(['actions','checkbox', 'product_image', 'created_at', 'created_by'])

                ->make(true);
    }
    # edit
    public function edit($id) {
        // DB::table('product_photos')->where('product_id', $id)->delete();
        $p_data = [];
        $p_data['url'] = 'edit product';
        $p_data['categories'] = Category::all();
        $p_data['galleries'] = DB::table('product_photos')->where('product_id', $id)->get();
        $p_data['product'] = $this->product_model->findOrfail($id);
        return view('dashboard.product.edit', $p_data);
    }
    # update
    public function update(ProductRequest $request, $id)
    {
        $product_data = $this->product_model::findOrfail($id);
        # single image
        $file_name = " ";
        if($request->hasfile('image')) {
            $single_image = $request->file('image');
            $file_name = time().rand(1,100).'.'.$single_image->extension();
            if($product_data->image != '') {
                unlink($product_data->image);
            }
            $single_image->move(public_path('upload/images/product'), $file_name);
        }
        # multiple image
        $multiple_image = [];
        if($request->hasfile('image_gallery')) {
            foreach($request->file('image_gallery') as $file)
            {
                $name = time().rand(1,100).'.'.$file->extension();
                $galleries = DB::table('product_photos')->where('product_id', $id)->get();
                foreach($galleries as $gallery) {
                    unlink($gallery->image);
                }
                $file->move(public_path('upload/images/product/gallery'), $name);
                $multiple_image[] = $name;
            }
        }
        $product_id = Helper::IDGenerator($this->product_model, 'product_id', 4, 'PRO'); /** Generate id */

        $product_data->code             = $request->code;
        $product_data->name             = $request->name;
        $product_data->category_id      = $request->category_id;
        $product_data->weight           = $request->weight ? $request->weight : 0;
        $product_data->cost             = $request->cost ? $request->cost : 0;
        $product_data->price            = $request->price;
        $product_data->quantity_alert   = $request->quantity_alert ? $request->quantity_alert : 0;
        $product_data->quantity         = $request->quantity ? $request->quantity : 0;
        $product_data->image            = 'upload/images/product/'.$file_name;
        $product_data->details          = $request->product_details ? $request->product_details : '';
        $product_data->created_by       = Auth::user()->id;
        $product_data->product_id       = $product_id;
        $count = count($multiple_image);
        $gallery_data = [];
        $q = $product_data->save();
        $galleries = $request->file('image_gallery');
        if ($q) {

            for($i = 0 ; $i < $count; $i++) {
                $gallery_data[] = [
                    'product_id'    => $product_data->id,
                    'image'         => 'upload/images/product/gallery/'.$multiple_image[$i]
                ];
            }
            if(DB::table('product_photos')->where('product_id', $id)->delete()) {
                DB::table('product_photos')->insert($gallery_data);
            }
            Session::flash('success', 'Product updated successfully');
            return redirect(route('product.index'));
        }
        else {
            return back()->with('fail', 'Something went wrong');
        }
    }
    # click delete product
    public function click_delete(Request $request){
        if(request()->ajax()) {
            $product_data = [];
            $array_id = [];
            $id = $request->product_id;
            $this->product_model->delete_product_images($array_id, $id);
            if($this->product_model::where('id', $id)->delete()) {
                return response()->json(['icon' => 'success', 'success' => 1, 'msg' => 'Product deleted successfully']);
            }
        }
    }
    # delete product checked
    public function checked_delete(Request $request){
        if(request()->ajax()) {
            $p_data = [];
            $single_image = [];
            if(!empty($request->post('item_id'))) {
                $product_id = $request->post('item_id');
                $array_id = [];
                foreach($product_id as $id) {
                    array_push($array_id, $id);
                }
                $this->product_model->delete_product_images($array_id, $single_image);
                if($this->product_model::whereIn('id', $array_id)->delete()) {
                    $count_product = count($product_id);
                    $product_label = '';
                    if($count_product <= 1) {
                        $product_label = ($count_product) .' Product';
                    } else {
                        $product_label = ($count_product) .' Products';
                    }
                    $p_data['icon'] = 'success';
                    $p_data['status'] = $product_label.' deleted successfully';
                    $p_data['status_text'] = $product_label.' selected has been removed';
                    return response()->json($p_data);
                }
            } else {
                $p_data['icon'] = 'warning';
                $p_data['status'] = 'No selected';
                $p_data['status_text'] = 'Please selected atleast any rows';
                return response()->json($p_data);
            }
        }
    }

    # modal add product gallery
    public function modal_add_gallery(Request $request) {
        if(request()->ajax()) {
            $modal = [];
            $p_data = [];
            $product_id = $request->product_id;
            $p_data['modal_title'] = 'Add Product Gallery';
            $p_data['product'] = $this->product_model::where('id', $product_id)->first();

            $modal = [
                'modal' =>  view('dashboard.product.modal_add_gallery', $p_data)->render(),
            ];

            return response()->json($modal);
        }
    }
    # change product gallery --> if product has multiple images or photos
    public function change_gallery(ProductRequest $request) {
        if(request()->ajax()) {
            $data_error = [];
            $validator = Validator::make($request->all(),[
                'single_image'=>'required|image'
            ],[
                'image_gallery.required'=>'Product image is required',
                'image_gallery.image'=>'Product Gallery images file must be an image',
            ]);

            if(!$validator->passes()){
                $data_error['error'] = 'fail';
                $data_error['get_error'] = $validator->errors()->toArray();
                return response()->json($data_error);
            }else{
                $data_file = [];
                $user_id = $request->post('user_id');
                $user = $user = DB::table('users')->where('id', $user_id)->first();
                if ($request->hasFile('user_image')) {
                    $file = $request->file('user_image');
                    $file_name = $user->name .'_'.time().'_'.$file->getClientOriginalName();
                    if($user->avatar != '') {
                        unlink($user->avatar);
                    }
                    $file->move(public_path('upload/images/user'), $file_name);
                    $data_file = $file_name;
                }

                $data = [
                    'avatar' => 'upload/images/user/'.$data_file,
                ];
                if(DB::table('users')->where('id', $user_id)->update($data)) {
                    $data_error['error'] = 'success';
                    $data_error['get_error'] = 'User Avatar updated successfully';
                    return response()->json($data_error);
                } else {
                    $data_error['error'] = 'not success';
                    $data_error['get_error'] = 'Something went wrong!';
                    return response()->json($data_error);
                }
            }
        }
    }


    # modal View Product
    public function modal_view_product(Request $request) {
        if(request()->ajax()) {
            $product_id = $request->product_id;
            $p_data['modal_title'] = 'View Product';
            $p_data['product'] = $this->product_model::where('id', $product_id)->first();

            $modal = [
                'modal' =>  view('dashboard.product.modal_view_product', $p_data)->render(),
            ];

            return response()->json($modal);
        }
    }
    public function export_excel(Request $request) {
        return Excel::download(new ProductsExport, 'products.xlsx');
        // if(request()->ajax()) {
        //     if(!empty($request->post('item_id'))) {
        //         $product_id = $request->post('item_id');
        //         $array_id = [];
        //         foreach($product_id as $id) {
        //             array_push($array_id, $id);
        //         }
        //         $products = $this->product_model::whereIn('id', $array_id)->get();
        //         return Excel::download(new ProductsExport, 'users.xlsx');
        //         // $this->data['products'] = $products;
        //         // return response()->json($this->data);
        //     }  else {
        //         $this->data['icon'] = 'warning';
        //         $this->data['status'] = 'No selected';
        //         $this->data['status_text'] = 'Please selected atleast any rows';
        //         return response()->json($this->data);
        //     }

        // }
    }
    public function generatePDF(Request $request)
    {
        if(!empty($request->post('item_id'))) {
            $product_id = $request->post('item_id');
            $array_id = [];
            foreach($product_id as $id) {
                array_push($array_id, $id);
            }
            $products = $this->product_model::whereIn('id', $array_id)->get();
            // view()->share('products',$products);
            $pdf = PDF::loadView('dashboard.product.pdf', $products);
            return $pdf->download('products.pdf');
        } else {
            return back()->with('fail', 'lang.no_product_selected');
        }
    }
    public function actions(Request $request) {
        if($request->post('item_id')) {
            $product_id = $request->post('item_id');
            $array_id = [];
            foreach($product_id as $id) {
                array_push($array_id, $id);
            }
            $products = $this->product_model::whereIn('id', $array_id)->get();
            view()->share('products',$products);
            $pdf = PDF::loadView('dashboard.product.pdf', $products);
            return $pdf->download('products.pdf', $products);
        }else {
            return back()->with('fail', 'lang.no_product_selected');
        }
    }
}
