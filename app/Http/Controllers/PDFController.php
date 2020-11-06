<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PDFController extends Controller
{
    public $server = 'https://semina.herokuapp.com';

    public function __construct() {
        
        $this->middleware('auth');
    }

    public function pdfFichaPaciente($id) {

        $paciente = Http::get($this->server.'/api/paciente/'.$id);

        $enfermendadesT = Http::get($this->server.'/api/enfermedad/paciente/'.$id);
        
        $CD4T = Http::get($this->server.'/api/cd4/'.$id);

        if ($paciente == 'null') {
            abort('404');
        }

        $CD4 = $CD4T->json();
        $enfermendades = $enfermendadesT->json();
        //return view('pacientes.fichapaciente', compact('paciente'));

        $pdf = resolve('dompdf.wrapper');
        $pdf->loadView('reportes.fichapaciente', compact('paciente', 'enfermendades', 'CD4'));
        return $pdf->stream();
    }

    public function pdfFichaCD4CargaViral($id) {

        $paciente = Http::get($this->server.'/api/paciente/'.$id);

        $CD4paciente = Http::get($this->server.'/api/cd4/'.$id);

        if ($CD4paciente == 'null' || $paciente == 'null') {
            abort('404');
        }

        $CD4CargaViralPaciente = $CD4paciente->json();

        $pdf = resolve('dompdf.wrapper');
        $pdf->loadView('reportes.fichapacientecd4', compact('paciente', 'CD4CargaViralPaciente'));
        return $pdf->stream();
    }

    public function pdfFichaControlNutricional($id) {
        
        $paciente = Http::get($this->server.'/api/paciente/'.$id);

        $nutricion = Http::get($this->server.'/api/nutricion/'.$id);

        $controlNutricional = Http::get($this->server.'/api/peso/'.$id);

        if ($nutricion == 'null' || $paciente == 'null' || count($controlNutricional->json()) == 0) {
            abort('404');
        }

        $nutricional = $nutricion->json();
        $control = $controlNutricional[0];

        $pdf = resolve('dompdf.wrapper');
        $pdf->loadView('reportes.fichapacientecontrolnutricion', compact('paciente', 'nutricional', 'control'));
        return $pdf->stream();
    }

    public function pdfFichaGlicemia($id) {
        
        $paciente = Http::get($this->server.'/api/paciente/'.$id);

        $glicemia = Http::get($this->server.'/api/glicemia/'.$id);

        if ($paciente == 'null' || count($glicemia->json()) == 0) {
            abort('404');
        }

        $control = $glicemia->json();

        $pdf = resolve('dompdf.wrapper');
        $pdf->loadView('reportes.fichapacienteglicemia', compact('paciente', 'control'));
        return $pdf->stream();
    }
}
