@extends('dashboardAdmin.dashboard')

@section('content')

<section>
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Lista de Cursos</h1>
            <div class="pull-right">
                <div class="btn-group">
                    <a href="{{ route('courses.create') }}" class="btn btn-info" >Añadir Curso</a>
                </div>
            </div>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/dashboard">Panel</a></li>
                <li class="breadcrumb-item active">Cursos</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    Tabla de cursos
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                            <thead>
                            <th>Curso</th>

                            <th>Plataforma</th>

                            <th>Fecha creación</th>

                            <th>Editar</th>

                            <th>Eliminar</th>

                            </thead>
                            <tbody>

                            @if($courses->count())

                                @foreach($courses as $course)


                                    <tr>
                                        <td>{{$course->name}}</td>

                                        <td>{{$course->platform}}</td>

                                        <td>{{$course->created_at}}</td>

                                        <td><a class="btn btn-primary btn-xs" href="{{action('CourseController@edit', $course->id)}}" ><span class="glyphicon glyphicon-pencil"></span></a></td>

                                        <td>
                                            <form action="{{action('CourseController@destroy', $course->id)}}" method="post">

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
            {{$courses->links()}}
        </div>
        </div>
    </main>

</section>
@endsection
