@extends('master')
@section('title','Add Video')
@section('content')

        <form action="{{route('video.store')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title')}}">
                @error('title')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" cols="30" rows="10"
                          class="form-control @error('description') is-invalid @enderror">{{old('description')}}</textarea>
                @error('description')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <hr>
        <h4>Videos</h4>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">SN</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1?>
            @foreach($videos as $video)
                <tr>
                    <th scope="row">{{$i}}</th>
                    <td>{{$video->title}}</td>
                    <td>{{$video->description}}</td>
                    <td>
                        @if($video->isActive==0)
                            <div class="text-danger">Inactive</div>
                        @elseif($video->isActive==1)
                            <div class="text-success">Active</div>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('video.edit',$video->id)}}" class="btn btn-primary">Edit</a>
                        @if($video->isActive==0)
                            <a href="{{route('video.activate',$video->id)}}" class="btn btn-success">Activate</a>
                        @elseif($video->isActive==1)
                            <a href="{{route('video.deactivate',$video->id)}}" class="btn btn-danger">Deactivate</a>
                        @endif
                        <a href="{{route('video.delete',$video->id)}}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php $i++?>
            @endforeach
            </tbody>
        </table>
@endsection
