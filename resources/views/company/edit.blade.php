@extends('layouts.app')
@section('content')
<a href="/company" class="btn btn-outline-dark">Go Back</a>

@foreach ($data as $com)

<form action="/company/{{$com->id}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PUT")

    <div class="forms">
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" value="{{$com->name}}">
        </div>
        <div class="form-group">
            <label>Email address</label>
            <input type="email" class="form-control" name="email" value="{{$com->email}}">
        </div>
        <div class="form-group">
            <label>Logo</label>
            <input type="file" class="form-control" name="logo">
        </div>
        <div class="form-group">
            <label>Website URL</label>
            <input type="text" class="form-control" name="url" value="{{$com->website}}">
        </div>
        <br>
        <br>
        <button type="submit" class="btn btn-outline-dark">Submit</button>
    </div>
    
</form>
@endforeach

@endsection