@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

<a href="/company/create " class="btn btn-outline-dark m-3">Add new Company</a>
<a href="/import " class="btn btn-outline-dark m-3">Import Companies</a>
<table class="table" id="company">
    <thead>
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Email Address</th>
        <th scope="col">Logo</th>
        <th scope="col">Webiste URL</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($data as $company)
        <tr>
            <td>{{$company->name}}</td>
            <td>{{$company->email}}</td>
            <td> <img src="{{$company->logo}}" alt="" style="width: 100px; height: 100px;"></td>
            <td> <a href="https://{{$company->website}}" class="link-primary">{{$company->website}}</a></td>

            
            <form action="/company/{{$company->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("DELETE")
                <td><a href="/company/{{$company->id}}" class="btn btn-outline-warning me-2">Edit company</a> <button type="submit" class="btn btn-outline-danger">Remove Company</button></td>
            </form>
        </tr>
    @endforeach
    </tbody>
  </table>

  <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
  <script>
    $(document).ready( function () {
          $('#company').DataTable();
    } );
  </script>
@endsection