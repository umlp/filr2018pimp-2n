<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

use App\Profil;
use Illuminate\Http\Request;

Route::group(['middleware' => ['web']], function () {
	
    /**
     * Show Profil Dashboard
     */
    Route::get('/', function () {
	$pseudo = session('pseudo');
	if(isset($pseudo)) {
		$profil = DB::table('profils')->where('Pseudo', $pseudo)->first();
		return view('tasks', ['accueil' => true, 'profil' => $profil]); 
	} else {
		return view('tasks', ['accueil' => true]); 
	}
    });

    /**
     * Connection
     */	
    Route::get('/identification', function () {
	return view('tasks', ['identification' => true]); 
    });
    /**
     * Connection
     */	
    Route::post('/authentification', function (Request $request) {
	$profil = DB::table('profils')->where('Pseudo', $request->Pseudo)->where('Password', $request->Password)->first();
	if(isset($profil)) {
		session(['pseudo' => $profil->Pseudo]);
		return redirect('/');
	} else {
		 return redirect('/identification');
	}
    });
    /**
     * Create New Profil
     */	
    Route::get('/inscription_1', function () {
	return view('tasks', ['inscription_1' => true]); 
    });

    /**
     * Add New Profil 1st part
     */
    Route::post('/inscription_2', function (Request $request) {
        $validator = Validator::make($request->all(), [
        	'Pseudo' => 'required|max:255|min:5',
		'Password' => 'required|max:255|min:5',
		'Genre' => 'required',
		'checkCU' => 'accepted'
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $profil = new Profil;
        $profil->Pseudo = $request->Pseudo;
        $profil->Password = $request->Password;
        $profil->Email = $request->Email;
        $profil->Nom = $request->Nom;
        $profil->Prenom = $request->Prenom;
        $profil->Genre = $request->Genre;
        $profil->Ville = $request->Ville;
        $profil->checkCU = $request->checkCU;

	session(['profil_1' => $profil]);
	    
        return view('tasks', ['inscription_2' => true]);
    });
    
    /**
     * Add New Profil 2nd part
     */
    Route::post('/profil', function (Request $request) {
        /*$validator = Validator::make($request->all(), [
        	'Pseudo' => 'required|max:255|min:5',
		'Password' => 'required|max:255|min:5',
		'Genre' => 'required',
		'checkCU' => 'boolean|different:0|different:false',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }*/

        $profil = session('profil_1');
        $profil->Photo = $request->Photo;
        $profil->Description = $request->Description;
        $profil->save();
	Session::forget('profil_1');
	session(['pseudo' => $profil->Pseudo]);
	    
        return redirect('/');
    });
	
    Route::get('/images/{filename}', function($filename){
	$path = resource_path() . '/views/images/' . $filename;
	echo "<script>console.log('dans le get image');</script>";
	if(!File::exists($path)) {
		return response()->json(['message' => 'Image not found.'], 404);
	}

	$file = File::get($path);
	$type = File::mimeType($path);

	$response = Response::make($file, 200);
	$response->header("Content-Type", $type);

	return $response;
    });
});
