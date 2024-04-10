<x-wrapper css="css/login.css">
    <h1>LOGIN</h1>

    <form method="POST" action="/login">
        @csrf
        <input name="email" type="email" value="{{ old('email') }}" type="email" placeholder="email"><br>
        <input name="password" type="password" placeholder="password"><br>
        <button type="submit">submit</button>
    </form>

    <x-formErrors />
    
    <div class="center">
        <a class="signupLink" href="/signup">don't have an account? sign up here.</a>
    </div>
</x-wrapper>