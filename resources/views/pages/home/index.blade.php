@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-grey">
                        <div class="inner">
                            <h3>{{ $usersCount }}</h3>
                            <p>Users</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
