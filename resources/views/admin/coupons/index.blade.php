@extends('admin.layouts.app')

@section('title')
    Coupons
@endsection

@section('content')
    <div class="row">
        @include('admin.layouts.sidebar')
        <div class="col-md-9 col-lg-10">
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h3 class="mt-2">Coupons ({{$coupons->count()}})</h3>
                        <a href="{{route('admin.coupons.create')}}" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                    <hr>
                    <div class="card-body">
                        <table class="table table-striped table-bordered text-center align-middle">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col" class="text-center">Name</th>
                                    <th scope="col"class="text-center">Discount</th>
                                    <th scope="col"class="text-center">Validity</th>
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $key => $coupon)
                                    <tr>
                                        <td class="text-center">{{$key + 1}}</td>
                                        <td>{{$coupon->name}}</td>
                                        <td class="text-center">{{$coupon->discount}}</td>
                                        <td>
                                            @if ($coupon->checkIFValid())
                                                <span class="badge bg-success text-white p-2">
                                                    Valid until {{\Carbon\Carbon::parse($coupon->valid_until)->diffForHumans()}}
                                                </span>
                                            @else
                                                <span class="badge bg-danger text-white p-2">
                                                    Expired
                                                </span>
                                            @endif
                                        </td>
                                        <td class="d-flex justify-content-center">
                                            <a href="{{route('admin.coupons.edit', $coupon->id)}}" class="btn btn-sm btn-warning mx-1">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" onclick="deleteItem({{$coupon->id}})" class="btn btn-sm btn-danger mx-1">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <form id="{{$coupon->id}}" action="{{route('admin.coupons.destroy', $coupon->id)}}" method="post" style="display: none;">
                                                @csrf
                                                @method('Delete')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
