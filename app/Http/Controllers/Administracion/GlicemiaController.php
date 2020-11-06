<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class GlicemiaController extends Controller
{
    public $server = 'https://semina.herokuapp.com';

    public function __construct() {
        
        $this->middleware('auth');
    }

    public function index($id) {

        $paciente = Http::get($this->server.'/api/paciente/'.$id);
        
        $glicemiaT = Http::get($this->server.'/api/glicemia/'.$id);

        if ($paciente == 'null') {
            abort('404');
        }

        $glicemia = $glicemiaT->json();

        return view('pacientes.admin.glicemia.glicemia', compact('paciente', 'id', 'glicemia'));
    }

    public function nuevo($id) {

        $paciente = Http::get($this->server.'/api/paciente/'.$id);

        if ($paciente == 'null') {
            abort('404');
        }

        return view('pacientes.admin.glicemia.nuevo', compact('paciente', 'id'));
    }

    public function crear($id) {

        request()->pre == "on" ? $pre = "true" : $pre = "false";
        request()->pos == "on" ? $pos = "true" : $pos = "false";

        $datos = array(
            'Id_Paciente' => $id,
            'Fecha_Glicemia' => request()->fecha,
            'Hora_Pre' => request()->horapre,
            'Pre' => $pre,
            'Hora_Pos' => request()->horapos,
            'Pos' => $pos,
        );

        Http::post($this->server.'/api/glicemia/', $datos);

        return redirect()->route('paciente.glicemia', $id);
    }

    public function leer($id, $no) {

        $paciente = Http::get($this->server.'/api/paciente/'.$id);

        $glicemia = Http::get($this->server.'/api/glicemia/registro/'.$no);

        if ($glicemia == 'null' || $paciente == 'null') {
            abort('404');
        }
        
        return view('pacientes.admin.glicemia.actualizar', compact('paciente', 'glicemia', 'id', 'no'));
    }

    public function actualizar($id, $no) {

        request()->pre == "on" ? $pre = "true" : $pre = "false";
        request()->pos == "on" ? $pos = "true" : $pos = "false";

        $datos = array(
            'Id_Paciente' => $id,
            'Fecha_Glicemia' => request()->fecha,
            'Hora_Pre' => request()->horapre,
            'Pre' => $pre,
            'Hora_Pos' => request()->horapos,
            'Pos' => $pos,
        );

        Http::put($this->server.'/api/glicemia/'.$no, $datos);

        return redirect()->route('paciente.glicemia', $id);
    }

    public function borrar($id, $no) {

        Http::delete($this->server.'/api/glicemia/'.$no);

        return redirect()->route('paciente.glicemia', $id);
    }
}
