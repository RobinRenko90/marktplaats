@extends('layouts.main')

@section('content')
    <p class="w-fit">Overzicht advertenties</p>
    <div>
        <a href="{{ route('advertisement.create') }}" class="inline-block mt-5 px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">Nieuwe advertentie</a>
    </div>
@endsection()