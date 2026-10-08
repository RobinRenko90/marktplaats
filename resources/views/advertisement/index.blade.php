@extends('layouts.main')

@section('content')

    <div class="grid grid-cols-1 sm:grid-cols-8">

        <div class="sm:-ml-5 flex flex-col pr-5 mb-5">
            <strong>Filter op:</strong>
            @if($categories)
                <form action="{{ route('advertisement.index') }}" method="GET">
                    <ul>
                    @foreach($categories as $category)
                        <li>
                            <input 
                            class="mr-2" 
                            type="checkbox" 
                            name="category" 
                            id="category-{{ $category->id }}"
                            value="{{ $category->name }}"
                            {{ in_array($category->name, (array)request('category', [])) ? 'checked' : '' }}
                        >
                        <label for="category-{{ $category->id }}">{{ $category->name }}</label></li>
                    @endforeach
                    </ul>
                    <input class="bg-gray-300 p-1 mt-3 w-full rounded cursor-pointer" type="submit" value="filter">
                </form>
            @endif
        </div>
        <div class="sm:col-span-7">
            <div class="flex justify-between flex-col md:flex-row mb-5">
                <p class="text-center text-xl">Mijn advertenties</p>
                <a href="{{ route('advertisement.create') }}" class="w-fit inline-block px-5 py-1.5 mt-3 sm:mt-0 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">Nieuwe advertentie</a>
            </div>
                @include('components.alerts')
            <div class="grid items-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
                <div class="flex sm:flex-row flex-wrap items-stretch gap-5 justify-start py-1">
                    @forelse($advertisements as $advertisement)
                        <div class="border p-3 text-wrap w-full sm:w-75 rounded">
                            <p class="font-bold text-md">{{ $advertisement->title }}</p>
                            <p class="my-6">{{ Str::words($advertisement->description, 25, '...') }}</p>

                            <div>
                                <i class="text-xs">prijs: €{{ $advertisement->price }}</i>

                                <a href="{{ route('advertisement.show', $advertisement->id) }}" class="float-right">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                        <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                        <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="col-span-3">Er zijn nog geen advertenties geplaatst. Waar wacht je op en begin met plaatsen :D</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('extraScript')
<script type="text/javascript">
    $('input[type=checkbox]').on('change', function (e) {
        if ($('input[type=checkbox]:checked').length > 1) {
            $(this).prop('checked', false);
        }
    });
</script>
@endsection