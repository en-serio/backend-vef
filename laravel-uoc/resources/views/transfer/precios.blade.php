@extends('layouts.app') 

@section('title', 'Gestión de Precios') 

@section('content')
    <div class="container py-4">
        <h5>Gestión de precios</h5>
        <div class="row">
            <div class="col-6">
                <form id="profileForm" method="POST" action="{{ route('precios.actualizar') }}">
                    @csrf <!-- Token de protección CSRF -->

                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
@endpush

 

