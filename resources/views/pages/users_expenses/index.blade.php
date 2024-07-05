@extends('layouts.app')
@section('title', 'User Expenses')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #1e5e34 ; border:none;color:white">
                            <h3 class="card-title">User Expenses</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>UserName</th>
                                        <th>Category</th>
                                        <th>Day</th>
                                        <th>Expenses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($expenses as $expense)
                                        <tr>
                                            <td>{{ $expense->id }}</td>
                                            <td>{{ $expense->user->name }}</td>
                                            <td>{{ $expense->category->name }}</td>
                                            <td>{{ $expense->day }}</td>
                                            <td>{{ $expense->expenses }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            {{ $expenses->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
