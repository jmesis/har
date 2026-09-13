@extends('layouts.app')

@section('content')
<div class="tablacontrol-viaje col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mx-auto px-2 rounded">
    @include('modals.mViaje')
    {{-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mx-auto px-2 rounded"> --}}
  
        <div class="card card-viaje">
        <div class="card-header bg-primary text-white d-flex justify-content-between">
            <h4 class="ml-2">{{ __('Listado de Viajes')}}</h4>
        </div>
        <div class="card-body">
            <div class="col-12 contViajes">
                <div id="leyendaViajes" class="col-12 bg-red text-white-50" hidden>
                    <p>{{ __("No existen viajes activos o vigentes")}}</p>
                </div>
                <table id="tableViajeBuque" class="col-12 col-lg-12 table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th colspan="3">
                            <button id="btnAddViaje" class="btn btn-sm btn-primary btnAddViaje mb-1 btnAceptar">{{ __("Agregar Viaje") }}</button>
                            </th>
                        </tr>
                        <tr class="justify-content-between">
                            <th scope="col" hidden>{{ __("idv") }}</th>
                            <th scope="col" hidden>{{ __("idb") }}</th>
                            <th scope="col">{{ __("Nombre Buque") }}</th>
                            <th scope="col">{{ __("Viaje") }}</th>
                            <th scope="col" colspan="2" style="text-align: center">{{__("Opcion")}}</th>
                        </tr>
                    </thead>
                    <tbody id="tableViajeBody">
                        @foreach($vbuqueviaje as $buqueviajeitem)
                            <tr data-idviaje="{{ $buqueviajeitem->idviaje }}" data-idbuque="{{ $buqueviajeitem->idbuque }}" data-buque="{{ $buqueviajeitem->buque }}" data-viaje="{{ $buqueviajeitem->viaje }}">
                                <td class="rowtdbuque" hidden>{{ $buqueviajeitem->idviaje }}</td>
                                <td class="rowtdbuque" hidden>{{ $buqueviajeitem->idbuque }}</td>
                                <td class="rowtdbuque">{{ $buqueviajeitem->buque }}</td>
                                <td class="rowtdbuque">{{ $buqueviajeitem->viaje }}</td>
                                <td style="text-align: center; width: 100px"><button class="btn btn-sm btnEditarViaje btnEditar"><i class="far fa-edit mr-1"></i>Editar</button></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="row d-flex justify-content-between align-items-center mr-2">
                <button class="btn btn-sm btn-dark ml-auto btncerrar-viaje btnCerrar">{{ __("Cerrar")}}</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/Viaje/CreaViaje.js') }}"></script>
    <script src="{{ asset('js/Viaje/ActualizaViaje.js') }}"></script>
@endsection
