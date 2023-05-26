@extends('layouts.app')
@section('content')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

<a href="/employee/create" class="btn btn-outline-dark m-3">Add new Employee</a>
<table class="table" id="employee">
    <thead>
      <tr>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Company</th>
        <th scope="col">Email</th>
        <th scope="col">Phone</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($data as $employee)
        <tr>
            <td>{{$employee->fname}}</td>
            <td>{{$employee->lname}}</td>
            <td>{{$employee->company}}</td>
            <td>{{$employee->email}}</td>
            <td>{{$employee->phone}}</td>
            
            <form action="/employee/{{$employee->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("DELETE")
                <td><a href="/employee/{{$employee->id}}" class="btn btn-outline-warning me-2">Edit Employee</a> <button type="submit" class="btn btn-outline-danger">Remove Employee</button></td>
            </form>
        </tr>
    @endforeach
    </tbody>
  </table>


<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
  <script>
    $(document).ready( function () {
          $('#employee').DataTable();
    } );
  </script>




@endsection