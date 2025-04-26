<?php
//Admin
use App\Http\Controllers\Admin\AreaController as AdminAreaController;
use App\Http\Controllers\Admin\BreedController as AdminBreedController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CategoryPlaceController as AdminCategoryPlaceController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\PrivatePolicyController as AdminPrivatePolicyController;
use App\Http\Controllers\Admin\SanitaryController as AdminSanitaryController;
use App\Http\Controllers\Admin\StatusController as AdminStatusController;
use App\Http\Controllers\Admin\TokenController as AdminTokenController;
use App\Http\Controllers\Admin\TypeController as AdminTypeController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\UserPermissionController as AdminUserPermissionController;
use App\Http\Controllers\Admin\PlaceController as AdminPlaceController;
use App\Http\Controllers\Admin\SanitaryTypeController as AdminSanitaryTypeController;
use App\Http\Controllers\Admin\MarkerController as AdminMarkerController;
use App\Http\Controllers\Admin\BackupController as AdminBackupController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\BushController as AdminBushController;
//Admin
//Mayor
use App\Http\Controllers\Mayor\DashboardController as MayorDashboardController;
//Mayor
//Consumer
use App\Http\Controllers\Consumer\DashboardController as ConsumerDashboardController;
//Consumer
//Agronom
use App\Http\Controllers\Agronom\DashboardController as AgronomDashboardController;
//Agronom
//Chef
use App\Http\Controllers\Chef\DashboardController as ChefDashboardController;
use App\Http\Controllers\Chef\UserController as ChefUserController;
use App\Http\Controllers\Chef\DepartmentController as ChefDepartmentController;
use App\Http\Controllers\Chef\WorkController as ChefWorkController;
//Chef
//Agronomist
use App\Http\Controllers\Agronomist\DashboardController as AgronomistDashboardController;
use App\Http\Controllers\Agronomist\WorkResultController as AgronomistWorkResultController;
//Agronomist
//Brigadier
use App\Http\Controllers\Brigadier\DashboardController as BrigadierDashboardController;
use App\Http\Controllers\Brigadier\WorkResultController as BrigadierWorkResultController;
//Brigadier
use App\Http\Controllers\Moder\BushController as ModerBushController;
use App\Http\Controllers\HomeController;
//Moderator Start
use App\Http\Controllers\Moder\DashboardController as ModerDashboardController;
use App\Http\Controllers\Moder\MarkerController as ModerMarkerController;
use App\Http\Controllers\Moder\TreeController as ModerTreeController;
use App\Http\Controllers\Moder\BreedController as ModerBreedController;
//Moderator End
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::get('access', function () {
    if (request()->session()->get('token')) {
        return redirect('/');
    } else {
        return view('access');
    }
});
Route::post('check-token', [\App\Http\Controllers\AccessController::class, 'check']);
//Route::middleware('AccessToken')->group(function (){
    Route::get('/logout', function (){
        Auth::logout();
        return redirect(\route('login'));
    });

