<?php

namespace App\Http\Controllers\BL;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vawb;
use App\Models\Vbl;
use App\Models\Vle;
use App\Models\VordenToEmbarque;
use Barryvdh\DomPDF\Facade as PDF;


class BlController extends Controller
{
    //

    public function index(){

        return view('documentacion.panelDocumentacion');
    }

    public function getSolicitudes(Request $request){

        if ($request->isMethod('post')){

            $jsondata=array();
            if($request->tipo_emb=="EM"){
                $jsondata['data'] = Vbl::where('no_embarque','=',$request->noembarque)->get(['noblhouse','shipper','consignee']);
            }
            else{
                $jsondata['data'] = Vawb::where('no_embarque','=',$request->noembarque)->get(['hawb','mawb','aeronave','vuelo','shipper','consignee','descripcion']);
            }

            if($jsondata['data'] == null){
                $jsondata['success'] = false;
                $jsondata['message'] = 'Request made';
                echo json_encode($jsondata);

            }
            else{
                $jsondata['success'] = true;
                $jsondata['message'] = 'Request made';
                echo json_encode($jsondata);

            }
        }
    }

    public function generaBlPdf(Request $request){
        $cadena = explode("+", $request->param);
        $tipobl = "";
        if($cadena[1] == "undefined"){
            $tipobl="COPY";
        }
        else{
            $tipobl = "ORIGINAL";
        }

        // $bls=Vbl::where('noblhouse',$request->param)->get();
        $bls=Vbl::where('noblhouse',$cadena[0])->get();
        $pdf = PDF::loadView('documentacion.bl_newtest',compact(['bls','tipobl']));

        $path = public_path('/pdf');
        $fileName =  $bls[0]->noblhouse.'.pdf' ;

        $pdf->save($path . '/' . $fileName);
        $pdf = public_path('pdf/'.$fileName);

        // $pdf->download($pdf);

        return response()->json([
            'success' => 'false',
            'message'=>'descargado',
            'data' => $bls[0]->noblhouse
        ]);
    }

    public function generaGuiaPdf(Request $request){
        $awbs=[];
        $embarque="";
        foreach($request->param as $dato){
            // print($dato['nodoc']."****");
            $awbarr=Vawb::where('hawb',$dato['nodoc'])->get();
            $embarque=$awbarr[0]->no_embarque;
            array_push($awbs,$awbarr);
        }
        $pdf = PDF::loadView('documentacion.awb',compact('awbs'))->setPaper('letter');
        $path = public_path('/pdf');
        $fileName =  $embarque.'.pdf' ;

        $pdf->save($path . '/' . $fileName);
        $pdf = public_path('pdf/'.$fileName);

        return response()->json([
            'success' => 'false',
            'message'=>'descargado',
            'data' => $embarque,
            'arreglo'=>$awbs
        ]);
    }

    //genera Lista de Empaque
    public function generaLEPdf(Request $request){
        $les=[];
        $nombre="";
        $house="";
        $ci="";
        $telefono="";
        $direccion="";
        $contenedor="";
        // foreach($request->param as $dato){
            $learr=Vle::where('house',$request['param'])->get();
            $nombre=$learr[0]['consignee'];
            $house=$learr[0]['house'];
            $ci=$learr[0]['ci'];
            $telefono=$learr[0]['telefono'];
            $direccion=$learr[0]['direccion'];
            $contenedor=$learr[0]['contenedor'];
            array_push($les,$learr);
        // }
        
        $pdf = PDF::loadView('documentacion.le_4',compact(['les','nombre','house','ci','telefono','direccion','contenedor']))->setPaper('letter');
        $path = public_path('/le');
        $fileName =  'Listaempaque.pdf' ;

        $pdf->save($path . '/' . $fileName);
        $pdf = public_path('le/'.$fileName);

        return response()->json([
            'success' => 'false',
            'message'=>'descargado',
        ]);
    }
}
