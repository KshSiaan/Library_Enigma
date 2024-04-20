<x-base-layout>
    <div class="container min-h-screen">
        <form action="">
            <div class="row flex flex-row justify-center items-center px-12 py-4">
                <input type="text" name="search" id="search" value="{{ $search }}"
                    class="col-7 rounded-md border border-[#e0e0e0] bg-white py-2 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                <button type="submit" class=" ml-4 btn btn-primary col-1">Search</button>
            </div>
        </form>


        <div class="container w-full shadow-sm py-4 flex flex-wrap justify-content-around">

            @foreach ($books as $book)
                <a href="  {{ route('book', $book->id) }} " class="text-decoration-none">
                    <a>
                        <div
                            class="flex-shrink-0 m-6 relative bg-gray-300 overflow-hidden rounded-lg max-w-xs shadow-sm hover:shadow-xl transition-all duration-300 ease-in-out transform hover:scale-[1.02]">
                            <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none"
                                style="transform: scale(1.5); opacity: 0.1;">
                                <rect x="159.52" y="175" width="152" height="152" rx="8"
                                    transform="rotate(-45 159.52 175)" fill="white" />
                                <rect y="107.48" width="152" height="152" rx="8"
                                    transform="rotate(-45 0 107.48)" fill="white" />
                            </svg>
                            <div class="relative pt-10 px-10 flex items-center justify-center">
                                <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3"
                                    style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;">
                                </div>
                                <img class="relative w-40 h-[174px] object-contain" src="{{ asset($book->cover) }}"
                                    alt="">
                            </div>
                            <div class="relative text-gray-800 px-6 pb-6 mt-6">
                                <span class="block opacity-75 mb-1">
                                    {{ $author = $authors->where('id', $book->author_id)->first()->author }}</span>
                                <div class="">
                                    <span class="block mb-2 font-semibold text-xl px-2">{{ $book->book_name }}</span>
                                    <span
                                        class="block h-[34px] min-w-1/3 bg-white rounded-full text-orange-400 text-md font-bold px-4 py-2 flex items-center justify-center">
                                        {{ $book->price }} BDT
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
            @endforeach

        </div>


        <h1 class="text-2xl text-center">Discover our latest Books</h1>

        <div class="row container mt-2">

            @foreach ($allBooks->reverse() as $book)
                <a href="  {{ route('book', $book->id) }} " class="text-decoration-none">
                    <a>
                        <div
                            class="flex-shrink-0 m-6 relative bg-gray-300 overflow-hidden rounded-lg max-w-xs shadow-sm hover:shadow-xl transition-all duration-300 ease-in-out transform hover:scale-[1.02]">
                            <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none"
                                style="transform: scale(1.5); opacity: 0.1;">
                                <rect x="159.52" y="175" width="152" height="152" rx="8"
                                    transform="rotate(-45 159.52 175)" fill="white" />
                                <rect y="107.48" width="152" height="152" rx="8"
                                    transform="rotate(-45 0 107.48)" fill="white" />
                            </svg>
                            <div class="relative pt-10 px-10 flex items-center justify-center">
                                <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3"
                                    style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;">
                                </div>
                                <img class="relative w-40 h-[174px] object-contain" src="{{ asset($book->cover) }}"
                                    alt="">
                            </div>
                            <div class="relative text-gray-800 px-6 pb-6 mt-6">
                                <span class="block opacity-75 mb-1">
                                    {{ $author = $authors->where('id', $book->author_id)->first()->author }}</span>
                                <div class="">
                                    <span class="block mb-2 font-semibold text-xl px-2">{{ $book->book_name }}</span>
                                    <span
                                        class="block h-[34px] min-w-1/3 bg-white rounded-full text-orange-400 text-md font-bold px-4 py-2 flex items-center justify-center">
                                        {{ $book->price }} BDT
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
            @endforeach
        </div>
    </div>
</x-base-layout>
