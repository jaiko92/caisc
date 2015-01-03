@extends('layouts.base_admin')
@section('title')
Mantenimiento Modalidad
@stop
@section('options')
<li >{{ HTML::link('modalidad','Todos') }}</li>
<li>{{ HTML::link('modalidad/create','Nuevo') }}</li>
@stop
@section('content')
<div class="panel frm-sm">
<div class="col-xs-20 col-sm-20">
  	<form method="post" action="store" class='form-horizontal',role='form'>
	  	<div class="form-group">
				{{ Form::label('id','Nombre:',array('class'=>'col-sm-2 control-label')) }}
			<div class="col-sm-5 col-md-10">
				{{ Form::text('id','',array('class'=>'form-control'))}}
			</div>
			<div class ="errores">
				@if ( $errors->has('id'))
		       		@foreach ($errors->get('id') as $error)
			   		<div class="alert alert-danger">* {{ $error }}</div>
		    		@endforeach
				@endif
			</div>
		</div>
		<br>

	  	<div class="form-group">
				{{ Form::label('descripcion','Concepto:',array('class'=>'col-sm-2 control-label')) }}
			<div class="col-sm-5 col-md-10">
				{{ Form::text('descripcion','',array('class'=>'form-control'))}}
			</div>
			<div class ="errores">
				@if ( $errors->has('descripcion'))
		       		@foreach ($errors->get('descripcion') as $error)
			   		<div class="alert alert-danger">* {{ $error }}</div>
		    		@endforeach
				@endif
			</div>
		</div>
		<br>
	  	<div class="form-group">
				{{ Form::label('monto','Monto(S/.):',array('class'=>'col-sm-2 control-label')) }}
			<div class="col-sm-5 col-md-10">
				{{ Form::text('monto','',array('class'=>'form-control'))}}
			</div>
			<div class ="errores">
			@if ( $errors->has('monto'))
		       	@foreach ($errors->get('monto') as $error)
			   	<div class="alert alert-danger">* {{ $error }}</div>
		    	@endforeach
			@endif
			</div>
		</div>
		<br>
		<div class="form-group">
			<div class="col-xs-12 col-sm-3">
				<input type="submit" value="Guardar" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
</div>
		@if(Session::has('message'))
			<div class="alert alert-{{ Session::get('class') }}">{{ Session::get('message')}}</div>
		@endif
@stop
