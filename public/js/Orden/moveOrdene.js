
$(document).ready(function(){

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btnTransferOrden").on("click",function(e){
        e.preventDefault();
        var noembarque_old = $.trim($("#txtembarqueconf option:selected").text());
        var noembarque_new = $.trim($("#txtembarquenuevo option:selected").text());

        moverOrdenes(noembarque_old,noembarque_new);

    });

    //abre modal para mover ordenes desde nuevas solicitudes
    $(".btnMoveOrden").on("click", function(){

        $("#m-moverorden").modal({backdrop: 'static'});
        var datos=[];
        var objetos={};
        $("#tableordenesBody tr td input[type='checkbox']:checked").each(function(){

            var row = $(this).closest("tr")[0];
            var noorden =  row.cells[1].innerHTML;
            datos.push({
                "noorden"  : noorden
            });
        });
        objetos.datos=datos;

        var noembarque_old = $.trim($("#txtnoembarque_orden option:selected").text());
        $("#txtEmbarqueActual").val(noembarque_old);

        $("#btnMoveOrdenes").on("click", function(){
            var embarquebefore =$("#txtEmbarqueActual").val();
            var embarquenew = $.trim($("#txtNuevoEmbarque option:selected").text());

            if(embarquebefore == embarquenew){
                var message = "Ambos embarques son iguales, debe seleccionar un embarque diferente para transferir";
                var title="Atencion!!!";
                var error ='';
                var reload = false
                var win="error"
                showMessage(message,error,title,reload,win);
            }
            else{
                moverOrdenes(embarquebefore,embarquenew,datos);
            }
            
        });
    });
});



function moverOrdenes(param1,param2,datos){

    var method = "POST";
    $.ajax({
        type:method,
        url:"muevesolicitud",
        data:{
            beforeEmbarque:param1,
            afterEmbarque:param2,
            datos:datos
        },
        success:function(data){
            if(data.success=="true"){
                var noembarque = param1;
                showOrdenes(noembarque);

                var message = data.message;
                var title="Informacion!!!";
                var error ='';
                var reload = false
                var win="informacion"
                showMessage(message,error,title,reload,win);
                $("#m-moverorden").modal('hide');
            }
            else{
                var message = data.message;
                var title="Atencion!!!";
                var error ='';
                var reload = false
                var win="error"
                showMessage(message,error,title,reload,win);
            }
        },
        error:function(){
            var message = "Error, por favor contactar su Administrador de sistema";
            var title="Error!!!";
            var error ='';
            var reload = false
            var win="error"
            showMessage(message,error,title,reload,win);
        }
    });
}

