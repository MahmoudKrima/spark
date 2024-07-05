<?php

namespace App\Http\Controllers\Api\Investment;

use Carbon\Carbon;
use App\Models\Category;
use App\Models\Expenses;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\DailyExpenseRequest;
use App\Http\Requests\Api\Investment\InvetmentInfo;
use App\Http\Resources\Api\Investment\InvetmentInfoResource;
use App\Http\Resources\UserExpenseResource;
use App\Models\UserDetails;

class InvetmentController extends Controller
{
    function invetmentInfo(InvetmentInfo $request)
    {
        $data = $request->validated();
        $data['user_id']=auth()->user()->id;
        $user_details=UserDetails::create($data);
        return ApiResponseTrait::apiResponse(new InvetmentInfoResource($user_details), 'Get Data Successfully');
    }

    function dailyExspense(DailyExpenseRequest $request)
    {
        $data = $request->validated();
        $expense = Expenses::where('user_id', auth()->user()->id)->where('day', $data['day'])->first();
        if ($expense) {
            return ApiResponseTrait::apiResponse([], 'Expenses For This Day Has Been Set');
        } else {
            $expense = Expenses::create([
                'user_id' => auth()->user()->id,
                'day' => $data['day'],
                'expenses' => $data['expense'],
                'category_id' => $data['category_id'],
            ]);
            return ApiResponseTrait::apiResponse($expense, 'Create Data Successfully');
        }
    }

    function allCategores(){
        $categories =Category::all();
        return ApiResponseTrait::apiResponse($categories, 'Get Data Successfully');
    }

    function getUserExpenses()
    {
        $expenses = Expenses::where('user_id', auth()->user()->id)->get();
        return ApiResponseTrait::apiResponse(UserExpenseResource::collection($expenses), 'Get Data Successfully');
    }

    public function expensesStatics()
    {
        $userId = auth()->user()->id;

        $expenses = DB::table('expenses')
            ->join('categories', 'expenses.category_id', '=', 'categories.id')
            ->select(
                'categories.name as category_name',
                DB::raw('SUM(expenses.expenses) as total_expense'),
                DB::raw('YEAR(expenses.created_at) as year'),
                DB::raw('MONTH(expenses.created_at) as month')
            )
            ->where('expenses.user_id', $userId)
            ->groupBy('categories.name', 'year', 'month')
            ->get();

        $formattedExpenses = $expenses->map(function ($expense) {
            return [
                'category-name' => $expense->category_name,
                'total-expense' => $expense->total_expense,
                'month' => sprintf('%04d-%02d', $expense->year, $expense->month),
            ];
        });

        return response()->json($formattedExpenses);
    }
}
