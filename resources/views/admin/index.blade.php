@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    @include('admin.layouts.sidebar')
    <div class="col-md-9 col-lg-10">
        <div class="row mt-2 g-3"> <!-- Added g-3 for consistent spacing -->
            <div class="col-md-12">
                <div class="card-header bg-white">
                    <h3 class="mt-2">Dashboard</h3>
                    <hr>
                </div>
                <div class="card-body">
                    <div class="row">

                        <!-- Today's Orders -->
                        <div class="col-12 col-md-6 mb-4">
                            <div class="card shadow-sm h-100">
                                <div class="card-header bg-white">
                                    <div class="d-flex justify-content-between">
                                        <span class="badge bg-dark">Today's Orders</span>
                                        <span class="badge bg-dark">{{ $todayOrders->count() }}</span>
                                    </div>
                                </div>
                                <div class="card-footer text-center bg-white">
                                    <strong>${{ $todayOrders->sum('total') }}</strong>
                                </div>
                            </div>
                        </div>

                        <!-- Yesterday's Orders -->
                        <div class="col-12 col-md-6 mb-4">
                            <div class="card shadow-sm h-100">
                                <div class="card-header bg-white">
                                    <div class="d-flex justify-content-between">
                                        <span class="badge bg-primary">Yesterday's Orders</span>
                                        <span class="badge bg-primary">{{ $yesterdayOrders->count() }}</span>
                                    </div>
                                </div>
                                <div class="card-footer text-center bg-white">
                                    <strong>${{ $yesterdayOrders->sum('total') }}</strong>
                                </div>
                            </div>
                        </div>

                        <!-- This Month's Orders -->
                        <div class="col-12 col-md-6 mb-4">
                            <div class="card shadow-sm h-100">
                                <div class="card-header bg-white">
                                    <div class="d-flex justify-content-between">
                                        <span class="badge bg-danger">This Month Orders</span>
                                        <span class="badge bg-danger">{{ $monthOrders->count() }}</span>
                                    </div>
                                </div>
                                <div class="card-footer text-center bg-white">
                                    <strong>${{ $monthOrders->sum('total') }}</strong>
                                </div>
                            </div>
                        </div>

                        <!-- This Year's Orders -->
                        <div class="col-12 col-md-6 mb-4">
                            <div class="card shadow-sm h-100">
                                <div class="card-header bg-white">
                                    <div class="d-flex justify-content-between">
                                        <span class="badge bg-success">This Year Orders</span>
                                        <span class="badge bg-success">{{ $yearOrders->count() }}</span>
                                    </div>
                                </div>
                                <div class="card-footer text-center bg-white">
                                    <strong>${{ $yearOrders->sum('total') }}</strong>
                                </div>
                            </div>
                        </div>

                    </div> <!-- End row -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
