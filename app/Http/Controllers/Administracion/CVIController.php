<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class CVIController extends Controller
{
    public $server = 'https://semina.herokuapp.com';

    public function __construct() {
        
        $this->middleware('auth');
    }

    public function index($id) {

        $paciente = Http::get($this->server.'/api/paciente/'.$id);
        
        $cviT = Http::get($this->server.'/api/cvi/'.$id);
        
        if ($paciente == 'null') {
            abort('404');
        }

        $cvi = $cviT->json();

        return view('pacientes.admin.cvi.cvi', compact('paciente', 'id', 'cvi'));
    }

    public function crear($id) {

        $datos = array(
            'Id_Paciente' => $id,
            'Fecha_CVI' => request()->fecha,
            'Cantidad_CVI' => request()->cvi,
        ); 

        Http::post($this->server.'/api/cvi/', $datos);

        return redirect()->route('paciente.cvi', $id);
    }

    public function actualizar($id, $no) {

        $datos = array(
            'Id_Paciente' => $id,
            'Fecha_CVI' => request()->fecha,
            'Cantidad_CVI' => request()->cvi,
        ); 

        Http::put($this->server.'/api/cvi/'.$no, $datos);

        return redirect()->route('paciente.cvi', $id);
    }

    public function borrar($id, $no) {

        Http::delete($this->server.'/api/cvi/'.$no);

        return redirect()->route('paciente.cvi', $id);
    }
}
