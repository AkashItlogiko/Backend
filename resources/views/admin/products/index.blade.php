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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Colors</th>
                                    <th scope="col">Sizes</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Status</th>

                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $product)
                                    <tr>
                                        <th scope="row">{{$key +=1}}</th>
                                        <td>{{$color->name}}</td>
                                        <td>
                                            @foreach ($product->colors as $color)
                                                <span class="badge bg-light text-dark">
                                                    {{$color->name}}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($product->sizes as $size)
                                                <span class="badge bg-light text-dark">
                                                    {{$size->name}}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td>{{$color->qty}}</td>
                                        <td>{{$color->price}}</td>
                                        <td>
                                            <img src="{{asset('storage/'.$color->image)}}" alt="Product Image" class="img-fluid">
                                        </td>
                                        <td>{{$color->name}}</td>
                                        <td>{{$color->name}}</td>
                                        <td>{{$color->name}}</td>
                                        <td>
                                             <a href="{{route('admin.colors.edit',$color->id)}}" class="btn btn-sm btn-warning">
                                                   <i class="fas fa-edit"></i>
                                            </a>
                                             <a href="#" onclick="deleteItem({{$color->id}})" class="btn btn-sm btn-danger">
                                                   <i class="fas fa-trash"></i>
                                            </a>
                                            <form id="{{$color->id}}" action="{{route('admin.colors.destroy',$color->id)}}" method="post">
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
