@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Today's Sales</h5>
                                        <p class="card-text">{{ $todaySales }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Yesterday's Sales</h5>
                                        <p class="card-text">{{ $yesterdaySales }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">This Month's Sales</h5>
                                        <p class="card-text">{{ $thisMonthSales }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Last Month's Sales</h5>
                                        <p class="card-text">{{ $lastMonthSales }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>
                        <a href="{{ url('/product/create') }}" class="btn btn-primary">Insert Products</a><br><br>
                        <a href="{{ url('/transactions') }}" class="btn btn-secondary">Transactions</a><br><br>
                        <a href="{{ url('/sales-history') }}" class="btn btn-primary">Sales History</a><br><br>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
