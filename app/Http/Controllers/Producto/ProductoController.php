<?php

namespace App\Http\Controllers\Producto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ArticuloDescrip;
use App\Models\Cargo;
use App\Models\Etiqueta;
use App\Models\Ordene;
use App\Models\Producto;
// use App\Models\TcCapituloproducto;
// use App\Models\TcProductoArt;
// use App\Models\TcProductoCap;
use App\Models\Vitemproducto;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = request()->validate([
            'producto'=>'required',
            'articulo'=>'required',
            'categoria'=>'required',
            'um'=>'required',
            'cantidad'=>'required',
            'mcubico'=>'required',
            'largo'=>'required',
            'alto'=>'required',
            'ancho'=>'required',
            'vaduana'=>'required',
            'pesokg'=>'required'
        ]);

        DB::beginTransaction();
        try{
            // $year = substr(Carbon::now('Y'),0,10);
            $idorden = Ordene::where('no_orden',$request->noorden)->get('idorden')->last();
            // $articulo = ArticuloDescrip::where('descripcion',$fields['producto'])->get(['idarticulo','idproductocap']);
            // $capitulo = TcProductoCap::where('idproductocap',$articulo[0]['idproductocap'])->get('categoria_capitulo');
            $catg = ArticuloDescrip::where('descripcion',$fields['producto'])->get();

            if($catg[0]['categoria'] == 'VALOR'){

                global $pesoton, $mcubico, $pvolumen, $pesokgs;

                $em = substr($request->embarque,3,2);
                if( $em == 'EM'){
                    $mcubico=$request->mcubico;
                    $pesoton=$request->pesokg/1000;
                }
                else{
                    $pvolumen=$request->pvolumen;
                    $pesokgs=$fields['pesokg'];
                }

                if($em == 'EM' && $mcubico > $pesoton && $request['ow']=="1"){
                    $producto = Producto::create([
                        'idorden'  =>   $idorden['idorden'],
                        'idarticulo'     =>   $catg[0]['idarticulo'],
                        'noproducto'      =>   $request->noproducto,
                        'descripcion' => $fields['producto'],
                        'um'      =>   $fields['um'],
                        'cantidad' => $fields['cantidad'],
                        'mcubico' => number_format($fields['mcubico'],5),
                        'pesovolumen' => number_format($fields['pesokg'], 3),
                        'largo' => $fields['largo'],
                        'alto' => $fields['alto'],
                        'ancho' => $fields['ancho'],
                        'vaduana'      =>   number_format($fields['vaduana'], 2),
                        'pesokg' => number_format($fields['pesokg'], 3),
                        // 'target' => 'PESO/VOLUMEN M3',
                        'target' => 'M3',
                        'ow' => $request['ow'],
                        'mcubico_total'=> number_format(($fields['mcubico']*$fields['cantidad']),5),
                        'pesovolumen_total'=> number_format(($fields['pesokg']*$fields['cantidad']),3),
                        'pesokg_total'=> number_format(($fields['pesokg']*$fields['cantidad']),3)
                    ]);
                }
                else{
                    if($em == 'EM' && $mcubico > $pesoton && $request['ow'] != "1"){

                        $producto = Producto::create([
                            'idorden'  =>   $idorden['idorden'],
                            'idarticulo'     =>   $catg[0]['idarticulo'],
                            'noproducto'      =>   $request->noproducto,
                            'descripcion' => $fields['producto'],
                            'um'      =>   $fields['um'],
                            'cantidad' => $fields['cantidad'],
                            'mcubico' => number_format($fields['mcubico'],5),
                            'pesovolumen' => number_format($fields['pesokg'], 3),
                            'largo' => $fields['largo'],
                            'alto' => $fields['alto'],
                            'ancho' => $fields['ancho'],
                            'vaduana'      =>   number_format($fields['vaduana'], 2),
                            'pesokg' => number_format($fields['pesokg'], 3),
                            // 'target' => 'PESO/VOLUMEN KG',
                            'target' => 'KG',
                            'ow' => $request['ow'],
                            'mcubico_total'=> number_format(($fields['mcubico']*$fields['cantidad']),5),
                            'pesovolumen_total'=> number_format(($fields['pesokg']*$fields['cantidad']),3),
                            'pesokg_total'=> number_format(($fields['pesokg']*$fields['cantidad']),3)
                        ]);
                    }
                    else{
                        if($em == 'EM' && $mcubico < $pesoton){
                            $producto = Producto::create([
                                'idorden'  =>   $idorden['idorden'],
                                'idarticulo'     =>   $catg[0]['idarticulo'],
                                'noproducto'      =>   $request->noproducto,
                                'descripcion' => $fields['producto'],
                                'um'      =>   $fields['um'],
                                'cantidad' => $fields['cantidad'],
                                'mcubico' => number_format($fields['mcubico'],5),
                                'pesovolumen' => number_format($fields['pesokg'], 3),
                                'largo' => $fields['largo'],
                                'alto' => $fields['alto'],
                                'ancho' => $fields['ancho'],
                                'vaduana'      =>   number_format($fields['vaduana'], 2),
                                'pesokg' => number_format($fields['pesokg'], 3),
                                // 'target' => 'PESO/VOLUMEN KG',
                                'target' => 'KG',
                                'ow' => $request['ow'],
                                'mcubico_total'=> number_format(($fields['mcubico']*$fields['cantidad']),5),
                                'pesovolumen_total'=> number_format(($fields['pesokg']*$fields['cantidad']),3),
                                'pesokg_total'=> number_format(($fields['pesokg']*$fields['cantidad']),3)
                            ]);
                        }
                    }
                }
                if($em == 'EA' && $pvolumen > $pesokgs){
                    $producto = Producto::create([
                        'idorden'  =>   $idorden['idorden'],
                        'idarticulo'     =>   $catg[0]['idarticulo'],
                        'noproducto'      =>   $request->noproducto,
                        'descripcion' => $fields['producto'],
                        'um'      =>   $fields['um'],
                        'cantidad' => $fields['cantidad'],
                        'mcubico' => number_format($fields['mcubico'],5),
                        'pesovolumen' => number_format($request->pvolumen,3),
                        'largo' => $fields['largo'],
                        'alto' => $fields['alto'],
                        'ancho' => $fields['ancho'],
                        'vaduana' => number_format($fields['vaduana'], 2),
                        'pesokg' => number_format($fields['pesokg'], 3),
                        // 'target' => 'PESO/VOLUMEN M3',
                        'target' => 'M3',
                        'mcubico_total'=> number_format(($fields['mcubico']*$fields['cantidad']),5),
                        'pesovolumen_total'=> number_format(($request->pvolumen*$fields['cantidad']),3),
                        'pesokg_total'=> number_format(($fields['pesokg']*$fields['cantidad']),3)
                    ]);
                }
                else{
                    if($em == 'EA' && $pvolumen < $pesokgs){
                        // dd("entra en aereo y pvolumen menor que pesokg");
                        $producto = Producto::create([
                            'idorden'  =>   $idorden['idorden'],
                            'idarticulo'     =>   $catg[0]['idarticulo'],
                            'noproducto'      =>   $request->noproducto,
                            'descripcion' => $fields['producto'],
                            'um'      =>   $fields['um'],
                            'cantidad' => $fields['cantidad'],
                            'mcubico' => number_format($fields['mcubico'],5),
                            'pesovolumen' => number_format($request->pvolumen,3),
                            'largo' => $fields['largo'],
                            'alto' => $fields['alto'],
                            'ancho' => $fields['ancho'],
                            'vaduana' => number_format($fields['vaduana'], 2),
                            'pesokg' => number_format($fields['pesokg'], 3),
                            // 'target' => 'PESO/VOLUMEN KG',
                            'target' => 'KG',
                            'mcubico_total'=> number_format(($fields['mcubico']*$fields['cantidad']),5),
                            'pesovolumen_total'=> number_format(($request->pvolumen*$fields['cantidad']),3),
                            'pesokg_total'=> number_format(($fields['pesokg']*$fields['cantidad']),3)
                        ]);
                    }
                }
            }
            else if($catg[0]['categoria'] == 'BULTOS'){
                
                $producto = Producto::create([
                    'idorden'  =>   $idorden['idorden'],
                    'idarticulo'     =>   $catg[0]['idarticulo'],
                    'noproducto'      =>   $request->noproducto,
                    'descripcion' => $fields['producto'],
                    'um'      =>   $fields['um'],
                    'cantidad' => $fields['cantidad'],
                    'mcubico' => number_format($fields['mcubico'],5),
                    'pesovolumen' => number_format($request->pvolumen,3),
                    'largo' => $fields['largo'],
                    'alto' => $fields['alto'],
                    'ancho' => $fields['ancho'],
                    'vaduana' => number_format($fields['vaduana'], 2),
                    'pesokg' => number_format($fields['pesokg'], 3),
                    'target' => $catg[0]['descripcion'],
                    'mcubico_total'=> number_format(($fields['mcubico']*$fields['cantidad']),5),
                    'pesovolumen_total'=> number_format(($request->pvolumen*$fields['cantidad']),3),
                    'pesokg_total'=> number_format(($fields['pesokg']*$fields['cantidad']),3)
                ]);
            }
            else{
                $producto = Producto::create([
                    'idorden'  =>   $idorden['idorden'],
                    'idarticulo'     =>   $catg[0]['idarticulo'],
                    'noproducto'      =>   $request->noproducto,
                    'descripcion' => $fields['producto'],
                    'um'      =>   $fields['um'],
                    'cantidad' => $fields['cantidad'],
                    'mcubico' => number_format($fields['mcubico'],5),
                    'pesovolumen' => number_format($request->pvolumen,3),
                    'largo' => $fields['largo'],
                    'alto' => $fields['alto'],
                    'ancho' => $fields['ancho'],
                    'vaduana' => number_format($fields['vaduana'], 2),
                    'pesokg' => number_format($fields['pesokg'], 3),
                    'target' => $catg[0]['categoria'],
                    'mcubico_total'=> number_format(($fields['mcubico']*$fields['cantidad']),5),
                    'pesovolumen_total'=> number_format(($request->pvolumen*$fields['cantidad']),3),
                    'pesokg_total'=> number_format(($fields['pesokg']*$fields['cantidad']),3)
                ]);
            }

            $codorden = substr($request->noorden,0,3);
            $year = substr(Carbon::now('Y'),2,2);
            $idproducto = Producto::where('idorden',$idorden['idorden'])->get('idproducto')->last();
            
            if($codorden == 'ENA' || $codorden == 'MNJ'){

                $ordenEtiqueta = Etiqueta::where('idorden',$idorden['idorden'])->get('idorden')->last();
                if($ordenEtiqueta){
                    $etibulto = Etiqueta::where('idorden',$idorden['idorden'])->count();
                    $cantproducto = Producto::where('idorden',$idorden['idorden'])->count();
                    $cantidadActual=$etibulto+1;
                    do {
                        Etiqueta::create([
                            'idorden'  =>   $idorden['idorden'],
                            'idproducto'     =>   $idproducto['idproducto'],
                            'bulto'      =>   $cantidadActual,
                            'cantidad' => $cantproducto,
                            'noproducto' => $request->noproducto,
                            'estado' => 'EN ALMACEN',
                            'noblhouse'=>$year.str_pad($idorden['idorden'], 8, '0', STR_PAD_LEFT)
                        ]);
                        $bulto=$cantidadActual+1;

                    } while ($bulto <= $cantproducto);

                    $eticantidad = Etiqueta::where('idorden',$idorden['idorden'])->count();
                    Etiqueta::where('idorden', $idorden['idorden'])->update([
                        'cantidad'  =>   $eticantidad
                    ]);
                }
                else{
                    $bulto=1;
                    $cantproducto = Producto::where('idorden',$idorden['idorden'])->count();
                    do {
                        Etiqueta::create([
                            'idorden'  =>   $idorden['idorden'],
                            'idproducto'     =>   $idproducto['idproducto'],
                            'bulto'      =>   $bulto,
                            'noproducto' => $request->noproducto,
                            'estado' => 'EN ALMACEN',
                            'noblhouse'=>$year.str_pad($idorden['idorden'], 8, '0', STR_PAD_LEFT)
                        ]);
                        $bulto=$bulto+1;

                    } while ($bulto <= $cantproducto);

                    $eticantidad = Etiqueta::where('idorden',$idorden['idorden'])->count();
                    Etiqueta::where('idorden', $idorden['idorden'])->update([
                        'cantidad'  =>   $eticantidad
                    ]);
                }
            }
            else{
                if($request->producto == 'BULTO 1.5KG' || $request->producto == 'BULTO 3KG' || $request->producto == 'BULTO 5KG' || $request->producto == 'BULTO 10KG'){
                    $bulto=1;
                    do {
                        $idetiquetaLast = Etiqueta::whereNotnull('noblhouse')->get('idetiqueta')->last();
                        Etiqueta::create([
                            'idorden'  =>   $idorden['idorden'],
                            'idproducto'     =>   $producto['idproducto'],
                            'bulto'      =>   $bulto,
                            'cantidad' => $fields['cantidad'],
                            'noproducto' => $request->noproducto,
                            'estado' => 'EN ALMACEN',
                            'noblhouse'=>$year.str_pad($idetiquetaLast['idetiqueta']+1, 8, '0', STR_PAD_LEFT)
                        ]);
                        $bulto=$bulto+1;

                    } while ($bulto <= $fields['cantidad']);
                }
                else{
                    $idetiquetaLast = Etiqueta::whereNotnull('noblhouse')->get('idetiqueta')->last();
                    // dd($idetiquetaLast);

                    if($idetiquetaLast == null){
                        Etiqueta::create([
                            'idorden'  =>   $idorden['idorden'],
                            'idproducto'     =>   $producto['idproducto'],
                            'bulto'      =>   "1",
                            'cantidad' => "1",
                            'noproducto' => $request->noproducto,
                            'estado' => 'EN ALMACEN',
                            'noblhouse'=>$year.str_pad(1, 8, '0', STR_PAD_LEFT)
                        ]);
                    }
                    else{
                        Etiqueta::create([
                            'idorden'  =>   $idorden['idorden'],
                            'idproducto'     =>   $producto['idproducto'],
                            'bulto'      =>   "1",
                            'cantidad' => "1",
                            'noproducto' => $request->noproducto,
                            'estado' => 'EN ALMACEN',
                            'noblhouse'=>$year.str_pad($idetiquetaLast['idetiqueta']+1, 8, '0', STR_PAD_LEFT)
                        ]);
                    }
                }
            }

            DB::commit();
            return response()->json([
                'success' => 'true',
                'message'=>'Los datos han sido guardado correctamente'
            ]);
        }
        catch(Exception $e){
            Db::rollBack();
            $error = $e->getMessage();
            return response()->json([
                'success' => 'false',
                'message'=>''.$error.''
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idproducto)
    {
        $fields = request()->validate([
            'producto'=>'required',
            'articulo'=>'required',
            'categoria'=>'required',
            'um'=>'required',
            'cantidad'=>'required',
            'mcubico'=>'required',
            'largo'=>'required',
            'alto'=>'required',
            'ancho'=>'required',
            'vaduana'=>'required',
            'pesokg'=>'required'
        ]);

        $year = substr(Carbon::now('Y'),0,10);
        // $articulo = ArticuloDescrip::whereNull('f_ffin')->where('descripcion',$fields['producto'])->get(['idarticulo','idproductocap']);
        // $capitulo = TcProductoCap::where('idproductocap',$articulo[0]['idproductocap'])->get('categoria_capitulo');
        $catg = ArticuloDescrip::where('descripcion',$fields['producto'])->get();
        $idorden = Ordene::where('no_orden',$request->noorden)->get('idorden')->last();
        $codorden = substr($request->noorden,0,3);
        $year = substr(Carbon::now('Y'),2,2);

        DB::beginTransaction();
        try{

            if($codorden == 'ENA' || $codorden == 'MNJ'){

                // $countbefore=Producto::where('idproducto',$idproducto)->get('cantidad');
                // dd($countbefore);
                if($catg[0]['categoria'] == 'VALOR'){

                    global $pesoton, $mcubico, $pvolumen, $pesokgs;

                    $em = substr($request->embarque,3,2);
                    if( $em == 'EM'){
                        $mcubico=$request->mcubico;
                        $pesoton=$request->pesokg/1000;
                    }
                    else{
                        $pvolumen=$request->pvolumen;
                        $pesokgs=$fields['pesokg'];
                    }

                    if($em == 'EM' && $mcubico > $pesoton && $request['ow']=="1"){
                        Producto::where('idproducto',$idproducto)->update([
                            'idorden'  =>   $idorden['idorden'],
                            'idarticulo'     =>   $catg[0]['idarticulo'],
                            'noproducto'      =>   $request->noproducto,
                            'descripcion' => $fields['producto'],
                            'um'      =>   $fields['um'],
                            'cantidad' => $fields['cantidad'],
                            'mcubico' => $fields['mcubico'],
                            'pesovolumen' => $fields['pesokg'],
                            'largo' => $fields['largo'],
                            'alto' => $fields['alto'],
                            'ancho' => $fields['ancho'],
                            'vaduana'      =>   $fields['vaduana'],
                            'pesokg' => $fields['pesokg'],
                            'target' => 'M3',
                            'ow' => $request['ow'],
                            'mcubico_total'=> number_format(($fields['mcubico']*$fields['cantidad']),5),
                            'pesovolumen_total'=> number_format(($fields['pesokg']*$fields['cantidad']),3),
                            'pesokg_total'=> number_format(($fields['pesokg']*$fields['cantidad']),3)
                        ]);
                    }
                    else{
                        if($em == 'EM' && $mcubico > $pesoton && $request['ow'] != "1"){
                            Producto::where('idproducto',$idproducto)->update([
                                'idorden'  =>   $idorden['idorden'],
                                'idarticulo'     =>   $catg[0]['idarticulo'],
                                'noproducto'      =>   $request->noproducto,
                                'descripcion' => $fields['producto'],
                                'um'      =>   $fields['um'],
                                'cantidad' => $fields['cantidad'],
                                'mcubico' => $fields['mcubico'],
                                'pesovolumen' => $fields['pesokg'],
                                'largo' => $fields['largo'],
                                'alto' => $fields['alto'],
                                'ancho' => $fields['ancho'],
                                'vaduana'      =>   $fields['vaduana'],
                                'pesokg' => $fields['pesokg'],
                                'target' => 'KG',
                                'ow' => $request['ow'],
                                'mcubico_total'=> number_format(($fields['mcubico']*$fields['cantidad']),5),
                                'pesovolumen_total'=> number_format(($fields['pesokg']*$fields['cantidad']),3),
                                'pesokg_total'=> number_format(($fields['pesokg']*$fields['cantidad']),3)
                            ]);
                        }
                        else{
                            Producto::where('idproducto',$idproducto)->update([
                                'idorden'  =>   $idorden['idorden'],
                                'idarticulo'     =>   $catg[0]['idarticulo'],
                                'noproducto'      =>   $request->noproducto,
                                'descripcion' => $fields['producto'],
                                'um'      =>   $fields['um'],
                                'cantidad' => $fields['cantidad'],
                                'mcubico' => $fields['mcubico'],
                                'pesovolumen' => $fields['pesokg'],
                                'largo' => $fields['largo'],
                                'alto' => $fields['alto'],
                                'ancho' => $fields['ancho'],
                                'vaduana'      =>   $fields['vaduana'],
                                'pesokg' => $fields['pesokg'],
                                'target' => 'KG',
                                'ow' => $request['ow'],
                                'mcubico_total'=> number_format(($fields['mcubico']*$fields['cantidad']),5),
                                'pesovolumen_total'=> number_format(($fields['pesokg']*$fields['cantidad']),3),
                                'pesokg_total'=> number_format(($fields['pesokg']*$fields['cantidad']),3)
                            ]);
                        }
                    }
                    if($em == 'EA' && $pvolumen > $pesokgs){
                        Producto::where('idproducto',$idproducto)->update([
                            'idorden'  =>   $idorden['idorden'],
                            'idarticulo'     =>   $catg[0]['idarticulo'],
                            'noproducto'      =>   $request->noproducto,
                            'descripcion' => $fields['producto'],
                            'um'      =>   $fields['um'],
                            'cantidad' => $fields['cantidad'],
                            'mcubico' => $fields['mcubico'],
                            'pesovolumen' => $request->pvolumen,
                            'largo' => $fields['largo'],
                            'alto' => $fields['alto'],
                            'ancho' => $fields['ancho'],
                            'vaduana'      =>   $fields['vaduana'],
                            'pesokg' => $fields['pesokg'],
                            'target' => 'M3',
                            'mcubico_total'=> number_format(($fields['mcubico']*$fields['cantidad']),5),
                            'pesovolumen_total'=> number_format(($request->pvolumen*$fields['cantidad']),3),
                            'pesokg_total'=> number_format(($fields['pesokg']*$fields['cantidad']),3)
                        ]);
                    }
                    else{
                        if($em == 'EA' && $pvolumen < $pesokgs){
                            Producto::where('idproducto',$idproducto)->update([
                                'idorden'  =>   $idorden['idorden'],
                                'idarticulo'     =>   $catg[0]['idarticulo'],
                                'noproducto'      =>   $request->noproducto,
                                'descripcion' => $fields['producto'],
                                'um'      =>   $fields['um'],
                                'cantidad' => $fields['cantidad'],
                                'mcubico' => $fields['mcubico'],
                                'pesovolumen' => $request->pvolumen,
                                'largo' => $fields['largo'],
                                'alto' => $fields['alto'],
                                'ancho' => $fields['ancho'],
                                'vaduana'      =>   $fields['vaduana'],
                                'pesokg' => $fields['pesokg'],
                                'target' => 'KG',
                                'mcubico_total'=> number_format(($fields['mcubico']*$fields['cantidad']),5),
                                'pesovolumen_total'=> number_format(($request->pvolumen*$fields['cantidad']),3),
                                'pesokg_total'=> number_format(($fields['pesokg']*$fields['cantidad']),3)
                            ]);
                        }
                    }
                }
                else{
                    Producto::where('idproducto',$idproducto)->update([
                        'idorden'  =>   $idorden['idorden'],
                        'idarticulo' => $catg[0]['idarticulo'],
                        'noproducto' => $request->noproducto,
                        'descripcion' => $fields['producto'],
                        'um'      =>   $fields['um'],
                        'cantidad' => $fields['cantidad'],
                        'mcubico' => $fields['mcubico'],
                        'pesovolumen' => $request->pvolumen,
                        'largo' => $fields['largo'],
                        'alto' => $fields['alto'],
                        'ancho' => $fields['ancho'],
                        'vaduana' => $fields['vaduana'],
                        'pesokg' => $fields['pesokg'],
                        'target' => $catg[0]['categoria'],
                        'mcubico_total'=> number_format(($fields['mcubico']*$fields['cantidad']),5),
                        'pesovolumen_total'=> number_format(($request->pvolumen*$fields['cantidad']),3),
                        'pesokg_total'=> number_format(($fields['pesokg']*$fields['cantidad']),3)
                    ]);
                }
            }
            else{
                $idorden = Ordene::where('no_orden',$request->noorden)->get('idorden')->last();
                $idLast = Etiqueta::get('idetiqueta')->max('idetiqueta');

                Etiqueta::where('idproducto',$idproducto)->delete();

                if($catg[0]['categoria'] == 'VALOR'){

                    global $pesoton, $mcubico, $pvolumen, $pesokgs;

                    $em = substr($request->embarque,3,2);
                    if( $em == 'EM'){
                        $mcubico=$request->mcubico;
                        $pesoton=$request->pesokg/1000;
                    }
                    else{
                        $pvolumen=$request->pvolumen;
                        $pesokgs=$fields['pesokg'];
                    }
                    //Verificar a partir de aqui
                    if($em == 'EM' && $mcubico > $pesoton && $request['ow']=="1" ){

                        Producto::where('idproducto',$idproducto)->update([
                            'idorden'  =>   $idorden['idorden'],
                            'idarticulo'     =>   $catg[0]['idarticulo'],
                            'noproducto'      =>   $request->noproducto,
                            'descripcion' => $fields['producto'],
                            'um'      =>   $fields['um'],
                            'cantidad' => $fields['cantidad'],
                            'mcubico' => $fields['mcubico'],
                            'pesovolumen' => $fields['pesokg'],
                            'largo' => $fields['largo'],
                            'alto' => $fields['alto'],
                            'ancho' => $fields['ancho'],
                            'vaduana'      =>   $fields['vaduana'],
                            'pesokg' => $fields['pesokg'],
                            'target' => 'M3',
                            'ow' => $request['ow'],
                            'mcubico_total'=> number_format(($fields['mcubico']*$fields['cantidad']),5),
                            'pesovolumen_total'=> number_format(($fields['pesokg']*$fields['cantidad']),3),
                            'pesokg_total'=> number_format(($fields['pesokg']*$fields['cantidad']),3)
                        ]);
                    }
                    else{
                        if($em == 'EM' && $mcubico > $pesoton && $request['ow'] !="1" ){
                            // dd("entra aqui");
                            Producto::where('idproducto',$idproducto)->update([
                                'idorden'  =>   $idorden['idorden'],
                                'idarticulo'     =>   $catg[0]['idarticulo'],
                                'noproducto'      =>   $request->noproducto,
                                'descripcion' => $fields['producto'],
                                'um'      =>   $fields['um'],
                                'cantidad' => $fields['cantidad'],
                                'mcubico' => $fields['mcubico'],
                                'pesovolumen' => $fields['pesokg'],
                                'largo' => $fields['largo'],
                                'alto' => $fields['alto'],
                                'ancho' => $fields['ancho'],
                                'vaduana'      =>   $fields['vaduana'],
                                'pesokg' => $fields['pesokg'],
                                'target' => 'KG',
                                'ow' => $request['ow'],
                                'mcubico_total'=> number_format(($fields['mcubico']*$fields['cantidad']),5),
                                'pesovolumen_total'=> number_format(($fields['pesokg']*$fields['cantidad']),3),
                                'pesokg_total'=> number_format(($fields['pesokg']*$fields['cantidad']),3)
                            ]);
                        }
                        else{
                            if($em == 'EM' && $mcubico < $pesoton){
                                // dd("entra aqui");
                                Producto::where('idproducto',$idproducto)->update([
                                    'idorden'  =>   $idorden['idorden'],
                                    'idarticulo'     =>   $catg[0]['idarticulo'],
                                    'noproducto'      =>   $request->noproducto,
                                    'descripcion' => $fields['producto'],
                                    'um'      =>   $fields['um'],
                                    'cantidad' => $fields['cantidad'],
                                    'mcubico' => $fields['mcubico'],
                                    'pesovolumen' => $fields['pesokg'],
                                    'largo' => $fields['largo'],
                                    'alto' => $fields['alto'],
                                    'ancho' => $fields['ancho'],
                                    'vaduana'      =>   $fields['vaduana'],
                                    'pesokg' => $fields['pesokg'],
                                    'target' => 'KG',
                                    'ow' => $request['ow'],
                                    'mcubico_total'=> number_format(($fields['mcubico']*$fields['cantidad']),5),
                                    'pesovolumen_total'=> number_format(($fields['pesokg']*$fields['cantidad']),3),
                                    'pesokg_total'=> number_format(($fields['pesokg']*$fields['cantidad']),3)
                                ]);
                            }
                        // }

                        else{
                            if($em == 'EA' && $pvolumen > $pesokgs){
                                Producto::where('idproducto',$idproducto)->update([
                                    'idorden'  =>   $idorden['idorden'],
                                    'idarticulo'     =>   $catg[0]['idarticulo'],
                                    'noproducto'      =>   $request->noproducto,
                                    'descripcion' => $fields['producto'],
                                    'um'      =>   $fields['um'],
                                    'cantidad' => $fields['cantidad'],
                                    'mcubico' => $fields['mcubico'],
                                    'pesovolumen' => $request->pvolumen,
                                    'largo' => $fields['largo'],
                                    'alto' => $fields['alto'],
                                    'ancho' => $fields['ancho'],
                                    'vaduana'      =>   $fields['vaduana'],
                                    'pesokg' => $fields['pesokg'],
                                    'target' => 'M3',
                                    'ow' => $request['ow'],
                                    'mcubico_total'=> number_format(($fields['mcubico']*$fields['cantidad']),5),
                                    'pesovolumen_total'=> number_format(($request->pvolumen*$fields['cantidad']),3),
                                    'pesokg_total'=> number_format(($fields['pesokg']*$fields['cantidad']),3)
                                ]);
                            }
                            else{
                                Producto::where('idproducto',$idproducto)->update([
                                    'idorden'  =>   $idorden['idorden'],
                                    'idarticulo'     =>   $catg[0]['idarticulo'],
                                    'noproducto'      =>   $request->noproducto,
                                    'descripcion' => $fields['producto'],
                                    'um'      =>   $fields['um'],
                                    'cantidad' => $fields['cantidad'],
                                    'mcubico' => $fields['mcubico'],
                                    'pesovolumen' => $request->pvolumen,
                                    'largo' => $fields['largo'],
                                    'alto' => $fields['alto'],
                                    'ancho' => $fields['ancho'],
                                    'vaduana'      =>   $fields['vaduana'],
                                    'pesokg' => $fields['pesokg'],
                                    'target' => 'KG',
                                    'ow' => $request['ow'],
                                    'mcubico_total'=> number_format(($fields['mcubico']*$fields['cantidad']),5),
                                    'pesovolumen_total'=> number_format(($request->pvolumen*$fields['cantidad']),3),
                                    'pesokg_total'=> number_format(($fields['pesokg']*$fields['cantidad']),3)
                                ]);
                            }
                        }
                    }
                    }
                }
                else if($catg[0]['categoria'] == 'BULTOS'){
                    Producto::where('idproducto',$idproducto)->update([
                        'idorden'  =>   $idorden['idorden'],
                        'idarticulo'     =>   $catg[0]['idarticulo'],
                        'noproducto'      =>   $request->noproducto,
                        'descripcion' => $fields['producto'],
                        'um'      =>   $fields['um'],
                        'cantidad' => $fields['cantidad'],
                        'mcubico' => number_format($fields['mcubico'],5),
                        'pesovolumen' => number_format($request->pvolumen,3),
                        'largo' => $fields['largo'],
                        'alto' => $fields['alto'],
                        'ancho' => $fields['ancho'],
                        'vaduana' => number_format($fields['vaduana'], 2),
                        'pesokg' => number_format($fields['pesokg'], 3),
                        'target' => $catg[0]['descripcion'],
                        'mcubico_total'=> number_format(($fields['mcubico']*$fields['cantidad']),5),
                        'pesovolumen_total'=> number_format(($request->pvolumen*$fields['cantidad']),3),
                        'pesokg_total'=> number_format(($fields['pesokg']*$fields['cantidad']),3)
                    ]);
                }
                else{
                    Producto::where('idproducto',$idproducto)->update([
                        'idorden'  =>   $idorden['idorden'],
                        'idarticulo'     =>   $catg[0]['idarticulo'],
                        'noproducto'      =>   $request->noproducto,
                        'descripcion' => $fields['producto'],
                        'um'      =>   $fields['um'],
                        'cantidad' => $fields['cantidad'],
                        'mcubico' => number_format($fields['mcubico'],5),
                        'pesovolumen' => number_format($request->pvolumen,3),
                        'largo' => $fields['largo'],
                        'alto' => $fields['alto'],
                        'ancho' => $fields['ancho'],
                        'vaduana'      =>   number_format($fields['vaduana'],2),
                        'pesokg' => number_format($fields['pesokg'],3),
                        'target' => $catg[0]['categoria'],
                        'mcubico_total'=> number_format(($fields['mcubico']*$fields['cantidad']),5),
                        'pesovolumen_total'=> number_format(($request->pvolumen*$fields['cantidad']),3),
                        'pesokg_total'=> number_format(($fields['pesokg']*$fields['cantidad']),3)
                    ]);
                }

                if($request->producto == 'BULTO 1.5KG' || $request->producto == 'BULTO 3KG' || $request->producto == 'BULTO 5KG' || $request->producto == 'BULTO 10KG'){
                    $bulto=1;

                    do {
                        Etiqueta::create([
                            'idorden'  =>   $idorden['idorden'],
                            'idproducto'     =>   $idproducto,
                            'bulto'      =>   $bulto,
                            'cantidad' => $fields['cantidad'],
                            'noproducto' => $request->noproducto,
                            'estado' => 'EN ALMACEN',
                            'noblhouse'=>$year.str_pad($idLast+$bulto, 8, '0', STR_PAD_LEFT)
                        ]);
                        $bulto=$bulto+1;
                    } while ($bulto <= $fields['cantidad']);
                }
                else{
                    Etiqueta::create([
                        'idorden'  =>   $idorden['idorden'],
                        'idproducto'     =>   $idproducto,
                        'bulto'      =>  "1",
                        'cantidad' => "1",
                        'noproducto' => $request->noproducto,
                        'estado' => 'EN ALMACEN',
                        'noblhouse'=>$year.str_pad($idLast+1, 8, '0', STR_PAD_LEFT)
                    ]);
                }
            }
            DB::commit();
            return response()->json([
                'success' => 'true',
                'message'=>'Los datos han sido actualizado correctamente'
            ]);
        }
        catch(Exception $e){
            Db::rollBack();
            $error = $e->getMessage();
            return response()->json([
                'success' => 'false',
                'message'=>''.$error.''
            ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $idproducto)
    {
        $idorden = Ordene::where('no_orden',$request->noorden)->get('idorden');
        $codorden = substr($request->noorden,0,3);
        $prod = Producto::where('idproducto',$request->producto)->get('target');

        DB::beginTransaction();
        try{
            if($codorden == 'ENA' || $codorden == 'MNJ'){
                Etiqueta::where('idproducto',$request->producto)->delete();
                $countEtiqueta = Etiqueta::where('idorden',$idorden[0]['idorden'])->count();
                Etiqueta::where('idorden', $idorden[0]['idorden'])->update([
                    'cantidad'  => $countEtiqueta
                ]);
                DB::select("CALL obtenerSeqBulto(".$idorden[0]['idorden'].")");
                Producto::where('idproducto',$request->producto)->delete();
            
                DB::commit();
                return response()->json([
                    'success' => 'true',
                    'message'=>'El producto ha sido eliminado'
                ]);
            }
            else{
                
                Etiqueta::where('idproducto',$request->producto)->delete();
                Producto::where('idproducto',$request->producto)->delete();
                
                DB::commit();
                return response()->json([
                    'success' => 'true',
                    'message'=>'El producto han sido eliminado'
                ]);
            }
        }
        catch(Exception $e){
            Db::rollBack();
            $error = $e->getMessage();
            return response()->json([
                'success' => 'false',
                'message'=>''.$error.''
            ]);
        }
    }

    public function getNoProducto(Request $request)
    {
        global $seq;

            $noproducto = Producto::orderBy('noproducto','Asc')->get('noproducto')->last();

            if($noproducto != ''){
                $seq = $noproducto['noproducto']+1;
            }
            else{
                $seq=1;
            }
            return response()->json($seq);
        
    }

    public function getArticulosCap(Request $request){

        $idorden=Ordene::where('no_orden',$request->orden)->get('idorden');
        $descripcion = Producto::where('idorden',$idorden[0]['idorden'])->where('idarticulo',$request->idproducto)->get('idproducto');

            $jsondata=array();
            $jsondata['data'] = Vitemproducto::where('idarticulo',$request->idproducto)->get();

            $jsondata['success'] = true;
            $jsondata['message'] = 'Request made';
            echo json_encode($jsondata);
    }

    public function getProductos(){

        $fechaActual=Carbon::now()->format('Y-m-d');

        $jsondata=array();
        $jsondata['data'] = Vitemproducto::whereNull('f_ffin')->orWhere('f_ffin','>',$fechaActual)->orderBy('producto','ASC')->get();

        $jsondata['success'] = true;
        $jsondata['message'] = 'Request made';
        echo json_encode($jsondata);
    }
}
