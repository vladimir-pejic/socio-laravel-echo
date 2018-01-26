@if(isset($errors))
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endif
@if (session('alert-error'))
    <div class="alert alert-error">
        {{ session('alert-error') }}
    </div>
@endif
@if (session('alert-status'))
    <div class="alert alert-success">
        {{ session('alert-success') }}
    </div>
@endif
@if (session('alert-info'))
    <div class="alert alert-info">
        {{ session('alert-info') }}
    </div>
@endif