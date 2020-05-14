@extends('layouts.dashboard')

@section('style')
    <style>
        img{
            max-width: 100%;
            height: auto;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.3/MathJax.js?config=TeX-MML-AM_CHTML" async></script>
@endsection

@section('title')
    Objective Questions
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <a href="{{ url('/objectives/setup') }}" class="btn btn-primary btn-block margin-bottom"><i class="fa fa-plus"></i> Add New Objective Question</a>
            <br>
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Objective Questions</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped" id="table">
                        <thead>
                            <tr>
                                <th>
                                    Objective Question
                                </th>
                                <th>
                                    Answer Options
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($objectives as $objective)
                            <tr>
                                <td>
                                    <a href="{{ route('objectives.show', [$objective->id]) }}">{!! $objective->question !!}</a>
                                </td>
                                <td>
                                    <p>a){!! $objective->a !!}@if($objective->answer == 'a') <i class="fa fa-check"></i>@endif</p>
                                    <p>b){!! $objective->b !!}@if($objective->answer == 'b') <i class="fa fa-check"></i>@endif</p>
                                    @if($objective->c)<p>c){!! $objective->c !!}@if($objective->answer == 'c') <i class="fa fa-check"></i>@endif</p>@endif
                                    @if($objective->d)<p>d){!! $objective->d !!}@if($objective->answer == 'd') <i class="fa fa-check"></i>@endif</p>@endif
                                    @if($objective->e)<p>e){!! $objective->e !!}@if($objective->answer == 'e') <i class="fa fa-check"></i>@endif</p>@endif
                                </td>
                                <td class="text-center">
                                    <a class="btn bg-olive" href="{{ route('objectives.edit',[$objective->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-modal-{{ $objective->id }}">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>

                                    <div class="modal modal-danger fade" id="delete-modal-{{ $objective->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Confirm Delete</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete {!! $objective->question !!}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">No, cancel</button>
                                                    <button onclick="document.getElementById('delete-form-{{ $objective->id }}').submit();" type="button" class="btn btn-outline">Yes, delete it</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <form id="delete-form-{{ $objective->id }}" action="{{ route('objectives.destroy', [$objective->id]) }}"
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