<p>Name : <b>{{ $user->name }}</b></p>
<p>Email : <b>{{ $user->email }}</b></p>
<div>
    <h4>Subjects Assigned</h4>
    @if($user->assignedSubjects()->count())
        <ul class="list-group">
            @foreach($user->assignedSubjects as $subject)
                    <li class="list-group-item"><b>{{ $subject->name }}</b>
                    <span class="pull-right">
                        <a type="button" data-toggle="modal" data-target="#delete-modal-{{ $subject->id }}">
                            <i class="fa fa-remove"></i>
                        </a>

                        <div class="modal modal-warning fade" id="delete-modal-{{ $subject->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Confirm Removal</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to remove {{ $subject->name }} from {{ $user->name }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">No, cancel</button>
                                        <button onclick="document.getElementById('delete-form-{{ $subject->pivot->id }}').submit();" type="button" class="btn btn-outline">Yes, delete it</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form id="delete-form-{{ $subject->pivot->id }}" action="{{ url('/assignment2') }}/{{ $subject->pivot->id }}"
                              method="POST" style="display:none;">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="delete">
                        </form>
                    </span>

                    </li>
            @endforeach
        </ul>
    @else
        <p>No Subject assigned yet</p>
    @endif
</div>