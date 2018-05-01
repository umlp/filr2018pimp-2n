@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    TinderASI
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Task Form -->
                    <form action="{{ url('profil')}}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}
                        
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        
                        <div class="form-group">
                            <label for="profil-Pseudo">Pseudo</label>
                            <input type="text" class="form-control" id="profil-Pseudo" aria-describedby="PseudoHelp" placeholder="Entrez un pseudonyme valide">
                            <small id="PseudoHelp" class="form-text text-muted">Votre pseudo doit faire au moins 5 caractères</small>
                        </div>
                        <div class="form-group">
                            <label for="profil-Password">Mot de passe</label>
                            <input type="password" class="form-control" id="profil-Password" aria-describedby="PasswordHelp" placeholder="Entrez un mot de passe valide">
                            <small id="PasswordHelp" class="form-text text-muted">Votre mot de passse doit faire au moins 5 caractères et contenir une majuscule</small>
                        </div>
                        <div class="form-group">
                            <label for="profil-Email">Adresse Email</label>
                            <input type="email" class="form-control" id="profil-Email" placeholder="Entrez votre email">
                        </div>
                        <div class="form-group">
                            <label for="profil-Prenom">Prénom</label>
                            <input type="text" class="form-control" id="profil-Prenom" placeholder="Entrez votre prénom">
                        </div>
                        <div class="form-group">
                            <label for="profil-Nom">Nom</label>
                            <input type="text" class="form-control" id="profil-Nom" placeholder="Entrez votre nom de famille">
                        </div>
                        <div class="form-group">
                            <label for="profil-Genre">Sexe</label>
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" id="profil-Genre" data-toggle="dropdown">Sélectionnez un genre
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Homme</a></li>
                                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Femme</a></li>
                                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Un peu des deux</a></li>
                                </ul>
                              </div>
                        </div>
                        <div class="form-group">
                                <label for="profil-Ville">Ville</label>
                            <input type="text" class="form-control" id="profil-Ville" placeholder="Entrez votre ville de résidence">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="checkCU">
                            <label class="form-check-label" for="checkCU">J'accepte les conditions d'utilisation de TinderASI</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Suivant</button>
                    </form>
                </div>
            </div>

            <!-- Current Tasks -->
            @if (count($profils) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Tasks
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>Task</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td class="table-text"><div>{{ $task->name }}</div></td>

                                        <!-- Task Delete Button -->
                                        <td>
                                            <form action="{{ url('task/'.$task->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
