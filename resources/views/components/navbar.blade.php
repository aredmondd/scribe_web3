<nav class="navbar">
    @guest
    <a href="/" class="{{ request()->is('/') ? 'active' : '' }} link">home</a>
    <a href="/aidenredmond" class="{{ request()->is('aidenredmond')  ? 'active' : '' }} link">about</a>
    <a href="/add" class="navbar_heading">SCRIBE</a>
    <a href="/signup" class="{{ request()->is('signup') ? 'active' : '' }} link">sign up</a>
    <a href="/login" class="{{ request()->is('login') ? 'active' : '' }} link">login</a>
    @endguest

    @auth
    <a href="/" class="{{ request()->is('/') ? 'active' : '' }} link">home</a>
    <a href="/all_games" class="{{ request()->is('all_games')  ? 'active' : '' }} link">games</a>
    <a href="/add" class="navbar_heading">SCRIBE</a>
    <a href="/stats" class="{{ request()->is('stats') ? 'active' : '' }} link">stats</a>
    <form method="POST" action="/logout" id="logoutForm">
        @csrf
        <button class="link" type="submit">logout</button>
    </form>
    @endauth
</nav>

<x-errorNotification />