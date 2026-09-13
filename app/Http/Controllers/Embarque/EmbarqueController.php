<?php

namespace App\Http\Controllers\Embarque;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Embarque;
use App\Models\TcContainer;
use App\Models\TcCliente;
use App\Models\TcOrigen;
use App\Models\TcTipoemb;
use App\Models\TcBuque;
use App\Models\TcViaje;
use App\Models\Vembarque;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Exception;

class EmbarqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vembarques=Vembarque::orderBy('fecha_est','Asc')->get();
        return view('embarques.panelembarques', compact('vembarques'));
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
        global $resultado;

        $fields = request()->validate([
            'origen'=>'required',
            'embarcador'=>'required',
            'consignado'=>'required',
            'tipoemb'=>'required'
        ]);

        
        $idorigen = TcOrigen::where('origen',$fields['origen'])->get(['idorigen','codigo'])->last();
        $idtipoemb = TcTipoemb::where('tipoembarque',$fields['tipoemb'])->get(['idtipoemb','codigo'])->last();
        $idconsignado = TcCliente::where('nombre',$fields['consignado'])->get('idcliente')->last();
        $idembarcador = TcCliente::where('nombre',$fields['embarcador'])->get('idcliente')->last();
        
        if($idorigen != '' && $idtipoemb != '' && $idconsignado != '' && $idembarcador !=''){

            $year = substr(Carbon::now('Y'),2,2);
            $yeardb=substr(Carbon::now('Y'),0,4);
            $noseq = Embarque::where('origen',$idorigen['codigo'])->where('tipoembarque',$idtipoemb['codigo'])->where('anno',$yeardb)->get('noseq')->last();
            
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

                $embarque=Embarque::create([
                    'idembarcador'=>$idembarcador['idcliente'],
                    'idconsignado'=>$idconsignado['idcliente'],
                    'origen' =>$idorigen['codigo'],
                    'tipoembarque' => $idtipoemb['codigo'],
                    'anno'=>$yeardb,
                    'noseq'=>$resultado,
                    'no_embarque'=>$idorigen['codigo'].$idtipoemb['codigo'].$year."-".$consecutivo,
                    'mguia_bl' =>$request['noembarque'],
                    'estado' => 'EN PROCESO'
                ]);

                if($embarque){
                    DB::commit();
                    return response()->json([
                        'success' => 'true',
                        'message'=>'El Embarque ha sido creado'
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
        //
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
    public function update(Request $request, $idembarque)
    {
        global $noembarque,$estado,$cont;

        $fields = request()->validate([
            'buque'=>'required',
            'origen'=>'required',
            'embarcador'=>'required',
            'consignado'=>'required',
            'tipoemb'=>'required',
            'viaje'=>'required',
            'idpol'=>'required',
            'idpod'=>'required'
        ]);

        $idTablaEmbarque = Embarque::where('no_embarque',$idembarque)->get('idembarque')->last();
        $idbuque=TcBuque::where('buque',$fields['buque'])->get('idbuque')->last();
        $idviaje=TcViaje::where('viaje',$fields['viaje'])->where('idbuque',$idbuque['idbuque'])->get('idviaje')->last();
        $idpol=$fields['idpol'];
        $idpod=$fields['idpod'];
        $idcont=TcContainer::where('type',substr($request['tipocont'],0,4))->get('idcontainer')->last();
        $idembarcador = TcCliente::where('nombre',$fields['embarcador'])->get('idcliente')->last();
        $idconsignado = TcCliente::where('nombre',$fields['consignado'])->get('idcliente')->last();
        $idorigen = TcOrigen::where('origen',$fields['origen'])->get(['idorigen','codigo'])->last();
        $idtipoemb = TcTipoemb::where('tipoembarque',$fields['tipoemb'])->get(['idtipoemb','codigo'])->last();
        $origen_tipoemb=substr($idembarque, 0, 5);

       if($idTablaEmbarque != '' && $idbuque != '' && $idviaje != '' && $idpol != '' && $idpod != '' && $idembarcador != '' && $idconsignado != '' && $idorigen != '' && $idtipoemb != ''){

            if($origen_tipoemb == $idorigen['codigo'].$idtipoemb['codigo']){
                $noembarque=$idembarque;
            }
            else{
                $year = substr(Carbon::now('Y'),0,4);
                $noseq = Embarque::where('origen',$idorigen['codigo'])->where('tipoembarque',$idtipoemb['codigo'])->where('anno',$year)->get('noseq')->last();

                if($noseq == ''){
                    $valor = 1;
                    $consecutivo = str_pad($valor, 4, '0', STR_PAD_LEFT);
                    $noembarque=$idorigen['codigo'].$idtipoemb['codigo'].$year."-".$consecutivo;
                }
                else{
                    $valor=$noseq['noseq']+1;
                    $consecutivo = str_pad($valor, 4, '0', STR_PAD_LEFT);
                    $noembarque=$idorigen['codigo'].$idtipoemb['codigo'].$year."-".$consecutivo;
                }
            }
            $yearEmbarque = substr($noembarque,5,2);
            $noseqEmbarque = substr($noembarque,10,4);
            $yeardb=substr(Carbon::now('Y'),0,4);

            DB::beginTransaction();
            try{
                if($request['mfto'] != ''){
                    $estado = "CONFIRMADO";
                }
                else{
                    $estado="EN PROCESO";
                }

                if($idcont == null){
                    $cont=null;
                }
                else{
                    $cont=$idcont['idcontainer'];
                }

                $embarque = Embarque::where('idembarque',$idTablaEmbarque['idembarque'])->update([
                    'idbuque' => $idbuque['idbuque'],
                    'idviaje' => $idviaje['idviaje'],
                    'idpol' => $idpol,
                    'idpod' => $idpod,
                    'idcontainer' => $cont,
                    'idembarcador' => $idembarcador['idcliente'],
                    'idconsignado'=> $idconsignado['idcliente'],
                    'idnaviera' => $request['idnaviera'],
                    'nomfto' => $request['mfto'],
                    'mguia_bl' =>$request['nodoc'],
                    'no_embarque' => $noembarque,
                    'origen' => $idorigen['codigo'],
                    'tipoembarque'=> $idtipoemb['codigo'],
                    'anno'=> $yeardb,
                    'noseq' => $noseqEmbarque,
                    'fecha_est' => $request['fechaest'],
                    'contenedor'=> strtoupper("".$request['cont'].""),
                    'estado' => $estado,
                ]);
                
                
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
                    // 'message'=>''.$error.''
                    'message'=>'Ha ocurrido un error. Contactar a su administrador'
                ]);

            }
        }
        else{
            Db::rollBack();
            $error = "Hay un error. Por favor contactar su administrador";
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
    public function destroy($id)
    {
        //
    }

    public function checkContainer(Request $request)
    {
        $resultado = checkContainers($request['cont']);
        if($resultado == true){
            return response()->json([
                'success' => 'true',
                'message'=>'El numero de contenedor es correcto'
            ]);
        }
    }

    public function getNoEmbarque(Request $request){
        try {
            $embarques = Vembarque::where('anno',$request['anno'])->orderBy('no_embarque','Asc')->get('no_embarque');
            $embarquesArray['']='';
            foreach($embarques as $vembarque){
                $embarquesArray[$vembarque->no_embarque]=$vembarque->no_embarque;
            }
            // return $embarquesArray;
            $response = ['data' => $embarquesArray];
        }
        catch (\Exception $exception) {
            return response()->json([ 'message' => 'Hubo un error obteniendo los embarques' ], 500);
        }
        return response()->json($response);
    }
}
