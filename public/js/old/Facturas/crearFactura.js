$(document).ready(function(){

    var validaFormulario = $("#formFactura").validate({
        rules:{
            txtblhousefactura:"required",
            txttelffactura:"required",
            txtclientefactura:"required",
            txtdirfactura:"required",
            txttipopagofactura:"required",
            txtpreciosubtotalfact:"required",
            txtivafact:"required",
            txttotalfact:"required"
        },
        messages:{
            txtblhousefactura:"Este campo es obligatorio",
            txttelffactura:"Este campo es obligatorio",
            txtclientefactura:"Este campo es obligatorio",
            txtdirfactura:"Este campo es obligatorio",
            txttipopagofactura:"Este campo es obligatorio",
            txtpreciosubtotalfact:"Este campo es obligatorio",
            txtivafact:"Este campo es obligatorio",
            txttotalfact:"Este campo es obligatorio"
        }
    });

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btn-facturara").on("click",function(e){

        var datos=[];
        var objetos={};
        $(".table_listaitemfactura tr td").each(function(){

            var row = $(this).closest("tr")[0];
            var idcargo =  row.cells[10].innerHTML;
            datos.push({
                "idcargo"  : idcargo

            });
        });
        objetos.datos=datos;

        e.preventDefault();
        if (validaFormulario.form()){

            var noorden = $("#txtblhousefactura").val();
            var telefono = $("#txttelffactura").val();
            var cliente = $("#txtclientefactura").val();
            var direccion = $("#txtdirfactura").val();
            var fpago = $("#txttipopagofactura option:selected").val();
            var subtotal = $("#txtpreciosubtotalfact").val();
            var iva = $("#txtivafact").val();
            var ivavalor = $("#txtivavalor").val();
            var total = $("#txttotalfact").val();

            var action = $("#formFactura").attr("action");
            var method = $("#formFactura").attr("method");

            $.ajax({
                type:method,
                url:action,
                data:{
                    noorden: noorden,
                    telefono: telefono,
                    cliente: cliente,
                    direccion: direccion,
                    fpago: fpago,
                    subtotal: subtotal,
                    iva:iva,
                    ivavalor:ivavalor,
                    total: total,
                    datos:objetos.datos
                },
                success:function(data){
                    if(data.success=="true"){
                        $("#msgsession").attr("hidden",true);
                        var message=data.message;
                        var title="Success!!!";
                        var error ='';
                        var reload = false
                        var window = "informacion";
                        showMessage(message,error,title,reload,window);

                        $.ajax({
                            type:"POST",
                            url:"tofacturas",
                            data:{
                                identificador:"carganofactura",
                                noorden: noorden
                            },
                            success:function(response){
                                $(".table_listaitemfacturaBody tr").remove();
                                $(".table_listaNofacturaBody tr").remove();
                                var jsonResults = JSON.parse(response);
                                if(jsonResults.success == true){
                                    $.each(jsonResults.data, function( index, response ){
                                        agregarFilaFacturas(response.nofactura);
                                    });

                                    $("#formFactura").trigger("reset");
                                    $("#txtctdadfactura").attr("disabled", true);
                                    $("#txttelffactura").attr("disabled",true);
                                    $("#txtclientefactura").attr("disabled",true);
                                    $("#txtdirfactura").attr("disabled",true);
                                    $("#txttipopagofactura").attr("disabled",true);
                                    $("#resetVtotal").attr("disabled",true);
                                    $("#btn-facturara").attr("disabled",true);
                                    $("#btnEditFactura").attr("disabled",true);
                                    $("#btnCancelFactura").attr("disabled",true);
                                    $("#txtblhousefactura").val(noorden);
                                    $("#txtclientefactura").val(cliente);
                                    $("#nofact").html("");
                                    $("#festadovalor").html("");
                                    $("#fcancelado").html("");
                                    $("#festadovalor").removeClass("bg-danger");
                                    $("#festadovalor").removeClass("text-white");
                                    $("#festadovalor").addClass("bg-secondary");
                                    $("#festadovalor").addClass("text-black-50");
                                    $("#txtdirfactura").val("");
                                    $("#txttelffactura").val("");
                                }
                            }
                        });
                    }
                    else{
                        var sms = data.message;
                        $(".msgsession").attr("hidden",false);
                        $(".msg").html(sms).fadeOut(8000);
                    }
                },
                error:function(){
                    var sms = "Error, por favor contactar su Administrador de sistema";
                    $(".msgsession").attr("hidden",false);
                    $(".msg").html(sms).fadeOut(8000);
                }
            })

        }
    })
})

