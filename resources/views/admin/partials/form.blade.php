@foreach ($errors->all() as $message)@endforeach


<form action="{{ route($routeName, $project) }}" method="POST" enctype="multipart/form-data">
@csrf
@method($method)

    {{-- Input title --}}
    <div class="mb-3">
        <label for="title" class="form-label">Project title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" maxlength="200" name="title" value="{{ old('title', $project->title) }}">
        @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror    
    </div>

    {{-- Description area--}}
    <div class="mb-3">
        <label for="description" class="form-label">Project description</label>
        <textarea class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description', $project->description) }}</textarea>
        @error('description')
            <div class="invalid-feedback">
                {{ $message}}
            </div>
        @enderror    
    </div>

    {{-- External Link --}}
    <div class="mb-3">
        <label for="link" class="form-label">Project link</label>
        <input type="text" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ old('link', $project->link) }}">
        @error('link')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror    
    </div>

     {{-- Type selector --}}
    <div class="mb-3">
        <label for="type_id" class="form-label">Project type</label>
       <select name="type_id" class="form-select @error('type') is-invalid @enderror">
        @foreach ($types as $type)
            <option value="{{ $type->id }}" {{ old('type_id', $project->type_id ) == $type->id ? 'selected' : '' }}> {{ $type->name }}</option>
        @endforeach    
       </select>
        @error('type')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror    
    </div>

    {{-- File upload --}}
    <div class="mb-3">
        <label for="image" class="form-label">Project Image</label>
        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image', $project->image) }}">
        @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror    
    </div>

    {{-- Set date --}}
    <div class="mb-3">
        <label for="created" class="form-label">Project creation</label>
        <input type="date" class="form-control @error('created') is-invalid @enderror" name="created" value="{{ old('created', $project->created) }}">
        @error('created')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror    
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">
            {{ $routeName == 'admin.projects.update' ? 'Update project' : 'Create project' }}
        </button>
    </div>
</form>