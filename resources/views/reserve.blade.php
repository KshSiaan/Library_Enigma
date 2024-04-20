<x-base-layout>
    <div class="container min-h-screen">

        <h1 class="text-3xl font-bold mb-4 text-center">Reservation and Hold</h1>

        <div class="container py-4">

            @foreach ($reservations as $reservation)
                <div class="bg-white p-4 rounded-lg shadow-md mb-4">
                    @auth
                        @if ($reservation->reserver_name == Auth::user()->name)
                            <h2>#{{ $reservation->reserver_number }}</h2>
                            <br>
                            <strong class="text-xl">
                                {{ $books->where('id', $reservation->book_id)->first()->book_name }}
                            </strong>

                            <div class="flex flex-row justify-between items-center">
                                <p>Reservation Date : {{ $reservation->reservation_date }}</p>
                                <p> Status : {{ $reservation->status }}</p>
                                @if ($reservation->status == 'Returned')
                                    <p>Return Date : {{ $reservation->return_date }}</p>
                                @endif
                            </div>
                            <p>Remark: {{ $reservation->remarks }}</p>
                        @endif
                    @else
                        <h2 class="text 2xl text-center text-capitalize">Please <a href="{{ route('login') }}">Log in</a>
                            first</h2>
                    @endauth

                </div>
            @endforeach

        </div>

    </div>
</x-base-layout>
