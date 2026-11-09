@props(['username' => null])

<header class="site-header">
    <a class="brand" href="{{ $username ? route('dashboard', ['username' => $username]) : route('login') }}">
        <span>PERSELA <strong>LAMONGAN</strong></span>
    </a>

    @if ($username)
        <nav class="site-nav" aria-label="Navigasi utama">
            <a href="{{ route('dashboard', ['username' => $username]) }}" @if (request()->routeIs('dashboard')) aria-current="page" @endif>Dashboard</a>
            <a href="{{ route('pengelolaan', ['username' => $username]) }}" @if (request()->routeIs('pengelolaan')) aria-current="page" @endif>Pengelolaan</a>
            <a href="{{ route('profile', ['username' => $username]) }}" @if (request()->routeIs('profile')) aria-current="page" @endif>Profil</a>
        </nav>
        <span class="nav-user">{{ $username }}</span>
    @else
        <span class="nav-caption">LASKAR JOKO TINGKIR</span>
    @endif
</header>
