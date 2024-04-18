@props(['game'])
<div class="row">
    <p style="text-align: left;">{{ $game->name }}</p>
    <p>{{ $game->est_length }} hrs</p>
    <p>{{ $game->is_owned === 1 ? 'YES' : 'NO' }}</p>
    <p>{{ $game->platform }}</p>
    <p>{{ $game->cost === null ? 'N/A' : '$' . $game->cost }}</p>
    <p><a><span class="material-symbols-outlined">sync_alt</span></a></p>
    <p><a href="/games/delete/{{$game->id}}"><span class="material-symbols-outlined">delete</span></a></p>
</div>

<!-- href="/all_games/{{$game->id}} -->