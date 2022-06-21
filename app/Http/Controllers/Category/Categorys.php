<?php

namespace App\Http\Controllers\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Category\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Category\CategoryRequest;

class Categorys extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $c_data = [];
        $c_data['url'] = 'categories';
        return view('dashboard.category.index', $c_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $c_data = [];
        $c_data['url'] = 'add category';
        return view('dashboard.category.add', $c_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        if (Category::create($request->validated())) {
            return back()->with('success', 'Category added successfully');
        }
        else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $model
     * @return \Illuminate\Http\Response
     */
    public function show() {
        $category_list = Category::all();
        return DataTables::of($category_list)
                ->addIndexColumn()
                ->addColumn('actions', function($data) {
                    $link_1 = '<i class="fa fa-edit"></i> Edit Category';
                    $link_2 = '<i class="fa fa-trash"></i> Delete';
                    $action =
                        '<div class="text-center dropdown role_actions"><div class="btn-group dropleft text-left">'
                            . '<button class="btn btn-xs btn_logo dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                            <div class="dropdown-menu pull-right" role="menu">
                                <a href="'.url('admin/category/'.$data->id.'/edit').'" class="dropdown-item edit_role" data-id="'.$data->id.'">' . $link_1 . '</a>
                                <a href="'.url('admin/category/'.$data->id.'/delete').'" class="dropdown-item delete_category" data-id="'.$data->id.'">' . $link_2 . '</a>
                            </div>
                        </div>';

                    return $action;
                })
                ->rawColumns(['actions','checkbox'])
                ->make(true);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\odel  $model
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $model, $id)
    {
        $c_data = [];
        $c_data['url'] = 'edit category';
        $c_data['category'] = $model->findOrfail($id);
        return view('dashboard.category.edit', $c_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $model
     * @return \Illuminate\Http\Response
     */
    public function update_old(Request $request, Category $model, $id)
    {
        $category = $model->findOrfail($id);
        if($category->code != $request->code) {
            $validator = Validator::make($request->all(),[
                'code'  =>  'required|unique:categories,code',
            ],[
                'code.required'=>'Category code is required',
                'code.unique'=>'Category code is already existing',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
        }else if($category->name != $request->name) {
            $validator = Validator::make($request->all(),[
                'name'  =>  'required|unique:categories,name',
            ],[
                'name.required'=>'Category name is required',
                'name.unique'=>'Category name is already existing',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
        }
        $category_data = [
            'code' => $request->code,
            'name' => $request->name,
        ];
        if ($category->update($category_data)) {
            Session::flash('success', 'Category update successfully');
            return redirect(route('category.index'));
        }
        else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    public function update(Request $request, Category $model, $id)
    {
        $category = $model->findOrfail($id);
        if($category->code != $request->code) {
            $validator = Validator::make($request->all(),[
                'code'  =>  'required|unique:categories,code',
            ],[
                'code.required'=>'Category code is required',
                'code.unique'=>'Category code is already existing',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
        }else if($category->name != $request->name) {
            $validator = Validator::make($request->all(),[
                'name'  =>  'required|unique:categories,name',
            ],[
                'name.required'=>'Category name is required',
                'name.unique'=>'Category name is already existing',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
        }
        if ($category->update($request->all())) {
            Session::flash('success', __('lang.Category update successfully'). ' ' . $request->name);
            return redirect(route('category.index'));
        }
        else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $model
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $model, $id)
    {
        $category = $model->findOrfail($id);
        if ($category->destroy($id)) {
            Session::flash('success', 'Category delete successfully');
            return redirect(route('category.index'));
        }
        else {
            return back()->with('fail', 'Something went wrong');
        }
    }
    # delete categories checked
    public function checked_delete(Request $request){
        if(request()->ajax()) {
            if(!empty($request->post('item_id'))) {
                $category_id = $request->post('item_id');
                $array_id = [];
                foreach($category_id as $id) {
                    array_push($array_id, $id);
                }
                if(Category::whereIn('id', $array_id)->delete()) {
                    $data['icon'] = 'success';
                    $data['status'] = 'Categories deleted successfully';
                    $data['status_text'] = 'Categories selected has been removed';
                    return response()->json($data);
                }
            } else {
                $data['icon'] = 'warning';
                $data['status'] = 'No selected';
                $data['status_text'] = 'Please selected atleast any rows';
                return response()->json($data);
            }
        }
    }

    public function modal() {

        $modal['modal'] = view('dashboard.category.modal')->render();
        return response()->json($modal);
    }
}
