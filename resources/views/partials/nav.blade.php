
 <nav id="sidebar">
    <div class="sidebar-header">
        <h3>SYSCOMT - HAR</h3>
        <a class="" href="/">
         
           <img src="{{asset('/images/syscomt-logo-white-80.png')}}" alt="Click to visit geeksforgeeks.org">
           {{-- <img src="{{asset('/images/kharlogo.png')}}" alt="Click to visit geeksforgeeks.org"> --}}
        </a>
        <a class="" href="/">
         
            <img src="{{asset('/images/har-logo-white-80.png')}}" alt="Click to visit geeksforgeeks.org">
            {{-- <img src="{{asset('/images/kharlogo.png')}}" alt="Click to visit geeksforgeeks.org"> --}}
         </a>
        
        
        <strong style="color: aliceblue;">HAR</strong>
    </div>

    <ul class="list-unstyled components">
        <li class="active">
            <a href="/">
                <i class="fa fa-home"></i>
                INICIO
            </a>
        </li>
        <li>
            <a href="#embarquedesubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"
                href="#">
                {{-- <i class="fa-solid fa-truck-fast"></i> --}}
                <i class="fas fa-shipping-fast"></i>
                {{ __('Embarques') }}
            </a>
            <ul class="collapse list-unstyled" id="embarquedesubmenu">
                <li>
                    <a href="{{ route('embarques.index') }}">{{ __('Ver Embarques') }}</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#ordenSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"
                href="#">
                <i class="fas fa-pen-square"></i>
                {{ __('Solicitudes') }}
            </a>
            <ul class="collapse list-unstyled" id="ordenSubmenu">
                <li>
                    <a id="Submenu-ordenM" class="dropdown-item"
                        href="{{ route('ordenes.index') }}">{{ __('Procesar Solicitudes') }}</a>
                </li>
                {{-- <li>
                    <a id="Submenu-ordenS" class="dropdown-item"
                        href="{{ route('ordenconfirm') }}">{{ __('Solicitudes a Embarcar') }}</a>
                </li> --}}
            </ul>
        </li>
        <li>
            <a class="nav-link dropdown-toggle disabled" href="#">
                <i class="fas fa-file-invoice"></i>
                {{ __('Facturacion') }}
            </a>
        </li>
        <li>
            <a href="#docSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" href="#">
                <i class="fas fa-folder-open"></i>
                {{ __('Documentacion') }}
            </a>
            <ul class="collapse list-unstyled" id="docSubmenu">
                <li>
                    {{-- <a id="etiquetamenu" class="dropdown-item" href="{{ route('etiqueta.index')}}">{{ __('Etiquetas')}}</a> --}}
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('mftoybl.index')}}">{{ __('Manifiesto / BL / AWB')}}</a>
                   
                </li>
                <li>
                    {{-- <a class="dropdown-item" href="{{ route('awb')}}">{{ __('Awb_Test')}}</a> --}}
                </li>
            </ul>
        </li>
        <li>
            <a href="#repSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" href="#">
                <i class="fas fa-th-large"></i>
                {{ __('Reportes') }}
            </a>
            <ul class="collapse list-unstyled" id="repSubmenu">
                 {{-- <li>
                    <a class="dropdown-item" href="{{ route('etiqueta.index')}}">{{ __('Listado de Etiquetas')}}</a>
                 </li>
                <li>
                    <a class="dropdown-item"  href="{{route('facturas.index')}}">{{ __('Listado de Facturas')}}</a>
                </li> --}}
                <li>
                    <a class="dropdown-item" href="{{ route('ordenlistado')}}">{{ __('Listado de Ordenes')}}</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#tcSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" href="#">
                <i class="fas fa-database"></i>
                {{ __('Tablas Control') }}
            </a>
            <ul class="collapse list-unstyled" id="tcSubmenu">
                 <li>
                    <a id="btnvessel" class="dropdown-item" href="{{  route('tcvessel.index') }}">{{ __('Buques / Aeronaves')}}</a>
                   
                 </li>
                <li>
                    <a class="dropdown-item" href="{{  route('tcviaje.index') }}">{{ __('Crear Viaje / Vuelo')}}</a>
                   
                </li>
                <li>
                    <a id="btncont" class="dropdown-item" href="{{  route('tccont.index') }}">{{ __('Contenedores') }}</a>
                   
                </li>
                <li> 
                    <a id="btnclient" class="dropdown-item" href="{{  route('tccliente.index') }}">{{ __('Clientes y Proveedores') }}</a>
                   
                </li>
                <li>
                    <a id="btnrem" class="dropdown-item" href="{{  route('tcremdest.index') }}">{{ __('Remitentes y Destinatarios') }}</a>
                    
                </li>
                <li>
                    <a id="btnprod" class="dropdown-item" href="{{  route('itemprod.index') }}">{{ __('Productos') }}</a>
                    
                </li>
                {{-- <li>
                    <a id="btncargo" class="dropdown-item" href="{{  route('tccargos.index') }}">{{ __('Conceptos de Cobro') }}</a>
                    
                </li>
                <li>
                    <a id="btncob" class="dropdown-item" href="{{  route('tctipocobro.index') }}">{{ __('Precios por Tipo de productos') }}</a>
                   
                </li>
                <li>
                    <a id="btncam" class="dropdown-item" href="{{  route('tcmoneda.index') }}">{{ __('Tasas de Cambio') }}</a>
                   
                </li> --}}
                <li>
                    {{-- <a id="btnAwbm" class="dropdown-item" href="{{  route('awb') }}">{{ __('AWB') }}</a> --}}
                </li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-question"></i>
                FAQ
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-paper-plane"></i>
                Contact
            </a>
        </li>
    </ul>

</nav>