@include('comps.header.header')
@include('comps.navbar.nav')
    <h1>Layout prueba</h1>
    <ul>
    @foreach($users as $user)
        @if($user->user == 'Valeria')
        <li><b>{{ $user->user }}</b></li>
        @elseif($user->user == 'Jeremy')
        <li><b>{{ $user->user }}</b></li>
        @else
        <li>{{ $user->user }}</li>
        @endif
    @endforeach
    </ul>
    
</body>
</html>