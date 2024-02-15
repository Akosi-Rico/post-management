@extends('modules.layout.app')

@section('content')

<profile
    :avatarlogo="{{ json_encode(asset("/images/avatar.jpeg")) }}"
    :newpostbaseurl="{{ json_encode(route("account.index"))}}"
    :resultset="{{ json_encode($data) }}"
    :postcommenturl="{{ json_encode(route("post.comment")) }}"
    :deletecommenturl="{{ json_encode(route("delete.comment")) }}"
    :canfilterposturl="{{ json_encode(route("filter.post")) }}">
</profile>
@endsection
