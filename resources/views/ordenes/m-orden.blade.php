@inject('envios', 'App\Services\Envios')
@inject('entregas', 'App\Services\Entrega')

<div class="modal mt-5 fade" id="m-orden">
    <div id="m-ordenDialog" class="modal-dialog modal-lg-dialog m-orden">
        <div class="modal-content">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 m-0 p-0">
                <form id="formOrden" class="formOrden" method="POST" action="{{ route("ordenes.store") }}">
                    @csrf
                    @include('partials._session-msg')
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-12 col-xl-12 m-auto p-0">
                        <div class="card contenedor-morden">
                            <div class="card-header bg-primary text-white d-flex justify-content-between">
                                <h4 id="title-orden">{{ __('Nueva Orden')}}</h4>
                            </div>
                            <div class="card-body">

                                <div class="form-row pt-2">

                                    <div class="form-group col-sm-12">
                                        <label for="lblembarque-ordenmodal" class="lbl"><strong>{{ __("No. Embarque") }}</strong></label>
                                        <input type="text" id="txtembarque_ordenmodal" name="txtembarque_ordenmodal" class="form-control form-control-sm txtembarque_ordenmodal" disabled>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="lbltipoenvio">{{ __("Tipo de Embarque") }}</label>
                                                <select id="txttipoenvio"
                                                        name="txttipoenvio"
                                                        class="selectpicker show-menu-arrow form-control form-control-sm txttipoenvio requerido"
                                                        data-live-search="true" required>
                                                    @foreach ($envios->getEnvios() as $idtenvio=>$categoria)
                                                        <option data-tokens="{{ $categoria }}" value="{{ $categoria }}"> {{ $categoria }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label for="lblfllegada">{{ __("Fecha de entrada al pais") }}</label>
                                                <input type="date" id="txtfentrada" name="txtfentrada" class="form-control form-control-sm requerido" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="div_reminput" class="form-group col-sm-12">
                                        <div class="contRemitters mb-4 p-0">
                                            <table id="tableRemitters" class="col-12 col-md-12 col-sm-12 col-lg-12 table table-hover table-sm table-responsive-sm tableRemitters">
                                                <thead class="thead-default">
                                                    <tr>
                                                        <th>
                                                            <button type="button" class="btn btn-sm btn-outline-primary ml-2 btnAddRemitter"><i class="fa-solid fa-person-dolly mr-1"></i>Remitente</button>
                                                            <button type="button" class="btn btn-sm btn-outline-primary ml-2 btnAddReceiver"><i class="fas fa-person-dolly-empty mr-1"></i><span id="btn_dest">Destinatario</span> <span id="btn_DesRem" hidden>Remitente / Destinatario</span></button>
                                                        </th>
                                                        <th colspan="4">
                                                            <form class="form-inline px-0 row">
                                                                <input id="findTablaRemitter" class="form-control mr-sm-2" type="text" placeholder="Search" style="width: 300px">
                                                            </form>
                                                        </th>
                                                    </tr>
                                                    <tr class="justify-content-between">
                                                        <th scope="col" hidden>{{ __("Id") }}</th>
                                                        <th scope="col">{{ __("No. ID") }}</th>
                                                        <th scope="col">{{ __("Nombre") }}</th>
                                                        <th scope="col">{{ __("1er Apellido") }}</th>
                                                        <th scope="col">{{ __("2do Apellido") }}</th>
                                                        <th scope="col">{{ __("Cliente") }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tableRemittersBody">

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="lblremitente-nombre" class="lbl"><strong>{{ __("Remitente") }}</strong></label>
                                                <input type="text" id="txtrem_nomb" name="txtrem_nomb" class="form-control form-control-sm txtrem_nomb requerido" required disabled>
                                            </div>
                                            <div class="col-4" hidden>
                                                <input type="text" id="txtremittersid" name="txtremittersid" class="form-control form-control-sm txtremittersid" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="div_destinput" class="form-group col-sm-8">
                                        <label for="lbldestinatario_input" class="lbl"><strong>{{ __("Destinatario") }}</strong></label>
                                        <input type="text" id="txtdestinatario_input" name="txtdestinatario_input" class="form-control form-control-sm" disabled required>
                                        <input type="text" id="txtiddestinatario_input" name="txtiddestinatario_input" class="form-control form-control-sm" required hidden>
                                    </div>
                                    <div class="col-4">
                                        <label for="lblentrega"><strong>{{ __("Entrega") }}</strong></label>
                                        <select id="txtentrega"
                                                name="txtentrega"
                                                class="selectpicker show-menu-arrow form-control form-control-sm txtentrega requerido"
                                                data-live-search="true" required>
                                            @foreach ($entregas->getEntregas() as $identrega=>$detalle)
                                                <option data-tokens="{{ $detalle }}" value="{{ $identrega }}"> {{ $detalle }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-secondary">
                                <button id="btn-guardorden" type="button" class="btn-guardorden btn btn-sm btn-primary btnAceptar mb-2">{{ __("Guardar") }}</button>
                                <button id="btn-actorden" type="button" class="btn-actorden btn btn-sm btn-primary btnAceptar mb-2" hidden>{{ __("Actualizar") }}</button>
                                <button id="btn-closeorden" type="button" class="btn btn-sm btn-dark btnCerrar mb-2 btn-closeorden">{{ __("Cerrar") }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
