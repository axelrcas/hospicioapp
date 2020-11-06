<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class MedicosController extends Controller
{
    public $server = 'https://semina.herokuapp.com';

    public function __construct() {
        
        $this->middleware('auth');
    }

    public function index() {

        $response = Http::get($this->server.'/api/medico/');

        $medicos = $response['data'];

        return view('medicos.medicos', compact('medicos'));
    }

    public function createForm() {

        return view('medicos.create');
    }

    public function create() {

        $datos = array(
            'Nombres_Medico' => request()->nombre,
            'Apellidos_Medico' => request()->apellidos,
            'Telefono' => request()->telefono,
            'DPI' => request()->dpi,
        );

        Http::post($this->server.'/api/medico/', $datos);

        return redirect()->route('medicos.index');
    }

    public function read($id) {

        $medico = Http::get($this->server.'/api/medico/'.$id);

        if ($medico == 'null') {
            abort('404');
        }

        return view('medicos.update', compact('medico'));
    }

    public function update($id) {


        $datos = array(
            'Id' => $id,
            'Nombres_Medico' => request()->nombre,
            'Apellidos_Medico' => request()->apellidos,
            'Telefono' => request()->telefono,
            'DPI' => request()->dpi,
        );

        Http::put($this->server.'/api/medico/'.$id, $datos);

        return redirect()->route('medicos.index');
    }

    public function delete($id) {
        
        Http::delete($this->server.'/api/medico/'.$id);

        return redirect()->route('medicos.index');
    }

    public function getdelete($id) {
        
        abort('404');
    }
}
