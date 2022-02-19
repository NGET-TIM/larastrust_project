<?php

namespace App\Http\Controllers\Pos;

use Illuminate\Http\Request;
use App\Models\Pos\Pos_Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pos\PosRequest;
use Illuminate\Support\Facades\Response;

class Pos extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['url'] = 'add pos';
        $this->data['tables'] = DB::table('table')->get();
        $this->data['tim'] = $this->tim::formatMoney(1235.65);
        $this->data['products'] = $this->product_model->paginate(config('product.paginate'));
        return view('dashboard.pos.add', $this->data);
    }
    public function ajax_get_product(Request $request) {
        if(request()->ajax()) {
            $page = $request->page;
            session(['page_number' => $request->page]);
            $this->data['products'] = $this->product_model->paginate(config('product.paginate'));
            $this->data['html'] = view('dashboard.product.view_page', $this->data)->render();
            return response()->json($this->data);
            // return view('dashboard.product.view_page', $this->data)->render();
        }
    }
    public function suggestions(Request $request) {
        if(request()->ajax()) {
            $term = $request->get('term');
            $supplier_id = $request->get('supplier_id');
            $products = $this->product_model->where('name','LIKE','%'.$term.'%')->orWhere('code','LIKE','%'.$term.'%')->limit(10)->get();
            if($products) {
                $r = time().rand(1,100);
                $i = 0;
                foreach($products as $row) {
                    // $category = $this->category_model->findOrfail($row->category_id);
                    $category = DB::table('categories')->where('id', $row->category_id)->first();
                    $row->category_name = $category;
                    $row->qty = 1;
                    $products[] = [
                        'id'        => ($r + $i),
                        'item_id'   => $row->id, 
                        'label'     => $row->name . " (" . $row->code . ")",
                        'row'       => $row
                    ];
                    $i++;
                }
                return Response::json($products);
            } else {
                $error[] = [
                    'id' => 0, 
                    'label' => 'No matching result found! Product might be out of stock in the selected warehouse !', 
                    'value' => $term
                ];
                return Response::json($error);
            }
        }
    }
    public function suggestions_ByClickProduct(Request $request) {
        if(request()->ajax()) {
            $product_id = $request->get('product_id');
            $row = $this->product_model::findOrfail($product_id);
            if($row) {
                $r = time().rand(1,100);
                $i = 0;
                $category = $this->category_model::findOrfail($row->category_id);
                // $category = DB::table('categories')->where('id', $row->category_id)->first();
                $row->category = $category;
                $row->qty = 1;
                $item = [
                    'id'        => ($r + $i),
                    'item_id'   => $row->id, 
                    'label'     => $row->name . " (" . $row->code . ")",
                    'row'       => $row
                ];
                $i++;
                return Response::json($item);
            } else {
                $error[] = [
                    'id' => 0, 
                    'label' => 'No matching result found! Product might be out of stock in the selected warehouse !', 
                    'value' => $product_id
                ];
                return Response::json($error);
            }
        }
    }
    public function show_table(Request $request) {
        if(request()->ajax()) {
            $modal_data['modal_title'] = __('lang.table');
            $modal_data['tables'] = DB::table('table')->get();
            $modal['modal'] = view('dashboard.pos.modal_table', $modal_data)->render();
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
        
        $this->data['customer'] = $request->customer;
        if (!empty($request->customer)) {
            $data = [
                'customer_id' => $request->customer,
                'reference_no' => "POS/Reference",
                'table_id' => $request->select_table,
                'grand_total' => 250,
                'created_at' => $request->date,
                'updated_at' => $request->date,
            ];
            if(DB::table('suspend')->insert($data)) {
                return back()->with('success', 'sale added successfully');
            }
        } 
        else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pos\Pos_Model  $pos_Model
     * @return \Illuminate\Http\Response
     */
    public function show(Pos_Model $pos_Model)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pos\Pos_Model  $pos_Model
     * @return \Illuminate\Http\Response
     */
    public function edit(Pos_Model $pos_Model)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pos\Pos_Model  $pos_Model
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pos_Model $pos_Model)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pos\Pos_Model  $pos_Model
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pos_Model $pos_Model)
    {
        //
    }
}
