<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

App::bind('elastic', function () {
        return new App\Elastic\Elastic(
            Elasticsearch\ClientBuilder::create()
                ->setLogger(Elasticsearch\ClientBuilder::defaultLogger(storage_path('logs/elastic.log')))
                ->build()
        );
		});


		
Route::get('testai', function(){
	return view('tests');
});		

Route::get('testai/create-user', function(){
	$u = App\User::create(['name' => 'TestUser', 'email' => 'test@test.com', 'password' => bcrypt('pass')]);
});		

		
Route::get('/', function(){
    return redirect()->route('test');
});
Route::get('/test', ['as' => 'test', 'uses' => 'TestController@test']);
Route::get('/language', ['as' => 'test', 'uses' => 'TestController@languages']);

Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);
Route::get('keywords', ['as' => 'keywords', 'uses' => 'KeywordTreeController@index']);
Route::patch('keyword-tree/create', ['as' => 'keywords.create', 'uses' => 'KeywordTreeController@store']);

Route::get('/elastic/search', function(){

	$elastic = app('elastic');
	
	$search = 'Hello world!';
	
	$query = [
		'multi_match' => [
			'query' => $search,
			'fuzziness' => 'AUTO',
			'fields' => ['title^3', 'content'], //suteikiam svorius laukams
		],
	];
	
	$parameters = [
		'index' => 'blog',
		'type' => 'post',
		'body' => [
			'query' => $query
		]
	];
	 
	$response = $elastic->search($parameters);


	
	var_dump($response);
	
});

Route::get('/elastic/index', function(){

	$elastic = app('elastic');
	for($i = 1; $i < 100; $i++){
		$elastic->index([
			'index' => 'blog',
			'type' => 'post',
			'id' => $i,
			'body' => [
				'title' => 'Hello world!'.$i,
				'content' => 'My first indexed post!'.$i
			]
		]);
	}
});


