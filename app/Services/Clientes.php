<?php
    namespace App\Services;

    use App\Models\TcCliente;

    class Clientes
    {
        public function getClientes()
        {
            $clientes = TcCliente::where('nombre','!=','SOCIEDAD COMERCIAL H.A.R. LIMITADA')->orderBy('nombre','ASC')->get();
            $clientesArray['']='';
            foreach($clientes as $cliente){
                $clientesArray[$cliente->idcliente]=$cliente->nombre;
            }
            return $clientesArray;
        }
    }
?>
