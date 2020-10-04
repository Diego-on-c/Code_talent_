@extends('dashboardAdmin.dashboard')

@section('content')

    <section>
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Lista de Promociones</h1>
                <div class="pull-right">
                    <div class="btn-group">
                        <a href="{{ route('promotion.create') }}" class="btn btn-info" >Añadir Promoción</a>
                    </div>
                </div>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="/dashboard">Panel</a></li>
                    <li class="breadcrumb-item active">Promoción</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Promociones
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                <thead>

                                <th>Nombre</th>

                                <th>Cursos</th>

                                <th>Creación</th>

                                <th>Editar</th>

                                <th>Eliminar</th>

                                </thead>
                                <tbody>

                                @if($promotions->count())

                                    @foreach($promotions as $promotion)


                                        <tr>

                                            <td><a href="{{action('PromotionController@show',$promotion->id)}}">{{$promotion->name}}</a></td>
                                            <td>
                                            @foreach($promotion->courses as $course)
                                                <p>{{$course->name}}</p>
                                            @endforeach
                                            </td>

                                            <td>{{$promotion->created_at}}</td>


                                            <td><a class="btn btn-primary btn-xs" href="{{action('PromotionController@edit', $promotion->id)}}" ><span class="glyphicon glyphicon-pencil"></span></a></td>

                                            <td>
                                                <form action="{{action('PromotionController@destroy', $promotion->id)}}" method="post">

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
                {{$promotions->links()}}
            </div>
            </div>
        </main>

    </section>
@endsection
