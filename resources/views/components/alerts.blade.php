@if ($errors->any())
    <div class="p-2 mb-5 bg-red-500 text-white rounded">
        <ul style="list-style">
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="p-2 my-5 bg-green-500 text-white rounded">
        {{ session('success') }}
    </div>
@endif