@if (session('status'))
    <div class="mb-4 rounded-lg bg-green-50 border border-green-400 text-green-800 px-4 py-3 text-sm">
        {{ session('status') }}
    </div>
@endif

@if ($errors->any())
    <div class="mb-4 rounded-lg bg-red-50 border border-red-400 text-red-800 px-4 py-3 text-sm">
        <div class="font-semibold mb-1">Se encontraron errores:</div>
        <ul class="list-disc list-inside space-y-0.5">
            @foreach ($errors->all() as $error)
                <li class="text-red-700">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
