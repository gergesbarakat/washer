<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\CourierProfileController;
use App\Http\Controllers\ParcelController;
use App\Http\Controllers\ProductController;

use App\Http\Controllers\InvoiceController;
use App\Models\Branch;
use App\Models\Parcel;
use App\Models\User;
use App\Models\Courier;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Http\Controllers\HotelController;
use Illuminate\Support\Facades\Auth;



###############################
#Dashboard Route
###############################


Route::get('/', function () {

    if (Auth::guard('user')->check()) {
        $hotelUser = Auth::guard('user')->user();
        $parcels = Parcel::with(['hotel', 'branch', 'courier', 'items.product'])
            ->where('hotel_id', $hotelUser->id)
            ->latest()->get();
        return view('dashboard', compact('parcels', 'hotelUser'));
    } elseif (Auth::guard('courier')->check()) {

        $hotelUser = Auth::guard('courier')->user();
        $parcels = Parcel::with(relations: ['hotel', 'branch', 'courier', 'items.product'])->where('courier_id', $hotelUser->id)
            ->latest()->get();

        return view('courier.dashboard', compact('parcels', 'hotelUser'));
    } elseif (Auth::guard('admin')->check()) {
        $hotels = User::get();
        $courier = Courier::get();

        $parcels = Parcel::with(['hotel', 'branch', 'courier', 'items.product'])->latest()->get();


        return view('admin.dashboard', compact('parcels',  'courier', 'hotels'));
    } else {
        return redirect()->route('user.login');
    }
})->name('dashboard')->middleware('multi-auth');

######################
#dashboard Routes
#########################


Route::get('/dashboard', function () {

    if (Auth::guard('user')->check()) {


        $hotelUser = Auth::guard('user')->user();
        $parcels = Parcel::with(['hotel', 'branch', 'courier'])
            ->where('hotel_id', $hotelUser->id)
            ->latest()->get();
        return view('dashboard', compact('parcels', 'hotelUser'));
    } elseif (Auth::guard('courier')->check()) {
        $hotelUser = Auth::guard('courier')->user();

        $parcels = Parcel::with(relations: ['hotel', 'branch', 'courier', 'items.product'])->where('courier_id', $hotelUser->id)
            ->latest()->get();

        return view('courier.dashboard', compact('parcels', 'hotelUser'));
    } elseif (Auth::guard('admin')->check()) {


        $hotels = User::get();
        $courier = Courier::get();

        $parcels = Parcel::with(relations: ['hotel', 'branch', 'courier', 'items.product'])->latest()->get();


        return view('admin.dashboard', compact('parcels',  'courier', 'hotels'));
    } else {


        return redirect()->route('user.login');
    }
})->name('dashboard')->middleware('multi-auth');



######################
#User Routes
#########################


Route::prefix('user')->name('user.')->middleware('auth:user')->group(function () {


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('parcels', ParcelController::class);
});


######################
#admin Routes
#########################


Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {

    Route::get('/profile', [AdminController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [AdminController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [AdminController::class, 'destroy'])->name('profile.destroy');

    Route::resource('parcels', ParcelController::class);
    Route::resource('branches', BranchController::class);
    Route::post('/branches/{branch}/activate', [BranchController::class, 'activate'])->name('branches.activate');

    Route::resource('categories', CategoryController::class);
    Route::post('/categories/{category}/activate', [CategoryController::class, 'activate'])->name('categories.activate');

    Route::resource('products', ProductController::class);
    Route::post('/products/{product}/activate', [ProductController::class, 'activate'])->name('products.activate');

    Route::resource('hotels', HotelController::class);
    Route::post('/hotels/{hotel}/activate', [HotelController::class, 'activate'])->name('hotels.activate');

    Route::resource('branches',  BranchController::class)->except(['show']);

    Route::resource('couriers', CourierController::class);
    Route::post('/couriers/{courier}/activate', [CourierController::class, 'activate'])->name('couriers.activate');


    Route::get('/admin/products/search', [ProductController::class, 'search'])->name('products.search');

    Route::get('/admin/branches/{branch}/couriers', function (Branch $branch) {
        return response()->json($branch->couriers()->select('id', 'firstname', 'lastname')->get());
    });
});

######################
#courier Routes
#########################


Route::prefix('courier')->name('courier.')->middleware('auth:courier')->group(function () {



    Route::get('/profile', [CourierProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [CourierProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [CourierProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('parcels', ParcelController::class);



    Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
});

Route::post('/invoice/generate', [InvoiceController::class, 'generate'])->name('invoice.generate');

require __DIR__ . '/auth.php';
