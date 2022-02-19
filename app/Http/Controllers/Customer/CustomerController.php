<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['url'] = 'customers';
        return view('dashboard.customer.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     # modal add customer
     public function create() {
        if(request()->ajax()) {
            $this->data['modal_title'] = 'Add Customer';
            $modal = [
                'modal' =>  view('dashboard.customer.add', $this->data)->render(),
            ];
            return response()->json($modal);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        $customers = $customer::all();
        return DataTables::of($customers)
                ->addIndexColumn()
                ->addColumn('actions', function($data) {
                    $link_1 = '<i class="fa fa-edit"></i> Edit Product';
                    $link_2 = '<i class="fa fa-images"></i> Add Product Gallery';
                    $link_3 = '<i class="fa fa-trash"></i> Delete';
                    if(Auth::user()->hasRole(['supper-admin', 'admin'])) {
                        $delete_link = '<a href="'.url('admin/customer/'.$data->id.'/delete').'" class="dropdown-item delete_customer" data-id="'.$data->id.'">' . $link_3 . '</a>';
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
                ->rawColumns(['actions'])

                ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
