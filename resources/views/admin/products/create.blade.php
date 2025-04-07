@extends('admin.layouts.app')

@section('title')
    Add new product
@endsection

@section('content')
        <div class="row">
        @include('admin.layouts.sidebar')
        <div class="col-md-9 col-lg-10">
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card-header bg-white">
                    <h3 class="mt-2">Add Product</h3>
                    <hr>
                </div>
                <div class="card-body">
                  <div class="row">
                     <div class="col-md-6 mx-auto">
                    <form action="{{route('admin.products.store') }}" method="post">
                        @csrf
                        <div class="form-floating mb-3">
                          <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="floatingInput"
                            name="name"
                            placeholder="Name" value="{{old('name')}}">
                          <label for="floatingInput">Name</label>
                          @error('name')
                            <span class="invalid-feedback">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>

                        <div class="form-floating mb-3">
                          <input
                            type="number"
                            class="form-control @error('qty') is-invalid @enderror"
                            id="floatingInput"
                            name="qty"
                            placeholder="Quantity" value="{{old('qty')}}">
                          <label for="floatingInput">Quantity</label>
                          @error('qty')
                            <span class="invalid-feedback">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>

                        <div class="form-floating mb-3">
                          <input
                            type="number"
                            class="form-control @error('price') is-invalid @enderror"
                            id="floatingInput"
                            name="price"
                            placeholder="Price" value="{{old('price')}}">
                          <label for="floatingInput">Price</label>
                          @error('price')
                            <span class="invalid-feedback">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>

                                            <div class="form-floating mb-3">
                        <select name="color_id[]" id="color_id"
                                class="form-control @error('color_id') is-invalid @enderror" multiple>
                            @foreach ($colors as $color)
                            <option value="{{ $color->id }}">
                                {{ $color->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('color_id')
                            <span class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>

                        <div class="mb-2">
                          <button type="submit" class="btn btn-sm btn-dark">
                            Submit
                          </button>
                        </div>
                      </form>
                   </div>
                  </div>
                </div>
            </div>
            </div>
        </div>
        </div>
@endsection
