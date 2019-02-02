<?php
/*
|--------------------------------------------------------------------------
| Home Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');

/*
|--------------------------------------------------------------------------
| Middleware
|--------------------------------------------------------------------------
*/

Route::group(['middleware'=>'auth'], function(){
/*
|--------------------------------------------------------------------------
| Project routes Routes
|--------------------------------------------------------------------------
*/

    Route::get('/projects', 'ProjectsController@index');
    Route::get('/projects/create', 'ProjectsController@create');
    Route::get('/projects/{project}', 'ProjectsController@show');
    Route::get('/projects/{project}/edit', 'ProjectsController@edit');
    Route::patch('/projects/{project}', 'ProjectsController@update');
    Route::post('/projects', 'ProjectsController@store');
    Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');
    Route::patch('/projects/{project}/tasks/{task}', 'ProjectTasksController@update');
    Route::get('/home', 'HomeController@index')->name('home');


/*
|--------------------------------------------------------------------------
| Forum Routes
|--------------------------------------------------------------------------
*/
    Route::get('/home', 'HomeController@index');
    Route::get('threads', 'ThreadsController@index');
    Route::get('threads/create', 'ThreadsController@create');
    Route::get('threads/{channel}/{thread}', 'ThreadsController@show');
    Route::post('threads', 'ThreadsController@store');
    Route::get('threads/{channel}', 'ThreadsController@index');
    Route::post('/threads/{channel}/{thread}/replies', 'RepliesController@store');

//Route::get('/profile', 'ThreadsController@index');
});
/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Auth::routes();

/*
|--------------------------------------------------------------------------
| DeBug Routes
|--------------------------------------------------------------------------
*/
Route::get('/debug', function () {

    $debug = [
        'Environment' => App::environment(),
    ];

    /*
    The following commented out line will print your MySQL credentials.
    Uncomment this line only if you're facing difficulties connecting to the
    database and you need to confirm your credentials. When you're done
    debugging, comment it back out so you don't accidentally leave it
    running on your production server, making your credentials public.
    */
    #$debug['MySQL connection config'] = config('database.connections.mysql');

    try {
        $databases = DB::select('SHOW DATABASES;');
        $debug['Database connection test'] = 'PASSED';
        $debug['Databases'] = array_column($databases, 'Database');
    } catch (Exception $e) {
        $debug['Database connection test'] = 'FAILED: '.$e->getMessage();
    }

    dump($debug);
});
