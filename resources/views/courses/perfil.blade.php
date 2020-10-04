@extends('dashboardAdmin.dashboard')

@section('content')
    <section>
    <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                      <h1>Perfil <strong>{{$candidate->name}}</strong></h1>
                                        <h3>Promoción <strong>{{$candidate->promotion->name}}</strong></h3>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                                    <thead>
                                                    <th>ID</th>

                                                    <th>Nombre</th>

                                                    <th>Apellidos</th>

                                                    <th>Email</th>

                                                    <th>Teléfono</th>

                                                    <th>Fecha de inicio</th>

                                                    <th>Última modificación</th>

                                                    </thead>
                                                    <tbody>
                                                            <tr>
                                                                <td>{{$candidate->id}}</td>

                                                                <td>{{$candidate->name}}</td>

                                                                <td>{{$candidate->lastname}}</td>

                                                                <td>{{$candidate->email}}</td>

                                                                <td>{{$candidate->phone_number}}</td>

                                                                <td>{{$candidate->created_at}}</td>

                                                                <td>{{$candidate->updated_at}}</td>

                                                            </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                                    <thead>
                                                        <th>SoloLearn</th>
                                                    </thead>

                                                    <tbody>
                                                    <tr>
                                                        <td><a href="{{$candidate->sololearn}}">{{$candidate->sololearn}}</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="progress-bar progress-bar-striped progress-bar-animated " role="progressbar" style="width: {{$candidate->sololearn_progress}}% ;" aria-valuenow="{{$candidate->sololearn_progress}}" aria-valuemin="0" aria-valuemax="100" >{{$candidate->sololearn_progress}}%</td>
                                                    </tr>
                                                    </tbody>

                                                </table>

                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                                        <thead>
                                                        <th>CodeAcademy</th>
                                                        </thead>

                                                        <tbody>
                                                        <tr>
                                                            <td><a href="{{$candidate->codeacademy}}">{{$candidate->codeacademy}}</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="progress-bar progress-bar-striped progress-bar-animated " role="progressbar" style="width: {{$candidate->codeacademy_progress}}% ;" aria-valuenow="{{$candidate->codeacademy_progress}}" aria-valuemin="0" aria-valuemax="100" >{{$candidate->codeacademy_progress}}%</td>
                                                        </tr>
                                                        </tbody>

                                                    </table>
                                                </div>
                                            </div>
                                        </div>


                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>
                </main>
        </div>
    </section>
@endsection
