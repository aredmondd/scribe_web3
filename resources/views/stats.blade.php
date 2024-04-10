<x-wrapper css="css/stats.css">
    <div class="stats">
        <h1>WHAT YOU'VE DONE THIS YEAR:</h1>
    </div>
    <div class="sixgrid">
        <div class="card">
            <p>you played</p>
            <h3><span class="lightpurple">{{ $numComplete }}</span> GAMES</h3>
            <p>probably more than last year.</p>
        </div>
        <div class="card">
            <p>it took</p>
            <h3><span class="lightpurple">{{ $hoursPlayed }}</span> HOURS</h3>
            <p>sheeeeeeeesh</p>
        </div>
        <div class="card">
            <p>you dropped</p>
            <h3><span class="lightpurple">{{ $numDropped }}</span> GAMES</h3>
            <p>...it happens.</p>
        </div>
        <div class="card">
            <p>with a</p>
            <h3><span class="lightpurple">{{ $successRate }}</span>%</h3>
            <p>success rate</p>
        </div>
    </div>
    <br>
</x-wrapper>