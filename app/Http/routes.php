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
        return view('profil', [
            'profil' => Profil::take(1)->orderBy('created_at','desc')
        ]);
    });

    /**
     * Add New Profil
     */
    Route::post('/profil', function (Request $request) {
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
