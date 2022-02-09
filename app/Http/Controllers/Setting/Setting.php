<?php

namespace App\Http\Controllers\Setting;

use DataTables;
use Illuminate\Http\Request;
use App\Models\Settings\Settings;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Table\TableRequest;
use Illuminate\Support\Facades\Validator;


class Setting extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function table_index()
    {
        $this->data['url'] = 'tables';
        return view('dashboard.table.index', $this->data);
    }
     /**
     * Display the specified resource.
     *
     * @param  \App\Models\Settings\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function list_table(Settings $settings)
    {
        $tables = DB::table('table')->get();
        return DataTables::of($tables)
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
            
                ->rawColumns(['actions'])

                ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }
    # avatar modal
    public function create_table(Request $request) {
        if(request()->ajax()) {
            $modal_data['modal_title'] = __('lang.add_table');
            $modal['modal'] = view('dashboard.table.add', $modal_data)->render();
            return response()->json($modal);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_table(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'code'=>'required',
            'name'=>'required',
        ],[
            'code.required'=>'Table is required',
            'name.required'=>'Table name is required',
        ]);
        if(!$validator->passes()){
            $data_error['error'] = 'fail';
            $data_error['get_error'] = $validator->errors()->toArray();
            return response()->json($data_error);
        } else {
            $data = [
                'code' => $request->code,
                'name' => $request->name,
            ];
            if(DB::table('table')->insert($data)) {
                $data_error['error'] = 'success';
                $data_error['get_error'] = 'Table Added successfully';
                return response()->json($data_error);
            } else {
                $data_error['error'] = 'not success';
                $data_error['get_error'] = 'Something went wrong!';
                return response()->json($data_error);
            }
        }
        
    }

    public function getTableById(Request $request) {
        if(request()->ajax()) {
            $table_id = $request->table_id;
            $this->data['table'] = DB::table('table')->where('id', $table_id)->first();
            return response()->json($this->data);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Settings\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function edit(Settings $settings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Settings\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Settings $settings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Settings\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Settings $settings)
    {
        //
    }
}
