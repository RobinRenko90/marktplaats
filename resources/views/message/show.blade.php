@extends('layouts.main')

@section('content')
    <div class="mb-5 grid gap-4">
        @foreach($messageBox->messages as $message)
            <p @if($message->user_id !== Auth::user()->id) class='text-right' @else class='text-left' @endif>
                {{ $message->content }}<br>
                <span class="text-xs">{{ $message->created_at }}</span>
            </p>
        @endforeach
    </div>
    <form class="flex flex-wrap justify-center" action="{{ route('new.message', $messageBox->id) }}" method="post">
        @csrf
            <div class="w-full">
                <input class="border w-8/10 md:w-9/10 p-1 px-2 rounded-l-md" type="text" name="content" id="content" placeholder="....">
                <input type="submit" class="cursor-pointer border rounded-r-md -ml-1 p-1 w-2/10 md:w-1/10" value="Verstuur">
            </div>
        @error('content') <div class="basis-full text-red-500"> {{ $message }} <div> @enderror
    </form>
@endsection