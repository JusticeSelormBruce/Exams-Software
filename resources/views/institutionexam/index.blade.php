@extends('layouts.dashboard')

@section('title')
    Examinations
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <a href="{{ url('exams/setup') }}" class="btn btn-primary btn-block margin-bottom"><i class="fa fa-calculator"></i> <span>Generate Question</a>
            <br>
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Examinations</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped" id="table">
                        <thead>
                        <tr>
                            <th>
                                Name of Examination
                            </th>
                            <th>
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($exams as $exam)
                            <tr>
                                <td>
                                    <p><i class="fa fa-eye"></i> {{ $exam->created_at }}-{{ $exam->subject->name }}</p>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('institutionexam.show', [$exam->id]) }}" class="btn btn-success">Print Question</a>&nbsp;&nbsp;
                                    &nbsp;&nbsp;
                                    <a href="{{ route('institutionexam.scheme', [$exam->id]) }}" class="btn bg-teal">Print Marking Scheme</a>
                                    &nbsp;
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-modal-{{ $exam->id }}">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>

                                    <div class="modal modal-danger fade" id="delete-modal-{{ $exam->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Confirm Delete</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete {{ $exam->name }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">No, cancel</button>
                                                    <button onclick="document.getElementById('delete-form-{{ $exam->id }}').submit();" type="button" class="btn btn-outline">Yes, delete it</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <form id="delete-form-{{ $exam->id }}" action="{{ route('institutionexam.destroy', [$exam->id]) }}"
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