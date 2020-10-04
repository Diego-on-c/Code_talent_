@extends('dashboardAdmin.dashboard')

@section('content')

    <section>
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Lista de Candidatos</h1>
                <div class="pull-right">
                    <div class="btn-group">
                        <a href="{{ route('candidate.create') }}" class="btn btn-info" >Añadir Candidato</a>
                    </div>
                </div>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="/dashboard">Panel</a></li>
                    <li class="breadcrumb-item active">Candidatos</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Promoción <strong>{{ $promotion->name }}</strong>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                <thead>
                                <th>Promoción</th>

                                <th>Perfil</th>

                                <th>ID</th>

                                <th>Nombre</th>

                                <th>Apellidos</th>

                                <th>Progreso general</th>

                                <th>Fecha de inicio</th>

                                <th>Editar</th>

                                <th>Eliminar</th>

                                </thead>
                                <tbody>

                                @if($promotion->candidates->count())

                                    @foreach($promotion->candidates as $candidate)


                                        <tr>
                                            <td>{{$candidate->promotion->name}}</td>

                                            <td><a class="btn btn-link btn-xs" href="{{action('CandidateController@show', $candidate->id)}}"><span class="glyphicon glyphicon-user"></span></a></td>

                                            <td>{{$candidate->id}}</td>

                                            <td>{{$candidate->name}}</td>

                                            <td>{{$candidate->lastname}}</td>

                                            <td class="progress-bar progress-bar-striped progress-bar-animated " role="progressbar" style="width: {{$candidate->percentage}}% ;" aria-valuenow="{{$candidate->percentage}}" aria-valuemin="0" aria-valuemax="100" >{{$candidate->percentage}}%</td>

                                            <td>{{$candidate->created_at}}</td>


                                            <td><a class="btn btn-primary btn-xs" href="{{action('CandidateController@edit', $candidate->id)}}" ><span class="glyphicon glyphicon-pencil"></span></a></td>

                                            <td>
                                                <form action="{{action('CandidateController@destroy', $candidate->id)}}" method="post">

                                                    {{csrf_field()}}

                                                    <input name="_method" type="hidden" value="DELETE">

                                                    <button class="btn btn-danger btn-xs" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                                                </form>
                                            </td>

                                        </tr>

                                    @endforeach
                                @else

                                    <tr>
                                        <td colspan="8">No hay registro !!</td>

                                    </tr>

                                @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </main>

    </section>
@endsection
