<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ControlNutricionalController extends Controller
{
    public $server = 'https://semina.herokuapp.com';

    public function __construct() {
        
        $this->middleware('auth');
    }

    /* CONTROL PRINCIPAL DE NUTRICION --- BANNER PRINCIPAL */

    public function crearControl($id) {

        $datos = array(
            'Id_Paciente' => request()->idPaciente,
            'Talla' => request()->talla,
            'Peso_Min' => request()->pesomin,
            'Peso_Max' => request()->pesomax,
        );

        Http::post($this->server.'/api/peso/', $datos);

        return redirect()->route('paciente.nutricion', $id);
    }

    public function updateControl($id, $no) {
        
        $datos = array(
            'Id_Paciente' => $id,
            'Talla' => request()->talla,
            'Peso_Min' => request()->pesomin,
            'Peso_Max' => request()->pesomax,
        );
        
        Http::put($this->server.'/api/peso/'.$no, $datos);

        return redirect()->route('paciente.nutricion', $id);
    }

    public function deleteControl($id, $no) {

        Http::delete($this->server.'/api/peso/'.$no);

        return redirect()->route('paciente.admin', $id);
    }



    /* ESTADOS NUTRICIONALES --- PROCESOS */

    public function index($id) {

        $paciente = Http::get($this->server.'/api/paciente/'.$id);
        
        $controlNutricional = Http::get($this->server.'/api/peso/'.$id);

        $nutricion = Http::get($this->server.'/api/nutricion/'.$id);

        if ($nutricion == 'null' || $paciente == 'null' || count($controlNutricional->json()) == 0) {
            abort('404');
        }

        $nutricional = $nutricion->json();
        
        if ( count($nutricional) > 0 ) {

            $infoPrincipal = $nutricion[0];
        } else {
            $infoPrincipal = '';
        }

        $control = $controlNutricional[0];

        return view('pacientes.admin.nutricion.nutricion', compact('paciente', 'id', 'nutricional', 'infoPrincipal', 'control'));
    }

    public function nuevo($id) {

        $paciente = Http::get($this->server.'/api/paciente/'.$id);

        $nutricion = Http::get($this->server.'/api/nutricion/'.$id);

        if ($paciente == 'null' || $nutricion == 'null') {
            abort('404');
        }

        $infoPrincipal = $nutricion[0];

        return view('pacientes.admin.nutricion.nuevo', compact('paciente', 'id', 'infoPrincipal'));
    }

    public function crear($id) {

        request()->primero == "on" ? $primero = "true" : $primero = "false";
        request()->segundo == "on" ? $segundo = "true" : $segundo = "false";
        request()->tercero == "on" ? $tercero = "true" : $tercero = "false";

        $datos = array(
            'Id_Paciente' => request()->idpaciente,
            'Peso' => request()->peso,
            'Fecha_E' => request()->fecha,
            'Primero' => $primero,
            'Segundo' => $segundo,
            'Tercero' => $tercero,
            'Observaciones' => request()->observaciones,
        );

        Http::post($this->server.'/api/nutricion/', $datos);

        return redirect()->route('paciente.nutricion', $id);
    }

    public function leer($id, $no) {

        $paciente = Http::get($this->server.'/api/paciente/'.$id);

        $estadoNutricional = Http::get($this->server.'/api/nutricion/registro/'.$no);

        if ($estadoNutricional == 'null' || $paciente == 'null') {
            abort('404');
        }

        return view('pacientes.admin.nutricion.actualizar', compact('paciente', 'estadoNutricional', 'id', 'no'));
    }

    public function actualizar($id, $no) {

        request()->primero == "on" ? $primero = "true" : $primero = "false";
        request()->segundo == "on" ? $segundo = "true" : $segundo = "false";
        request()->tercero == "on" ? $tercero = "true" : $tercero = "false";

        $datos = array(
            'Id_Paciente' => request()->idpaciente,
            'Peso' => request()->peso,
            'Fecha_E' => request()->fecha,
            'Primero' => $primero,
            'Segundo' => $segundo,
            'Tercero' => $tercero,
            'Observaciones' => request()->observaciones,
        );

        Http::put($this->server.'/api/nutricion/'.$no, $datos);

        return redirect()->route('paciente.nutricion', $id);
    }

    public function borrar($id, $no) {

        Http::delete($this->server.'/api/nutricion/'.$no);

        return redirect()->route('paciente.nutricion', $id);
    }
}
