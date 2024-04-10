@props(['currentGame'])
<x-wrapper css="../css/games.css">
    <h1>{{ $currentGame->id }}</h1>
    <h1>{{ $currentGame->name }}</h1>
    <h1>{{ $currentGame->est_length }}</h1>
    <h1>{{ $currentGame->is_owned }}</h1>
    <h1>{{ $currentGame->platform }}</h1>
    <h1>{{ $currentGame->cost }}</h1>
    <h1>{{ $currentGame->why }}</h1>
    <h1>{{ $currentGame->date_started }}</h1>
    <h1>{{ $currentGame->date_dropped }}</h1>
    <h1>{{ $currentGame->date_retired }}</h1>
    <h1>{{ $currentGame->date_finished }}</h1>
    <h1>{{ $currentGame->hours_played }}</h1>
    <h1>{{ $currentGame->reason_dropped }}</h1>
    <h1>{{ $currentGame->reason_retired }}</h1>
    <h1>{{ $currentGame->want_to_revisit }}</h1>
    <h1>{{ $currentGame->did_100 }}</h1>
    <h1>{{ $currentGame->review }}</h1>
    <h1>{{ $currentGame->star_score }}</h1>
</x-wrapper>