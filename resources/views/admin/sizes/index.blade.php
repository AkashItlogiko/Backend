@extends('admin.layouts.app')

@section('title')
    Sizes
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.layouts.sidebar')
        <div class="col-md-9 col-lg-10">
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h3 class="mt-2">Sizes ({{ $sizes->count() }})</h3>
                            <a href="{{ route('admin.sizes.create') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus"></i> Add Size
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="text-center">#</th>
                                            <th scope="col" class="text-center">Name</th>
                                            <th scope="col" class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sizes as $key => $size)
                                            <tr>
                                                <th scope="row" class="text-center">{{ $key + 1 }}</th>
                                                <td class="text-center">{{ $size->name }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.sizes.edit', $size->id) }}" class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <a href="#" onclick="deleteItem({{ $size->id }})" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </a>
                                                    <form id="{{ $size->id }}" action="{{ route('admin.sizes.destroy', $size->id) }}" method="post" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <small class="text-muted">Manage all available sizes here</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
