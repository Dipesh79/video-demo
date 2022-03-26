@extends('master')
@section('title','Edit Video')
@section('content')
    <div class="container">
        <form action="{{route('video.update',$video->id)}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{$video->title}}">
                @error('title')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" cols="30" rows="10"
                          class="form-control @error('description') is-invalid @enderror">{{$video->description}}</textarea>
                @error('description')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
