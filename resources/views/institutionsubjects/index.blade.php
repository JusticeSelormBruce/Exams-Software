@extends('layouts.dashboard')

@section('title')
    Subjects
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('subject.create') }}" class="btn btn-primary btn-block margin-bottom"><i class="fa fa-plus"></i> Add New Subject</a>
            <br>
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Subjects</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped" id="table">
                        <thead>
                            <tr>
                                <th>
                                    Name of Subject
                                </th>
                                <th>
                                    For
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subjects as $subject)
                            <tr>
                                <td>
                                    @if($subject->subjectable_type == 'App\Institution')
                                    <a href="{{ route('subject.show', [$subject->id]) }}"><i class="fa fa-eye"></i> {{ $subject->name }}</a>
                                    @else
                                    <a href="#"><i class="fa fa-eye-slash"></i> {{ $subject->name }}</a>
                                    @endif
                                </td>
                                <td>
                                    {{ $subject->for }}
                                </td>
                                <td class="text-center">
                                    <a class="btn bg-olive @if($subject->subjectable_type == 'App\System') {{ 'disabled' }} @endif" href="@if($subject->subjectable_type == 'App\Institution') {{ route('subject.edit',[$subject->id]) }} @else {{ '#' }} @endif" ><i class="fa fa-edit"></i> Edit</a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <button @if($subject->subjectable_type == 'App\System') {{ 'disabled' }} @endif type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-modal-{{ $subject->id }}">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>

                                    <div class="modal modal-danger fade" id="delete-modal-{{ $subject->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Confirm Delete</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete {{ $subject->name }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">No, cancel</button>
                                                    <button onclick="document.getElementById('delete-form-{{ $subject->id }}').submit();" type="button" class="btn btn-outline">Yes, delete it</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <form id="delete-form-{{ $subject->id }}" action="{{ route('subject.destroy', [$subject->id]) }}"
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