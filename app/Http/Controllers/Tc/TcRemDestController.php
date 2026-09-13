<?php

namespace App\Http\Controllers\Tc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ordene;
use App\Models\TcCp;
use App\Models\TcProvMcpio;
use Illuminate\Support\Facades\DB;
use App\Models\TcRemDest;
use App\Models\Vremdest;
use Exception;

class TcRemDestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tcremdest = Vremdest::orderBy('idremdest','Asc')->get();
        return view('tc._tcremdest',compact('tcremdest'));
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
        $fields=request()->validate([
            // 'ci'=>'required',
            'nombre'=>'required',
            'apellidop'=>'required',
            'apellidom'=>'required',
            'nacionalidad'=>'required',
            'telefono'=>'required',
            'calle'=>'required',
            'no_calle'=>'required',
            'entrecalle'=>'required',
            'provincia'=>'required',
            'municipio'=>'required',
            'cp' =>'required'
        ]);
        DB::beginTransaction();
        try{

            $idprovmcpio = TcProvMcpio::where('provincia',$fields['provincia'])->where('municipio',$fields['municipio'])->get()->last();
            $idcp = TcCp::where('cp',$request['cp'])->get('idcp')->last();
            $apto = "-";

            if($request['apto'] !=''){
                $apto=$request['apto'];
            }
            else{
                $apto;
            }

            $tcremdest=TcRemDest::create([
                'idprovmcpio'=>$idprovmcpio['idprovmcpio'],
                'idcp'=>$idcp['idcp'],
                'ci'=>$request['ci'],
                'nopasaporte'=>strtoupper($request['pasaporte']),
                'nombre'=>strtoupper($fields['nombre']),
                'apellidop'=>strtoupper($fields['apellidop']),
                'apellidom'=>strtoupper($fields['apellidom']),
                'nacionalidad'=>strtoupper($fields['nacionalidad']),
                'telefono'=>strtoupper($fields['telefono']),
                'calle'=>strtoupper($fields['calle']),
                'no_calle'=>$fields['no_calle'],
                'entrecalle'=>strtoupper($fields['entrecalle']),
                'apto'=>$apto,
                'email' => strtoupper($request['email']),
            ]);

            if($tcremdest){

                DB::commit();
                return response()->json([
                    'success' => 'true',
                    'message'=>'Los datos han sido guardado correctamente'
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
    public function update(Request $request, $id)
    {
        $fields=request()->validate([
            // 'ci'=>'required',
            'nombre'=>'required',
            'apellidop'=>'required',
            'apellidom'=>'required',
            'nacionalidad'=>'required',
            'telefono'=>'required',
            'calle'=>'required',
            'no_calle'=>'required',
            'entrecalle'=>'required',
            'provincia'=>'required',
            'municipio'=>'required',
            'cp'=>'required'
        ]);

        DB::beginTransaction();
        try{

            $apto = "-";
            if($request['apto'] !=''){
                $apto=$request['apto'];
            }
            else{
                $apto;
            }

            $idprovmcpio = TcProvMcpio::where('provincia',$fields['provincia'])->where('municipio',$fields['municipio'])->get('idprovmcpio')->last();
            $idcp = TcCp::where('cp',$request['cp'])->get('idcp')->last();
            // dd($idprovmcpio['idprovmcpio']);

            $tcremdest=TcRemDest::where('idremdest',$id)->update([
                'idprovmcpio'=>$idprovmcpio['idprovmcpio'],
                'idcp' => $idcp['idcp'],
                'ci'=>$request['ci'],
                'nopasaporte'=>strtoupper($request['pasaporte']),
                'nombre'=>strtoupper($fields['nombre']),
                'apellidop'=>strtoupper($fields['apellidop']),
                'apellidom'=>strtoupper($fields['apellidom']),
                'nacionalidad'=>strtoupper($fields['nacionalidad']),
                'telefono'=>$fields['telefono'],
                'calle'=>strtoupper($fields['calle']),
                'no_calle'=>strtoupper($fields['no_calle']),
                'entrecalle'=>strtoupper($fields['entrecalle']),
                'apto'=>$apto,
                'email' => strtoupper($request['email'])
            ]);

            if($tcremdest){

                DB::commit();
                return response()->json([
                    'success' => 'true',
                    'message'=>'Los datos han sido actualizado correctamente'
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente_orden = Ordene::where('idremdest',$id)->get('idorden');

        DB::beginTransaction();
        try{
            if($cliente_orden->isEmpty()){
                TcRemDest::where('idremdest',$id)->delete();
                DB::commit();
                return response()->json([
                    'success' => 'true',
                    'message'=>'Los datos han sido eliminados correctamente'
                ]);
            }
            else{
                return response()->json([
                    'success' => 'false',
                    'message'=>'Este cliente tiene ordenes presentadas.  No se puede eliminar'
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

    public function getCI(Request $request){

        if($request->ajax()){
            $remdest=Vremdest::where('ci',$request->param)->get()->last();
            return response()->json($remdest);
        }
    }


}
