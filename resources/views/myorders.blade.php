<x-base-layout>
    <div class="my-2">
        <div class="container">
            @foreach ($orders as $order)
                <div class="bg-white p-4 rounded-lg shadow-md mb-4">
                    @auth
                        <h2>#{{ $order->id }}</h2>
                        <br>
                        <strong
                            class="text-2xl">{{ $book = $books->where('id', $order->book_id)->first()->book_name }}</strong>
                        <br>
                        <strong class="text-xl">
                            {{ $order->user }}
                        </strong>
                        <br>
                        <p>{{ $order->email }}</p>

                        <div class="flex flex-row justify-between items-center">
                            <p>Ordered at : {{ $order->created_at }}</p>
                            <p> Status : {{ $order->status }}</p>
                        </div>
                    @else
                        <h2 class="text 2xl text-center text-capitalize">Please <a href="{{ route('login') }}">Log in</a>
                            first</h2>
                    @endauth

                </div>
            @endforeach

        </div>
    </div>
</x-base-layout>
