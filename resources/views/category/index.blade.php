@extends('layouts.main')

@section('content')
    @include('components.alerts')
    <div class="grid w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <p class="text-center">Categorieën</p>
        <a href="{{ route('categories.create') }}" class="w-fit m-auto inline-block mt-5 px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">Nieuwe categorie</a>

        <div>
            <table class="text-left">
                <tbody class="grid gap-2">
                    <tr>
                        <th width='300'>Naam</th>
                        <th width='200'>Actie</th>
                    </tr>
                    @foreach($categories as $category)
                        <tr>
                            <td width='300'>{{ $category->name }}</td>
                            <td width='200'><a href="{{ route('categories.edit', $category->id) }}">Aanpassen</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection