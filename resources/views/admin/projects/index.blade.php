@extends('layouts.admin')

@section('content')
   <div class="container">
        <div class="row my-3">
          <div class="col-12 text-center">
            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">Create Item</a>
          </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                      <tr>
                        <th>#ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Link</th>
                        <th>Created</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($projects as $project)
                      <tr>
                        <th>{{ $project->id }}</th>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->description }}</td>
                        <td>{{ $project->type->name }}</td>
                        <td>{{ $project->link }}</td>
                        <td>{{ $project->created }}</td>
                        <td>
                          <a href="{{ route('admin.projects.show', $project->slug )}}" class="btn btn-primary">Show</a>
                          <a href="{{ route('admin.projects.edit', $project->slug )}}" class="btn btn-success">Edit</a>
                          <form action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST" class="delete">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" title="delete">Delete</button>
                          </form>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{ $projects->links() }}
            </div>
        </div>
   </div>
@endsection

@section('script')
    @vite('resources/js/confirmDelete.js')
@endsection