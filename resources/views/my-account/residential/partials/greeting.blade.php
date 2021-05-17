<h2>
    <?php $current_hour = date('H'); ?>
    @if ($current_hour < 12)
        Good Morning
    @elseif ($current_hour < 17)
        Good Afternoon
    @else
        Good Evening
    @endif
    {{ $user_name }}
</h2>