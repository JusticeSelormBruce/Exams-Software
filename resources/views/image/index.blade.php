@extends('layouts.dashboard')

@section('title')
    Images
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('image.create') }}" class="btn btn-primary btn-block margin-bottom"><i class="fa fa-plus"></i> Add New Image</a>
            <br>
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Images</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped" id="table">
                        <thead>
                            <tr>
                                <th>
                                    Name of Image
                                </th>
                                <th style="min-width:20px">
                                    Image
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($images as $image)
                            <tr>
                                <td>
                                    <a href="{{ route('image.show', [$image->id]) }}"><i class="fa fa-eye"></i> {{ $image->name }}</a>
                                </td>
                                <td width="40%;">
                                    <img class="img-responsive" src="{{ url('') }}<?= '/' ?>{{ $image->url }}">
                                    url: <input style="" id="C-{{ $image->id }}" type="text" value="{{ url('') }}/{{ $image->url }}">
                                </td>
                                <td class="text-center">
                                    <button onclick="CopyURL('C-'+{{ $image->id }})" class="btn bg-maroon">Copy URL</button>
                                    &nbsp;&nbsp;
                                    <a class="btn bg-olive" href="{{ route('image.edit',[$image->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                    &nbsp;&nbsp;
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-modal-{{ $image->id }}">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                    <div class="modal modal-danger fade" id="delete-modal-{{ $image->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Confirm Delete</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete {{ $image->name }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">No, cancel</button>
                                                    <button onclick="document.getElementById('delete-form-{{ $image->id }}').submit();" type="button" class="btn btn-outline">Yes, delete it</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <form id="delete-form-{{ $image->id }}" action="{{ route('image.destroy', [$image->id]) }}"
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

@section('script')
    <script>
        function CopyURL(id){
             /* Get the text field */
            var copyText = document.getElementById(id);

            /* Select the text field */
            copyText.select();

            /* Copy the text inside the text field */
            document.execCommand("Copy");

            /* Alert the copied text */
            alert("URL Copied: " + copyText.value);
        }
    </script>
@endsection