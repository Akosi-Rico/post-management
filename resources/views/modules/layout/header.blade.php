<navbar
    :headerlogo="{{ json_encode(asset("/images/logo.jpg")) }}"
    :avatarlogo="{{ json_encode(asset("/images/avatar.jpeg")) }}"
    :logouturl="{{ json_encode(route('logout')) }}"
    :profileurl="{{ json_encode(route("account.index"))}}"
    :homeurl="{{ json_encode(route("home.index"))}}"
    :accountname="{{ json_encode(auth()->user()->name) }}">
</navbar>