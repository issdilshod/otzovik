<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function index(Request $request)
    {
        $data['title'] = __('dashboard_title');

        return view('admin.pages.dashboard', $data);
    }

}
