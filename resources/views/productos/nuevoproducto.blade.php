@inject('productos', 'App\Services\Productos')

<div class="orden-nuevoproducto col-sm-6 col-md-6 col-lg-6 col-xl-6" hidden>
    @include('productos.m-productoorden')
    <div class="card cardnuevoproducto">
        <div class="card-header bg-primary d-flex justify-content-between">
            <label class="titulo">{{ __('Articulos')}}</label>
        </div>
        <div class="card-body">
            <div class="col-12 panelNuevoProducto">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 m-0 p-0 cardbodyNuevoProducto">
                    <form id="formProducto" class="formProducto" method="POST" action="{{ route('producto.store')}}">
                        @csrf
                        @include('partials._session-msg')
                        <div class="col-sm-12 col-md-10 col-lg-12 col-xl-12 m-auto p-0">
                            <div class="card contenedor-listadoproducto">
                                <div class="card-body">
                                    {{-- <div class="divtableproducto row pt-4">  --}}
                                        <div>
                                            <div class="row d-flex justify-content-between align-items-center col-10">
                                                <div class="form-inline col-sm-2 col-md-2 col-lg-2 col-xl-2 pr-0 mb-1">
                                                    <label for="lblproductono" class="lbl mr-2" style="text-align: right">{{ __("No Bulto:") }}</label>
                                                    {{-- <input id="txtproductono" class="form-control form-control-sm txtproductono ml-1" type="text" name="txtproductono" disabled> --}}
                                                </div>
                                                <div class="form-inline col-sm-9 col-md-9 col-lg-9 col-xl-9 mb-1">
                                                    <input id="txtproductono" class="form-control form-control-sm txtproductono ml-1" type="text" name="txtproductono" disabled>
                                                </div>
                                                <div class="form-inline col-sm-2 col-md-2 col-lg-2 col-xl-2 pr-0 mb-1">
                                                    <label for="lblnoorden_prod_nuevo" class="lbl mr-2" style="text-align: right">{{ __("Orden:") }}</label>
                                                    {{-- <input type="text" id="txtnoorden_prod_nuevo" name="txtnoorden_prod_nuevo" class="form-control form-control-sm txtnoorden_prod_nuevo ml-1" disabled> --}}
                                                </div>
                                                <div class="form-inline col-sm-9 col-md-9 col-lg-9 col-xl-9 mb-1">
                                                    <input type="text" id="txtnoorden_prod_nuevo" name="txtnoorden_prod_nuevo" class="form-control form-control-sm txtnoorden_prod_nuevo ml-1" disabled>
                                                </div>

                                                <div class="form-inline col-sm-2 col-md-2 col-lg-2 col-xl-2 pr-0 mb-2">
                                                    <label for="lbldest_producto_nuevo" class="lbl">{{ __("Destinatario:") }}</label>
                                                    {{-- <input type="text" id="txtdest_prod_nuevo" name="txtdest_prod_nuevo" class="form-control form-control-sm txtdest_prod_nuevo ml-1" disabled> --}}
                                                </div>
                                                <div class="form-inline col-sm-9 col-md-9 col-lg-9 col-xl-9 mb-2">
                                                    <input type="text" id="txtdest_prod_nuevo" name="txtdest_prod_nuevo" class="form-control form-control-sm txtdest_prod_nuevo ml-1" disabled>
                                                </div>

                                            </div>

                                        </div>
                                        <div  class="gridNProducto">
                                            <table class="table table-bordered table-hover table-sm table-responsive-sm tablanewprod">
                                                <thead class="thead-primary">
                                                    <tr class="justify-content-between">
                                                        <th colspan="19"><button id="btnNuevoProd" type="button" class="btn btn-sm btn-primary">{{__('Agregar Articulo')}}</button></th>
                                                    </tr>
                                                    <tr class="justify-content-between">
                                                        <th scope="col"  class="bg-light">{{ __("No") }}</th>
                                                        <th scope="col"  class="bg-light">{{ __("Producto") }}</th>
                                                        <th scope="col"  class="bg-light">{{ __("Capitulo") }}</th>
                                                        <th scope="col"  class="bg-light" style="width: 20%">{{ __("Articulo") }}</th>
                                                        <th scope="col"  class="bg-light">{{ __("UM") }}</th>
                                                        <th scope="col"  class="bg-light">{{ __("Ctdad") }}</th>
                                                        <th scope="col"  class="bg-light">{{ __("M3") }}</th>
                                                        <th scope="col"  class="bg-light">{{ __("VA") }}</th>
                                                        <th scope="col"  class="bg-light">{{ __("KG") }}</th>
                                                        <th scope="col"  class="bg-light" hidden>{{ __("M3") }}</th>
                                                        <th scope="col"  class="bg-light" hidden>{{ __("VA") }}</th>
                                                        <th scope="col"  class="bg-light" hidden>{{ __("Peso KG") }}</th>
                                                        <th scope="col"  class="bg-light" hidden>{{ __("idproducto") }}</th>
                                                        <th scope="col"  class="bg-light" hidden>{{ __("largo") }}</th>
                                                        <th scope="col"  class="bg-light" hidden>{{ __("alto") }}</th>
                                                        <th scope="col"  class="bg-light" hidden>{{ __("ancho") }}</th>
                                                        <th scope="col"  class="bg-light" hidden>{{ __("pesovolumen") }}</th>
                                                        <th scope="col"  class="bg-light" hidden>{{ __("ow") }}</th>
                                                        <th scope="col"  class="bg-light" style="width: 80px">{{ __("Accion") }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tablanewprodBody">

                                                </tbody>
                                            </table>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-footer bg-light">
            <div class="row d-flex justify-content-between align-items-center mr-2">
                <button class="btn btn-dark ml-auto btncerrar-nuevoproducto btnCerrar"></i>{{ __("Cerrar")}}</button>
            </div>
            {{-- <a id="urlgetdatosprod" href="{{ route('producto.show','') }}" hidden></a> --}}
            <a id="urlactualizadatosprod" href="{{ route('producto.update','') }}" hidden></a>
            <a id="urldeletedatosprod" href="{{ route('producto.destroy','') }}" hidden></a>
        </div>
    </div>
</div>
