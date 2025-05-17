@extends('admin.layouts.app')

@section('title')
    Products
@endsection

@section('content')
    <div class="row">
        @include('admin.layouts.sidebar')
        <div class="col-md-9 col-lg-10">
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h3 class="mt-2">Products ({{$products->count()}})</h3>
                        <a href="{{route('admin.products.create')}}" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                    <hr>
                    <div class="card-body">
                        <table class="table table-striped table-bordered text-center align-middle">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col"class="text-center">Name</th>
                                    <th scope="col"class="text-center">Colors</th>
                                    <th scope="col"class="text-center">Sizes</th>
                                    <th scope="col"class="text-center">Qty</th>
                                    <th scope="col"class="text-center">Price</th>
                                    <th scope="col"class="text-center">Images</th>
                                    <th scope="col"class="text-center">Status</th>
                                    <th scope="col"class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $product)
                                    <tr>
                                        <td class="text-center">{{$key + 1}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>
                                            @foreach ($product->colors as $color)
                                                <span class="badge bg-light text-dark">{{$color->name}}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($product->sizes as $size)
                                                <span class="badge bg-light text-dark">{{$size->name}}</span>
                                            @endforeach
                                        </td>
                                        <td class="text-center">{{$product->qty}}</td>
                                        <td class="text-center">{{$product->price}}</td>
                                        <td>
                                            <div class="d-flex flex-wrap justify-content-center">
                                                <img src="{{asset($product->thumbnail)}}" alt="{{$product->name}}" class="img-fluid rounded m-1" width="50" height="50">
                                                @if($product->first_image)
                                                    <img src="{{asset($product->first_image)}}" alt="{{$product->name}}" class="img-fluid rounded m-1" width="50" height="50">
                                                @endif
                                                @if($product->second_image)
                                                    <img src="{{asset($product->second_image)}}" alt="{{$product->name}}" class="img-fluid rounded m-1" width="50" height="50">
                                                @endif
                                                @if($product->third_image)
                                                    <img src="{{asset($product->third_image)}}" alt="{{$product->name}}" class="img-fluid rounded m-1" width="50" height="50">
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            @if($product->status)
                                                <span class="badge bg-success p-2">In Stock</span>
                                            @else
                                                <span class="badge bg-danger p-2">Out of Stock</span>
                                            @endif
                                        </td>
                                        <td class="d-flex justify-content-center">
                                            <a href="{{route('admin.products.edit',$product->slug)}}" class="btn btn-sm btn-warning mx-1">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" onclick="deleteItem({{$product->id}})" class="btn btn-sm btn-danger mx-1">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <form id="{{$product->id}}" action="{{route('admin.products.destroy',$product->slug)}}" method="post">
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
