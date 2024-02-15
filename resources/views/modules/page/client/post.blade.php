@extends('modules.layout.app')

@section('content')
<div class="grid grid-cols-1">
    <client 
        :avatarlogo="{{ json_encode(asset("/images/avatar.jpeg")) }}"
        :resultset="{{ json_encode($data) }}"
        :postcommenturl="{{ json_encode(route("post.comment")) }}"
        :deletecommenturl="{{ json_encode(route("delete.comment")) }}"
        :rateposturl="{{ json_encode(route("rate.post")) }}">
    </client>
 </div>
@endsection

