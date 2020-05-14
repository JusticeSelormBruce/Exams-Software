<p>Name : <b>{{ $user->name }}</b></p>
<p>Email : <b>{{ $user->email }}</b></p>
<div>
    <h4>Institutions Assigned</h4>
    @if($user->assignedInstitutions()->count())
        <ul class="list-group">
            @foreach($user->assignedInstitutions as $institution)
                    <li class="list-group-item"><b>{{ $institution->name }}</b>
                    <span class="pull-right">
                        <a type="button" data-toggle="modal" data-target="#delete-modal-{{ $institution->id }}">
                            <i class="fa fa-remove"></i>
                        </a>

                        <div class="modal modal-warning fade" id="delete-modal-{{ $institution->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Confirm Removal</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to remove {{ $institution->name }} from {{ $user->name }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">No, cancel</button>
                                        <button onclick="document.getElementById('delete-form-{{ $institution->pivot->id }}').submit();" type="button" class="btn btn-outline">Yes, delete it</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form id="delete-form-{{ $institution->pivot->id }}" action="{{ url('/assignment') }}/{{ $institution->pivot->id }}"
                              method="POST" style="display:none;">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="delete">
                        </form>
                    </span>

                    </li>
            @endforeach
        </ul>
    @else
        <p>No Institution assigned yet</p>
    @endif
</div>