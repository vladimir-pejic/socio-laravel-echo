<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
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
                <a class="nav-link" href="{{ route('home') }}"><i class="fa fa-home"></i> Home </a>
                <a class="nav-link" href="{{ route('chat.index') }}"><i class="fa fa-comment"></i> Chat </a>
                <a class="nav-link" href="{{ route('messages.inbox') }}"><i class="fa fa-envelope"></i> Inbox </a>
                <new-notifications
                    :unread_notifications="{{ json_encode(User::getUser()->unreadNotifications) }}"
                    :all_notifications="{{ json_encode(User::getUser()->notifications) }}">
                </new-notifications>

                <a class="nav-link" href="{{ route('profile', User::getUser()->profile->profile_url ? User::getUser()->profile->profile_url : User::getUser()->uid) }}">
                    <img src="/img/pic.jpg" width="25px" class="rounded-circle"> {{ User::getUser()->first_name }} </a>
                <a class="nav-link" href="{{ route('logout') }}">Log out</a>
            </div>

        </div>
    </div>
</nav>
