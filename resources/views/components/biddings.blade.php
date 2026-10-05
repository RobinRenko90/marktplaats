<div class="ml-10">
    <ul style="list-style: disc;" class="ml-4">
        @foreach($model->biddings as $bidding)
            <li>{{ $bidding->user->fullName }} heeft geboden: €{{ $bidding->value }}</li>
        @endforeach
    </ul>
    @if($model->user_id != Auth::user()->id)
        <form class="mt-5" action="{{ route('advertisement.bidding', $model) }}" method="post">
            @csrf
            <div>
                <input class="border p-1.5" type="text" name="value" id="value">
            </div>
            <input type="submit" value="bieden" 
                class="w-full mt-3 cursor-pointer inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                onClick="confirm('Weet je zeker dat je het bod wilt bevestigen?')"
            >
        </form>
    @endif
</div>