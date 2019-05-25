@extends('layouts.company')

@section('content')
    @include('partials.header',['title' => 'List Of Employees'])
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>Employee List</h2>
                    <ul class="header-dropdown">
                        <li><a href="{{ route('create-employee') }}" class="btn btn-info">Add New</a></li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover js-basic-example dataTable table-custom table-striped m-b-0 c_list">
                            <thead class="thead-dark">
                            <tr>
                                <th>SL</th>
                                <th>Employee Id</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Pay Scale</th>
                                <th>Branch</th>
                                <th>Section</th>
                                <th>Line</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $k => $employee)
                                <tr>
                                    <td>{{ $k+1 }}</td>
                                    <td>{{ $employee->employee_id }}</td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->designation->name  ?? '' }}</td>
                                    <td>{{ $employee->payScale->name  ?? '' }}</td>
                                    <td>{{ $employee->branch->name  ?? '' }}</td>
                                    <td>{{ $employee->section->name  ?? '' }}</td>
                                    <td>{{ $employee->line->name  ?? '' }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('edit-employee',['id' => $employee->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <button class="btn btn-sm btn-danger btn-delete" data-url="{{ route('delete-employee',['id' => $employee->id]) }}" data-toggle="modal" data-target="#deleteModal">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection