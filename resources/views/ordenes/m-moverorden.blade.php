 <div class="modal fade" id="m-moverorden">
    <div class="modal-dialog">
        <div class="modal-content">
             {{--   {<link href="{{ asset('css/app.css') }}" rel="stylesheet">
                <link href="{{ asset('css/styles.css') }}" rel="stylesheet">


            <div class="modal-header">
                <h4 id="titleMoveOrden" class="modal-title text-white">{{ __('Mover Ordenes')}}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>


            <div class="row modal-body">
                <div class="col-12">
                <span id="msgerrormoveorden"></span><br/><br />
                <div class="form-group col-sm-5">
                    <label>{{ __("Embarque actual") }}</label>
                    <input type="text" id="txtEmbarqueActual" class="form-control requerido" type="text" name="txtEmbarqueActual" required disabled>
                </div>

                <div class="form-group col-sm-6 mr-4">
                    <label>{{ __("Nuevo embarque") }}</label>
                    <select id="txtNuevoEmbarque"
                             name="txtNuevoEmbarque"
                            class="selectpicker show-menu-arrow form-control form-control-sm txtNuevoEmbarque requerido"
                            data-live-search="true"
                            required>
                            <option></option>
                            @foreach($vembarques as $vembarqueitem)
                            <option data-tokens="{{ $vembarqueitem->no_embarque }}" value="{{ $vembarqueitem->no_embarque }}"> {{ $vembarqueitem->no_embarque }}</option>
                        @endforeach
                    </select>
                </div>
                </div>
            </div>


      <div class="modal-footer">
        <button id="btnMoveOrdenes" type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Yes')}}</button>
        <button id="btnCerrarMoveOrdenes" type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cerrar')}}</button>
      </div>
    </div>
  </div>
</div> --}}

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 m-0 p-0">
                {{-- <form id="formMoveOrden" class="formMoveOrden" method="POST" action="{{ route('muevesolicitud') }}"> --}}
                    @csrf
                    @include('partials._session-msg')
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-12 col-xl-12 m-auto p-0">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h4 id="titleMoveOrden" class="titulo">{{ __('Mover Ordenes')}}</h4>
                            </div>
                            <div class="card-body">
                                <div id="fieldViaje" class="form-row">

                                    <div class="form-group col-sm-5">
                                        <label>{{ __("Embarque actual") }}</label>
                                        <input type="text" id="txtEmbarqueActual" class="form-control requerido" type="text" name="txtEmbarqueActual" required disabled>
                                    </div>

                                    <div class="form-group col-sm-6 mr-4">
                                        <label>{{ __("Nuevo embarque") }}</label>
                                        <select id="txtNuevoEmbarque"
                                                 name="txtNuevoEmbarque"
                                                class="selectpicker show-menu-arrow form-control form-control-sm txtNuevoEmbarque requerido"
                                                data-live-search="true"
                                                required>
                                                <option></option>
                                                @foreach($vembarques as $vembarqueitem)
                                                <option data-tokens="{{ $vembarqueitem->no_embarque }}" value="{{ $vembarqueitem->no_embarque }}"> {{ $vembarqueitem->no_embarque }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="car-footer ml-auto mr-4">
                                <button type="button" id="btnMoveOrdenes" class="btn btn-sm btn-primary mb-2">{{ __("Mover Ordenes") }}</button>
                                <button type="button" id="btnCerrarMoveOrdenes" class="btn btn-sm btn-danger mb-2 btnCerrarMoveOrdenes">{{ __("Cerrar") }}</button>
                            </div>
                            <a class="urlgetordenes" href="{{ route('ordenes.show','') }}" hidden></a>
                        </div>
                    </div>
                {{-- </form> --}}
             </div>
        </div>
    </div>
</div>




