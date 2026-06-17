@extends('layouts.master')

@section('content')

<style>

    .listado-container {
        width: 100%;
        padding: 10px;
    }

    .listado-card {
        background: #fff;
        border-radius: 4px;
        border: 1px solid #dcdcdc;
        overflow: hidden;
    }

    .listado-header {
        background: #f5f5f5;
        padding: 10px 15px;
        border-bottom: 1px solid #dcdcdc;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .listado-header h2 {
        margin: 0;
        font-size: 24px;
        color: #1e7e34;
        font-weight: bold;
    }

    .listado-header h2 i {
        margin-right: 8px;
    }

    .listado-body {
        padding: 15px;
    }

    .filtros {
        display: flex;
        justify-content: flex-end;
        align-items: end;
        gap: 10px;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }

    .campo {
        min-width: 180px;
    }

    .campo label {
        display: block;
        font-size: 11px;
        font-weight: bold;
        margin-bottom: 4px;
        color: #444;
    }

    .campo input {
        width: 100%;
        height: 32px;
        border: 1px solid #ccc;
        border-radius: 3px;
        padding: 5px 8px;
        font-size: 12px;
    }

    .btn-filtrar {
        background: #198754;
        color: white;
        border: none;
        height: 32px;
        padding: 0 15px;
        border-radius: 3px;
        font-size: 12px;
        font-weight: bold;
        cursor: pointer;
    }

    .btn-filtrar:hover {
        background: #157347;
    }

    .tabla {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
    }

    .tabla thead {
        background: #f8f9fa;
    }

    .tabla th {
        padding: 10px;
        text-align: left;
        font-size: 11px;
        color: #555;
        border-bottom: 1px solid #ddd;
    }

    .tabla td {
        padding: 10px;
        border-bottom: 1px solid #f0f0f0;
        color: #333;
    }

    .tabla tr:hover {
        background: #fafafa;
    }

    .estado {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: bold;
        color: white;
    }

    .proceso {
        background: #2567e0;
        color: #fff;
    }

    .sancionado {
        background: #dd3f3a;
        color: #fff;
    }

    .archivado {
        background: #6c757d;
        color: #fff;
    }

    .pendiente {
        background: #e7d215;
        color: #000;
    }

    .btn-ver {
        background: #0d6efd;
        color: white;
        border: none;
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 11px;
        text-decoration: none;
        display: inline-block;
    }

    .btn-ver:hover {
        background: #0b5ed7;
        color: white;
    }

    .btn-eliminar {
        background: #dc3545;
        color: white;
        border: none;
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 11px;
        cursor: pointer;
    }

    .btn-eliminar:hover {
        background: #bb2d3b;
    }

    .acciones {
        display: flex;
        gap: 5px;
    }

    .mensaje-vacio {
        text-align: center;
        padding: 30px;
        color: #777;
        font-size: 13px;
    }

</style>

<div class="listado-container">

    <div class="listado-card">

        <div class="listado-header">

            <h2>
                <i class="fas fa-clipboard-list"></i>
                Listado de Procesos Disciplinarios
            </h2>

        </div>

        <div class="listado-body">

            <form action="{{ route('abogado.consultarproceso') }}" method="GET">

                <div class="filtros">

                    <div class="campo">
                        <label>Nombre del Responsable</label>

                        <input type="text"
                               name="nombre"
                               placeholder="Buscar responsable"
                               value="{{ request('nombre') }}">
                    </div>

                    <div class="campo">
                        <label>Fecha Solicitud</label>

                        <input type="date"
                               name="fecha"
                               value="{{ request('fecha') }}">
                    </div>

                    <button type="submit" class="btn-filtrar">
                        <i class="fas fa-filter"></i> Filtrar
                    </button>

                </div>

            </form>

            <table class="tabla">

                <thead>

                    <tr>
                      
                        <th>Nombre del Responsable</th>
                        <th>Fecha Solicitud</th>

                        @if(auth()->user()->role == 'coordinadora')
                            <th>Registrado Por</th>
                        @endif

                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($procesos as $proceso)

                    <tr>

                       

                        <td>
                            <i class="fas fa-user" style="color:#198754;"></i>
                            {{ $proceso->nombre }}
                        </td>

                        <td>
                            <i class="fas fa-calendar-alt" style="color:#0d6efd;"></i>
                            {{ $proceso->fecha_falta }}
                        </td>

                        @if(auth()->user()->role == 'coordinadora')

                        <td>

                            <i class="fas fa-user-tie" style="color:#198754;"></i>

                            {{ $proceso->user->name ?? 'Sin asignar' }}

                        </td>

                        @endif

                        <td>

                            @if($proceso->estado == 'Pendiente')

                                <span class="estado pendiente">
                                    Pendiente
                                </span>

                            @elseif($proceso->estado == 'En Proceso')

                                <span class="estado proceso">
                                    En Proceso
                                </span>

                            @elseif($proceso->estado == 'Archivado')

                                <span class="estado archivado">
                                    Archivado
                                </span>

                            @elseif($proceso->estado == 'Sancionado')

                                <span class="estado sancionado">
                                    Sancionado
                                </span>

                            @endif

                        </td>

                        <td>

                            <div class="acciones">

                                <a href="{{ route('abogado.detalleproceso', $proceso->id) }}"
                                   class="btn-ver">

                                    <i class="fas fa-eye"></i> Ver

                                </a>

                               <form action="{{ route('abogado.eliminarproceso', $proceso->id) }}"
      method="POST"
      onsubmit="return confirm('¿Deseas eliminar este proceso disciplinario?')">

    @csrf
    @method('DELETE')

    <button type="submit" class="btn-eliminar">

        <i class="fas fa-trash"></i> Eliminar

    </button>

</form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="{{ auth()->user()->role == 'coordinadora' ? 6 : 5 }}"
                            class="mensaje-vacio">

                            No hay procesos disciplinarios registrados

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection