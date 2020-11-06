<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Auth\LoginController@mostrarLoginForm')->middleware('guest');

Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/dashboard', 'Administracion\DashboardController@index')->name('dashboard');

/* MEDICOS */
Route::get('/medicos', 'Administracion\MedicosController@index')->name('medicos.index');
Route::get('/nuevo-medico', 'Administracion\MedicosController@createForm')->name('medicos.createForm');
Route::post('/nuevo-medico', 'Administracion\MedicosController@create')->name('medicos.create');
Route::get('/medico/{id}', 'Administracion\MedicosController@read')->name('medicos.read');
Route::post('/medico/{id}', 'Administracion\MedicosController@update')->name('medicos.update');
Route::post('/medico/d/{id}', 'Administracion\MedicosController@delete')->name('medicos.delete');
Route::get('/medico/d/{id}', 'Administracion\MedicosController@getdelete')->name('medicos.getdelete');      // evitar metodo get en novegador

/* PACIENTES */
Route::get('/pacientes', 'Administracion\PacientesController@index')->name('pacientes.index');
Route::get('/nuevo-paciente', 'Administracion\PacientesController@createForm')->name('pacientes.createForm');
Route::post('/nuevo-paciente', 'Administracion\PacientesController@create')->name('pacientes.create');
Route::get('/paciente/{id}', 'Administracion\PacientesController@read')->name('pacientes.read');
Route::post('/paciente/{id}', 'Administracion\PacientesController@update')->name('pacientes.update');
Route::post('/paciente/d/{id}', 'Administracion\PacientesController@delete')->name('pacientes.delete');
Route::get('/paciente/d/{id}', 'Administracion\PacientesController@getdelete')->name('pacientes.getdelete');      // evitar metodo get en novegador

/* ADMINISTRACION PACIENTE */
Route::get('/admin/paciente/{id}', 'Administracion\AdminPacienteController@admin')->name('paciente.admin');

/* CD4 Y CARGA VIRAL PARA PACIENTE */
Route::get('/admin/paciente/{id}/cd4-y-carga-viral', 'Administracion\CD4CargaViralController@index')->name('paciente.cd4cargaviral');
Route::get('/admin/paciente/{id}/cd4-y-carga-viral/nuevo', 'Administracion\CD4CargaViralController@nuevo')->name('paciente.cd4cargaviral.nuevo');
Route::post('/admin/paciente/{id}/cd4-y-carga-viral/nuevo', 'Administracion\CD4CargaViralController@crear')->name('paciente.cd4cargaviral.crear');
Route::get('/admin/paciente/{id}/cd4-y-carga-viral/{no}', 'Administracion\CD4CargaViralController@leer')->name('paciente.cd4cargaviral.leer');
Route::post('/admin/paciente/{id}/cd4-y-carga-viral/{no}', 'Administracion\CD4CargaViralController@actualizar')->name('paciente.cd4cargaviral.actualizar');
Route::post('/admin/paciente/{id}/cd4-y-carga-viral/d/{no}', 'Administracion\CD4CargaViralController@borrar')->name('paciente.cd4cargaviral.borrar');
Route::get('/admin/paciente/{id}/cd4-y-carga-viral/d/{no}', 'Administracion\CD4CargaViralController@getBorrar')->name('paciente.cd4cargaviral.getBorrar');    // evitar metodo get en novegador

/* CONTROL GENERAL DE ESTADO NUTRICIONAL PARA PACIENTE */
Route::post('/admin/paciente/{id}/nutricion/crear-control', 'Administracion\ControlNutricionalController@crearControl')->name('paciente.nutricion.crearControl');
Route::post('/admin/paciente/{id}/nutricion/actualizar-control/{no}', 'Administracion\ControlNutricionalController@updateControl')->name('paciente.nutricion.updateControl');
Route::post('/admin/paciente/{id}/nutricion/eliminar-control/{no}', 'Administracion\ControlNutricionalController@deleteControl')->name('paciente.nutricion.deleteControl');

/* ESTADOS DEL CONTROL GENERAL DE ESTADO NUTRICIONAL PARA PACIENTE */
Route::get('/admin/paciente/{id}/nutricion', 'Administracion\ControlNutricionalController@index')->name('paciente.nutricion');
Route::get('/admin/paciente/{id}/nutricion/nuevo', 'Administracion\ControlNutricionalController@nuevo')->name('paciente.nutricion.nuevo');
Route::post('/admin/paciente/{id}/nutricion/nuevo', 'Administracion\ControlNutricionalController@crear')->name('paciente.nutricion.crear');
Route::get('/admin/paciente/{id}/nutricion/{no}', 'Administracion\ControlNutricionalController@leer')->name('paciente.nutricion.leer');
Route::post('/admin/paciente/{id}/nutricion/{no}', 'Administracion\ControlNutricionalController@actualizar')->name('paciente.nutricion.actualizar');
Route::post('/admin/paciente/{id}/nutricion/d/{no}', 'Administracion\ControlNutricionalController@borrar')->name('paciente.nutricion.borrar');
Route::get('/admin/paciente/{id}/nutricion/d/{no}', 'Administracion\ControlNutricionalController@getBorrar')->name('paciente.nutricion.getBorrar');    // evitar metodo get en novegador

