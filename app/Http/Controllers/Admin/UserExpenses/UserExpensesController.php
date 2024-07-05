<?php

namespace App\Http\Controllers\Admin\UserExpenses;

use App\Http\Controllers\Controller;
use App\Models\Expenses;
use Illuminate\Http\Request;

class UserExpensesController extends Controller
{
    public function index()
    {
        $expenses = Expenses::paginate();
        return view('pages.users_expenses.index', compact('expenses'));
    }
}
