<x-base-layout>
    <div class="container min-h-screen">
        <div class="container mx-auto px-4 shadow-sm mt-2">
            <h1 class="text-2xl font-bold mb-4 text-center">Your Order</h1>
            <div class="container w-full py-4 border row">
                {{-- <div class="col-md-4">{{ $request->id }}</div> --}}

                <img src="{{ asset($book->cover) }}" class="col-2 object-cover" alt="">
                <div class="col-10">
                    <h1>{{ $book->book_name }}</h1>
                    <p>Author : {{ $author->author }}</p>
                    <strong>{{ $book->price }} BDT</strong>
                </div>
            </div>

            <div class="flex justify-center items-center">
                <form method="POST" action="{{ route('order.store', $book->id) }}">
                    @csrf
                    <button class="btn btn-success my-4">Order now</button>
                </form>
            </div>
        </div>
    </div>
    <div class="">{{ $book }}</div>
</x-base-layout>
