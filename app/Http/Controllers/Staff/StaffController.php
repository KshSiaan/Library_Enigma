<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Reservation;
use App\Models\ReturnBook;
use Illuminate\Http\Request;
use App\Models\Catagory;
use App\Models\Order;

class StaffController extends Controller
{
    public function index()
    {
        return view('staff.index');
    }
    public function messages()
    {
        return view('staff.messages');
    }
    public function addBook(Catagory $catagories, Author $authors)
    {
        $catagories = Catagory::all();
        $authors = Author::all();
        return view('staff.addBook', compact('catagories', 'authors'));
    }
    public function catagories_authors(Catagory $catagories, Author $authors)
    {
        $catagories = Catagory::all();
        $authors = Author::all();
        return view('staff.catAuths', compact('catagories', 'authors'));
    }
    public function catStore(Request $request)
    {
        $validated = $request->validate([
            'catagory' => ['required'],
            // Add validation rules for other fields if needed
        ]);

        // Assuming 'catagory' is the correct field name in your form
        Catagory::create([
            'catagory' => $validated['catagory'],
            // Add other fields if needed
        ]);

        return redirect()->route('staff.catAuths')->with('message', 'New category successfully created');
    }
    public function athStore(Request $request)
    {
        $validated = $request->validate([
            'author' => ['required'],
            // Add validation rules for other fields if needed
        ]);

        // Assuming 'catagory' is the correct field name in your form
        Author::create([
            'author' => $validated['author'],
            // Add other fields if needed
        ]);

        return redirect()->route('staff.catAuths')->with('message', 'New Author successfully created');
    }
    public function createBook(Request $request)
    {
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $extension = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $extension;
            $path = 'uploads/covers/' . $file_name;

            $file->move(public_path('uploads/covers'), $file_name);
        } else {
            $path = '';
        }


        $book = new Book();
        $book->cover = $path;
        $book->book_name = $request->book_name;
        $book->author_id = $request->author_id;
        $book->price = $request->price;
        $book->init_stock = $request->stock;
        $book->current_stock = $request->stock;
        $book->catagory_id = $request->catagory_id;
        $book->language = $request->language;
        $book->book_detail = $request->book_detail;
        $book->save();

        return redirect()->route('staff.index')->with('message', 'New Book successfully created');
    }
    public function manageBooks(Book $books)
    {
        $books = Book::all();
        return view('staff.manageBooks', compact('books'));
    }
    public function editBook($id, Catagory $catagories, Author $authors)
    {
        $catagories = Catagory::all();
        $authors = Author::all();
        $book = Book::findOrFail($id);
        return view('staff.editBook', compact('book', 'catagories', 'authors'));
    }

    public function updateBook(Request $request, $id)
    {
        // Find the book by its ID
        $book = Book::findOrFail($id);

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $extension = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $extension;
            $path = 'uploads/covers/' . $file_name;

            $file->move(public_path('uploads/covers'), $file_name);
        } else {
            $path = ''; // If no cover image uploaded, you may want to set a default or leave it empty
        }

        // Update other attributes of the book
        $book->cover = $path;
        $book->book_name = $request->book_name;
        $book->author_id = $request->author_id;
        $book->price = $request->price;
        $book->init_stock = $request->stock;
        $book->current_stock = $request->stock;
        $book->catagory_id = $request->catagory_id;
        $book->language = $request->language;
        $book->book_detail = $request->book_detail;

        // Save the changes to the database
        $book->save();

        // Redirect back to the manageBooks route with a success message
        return redirect()->route('staff.manageBooks')->with('message', 'Book successfully updated');
    }

    public function deleteBook($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect()->route('staff.manageBooks')->with('message', 'Book successfully deleted');
    }

    public function orders(Order $orders)
    {
        $orders = Order::all();
        return view('staff.orders', compact('orders'));
    }

    // reservation index
    public function reservation()
    {
        $reservations = Reservation::all();

        return view('staff.reservation.index', compact('reservations'));
    }
    //create page
    public function createReservation()
    {
        $books = Book::all();
        return view('staff.reservation.create', compact('books'));
    }

    // create reservation
    public function storeReservation(Request $request)
    {

        $reservation = new Reservation();
        $reservation->book_id = $request->book_id;
        $reservation->reserver_name = $request->reserver_name;
        $reservation->reserver_number = $request->reserver_number;
        $reservation->reservation_date = $request->reservation_date;
        $reservation->return_date = $request->return_date;
        $reservation->remarks = $request->remarks;
        $reservation->status = 'Not Returned Yet';

        $reservation->save();

        $book = Book::find($request->book_id);
        $book->current_stock = $book->current_stock - 1;
        $book->save();


        return redirect()->route('staff.newReservation')->with('message', 'New reservation successfully created');
    }

    // return index
    public function return()
    {
        $returns = ReturnBook::all();

        return view('staff.return.index', compact('returns'));
    }
    //create page
    public function createReturn()
    {
        $books = Book::all();
        $reservations = Reservation::where('status', 'Not Returned Yet')->get();
        return view('staff.return.create', compact('books', 'reservations'));
    }

    // create reservation
    public function storeReturn(Request $request)
    {
        $return = new ReturnBook();
        $return->reservation_id = $request->reservation_id;
        $reservation = Reservation::find($request->reservation_id);
        $return->book_id = $reservation->book_id;
        $return->return_date = $request->return_date;
        $reservation->status = 'Returned';
        $return->save();
        $reservation->save();
        $book = Book::find($reservation->book_id);
        $book->current_stock = $book->current_stock + 1;
        $book->save();

        return redirect()->route('staff.return')->with('message', 'Book Return successfully ');
    }
}
