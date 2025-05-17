@extends('admin.layouts.app')

@section('title')
    Reviews
@endsection

@section('content')
    <div class="row">
        @include('admin.layouts.sidebar')
        <div class="col-md-9">
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h3 class="mt-2">Reviews ({{$reviews->count()}})</h3>
                    </div>
                    <hr>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr class="text-center align-middle">
                                    <th>#</th>
                                    <th class="text-center">Title</th>
                                    <th class="text-center">Body</th>
                                    <th class="text-center">Rating</th>
                                    <th class="text-center">Approved</th>
                                    <th class="text-center">By</th>
                                    <th class="text-center">Product</th>
                                    <th class="text-center">Created</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $key => $review)
                                    <tr class="align-middle">
                                        <td class="text-center">{{$key + 1}}</td>
                                        <td class="text-center">{{$review->title}}</td>
                                        <td>{{$review->body}}</td>
                                        <td class="text-center">{{$review->rating}}</td>
                                        <td class="text-center">
                                            @if ($review->approved)
                                                <span class="badge bg-success">Yes</span>
                                            @else
                                                <span class="badge bg-danger">No</span>
                                            @endif
                                        </td>
                                        <td>{{$review->user->name}}</td>
                                        <td class="text-center">
                                            <img src="{{asset($review->product->thumbnail)}}" class="rounded" width="60" height="60" alt="{{$review->product->name}}">
                                        </td>
                                        <td>{{$review->created_at}}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                @if ($review->approved)
                                                    <a href="{{ route('admin.reviews.update', ['review' => $review->id, 'status' => 0]) }}"
                                                       class="btn btn-warning btn-sm">
                                                        <i class="fas fa-ban"></i> Cancel
                                                    </a>
                                                @else
                                                    <a href="{{ route('admin.reviews.update', ['review' => $review->id, 'status' => 1]) }}"
                                                       class="btn btn-success btn-sm">
                                                        <i class="fas fa-check-double"></i> Approve
                                                    </a>
                                                @endif
                                                <a href="#" onclick="deleteItem({{ $review->id }})" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a>
                                            </div>
                                            <form id="{{$review->id}}" action="{{route('admin.reviews.delete',$review->id)}}" method="post" style="display: none;">
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
            </div>
        </div>
    </div>
@endsection
