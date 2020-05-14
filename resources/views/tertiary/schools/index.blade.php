@extends('layouts.dashboard')

@section('title')
    Schools
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('schools.create') }}" class="btn btn-primary btn-block margin-bottom"><i class="fa fa-plus"></i> Add New School</a>
            <br>
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Schools</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped" id="table">
                        <thead>
                            <tr>
                                <th>
                                    Name of School
                                </th>
                                <th>
                                    Institution
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schools as $school)
                            <tr>
                                <td>
                                    <a href="{{ route('schools.show', [$school->id]) }}"><i class="fa fa-eye"></i> {{ $school->name }}</a>
                                </td>
                                <td>
                                    {{ $school->institution->name }}
                                </td>
                                <td class="text-center">
                                    <a class="btn bg-olive" href="{{ route('schools.edit',[$school->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-modal-{{ $school->id }}">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>

                                    <div class="modal modal-danger fade" id="delete-modal-{{ $school->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Confirm Delete</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete {{ $school->name }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">No, cancel</button>
                                                    <button onclick="document.getElementById('delete-form-{{ $school->id }}').submit();" type="button" class="btn btn-outline">Yes, delete it</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <form id="delete-form-{{ $school->id }}" action="{{ route('institutions.destroy', [$school->id]) }}"
                                          method="POST" style="display:none;">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete">
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
@endsection