<div class="embarque-principal col-sm-12 col-md-12 col-lg-12 col-xl-12">
    @include('embarques.m-embarque')
    @include('embarques.findPort')

    <div class="card card-embarques">
        <div class="card-header bg-primary text-white d-flex justify-content-between">
            <h4 class="ml-2">{{ __('Listado de Embarques')}}</h4>
        </div>
        <div class="card-body">
            <div class="col-12 contEmbarques">
                <div id="leyendaEmbarques" class="col-12 bg-dark text-white-50" hidden>
                    <p>{{ __("No existen embarques activos o vigentes")}}</p>
                </div>
                <table class="table table-hover table-borderless table-sm table-responsive-sm tablelistadoembarque">
                    <thead>
                        <tr>
                            <th colspan="14">
                                <button type="button" class="btn-nuevoembarq btn btn-sm btn-primary rounded ml-auto btnAceptar">{{ __("Crear Embarque") }}</button>
                            </th>
                        </tr>
                        <tr class="justify-content-between">
                            <th scope="col"  class="bg-light">{{ __("No.Embarque") }}</th>
                            <th scope="col"  class="bg-light">{{ __("Origen") }}</th>
                            <th scope="col"  class="bg-light">{{ __("Tipo Embarque") }}</th>
                            <th scope="col"  class="bg-light">{{ __("Buque / Aeronave") }}</th>
                            <th scope="col"  class="bg-light">{{ __("Viaje / Vuelo") }}</th>
                            <th scope="col"  class="bg-light">{{ __("Pol / Origen") }}</th>
                            <th scope="col"  class="bg-light">{{ __("Pod / Destino") }}</th>
                            <th scope="col"  class="bg-light">{{ __("Embarcador") }}</th>
                            <th scope="col"  class="bg-light">{{ __("Cosnigando") }}</th>
                            <th scope="col"  class="bg-light">{{ __("ETS") }}</th>
                            <th scope="col"  class="bg-light">{{ __("Naviera / Aerolinea") }}</th>
                            <th scope="col"  class="bg-light">{{ __("No. Doc") }}</th>
                            <th scope="col"  class="bg-light">{{ __("Estado") }}</th>
                            <th scope="col"  class="bg-light" style="text-align: center">{{ __("Accion") }}</th>
                            <th scope="col"  class="bg-light" hidden>{{ __("Cod_Origen") }}</th>
                            <th scope="col"  class="bg-light" hidden>{{ __("Cod_Emb") }}</th>
                            <th scope="col"  class="bg-light" hidden>{{ __("TipoCont") }}</th>
                            <th scope="col"  class="bg-light" hidden>{{ __("Cont") }}</th>
                            <th scope="col"  class="bg-light" hidden>{{ __("idpol") }}</th>
                            <th scope="col"  class="bg-light" hidden>{{ __("idpod") }}</th>
                            <th scope="col"  class="bg-light" hidden>{{ __("idnaviera") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vembarques as $vembarqueitem)
                        <tr data-no_embarque="{{ $vembarqueitem->no_embarque }}" data-origen="{{ $vembarqueitem->origen }}" data-tipoembarque="{{ $vembarqueitem->tipoembarque }}" data-buque="{{ $vembarqueitem->buque }}" data-viaje="{{ $vembarqueitem->viaje }}" data-embarcador="{{ $vembarqueitem->embarcador }}" data-consignado="{{ $vembarqueitem->consignado }}" data-pol="{{ $vembarqueitem->pol }}" data-pod="{{ $vembarqueitem->pod }}" data-tipocont="{{ $vembarqueitem->tipocont }}" data-contenedor="{{ $vembarqueitem->contenedor }}" data-p_bruto="{{ $vembarqueitem->p_bruto }}" data-p_neto="{{ $vembarqueitem->p_neto }}" data-tara="{{ $vembarqueitem->tara }}" data-fecha_est="{{ $vembarqueitem->fecha_est }}" data-idpol="{{ $vembarqueitem->idpol }}" data-idpod="{{ $vembarqueitem->idpod }}" data-codigoorigen="{{ $vembarqueitem->codigoorigen }}" data-codigoembarque="{{ $vembarqueitem->codigoembarque }}" data-idnaviera="{{ $vembarqueitem->idnaviera }}" data-naviera="{{ $vembarqueitem->naviera }}" data-doc="{{ $vembarqueitem->doc }}">
                            <td class="rowtdembarque">{{ $vembarqueitem->no_embarque }}</td>
                            <td class="rowtdembarque">{{ $vembarqueitem->origen }}</td>
                            <td class="rowtdembarque">{{ $vembarqueitem->tipoembarque }}</td>
                            <td class="rowtdembarque">{{ $vembarqueitem->buque }}</td>
                            <td class="rowtdembarque">{{ $vembarqueitem->viaje }}</td>
                            <td class="rowtdembarque">{{ $vembarqueitem->pol}}</td>
                            <td class="rowtdembarque">{{ $vembarqueitem->pod }}</td>
                            <td class="rowtdembarque">{{ $vembarqueitem->embarcador}}</td>
                            <td class="rowtdembarque">{{ $vembarqueitem->consignado }}</td>
                            <td class="rowtdembarque">{{ Carbon\Carbon::parse($vembarqueitem->fecha_est)->format('Y-m-d') }}</td>
                            <td class="rowtdembarque">{{ $vembarqueitem->naviera }}</td>
                            <td class="rowtdembarque">{{ $vembarqueitem->doc }}</td>
                            <td class="rowtdembarque @if($vembarqueitem->estado =="EN PROCESO") trpdte @elseif($vembarqueitem->estado =="READY") trready @else trconfirm @endif">{{ $vembarqueitem->estado }}</td>
                            <td class="rowtdembarque" style="text-align: center">
                                {{--<button class="btn btn-sm btnEditar btnEditarBuque" @if($vembarqueitem->estado =="CONFIRMADO") disabled @endif><i class="far fa-edit"></i><span class="ml-1">{{ __('Editar')}}</span></button>--}} 
                                 <button class="btn btn-sm mr-auto btn-editarembarque btnEditar" @if($vembarqueitem->estado =="CONFIRMADO") disabled @endif><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger mr-auto btn-cancelarembarque btnEliminar" @if($vembarqueitem->estado =="CONFIRMADO") disabled @endif><i class="fas fa-trash-alt"></i></button>
                            </td>
                            <td class="rowtdembarque" hidden>{{ $vembarqueitem->codigoorigen }}</td>
                            <td class="rowtdembarque" hidden>{{ $vembarqueitem->codigoembarque }}</td>
                            <td class="rowtdembarque" hidden>{{ $vembarqueitem->tipocont }}</td>
                            <td class="rowtdembarque" hidden>{{ $vembarqueitem->contenedor }}</td>
                            <td class="rowtdembarque" hidden>{{ $vembarqueitem->idpol}}</td>
                            <td class="rowtdembarque" hidden>{{ $vembarqueitem->idpod }}</td>
                            <td class="rowtdembarque" hidden>{{ $vembarqueitem->idnaviera}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-light">
            <div class="row d-flex justify-content-between align-items-center mr-2">
                <button class="btn btn-sm btn-dark ml-auto btncerrar-embarque btnCerrar">{{ __("Cerrar")}}</button>
            </div>
        </div>
    </div>
</div>

