<div class="modal mt-5 fade" id="mTcremitter">
    <div id="mTcremitterDialog" class="modal-dialog modal-lg-dialog mTcremitter">
        <div class="modal-content">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 m-0 p-0">
                <form id="formTcremitter" class="formTcremitter" method="POST" action="{{ route('tcremitter.store') }}">
                    @csrf
                    @include('partials._session-msg')
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-12 col-xl-12 m-auto p-0">
                        <div class="card">
                            <div class="card-header bg-primary text-white d-flex justify-content-between">
                                <h4 id="title-mremdest">{{ __('Nuevo Remitente')}}</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <label><strong>{{ __("No. ID") }}</strong></label>
                                        <input type="text" id="txtRemitterId" name="txtRemitterId" class="form-control form-control-sm txtRemitterId" autofocus>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <label><strong>{{ __("Nombre(s)") }}</strong></label>
                                        <input type="text" id="txtRemitterName" name="txtRemitterName" class="form-control form-control-sm inputremdest requerido" required>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label><strong>{{ __("1er Apellido") }}</strong></label>
                                        <input type="text" id="txtRemitterApellidop" name="txtRemitterApellidop" class="form-control form-control-sm inputremdest requerido" required>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label><strong>{{ __("2do Apellido") }}</strong></label>
                                        <input type="text" id="txtRemitterApellidom" name="txtRemitterApellidom" class="form-control form-control-sm inputremdest requerido" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <label><strong>{{ __("Telefono") }}</strong></label>
                                        <input type="text" id="txtRemitterTelef" name="txtRemitterTelef" class="form-control form-control-sm inputremdest requerido" required>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label><strong>{{ __("Direccion") }}</strong></label>
                                        <textarea type="text" id="txtRemitterDir" name="txtRemitterDir" class="form-control form-control-sm inputremdest requerido" required></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <label><strong>{{ __("Email") }}</strong></label>
                                        <input type="text" id="txtRemitterEmail" name="txtRemitterEmail" class="form-control form-control-sm inputremdest requerido" required>
                                    </div>
                                </div>
                            </div>
                            <div class="car-footer ml-auto mr-4">
                                <button type="button" id="btnSaveRemitter" class="btn btn-sm btn-primary mb-2 btnAceptar">{{ __("Guardar") }}</button>
                                <button type="button" id="btnUpdateRemitter" class="btn btn-sm btn-outline-primary mb-2 btnEditar" hidden>{{ __("Actualizar") }}</button>
                                <button type="button" id="btnCloseRemitter"  class="btn btn-sm btn-danger mb-2 btnCerrar">{{ __("Cerrar") }}</button>
                            </div>
                        </div>
                    </div>
                </form>
                <a id="urlRemitterUpdate" href="{{ route('tcremitter.update','') }}" hidden></a>
            </div>
        </div>
    </div>
</div>
