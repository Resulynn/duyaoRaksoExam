@extends('layouts.app')
@section('content')
<a href="/employee" class="btn btn-outline-dark">Go Back</a>
@foreach ($data as $up)
<form action="/employee/{{$up->id}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PUT")

    <div class="forms">
        <div class="form-group">
            <label>First Name</label>
            <input type="text" class="form-control" name="fname" value="{{$up->fname}}">
        </div>
        <div class="form-group">
            <label>Last Name</label>
            <input type="text" class="form-control" name="lname" value="{{$up->lname}}">
        </div>
        <div class="form-group">
            <label>Company</label>
            <select class="form-select" aria-label="Default select example" name="company">
                <option selected>{{$up->company}}</option>

                @foreach ($com as $name)
                    <option value="{{$name->name}}">{{$name->name}}</option>
                @endforeach
        
            </select>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" name="email" value="{{$up->email}}">
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="number" class="form-control" name="phone" value="{{$up->phone}}">
        </div>
        <br>
        <br>
        <button type="submit" class="btn btn-outline-dark">Submit</button>
    </div>
    
    

</form>
@endforeach
    
@endsection