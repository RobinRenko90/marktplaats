@extends('layouts.main')

@section('content')
    <p class="text-center text-xl mb-5">Advertentie aanmaken</p>
    @include('components.alerts')
    <div class="grid items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <form class="grid w-150 gap-4" action="{{ route('advertisement.store') }}" method="post">
            @csrf
            <div>
                <label class="font-bold text-xs" for="title">Titel</label>
                <input class="border rounded w-full py-1 px-2" type="text" name="title" id="title" value="{{ old('title') }}">
            </div>
            <div>
                <label class="font-bold text-xs" for="description">Omschrijving</label>
                <textarea class="border rounded w-full py-1 px-2" name="description" id="description" cols='5'>{{ old('description') }}</textarea>
            </div>
            <div>
                <label class="font-bold text-xs" for="price">Prijs</label>
                <input class="border rounded w-full py-1 px-2" type="text" name="price" id="price" value="{{ old('price') }}">
            </div>
        
            <input type="submit" value="Advertentie aanmaken" class="cursor-pointer inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
        </form>
    </div>
@endsection