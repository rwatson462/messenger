<form method="{{ strtolower($method ?? 'post') === 'get' ? 'get' : 'post' }}">
    @if(!in_array(strtolower($method ?? 'post'), ['get', 'post']))
        @method(strtolower($method))
    @endif
    @csrf
    {{ $slot }}
</form>
