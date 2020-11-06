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
            width: 100%;
        }
        .margen-abajo {
            margin-bottom: 5px;
        }
        .margen-izquierda-1 {
            margin-left: 40px;
        }
    </style>

</head>
<body>
    
    <div class="row margen-abajo">
        <div class="col-xs-2">
            <img src="{{ public_path().'/src/img/logos/logo.png' }}" class="logo">
        </div>
        <div class="row">
            <div class="col-xs-10 margen-izquierda-1">
                <h3>CONTROL DE CD4 Y CARGA VIRAL</h3>
            </div>
            <br><br><br>
            <div class="col-xs-10 margen-izquierda-1">
                <h4><b>NOMBRE: </b> {{ $paciente['Nombres_Paciente'] }} {{ $paciente['Apellidos_Paciente'] }}</h4>
            </div>
        </div>
    </div>

    <br>

    <table class="table table-bordered">
        <tr>
            <th>FECHA</th>
            <th>HORA</th>
            <th>PRE</th>
            <th>HORA</th>
            <th>POS</th>
        </tr>
        <tbody>
            @foreach ($control as $glicemia)
                <tr class="text-center">
                    <td>{{ $glicemia['Fecha_Glicemia'] }}</td>
                    <td>{{ $glicemia['Hora_Pre'] }}</td>
                    <td>
                        @if ( $glicemia['Pre'] == "true" )
                            <h3><b>X</b></h3>
                        @endif
                    </td>
                    <td>{{ $glicemia['Hora_Pos'] }}</td>
                    <td>
                        @if ( $glicemia['Pos'] == "true" )
                            <h3><b>X</b></h3>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    
    
    <br><br><br>





    {{-- <div class="row margen-abajo">
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
    </div> --}}

</body>
</html>