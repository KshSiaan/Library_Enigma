<x-staff-layout>
    <form method="POST" action="{{ route('staff.createBook') }}" enctype="multipart/form-data">
        @csrf
        <div class="p-4">
            <h1 class="font-medium text-xl text-center">Add a book to the library database</h1>
            <div class="container flex flex-row justify-end"><button type="submit" class="btn btn-success bg-success">Add
                    Book</button></div>
            <div class="m-4 h-[80vh] w-full rounded-md mx-auto shadow-sm overflow-y-scroll overflow-x-hidden">
                <div class="row">
                    <div class="col-3">

                        <div class="max-w-2xl mx-auto">

                            <div class="flex items-center justify-center w-full">
                                <label for="cover"
                                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <p class="mb-2 text-md text-gray-500 font-bold">Book Cover</p>
                                        <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                            </path>
                                        </svg>
                                        <p id="file-name" class="mb-2 text-sm text-gray-900"><span
                                                class="font-semibold">Click to upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG or JPG</p>
                                    </div>
                                    <input id="cover" name="cover" type="file" class="hidden"
                                        onchange="updateFileName(this)" />
                                </label>


                            </div>
                        </div>

                        <!-- Second column -->

                    </div>
                    <div class="col-9">
                        <div class="my-2 w-full">
                            <label for="book_name" class="mb-2 block text-base font-medium text-[#07074D]">
                                Book Name
                            </label>
                            <input type="text" name="book_name" id="book_name"
                                class="w-[97.5%] rounded-md border border-[#e0e0e0] bg-white py-2 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                        <div class="my-2">

                            <div class="row w-full">
                                <div class="col-6"><label for="publisher"
                                        class="mb-2 block text-base font-medium text-[#07074D]">
                                        Author
                                    </label>
                                    <select name="author_id" id="author_id"
                                        class="w-[97.5%] rounded-md border border-[#e0e0e0] bg-white py-2 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                        <option value="unknown">Unknown</option>
                                        @foreach ($authors as $author)
                                            <option value="{{ $author->id }}">{{ $author->author }}</option>
                                        @endforeach


                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="price" class="mb-2 block text-base font-medium text-[#07074D]">
                                        Price
                                    </label>
                                    <input type="number" name="price" id="price"
                                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-2 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                </div>
                            </div>
                        </div>
                        <div class="my-2 w-full">
                            <div class="row w-full">
                                <div class="col-4">
                                    <label for="stock" class="mb-2 block text-base font-medium text-[#07074D]">
                                        Books in stock
                                    </label>
                                    <input type="number" name="stock" id="stock"
                                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-2 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                </div>
                                <div class="col-4">
                                    <label for="catagory_id" class="mb-2 block text-base font-medium text-[#07074D]">
                                        Genre / Catagory
                                    </label>
                                    <select name="catagory_id" id="catagory_id"
                                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-2 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                        @foreach ($catagories as $catagory)
                                            <option value="{{ $catagory->id }}">{{ $catagory->catagory }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="language" class="mb-2 block text-base font-medium text-[#07074D]">
                                        Language
                                    </label>
                                    <select name="language" id="language"
                                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-2 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                        <option value="english">English</option>
                                        <option value="bangla">Bangla</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="w-full mx-auto">
                            <label for="book_detail" class="mb-2 block text-base font-medium text-[#07074D]">
                                Book Details
                            </label>
                            <textarea type="text" name="book_detail" id="book_detail"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-2 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                rows="10" spellcheck="true" style="resize: vertical"></textarea>

                        </div>
                    </div>




                </div>


            </div>
    </form>

</x-staff-layout>
