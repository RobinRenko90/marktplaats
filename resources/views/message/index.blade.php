@extends('layouts.main')

@section('content')
    <div class="grid">
    @forelse($messageboxes as $messagebox)
        <a href="{{ route('messagebox.show', $messagebox->id) }}">
            @if($messagebox->seller == Auth::user())
                {{ $messagebox->interested->fullName }}
            @else
                {{ $messagebox->seller->fullName }}
            @endif
        </a>
    @empty
    </div>
    @endforelse
@endsection