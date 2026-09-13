<?php

namespace App\Http\Controllers\Orden;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cargo;
use App\Models\Embarque;
use App\Models\Etiqueta;
use App\Models\FacturaDato;
use App\Models\Ordene;
use App\Models\Producto;
use App\Models\TcProvMcpio;
use App\Models\TcRemDest;
use App\Models\TcTipoenvio;
use App\Models\Vembarque;
use App\Models\Vetiqueta;
use App\Models\Vlistadoordene;
use App\Models\Vordene;
use App\Models\VordenToEmbarque;
use App\Models\Vproducto;
use App\Models\Vproductoresume;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;
use Svg\Gradient\Stop;

class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vembarques=Vembarque::orderBy('fecha_est','Asc')->get();
        return view('ordenes.panelordenes', compact('vembarques'));
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
        global $resultado; //$nom_remitente;

        $fields = request()->validate([
            'noembarque'=>'required',
            'tipoenvio'=>'required',
            'remitente'=>'required',
            'destinatario'=>'required',
            'iddestinatario'=>'required',
            'fentrada' => 'required',
            'entrega' => 'required'
        ]);

        // if($fields['tipoenvio'] == 'ENA' || $fields['tipoenvio'] == 'MNJ'){
        //     $nap_remitente = TcRemDest::where('idremdest',$fields['remitente'])->get('nombre','apellidop','apellidom')->last();
        //     $nom_remitente=$nap_remitente['nombre']." ".$nap_remitente['apellidop']." ".$nap_remitente['apellidom'];
        // }
        // else{
        //     $nom_remitente = $fields['remitente'];
        // }

        $idembarque=Embarque::where('no_embarque',$fields['noembarque'])->get('idembarque')->last();
        $tipoenvio=TcTipoenvio::where('categoria',$fields['tipoenvio'])->get(['idtenvio','categoria'])->last();
        $idlocation = TcRemDest::where('idremdest',$fields['iddestinatario'])->get('idprovmcpio');
        $caracter = TcProvMcpio::where('idprovmcpio',$idlocation[0]['idprovmcpio'])->get('caracter');

        if(/*$nom_remitente != '' && */$idembarque != '' && $tipoenvio != ''){

            $year = substr(Carbon::now('Y'),2,2);
            $noseq = Ordene::where('codigoenvio',substr($tipoenvio['categoria'],0,3))->where('anno',$year)->get('noseq')->last();

            if($noseq == ''){
                $resultado = 1;
            }
            else{
                $valor=$noseq['noseq']+1;
                $resultado = $valor;
            }

            DB::beginTransaction();
            try{
                $consecutivo = str_pad($resultado, 4, '0', STR_PAD_LEFT);
                $orden=Ordene::create([
                    'idremitter'=>$request['idremitter'],
                    'idremdest'=>$fields['iddestinatario'],
                    'idembarque'=>$idembarque['idembarque'],
                    'idtenvio' =>$tipoenvio['idtenvio'],
                    'identrega'=>$fields['entrega'],
                    'codigoenvio' => substr($tipoenvio['categoria'],0,3),
                    'no_orden'=>substr($tipoenvio['categoria'],0,3).$year.$consecutivo,
                    'noseq'=>$resultado,
                    'anno'=>$year,
                    'remitente'=>strtoupper("".$fields['remitente'].""),
                    'fentrada' =>$request['fentrada'],
                    'estado' => 'PENDIENTE'
                ]);
                $idorden = Ordene::where('no_orden',substr($tipoenvio['categoria'],0,3).$year.$consecutivo)->get('idorden');

                Ordene::where('idorden',$idorden[0]['idorden'])->update([
                    'codigo_identificativo'=>'GLH'.$caracter[0]['caracter']."S".str_pad($idorden[0]['idorden'],6,"0",STR_PAD_LEFT)
                ]);

                if($orden){
                    DB::commit();
                    return response()->json([
                        'success' => 'true',
                        'message'=>'La orden ha sido creada'
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id !=''){
            $jsondata=array();

            $jsondata['data'] = Vordene::where('no_embarque',$id)->get();
            $jsondata['success'] = true;
	    	$jsondata['message'] = 'Request made';

            echo json_encode($jsondata);
        }
        else{
            echo("No existen ordenes asociadas a ese Embarque");
        }
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($noorden)
    {
        $orden = Ordene::where('estado','!=','EMBARCADO')->where('no_orden',$noorden)->get('idorden');

        DB::beginTransaction();
        try{
            if($orden->isEmpty()){
                return response()->json([
                    'success' => 'false',
                    'message'=>'Esta orden se encuentra embarcada, por tal motivo no se puede eliminar'
                ]);
            }
            else{
                Etiqueta::where('idorden',$orden[0]['idorden'])->delete();
                Producto::where('idorden',$orden[0]['idorden'])->delete();
                Ordene::where('idorden',$orden[0]['idorden'])->delete();
            }
            DB::commit();
            return response()->json([
                'success' => 'true',
                'message'=>'La orden '.$noorden.' han sido eliminada'
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

    public function getListadoProducto(Request $request){

        if($request->ajax()){

            $jsondata=array();
            $jsondata['data'] = Vproductoresume::orderBy('noproducto','ASC')->where('noorden',$request['noorden'])->get()->all();

            $jsondata['success'] = true;
            $jsondata['message'] = 'Request made';
            echo json_encode($jsondata);
        }
    }

    public function getProductoDetalle(Request $request){

        if($request->ajax()){

            $jsondata=array();
            $jsondata['data'] = Vproducto::orderBy('noproducto','ASC')->where('noproducto',$request['noproducto'])->get()->all();

            $jsondata['success'] = true;
            $jsondata['count'] = count($jsondata['data']);
            $jsondata['message'] = 'Request made';
            echo json_encode($jsondata);
        }
    }

    public function ordenesToEmbarcar(Request $request){

        if ($request->isMethod('post')){
            $embarque = $request->embarque;

            $jsondata=array();
            $jsondata['data'] = VordenToEmbarque::where('no_embarque',$embarque)->get();

            $jsondata['success'] = true;
            $jsondata['message'] = 'Request made';
            $jsondata['count'] = count($jsondata['data']);
            echo json_encode($jsondata);
        }
        else{
            $jsondata['success'] = false;
            $jsondata['message'] = 'Peticion incorrecta';
            echo json_encode($jsondata);
        }
    }

    public function listaBultoConfirmado(Request $request){

        if ($request->isMethod('post')){

            $embarque = $request->embarque;
            $pieza = $request->pieza;

            $rsOE = VordenToEmbarque::where('codigobarra',$pieza)->where('no_embarque',$embarque)->get(['idorden','codigoenvio']);

            if($rsOE[0]['codigoenvio'] == 'ENV'){
                // $rsVEtiqueta = Vetiqueta::where('idorden',$rsOE[0]['idorden'])->where('no_embarque',$embarque)->get(['idorden','idetiqueta']);
                Etiqueta::where('idorden', $rsOE[0]['idorden'])->update([
                    'estado'=>'CONFIRMADO'
                ]);
                DB::select("CALL verificaStatusOrden(".$rsOE[0]['idorden'].")");
            }
            else{
                $rsVEtiqueta = Vetiqueta::where('idorden',$rsOE[0]['idorden'])->where('codigobarra',$pieza)->where('no_embarque',$embarque)->get(['idorden','idetiqueta']);

                Etiqueta::where('idetiqueta', $rsVEtiqueta[0]['idetiqueta'])->update([
                    'estado'=>'CONFIRMADO'
                ]);
                DB::select("CALL verificaStatusOrden(".$rsOE[0]['idorden'].")");
            }

            return response()->json([
                'success' => 'true',
                'message'=>'Done'
            ]);
        }
    }

    public function moveRequest(Request $request){

        global $operacion;

        DB::beginTransaction();
        try{
            if ($request->isMethod('post')){

                foreach($request->datos as $dato){

                    $lastEmb = Embarque::where('no_embarque',$request->beforeEmbarque)->get('idembarque');
                    $newEmb = Embarque::where('no_embarque',$request->afterEmbarque)->get('idembarque');
                    $operacion = Ordene::where('idembarque',$lastEmb[0]['idembarque'])->where('no_orden',$dato['noorden'])->update([
                        'idembarque'=> $newEmb[0]['idembarque']
                    ]);
                }
                //  dd($operacion);
                if($operacion == 1){
                    DB::commit();
                    return response()->json([
                        'success' => 'true',
                        'message'=>'Las solicitudes seleccionadas han sido trasladadas a otro embarque',
                    ]);
                }
                else{
                    Db::rollBack();
                    $error = "Error, Contactar a su administrador, Error de inconsistencia";
                    return response()->json([
                        'success' => 'false',
                        'message'=>''.$error.''
                    ]);
                }
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

    public function listaOrdenes(Request $request)
    {
        if ($request->isMethod('post')){
            $embarque = $request->input("embarque");
            $nodoc = $request->input("nodoc");
            $estadof = $request->input("estadof");
            $estadoo = $request->input("estadoo");

            $jsondata=array();
            //
            $jsondata['data'] = Vlistadoordene::where('embarque',$embarque)->doc($nodoc)->estadof($estadof)->estadoo($estadoo)->get()->all();
            $jsondata['ctdfacturada'] = Vlistadoordene::where('embarque',$embarque)->where('nofactura','!=',null)->doc($nodoc)->estadof($estadof)->estadoo($estadoo)->count();
            $jsondata['ctdPdtefactura'] = Vlistadoordene::where('embarque',$embarque)->where('nofactura','=',null)->doc($nodoc)->estadof($estadof)->estadoo($estadoo)->count();

            if($jsondata['data'] == null){
                $jsondata['success'] = false;
                $jsondata['message'] = 'Request made';
                $jsondata['cantidad']= 0;
                echo json_encode($jsondata);

            }
            else{
                $jsondata['success'] = true;
                $jsondata['message'] = 'Request made';
                $jsondata['cantidad']= count($jsondata['data']);
                echo json_encode($jsondata);

            }
        }
    }
}
