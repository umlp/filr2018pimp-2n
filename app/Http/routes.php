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
	
	function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}
    /**
     * Show Profil Dashboard
     */
    Route::get('/', function () {
	debug_to_console("Dans le get");
	$profil = NULL;//Profil::query()->first();
	debug_to_console("A la fin du get");
	return view('tasks', ['profil' => $profil]); 
    });

    /**
     * Add New Profil
     */
    Route::post('/profil', function (Request $request) {
	debug_to_console("Dans le post");
        $validator = Validator::make($request->all(), [
            'Pseudo' => 'required|max:255|min:5',
			'Password' => 'required|max:255|min:5',
			'Genre' => 'required',
			'checkCU' => 'boolean|different:0|different:false',
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
        $profil->save();

        return redirect('/');
    });
});
