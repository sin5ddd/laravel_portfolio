
@if(session('message'))
	<nav id="flash-message" class="flash-message-{{session('type')}}">{{session('message')}}</nav>
@endif