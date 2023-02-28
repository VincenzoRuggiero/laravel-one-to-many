@extends('layouts.admin')

@section('content')
   <div class="container mt-5">
        <div class="row d-flex justify-content-center">
         <div class="card col-12" style="width: 36rem;">
            <img src="{{ asset('storage/' . $project->image) }}" class="card-img-top img-fluid pt-2 rounded" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{ $project->title }}</h5>
              <p>Created: <small>{{ $project->created }}</small></p>
              <p>Type: <small>{{ $project->type->name }}</small></p>
              <p class="card-text">{{ $project->description }}</p>

              {{-- Action buttons --}}
              <div class="btn-wrapper d-flex justify-content-between">
                  <div>
                     <a class="btn btn-outline-dark @if(!isset($prev)) disabled @endisset" href="{{ route('admin.projects.show', $prev->slug ?? '') }}">Prev</a>
                  </div>
                  <a href="{{ $project->link }}" class="btn btn-primary">Open Project</a>
                  <a href="{{ route('admin.projects.edit', $project->slug) }}" class="btn btn-success mx-2">Edit</a>
                  <form class="d-inline delete" action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST" class="delete">
                     @csrf
                     @method('DELETE')
                     <button class="btn btn-danger" title="delete">Delete</button>
                  </form>
                  <div>
                     <a class="btn btn-outline-dark @if(!isset($next)) disabled @endisset" href="{{ route('admin.projects.show', $next->slug ?? '') }}">Next</a>
                  </div>
              </div>
            </div>
          </div>
         </div>
   </div>

@endsection

@section('script')
    @vite('resources/js/confirmDelete.js')
@endsection