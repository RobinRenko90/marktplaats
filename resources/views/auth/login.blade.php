@extends('layouts.main')

@section('content')
    <div class="grid items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <h2 class="text-center text-xl font-bold mb-5">Welkom</h2>
        @include('components.alerts')

        <form class="bg-gray-200 rounded w-150 p-4 grid" action="{{ route('login') }}" method="post">
            @csrf

            <label class="text-sm font-bold" for="email">E-mail</label>
            <input class="bg-white rounded py-1 px-2" type="email" name="email" id="email"">

            <label class="mt-4 text-sm font-bold" for="password">Wachtwoord</label>
            <input class="bg-white rounded py-1 px-2" type="password" name="password" id="password">

            <a href="{{ route('forgotPassword.show') }}" class="text-xs mt-2">Wachtwoord vergeten</a>

            <input class="font-bold mt-4 cursor-pointer bg-white rounded p-2 border border-gray-400" type="submit" value="login">
        </form>
        <div class="px-5 mt-3 text-right">
            <ul>
                <li><a href="{{ route('registration.show') }}">Registreren</a></li>
            </ul>

        </div>
    </div>
@endsection