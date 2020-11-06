<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class AdminPacienteController extends Controller
{
    public $server = 'https://semina.herokuapp.com';

    public function __construct() {
        
        $this->middleware('auth');
    }

    public function admin($id) {

        $paciente = Http::get($this->server.'/api/paciente/'.$id);

        if ($paciente == 'null') {
            abort('404');
        }

        $hasControlNutricional = Http::get($this->server.'/api/peso/'.$id);;

        return view('pacientes.admin.admin', compact('paciente', 'id', 'hasControlNutricional'));
    }

}
