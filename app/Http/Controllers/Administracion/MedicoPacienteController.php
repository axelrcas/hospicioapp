<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class MedicoPacienteController extends Controller
{
    public $server = 'https://semina.herokuapp.com';

    public function __construct() {
        
        $this->middleware('auth');
    }

    public function index($id) {

        $paciente = Http::get($this->server.'/api/paciente/'.$id);
        
        $control = Http::get($this->server.'/api/control/'.$id);

        $medico = Http::get($this->server.'/api/medico/');

        if ($paciente == 'null') {
            abort('404');
        }

        $controlMedico = $control->json();
        $medicos = $medico['data'];

        return view('pacientes.admin.medicopaciente.medicopaciente', compact('paciente', 'id', 'controlMedico', 'medicos'));
    }

    public function crear($id) {
        
        $datos = array(
            'Id' => auth()->user()->id,
            'Id_Medico' => request()->medico,
            'Id_Paciente' => request()->paciente,
            'Fecha_ingreso' => request()->fecha,
        );

        Http::post($this->server.'/api/control/', $datos);

        return redirect()->route('medicopaciente.index', $id);
    }

    public function actualizar($id, $no) {

        $datos = array(
            'Id_Medico' => request()->medico,
        );

        Http::put($this->server.'/api/control/'.$no, $datos);

        return redirect()->route('medicopaciente.index', $id);
    }

    public function borrar($id, $no) {
        
        Http::delete($this->server.'/api/control/'.$no);

        return redirect()->route('medicopaciente.index', $id);
    }
}
