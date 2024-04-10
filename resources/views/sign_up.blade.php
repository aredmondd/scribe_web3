<x-wrapper css="css/login.css">
    <h1>SIGN UP</h1>

    <form method="POST" action="/signup">
        @csrf
        <input name="name" type="name" placeholder="name" value="{{ old('name') }}"><br>
        <input name="email" type="email" placeholder="email" value="{{ old('email') }}"><br>
        <input name="password" type="password" placeholder="password"><br>
        <button>submit</button>
    </form>

    <x-formErrors />

    <div class="center">
        <a class="signupLink" href="/login">already have an account? log in here.</a>
    </div>
</x-wrapper>