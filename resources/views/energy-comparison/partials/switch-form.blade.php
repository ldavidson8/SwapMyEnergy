<form action="{{ route('residential.energy-comparison.3-browse-deals') }}" method="POST">
    @csrf
    <input type="hidden" name="tariffId" value="{{ $row['tariffId'] }}" />
    <button type="submit" class="rounded-blue-button">Get Switching</button>
</form>