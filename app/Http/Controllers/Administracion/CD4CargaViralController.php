<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class CD4CargaViralController extends Controller
{
    public $server = 'https://semina.herokuapp.com';

    public function __construct() {
        
        $this->middleware('auth');
    }

    public function index($id) {

        $paciente = Http::get($this->server.'/api/paciente/'.$id);
        
        $cd4cv = Http::get($this->server.'/api/cd4/'.$id);

        if ($paciente == 'null') {
            abort('404');
        }

        $cd4cargaviral = $cd4cv->json();

        return view('pacientes.admin.cd4cargaviral.cd4cargaviral', compact('paciente', 'id', 'cd4cargaviral'));
    }

    public function nuevo($id) {

        $paciente = Http::get($this->server.'/api/paciente/'.$id);

        if ($paciente == 'null') {
            abort('404');
        }

        return view('pacientes.admin.cd4cargaviral.nuevo', compact('paciente', 'id'));
    }

    public function crear($id) {

        $datos = array(
            'Id_Paciente' => $id,
            'Fecha_CD4CV' => request()->fecha,
            'CD4' => request()->cd4,
            'Carga_Viral' => request()->cargaviral,
            'Esquema' => request()->esquema,
            'Observaciones' => request()->observaciones,
        );

        Http::post($this->server.'/api/cd4/', $datos);

        return redirect()->route('paciente.cd4cargaviral', $id);
    }

    public function leer($id, $no) {

        $paciente = Http::get($this->server.'/api/paciente/'.$id);

        $cd4cargaviral = Http::get($this->server.'/api/cd4/registro/'.$no);

        if ($cd4cargaviral == 'null' || $paciente == 'null') {
            abort('404');
        }

        return view('pacientes.admin.cd4cargaviral.actualizar', compact('paciente', 'cd4cargaviral', 'id', 'no'));
    }

    public function actualizar($id, $no) {

        $datos = array(
            'Fecha_CD4CV' => request()->fecha,
            'CD4' => request()->cd4,
            'Carga_Viral' => request()->cargaviral,
            'Esquema' => request()->esquema,
            'Observaciones' => request()->observaciones,
        );

        Http::put($this->server.'/api/cd4/'.$no, $datos);

        return redirect()->route('paciente.cd4cargaviral', $id);
    }

    public function borrar($id, $no) {

        Http::delete($this->server.'/api/cd4/'.$no);

        return redirect()->route('paciente.cd4cargaviral', $id);
    }
}
