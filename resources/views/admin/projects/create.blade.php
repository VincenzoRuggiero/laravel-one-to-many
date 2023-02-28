@extends('layouts.admin')

@section('content')
   <div class="container">
        <div class="row my-3">
          <div class="col-6">
            <h1>Create item</h1>
          </div>
        </div>
        <div class="row">
            <div class="col-5">
              @include('admin.partials.form', ['method' => 'POST', 'routeName' => 'admin.projects.store'])
            </div>
        </div>
   </div>
@endsection