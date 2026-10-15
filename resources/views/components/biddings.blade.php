<div class="mt-5 md:mt-0 md:ml-10">
    <strong>Biedingen:</strong>
    <ul style="list-style: disc;" class="ml-4">
        @foreach($model->biddings as $bidding)
            <li>{{ $bidding->user->fullName }} heeft geboden: €{{ $bidding->value }}</li>
        @endforeach
    </ul>
    @if($model->user_id != Auth::user()->id)
        <form class="mt-5" id="offer" action="{{ route('advertisement.bidding', $model) }}" method="post">
            @csrf
            <div>
                <input class="border p-1.5" type="text" placeholder="bedrag..." name="value" id="value">
            </div>
            <input type="submit" value="bieden" 
                class="w-full mt-3 cursor-pointer inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
            >
        </form>
    @endif
</div>