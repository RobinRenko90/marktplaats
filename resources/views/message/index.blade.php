@extends('layouts.main')

@section('content')
    <div class="flex justify-between flex-col md:flex-row mb-5">
        <p class="text-center text-xl">Mijn berichten</p>
    </div>
    <div class="grid gap-2">
        @forelse($inboxes as $inbox)

            @php
                $otherUser = $inbox->customer_id === Auth::id()
                    ? $inbox->seller
                    : $inbox->customer;
            @endphp

            <a class="border p-2 text-sm rounded" href="{{ route('message.show', $otherUser->slug) }}">
                <b>{{ $otherUser->fullName }}</b>
                <p class="text-xs text-gray-500 font-normal">
                    {{ Str::words($inbox->messages->last()->content, 15, '....') }}
                    <span class="float-right mt-5">{{ $inbox->messages->last()->created_at }}</span>
                </p>
            </a>
        @empty

        @endforelse
    </div>
@endsection
