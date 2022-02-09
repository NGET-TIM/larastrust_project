<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Product\Products;
use App\Models\Category\Category;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    protected $product_model;
    protected $category_model;
    protected $data;
    protected $tim;
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {
        $this->product_model = new Products();
        $this->category_model = new Category();
        $this->tim = new Helper();
    }
    # languages
    public function switchLang($lang)
    {
        if (array_key_exists($lang, Config::get('languages'))) {
            Session::put('applocale', $lang);
        }
        return Redirect::back();
    }
}
