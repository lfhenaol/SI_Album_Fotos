<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('usuario/login','Usuario\LoginController@validar');

Route::post('usuario/registro','Usuario\RegistroController@registrar');

Route::post('usuario/validar-sesion','Usuario\SessionController@validar');

Route::group(['middleware' => ['validar_usuario']], function(){

    Route::post('album/crear-album','Album\AlbumController@crear');

    Route::post('album/consultar-albumes','Album\AlbumController@consultar');

    Route::post('album/listar-albumes','Album\AlbumController@listar');

    Route::post('imagen/guardar-imagen','Album\Imagen\ImagenController@guardar');

    Route::post('imagen/consultar-imagenes-album','Album\Imagen\ImagenController@consultar');

});

