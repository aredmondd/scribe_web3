@if(session()->has('error'))
    <div id="successNotification" class="notification">
        <div class="notification-content">
            {{ session('error') }}
        </div>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var successNotification = document.getElementById('successNotification');

        if (successNotification) {
            setTimeout(function() {
                successNotification.style.opacity = '0'; // Fade out the notification
                successNotification.style.animation = 'slideOut 0.5s ease forwards'; // Trigger slide-out animation
                setTimeout(function() {
                    successNotification.remove();
                }, 500); // Wait for the slide-out animation to finish before removing the notification
            }, 4000); // Hide the notification after 4000 milliseconds (4 seconds)
        }
    });
</script>