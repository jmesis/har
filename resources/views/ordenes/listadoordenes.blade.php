<div class="row p-0">
    <div class="embarque-datalle col-sm-6 col-md-6 col-lg-6 col-xl-6 m-0">
        @include('ordenes.m-orden')
        @include('ordenes.m-moverorden')
        @include('modals.mTcremitter')
        @include('modals.mRemDest')
        <div class="card card-ordenes">
            <div class="card-header d-flex justify-content-between" data-toggle="collapse" data-target=".cardbodyordenes">
                <label class="titulo">{{ __('Listado de ordenes')}}</label>
            </div>
            <div class="card-body cardbodyordenes collapse show">
                <div class="col-12 contordenes p-0">
                    <div id="leyendaOrdenes" class="col-12 bg-dark text-white-50" hidden>
                        <p>{{ __("No existen ordenes para este embarque")}}</p>
                    </div>
                    <table class="table table-hover table-bordered table-sm table-responsive-sm tablelistadoordenes">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" colspan="4"  class="bg-light thtop"><button id="creaNorden" type="button" class="btn-nuevaorden btn btn-sm btn-primary rounded mr-2 btnAceptar " disabled><i class="fas fa-plus mr-1"></i>{{ __("Crear Nueva Orden") }}</button><button type="button" class="btn-moveOrden btn-outline-dark btn btn-sm rounded ml-1 mr-auto btnMoveOrden" disabled><i class="fas fa-exchange-alt mr-1"></i>{{__("Mover Orden")}}</button></th>
                                {{-- <a class="btn-expExcel btn btn-sm btn-success rounded ml-auto" href="{{route('generaexcel')}}">{{ __("Exportar a Excel") }}</a></th> --}}
                                {{-- <a class="btn-facturaorden btn btn-sm btn-success rounded ml-auto"><i class="far fa-lg fa-file-excel mr-1"></i>{{ __("Exportar a Excel") }}</a></th> --}}
                                <th scope="col" class="bg-light thdown">
                                    <div class="form-inline es-input" data-effects="slide">
                                        <label for="lblpeson">{{ __("Año") }}</label>
                                        <select id="txtanno_embarque"
                                                name="txtanno_embarque"
                                                class="selectpicker show-menu-arrow form-control form-control-sm txtanno_embarque ml-2"
                                                data-live-search="true" required>
                                                <option></option>
                                                <option>{{ Carbon\Carbon::now()->format('Y')}}</option>
                                                <option>{{ Carbon\Carbon::now()->subYears(1)->format('Y')}}</option>
                                                <option>{{ Carbon\Carbon::now()->subYears(2)->format('Y')}}</option>
                                        </select>
                                    </div>
                                </th>
                                <th scope="col" colspan="3" class="bg-light thdown">
                                    <div class="form-inline es-input" data-effects="slide">
                                        <label for="lblpeson">{{ __("No. Embarque:") }}</label>
                                        <select id="txtnoembarque_orden"
                                                name="txtnoembarque_orden"
                                                class="selectpicker show-menu-arrow form-control form-control-sm txtnoembarque_orden ml-2"
                                                data-live-search="true" required>
                                        </select>
                                    </div>
                                </th>

                            </tr>
                            <tr class="justify-content-between">
                                <th scope="col"  class="bg-light" style="width: 2%"><input type="checkbox" class="chkboxFullOrdenes"></th>
                                <th scope="col"  class="bg-light" style="width: 10%">{{ __("No. Orden") }}</th>
                                <th scope="col"  class="bg-light" style="width: 10%">{{ __("Fecha") }}</th>
                                <th scope="col"  class="bg-light" style="width: 23%">{{ __("Remitente") }}</th>
                                <th scope="col"  class="bg-light" style="width: 23%">{{ __("Destinatario") }}</th>
                                <th scope="col"  class="bg-light" style="width: 12%">{{ __("Estado") }}</th>
                                <th scope="col"  class="bg-light" style="width: 15%" hidden>{{ __("Doc") }}</th>
                                <th scope="col"  class="bg-light" style="text-align: right; width:30%"></th>
                            </tr>
                        </thead>
                        <tbody id="tableordenesBody">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-light">
                <div class="row d-flex justify-content-between align-items-center mr-2">
                    <button class="btn btn-dark ml-auto mt-0 btncerrar-embarquedetalle btnCerrar">{{ __("Cerrar")}}</button>
                </div>
                <a id="urlgetordenes" class="urlgetordenes" href="{{ route('ordenes.show','') }}" hidden></a>
                <a id="urldeleteorden" href="{{ route('ordenes.destroy','') }}" hidden></a>
            </div>
        </div>
    </div>
    @include('productos.listadoproductos')
    @include('productos.nuevoproducto')
</div>
