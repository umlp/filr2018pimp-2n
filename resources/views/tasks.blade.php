@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <table style:"width:99%;">
                    <tr>
                        <td><img src="{{ asset('images/LogoTinderASI.png') }}" alt="Logo TinderASI" style="width:auto;height:100%;max-width:120px;max-height:120px"></td>
                        <td text-align="center"><h2>TinderASI<h2></td>
                    </tr>
                    </table>
                </div>
                <div class="panel-body" style="padding:5px;">
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    @if (isset($accueil))
                        <p style="text-align:center;">Bienvenue sur TinderASI
                        @if(isset($profil))
                            , {{ $profil->Prenom }}
                        @endif
                        </p>
                    @endif
                    @if (isset($identification))
                        <form action="{{ url('authentification') }}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}

                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>

                            <div class="form-group">
                                <label for="login-Pseudo">Pseudo</label>
                                <input type="text" name="Pseudo" class="form-control" id="login-Pseudo" placeholder="Entrez votre pseudonyme">
                            </div>
                            <div class="form-group">
                                <label for="login-Password">Mot de passe</label>
                                <input type="password" name="Password" class="form-control" id="login-Password" placeholder="Entrez votre mot de passe">
                            </div>
                            <button type="submit" class="btn btn-primary">Se connecter</button>
                        </form>
                    @endif
                    @if (isset($inscription_1))
                        <!-- New Task Form -->
                        <form action="{{ url('inscription_2') }}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}

                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>

                            <div class="form-group">
                                <label for="profil-Pseudo">Pseudo</label>
                                <input type="text" name="Pseudo" class="form-control" id="profil-Pseudo" aria-describedby="PseudoHelp" placeholder="Entrez un pseudonyme valide">
                                <small id="PseudoHelp" class="form-text text-muted">Votre pseudo doit faire au moins 5 caractères</small>
                            </div>
                            <div class="form-group">
                                <label for="profil-Password">Mot de passe</label>
                                <input type="password" name="Password" class="form-control" id="profil-Password" aria-describedby="PasswordHelp" placeholder="Entrez un mot de passe valide">
                                <small id="PasswordHelp" class="form-text text-muted">Votre mot de passse doit faire au moins 5 caractères et contenir une majuscule</small>
                            </div>
                            <div class="form-group">
                                <label for="profil-Email">Adresse Email</label>
                                <input type="email" name="Email" class="form-control" id="profil-Email" placeholder="Entrez votre email">
                            </div>
                            <div class="form-group">
                                <label for="profil-Prenom">Prénom</label>
                                <input type="text" name="Prenom" class="form-control" id="profil-Prenom" placeholder="Entrez votre prénom">
                            </div>
                            <div class="form-group">
                                <label for="profil-Nom">Nom</label>
                                <input type="text" name="Nom" class="form-control" id="profil-Nom" placeholder="Entrez votre nom de famille">
                            </div>
                            <div class="form-group">
                                <label for="profil-Genre">Sexe</label>
                                <select name="Genre" class="form-control" id="profil-Genre">
                                   <option value="0">Homme</option>
                                   <option value="1">Femme</option>
                                   <option value="2">Un peu des deux</option>
                               </select>
                            </div>
                            <div class="form-group">
                                <label for="profil-Ville">Ville</label>
                                <input type="text" name="Ville" class="form-control" id="profil-Ville" placeholder="Entrez votre ville de résidence">
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="checkCU" class="form-check-input" id="profil-checkCU">
                                <label class="form-check-label" for="profil-checkCU">J'accepte les conditions d'utilisation de TinderASI</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Suivant</button>
                        </form>
                    @endif
                    <!-- Seconde Partie Inscription -->
                    @if (isset($inscription_2))
                        <form action="{{ url('profil') }}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}

                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="custom-file">
                                        <input type="file" id="file" class="custom-file-input" onchange="readURL(this);">
                                        <span class="custom-file-control"></span>
                                        <img id="imgPhoto" src="#" alt="Photo de profil" />
                                    </label>
                                </div>
                            </div>
                            <input type="hidden" name="Photo" id="Photo" value="">
                            <div class="form-group">
                                <label for="profil-Description">Description :</label>
                                <textarea name ="Description" class="form-control" rows="8" id="profil-Description"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Suivant</button>
                        </form>
                        <script>
                            function readURL(input) {
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();
                                    reader.onload = function (e) {
                                        $('#imgPhoto')
                                            .attr('src', e.target.result)
                                            .width(150)
                                            .height(200);
                                        $('#Photo')
                                            .attr('value', Uint8Array(e.target.result));
                                    };
                                    reader.readAsDataURL(input.files[0]);
                                }
                            }
                        </script>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
