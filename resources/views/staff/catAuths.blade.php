<x-staff-layout>

    <div class="p-4">
        <div class="row w-full">
            <div class="col-6"><button class="w-full btn bg-white shadow py-2"
                    onclick="changeTo('cat')">Catagories</button></div>
            <div class="col-6"><button class="w-full btn bg-white py-2 shadow"onclick="changeTo('auth')">Authors</button>
            </div>
        </div>
        <div class="m-4 h-[80vh] w-full rounded-md mx-auto shadow-sm overflow-y-scroll overflow-x-hidden">
            <div class="cat" id="cat">
                <h2 class="w-full text-center py-4 text-3xl">Catagories</h2>
                <div class="container mb-4">
                    <form method="POST" action="{{ route('staff.catStore') }}">
                        @csrf
                        <div class="row min-w-full px-12 flex flex-row justify-between items-center">
                            <input
                                class="col-9 w-full rounded-md border border-[#e0e0e0] bg-white py-2 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                type="text" name="catagory" id="catagory" placeholder="Add new catagory">
                            <button type="submit" class="btn btn-success bg-success">Create</button>
                        </div>
                        @error('catagory')
                            <div class="text-sm text-danger">Please put a valid unique name </div>
                        @enderror
                    </form>
                </div>
                <div class="container">
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
                            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <table class="min-w-full">
                                        <thead class="bg-gray-200 border-b">
                                            <tr>
                                                <th scope="col"
                                                    class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                    #
                                                </th>
                                                <th scope="col"
                                                    class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                    Catagory Name
                                                </th>
                                                <th scope="col"
                                                    class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                    Handle
                                                </th>
                                                <th scope="col"
                                                    class="text-sm font-medium text-gray-900 px-6 py-4 text-left">

                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($catagories as $catagory)
                                                <tr
                                                    class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        {{ $catagory->id }}</td>
                                                    <td
                                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        {{ $catagory->catagory }}
                                                    </td>
                                                    <td
                                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        <button class="btn btn-primary btn-sm">

                                                            <i class="fas fa-fw fa-pen"></i>

                                                            Edit</button>
                                                    </td>
                                                    <td
                                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        <button class="btn btn-danger btn-sm">

                                                            <i class="fas fa-fw fa-trash"></i>

                                                            Delete</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="auth" style="display: none" id="auth">
                <h2 class="w-full text-center py-4 text-3xl">Author</h2>
                <div class="container mb-4">
                    <form method="POST" action="{{ route('staff.athStore') }}">
                        @csrf
                        <div class="row min-w-full px-12 flex flex-row justify-between items-center">
                            <input
                                class="col-9 w-full rounded-md border border-[#e0e0e0] bg-white py-2 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                type="text" name="author" id="author" placeholder="Add new Author">
                            <button class="3 btn btn-success">Create</button>
                        </div>
                        @error('catagory')
                            <div class="text-sm text-danger">Please put a valid unique name </div>
                        @enderror
                    </form>
                </div>
                <div class="container">
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
                            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <table class="min-w-full">
                                        <thead class="bg-gray-200 border-b">
                                            <tr>
                                                <th scope="col"
                                                    class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                    #
                                                </th>
                                                <th scope="col"
                                                    class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                    Author Name
                                                </th>
                                                <th scope="col"
                                                    class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                    Handle
                                                </th>
                                                <th scope="col"
                                                    class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($authors as $author)
                                                <tr
                                                    class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        {{ $author->id }}</td>
                                                    <td
                                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        {{ $author->author }}
                                                    </td>
                                                    <td
                                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        <button class="btn btn-primary btn-sm">

                                                            <i class="fas fa-fw fa-trash"></i>

                                                            Edit</button>
                                                    </td>
                                                    <td
                                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        <button class="btn btn-danger btn-sm">

                                                            <i class="fas fa-fw fa-trash"></i>

                                                            Delete</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>


        <script>
            const cat = document.getElementById('cat');
            const auth = document.getElementById('auth');

            function changeTo(x) {
                if (x == "auth") {
                    cat.style.display = "none"
                    auth.style.display = "block"
                } else {
                    cat.style.display = "block"
                    auth.style.display = "none"
                }
            }
        </script>
</x-staff-layout>
