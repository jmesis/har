<?php

namespace App\Http\Controllers;

use App\Exports\AwbExcel;
use App\Exports\MftoExport;
use App\Exports\MftoExporta;
use App\Exports\MftoExportf;
use App\Exports\OrdenExportExcel;
use App\Models\Vlistadofactura;
use App\Models\Vlistadoordene;
use Illuminate\Http\Request;
use App\Models\Vmanifiesto;
use App\Models\VtempMfto;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as WriterXlsx;

class ExportController extends Controller
{
    public function export($id){
        $emb =$id;
        $File="mfto_".$emb;

        $mfto=Vmanifiesto::where('embarque', '=', $emb)
            ->orderBy("operacion")
            ->get();

        $export = new MftoExport($mfto);
        return Excel::download($export, $File.'.xlsx');
    }

    public function exporta($id){
        $emb=$id;
        /*$File="mfto_".$emb;*/

        $mfto=VtempMfto::where('embarque', '=', $emb)
            ->orderBy("operacion")
            ->get();

        $cantbultos=VtempMfto::where('embarque', '=', $emb)
            ->sum('bultos');

        $canthouse=VtempMfto::where('embarque', '=', $emb)
            ->count();

        $totalpersonas=VtempMfto::distinct('destinatario')->where('embarque', '=', $emb)
        ->count();

        $file="mfto_".$mfto[0]['mawb'];
        $export = new MftoExporta($mfto,$cantbultos,$canthouse,$totalpersonas);
        return Excel::download($export, $file.'.xlsx');
    }

    public function exportFactura($embarque,$fechadesde,$fechahasta,$nfactura,$estado,$concepto){
        $fecha = substr(Carbon::now(),0,10);
        $File="listadofactura_".$fecha;
        $nofactura="";

        if($nfactura == "SN"){
            $nofactura=$nofactura;
        }
        else{
            $nofactura=$nfactura;
        }

        if($estado != 'TODOS' && $estado == 'EMITIDA'){
            $rs = Vlistadofactura::where('emitida','>=',$fechadesde)->where('emitida','<=',$fechahasta)->nofacturas($nofactura)->estados($estado)->conceptos($concepto)->embarques($embarque)->get()->all();
            $rsCountEmitida= Vlistadofactura::where('emitida','>=',$fechadesde)->where('emitida','<=',$fechahasta)->where('estado','EMITIDA')->nofacturas($nofactura)->conceptos($concepto)->embarques($embarque)->count();
            $rsTotalFactura= Vlistadofactura::where('emitida','>=',$fechadesde)->where('emitida','<=',$fechahasta)->where('estado','EMITIDA')->nofacturas($nofactura)->conceptos($concepto)->embarques($embarque)->sum('total');
            $rsCountCancelada= 0;
        }
        else if($estado != 'TODOS' && $estado == 'CANCELADA'){
            $rs = Vlistadofactura::where('emitida','>=',$fechadesde)->where('emitida','<=',$fechahasta)->nofacturas($nofactura)->estados($estado)->conceptos($concepto)->embarques($embarque)->get()->all();
            $rsCountEmitida= 0;
            $rsTotalFactura= Vlistadofactura::where('emitida','>=',$fechadesde)->where('emitida','<=',$fechahasta)->where('estado','EMITIDA')->nofacturas($nofactura)->conceptos($concepto)->embarques($embarque)->sum('total');
            $rsCountCancelada= Vlistadofactura::where('emitida','>=',$fechadesde)->where('emitida','<=',$fechahasta)->where('estado','CANCELADA')->nofacturas($nofactura)->conceptos($concepto)->embarques($embarque)->count();
        }
        else{
            $rs = Vlistadofactura::where('emitida','>=',$fechadesde)->where('emitida','<=',$fechahasta)->nofacturas($nofactura)->estados($estado)->conceptos($concepto)->embarques($embarque)->get()->all();
            $rsCountEmitida= Vlistadofactura::where('emitida','>=',$fechadesde)->where('emitida','<=',$fechahasta)->where('estado','EMITIDA')->nofacturas($nofactura)->conceptos($concepto)->embarques($embarque)->count();
            $rsTotalFactura= Vlistadofactura::where('emitida','>=',$fechadesde)->where('emitida','<=',$fechahasta)->where('estado','EMITIDA')->nofacturas($nofactura)->conceptos($concepto)->embarques($embarque)->sum('total');
            $rsCountCancelada= Vlistadofactura::where('emitida','>=',$fechadesde)->where('emitida','<=',$fechahasta)->where('estado','CANCELADA')->nofacturas($nofactura)->conceptos($concepto)->embarques($embarque)->count();
        }

        $cantTotal=count($rs);
        $export = new MftoExportf($rs,$rsCountEmitida,$rsTotalFactura,$rsCountCancelada,$cantTotal,$embarque,$fechadesde,$fechahasta,$nfactura,$estado,$concepto);
        return Excel::download($export, $File.'.xlsx');
    }

    public function exportOrdenes($embarque,$master,$estadof,$estadoo){
        $fecha = substr(Carbon::now(),0,10);
        $File="listadoordenes_".$fecha;
        $nomaster="";

        if($master == "SN"){
            $nomaster='';
        }
        else{
            $nomaster=$master;
        }

        $rs = Vlistadoordene::where('embarque',$embarque)->doc($nomaster)->estadof($estadof)->estadoo($estadoo)->get()->all();
        $rsFacturada = Vlistadoordene::where('embarque',$embarque)->where('nofactura','!=',null)->doc($nomaster)->estadof($estadof)->estadoo($estadoo)->count();
        $rsPdtefactura = Vlistadoordene::where('embarque',$embarque)->where('nofactura','=',null)->doc($nomaster)->estadof($estadof)->estadoo($estadoo)->count();

        $cantTotal=count($rs);
        $export = new OrdenExportExcel($rs,$rsFacturada,$rsPdtefactura,$embarque,$master,$estadof,$estadoo,$cantTotal);
        return Excel::download($export, $File.'.xlsx');
    }

}
