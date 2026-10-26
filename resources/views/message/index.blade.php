@extends('layouts.main')

@section('content')
    <div class="grid">
    @forelse($messageboxes as $messagebox)
            @if($messagebox->seller == Auth::user())
                <a href="{{ route('message.show', $messagebox->interested->slug. '-' . $messagebox->interested->id) }}">
                    {{ $messagebox->interested->fullName }}
                </a>
            @else
                <a href="{{ route('message.show', $messagebox->seller->slug. '-' . $messagebox->seller->id) }}">
                    {{ $messagebox->seller->fullName }}
                </a>
            @endif
    @empty
    </div>
    @endforelse
@endsection