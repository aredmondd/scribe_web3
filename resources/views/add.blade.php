<x-wrapper css="css/add.css">
    <div class="header">
        <h1>ADD A GAME TO YOUR BACKLOG.</h1>
    </div>

    <div class="fields">
        <form method="POST" action="/add">
            @csrf
            <input name="name" type="text" placeholder="name" value="{{ old('name') }}"><br>
            <input name="length" type="number" placeholder="est. length to beat" value="{{ old('length') }}"><br>
            <input name="owned" type="text" placeholder="do you own it? (Y/N)" id="owned-input" value="{{ old('owned') }}"><br>
            <input name="platform" type="text" placeholder="on what platform?" value="{{ old('platform') }}"><br>
            <input name="cost" type="number" placeholder="cost" id="cost-input" value="{{ old('cost') }}"><br>
            <textarea name="why" placeholder="why?" cols="20" rows="7" value="{{ old('why') }}"></textarea><br>
            <button type="submit">add</button>
        </form>

        <x-formErrors />
        
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ownedInput = document.getElementById("owned-input");
            const costInput = document.getElementById("cost-input");

            ownedInput.addEventListener("change", function() {
                if (ownedInput.value[0] === "y" || ownedInput.value[0] === "Y") {
                    costInput.value = null;
                    costInput.disabled = true;
                    costInput.placeholder = "N/A";
                } else {
                    costInput.disabled = false;
                    costInput.placeholder = "cost";
                    costInput.value = "";
                }
            });
        });
    </script>
</x-wrapper>
