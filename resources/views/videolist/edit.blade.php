@extends('master')
@section('title','Edit Video List')
@section('content')

    <form action="{{route('videoList.update',$video_list->id)}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                   value="{{$video_list->name}}">
            @error('name')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="link" class="form-label">Link</label>
            <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link"
                   value="{{$video_list->link}}">
            @error('link')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="video" class="form-label">Video</label>
            <select name="video" id="video" class="form-control @error('video') is-invalid @enderror">
                <option disabled selected>Select Video</option>
                @foreach($videos as $video)
                    <option value="{{$video->id}}" {!! old('video',$video_list->video_id) == $video->id ? 'selected="selected"':'' !!}>{{$video->title}}</option>
                @endforeach
            </select>
            @error('video')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
