<!DOCTYPE html>
<html>
<title>Document</title>
<head>
<style>
    table {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
    
    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        width: 100%;
    }
    
    tr:nth-child(even) {
        background-color: #dddddd;
    }
    </style>
</head>
<body>
    <h2>Reporte de prestamos para: 
        @foreach ($usuarios as $usuario)
        {{$usuario->name}} {{$usuario->motherlastname}} {{$usuario->lastname}}
        @endforeach
    </h2>
    <table>
        <tr>
            <th>Id</th>
            <th>Fecha de prestamo</th>
            <th>Titulo</th>
            <th>Usuario</th>
            <th>Fecha de devolución</th>
        </tr>
            @foreach ($prestamos as $prestamo)
        <tr>
            <td>{{ $prestamo->id }}</td>
            <td>{{ $prestamo->creacion}}</td>
            <td>{{ $prestamo->libro->titulo }}</td>
            <td>{{ $prestamo->usuario->name }}</td>
            <td>{{ $prestamo->devolucion}}</td>    
        </tr>
            @endforeach
    </table>
</body>
</html>