<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class EnfermedadesController extends Controller
{
    public $server = 'https://semina.herokuapp.com';

    public function __construct() {
        
        $this->middleware('auth');
    }

    public function index($id) {

        $paciente = Http::get($this->server.'/api/paciente/'.$id);
        
        $enfermedadesOp = Http::get($this->server.'/api/enfermedad/paciente/'.$id);
        
        if ($paciente == 'null') {
            abort('404');
        }

        $enfermedades = $enfermedadesOp->json();

        return view('pacientes.admin.enfermedades.enfermedades', compact('paciente', 'id', 'enfermedades'));
    }

    public function nuevo($id) {

        $paciente = Http::get($this->server.'/api/paciente/'.$id);

        if ($paciente == 'null') {
            abort('404');
        }

        return view('pacientes.admin.enfermedades.nuevo', compact('paciente', 'id'));
    }

    public function crear($id) {

        $datos = array(
            'Id_Paciente' => $id,
            'Enfermedades_Oportunistas' => request()->enfermedades,
            'Toma_Medicamento' => request()->medicamentos,
            'Fecha_Inicio_EO' => request()->fecha,
            'Fecha_Mejora_EO' => request()->mejora,
        ); 

        Http::post($this->server.'/api/enfermedad/', $datos);

        return redirect()->route('paciente.enfermedades', $id);
    }

    public function leer($id, $no) {

        $paciente = Http::get($this->server.'/api/paciente/'.$id);

        $enfermedad = Http::get($this->server.'/api/enfermedad/'.$no);

        if ($enfermedad == 'null' || $paciente == 'null') {
            abort('404');
        }

        return view('pacientes.admin.enfermedades.actualizar', compact('paciente', 'enfermedad', 'id', 'no'));
    }

    public function actualizar($id, $no) {

        $datos = array(
            'Id_Paciente' => $id,
            'Enfermedades_Oportunistas' => request()->enfermedades,
            'Toma_Medicamento' => request()->medicamentos,
            'Fecha_Inicio_EO' => request()->fecha,
            'Fecha_Mejora_EO' => request()->mejora,
        ); 

        Http::put($this->server.'/api/enfermedad/'.$no, $datos);

        return redirect()->route('paciente.enfermedades', $id);
    }

    public function borrar($id, $no) {

        Http::delete($this->server.'/api/enfermedad/'.$no);

        return redirect()->route('paciente.enfermedades', $id);
    }
}
