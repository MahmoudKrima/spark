@extends('layouts.app')
@section('title', 'Edit Profile')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header" style="background-color: #1e5e34 ; border:none;color:white">
                            <h3 class="card-title">Edit Profile</h3>
                        </div>
                        <form method="POST" action="{{ route('admin.update_profile') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputName">Name</label>
                                    <input type="text" value="{{ auth()->user()->name }}" name="name"
                                        class="form-control" id="exampleInputName" placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail">Email</label>
                                    <input type="email" value="{{ auth()->user()->email }}" name="email"
                                        class="form-control" id="exampleInputEmail" placeholder="Enter Email">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputPassword">Password</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword"
                                        placeholder="Enter Password">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" style="background-color: #1e5e34 ; border:none;color:white">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
