<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index() {
        $data = [];
        $data['url'] = 'Dashboard';
        return view('dashboard.index', $data);
    }
}
