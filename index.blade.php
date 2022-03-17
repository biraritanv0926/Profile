@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Employee Crud</h2>
                    </div>
                    <br/>
                        <div class="table-responsive">
                            <table class="table">

                                <script src="{{ asset('js/emp.js') }}" defer></script>
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>DOB</th>
                                        <th>Designation</th>
                                        <th>Date of Joining</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($employee as $item)
                                    <tr>
                                           {{--
                                             The current loop iteration (starts at 1).
                                           When looping, a $loop variable will be available inside of your loop. 
                                           This variable provides access to some useful bits of information such as the current
                                            loop index and whether this is the first or last iteration through the loop:
                                             --}}
                                        <td>{{ $loop->iteration }}</td> 
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->mobile }}</td>
                                        <td>{{ $item->dob }}</td>
                                        <td>{{ $item->designation }}</td>
                                        <td>{{ $item->doj }}</td>
                                        <td>
                                            <a href="{{ url('/employee/' . $item->id) }}" title="View Employee"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/employee/' . $item->id . '/edit') }}" title="Edit Employee"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            <form method="POST" action="{{ url('/employee' . '/' . $item->id) }}"  class="d-inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                               
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Employee" onclick="return confirm('Are you sure want to Delete?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    
                                @endforeach
                                </tbody>
                            </table>
                            <div class="card-body text-center">
                                <a href="{{ url('/employee/create') }}" class="btn btn-success btn-sm" title="Add New Employee">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Add New
                                </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script src="{{ asset('js/emp.js')}}"></script>
    @endpush
    
@endsection
