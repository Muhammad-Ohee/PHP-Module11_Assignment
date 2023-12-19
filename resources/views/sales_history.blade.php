@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Sale Transaction History') }}</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Quantity Sold</th>
                                    <th scope="col">Total Amount</th>
                                    <th scope="col">Transaction Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales as $sale)
                                    <tr>
                                        <td>{{ $sale->product_name }}</td>
                                        <td>{{ $sale->quantity_sold }}</td>
                                        <td>{{ $sale->total_amount }}</td>
                                        <td>{{ $sale->transaction_date }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <a href="{{ url('/dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
