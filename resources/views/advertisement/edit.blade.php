@extends('layouts.main')

@section('content')
    <p class="text-center text-xl mb-5">Advertentie aanpassen</p>
    @include('components.alerts')
    <div class="grid items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <form class="grid w-150 gap-4" action="{{ route('advertisement.update', $advertisement->id) }}" method="post">
            @csrf
            @method('patch')
            <div>
                <label class="font-bold text-xs" for="title">Titel</label>
                <input class="border rounded w-full py-1 px-2" type="text" name="title" id="title" value="{{ old('title', $advertisement->title) }}">
            </div>
            <div>
                <label class="font-bold text-xs" for="description">Omschrijving</label>
                <textarea class="border rounded w-full py-1 px-2" name="description" id="description" cols='5'>{{ old('description', $advertisement->description) }}</textarea>
            </div>
            <div>
                <label class="font-bold text-xs" for="category">Categorie</label>
                <select name="category" id="category" class="border w-full py-2 px-1 rounded">
                    <option value="" disabled selected>Selecteer categorie</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $selectedCategory && $selectedCategory->id == $category->id ? 'selected' : '' }}
                        >{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>  
            <div>
                <label class="font-bold text-xs" for="price">Prijs</label>
                <input class="border rounded w-full py-1 px-2" type="text" name="price" id="price" value="{{ old('price', $advertisement->price) }}">
            </div>
        
            <input type="submit" value="Bewerken" class="cursor-pointer inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
        </form>
        <form class="mt-4" action="{{ Route('advertisement.destroy', $advertisement->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="w-full cursor-pointer inline-block px-5 py-1.5 bg-red-400 text-white dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                onclick="return confirm('Weet je zeker dat je deze advertentie wilt verwijderen?')">
                Verwijderen
            </button>
        </form>


    </div>
@endsection