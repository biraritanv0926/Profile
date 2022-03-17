@extends('layout')
@section('content')
<div class="container">
<div class="card row mt-5">
  <h4 class="card-header text-center">Project Page</h4>
  <div class="card-body">
      <h2>{{ isset($project) ? 'Edit record' : 'Create new record' }}</h2>
      <form action="{{ isset($project) ? '/project/'.$project->id : '/project' }}" method="post">
        {!! csrf_field() !!}

        @if ($project ?? false)
        @method("PATCH")
        @endif

        <label>Project Name :</label></br>
        <input type="text" name="name" id="name" value="{{ old('name', $project->name) }}" placeholder="Enter Project Name" class="form-control @error('name') is-invalid @enderror">
        @error('name')
        <div class="mt-2 alert alert-danger">{{ $message }}</div>
    @enderror
      </br>

        <label>Description :</label></br>
        <textarea name="description" id="description" value="{{ old('description', $project->description) }}" rows="4" cols="50" placeholder="Enter the project description" class="form-control @error('description') is-invalid @enderror"></textarea>
        @error('description')
        <div class="mt-2 alert alert-danger">{{ $message }}</div>
    @enderror
      </br>

      <label>Technology :</label></br>
        <input type="text" name="Technology" id="Technology" value="{{ old('technology', $project->technology) }}" placeholder="Enter technology Name" class="form-control @error('technology') is-invalid @enderror">
        @error('technology')
        <div class="mt-2 alert alert-danger">{{ $message }}</div>
    @enderror
      </br>
      
        <label>Start Date :</label></br>
        <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $project->start_date) }}"  class="form-control @error('start_date') is-invalid @enderror">
        @error('start_date')
        <div class="mt-2 alert alert-danger">{{ $message }}</div>
    @enderror
      </br>
        
          <label>End Date:</label></br>
        <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $project->end_date) }}" class="form-control @error('end_date') is-invalid @enderror">
        @error('end_date')
        <div class="mt-2 alert alert-danger">{{ $message }}</div>
    @enderror
      </br>
    </br>
    {{-- <div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>checkbox</th>
                <th>Employee Name</th>
               
                <th></th>
            </tr>
        </thead>        
          <tbody>         
                <tr>
                    <td><input type="checkbox"></td> 
                    <td>Tanvi Birari</td>
                   
                </tr>
                <tr>
                  <td><input type="checkbox"></td> 
                  <td>Neha Ma'am</td>
                 </tr>
                 <tr>
                <td><input type="checkbox"></td> 
                <td>Shailesh Sir</td>
                 </tr>
                 <tr>
                <td><input type="checkbox"></td> 
                  <td>Charushila Ma'am</td>
                 </tr>
        </tbody>
      </table>
    </div> --}}

      <button type="submit" class="btn btn-success">{{ isset($project) ? 'Update' : 'Save' }}</button>
      {{-- <button type="submit" class="btn btn-success">Update</button> --}}
      <a class="btn btn-secondary" href="{{ route('project.index') }}">Cancel </a></br>
  </form>


</div>
</div>
</div>
@endsection