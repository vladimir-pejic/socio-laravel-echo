<div class="col-md-12">
    <i class="fa fa-image"></i>
    <i class="fa fa-file"></i>
    <i class="fa fa-film"></i>
</div>

<div class="col-md-12">
    @php
    if(isset($profile)) $target_id = $profile->id;
    else $target_id = \App\Models\Users\User::getUser()->id;
    @endphp
    {!! Form::open(['method' => 'post', 'route' => ['user.status.store', $target_id]]) !!}
    {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => 3, 'id'=>'user_status', 'placeholder' => 'Give some content to the world!']) !!}
    {!! Form::submit('Post', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
</div>

<div class="col-md-12"><hr></div>