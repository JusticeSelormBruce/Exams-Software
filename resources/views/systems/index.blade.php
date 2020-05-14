@extends('layouts.dashboard')

@section('title')
    School Systems
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('systems.create') }}" class="btn btn-primary btn-block margin-bottom"><i class="fa fa-plus"></i> Add New School System</a>
            <br>
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">School Systems</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped" id="table">
                        <thead>
                            <tr>
                                <th>
                                    Name of School System
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($systems as $system)
                            <tr>
                                <td>
                                    <a href="{{ route('systems.show', [$system->id]) }}"><i class="fa fa-eye"></i> {{ $system->name }}</a>
                                </td>
                                <td class="text-center">
                                    <a class="btn bg-olive" href="{{ route('systems.edit',[$system->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-modal-{{ $system->id }}">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>

                                    <div class="modal modal-danger fade" id="delete-modal-{{ $system->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Confirm Delete</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete {{ $system->name }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">No, cancel</button>
                                                    <button onclick="document.getElementById('delete-form-{{ $system->id }}').submit();" type="button" class="btn btn-outline">Yes, delete it</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <form id="delete-form-{{ $system->id }}" action="{{ route('systems.destroy', [$system->id]) }}"
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