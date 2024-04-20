<x-base-layout>
    <div class="mt-3 container min-h-screen">
        <div class="row w-full">
            <div class="col-3"><img class="w-full h-full"
                    style="object-fit: cover; border-radius: 10px; max-height: 300px; max-width: 200px;"
                    src="{{ asset($book->cover) }}" alt="{{ asset($book->cover) }}">
            </div>
            <div class="col-9">
                <h3 class="text-2xl font-bold "> {{ $book->book_name }}</h3>
                <p>Author: {{ $author = $authors->where('id', $book->author_id)->first()->author }}</p>
                <p class="py-2">Catagory:
                    {{ $catagory = $catagories->where('id', $book->catagory_id)->first()->catagory }}</p>
                <p class="py-2">{{ $book->book_detail }}</p>
            </div>
        </div>
        <div class="flex flex-col justify-start items-start">
            <button class="btn btn-lg btn-outline-success my-2">Want to read</button>
            <form method="POST" action="{{ route('orderBook', $book->id) }}">
                @csrf
                <button class="btn btn-lg btn-outline-success mb-2">Purchase |
                    {{ $book->price }}
                    BDT</button>
            </form>
        </div>

    </div>

</x-base-layout>
