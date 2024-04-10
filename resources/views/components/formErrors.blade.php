@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color: var(--flame); text-align: center;">{{ $error }}</li>
            @endforeach
        </ul>
        <br>
    </div>
@endif