<div class="modal-header">
    <div class="col-sm-6">
        <h4 class="modal-title">Likes</h4>
    </div>
    <div class="col-sm-6">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
</div>
<div class="modal-body">
    @foreach ($model->likes as $user)
        <div>
            <a class="nav-link" href="{{ route('profile', $user->profile->profile_url ? $user->profile->profile_url : $user->uid) }}">
                <img width="40px" class="rounded-circle" src="{{ url('/img/pic.jpg') }}">
                {{ $user->first_name }} {{ $user->last_name }}
            </a>
        </div>
    @endforeach
</div>
<div class="modal-footer">
    <button type="button" id="close-parcels" class="btn btn-primary" data-dismiss="modal">Close</button>
</div>