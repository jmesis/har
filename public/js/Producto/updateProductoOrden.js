$(document).ready(function(){

    var validaFormulario = $(".formProducto").validate({
        rules:{
            txtproducto:"required",
            txtarticulo:"required",
            txtcategoria:"required",
            txtumedida:"required",

            txtcantidad:{
                required:true,
                digits:true
            },
            txtmcubico:{
                required:true,
                number:true
            },
            txtmcubicokg:{
                required:true,
                number:true
            },
            txtvaduana:{
                required:true,
                number:true
            },
            txtpesokg:{
                required:true,
                number:true
            },
            txtlargom3:{
                required:true,
                number:true
            },
            txtaltom3:{
                required:true,
                number:true
            },
            txtanchom3:{
                required:true,
                number:true
            }
        },
        messages:{
            txtproducto:"Este campo es obligatorio",
            txtarticulo:"Este campo es obligatorio",
            txtcategoria:"Este campo es obligatorio",
            txtumedida:"Este campo es obligatorio",
            txtcantidad:{
                required:"Este campo es obligatorio",
                digits:"Este campo solo permite numeros"
            },
            txtmcubico:{
                required:"Este campo es obligatorio",
                number:"Este campo solo permite numeros"
            },
            txtmcubicokg:{
                required:"Este campo es obligatorio",
                digits:"Este campo solo permite numeros"
            },
            txtvaduana:{
                required:"Este campo es obligatorio",
                number:"Este campo solo permite numeros Ej: 25.320"
            },
            txtpesokg:{
                required:"Este campo es obligatorio",
                number:"Este campo solo permite numeros Ej: 25.320"
            },
            txtlargom3:{
                required:"Este campo es obligatorio",
                number:"Este campo solo permite numeros Ej: 25.320"
            },
            txtaltom3:{
                required:"Este campo es obligatorio",
                number:"Este campo solo permite numeros Ej: 25.320"
            },
            txtanchom3:{
                required:"Este campo es obligatorio",
                number:"Este campo solo permite numeros Ej: 25.320"
            }
        }
    });

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btn-updateProducto").on("click", function(e){
        e.preventDefault();

        if (validaFormulario.form()){

            var idproducto = $("#txtidproducto").val();
            var noproducto = $("#txtproductono").val();
            var noorden = $("#txtnoorden_prod_nuevo").val();

            var producto =  $("#txtproducto").val();
            var articulo = $("#txtarticulo").val();
            var categoria = $("#txtcategoria").val();
            var um = $("#txtumedida").val();
            var cantidad = $("#txtcantidad").val();
            var mcubico = $("#txtmcubico").val();
            var pesovolumen = $("#txtmcubicokg").val();
            var largo = $("#txtlargom3").val();
            var alto = $("#txtaltom3").val();
            var ancho = $("#txtanchom3").val();
            var vaduana = $("#txtvaduana").val();
            var pesokg;
            var embarque = $("#idembarque").val();
            var ow = $("input:checkbox[name=ow]:checked").val();

            if(producto == "MISCELANEA (1.5)"){
                pesokg=(cantidad*1.50);
            }
            else{
                pesokg=$("#txtpesokg").val();
            }

            var action = $("#urlactualizadatosprod").attr("href");
            var method = 'PATCH';
            var url = action+"/"+idproducto;

            $.ajax({
                type:method,
                url:url,
                data:{
                    producto:producto,
                    articulo:articulo,
                    categoria:categoria,
                    um:um,
                    cantidad:cantidad,
                    mcubico:mcubico,
                    pvolumen:pesovolumen,
                    largo:largo,
                    alto:alto,
                    ancho:ancho,
                    vaduana:vaduana,
                    pesokg:pesokg,
                    noorden:noorden,
                    noproducto:noproducto,
                    embarque:embarque,
                    ow:ow
                },
                success:function(data){
                    if(data.success=="true"){
                        $("#msgsession").attr("hidden",true);
                        $("#txtproducto").val('');
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
                        $("#ow").prop("checked", false);

                        $.ajax({
                            method:"POST",
                            url: "listaproductodetalle",
                            data: {
                                noproducto:noproducto
                            },
                            success:function(response){

                                $(".tablanewprodBody tr").remove();
                                var jsonResults = JSON.parse(response);
                                $.each(jsonResults.data, function( index, response ){
                                    agregarFilaProdudcto(response.noproducto, response.descripcion, response.capitulo, response.articulo, response.um, response.cantidad, response.mcubico, response.mcubicototal, response.vaduana, response.vaduanatotal, response.pesokg, response.pesototal,response.idproducto,response.largo,response.alto,response.ancho,response.pesovolumen,response.ow);
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

                                $(".table-listadoProductosBody tr").remove();
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
                },
                error:function(){
                    var message = "Error, por favor contactar su Administrador de sistema";
                    var title="Error!!!";
                    var error ='';
                    var reload = false
                    var win="error"
                    showMessage(message,error,title,reload,win);
                }
            })
        }
    });
});
