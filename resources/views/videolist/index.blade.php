@extends('master')
@section('title','Add Video List')
@section('content')

    <form action="{{route('videoList.store')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                   value="{{old('name')}}">
            @error('name')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="link" class="form-label">Link</label>
            <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link"
                   value="{{old('link')}}">
            @error('link')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="video" class="form-label">Video</label>
            <select name="video" id="video" class="form-control @error('video') is-invalid @enderror">
                <option disabled selected>Select Video</option>
                @foreach($videos as $video)
                    <option value="{{$video->id}}" {!! old('video') == $video->id ? 'selected="selected"':'' !!}>{{$video->title}}</option>
                @endforeach
            </select>
            @error('video')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <hr>
    <h4>Video Lists</h4>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">SN</th>
            <th scope="col">Name</th>
            <th scope="col">Link</th>
            <th scope="col">Video Title</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 1?>
        @foreach($video_lists as $video)
            <tr>
                <th scope="row">{{$i}}</th>
                <td>{{$video->name}}</td>
                <td><a href="{{$video->link}}" target="_blank">{{$video->link}}</a></td>
                <td>{{$video->video['title']}}</td>

                <td>
                    <a href="{{route('videoList.edit',$video->id)}}" class="btn btn-primary">Edit</a>
                    <a href="{{route('videoList.delete',$video->id)}}" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php $i++?>
        @endforeach
        </tbody>
    </table>
@endsection
