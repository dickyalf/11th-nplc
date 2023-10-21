<?php

use App\Models\Cart;
use App\Models\Character;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Models\Invoice;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('admin/auth/login', \App\Http\Livewire\Auth\LoginView::class)->name('auth.login');
Route::group(['prefix' => 'admin', 'middleware' => 'auth.admin'], function () {
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('slider', function () {
        return view('admin.slider');
    })->name('admin.slider');

    Route::group(['prefix' => 'products'], function () {
        Route::get('', function () {
            return view('admin.products');
        })->name('admin.products');
    });
    Route::group(['prefix' => 'users'], function () {
        Route::get('', function () {
            return view('admin.users');
        })->name('admin.users');
    });
    Route::get('/download/{file}', [FileController::class, 'view'])
        ->middleware('auth')
        ->name('file.view');

    Route::group(['prefix' => 'characters'], function () {
        Route::get('', function () {
            return view('admin.characters');
        })->name('admin.characters');
    });
    Route::group(['prefix' => 'invoices'], function () {
        Route::get('', function () {
            return view('admin.invoices');
        })->name('admin.invoices');
    });
});
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products', function () {
    return view('user.product.list', ['title' => 'Products', 'breadcrumb' => ['/' => 'Home', 'Products']]);
})->name('products');
Route::get('/products/{id}', function ($id) {
    $product = Product::find($id);
    if ($product) {
        return view('user.product.detail', [
            'title' => 'Product Detail',
            'breadcrumb' => ['/' => 'Home', '/products' => 'Products', $product->name],
            'product' => $product,
            'relateds' => Product::where('category', $product->category)->where('id', '!=', $product->id)->limit(4)->get(),
        ]);
    } else {
        abort(404);
    }
})->name('product.detail');

Route::get('/carts', function () {
    $carts = auth()->check() ? auth()->user()->carts : Cart::where('session_id', session()->getId())->get();
    return view('user.product.carts', ['title' => 'Shopping Cart', 'breadcrumb' => ['/' => 'Home', '/products' => 'Products', 'Shopping Cart'], 'carts' => $carts]);
})->name('carts');

Route::get('/checkout', function () {
    return view('user.product.checkout', ['title' => 'Checkout', 'breadcrumb' => ['/' => 'Home', '/products' => 'Products', 'Checkout']]);
})->name('checkout');

Route::get('/completed', function () {
    return view('user.product.completed', ['title' => 'Order Completed', 'breadcrumb' => ['/' => 'Home', '/products' => 'Products', 'Order Completed']]);
})->name('completed');

Route::get('/invoices', function () {
    return view('user.invoice.list', ['title' => 'Invoices', 'breadcrumb' => ['/' => 'Home', 'Invoices']]);
})->name('invoices');

Route::get('/invoice/{inv}', function ($inv) {
    $invoice = Invoice::where([
        'invoice_number' => $inv,
        'user_id' => auth()->check() ? auth()->user()->id : -1,
    ])->first();
    if ($invoice) {
        return view('user.invoice.detail', [
            'title' => 'Invoices',
            'breadcrumb' => ['/' => 'Home', 'Invoices'],
            'invoice' => $invoice,
        ]);
    } else {
        abort(404);
    }
})->name('invoice.detail');

Route::get('/invoice/{inv}/{reference}', function ($inv, $reference) {
    $invoice = Invoice::where([
        'invoice_number' => $inv,
        'payment_reference' => $reference,
    ])->first();
    if ($invoice) {
        return view('user.invoice.detail', [
            'title' => 'Invoices',
            'breadcrumb' => ['/' => 'Home', 'Invoices'],
            'invoice' => $invoice,
        ]);
    } else {
        abort(404);
    }
})->name('invoice.guest.detail');

Route::get('/download/{invoice}/{product}', [FileController::class, 'download'])
    ->middleware('auth')
    ->name('file.download');
Route::get('/gdownload/{invoice}/{product}/{reference}', [FileController::class, 'guestDownload'])->name('file.gdownload');

Route::get('/characters', function () {
    return view('user.character.list', ['title' => 'Characters', 'breadcrumb' => ['/' => 'Home', 'Characters']]);
})->name('characters');

Route::get('/account', function () {
    return view('user.account', ['title' => 'My Account', 'breadcrumb' => ['/' => 'Home', 'My Account']]);
})
    ->middleware('auth')
    ->name('account');

Route::get('/characters/{id}', function ($id) {
    $character = Character::find($id);
    if ($character) {
        return view('user.character.detail', [
            'title' => 'Character Detail',
            'breadcrumb' => ['/' => 'Home', '/characters' => 'Characters', $character->name],
            'character' => $character,
        ]);
    } else {
        abort(404);
    }
})->name('character.detail');

Route::get('/contact', function () {
    return view('user.contact', ['title' => 'Contact Us', 'breadcrumb' => ['/' => 'Home', 'Contact Us']]);
})->name('contact');

Route::group(['prefix' => 'auth'], function () {
    Route::get('/login', function () {
        return view('user.auth.login', ['title' => 'Login', 'breadcrumb' => ['/' => 'Home', 'Login']]);
    })->name('login');

    Route::get('/register', function () {
        return view('user.auth.register', ['title' => 'Register', 'breadcrumb' => ['/' => 'Home', 'Register']]);
    })->name('register');
});

// Route::view('/pages/slick', 'pages.slick');
// Route::view('/pages/datatables', 'pages.datatables');
// Route::view('/pages/blank', 'pages.blank');
