@extends('master')
@section('title','Home')
@section('content')
    <div class="row">
        <div class="col m-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Video</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Video Count</h6>
                    <p class="card-text">{{$video_count}}</p>

                </div>
            </div>
        </div>

        <div class="col m-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Video List</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Video List Count</h6>
                    <p class="card-text">{{$video_list_count}}</p>

                </div>
            </div>
        </div>
    </div>
@endsection
