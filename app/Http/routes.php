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
		return view('tasks', ['profil' => $profil]); 
	} else {
		$profil = session('profil_1');
		return view('tasks', ['profil_1' => $profil]); 
	}
    });

    /**
     * Add New Profil
     */
    Route::post('/profil_1', function (Request $request) {
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
	    
        return redirect('/');
    });
	
    Route::post('/profil_2', function (Request $request) {
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
