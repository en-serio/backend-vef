@php
    $rol = 1; // session('rol') Obtener el rol del usuario desde la sesión
@endphp
@extends('layouts.app') <!-- Extiende del layout principal -->

@section('title', 'Dashboard') <!-- Define el título de la página -->

@section('content') <!-- Sección de contenido -->
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container-block">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" onclick="toggleSidebar()">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand ms-4" href="{{ route('dashboard') }}">
        <img src="{{ Vite::asset('resources/images/Bootstrap-logo.png') }}" class="rounded-circle" alt="Logo" style="width: 30px;">
            <span class="ms-2">Gestión de Transfers VEF</span>
        </a>
    </div>
</nav>

<main class="vh-100 mt-5">
    @include('layouts.sidebar') <!-- Incluye el sidebar -->
    <!-- Container principal para Sidebar y Main Content -->
    <div class="contenidoDinamico container-fluid h-100">
        <!-- Main Content -->
        <div id="main-content" class="main-content">
            <!-- Tarjetas -->
            <div class="row mb-3 pt-4 pt-md-0">
                @php
                    $rol = session('rol'); // Recuperar rol del usuario
                @endphp

                @switch($rol)
                    @case(1) <!--Admin -->
                        @include('partials.dashboardAdmin') 
                        @break

                    @case(2) <!-- Corporativo -->
                        @include('partials.dashboardCorporativo')
                        @break

                    @case(3) <!--Cliente-->
                        @include('partials.dashboardCliente')
                        @break

                @endswitch
            </div>

            <!-- Contenido dinámico -->
            <div class="row mb-5 pb-4" id="dynamicContent">
                <!-- Aquí se cargará el contenido dinámico (calendario, vistas, etc.) -->
            </div>
        </div>
    </div>

    <!-- Incluye modales genéricos -->
    @include('misc.modalEdit')
    @include('transfer.stepper')
</main>
@endsection