/* CONTROL DE MEDICO ASIGNADO AL PACIENTE */
Route::get('/admin/paciente/{id}/medico', 'Administracion\MedicoPacienteController@index')->name('medicopaciente.index');
Route::post('/admin/paciente/{id}/medico', 'Administracion\MedicoPacienteController@crear')->name('medicopaciente.crear');
Route::post('/admin/paciente/{id}/medico/{no}', 'Administracion\MedicoPacienteController@actualizar')->name('medicopaciente.actualizar');
Route::post('/admin/paciente/{id}/medico/d/{no}', 'Administracion\MedicoPacienteController@borrar')->name('medicopaciente.borrar');

/* CONTROL DE ENFERMEDADES */
Route::get('/admin/paciente/{id}/enfermedades', 'Administracion\EnfermedadesController@index')->name('paciente.enfermedades');
Route::get('/admin/paciente/{id}/enfermedades/nuevo', 'Administracion\EnfermedadesController@nuevo')->name('paciente.enfermedades.nuevo');
Route::post('/admin/paciente/{id}/enfermedades/nuevo', 'Administracion\EnfermedadesController@crear')->name('paciente.enfermedades.crear');
Route::get('/admin/paciente/{id}/enfermedades/{no}', 'Administracion\EnfermedadesController@leer')->name('paciente.enfermedades.leer');
Route::post('/admin/paciente/{id}/enfermedades/{no}', 'Administracion\EnfermedadesController@actualizar')->name('paciente.enfermedades.actualizar');
Route::post('/admin/paciente/{id}/enfermedades/d/{no}', 'Administracion\EnfermedadesController@borrar')->name('paciente.enfermedades.borrar');
Route::get('/admin/paciente/{id}/enfermedades/d/{no}', 'Administracion\EnfermedadesController@getBorrar')->name('paciente.enfermedades.getBorrar');

/* CONTROL DE CVI */
Route::get('/admin/paciente/{id}/cvi', 'Administracion\CVIController@index')->name('paciente.cvi');
Route::post('/admin/paciente/{id}/cvi', 'Administracion\CVIController@crear')->name('paciente.cvi.crear');
Route::post('/admin/paciente/{id}/cvi/{no}', 'Administracion\CVIController@actualizar')->name('paciente.cvi.actualizar');
Route::post('/admin/paciente/{id}/cvi/d/{no}', 'Administracion\CVIController@borrar')->name('paciente.cvi.borrar');

/* CONTROL DE GLICEMIA */
Route::get('/admin/paciente/{id}/glicemia', 'Administracion\GlicemiaController@index')->name('paciente.glicemia');
Route::get('/admin/paciente/{id}/glicemia/nuevo', 'Administracion\GlicemiaController@nuevo')->name('paciente.glicemia.nuevo');
Route::post('/admin/paciente/{id}/glicemia/nuevo', 'Administracion\GlicemiaController@crear')->name('paciente.glicemia.crear');
Route::get('/admin/paciente/{id}/glicemia/{no}', 'Administracion\GlicemiaController@leer')->name('paciente.glicemia.leer');
Route::post('/admin/paciente/{id}/glicemia/{no}', 'Administracion\GlicemiaController@actualizar')->name('paciente.glicemia.actualizar');
Route::post('/admin/paciente/{id}/glicemia/d/{no}', 'Administracion\GlicemiaController@borrar')->name('paciente.glicemia.borrar');
Route::get('/admin/paciente/{id}/glicemia/d/{no}', 'Administracion\GlicemiaController@getBorrar')->name('paciente.glicemia.getBorrar');    // evitar metodo get en novegador








/* REPORTES EN PDF */
Route::get('/ficha/{id}', 'PDFController@pdfFichaPaciente')->name('descargarPDF');
Route::get('/cd4-carga-varial/paciente/{id}/', 'PDFController@pdfFichaCD4CargaViral')->name('pdfFichaCD4CargaViral');
Route::get('/control-estado-nutricional/paciente/{id}/', 'PDFController@pdfFichaControlNutricional')->name('pdfFichaControlNutricional');
Route::get('/glicemia/paciente/{id}/', 'PDFController@pdfFichaGlicemia')->name('pdfFichaGlicemia');




Route::get('/home', 'HomeController@index')->name('home');
