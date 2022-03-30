<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Product\Products;
use App\Models\Category\Category;
use App\Models\Purchase\Purchases;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\User;
class Controller extends BaseController
{
    protected $purchase_model;
    protected $product_model;
    protected $category_model;
    protected $data;
    protected $tim;
    protected $user_model;
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {
        $this->purchase_model = new Purchases();
        $this->product_model = new Products();
        $this->category_model = new Category();
        $this->tim = new Helper();
        $this->user_model = new User();
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
