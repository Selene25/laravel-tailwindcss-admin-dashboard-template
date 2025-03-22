@if(session('success'))
    <div class="text-green-500 text-sm mt-2">
        {{ session('success') }}
    </div>
@endif