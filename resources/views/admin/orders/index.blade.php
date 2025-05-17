@extends('admin.layouts.app')

@section('title')
   Orders
@endsection

@section('content')
    <div class="row">
        @include('admin.layouts.sidebar')
        <div class="col-md-9 col-lg-10">
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h3 class="mt-2">Orders({{$orders->count()}})</h3>

                    </div>
                    <hr>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">#</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Product Price</th>
                                    <th scope="col" class="text-center">Qty</th>
                                    <th scope="col" class="text-center">Total</th>
                                    <th scope="col" class="text-center">Coupon</th>
                                    <th scope="col" class="text-center">By</th>
                                    <th scope="col" class="text-center">Done</th>
                                    <th scope="col" class="text-center">Delivered</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $key => $order)
                                    <tr>
                                        <td scope="col" class="text-center">{{$key +=1}}</td>
                                        <td scope="col">
                                            <div class="d-flex flex-column" class="text-center">
                                                @foreach ($order->products as $product)
                                                    {{ $product->name }}
                                                @endforeach
                                            </div>
                                        </td>
                                        <td scope="col">
                                            <div class="d-flex flex-column text-center">
                                                @foreach ($order->products as $product)
                                                    {{ $product->price }}
                                                @endforeach
                                            </div>
                                        </td>
                                        <td scope="col" class="text-center">
                                            <div class="d-flex flex-column">
                                                {{ $order->qty }}
                                            </div>
                                        </td>
                                        <td scope="col" class="text-center">
                                                {{ $order->total }}
                                        </td>
                                        <td class="text-center">
                                            @if ($order->coupon()->exists())
                                                <span class="badge bg-success text-center">
                                                    {{ $order->coupon->name }}
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    N/A
                                                </span>
                                            @endif
                                        </td>

                                        <td scope="col" class="text-center">
                                            {{$order->user->name}}
                                        </td>
                                        <td scope="col">
                                            {{ $order->created_at  }}
                                        </td>
                                        <td scope="col" class="text-center">
                                            @if ($order->delivered_at)
                                            <span class="badge bg-success">
                                                {{ \Carbon\Carbon::parse($order->delivered_at)->diffForHumans() }}
                                            </span>
                                        @else
                                                <a href="{{route('admin.orders.update',$order->id)}}"class="btn btn-sm btn-primary" >
                                                    <i class="fas fa-truck"></i>Confirm Delivery
                                                </a>
                                        @endif
                                        </td>
                                        <td class="text-center">
                                             <a href="#" onclick="deleteItem({{$order->id}})" class="btn btn-sm btn-danger">
                                                   <i class="fas fa-trash"></i>
                                            </a>
                                            <form id="{{$order->id}}" action="{{route('admin.orders.delete',$order->id)}}" method="post">
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
