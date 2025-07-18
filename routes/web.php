    <?php

    use App\Http\Controllers\CategoryController;
    use App\Http\Controllers\ItemController;
    use App\Http\Controllers\ProfileController;
    use Illuminate\Support\Facades\Route;

    Route::get('/', [CategoryController::class, 'publicIndex'])
        ->name('categories.index');

    Route::middleware('auth')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::resource('categories', CategoryController::class);
            Route::resource('categories.items', ItemController::class)
                ->scoped();
        });
    require __DIR__.'/auth.php';
