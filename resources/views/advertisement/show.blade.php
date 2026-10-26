@extends('layouts.main')

@section('content')

    @include('components.alerts')

    <div class="flex justify-center mb-4 gap-5 ">
        <p class="text-center text-xl mb-5 ">{{ $advertisement->title }}
             @if($advertisement->premium == 1)
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="float-right size-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                </svg>
            @endif
        </p>
        @if(count($advertisement->categories))
            <div>
                @foreach($advertisement->categories as $category)
                    <span class="bg-amber-400 w-fit rounded-full px-3 py-1 text-white text-xs">{{ $category->name }}</span>
                @endforeach
            </div>
        @endif()    
    </div>

    <div class="flex flex-col md:flex-row justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <div class="flex flex-col justify-between md:w-150 gap-4">
            <div>
                <p class="">{{ $advertisement->description }}</p>

                <p class="mt-5">Prijs: €{{ $advertisement->price }}</p>
            </div>

            @can('update', $advertisement)
                <div>
                    <a href="{{ route('advertisement.edit', $advertisement->id) }}" class="w-fit mt-3 cursor-pointer inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        Bewerken
                    </a>

                    @if($advertisement->premium != 1)
                    <a href="{{ route('advertisement.promote.post', $advertisement->id) }}" 
                        class="w-fit mt-3 cursor-pointer inline-block px-5 py-1.5 bg-blue-500 text-white rounded-sm text-sm leading-normal">Promoveer advertentie
                    </a>
                    @endif
                </div>
            @endcan
        </div>
        <div>
            @include('components.biddings', ['model' => $advertisement])
        </div>
    </div>
@endsection

@section('extraScript')
    <script type="text/javascript">
        $("#offer").on("submit", function(){
            return confirm("Weet je het zeker?");
        });

    </script>
@endsection