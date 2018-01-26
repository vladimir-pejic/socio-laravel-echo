@foreach($statuses as $status)
    <div class="col-md-12 alert alert-primary">

        {{-- STATUS --}}
        <div class="col-md-12">
            <h6><a href="{{ route('profile', $status->user->profile->profile_url ? $status->user->profile->profile_url : $status->user->uid) }}">
                    <img class="rounded-circle" width="25px" src="{{ url('/img/pic.jpg') }}">
                    {{ $status->user->first_name }} {{ $status->user->last_name }}
                </a>
                @if($status->origin_user_id != $status->target_user_id)
                    &#x25BA; <a href="{{ route('profile', $status->targetUser->profile->profile_url ? $status->targetUser->profile->profile_url : $status->targetUser->uid) }}">
                        {{ $status->targetUser->first_name }} {{ $status->targetUser->last_name }}
                    </a>
                @endif
            </h6>
            <p class="label-info">{{ $status->content }}</p>
        </div>
        <div class="col-md-6">
            {{-- All likes --}}
            @if($status->likes()->count() == 1)<a href="#" id="show-likes-user-status-{{ $status->id }}" data-model="UserStatus" data-id="{{ $status->id }}" data-toggle="modal" data-target="#modal-small"> {{ $status->likes()->count() }} Like </a>
            @elseif($status->likes()->count() > 1)<a href="#" id="show-likes-user-status-{{ $status->id }}" data-model="UserStatus" data-id="{{ $status->id }}" data-toggle="modal" data-target="#modal-small"> {{ $status->likes()->count() }} Likes </a>
            @else @endif
            {{-- Like/Unlike--}}
            @if ($status->isLiked)<a href="{{ route('user.status.like', $status->id) }}">Unlike</a>
            @else <a href="{{ route('user.status.like', $status->id) }}">Like</a>
            @endif
        </div>
        <div class="col-md-6">
                <cite title="Source Title">Posted: </cite>
                {{ $status->created_at->diffForHumans() }}
        </div>
        <hr>

        {{-- DISPLAY ALL COMMENT IF ANY --}}
        @foreach($status->comments as $comment)
            <div class="col-md-12 alert alert-info">
                <h6><a class="nav-link" href="{{ route('profile', $comment->user->profile->profile_url ? $comment->user->profile->profile_url : $comment->user->uid) }}">
                        <img class="rounded-circle" width="25px" src="{{ url('/img/pic.jpg') }}">
                        {{ $comment->user->first_name }} {{ $comment->user->last_name }}
                    </a> replied: </h6>
                <br>{{ $comment->content }}
                <div class="col-md-6">
                    {{-- All likes --}}
                    @if($comment->likes()->count() == 1)<a href="#" id="show-likes-user-status-comment-{{ $comment->id }}"  data-model="UserStatusComment" data-id="{{ $comment->id }}" data-toggle="modal" data-target="#modal-small"> {{ $comment->likes()->count() }} Like </a>
                    @elseif($comment->likes()->count() > 1)<a href="#" id="show-likes-user-status-comment-{{ $comment->id }}"  data-model="UserStatusComment" data-id="{{ $comment->id }}" data-toggle="modal" data-target="#modal-small"> {{ $comment->likes()->count() }} Likes </a>
                    @else @endif
                    {{-- Like/Unlike--}}
                    @if ($comment->isLiked)<a href="{{ route('user.comment.like', $comment->id) }}">Unlike</a>
                    @else <a href="{{ route('user.comment.like', $comment->id) }}">Like</a>
                    @endif
                </div>
                <div class="col-md-6">
                    <cite title="Source Title">Posted: </cite>
                    {{ $status->created_at->diffForHumans() }}
                </div>
            </div>
        @endforeach


        {{-- COMMENTING FORM --}}
        {!! Form::open(['method' => 'post', 'route' => ['user.status.comment.store', $status->id]]) !!}
        <div class="col-md-12 form-inline">
            {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => 1, 'id'=>'user_status_comment', 'placeholder' => 'Comment']) !!}
            {!! Form::submit('Post', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endforeach