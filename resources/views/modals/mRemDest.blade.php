@inject('provmcpio', 'App\Services\ProvMcpio')

<div class="modal mt-5 fade" id="mRemDest">
    <div id="mRemDestDialog" class="modal-dialog modal-lg-dialog mRemDest">
        <div class="modal-content">
            {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet">
            <link href="{{ asset('css/styles.css') }}" rel="stylesheet"> --}}

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 m-0 p-0">
                <form id="formRemDest" class="formRemDest" method="POST" action="{{ route('tcremdest.store') }}">
                    @csrf
                    @include('partials._session-msg')
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-12 col-xl-12 m-auto p-0">
                        <div class="card">
                            <div class="card-header bg-primary text-white d-flex justify-content-between">
                                <h3 id="title-mremdest">{{ __('Nuevo Cliente')}}</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <label for="lblci"><strong>{{ __("CI") }}</strong></label>
                                        <input type="text" id="txtci" name="txtci" class="form-control form-control-sm txtci" autofocus>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="lblpasaporte"><strong>{{ __("Pasaporte") }}</strong></label>
                                        <input type="text" id="txtpasaporte" name="txtpasaporte" class="form-control form-control-sm inputremdest">
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <label for="lblnombre"><strong>{{ __("Nombre(s)") }}</strong></label>
                                        <input type="text" id="txtnombre" name="txtnombre" class="form-control form-control-sm inputremdest requerido" required>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="lblapellidop"><strong>{{ __("Apellido Paterno") }}</strong></label>
                                        <input type="text" id="txtapellidop" name="txtapellidop" class="form-control form-control-sm inputremdest requerido" required>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="lblapellidom"><strong>{{ __("Apellido Materno") }}</strong></label>
                                        <input type="text" id="txtapellidom" name="txtapellidom" class="form-control form-control-sm inputremdest requerido" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <label for="lbltelefono"><strong>{{ __("Telefono") }}</strong></label>
                                        <input type="text" id="txttelefono" name="txttelefono" class="form-control form-control-sm inputremdest requerido" required>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="lblnacionalidad"><strong>{{ __("Nacionalidad") }}</strong></label>
                                        <input type="text" id="txtnacionalidad" name="txtnacionalidad" class="form-control form-control-sm inputremdest requerido" required>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <label for="lblcalle"><strong>{{ __("Calle") }}</strong></label>
                                        <input type="text" id="txtcalle" name="txtcalle" class="form-control form-control-sm inputremdest requerido" required>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="lblnocalle"><strong>{{ __("No.") }}</strong></label>
                                        <input type="text" id="txtnocalle" name="txtnocalle" class="form-control form-control-sm inputremdest requerido" required>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="lblapto"><strong>{{ __("Apto") }}</strong></label>
                                        <input type="text" id="txtapto" name="txtapto" class="form-control form-control-sm inputremdest">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <label for="lblentrecalle"><strong>{{ __("Entre Calles") }}</strong></label>
                                        <input type="text" id="txtentrecalle" name="txtentrecalle" class="form-control form-control-sm inputremdest requerido" required>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="lblprov"><strong>{{ __("Provincia") }}</strong></label>
                                        <select id="txtprov"
                                                name="txtprov"
                                                class="selectpicker show-menu-arrow form-control form-control-sm inputremdest requerido"
                                                data-live-search="true"
                                                required>
                                            @foreach ($provmcpio->getProvMcpios() as $provincia=>$municipio)
                                                <option data-tokens="{{ $provincia }}" value="{{ $provincia }}"> {{ $provincia }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <label for="lblmcpio"><strong>{{ __("Municpio") }}</strong></label>
                                        <select id="txtmcpio" name="txtmcpio" class="selectpicker show-menu-arrow form-control form-control-sm inputremdest requerido" data-live-search="true" required>

                                        </select>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="lblcp"><strong>{{ __("Codigo Postal") }}</strong></label>
                                        <select id="txtcp" name="txtcp" class="selectpicker show-menu-arrow form-control form-control-sm inputremdest requerido" data-live-search="true" required>

                                        </select>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="lblemail"><strong>{{ __("Email") }}</strong></label>
                                        <input type="text" id="txtemail_remdest" name="txtemail_remdest" class="form-control form-control-sm inputremdest">
                                    </div>
                                </div>
                            </div>
                            <div class="car-footer ml-auto mr-4">
                                <button id="btnSaveRemDest" class="btn btn-sm btn-primary mb-2 btnAceptar">{{ __("Guardar") }}</button>
                                <button id="btnUpdateRemDest" class="btn btn-sm btn-outline-primary mb-2 btnEditar" hidden>{{ __("Actualizar") }}</button>
                                <button id="btnCloseRemDest" type="button" class="btn btn-sm btn-danger mb-2 btnCloseRemDest btnCerrar">{{ __("Cerrar") }}</button>
                            </div>
                        </div>
                    </div>
                </form>
                <a id="urlremdestupdate" href="{{ route('tcremdest.update','') }}" hidden></a>
            </div>

        </div>
    </div>
</div>
