<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			//return Redirect::guest('login');
			return Redirect::guest('/');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

Route::filter('sessionDoc',function()
{
	if (Auth::check())
	{
		$tipoUsuario = Auth::user()->gettipoUsuario();
		if($tipoUsuario == "Personal")
		{
			//return Redirect::to('persona');
		}
		else
		{
			if($tipoUsuario=="Alumno")
			{
				return Redirect::to('alumno');
			}
		}
	}

});
Route::filter('sessionPer',function()
{
	if (Auth::check())
	{
		$tipoUsuario = Auth::user()->gettipoUsuario();
		if($tipoUsuario == "Docente")
		{
			return Redirect::to('docente');
		}
		else
		{
			if($tipoUsuario=="Alumno")
			{
				return Redirect::to('alumno');
			}
		}
	}

});

Route::filter('sessionAlu',function()
{
	if (Auth::check())
	{
		$tipoUsuario = Auth::user()->gettipoUsuario();
		if($tipoUsuario == "Personal")
		{
			//return Redirect::to('persona');
		}
		else
		{
			if($tipoUsuario=="Docente")
			{
				return Redirect::to('docente');
			}
		}
	}

});

Route::filter('sessionPerCaja',function()
{
	if (Auth::check())
	{
		$tipoUsuario = Auth::user()->gettipoUsuario();
		if($tipoUsuario == "Docente")
		{
			return Redirect::to('docente');
		}
		else
		{
			if($tipoUsuario=="Alumno")
			{
				return Redirect::to('alumno');
			}
		}
		if($tipoUsuario=="Personal")
		{			
			$NroId = Auth::user()->getnroId();
			$personal = Personal::where('id','=',$NroId)->firstOrFail();
			$CargoId = $personal->getcargoId();
			$Cargo = Cargo::where('id','=',$CargoId)->firstOrFail();
			$tipoCargo = $Cargo->getNombre();
			if(($tipoCargo!="Cajero") && ($tipoCargo != "Cajera")&&($tipoCargo != "Administrador")&&($tipoCargo != "Director") )
			{
				return Redirect::to('persona');				
			}

		}
	}

});