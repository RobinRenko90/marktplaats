@extends('layouts.main')

@section('content')
    <div class="flex justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <div class="w-150 mt-10">
            <div class="border px-4 py-4 rounded">
                <p>orem ipsum dolor sit amet consectetur adipisicing elit. Quam necessitatibus quos labore doloremque, adipisci consequatur excepturi aperiam modi quia repellat nobis accusantium! Eos id labore sed vitae quis nobis laborum?</p>
                <ul style="list-style:disc; margin-left:20px" class="my-3">
                    <li>Eenmalig bedrag van <strong>€10,-</strong>;</li>
                    <li>Jouw advertentie krijgt meer voorrang;</li>
                    <li>Trek meer bezoekers aan.</li>
                </ul>
                
                <div>
                    <form action="{{ route('advertisement.promote', $advertisement->id) }}" method="post" id="promote">
                        @csrf
                        <input type="submit" class="w-fit mt-3 cursor-pointer inline-block px-5 py-1.5 bg-blue-500 text-white rounded-sm text-sm leading-normal" value="Promoveer deze Advertentie">
                    </form>
                </div>
            </div>
        </div>
    </div>    
@endsection()

@section('extraScript')
    <script type="text/javascript">
        $("#promote").on("submit", function(){
            return confirm("Weet je het zeker?");
        });
    </script>
@endsection