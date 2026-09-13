@extends('layouts.app')

@section('content')
    @include('ordenes.listadoordenes')
@endsection

@section('script')
    <script src="{{ asset('js/embarques/main.js') }}"></script>
    <script src="{{ asset('js/Orden/orden.js') }}"></script>
    <script src="{{ asset('js/Orden/crearOrden.js') }}"></script>
    <script src="{{ asset('js/Orden/deleteOrden.js') }}"></script>
    <script src="{{ asset('js/Orden/moveOrdene.js') }}"></script>
    <script src="{{ asset('js/Producto/producto.js') }}"></script>
    <script src="{{ asset('js/Producto/creaProductoOrden.js') }}"></script>
    <script src="{{ asset('js/Producto/updateProductoOrden.js') }}"></script>
    <script src="{{ asset('js/Producto/deleteProductoOrden.js') }}"></script>
    <script src="{{ asset('js/Etiquetas/etiqueta.js') }}"></script>
    <script src="{{ asset('js/Tc/CreaTcRemitter.js') }}"></script>
    <script src="{{ asset('js/Tc/main.js') }}"></script>
    <script src="{{ asset('js/Tc/CreaTcRemDest.js') }}"></script>
@endsection

