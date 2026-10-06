@extends('layouts.main')

@section('content')
    <p class="text-center text-xl mb-5">Categorie aanmaken</p>
    @include('components.alerts')
    <div class="grid items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <form class="grid w-150 gap-4" action="{{ route('categories.store') }}" method="post">
            @csrf
            <div>
                <label class="font-bold text-xs" for="name">Naam categorie</label>
                <input class="border rounded w-full py-1 px-2" type="text" name="name" id="name" value="{{ old('name') }}">
            </div>
            <input type="submit" value="Categorie aanmaken" class="cursor-pointer inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
        </form>
    </div>
@endsection