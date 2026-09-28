@if ($errors->any())
    <div class="p-2 mb-5 bg-red-500 text-white rounded">
        <ul style="list-style">
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif