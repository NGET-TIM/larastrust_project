<?php

namespace App\Http\Controllers\Purchase;

use Illuminate\Http\Request;
use App\Models\Purchase\Purchases;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Purchase\Purchase;

class Purchase extends Controller
{


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
        $this->data['users'][] = [
            'id' => 1,
            'data' => [
                'name' => 'Nget Tim',
                'age' => 25,
            ]
        ];
        $this->data['url'] = 'add purchase';
        $this->data['sql'] = DB::select('select * from tim_products');
        // dd($this->data['sql']);
        return view('dashboard.purchase.add', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        

        $validator = Validator::make($request->all(),[
            'date' => 'required',
        ]);
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $items = [];
            $data = [
                'reference_no' => $request->reference_no,
            ];
            # purchases items
            $count = sizeof(($request->product_id ? $request->product_id : []));
            for($i = 0; $i < $count; $i++) {
                $items[] = [
                    'product_id' => $request->product_id[$i],
                ];
            }
            if(count($items) <= 0) {
                return back()->with('error', __('lang.no_items'));
            } else {
                return back()->with('success', __('lang.purchase_added') .' - '.$count . ($count > 1 ? ' Items' : 'Item'));
            }
            
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
