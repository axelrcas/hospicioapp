<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
    <title>Ficha del Paciente {{ $paciente['Nombres_Paciente'] }} {{ $paciente['Apellidos_Paciente'] }} </title>

    @include('reportes.estilos')

    <style>
        .logo {
            width: 25%;
        }
        .margen-abajo {
            margin-bottom: 5px;
        }
    </style>

</head>
<body>
    
    <div class="row text-center">
        <img src="{{ public_path().'/src/img/logos/logo.png' }}" class="logo">
    </div>

    <div class="row text-center">
        <h5>BOLETA DE INFORMACIÓN DE EGRESOS</h5>
    </div>

    <br>

    <div class="row margen-abajo">
        <div class="col-xs-5">
            <b>Nombre:</b> {{ $paciente['Nombres_Paciente'] }}
        </div>
        <div class="col-xs-5">
            <b>Apellido:</b> {{ $paciente['Apellidos_Paciente'] }}
        </div>
    </div>

    <div class="row margen-abajo">
        <div class="col-xs-12">
            <b>Dirección Domiciliar:</b> {{ $paciente['Direccion_Domiciliar'] }}
        </div>
    </div>

    <div class="row margen-abajo">
        <div class="col-xs-5">
            <b>Municipio:</b> {{ $paciente['Municipio'] }}
        </div>
        <div class="col-xs-5">
            <b>Departamento:</b> {{ $paciente['Departamento'] }}
        </div>
    </div>

    <div class="row margen-abajo">
        <div class="col-xs-5">
            <b>Pais:</b> {{ $paciente['Pais'] }}
        </div>
        <div class="col-xs-5">
            <b>Fecha Nacimiento:</b> {{ $paciente['Fecha_Nacimiento'] }}
        </div>
    </div>

    <div class="row margen-abajo">
        <div class="col-xs-5">
            <b>Edad:</b> {{ $paciente['Edad'] }} Años
        </div>
        <div class="col-xs-5">
            <b>Genero:</b> {{ $paciente['Genero'] }}
        </div>
    </div>

    <div class="row margen-abajo">
        <div class="col-xs-12">
            <b>Ocupacion:</b> {{ $paciente['Ocupacion'] }}
        </div>        
    </div>

    <div class="row margen-abajo">
        <div class="col-xs-5">
            <b>Nivel Educativo:</b> {{ $paciente['Id_Nivel_E'] }}
        </div>
        <div class="col-xs-5">
            <b>Sabe Leer:</b> @if ($paciente['Sabe_Leer'] == "1") Si @else No @endif
        </div>
    </div>

    <div class="row margen-abajo">
        <div class="col-xs-12">
            <b>Fecha Ingreso:</b> null
        </div>
    </div>

    <div class="row margen-abajo">
        <div class="col-xs-12">
            <b>Fecha de Prueba:</b> {{ $paciente['Fecha_Prueba'] }}
        </div>
    </div>

    <div class="row margen-abajo">
        <div class="col-xs-5">
            <b>Registro Hospitalario:</b> {{ $paciente['Registro_hospitalario'] }}
        </div>
        <div class="col-xs-5">
            <b>Registro Hospicio:</b> null
        </div>
    </div>

    <div class="row margen-abajo">
        <div class="col-xs-5">
            <b>Toma ARV:</b> @if ($paciente['Toma_ARV'] == "1") Si @else No @endif
        </div>
        <div class="col-xs-5">
            <b>Fecha de Inicio ARV:</b> {{ $paciente['Fecha_InicioARV'] }}
        </div>
    </div>

    <div class="row margen-abajo">
        <div class="col-xs-4">

            <div class="text-center">
                <h4>CD4</h4>
            </div>

            <table class="table table-bordered">
                <tr>
                    <th>FECHA</th>
                    <th>CANTIDAD</th>
                </tr>
                <tbody>
                    @foreach ($CD4 as $cd4_in)
                        @if ( $cd4_in['CD4'] <> null )
                            <tr>
                                <td>{{ $cd4_in['Fecha_CD4CV'] }}</td>
                                <td>{{ $cd4_in['CD4'] }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>ENFERMEDADES OPORTUNISTAS</th>
            <th>TOMA MEDICAMENTOS</th>
            <th>FECHA INICIO</th>
            <th>FECHA MEJORÍA</th>
        </tr>
        <tbody>
            @foreach ($enfermendades as $enfermendad)
                <tr>
                    <td>{{ $enfermendad['Enfermedades_Oportunistas'] }}</td>
                    <td>{{ $enfermendad['Toma_Medicamento'] }}</td>
                    <td>{{ $enfermendad['Fecha_Inicio_EO'] }}</td>
                    <td>{{ $enfermendad['Fecha_Mejora_EO'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>