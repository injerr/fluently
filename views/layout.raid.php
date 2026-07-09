@include('comps/header/header')
@include('comps/navbar/nav')
    <h1>Layout prueba</h1>
    @foreach($users as $user)
    <p>Username: {{ $user->user }}</p>
    @endforeach
    @include('docs/index')
    
</body>
</html>