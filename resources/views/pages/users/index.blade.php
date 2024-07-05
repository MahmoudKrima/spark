@extends('layouts.app')
@section('title', 'Users')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th style="width: 40px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <!-- Show Details Button -->
                                            <button class="btn btn-warning" style="margin-left: 10px; background-color: #1e5e34 ; border:none; color:white" data-toggle="modal" data-target="#userDetailsModal{{ $user->id }}">Show</button>

                                            <!-- Edit Button -->
                                            <a class="btn btn-warning" style="margin-left: 10px; background-color: #1e5e34 ; border:none; color:white" href="{{ route('users.edit', $user->id) }}">Edit</a>

                                            <!-- Delete Form -->
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="margin-left: 10px;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-delete">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- User Details Modal -->
                                <div class="modal fade" id="userDetailsModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="userDetailsModalLabel{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="userDetailsModalLabel{{ $user->id }}">User Details</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Age:</strong> {{ $user->details?->age }}</p>
                                                <p><strong>Education Level:</strong> {{ $user->details?->edu_level }}</p>
                                                <p><strong>Marital Status:</strong> {{ $user->details?->married == 1 ? 'Married' : 'Not Married' }}</p>
                                                <p><strong>Kids:</strong> {{ $user->details?->kids }}</p>
                                                <p><strong>Life Stage:</strong> {{ $user->details?->life_stage }}</p>
                                                <p><strong>Occupation Category:</strong> {{ $user->details?->occu_category }}</p>
                                                <p><strong>Income:</strong> {{ $user->details?->income }}</p>
                                                <p><strong>Risk:</strong> {{ $user->details?->risk == 1 ? 'Riskable' : 'Unriskable' }}</p>
                                                <p><strong>Eager:</strong> {{ $user->details?->eager == 1 ? 'Eager' : 'Not Eager' }}</p>
                                                <p><strong>Investment Amount:</strong> {{ $user->details?->investment_amount }}</p>
                                                <p><strong>End Date:</strong> {{ $user->details?->end_date }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