//    Route::get('/create-encrypted-file', [\App\Http\Controllers\EncryptionController::class, 'createEncryptedFile']);

    Route::group(['prefix' => LaravelLocalization::setLocale()], function(){
        Route::get('/', [HomeController::class,"index"]);
        Route::get('/map', [HomeController::class,"map"])->name("front-map");
        Route::get('/heatmap', [HomeController::class,"heatmap"])->name("front-heatmap")->middleware(['auth', 'verified']);
        Route::get('/statistics', [HomeController::class,"stats"])->name("stats");
        Route::get('/faq', [HomeController::class,"faq"])->name("faq");
        Route::get('/contact', [HomeController::class,"contact"])->name("contact");
        Route::get('/do-backup', [HomeController::class,"db_dump"])->name("do-backup");
        Route::get('/make-report/{id}', [HomeController::class,"make_report"])->name("make-report");
        Route::post('/save-report', [HomeController::class,"save_report"])->name("save-report");
        Route::post('/send-mail', [HomeController::class,"sendMail"])->name("send-mail");
        require __DIR__.'/auth.php';
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        //Admin
        Route::middleware('AdminMiddleware')->prefix('admin')->group(function () {
            Route::get('/', [AdminDashboardController::class, 'index'])->name('admin-dashboard');
            Route::get('converts', [AdminDashboardController::class, 'convert'])->name('admin-convert');
            Route::get('maps', [AdminDashboardController::class, 'map'])->name('admin-maps');
            Route::resource('area', AdminAreaController::class);
            Route::resource('user', AdminUserController::class);
            Route::get("/user-permission/{id}",[AdminUserPermissionController::class,"getUserPermission"])->name("get-user-permission");
            Route::post("/give-user-permission",[AdminUserPermissionController::class,"giveUserPermission"])->name("give-user-permission");
            Route::get("/delete-user-permission/{id}/{user_id}",[AdminUserPermissionController::class,"deleteUserPermission"])->name("delete-user-permission");
            Route::resource('place', AdminPlaceController::class)->except('show');
            Route::any('place/search', [AdminPlaceController::class, 'search'])->name('place.search');
            Route::resource('breed', AdminBreedController::class);
            Route::resource('category', AdminCategoryController::class);
            Route::resource('category-places', AdminCategoryPlaceController::class);
            Route::resource('sanitary', AdminSanitaryController::class);
            Route::resource('sanitary', AdminSanitaryController::class);
            Route::resource('status', AdminStatusController::class);
            Route::resource('event', AdminEventController::class);
            Route::resource('type', AdminTypeController::class);
            Route::resource('bush', AdminBushController::class);
            Route::resource('sanitary_type', AdminSanitaryTypeController::class);
            Route::post("update-marker-by-place",[AdminMarkerController::class,"update_by_place"])->name("update-marker-by-place");
            Route::get("all-trees",[AdminDashboardController::class,"all_trees"])->name("all-trees");
            Route::get('add-place/{id?}', [AdminPlaceController::class, 'addPlace'])->name('admin.add-place');
            Route::get("/change-marker/{id}",[AdminPlaceController::class,"changeMarker"])->name("change-marker");
            Route::put("/update-marker/{id}",[AdminPlaceController::class,"updateMarker"])->name("update-marker");
            Route::get("/delete-markers-by-place/{id}",[AdminPlaceController::class,"deleteByPlace"])->name("delete-markers-by-place-id");
            Route::get("/change-markers-by-place/{id}",[AdminPlaceController::class,"changeByPlace"])->name("change-markers-by-place-id");
            Route::put("/delete-markers-by-place-stats/{id}",[AdminPlaceController::class,"deleteByPlaceStats"])->name("delete-markers-by-place-stats");
            Route::put("/change-markers-by-place-stats/{id}",[AdminPlaceController::class,"changeByPlaceState"])->name("change-markers-by-place-stats");
            Route::get('users-check', [AdminDashboardController::class, 'geo_positions'])->name('admin-check-users');
            Route::get('user-by-geo/{id}', [AdminDashboardController::class, 'getByGeo'])->name('admin-user-by-geo');
            Route::get('user-stats/{id}', [AdminUserController::class, 'stats'])->name('user-stats');
            Route::get("markers",[AdminMarkerController::class,"index"])->name("markers");
            Route::get("markers-edit",[AdminMarkerController::class,"edit"])->name("markers-edit");
            Route::put("markers-mass-update",[AdminMarkerController::class,"update"])->name("markers-mass-update");
            Route::get("back-up",[AdminBackupController::class,"index"])->name("back-up");
            Route::delete("back-up-destroy",[AdminBackupController::class,"delete"])->name("back-up-destroy");
            Route::resource('reports', AdminReportController::class)->only([
                'index', 'edit','destroy',"update"
            ]);
            Route::get('get-all-markers', [AdminMarkerController::class, 'getAllMarkers'])->name('get-all-markers');
            Route::any('filter-markers', [AdminMarkerController::class, 'filterMarkers'])->name('filter-markers');
            Route::get('create-token', [AdminTokenController::class, 'createToken'])->name('create-token');
            Route::post('create-token', [AdminTokenController::class, 'storeToken'])->name('store-token');
            Route::delete('delete-token/{id}', [AdminTokenController::class, 'destroyToken'])->name('delete-token');
            Route::resource('private-policy', AdminPrivatePolicyController::class);
        });
        //Admin
        Route::middleware('ModerMiddleware')->prefix('moder')->group(function () {
            Route::get('/', [ModerDashboardController::class, 'index'])->name('moder-dashboard');
            Route::get('/maps', [ModerDashboardController::class, 'maps'])->name('moder-maps');
            Route::get('/places', [ModerDashboardController::class, 'places'])->name('moder-places');
            Route::get('/markers/by-area/{area_id}', [ModerMarkerController::class, 'index'])->name('moder-markers');
            Route::post('store-marker', [ModerMarkerController::class, 'store'])->name('store-marker');
            Route::resource('trees', ModerTreeController::class);
            Route::get('/bush', [ModerBushController::class,"index"])->name("moder-bush-index");
            Route::get('/bush-create/{place_id}',  [ModerBushController::class,"create"])->name("moder-bush-create");
            Route::post('/bush-store',  [ModerBushController::class,"store"])->name("moder-bush-store");
            Route::resource('moder-breed', ModerBreedController::class);
        });
        //Mayor
        Route::middleware('MayorMiddleware')->prefix('mayor')->group(function (){
            Route::get('', [MayorDashboardController::class, 'index'])->name('mayor-dashboard');
            Route::get('statistics', [MayorDashboardController::class, 'statistics'])->name('mayor-statistics');
            Route::get('search', [MayorDashboardController::class, 'search'])->name('mayor-search');
            Route::post('search', [MayorDashboardController::class, 'search'])->name('mayor-search');
            Route::get('mayor-marker-show/{id}', [MayorDashboardController::class, 'marker_edit'])->name('mayor-marker-show');
            Route::get('statistics-by-tree', [MayorDashboardController::class, 'statisticsByTree'])->name('mayor-statistics-by-trees');
            Route::get('statistics-tree', [MayorDashboardController::class, 'statisticsTree'])->name('mayor-statistics-tree');
            Route::get('statistics-breed-place', [MayorDashboardController::class, 'statisticsBreed'])->name('mayor-statistics-breed-place');
            Route::get('statistics-by-age', [MayorDashboardController::class, 'statisticsByAge'])->name('mayor-statistics-by-age');
            Route::get('statistics-by-age/{area_id}/{age}', [MayorDashboardController::class, 'statisticsByAgeByArea'])->name('mayor-statistics-by-age-by-area');
        });
        //Mayor
        //Consumer
        Route::middleware('ConsumerMiddleware')->prefix('consumer')->group(function (){
            Route::get('', [ConsumerDashboardController::class, 'index'])->name('consumer-dashboard');
            Route::get('statistics', [ConsumerDashboardController::class, 'statistics'])->name('consumer-statistics');
            Route::get('search', [ConsumerDashboardController::class, 'search'])->name('consumer-search');
            Route::post('search', [ConsumerDashboardController::class, 'search'])->name('consumer-search');
            Route::get('mayor-marker-show/{id}', [ConsumerDashboardController::class, 'marker_edit'])->name('consumer-marker-show');
            Route::get('statistics-by-tree', [ConsumerDashboardController::class, 'statisticsByTree'])->name('consumer-statistics-by-trees');
            Route::get('statistics-tree', [ConsumerDashboardController::class, 'statisticsTree'])->name('consumer-statistics-tree');
        });
        //Consumer
        //Agronom
        Route::middleware('AgronomMiddleware')->prefix('agronom')->group(function (){
            //Some Admin Root
            Route::get("all-trees",[AdminDashboardController::class,"all_trees"])->name("all-trees");
            Route::get("/change-marker/{id}",[AdminPlaceController::class,"changeMarker"])->name("change-marker");
            Route::put("/update-marker/{id}",[AdminPlaceController::class,"updateMarker"])->name("update-marker");
            //Some Admin Root
            Route::get('', [AgronomDashboardController::class, 'index'])->name('agronom-dashboard');
            Route::get('statistics', [AgronomDashboardController::class, 'statistics'])->name('agronom-statistics');
            Route::get('statistics-by-tree', [AgronomDashboardController::class, 'statisticsByTree'])->name('agronom-statistics-by-trees');
            Route::get('statistics-tree', [AgronomDashboardController::class, 'statisticsTree'])->name('agronom-statistics-tree');
            Route::get('search', [AgronomDashboardController::class, 'search'])->name('agronom-search');
            Route::post('search', [AgronomDashboardController::class, 'search'])->name('agronom-search');
            Route::get('mayor-marker-show/{id}', [AgronomDashboardController::class, 'marker_edit'])->name('agronom-marker-show');
        });
        //Agronom
        //Chef
        Route::middleware('ChefMiddleware')->prefix('chef')->group(function (){
            Route::get('', [ChefDashboardController::class, 'index'])->name('chef-dashboard');
            Route::resource('chef-user', ChefUserController::class);
            Route::resource('chef-department', ChefDepartmentController::class);
            Route::resource('chef-work', ChefWorkController::class);
        });
        //Chef
        //Agronomist
        Route::middleware('AgronomistMiddleware')->prefix('agronomist')->group(function (){
            Route::get('', [AgronomistDashboardController::class, 'index'])->name('agronomist-dashboard');
            Route::resource('agronomist-work-result', AgronomistWorkResultController::class)->only("index","show","edit","store","destroy");
        });
        //Agronomist
        //Brigadier
        Route::middleware('BrigadierMiddleware')->prefix('brigadier')->group(function (){
            Route::get('', [BrigadierDashboardController::class, 'index'])->name('brigadier-dashboard');
            Route::resource('brigadier-work-result', BrigadierWorkResultController::class)->only("index","show","edit","store","destroy");
        });
        //Brigadier

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
//});

