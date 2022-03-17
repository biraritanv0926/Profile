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
        <input type="text" name="name" id="name" value="{{ old('name', $project->name ?? null) }}" placeholder="Enter your Project Name" class="form-control @error('name') is-invalid @enderror">
        @error('name')
        <div class="mt-2 alert alert-danger">{{ $message }}</div>
    @enderror
      </br>

      <label>Description :</label></br>
      <textarea name="description" id="description" rows="4" cols="50" placeholder="Enter the project description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $project->description  ?? null) }}</textarea>
      @error('description')
      <div class="mt-2 alert alert-danger">{{ $message }}</div>
  @enderror
    </br>

        <label>Technology:</label></br>
        <select name="technology" id="technology"  class="form-control @error('technology') is-invalid @enderror" >
          <option selected value="" @if(old('technology', $project->technology  ?? null) == '') @endif>None</option>
          <option  value="laravel"  @if(old('technology', $project->technology  ?? null) == 'laravel')  selected @endif>Laravel</option>
          <option value="mernstack" @if(old('technology', $project->technology  ?? null) == 'mernstack')  selected @endif>Mernstack</option>
          <option value="station" @if(old('technology', $project->technology  ?? null) == 'station')  selected @endif>Station</option> 
        </select>

        @error('technology')
        <div class="mt-2 alert alert-danger">{{ $message }}</div>
    @enderror
      </br>

        <label>Start Date :</label></br>
        <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $project->start_date ?? null) }}"  class="form-control datepicker @error('start_date') is-invalid @enderror">
        @error('start_date')
        <div class="mt-2 alert alert-danger">{{ $message }}</div>
    @enderror
      </br>
        
        <label>End Date :</label></br>
        <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $project->end_date ?? null) }}" class="form-control @error('end_date') is-invalid @enderror">
        @error('end_date')
        <div class="mt-2 alert alert-danger">{{ $message }}</div>
    @enderror
      </br>
    
      @foreach($employees as $employee)
     
      <label class="checkbox">
      <input type="checkbox" id="employee_id" name="employee_id[]" value="{{ $employee->id }}"  @if ($project ?? false) {{ in_array($employee->id , $projectEmployees ) ? 'checked' : ' '  }} @endif> {{$employee->name  ?? null}}
    </label></br>

  @endforeach
</br>
        <button type="submit" class="btn btn-success">{{ isset($project) ? 'Update' : 'Save' }}</button>
        {{-- <button type="submit" class="btn btn-success">Update</button> --}}
        <a class="btn btn-secondary" href="{{ route('project.index') }}">Cancel </a></br>
    </form>
    <script>
      //     console.log('script loaded');
      //   $(document).ready(function () {
      //     var date = new Date();
      //     var currentMonth = date.getMonth();
      //     var currentDate = date.getDate();
      //     var currentYear = date.getFullYear();
      
      //     $('#start_date').datepicker({
      //         minDate: new Date(currentYear, currentMonth, currentDate),
      //         dateFormat: 'yy-mm-dd'
      //     });
      // });
    
    
     // $("#start_date").datepicker({ dateFormat: 'yy-mm-dd' });
      console.log('xxxf');
    //   $('#start_date').datepicker({
    //       dateFormat: 'yy-mm-dd'
    // });
      </script>
    

  </div>
</div>
</div>
@endsection