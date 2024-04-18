<x-wrapper css="../../css/games.css">
    <div class="filters">
        <h2 id="filterTitle">{{$title_text}}</h2>
        <form method="GET" action="/games" id="searchForm">
            <input id="searchInput" type="text" name="search" placeholder="search your games" value="{{ request()->input('search') }}">
        </form>
        <div class="right">
            <a href="/games/backlog"><button class="filter-btn" style="background: #E4572E" data-title="Backlog">Backlog</button></a>
            <a href="/games/currently_playing"><button class="filter-btn" style="background: #F3A712" data-title="Currently Playing">Currently Playing</button></a>
            <a href="/games/dropped"><button class="filter-btn" style="background: #A8C686" data-title="Dropped">Dropped</button></a>
            <a href="/games/shelved"><button class="filter-btn" style="background: #669BBC" data-title="Shelved">Shelved</button></a>
            <a href="/games/beat"><button class="filter-btn" style="background: #7189E0" data-title="Beaten">Beat</button></a>
        </div>
    </div>
    <div class="table">
        <div class="header">
            <div class="col" style="text-align: left; padding-left: 10px"><a href="/games/{{$current_location}}/sortby=name">NAME</a></div>
            <div class="col"><a href="/games/{{$current_location}}/sortby=length">EST LENGTH</a></div>
            <div class="col"><a href="/games/{{$current_location}}/sortby=owned">OWNED</a></div>
            <div class="col"><a href="/games/{{$current_location}}/sortby=platform">PLATFORM</a></div>
            <div class="col"><a href="/games/{{$current_location}}/sortby=cost">COST</a></div>
            <div class="col">UPDATE</div>
            <div class="col">DELETE</div>
        </div>
    </div>

    @foreach($games as $game)
        <x-row :game=$game/>
    @endforeach
    
    @if ($games->count() == 0)
        <p style="text-align: center; margin-top: 15px;">so empty...</p>
    @endif
</x-wrapper>