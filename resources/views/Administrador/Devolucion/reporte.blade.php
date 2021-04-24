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
    <h2>Reporte de devoluciones</h2>
    <table>
        <tr>
            <th>Id</th>
            <th>Fecha estimada devolucion</th>
            <th>Titulo</th>
            <th>Usuario</th>
            <th>Fecha de devolución</th>
        </tr>
            @foreach ($devoluciones as $devolucion)
        <tr>
            <td>{{ $devolucion->id }}</td>
            <td>{{ $devolucion->devolucion}}</td>
            <td>{{ $devolucion->libro->titulo }}</td>
            <td>{{ $devolucion->usuario->name }}</td>
            <td>{{ $devolucion->devolucionreal}}</td>    
        </tr>
            @endforeach
    </table>
</body>
</html>