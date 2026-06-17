@extends('layouts.master')

@section('content')

@if(session('success'))

<script>
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: '{{ session('success') }}',
        confirmButtonColor: '#2563eb'
    });
</script>

@endif

<div style="max-width: 1200px; margin: 0 auto; padding: 40px 20px;">

    <!-- ENCABEZADO -->
    <div style="text-align: center; margin-bottom: 48px;">

        <h1 style="
            font-size: 32px;
            font-weight: 600;
            color: #1e293b;
            margin: 0 0 12px 0;
            font-family: 'Segoe UI', system-ui, sans-serif;
        ">

            <i class="fas fa-users"
               style="color:#2563eb; margin-right:10px;">
            </i>

            Lista de Abogados Coordinadora de Procesos Disciplinarios

        </h1>

    </div>

    <!-- BOTÓN -->
    <div style="margin-bottom: 24px; text-align: right;">

        <button id="btnAgregar"
            style="
                background: #3b82f6;
                color: white;
                border: none;
                padding: 10px 24px;
                border-radius: 8px;
                font-size: 14px;
                font-weight: 500;
                cursor: pointer;
            ">

            <i class="fas fa-user-plus"></i>
            Agregar Abogado

        </button>

    </div>

    <!-- FORMULARIO -->
    <div id="formularioContainer"
         style="
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 24px;
            display: none;
         ">

        <h3 style="
            margin: 0 0 16px 0;
            font-size: 18px;
            color: #1e293b;
        ">

            <i class="fas fa-user-plus"
               style="margin-right:8px; color:#2563eb;">
            </i>

            Agregar Abogado

        </h3>

        <form action="{{ route('coordinadora.abogados.guardar') }}"
              method="POST">

            @csrf

            <div style="
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 12px;
                align-items: end;
            ">

                <!-- NOMBRE -->
                <div>

                    <label style="
                        display: block;
                        font-size: 14px;
                        color: #475569;
                        margin-bottom: 4px;
                    ">
                        Nombre
                    </label>

                    <input type="text"
                           name="name"
                           required
                           placeholder="Nombre del abogado"
                           style="
                                width: 100%;
                                padding: 10px;
                                border: 1px solid #cbd5e1;
                                border-radius: 6px;
                                font-size: 14px;
                           ">

                </div>

                <!-- EMAIL -->
                <div>

                    <label style="
                        display: block;
                        font-size: 14px;
                        color: #475569;
                        margin-bottom: 4px;
                    ">
                        Correo
                    </label>

                    <input type="email"
                           name="email"
                           required
                           placeholder="Correo electrónico"
                           style="
                                width: 100%;
                                padding: 10px;
                                border: 1px solid #cbd5e1;
                                border-radius: 6px;
                                font-size: 14px;
                           ">

                </div>

                <!-- PASSWORD -->
                <div>

                    <label style="
                        display: block;
                        font-size: 14px;
                        color: #475569;
                        margin-bottom: 4px;
                    ">
                        Contraseña
                    </label>

                    <input type="password"
                           name="password"
                           required
                           placeholder="Contraseña"
                           style="
                                width: 100%;
                                padding: 10px;
                                border: 1px solid #cbd5e1;
                                border-radius: 6px;
                                font-size: 14px;
                           ">

                </div>

                <!-- CARGO -->
                <div>

                    <label style="
                        display: block;
                        font-size: 14px;
                        color: #475569;
                        margin-bottom: 4px;
                    ">
                        Cargo
                    </label>

                    <input type="text"
                           name="cargo"
                           required
                           placeholder="Cargo del abogado"
                           style="
                                width: 100%;
                                padding: 10px;
                                border: 1px solid #cbd5e1;
                                border-radius: 6px;
                                font-size: 14px;
                           ">

                </div>

                <!-- BOTÓN -->
                <div>

                    <button type="submit"
                        style="
                            background:#10b981;
                            color:white;
                            border:none;
                            padding:10px 20px;
                            border-radius:6px;
                            cursor:pointer;
                            font-weight:600;
                        ">

                        <i class="fas fa-save"></i>
                        Guardar

                    </button>

                </div>

            </div>

        </form>

    </div>

    <!-- TABLA -->
    <div style="
        background:#ffffff;
        border:1px solid #e2e8f0;
        border-radius:12px;
        overflow:hidden;
        box-shadow:0 1px 2px rgba(0,0,0,0.03);
    ">

        <table style="
            width:100%;
            border-collapse:collapse;
        ">

            <thead style="background:#f1f5f9;">

                <tr>

                    <th style="text-align:left; padding:16px;">
                        Nombre
                    </th>

                    <th style="text-align:left; padding:16px;">
                        Correo
                    </th>

                    <th style="text-align:left; padding:16px;">
                        Cargo
                    </th>

                    <th style="text-align:center; padding:16px;">
                        Acciones
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($abogados as $abogado)

                <tr style="border-bottom:1px solid #f1f5f9;">

                    <!-- NOMBRE -->
                    <td style="padding:16px;">

                        <i class="fas fa-user-tie"
                           style="color:#2563eb; margin-right:6px;">
                        </i>

                        {{ $abogado->name }}

                    </td>

                    <!-- EMAIL -->
                    <td style="padding:16px;">

                        <i class="fas fa-envelope"
                           style="color:#64748b; margin-right:6px;">
                        </i>

                        {{ $abogado->email }}

                    </td>

                    <!-- CARGO -->
                    <td style="padding:16px;">

                        <i class="fas fa-briefcase"
                           style="color:#0f766e; margin-right:6px;">
                        </i>

                        {{ $abogado->cargo }}

                    </td>

                    <!-- ACCIONES -->
                    <td style="
                        padding:16px;
                        text-align:center;
                    ">

                        <!-- EDITAR -->
                        <button
                            onclick="abrirModalEditar(
                                '{{ $abogado->id }}',
                                '{{ $abogado->name }}',
                                '{{ $abogado->email }}',
                                '{{ $abogado->cargo }}'
                            )"
                            style="
                                background:#f59e0b;
                                color:white;
                                border:none;
                                padding:7px 14px;
                                border-radius:6px;
                                cursor:pointer;
                                font-size:12px;
                                font-weight:600;
                                margin-right:6px;
                            ">

                            <i class="fas fa-edit"></i>
                            Editar

                        </button>

                        <!-- ELIMINAR -->
                        <form action="{{ route('coordinadora.abogados.eliminar', $abogado->id) }}"
                              method="POST"
                              style="display:inline-block;"
                              onsubmit="return confirm('¿Deseas eliminar este abogado?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                style="
                                    background:#ef4444;
                                    color:white;
                                    border:none;
                                    padding:7px 14px;
                                    border-radius:6px;
                                    cursor:pointer;
                                    font-size:12px;
                                    font-weight:600;
                                ">

                                <i class="fas fa-trash-alt"></i>
                                Eliminar

                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="4"
                        style="
                            text-align:center;
                            padding:40px;
                            color:#94a3b8;
                        ">

                        No hay abogados registrados

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<!-- MODAL EDITAR -->
<div id="modalEditar"
     style="
        display:none;
        position:fixed;
        top:0;
        left:0;
        width:100%;
        height:100%;
        background:rgba(0,0,0,0.5);
        justify-content:center;
        align-items:center;
        z-index:999;
     ">

    <div style="
        background:white;
        padding:24px;
        border-radius:12px;
        width:400px;
    ">

        <h3 style="margin-bottom:20px;">
            Editar Abogado
        </h3>

        <form id="formEditar"
              method="POST">

            @csrf
            @method('PUT')

            <!-- NOMBRE -->
            <div style="margin-bottom:15px;">

                <label>Nombre</label>

                <input type="text"
                       name="name"
                       id="editName"
                       required
                       style="
                            width:100%;
                            padding:10px;
                            border:1px solid #cbd5e1;
                            border-radius:6px;
                       ">

            </div>

            <!-- EMAIL -->
            <div style="margin-bottom:15px;">

                <label>Correo</label>

                <input type="email"
                       name="email"
                       id="editEmail"
                       required
                       style="
                            width:100%;
                            padding:10px;
                            border:1px solid #cbd5e1;
                            border-radius:6px;
                       ">

            </div>

            <!-- CARGO -->
            <div style="margin-bottom:15px;">

                <label>Cargo</label>

                <input type="text"
                       name="cargo"
                       id="editCargo"
                       required
                       style="
                            width:100%;
                            padding:10px;
                            border:1px solid #cbd5e1;
                            border-radius:6px;
                       ">

            </div>

            <!-- BOTONES -->
            <div style="
                display:flex;
                justify-content:flex-end;
                gap:10px;
            ">

                <button type="button"
                        onclick="cerrarModal()"
                        style="
                            background:#94a3b8;
                            color:white;
                            border:none;
                            padding:10px 18px;
                            border-radius:6px;
                        ">
                    Cancelar
                </button>

                <button type="submit"
                        style="
                            background:#10b981;
                            color:white;
                            border:none;
                            padding:10px 18px;
                            border-radius:6px;
                        ">
                    Guardar
                </button>

            </div>

        </form>

    </div>

</div>

<script>

    const btnAgregar =
        document.getElementById("btnAgregar");

    const formularioContainer =
        document.getElementById("formularioContainer");

    btnAgregar.addEventListener("click", () => {

        if(formularioContainer.style.display === "none") {

            formularioContainer.style.display = "block";

        } else {

            formularioContainer.style.display = "none";

        }

    });

    function abrirModalEditar(id, nombre, email, cargo)
    {
        document.getElementById('modalEditar').style.display = 'flex';

        document.getElementById('editName').value = nombre;
        document.getElementById('editEmail').value = email;
        document.getElementById('editCargo').value = cargo;

        document.getElementById('formEditar').action =
            '/coordinadora/abogados/editar/' + id;
    }

    function cerrarModal()
    {
        document.getElementById('modalEditar').style.display = 'none';
    }

</script>

@endsection