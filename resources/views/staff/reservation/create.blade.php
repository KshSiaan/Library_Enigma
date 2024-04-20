<x-staff-layout>
    <form method="POST" action="{{ route('staff.reservation.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="p-4">
            <h1 class="font-medium text-xl text-center">Book Reservation </h1>
            <div class="container flex flex-row justify-end"><button type="submit" class="btn btn-success bg-success">Add
                    Reservation</button></div>
            <div class="m-4 h-[80vh] w-full rounded-md mx-auto shadow-sm overflow-y-scroll overflow-x-hidden">
                <div class="row">
                    <div class="col-2">


                        <!-- Second column -->

                    </div>
                    <div class="col-9">
                        <div class="my-2 w-full">
                            <label for="book_name" class="mb-2 block text-base font-medium text-[#07074D]">
                             Select   Book
                            </label>
                            <select name="book_id" id="book_id"
                                    class="w-[97.5%] rounded-md border border-[#e0e0e0] bg-white py-2 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">

                                @foreach ($books as $book)
                                    <option value="{{ $book->id }}">{{ $book->book_name }}</option>
                                @endforeach


                            </select>
                        </div>
                        <div class="my-2">
                            <label for="reserver_name" class="mb-2 block text-base font-medium text-[#07074D]">
                                Reserver Name
                            </label>
                            <input type="text" name="reserver_name" id="reserver_name"
                                   class="w-[97.5%] rounded-md border border-[#e0e0e0] bg-white py-2 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                        <div class="my-2">
                            <label for="reserver_name" class="mb-2 block text-base font-medium text-[#07074D]">
                                Reserver Number
                            </label>
                            <input type="text" name="reserver_number" id="reserver_number"
                                   class=" w-[97.5%] rounded-md border border-[#e0e0e0] bg-white py-2 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                        <div class="my-2">
                            <label for="reservation_date" class="mb-2 block
                                text-base font-medium text-[#07074D]">
                                Reservation Date
                            </label>
                            <input type="date" name="reservation_date" id="reservation_date"
                                   class="w-[97.5%] rounded-md border border-[#e0e0e0] bg-white py-2 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                        <div class="my-2">
                            <label for="return_date" class="mb-2 block
                                text-base font-medium text-[#07074D]">
                                Return Date
                            </label>
                            <input type="date" name="return_date" id="return_date"
                                   class="w-[97.5%] rounded-md border border-[#e0e0e0] bg-white py-2 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                        <div class="my-2">
                            <label for="remarks" class="mb-2 block text-base font-medium text-[#07074D]">
                               Remarks
                            </label>
                            <textarea type="text" name="remarks" id="remarks"
                                      class="w-full rounded-md border border-[#e0e0e0] bg-white py-2 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                      rows="10" spellcheck="true" style="resize: vertical"></textarea>
                        </div>





                    </div>

                </div>


            </div>
            </div>
    </form>

</x-staff-layout>
