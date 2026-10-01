@extends('layouts.main')

@section('content')
    <div class="grid items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <h2 class="text-center text-xl font-bold mb-5">Registreren</h2>
        @include('components.alerts')
        <form class="bg-gray-200 rounded w-150 p-4 grid " action="" method="post">
            @csrf

            <div class="flex gap-4">
                <div>
                    <label class="mt-4 text-sm font-bold" for="first_name">Voornaam</label>
                    <input class="bg-white rounded py-1 px-2 w-full" type="text" name="first_name" id="first_name" value="{{ old('first_name') }}">
                </div>
                <div>
                    <label class="mt-4 text-sm font-bold" for="last_name">Achternaam</label>
                    <input class="bg-white rounded py-1 px-2 w-full" type="test" name="last_name" id="last_name" value="{{ old('last_name') }}">
                </div>
            </div>

            <label class="mt-4 text-sm font-bold" for="email">E-mail</label>
            <input class="bg-white rounded py-1 px-2" type="email" name="email" id="email" value="{{ old('email') }}">

            <label class="mt-4 text-sm font-bold" for="password">Wachtwoord</label>
            <input class="bg-white rounded py-1 px-2" type="password" name="password" id="password">

            <label class="mt-4 text-sm font-bold" for="password_confirmation">Wachtwoord herhalen</label>
            <input class="bg-white rounded py-1 px-2" type="password" name="password_confirmation" id="password_confirmation">

            <input class="font-bold mt-4 cursor-pointer bg-white rounded p-2 border border-gray-400" type="submit" value="Registreren">
        </form>
    </div>    
@endsection()