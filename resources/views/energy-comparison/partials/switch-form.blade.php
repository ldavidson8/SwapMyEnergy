<form action="{{ route('residential.energy-comparison.3-browse-deals') }}" method="POST">
    @csrf
    <input type="hidden" name="tariffPosition" value="{{ $row['tariffPosition'] }}" />
    <button type="submit" class="switch-form-button">Get Switching</button>
</form>