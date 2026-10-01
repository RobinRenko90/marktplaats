@extends('layouts.main')

@section('content')
    <p class="text-center text-xl mb-5">{{ $advertisement->title }}</p>
    @include('components.alerts')
    <div class="grid items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <div class="grid w-150 gap-4">
            <div>
                <p>{{ $advertisement->title }}</p>

                <p>{{ $advertisement->description }}</p>

                <p>Prijs: €{{ $advertisement->price }}</p>
            </div>
        </div>
    </div>
@endsection