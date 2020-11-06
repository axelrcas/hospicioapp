<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public $server = 'https://semina.herokuapp.com';

    public function __construct() {
        
        $this->middleware('auth');
    }

    public function index() {
        
        $response = Http::get($this->server.'/api/paciente/');
        $totalPacientes = count($response['data']);

        $response2 = Http::get($this->server.'/api/medico/');
        $totalMedicos = count($response2['data']);

        return view('dashboard', compact('totalPacientes', 'totalMedicos'));
    }
}
