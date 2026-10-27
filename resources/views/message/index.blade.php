@extends('layouts.main')

@section('content')
    <div class="grid">
        @forelse($inboxes as $inbox)

            @php
                $otherUser = $inbox->customer_id === Auth::id()
                    ? $inbox->seller
                    : $inbox->customer;
            @endphp

            <a href="{{ route('message.show', $otherUser->slug) }}">
                {{ $otherUser->fullName }}
            </a>


                {{-- @if($inbox->customer->id == Auth::user()->id)
                    <a href="{{ route('message.show', $inbox->seller->slug) }}">
                        {{ $inbox->seller->fullName }}
                    </a>
                @else
                    <a href="{{ route('message.show', $inbox->customer->slug) }}">
                        {{ $inbox->customer->fullName }}
                    </a>
                @endif --}}
        @empty

        @endforelse
    </div>
@endsection
