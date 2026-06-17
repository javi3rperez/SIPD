@extends('layouts.master')
@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 40px 20px;">
    
    <!-- Encabezado -->
    <div style="text-align: center; margin-bottom: 48px;">
        <h1 style="font-size: 32px; font-weight: 600; color: #1e293b; margin: 0 0 12px 0; font-family: 'Segoe UI', system-ui, sans-serif;">
            Bienvenido al Sistema de Procesos Disciplinarios
        </h1>
        <p style="font-size: 16px; color: #64748b; margin: 0; letter-spacing: 2px; font-weight: 500;">
            S.I.P.D
        </p>
        <div style="width: 60px; height: 3px; background: #3b82f6; margin: 20px auto 0;"></div>
    </div>
    
    <!-- Cajas (tarjetas) -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px;">
        
        <!-- Caja 1 -->
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; box-shadow: 0 1px 2px rgba(0,0,0,0.03);">
            <div style="font-size: 36px; margin-bottom: 16px;">⚖️</div>
            <h3 style="font-size: 18px; font-weight: 600; color: #1e293b; margin: 0 0 8px 0;">Faltas y sanciones</h3>
            <p style="font-size: 14px; color: #475569; margin: 0; line-height: 1.5;">Clasificación de faltas leves, graves y gravísimas con sus respectivas sanciones.</p>
        </div>
        
        <!-- Caja 2 -->
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; box-shadow: 0 1px 2px rgba(0,0,0,0.03);">
            <div style="font-size: 36px; margin-bottom: 16px;">📋</div>
            <h3 style="font-size: 18px; font-weight: 600; color: #1e293b; margin: 0 0 8px 0;">Registro de procesos</h3>
            <p style="font-size: 14px; color: #475569; margin: 0; line-height: 1.5;">Historial completo y seguimiento de cada caso disciplinario.</p>
        </div>
        
        <!-- Caja 3 -->
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; box-shadow: 0 1px 2px rgba(0,0,0,0.03);">
            <div style="font-size: 36px; margin-bottom: 16px;">⏱️</div>
            <h3 style="font-size: 18px; font-weight: 600; color: #1e293b; margin: 0 0 8px 0;">Plazos y términos</h3>
            <p style="font-size: 14px; color: #475569; margin: 0; line-height: 1.5;">Control de tiempos procesales y fechas clave en cada etapa.</p>
        </div>
        
        <!-- Caja 4 -->
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; box-shadow: 0 1px 2px rgba(0,0,0,0.03);">
            <div style="font-size: 36px; margin-bottom: 16px;">👥</div>
            <h3 style="font-size: 18px; font-weight: 600; color: #1e293b; margin: 0 0 8px 0;">Partes involucradas</h3>
            <p style="font-size: 14px; color: #475569; margin: 0; line-height: 1.5;">Gestión de denunciantes, denunciados y testigos del proceso.</p>
        </div>
        
        <!-- Caja 5 -->
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; box-shadow: 0 1px 2px rgba(0,0,0,0.03);">
            <div style="font-size: 36px; margin-bottom: 16px;">📄</div>
            <h3 style="font-size: 18px; font-weight: 600; color: #1e293b; margin: 0 0 8px 0;">Resoluciones</h3>
            <p style="font-size: 14px; color: #475569; margin: 0; line-height: 1.5;">Generación de actos administrativos y fallos disciplinarios.</p>
        </div>
        
        <!-- Caja 6 -->
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; box-shadow: 0 1px 2px rgba(0,0,0,0.03);">
            <div style="font-size: 36px; margin-bottom: 16px;">📊</div>
            <h3 style="font-size: 18px; font-weight: 600; color: #1e293b; margin: 0 0 8px 0;">Reportes y estadísticas</h3>
            <p style="font-size: 14px; color: #475569; margin: 0; line-height: 1.5;">Indicadores y métricas sobre procesos disciplinarios.</p>
        </div>
        
    </div>
</div>
@endsection