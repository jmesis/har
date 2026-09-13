@inject('origenes', 'App\Services\Origenes')
@inject('embarques', 'App\Services\TipoEmbarques')
@inject('clientes', 'App\Services\Clientes')
@inject('paises', 'App\Services\Paises')
@inject('typeconts', 'App\Services\TypeCont')
@inject('buques', 'App\Services\SVBuqueViaje')
@inject('navieras', 'App\Services\Navieras')

<div class="modal mt-5 fade" id="m-embarque">
    <div id="m-mbarqueDialog" class="modal-dialog modal-lg-dialog m-embarque">
        <div class="modal-content">
          

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 m-0 p-0">
                @include('partials._session-msg')
                <form id="formEmbarque" class="formEmbarque" method="POST" action="{{ route('embarques.store') }}">
                    @csrf
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-12 col-xl-12 m-auto p-0">
                        <div class="card contenedor-membarque">
                            <div class="card-header d-flex justify-content-between">
                                <label class="titulo" id="title-membarque">{{ __('Nuevo Embarque')}}</label>
                                <div class="form-row pt-0">
                                    <div class="form-inline col-sm-6">
                                        <input id="txtembarque" class="form-control txtembarque bg-dark text-warning text-right" style="font-size: 14px" type="text" name="txtembarque" hidden disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="fielddg" class="form-row pt-2">
                                    <div class="form-group col-sm-4">
                                        <label for="lblorigen">{{ __("Oficina") }}</label>
                                        <select id="txtorigen"
                                                name="txtorigen"
                                                class="selectpicker show-menu-arrow form-control form-control-sm txtorigen requerido"
                                                data-live-search="true"
                                                required>
                                            @foreach ($origenes->getOrigenes() as $codigo=>$origen)
                                                <option data-tokens="{{ $origen }}" value="{{ $origen }}"> {{ $origen }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-sm-4">
                                        {{-- <label for="lblembarcador">{{ __("Embarcador") }}</label>
                                        <select id="txtembarcador"
                                                name="txtembarcador"
                                                class="selectpicker show-menu-arrow form-control form-control-sm txtembarcador requerido"
                                                data-live-search="true"
                                                required>
                                            @foreach ($clientes->getClientes() as $nombre)
                                                <option data-tokens="{{ $nombre }}" value="{{ $nombre }}"> {{ $nombre }}</option>
                                            @endforeach
                                        </select> --}}

                                        <label for="lblembarcador">{{ __("Embarcador") }}</label>
                                        <input id="txtembarcador" class="form-control form-control-sm txtembarcador" type="text" name="txtembarcador" value="SOCIEDAD COMERCIAL H.A.R. LIMITADA" disabled>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="lblconsignado">{{ __("Consignado") }}</label>
                                        <select id="txtconsignado"
                                                name="txtconsignado"
                                                class="selectpicker show-menu-arrow form-control form-control-sm txtconsignado requerido"
                                                data-live-search="true"
                                                required>
                                            @foreach ($clientes->getClientes() as $nombre)
                                                <option data-tokens="{{ $nombre }}" value="{{ $nombre }}"> {{ $nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-sm-4">
                                        <label for="lbltipoemb">{{ __("Tipo de Embarque") }}</label>
                                        <select id="txttipoemb"
                                                name="txttipoemb"
                                                class="selectpicker show-menu-arrow form-control form-control-sm txttipoemb requerido"
                                                data-live-search="true"
                                                required>
                                            @foreach ($embarques->getTipoEmbarques() as $codigo=>$embarque)
                                                <option data-tokens="{{ $codigo }}" value="{{ $codigo }}"> {{ $embarque }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="lblbuque">{{ __("Buque / Aeronave") }}</label>
                                        <select id="txtbuque" name="txtbuque" class="selectpicker show-menu-arrow form-control form-control-sm txtbuque" data-live-search="true" disabled>
                                            @foreach ($buques->getBuques() as $idbuque=>$buque)
                                                <option data-tokens="{{ $idbuque }}" value="{{ $idbuque }}"> {{ $buque }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="lblviaje">{{ __("Viaje / No. Vuelo") }}</label>
                                        <select id="txtviaje" name="txtviaje" class="selectpicker show-menu-arrow form-control form-control-sm txtviaje" data-live-search="true" disabled>

                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="lblfechaest">{{ __("Fecha Est.") }}</label>
                                        <input id="txtfechaest" class="form-control form-control-sm txtfechaest" type="date" name="txtfechaest" disabled>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="lblpol">{{ __("POL / Aeropuerto Origen") }}</label>
                                        <input id="txtpol" class="form-control form-control-sm txtpol" type="text" name="txtpol" disabled>
                                        <input id="idtxtpol" class="form-control form-control-sm idtxtpol" type="text" name="idtxtpol" hidden disabled>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="lblpod">{{ __("POD / Aeropuerto Destino") }}</label>
                                        <input id="txtpod" class="form-control form-control-sm txtpod" type="text" name="txtpod" disabled>
                                        <input id="idtxtpod" class="form-control form-control-sm idtxtpod" type="text" name="idtxtpod" hidden disabled>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="lbltipocont">{{ __("Tipo Cont") }}</label>
                                        <select id="txttipocont"
                                                name="txttipocont"
                                                class="selectpicker show-menu-arrow form-control form-control-sm txttipocont"
                                                data-live-search="true" disabled>
                                            @foreach ($typeconts->getTypeCont() as $typecont=>$description)
                                                <option data-tokens="{{ $typecont }}" value="{{ $typecont }}"> {{ $typecont.' - '.$description }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="lblcont">{{ __("No. Cont") }}</label>
                                        <input id="txtcont" class="form-control form-control-sm txtcont" type="text" name="txtcont" disabled>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label>{{ __("Doc. Embarque") }}</label>
                                        <input id="txtdocembarque" class="form-control form-control-sm txtdocembarque" type="text" name="txtdocembarque" disabled>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="lblmfto">{{ __("No. MFTO") }}</label>
                                        <input id="txtmfto" class="form-control form-control-sm txtmfto" type="text" name="txtmfto" disabled>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="lblmfto">{{ __("Naviera / Aerolinea") }}</label>
                                        <select
                                            id="txtnaviera"
                                            class="form-control form-control-sm txtnaviera"
                                            name="txtnaviera"
                                            class="selectpicker show-menu-arrow form-control form-control-sm txtnaviera"
                                            data-live-search="true">
                                            @foreach ($navieras->getNavieras() as $naviera=>$description)
                                                <option data-tokens="{{ $naviera }}" value="{{ $naviera }}"> {{$description}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-4">
                                <button type="button" id="btn-guardaembarque" class="btn btn-sm btn-primary mb-2 btn-guardaembarque btnAceptar">{{ __("Guardar") }}</button>
                                <button type="button" id="btn-actembarque" class="btn btn-sm btn-secondary mb-2 btn-actembarque btnEditar" hidden>{{ __("Actualizar") }}</button>
                                <button type="button" id="btn-closeembarque" class="btn btn-sm btn-danger mb-2 btn-closeembarque btnCerrar">{{ __("Cerrar") }}</button>
                            </div>
                        </div>
                    </div>
                </form>
                <a id="urlembarqueupdate" href="{{ route('embarques.update','') }}" hidden></a>
            </div>

        </div>
    </div>
</div>
