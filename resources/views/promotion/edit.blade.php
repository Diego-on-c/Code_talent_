@extends('layouts.layouts')
@section('content')

    <div class="row">
        <section class="content">
            <div class="col-md-8 col-md-offset-2">

                @if (count($errors) > 0)

                    <div class="alert alert-danger">
                        <strong>Error!</strong> Revise los campos obligatorios.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)

                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(Session::has('success'))
                    <div class="alert alert-info">
                        {{Session::get('success')}}
                    </div>
                @endif

                <div class="panel panel-default">

                    <div class="panel-heading">

                        <h3 class="panel-title">Nueva Promocion</h3>

                    </div>

                    <div class="panel-body">

                        <div class="table-container">

                            <form method="POST" action="{{ route('promotion.update',$promotion->id) }}"  role="form">

                                {{ csrf_field() }}

                                <input name="_method" type="hidden" value="PATCH">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="name" id="name" class="form-control input-sm" value="{{$promotion->name}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            @foreach($courses as $course)
                                                <input  name="courses_id[]" id="course_id[]" class="form-control input-sm" type="checkbox" value="{{$course->id}}"
                                                        @if (count($promotion->courses->where('id', $course->id)))
                                                        checked
                                                        @endif >{{$course->name}}
                                            @endforeach
                                        </div>
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">

                                        <input type="submit"  value="Actualizar" class="btn btn-success btn-block">

                                        <a href="{{ route('promotion.index') }}" class="btn btn-info btn-block" >Atrás</a>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </section>
@endsection

