<?php

namespace App\Http\Controllers\Tc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TcRemitter;
use App\Models\Vremdest;
use App\Models\VRemitter;
use App\Models\Vreceiver;
use App\Models\VremittersReceiver;
use Illuminate\Support\Facades\DB;
USE Exception;

class TcRemitterController extends Controller
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
        $fields=request()->validate([
            'number'=>'required',
            'nombre'=>'required',
            'apellidop'=>'required',
            'apellidom'=>'required',
            'telefono'=>'required',
            'dir'=>'required',
            'email'=>'required'
        ]);
        DB::beginTransaction();
        try{
            $tcremdest=TcRemitter::create([
                'number'=>$fields['number'],
                'name'=>strtoupper($fields['nombre']),
                'lastnamep'=>strtoupper($fields['apellidop']),
                'lastnamem'=>strtoupper($fields['apellidom']),
                'address'=>strtoupper($fields['dir']),
                'phone'=>$fields['telefono'],
                'email' => $fields['email']
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
        //
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

    public function getID(Request $request){
        if($request->ajax()){
            $remitter=VRemitter::where('number',$request->param)->get()->last();
            return response()->json($remitter);
        }
    }

    public function getListRemitter(Request $request){
            
        if($request->ajax()){
            $jsondata=array();
            if($request['tipoenvio']=='ENA' || $request['tipoenvio']=='MNJ'){
                $jsondata['data'] = Vreceiver::get()->all();
            }
            else{
                $jsondata['data'] = VremittersReceiver::get()->all();
            }
            

            $jsondata['success'] = true;
            $jsondata['message'] = 'Request made';
            echo json_encode($jsondata);
        }
    }
}
