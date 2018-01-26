<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">

    <a class="navbar-brand" href="{{ route('home') }}">LOGO!</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav navbar-left mr-auto ">
            <li>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </li>
        </ul>
        <div class="navbar-nav">
            <a class="nav-link" href="{{ route('messages.inbox') }}"><i class="fa fa-envelope"></i> Inbox </a>
            <a class="nav-link" href="{{ route('home') }}"><i class="fa fa-home"></i> Home </a>
            <a class="nav-link" href="{{ route('profile', \App\Models\Users\User::getUser()->profile->profile_url ? \App\Models\Users\User::getUser()->profile->profile_url : \App\Models\Users\User::getUser()->uid) }}"><img src="https://thumb1.shutterstock.com/display_pic_with_logo/2327279/450966898/stock-vector-male-profile-picture-placeholder-vector-illustration-design-social-profile-template-avatar-450966898.jpg.jpg" width="25px" class="rounded-circle">{{ Sentinel::getUser()->first_name }}</a>
            <a class="nav-link" href="{{ route('logout') }}">Log out</a>
        </div>

    </div>

</nav>
