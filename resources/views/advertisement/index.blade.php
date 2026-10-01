@extends('layouts.main')

@section('content')
    @include('components.alerts')
    <p class="text-center">Mijn advertenties</p>
    <div class="grid items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <a href="{{ route('advertisement.create') }}" class="w-fit m-auto inline-block mt-5 px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">Nieuwe advertentie</a>
        <div class="grid grid-cols-3 gap-4 py-5">
            @forelse($advertisements as $advertisement)
                <div class="border mt-4 p-3 text-wrap w-full rounded">
                    <p class="font-bold text-md">{{ $advertisement->title }}</p>
                    <p class="my-6">{{ $advertisement->description }}</p>

                    <i class="text-xs">prijs: €{{ $advertisement->price }}</i>

                    <a href="{{ route('advertisement.edit', $advertisement->id) }}" class="float-right">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </a>
                </div>
            @empty
                <p class="col-span-3">Er zijn nog geen advertenties geplaatst. Waar wacht je op en begin met plaatsen :D</p>
            @endforelse
        </div>
    </div>
@endsection()
