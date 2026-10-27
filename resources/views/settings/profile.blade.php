@extends('layouts.main')

@section('content')
    <p class="text-center text-xl mb-5">Profiel</p>
    @include('components.alerts')
    <div class="grid items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <form class="grid w-150 gap-4" action="{{ route('setting.update-profile', $user) }}" method="post">
            @csrf
            @method('PATCH')
            <div>
                <label class="font-bold text-xs" for="first_name"><b>Voornaam</b></label>
                <input class="border rounded w-full py-1 px-2" type="text" name="first_name" id="first_name" value="{{ $user->first_name }}">
            </div>
            <div>
                <label class="font-bold text-xs" for="last_name"><b>Achternaam</b></label>
                <input class="border rounded w-full py-1 px-2" type="text" name="last_name" id="last_name" value="{{ $user->last_name }}">
            </div>
            <div>
                <label class="font-bold text-xs" for="email"><b>Email</b></label>
                <input class="border rounded w-full py-1 px-2" type="email" name="email" id="email" value="{{ $user->email }}">
            </div>
            <div>
                <input type="checkbox" name="notification" id="notification" @checked(old('notification', $user->notification))><label class="ml-1" for="notification">Ik wil geen notificaties ontvangen</label>
            </div>
            <input class="cursor-pointer inline-block px-5 py-1.5 bg-blue-500 text-white rounded-sm text-sm leading-normal" type="submit" value="Aanpassen">
        </form>
    </div>
@endsection