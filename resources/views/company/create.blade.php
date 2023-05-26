@extends('layouts.app')
@section('content')
<a href="/company" class="btn btn-outline-dark">Go Back</a>
    <form action="/company" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="forms">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group">
                <label>Email address</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="form-group">
                <label>Logo</label>
                <input type="file" class="form-control" name="logo">
            </div>
            <div class="form-group">
                <label>Website URL</label>
                <input type="text" class="form-control" name="url">
            </div>
            <br>
            <br>
            <button type="submit" class="btn btn-outline-dark">Submit</button>
        </div>
        
    </form>
@endsection