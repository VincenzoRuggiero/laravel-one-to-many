@extends('layouts.admin')

@section('content')
   <div class="container">
        <div class="row my-3">
          <div class="col-6">
            <h1>Edit item</h1>
          </div>
        </div>
        <div class="row">
            <div class="col-5">
              @include('admin.partials.form', ['method' => 'PUT', 'routeName' => 'admin.projects.update'])
            </div>
        </div>
   </div>
@endsection