@if ($type == 'success')

    @if (session()->has($target))   
        <small class="success">
            <i class="fas fa-exclamation-circle"></i>
            {{ session()->get($target) }}
        </small>
    @endif

@elseif ($type == 'error')

    @error($target)
        <small class="error">
            <i class="fas fa-exclamation-circle"></i>
            {{ $message }}
        </small>
    @enderror

@endif