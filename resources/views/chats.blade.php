@extends('layouts.app')

@section('content')
<div class="container">

    <chats :auth_user="{{ auth()->user() }}"></chats>

</div>
@endsection
