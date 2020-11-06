<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class PacientesController extends Controller
{
    public $server = 'https://semina.herokuapp.com';

    public function __construct() {
        
        $this->middleware('auth');
    }

    public function index() {

        $response = Http::get($this->server.'/api/paciente/');

        $pacientes = $response['data'];

        return view('pacientes.pacientes', compact('pacientes'));
    }

    public function createForm() {

        return view('pacientes.create');
    }

    public function create() {

        list($ano,$mes,$dia) = explode("-",request()->fechanac);
        $ano_diferencia  = date("Y") - $ano;
        $mes_diferencia = date("m") - $mes;
        $dia_diferencia   = date("d") - $dia;

        if ($dia_diferencia < 0 || $mes_diferencia < 0)
            $ano_diferencia--;

        $edad = $ano_diferencia;

        $datos = array(
            'Nombres_Paciente' => request()->nombre,
            'Apellidos_Paciente' => request()->apellidos,
            'Direccion_Domiciliar' => request()->direccion,
            'Municipio' => request()->municipio,
            'Departamento' => request()->departamento,
            'Pais' => request()->nacionalidad,
            'Edad' => $edad,
            'Fecha_Nacimiento' => request()->fechanac,
            'Genero' => request()->genero,
            'Ocupacion' => request()->ocupacion,
            'Sabe_Leer' => request()->sabeleer,
            'Id_Nivel_E' => request()->nivelacademico,
            'Fecha_Prueba' => request()->fechaprueba,
            'Registro_hospitalario' => request()->registrohospitalario,
            'Toma_ARV' => request()->tomaarv, 
            'Fecha_InicioARV' => request()->fechainicioarv
        );

        Http::post($this->server.'/api/paciente/', $datos);

        return redirect()->route('pacientes.index');
    }

    public function read($id) {

        $paciente = Http::get($this->server.'/api/paciente/'.$id);

        if ($paciente == 'null') {
            abort('404');
        }

        return view('pacientes.update', compact('paciente'));
    }

    public function update($id) {

        list($ano,$mes,$dia) = explode("-",request()->fechanac);
        $ano_diferencia  = date("Y") - $ano;
        $mes_diferencia = date("m") - $mes;
        $dia_diferencia   = date("d") - $dia;

        if ($dia_diferencia < 0 || $mes_diferencia < 0)
            $ano_diferencia--;

        $edad = $ano_diferencia;

        $datos = array(
            'Nombres_Paciente' => request()->nombre,
            'Apellidos_Paciente' => request()->apellidos,
            'Direccion_Domiciliar' => request()->direccion,
            'Municipio' => request()->municipio,
            'Departamento' => request()->departamento,
            'Pais' => request()->nacionalidad,
            'Edad' => $edad,
            'Fecha_Nacimiento' => request()->fechanac,
            'Genero' => request()->genero,
            'Ocupacion' => request()->ocupacion,
            'Sabe_Leer' => request()->sabeleer,
            'Id_Nivel_E' => request()->nivelacademico,
            'Fecha_Prueba' => request()->fechaprueba,
            'Registro_hospitalario' => request()->registrohospitalario,
            'Toma_ARV' => request()->tomaarv, 
            'Fecha_InicioARV' => request()->fechainicioarv
        );

        Http::put($this->server.'/api/paciente/'.$id, $datos);

        return redirect()->route('pacientes.index');
    }

    public function delete($id) {
        
        Http::delete($this->server.'/api/paciente/'.$id);

        return redirect()->route('pacientes.index');
    }

    public function getdelete($id) {
        
        abort('404');
    }
}
