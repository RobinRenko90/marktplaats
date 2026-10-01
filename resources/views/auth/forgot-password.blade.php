@extends('layouts.main')

@section('content')
    <div class="grid items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <h2 class="text-center text-xl font-bold mb-5">Wachtwoord vergeten</h2>
        @include('components.alerts')

        <form class="bg-gray-200 rounded w-150 p-4 grid" action="" method="post">
            @csrf

            <label class="text-sm font-bold" for="email">E-mail</label>
            <input class="bg-white rounded py-1 px-2" type="email" name="email" id="email"">

            <input class="font-bold mt-4 cursor-pointer bg-white rounded p-2 border border-gray-400" type="submit" value="Verstuur">
        </form>
    </div>
@endsection