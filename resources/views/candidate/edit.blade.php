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

                        <h3 class="panel-title">Editar Candidato</h3>

                    </div>

                    <div class="panel-body">

                        <div class="table-container">

                            <form method="POST" action="{{ route('candidate.update',$candidate->id) }}"  role="form">

                                {{ csrf_field() }}

                                <input name="_method" type="hidden" value="PATCH">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">

                                            <input type="text" name="name" id="name" class="form-control input-sm" value="{{$candidate->name}}">

                                        </div>
                                    </div>

                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">

                                            <input type="text" name="lastname" id="lastname" class="form-control input-sm" value="{{$candidate->lastname}}">

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">

                                            <input type="text" name="email" id="email" class="form-control input-sm" value="{{$candidate->email}}">

                                        </div>
                                    </div>

                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="phone_number" id="phone_number" class="form-control input-sm" value="{{$candidate->phone_number}}">
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <select name="promotion_id" class="form-control" id="promotion_id"  placeholder="Promocion">
                                        <option selected>Promociones...</option>
                                        @foreach($promotions as $promotion)
                                            <option value="{{$promotion->id}}" >{{$promotion->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="sololearn" id="sololearn" class="form-control input-sm" value="{{$candidate->sololearn}}">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="codeacademy" id="codeacademy" class="form-control input-sm" value="{{$candidate->codeacademy}}">
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">

                                        <input type="submit"  value="Actualizar" class="btn btn-success btn-block">

                                        <a href="{{ route('candidate.index') }}" class="btn btn-info btn-block" >Atrás</a>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </section>
@endsection
