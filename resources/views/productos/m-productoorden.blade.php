{{-- @inject('caparts', 'App\Services\CapituloArticulo') --}}

<div class="modal mt-5 fade" id="mProductoOrden">
    <div id="mProductoOrdenDialog" class="modal-dialog modal-lg-dialog mProductoOrden">
        <div class="modal-content">
            {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet">
            <link href="{{ asset('css/styles.css') }}" rel="stylesheet"> --}}
            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-12 col-xl-12 m-auto p-0">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <label class="titulo" id="title-mitemprod">{{ __('Nuevo Producto')}}</label>
                    </div>
                    <div class="card-body">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 m-0 p-0">
                            <div class="gridListadoArticulo mb-3">
                                <table class="table table-bordered table-hover table-sm table-responsive-sm tablaListadoArticulo">
                                    <thead class="thead-primary">
                                        <tr>
                                            <th><label>Listado de articulos disponibles </label></th>
                                            <th colspan="3">
                                                {{-- <form class="form-inline row"> --}}
                                                    <input id="findTablaArticulo" class="form-control" type="text" placeholder="Search" style="width: 300px">
                                                {{-- </form> --}}
                                            </th>
                                            <th><button class="btn btn-sm btn-secondary">Editar</button></th>
                                        </tr>
                                        <tr class="justify-content-between">
                                            <th scope="col"  class="bg-light" hidden>{{ __("No") }}</th>
                                            <th scope="col"  class="bg-light">{{ __("Producto") }}</th>
                                            <th scope="col"  class="bg-light" style="width: 20%">{{ __("Articulo") }}</th>
                                            <th scope="col"  class="bg-light">{{ __("Categoria") }}</th>
                                            <th scope="col"  class="bg-light">{{ __("UM") }}</th>
                                            <th scope="col"  class="bg-light" style="width: 10%">{{ __("Valor Aduana") }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tablaListadoArticuloBody">

                                    </tbody>
                                </table>
                            </div>
                            <form id="formmItemProd" class="formmItemProd" method="POST" action="{{ route('itemprod.store') }}">
                                @csrf
                                @include('partials._session-msg')
                                <div class="col-12 panelNuevoProducto">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 m-0 p-0 cardbodyNuevoProducto">
                                        <form id="formProducto" class="formProducto" method="POST" action="{{ route('producto.store')}}">
                                            @csrf
                                            @include('partials._session-msg')
                                            <div class="col-sm-12 col-md-10 col-lg-12 col-xl-12 m-auto p-0">
                                                <div class="card contenedor-mproducto">
                                                    <div class="card-body">
                                                        <div class="formfieldproducto col-12">
                                                            <div class="form-row">
                                                                <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                                                    <label for="lblproducto" class="lbl">{{ __("Producto") }}</strong></label>
                                                                    <input type="text" id="txtproducto" name="txtproducto" class="form-control form-control-sm" required disabled>
                                                                </div>
                                                                <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                                                    <label for="lblarticulo" class="lbl">{{ __("Articulo") }}</label>
                                                                    <input id="txtarticulo" class="form-control form-control-sm txtarticulo requerido" type="text" name="txtarticulo" disabled required>
                                                                </div>
                                                                <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                                                    <label for="lblcategoria" class="lbl">{{ __("Categoria") }}</label>
                                                                    <input id="txtcategoria" class="form-control form-control-sm txtcategoria requerido" type="text" name="txtcategoria" disabled required>
                                                                </div>
                                                                <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                                                    <label for="lblumedida" class="lbl">{{ __("UM") }}</label>
                                                                    <input id="txtumedida" class="form-control form-control-sm txtumedida requerido" type="text" name="txtumedida" disabled required>
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                                                    <label for="lblcantidad" class="lbl">{{ __("Cantidad") }}</label>
                                                                    <input id="txtcantidad" class="form-control form-control-sm txtcantidad requerido" type="text" name="txtcantidad" required>
                                                                </div>
                                                                <div class="form-group col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                                                    <label for="lblmcubico" class="lbl">{{ __("M3/Unidad") }}</label>
                                                                    <input id="txtmcubico" class="form-control form-control-sm txtmcubico requerido" type="text" name="txtmcubico" required disabled>
                                                                </div>
                                                                <div class="form-group col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                                                    <label for="lblmcubicokg" class="lbl">{{ __("PVolumen/Unidad") }}</label>
                                                                    <input id="txtmcubicokg" class="form-control form-control-sm txtmcubicokg requerido" type="text" name="txtmcubicokg" required disabled>
                                                                </div>
                                                                <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                                                    <label for="lblvaduana" class="lbl">{{ __("Valor Aduana") }}</label>
                                                                    <input id="txtvaduana" class="form-control form-control-sm txtvaduana requerido" type="text" name="txtvaduana" required disabled>
                                                                </div>
                                                                <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                                                    <label for="lblpesokg" class="lbl">{{ __("Peso KG/Unidad") }}</label>
                                                                    <input id="txtpesokg" class="form-control form-control-sm txtpesokg requerido" type="text" name="txtpesokg" required>
                                                                </div>
                                                                <input id="txtidproducto" class="form-control form-control-sm txtidproducto requerido" type="text" name="txtidproducto" required disabled hidden>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                                                    <label class="lbl">{{ __("Largo (cm)") }}</label>
                                                                    <input id="txtlargom3" class="form-control form-control-sm txtm3 requerido" type="text" name="txtlargom3" required>
                                                                </div>
                                                                <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                                                    <label class="lbl">{{ __("Ancho (cm)") }}</label>
                                                                    <input id="txtanchom3" class="form-control form-control-sm txtm3 requerido" type="text" name="txtanchom3" required>
                                                                </div>
                                                                <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                                                    <label class="lbl">{{ __("Alto (cm)") }}</label>
                                                                    <input id="txtaltom3" class="form-control form-control-sm txtm3 requerido" type="text" name="txtaltom3" required>
                                                                </div>
                                                                <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                                                    <label class="lbl" hidden>{{ __("BTN_M3") }}</label><br>
                                                                    <button type="button" id="btnCalculaM3" class="btn btn-sm btnCalcula mr-1 rounded"><i class="far fa-save mr-1"></i>{{ __('Calcular M3 y KG')}}</button>
                                                                    <input type="checkbox" id="ow" name="ow" value="1" class="mr-1"><label>{{ __("OverW")}}</label>
                                                                </div>
                                                                <input id="txtidproducto" class="form-control form-control-sm txtidproducto requerido" type="text" name="txtidproducto" required disabled hidden>
                                                                <input id="idembarque" class="form-control form-control-sm idembarque requerido" type="text" name="idembarque" required disabled hidden>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer bg-light">
                        <div class="row d-flex justify-content-between align-items-center mr-2">
                            <button type="button" id="btn-saveProducto" class="btn btn-sm btnAceptar mr-1 rounded"><i class="far fa-save mr-1"></i>{{ __('Guardar')}}</button>
                            <button type="button" id="btn-updateProducto" class="btn btn-sm btnEditar mr-1" hidden><i class="far fa-edit mr-1"></i>{{ __("Actualizar") }}</button>
                            <button type="button" id="btn-clearProducto" class="btn btn-sm btn-dark btnCerrar mr-1"><i class="fas fa-sync mr-1"></i>{{ __("Reset") }}</button>
                            <button type="button" id="btnCloseNuevoArticulo" class="btn btn-sm btn-dark btnCerrar mr-1"><i class="fa-thin fa-rectangle-xmark mr-1"></i>{{ __("Cerrar") }}</button>
                        </div>
                        {{-- <a id="urlgetdatosprod" href="{{ route('producto.show','') }}" hidden></a> --}}
                        <a id="urlactualizadatosprod" href="{{ route('producto.update','') }}" hidden></a>
                        <a id="urldeletedatosprod" href="{{ route('producto.destroy','') }}" hidden></a>
                    </div>
                </div>
                {{-- <a id="urlitemprodupdate" href="{{ route('itemprod.update','') }}" hidden></a> --}}
            </div>
        </div>
    </div>
</div>
