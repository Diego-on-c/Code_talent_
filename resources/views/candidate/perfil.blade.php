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

                                                    <th>Link SoloLearn</th>

                                                    <th><a href="{{$candidate->sololearn}}"><span class="glyphicon glyphicon-eye-open"></span></a></th>


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

                                                                <th>Link CodeAcademy</th>

                                                                <th><a href="{{$candidate->codeacademy}}"><span class="glyphicon glyphicon-eye-open"></span></a></th>

                                                            </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                                        @for ($i = 0; $i < count($courses); $i++)
                                                        <thead>
                                                        <th>{{$courses[$i]->name}}</th>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td class="progress-bar progress-bar-striped progress-bar-animated " role="progressbar" style="width: {{$progress[$i][0]->percentage}}% ;" aria-valuenow="{{$progress[$i][0]->percentage}}" aria-valuemin="0" aria-valuemax="100" >{{$progress[$i][0]->percentage}}%</td>
                                                        </tr>
                                                        </tbody>
                                                    @endfor

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
