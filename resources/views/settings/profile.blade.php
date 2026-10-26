@extends('layouts.main')

@section('content')
    <div>
        @include('components.alerts')
        <form class="flex flex-col" action="{{ route('setting.update-profile', $user) }}" method="post">
            @csrf
            @method('PATCH')
            <label for="first_name"><b>Voornaam</b></label>
            <input class="border rounded mb-3 px-2 py-1" type="text" name="first_name" id="first_name" value="{{ $user->first_name }}">
            <label for="last_name"><b>Achternaam</b></label>
            <input class="border rounded mb-3 px-2 py-1" type="text" name="last_name" id="last_name" value="{{ $user->last_name }}">
            <label for="email"><b>Email</b></label>
            <input class="border rounded mb-3 px-2 py-1" type="email" name="email" id="email" value="{{ $user->email }}">
            <div>
                <input type="checkbox" name="notification" id="notification" @checked(old('notification', $user->notification))><label class="ml-1" for="notification">Ik wil geen notificaties ontvangen</label>
            </div>
            <input class="mt-3 cursor-pointer inline-block px-5 py-1.5 bg-blue-500 text-white rounded-sm text-sm leading-normal" type="submit" value="Aanpassen">
        </form>
    </div>
@endsection