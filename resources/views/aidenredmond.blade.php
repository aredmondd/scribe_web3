<x-wrapper css="css/aidenredmond.css">
    <div class="table">
        <div class="profile">
            <img src="images/redmond_v1.JPG" alt="creator">
            <h2>Aiden Redmond</h2>
        </div>
        <div class="col">
            <h4># of Games Beat</h4>
            <p>{{ $numComplete }}</p>
        </div>
        <div class="col">
            <h4># of Hours Played</h4>
            <p>{{ $hoursPlayed }}</p>
        </div>
        <div class="col">
            <h4># of Games Dropped</h4>
            <p>{{ $numDropped }}</p>
        </div>
        <div class="col">
            <h4>% Success Rate</h4>
            <p>{{ $successRate }}</p>
        </div>
    </div>
</x-wrapper>