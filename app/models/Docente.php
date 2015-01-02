<?php

class Docente extends Eloquent {

	protected $table = 'docente';
	protected $fillable = array('nombre','apellidos','dni','direccion','telefono','email','password');

	public static function agregar($input)
	{
		$respuesta = array();
		$reglas = array(
			'nombre'=>array('required','min:3','max:15'),
			'apellidos'=>array('required','min:3','max:25'),
			'dni'=>array('required','numeric','digits:8','unique:docente'),
			'direccion'=>array('max:50'),
			'telefono'=>array('max:20'),
			'email'=>array('required','email','unique:docente','max:40','unique:users'),
			'password'=>array('required','min:6','confirmed','max:12')
		);
		$validador = Validator::make($input,$reglas);
		if($validador->fails())
		{
			$respuesta['mensaje'] = $validador;
			$respuesta['error'] = true;
		} else
		{
			$input['password'] = Hash::make($input['password']);
			$docente = static::create($input);
			$respuesta['mensaje'] = 'Docente Creado';
			$respuesta['error'] = false;
			$respuesta['data'] = $docente;
		}
		return $respuesta;
	}


	public static function editar($obj,$input)
	{
		$respuesta = array();
		$reglas = array(
			'nombre'=>array('required','min:3','max:15'),
			'apellidos'=>array('required','min:3','max:25'),
			'direccion'=>array('max:50'),
			'telefono'=>array('max:20'),
		);
		$validador = Validator::make($input,$reglas);
		if($validador->fails())
		{
			$respuesta['mensaje'] = $validador;
			$respuesta['error'] = true;
		} else
		{
			$obj->nombre = Input::get('nombre');
			$obj->apellidos = Input::get('apellidos');
			$obj->direccion = Input::get('direccion');
			$obj->telefono = Input::get('telefono');
			$obj->save();
			$respuesta['mensaje'] = 'Datos Actualizados';
			$respuesta['error'] = false;
		}
		return $respuesta;
	}

	public static function updatePassword($obj,$input)
	{
		$input['pasado'] = Hash::make($input['pasado']);
		$respuesta = array();
		$reglas = array(
			'password'=>array('required','min:6','confirmed','max:12')
		);
		$validador = Validator::make($input,$reglas);
		if($validador->fails())
		{
			$respuesta['mensaje'] = $validador;
			$respuesta['error'] = true;
		} else
		{
			$user = User::where('nroId','=',$obj->id)->firstOrFail();
			$obj->password =  Hash::make($input['password']);
			$user->password = $obj->password;
			$obj->save();
			$user->save();
			$respuesta['error'] = false;
			$respuesta['mensaje'] = 'Contraseña Actualizado';
		}
		return $respuesta;
	}
}

