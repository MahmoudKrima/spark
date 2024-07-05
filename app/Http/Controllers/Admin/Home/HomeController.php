<?php

namespace App\Http\Controllers\Admin\Home;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\User;

class HomeController extends Controller
{
    public function home()
    {
        $usersCount = User::where('role', 'user')
            ->count();
        return view('pages.home.index', compact('usersCount'));
    }
}
