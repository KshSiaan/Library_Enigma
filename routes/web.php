<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Permission;
use App\Http\Controllers\Staff\StaffController;
use App\Models\Author;
use App\Models\Book;
use App\Models\Catagory;
use App\Models\Order;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('/aboutUs', function () {
    return view('aboutUs');
})->name('aboutUs');

Route::get('/tnc', function () {
    return view('tnc');
})->name('tnc');

Route::get('/policy', function () {
    return view('policy');
})->name('policy');
Route::get('/search', function (Request $request) {
    $search = $request->input('search', '');

    $booksQuery = Book::query();

    if ($search !== '') {
        $booksQuery->where('book_name', 'like', "%$search%");
    }

    $books = $booksQuery->get();
    $allBooks = Book::all();
    $authors = Author::all();

    return view('search', compact('books', 'allBooks', 'authors', 'search'));
})->name('search');


Route::get('/books', function (Book $books, Author $authors) {
    $books = Book::all();
    $authors = Author::all();
    return view('books', compact('books', 'authors'));
})->name('books');
Route::get('/book/{id}', function ($id, Author $authors, Catagory $catagories) {
    $book = App\Models\Book::findOrFail($id);
    $authors = Author::all();
    return view('book', compact('book', 'authors', 'catagories'));
})->name('book');

Route::get('/order', function (Request $request, Author $authors) {
    $book = null;
    $author = null;
    $id = $request->id ?? null;
    if (is_numeric($id)) {
        $book = Book::find($id);
        if ($book) {
            $author = $authors->where('id', $book->author_id)->first();
        }
    }
    return view('order', compact('book', 'author'));
})->name('order');
Route::post('/orderStore/{id}', function ($id, Request $request) {

    // $book->cover = $path;
    // $book->book_name = $request->book_name;
    // $book->author_id = $request->author_id;
    // $book->price = $request->price;

    // protected $fillable = [
    //     'book_id',
    //     'user',
    //     'email',
    //     'status',
    // ];

    $order = new Order();
    $order->book_id = $id;
    $order->user = Auth::user()->name;
    $order->email = Auth::user()->email;
    $order->status = 'pending';
    $order->save();

    return redirect()->route('book', ['id' => $id]);
})->name('order.store');

Route::get('myOrders', function (Order $orders, Book $books) {
    $books = Book::all();
    $orders = Order::where('user', Auth::user()->name)->get();
    return view('myOrders', compact('orders', 'books'));
})->name('myOrders');



Route::get('/reservation', function (Book $books, Author $authors, Reservation $reservations) {
    $books = Book::all();
    $reservations = Reservation::all();


    return view('reserve', compact('books', 'authors', 'reservations'));
})->name('reservation');

Route::post('order/{id}', function (Request $request, $id) {
    return redirect()->route('order', ['id' => $id]);
})->name('orderBook');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::resource('/roles', RoleController::class);
    Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions');
    Route::resource('/permissions', PermissionController::class);
    Route::resource('/users', UserController::class);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/{user}/roles', [UserController::class, 'roles'])->name('users.roles');
    Route::get('users/{user}/permissions', [UserController::class, 'permissions'])->name('users.permissions');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('users/{id}/assignRole', [UserController::class, 'assignRole'])->name('users.assignRole');
});

Route::middleware(['auth', 'role:staff'])->name('staff.')->prefix('staff')->group(function () {
    Route::get('/', [StaffController::class, 'index'])->name('index');
    Route::resource('/staff', StaffController::class);
    Route::get('/messages', [StaffController::class, 'messages'])->name('messages');
    Route::get('/addBook', [StaffController::class, 'addBook'])->name('addBook');
    Route::get('/catAuths', [StaffController::class, 'catagories_authors'])->name('catAuths');
    Route::post('/catStore', [StaffController::class, 'catStore'])->name('catStore');
    Route::post('/athStore', [StaffController::class, 'athStore'])->name('athStore');
    Route::post('/createBook', [StaffController::class, 'createBook'])->name('createBook');
    Route::get('/manageBooks', [StaffController::class, 'manageBooks'])->name('manageBooks');
    Route::get('/books/manageBooks/{id}', [StaffController::class, 'editBook'])->name('manageBooks.edit');
    Route::post('/books/ManageBooks/{id}/update', [StaffController::class, 'updateBook'])->name('manageBooks.update');
    Route::delete('books/ManageBooks/{id}/delete', [StaffController::class, 'deleteBook'])->name('manageBooks.destroy');
    Route::get('/orders', [StaffController::class, 'orders'])->name('orders');

    //Route for reservation
    Route::get('/new/reservation', [StaffController::class, 'reservation'])->name('newReservation');
    Route::get('/new/reservation/create', [StaffController::class, 'createReservation'])->name('reservation.create');
    Route::post('/new/reservation/store', [StaffController::class, 'storeReservation'])->name('reservation.store');

    //Route for Return
    Route::get('/new/return', [StaffController::class, 'return'])->name('return');
    Route::get('/new/return/create', [StaffController::class, 'createReturn'])->name('return.create');
    Route::post('/new/return/store', [StaffController::class, 'storeReturn'])->name('return.store');
});



require __DIR__ . '/auth.php';
