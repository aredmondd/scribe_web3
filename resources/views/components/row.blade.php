@props(['game'])
<a class="row" href="/games/{{$game->id}}">
    <p>{{ $game->name }}</p>
    <p>{{ $game->est_length }} hrs</p>
    <p>{{ $game->is_owned === 1 ? 'YES' : 'NO' }}</p>
    <p>{{ $game->platform }}</p>
    <p>{{ $game->cost === null ? 'N/A' : '$' . $game->cost }}</p>
    <p>{{ $game->why }}</p>
</a>