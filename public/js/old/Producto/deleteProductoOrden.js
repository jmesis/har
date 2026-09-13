

$(".tablanewprod tbody").on("click", ".btn-deleteprod", function(e){
    e.preventDefault();
    var row = $(this).parents('tr');

    var fila = row.attr('id');
    var message="Se eliminara el producto "+row.data('categoria')+".  Estas Seguro?";
    var title="Atencion";
    showMessageDelete(message,title);

    var idproducto = row.data('idproducto');
    var noproducto = $("#txtproductono").val();
    var noorden = $("#txtnoorden_prod_nuevo").val();
    var action = $("#urldeletedatosprod");

    var action = action.attr("href");
    var method = 'DELETE';
    var url = action+"/"+idproducto;

    $("#modalDeleteYes").on("click", function(){

        $.ajax({
            type:method,
            url:url,
            data:{
                noorden:noorden,
                producto:idproducto
            },
            success:function(data){
                if(data.success=="true"){

                    $("#txtproducto").prop('selectedIndex',0);
                    $("#txtproducto option:selected").text('');
                    $("#txtproducto option:selected").val('');
                    $("#txtarticulo").val('');
                    $("#txtcategoria").val('');
                    $("#txtumedida").val('');
                    $("#txtcantidad").val('');
                    $("#txtmcubico").val('');
                    $("#txtmcubicokg").val('');
                    $("#txtlargom3").val('');
                    $("#txtaltom3").val('');
                    $("#txtanchom3").val('');
                    $("#txtvaduana").val('');
                    $("#txtpesokg").val('');
                    $("#btn-saveProducto").removeAttr("hidden");
                    $("#btn-updateProducto").attr("hidden", true);

                    $.ajax({
                        method:"POST",
                        url: "listaproductodetalle",
                        data: {
                            noproducto:noproducto
                        },
                        success:function(response){
                            $(".tablanewprodBody tr").remove();
                            $(".table-listadoProductosBody tr").remove();
                            var jsonResults = JSON.parse(response);
                            $.each(jsonResults.data, function( index, response ){
                                agregarFilaProdudcto(response.noproducto, response.producto, response.articulo, response.categoria, response.um, response.cantidad, response.mcubico, response.vaduana, response.pesokg,response.idproducto,response.largo,response.alto,response.ancho,response.pesovolumen);
                            });
                        }
                    });

                    $.ajax({
                        method:"POST",
                        url: "listaproductoorden",
                        data:{
                            noorden: noorden
                        },
                        success:function(response){
                            var jsonResults = JSON.parse(response);
                            $.each(jsonResults.data, function( index, response ){
                                agregarFilaProdOrden(response.noproducto,response.cantidad,response.mcubico,response.vaduana,response.pesokg);
                            });
                        }
                    });
                }
                else{
                    var message = data.message;
                    var title="Error!!!";
                    var error ='';
                    var reload = false
                    var win="error"
                    showMessage(message,error,title,reload,win);
                }
            }
            // error:function(){
            //     console.log("por que entra aqui???");
            //     var sms = "Error, por favor contactar su Administrador de sistema";
            //     $(".msgsession").attr("hidden",false);
            //     $(".msg").html(sms)/*.fadeOut(1000)*/;
            // }
        })
    })
})
