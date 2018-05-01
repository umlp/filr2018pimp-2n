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
                    <form action="{{ url('task')}}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}
                        
                        <div class="form-group">
                            <label for="InputPseudo"><pre>  Pseudo</pre></label>
                            <input type="text" class="form-control" id="InputPseudo" aria-describedby="PseudoHelp" placeholder="Entrez un pseudonyme valide">
                            <small id="PseudoHelp" class="form-text text-muted">Votre pseudo doit faire au moins 5 caractères</small>
                        </div>
                        <div class="form-group">
                            <label for="InputPassword"><pre>  Mot de passe</pre></label>
                            <input type="password" class="form-control" id="InputPassword" aria-describedby="PasswordHelp" placeholder="Entrez un mot de passe valide">
                            <small id="PasswordHelp" class="form-text text-muted">Votre mot de passse doit faire au moins 5 caractères et contenir une majuscule</small>
                        </div>
                        <div class="form-group">
                            <label for="InputEmail"><pre>  Adresse Email</pre></label>
                            <input type="email" class="form-control" id="InputEmail" placeholder="Entrez votre email">
                        </div>
                        <div class="form-group">
                            <label for="InputPrénom"><pre>  Prénom</pre></label>
                            <input type="text" class="form-control" id="InputPrénom" placeholder="Entrez votre prénom">
                        </div>
                        <div class="form-group">
                            <label for="InputNom"><pre>  Nom</pre></label>
                            <input type="text" class="form-control" id="InputNom" placeholder="Entrez votre nom de famille">
                        </div>
                        <div class="form-group">
                            <label for="menuGenre"><pre>  Sexe</pre></label>
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" id="menuGenre" data-toggle="dropdown">Tutorials
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Homme</a></li>
                                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Femme</a></li>
                                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Un peu des deux</a></li>
                                </ul>
                              </div>
                        </div>
                        <div class="form-group">
                            <label for="InputVille"><pre>  Ville</pre></label>
                            <input type="text" class="form-control" id="InputVille" placeholder="Entrez votre ville de résidence">
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
            @if (count($tasks) > 0)
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
