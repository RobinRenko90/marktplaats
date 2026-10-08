@extends('layouts.main')

@section('content')
    <p class="text-center text-xl mb-5">Categorie aanpassen</p>
    @include('components.alerts')
    <div class="grid items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <form class="grid w-150 gap-4" action="{{ route('categories.update', $category) }}" method="post">
            @csrf
            @method('PATCH')
            <div>
                <label class="font-bold text-xs" for="name">Naam categorie</label>
                <input class="border rounded w-full py-1 px-2" type="text" name="name" id="name" value="{{ $category->name }}">
            </div>
            <input type="submit" value="Categorie aanpassen" class="cursor-pointer inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
        </form>
        <form class="mt-4" action="{{ Route('categories.destroy', $category->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="w-full cursor-pointer inline-block px-5 py-1.5 bg-red-400 text-white dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                onclick="return confirm('Weet je zeker dat je deze categorie wilt verwijderen?')">
                Verwijderen
            </button>
        </form>
    </div>
@endsection