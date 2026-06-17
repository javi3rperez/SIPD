<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProcesoDisciplinario;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProcesoDisciplinarioController extends Controller
{
    /**
     * Mostrar formulario
     */
    public function create()
    {
        return view('abogado.Registro');
    }

    /**
     * Listado de procesos disciplinarios
     */
    public function index(Request $request)
    {
        // CARGAR EL USUARIO QUE REGISTRÓ EL PROCESO
        $query = ProcesoDisciplinario::with('user');

        // FILTRO POR NOMBRE
        if ($request->filled('nombre')) {

            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        // FILTRO POR CÉDULA
        if ($request->filled('cedula')) {

            $query->where('cedula', 'like', '%' . $request->cedula . '%');
        }

        $procesos = $query->latest()->get();

        return view('abogado.ConsultarProceso', compact('procesos'));
    }

    /**
     * Guardar proceso disciplinario
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
        ]);

        $rutaDocumento = null;

        // GUARDAR DOCUMENTO
        if ($request->hasFile('documento_falta')) {

            $archivo = $request->file('documento_falta');

            $rutaDocumento = $archivo->store('documentos', 'public');
        }

        ProcesoDisciplinario::create([

            // DATOS DEL CONDUCTOR
            'nombre' => $request->nombre,
            'cedula' => $request->cedula,
            'placa' => $request->placa,
            'ruta' => $request->ruta,
            'modalidad' => $request->modalidad,
            'telefono' => $request->telefono,

            // INFORMACIÓN DISCIPLINARIA
            'tipo_falta' => $request->tipo_falta,
            'descripcion_falta' => $request->descripcion_falta,
            'fecha_falta' => $request->fecha_falta,

            // DOCUMENTO
            'documento_falta' => $rutaDocumento,

            // OBSERVACIONES
            'observacion' => $request->observacion,
            'descargos' => $request->descargos,
            'decision_final' => $request->decision_final,

            // ESTADO
            'estado' => 'Pendiente',

            // USUARIO QUE REGISTRÓ
            'user_id' => auth()->id()
        ]);

        return redirect()
            ->back()
            ->with('success', 'Proceso disciplinario registrado correctamente');
    }

    /**
     * Mostrar detalles de un proceso disciplinario
     */
    public function show($id)
    {
        // CARGAR EL USUARIO RELACIONADO
        $proceso = ProcesoDisciplinario::with('user')->findOrFail($id);

        return view('abogado.Detalleproceso', compact('proceso'));
    }

    /**
     * ACTUALIZAR PROCESO
     */
    public function update(Request $request, $id)
    {
        $proceso = ProcesoDisciplinario::findOrFail($id);

        $rutaDocumento = $proceso->documento_falta;

        // SI SUBE NUEVO DOCUMENTO
        if ($request->hasFile('documento_falta')) {

            $archivo = $request->file('documento_falta');

            $rutaDocumento = $archivo->store('documentos', 'public');
        }

        $proceso->update([

            'nombre' => $request->nombre,
            'cedula' => $request->cedula,
            'telefono' => $request->telefono,
            'placa' => $request->placa,
            'ruta' => $request->ruta,
            'modalidad' => $request->modalidad,

            'tipo_falta' => $request->tipo_falta,
            'fecha_falta' => $request->fecha_falta,
            'descripcion_falta' => $request->descripcion_falta,

            'documento_falta' => $rutaDocumento,

            'observacion' => $request->observacion,
            'descargos' => $request->descargos,
            'decision_final' => $request->decision_final,

            // NUEVO ESTADO
            'estado' => $request->estado
        ]);

        return redirect()
            ->back()
            ->with('success', 'Proceso actualizado correctamente');
    }

    /**
     * VISTA ABOGADOS
     */
    public function abogados()
    {
        $abogados = User::where('role', 'abogado')->get();

        return view('coordinadora.abogados', compact('abogados'));
    }

    /**
     * DATOS PARA ESTADÍSTICAS
     */
    public function estadisticasDatos(Request $request)
    {
        $query = ProcesoDisciplinario::query();

        // =========================
        // FILTRO POR FECHAS
        // =========================
        if ($request->fecha_desde && $request->fecha_hasta) {

            $query->whereBetween('fecha_falta', [
                $request->fecha_desde,
                $request->fecha_hasta
            ]);
        }

        // =========================
        // FILTRO POR MODALIDAD
        // =========================
        if ($request->filled('modalidad')) {

            $query->where('modalidad', $request->modalidad);
        }

        // =========================
        // CONTADORES
        // =========================

        $archivados = (clone $query)
            ->where('estado', 'Archivado')
            ->count();

        $enProceso = (clone $query)
            ->where('estado', 'En Proceso')
            ->count();

        $pendientes = (clone $query)
            ->where('estado', 'Pendiente')
            ->count();

        $sancionados = (clone $query)
            ->where('estado', 'Sancionado')
            ->count();

        return response()->json([

            'archivados' => $archivados,
            'proceso' => $enProceso,
            'pendientes' => $pendientes,
            'sancionados' => $sancionados

        ]);
    }

    /**
     * ELIMINAR PROCESO
     */
    public function destroy($id)
    {
        $proceso = ProcesoDisciplinario::findOrFail($id);

        $proceso->delete();

        return redirect()
            ->back()
            ->with('success', 'Proceso disciplinario eliminado correctamente');
    }

    /**
     * ELIMINAR ABOGADO
     */
    public function eliminarAbogado($id)
    {
        $abogado = User::findOrFail($id);

        $abogado->delete();

        return redirect()
            ->back()
            ->with('success', 'Abogado eliminado correctamente');
    }

    /**
     * GUARDAR ABOGADO
     */
    public function guardarAbogado(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'cargo' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

            // ROL DEL SISTEMA
            'role' => 'abogado',

            // CARGO DEL ABOGADO
            'cargo' => $request->cargo
        ]);

        return redirect()
            ->back()
            ->with('success', 'Abogado registrado correctamente');
    }

    /**
     * EDITAR ABOGADO
     */
    public function editarAbogado(Request $request, $id)
    {
        $abogado = User::findOrFail($id);

        $abogado->update([
            'name' => $request->name,
            'email' => $request->email,
            'cargo' => $request->cargo
        ]);

        return redirect()
            ->back()
            ->with('success', 'Abogado actualizado correctamente');
    }
}