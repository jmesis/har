<?php
    namespace App\Services;

    use App\Models\TcEntrega;

    class Entrega
    {
        public function getEntregas()
        {
            $entregas = TcEntrega::orderBy('cod_entrega','ASC')->get();
            $entregasArray['']='';
            foreach($entregas as $entrega){
                $entregasArray[$entrega->identrega]=$entrega->detalle;
            }
            return $entregasArray;
        }
    }
?>
