@extends('layouts.app')
@section('content')

<div class="statbox widget box box-shadow">

    <div class="widget-content widget-content-area">
        <table class="table" id="dataTable101" class="table table-condensed table-responsive">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($chats as $chat)
                <tr>
                    <td>{{ $chat->user_id }}</td> 
                    <td>{{ $chat->name }}</td> 
                   
                    <td>
                        <a title="Conversar" href="{{ route('chat.with',$chat->user_id)}}" class="btn btn-success"><img src="img/General/responder.png"></a>
                    </td>
                </tr>
                     
                @endforeach
            </tbody>
        </table>
        
    </div>
</div>

@endsection