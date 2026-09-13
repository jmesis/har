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
                digits:true
            },
            txtvaduana:{
                required:true,
                number:true
            },
            txtpesokg:{
                required:true,
                number:true
            },
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
                digits:"Este campo solo permite numeros"
            },
            txtvaduana:{
                required:"Este campo es obligatorio",
                number:"Este campo solo permite numeros Ej: 25.320"
            },
            txtpesokg:{
                required:"Este campo es obligatorio",
                number:"Este campo solo permite numeros Ej: 25.320"
            }
        }
    });

    //Abre modal Productos
    $('.btnAddItemProd').on('click', function(){
        $("#mItemProd").modal({backdrop: 'static'});
    })

    //Cierra Modal Productos
    $('.btnCloseItemProd').on('click', function(){
        $("#mItemProd").modal("hide");
        $("#formmItemProd").trigger("reset");

        $("#title-mitemprod").html("Nuevo Producto");
        $("#btnUpdateItemProd").attr("hidden",true);
        $("#btn-guardaItemProd").removeAttr("hidden");
    })

    //Agregar nuevo producto
    $('.btn-nuevoproducto').on('click', function(){
        $(".orden-nuevoproducto").attr("hidden",false);
        $(".orden-datalle").attr("hidden",true);

        var orden = $("#txtnoorden_prod").val();
        var dest = $("#txtdest_prod").val();

        $("#txtnoorden_prod_nuevo").val(orden);
        $("#txtdest_prod_nuevo").val(dest);

        $.get("noproducto",{param:"1"}, function(response){
            $("#txtproductono").val(response);
        })
    })

    //Cierra nuevo producto
    $(".btncerrar-nuevoproducto").on("click", function(){

        $(".orden-nuevoproducto").attr("hidden",true);
        $(".orden-datalle").attr("hidden",false);
        $(".btn-actproducto").attr("hidden",true);
        $("#btn-guardexit").removeAttr("hidden");
        $("#btn-guardcontinuar").removeAttr("hidden");
        $(".formProducto").trigger("reset");

        $("#txtproducto option:selected").text("");
        $("#txtproducto option:selected").val("");

        $(".tablanewprodBody tr").remove();

    })

    //Cierra listado productos
    $(".btncerrar-listadoProducto").on("click", function(){
        $(".orden-datalle").attr("hidden",true);
    })

    //carga combo articulos desde el combo capitulo
    $("#txtmcapitulo").on("change", function(){
        var idcapitulo = $(this).val();

        if($.trim(idcapitulo) !=''){
            $.get("articulos",{param: idcapitulo}, function(response){
                $("#txtmarticulo").empty();
                $("#txtmarticulo").append("<option value=''></option>");

                $.each(response, function(index,value){
                    $("#txtmarticulo").append("<option value="+index+">"+value+"</option>");
                })
            })
        }
    })

    //Agrega productos a la tabla
    $("#btn-guardcontinuar").on("click", function(){
        if (validaFormulario.form()){

            var orden=$("#txtnoorden_prod_nuevo").val();
            var dest=$("#txtdest_prod_nuevo").val();
            var noproducto = $("#txtproductono").val();
            var producto = $("#txtproducto option:selected").text();
            var articulo = $("#txtarticulo").val();
            var categoria = $("#txtcategoria").val();
            var um = $("#txtumedida").val();
            var cantidad = $("#txtcantidad").val();
            var mcubico = $("#txtmcubico").val();
            var vaduana = $("#txtvaduana").val();
            var pesokg = $("#txtpesokg").val();
            var idproducto="";

            agregarFilaProdudcto(noproducto, producto, articulo, categoria, um, cantidad, mcubico, vaduana, pesokg,idproducto);
            $(".formProducto").trigger("reset");
            $("#txtproductono").val(noproducto);
            $("#txtnoorden_prod_nuevo").val(orden);
            $("#txtdest_prod_nuevo").val(dest);
            $("#txtproducto option:selected").val("");
            $("#txtproducto option:selected").text("");
        }
        else{
            var message="Por favor completar el formulario para poder continuar ";
            var title="Error!";
            var error ='';
            var reload = false
            var window="error"
            showMessage(message,error,title,reload,window);
        }
    })

    //Borra registro de la tabla de producto
    $(".tablanewprod tbody").on("click",".btn-deleteprod",function(e){
        e.preventDefault();
        var row = $(this).parents('tr');
        row.remove();
    })

    //Selecciona datos segun Producto
    $("#txtproducto").on("change", function(){
        var idproducto = $(this).val();

        var action = $("#urlgetdatosprod").attr("href");
        var method = 'GET';
        var url = action+"/"+idproducto;

        $.ajax({
            type:method,
            url:url,
            // data:{
            //     valor:idproducto
            // },
            success:function(obj, status, error){
                if(status=="success"){

                    $("#txtcategoria").val("");
                    $("#txtarticulo").val("");
                    $("#txtumedida").val("");
                    $("#txtcantidad").val("");
                    $("#txtvaduana").val("");
                    $("#txtmcubico").val("");
                    $("#txtpesokg").val("");

                    var jsonResults = JSON.parse(obj);
                    $.each(jsonResults.data , function( index, obj ) {
                        $("#txtcategoria").val(obj.capitulo);
                        $("#txtarticulo").val(obj.articulo);
                        $("#txtumedida").val(obj.um);
                        $("#txtcantidad").val(obj.cantidad);
                        $("#txtvaduana").val(obj.valor);
                        if(obj.producto=="MISCELANEA (1.5)"){
                            $("#txtpesokg").val("1.5");
                        }
                        else{
                            $("#txtpesokg").val("");
                        }
                    });
                }
            },
            error:function(obj){
                var sms = obj.message;
                $(".msgsession").removeAttr("hidden");
                $(".msg").html(sms).fadeOut( 1000 );
            }
        })

    })

    //Abre nuevo producto pero ya con los detalles de la tabla
    $(".table_listadoproducto tbody").on("dblclick",".rowtdproductoorden", function(){

        var row = $(this).parents('tr');
        var noproducto = (row.data("noproducto"));
        var orden = $("#txtnoorden_prod").val();
        var dest = $("#txtdest_prod").val();

        $(".orden-nuevoproducto").attr("hidden",false);
        $(".orden-datalle").attr("hidden",true);
        $("#txtnoorden_prod_nuevo").val(orden);
        $("#txtdest_prod_nuevo").val(dest);
        $("#txtproductono").val(noproducto);

        $(".btn-actproducto").removeAttr("hidden");
        $("#btn-guardexit").attr("hidden",true);
        $("#btn-guardcontinuar").attr("hidden", true);

        $.get("listaproductodetalle",{param: noproducto}, function(response){

            $(".tablanewprodBody tr").remove();
            var jsonResults = JSON.parse(response);
            $.each(jsonResults.data, function( index, response ){
                agregarFilaProdudcto(response.noproducto, response.producto, response.articulo, response.categoria, response.um, response.cantidad, response.mcubico, response.vaduana, response.pesokg,response.idproducto);
            })
        })
    })

    //Carga formulario de productos para editar alguno
    $(".tablanewprod tbody").on("click",".btn-editprod", function(e){
        e.preventDefault();

        var row = $(this).parents('tr');

        var producto    = (row.data("producto"));
        var articulo    = (row.data("articulo"));
        var categoria   = (row.data("categoria"));
        var um          = (row.data("um"));
        var cantidad    = (row.data("cantidad"));
        var mcubico     = (row.data("mcubico"));
        var vaduana     = (row.data("vaduana"));
        var pesokg      = (row.data("pesokg"));
        var idproducto      = (row.data("idproducto"));

        $("#txtproducto option:selected").val(producto);
        $("#txtproducto option:selected").text(producto);
        $("#txtarticulo").val(articulo);
        $("#txtcategoria").val(categoria);
        $("#txtumedida").val(um);
        $("#txtcantidad").val(cantidad);
        $("#txtmcubico").val(mcubico);
        $("#txtvaduana").val(vaduana);
        $("#txtpesokg").val(pesokg);
        $("#txtidproducto").val(idproducto);

        // row.remove();
    })

    $("#btn-actproducto").on("click", function(e){
        e.preventDefault();
        if (validaFormulario.form()){

            var idproducto = $("#txtidproducto").val();
            var noproducto = $("#txtproductono").val();
            var noorden = $("#txtnoorden_prod_nuevo").val();

            var producto = $("#txtproducto option:selected").text();
            var articulo = $("#txtarticulo").val();
            var categoria = $("#txtcategoria").val();
            var um = $("#txtumedida").val();
            var cantidad = $("#txtcantidad").val();
            var mcubico = $("#txtmcubico").val();
            var vaduana = $("#txtvaduana").val();
            var pesokg = $("#txtpesokg").val();

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
                    vaduana:vaduana,
                    pesokg:pesokg
                },
                success:function(data){
                    if(data.success=="true"){
                        $("#msgsession").attr("hidden",true);
                        var message=data.message;
                        var title="Success!!!";
                        var error ='';
                        var reload = '';
                        showMessage(message,error,title,reload);
                        $(".formProducto").trigger("reset");

                        $.get("listaproductodetalle",{param: noproducto}, function(response){

                            $(".tablanewprodBody tr").remove();
                            var jsonResults = JSON.parse(response);
                            $.each(jsonResults.data, function( index, response ){
                                agregarFilaProdudcto(response.noproducto, response.producto, response.articulo, response.categoria, response.um, response.cantidad, response.mcubico, response.vaduana, response.pesokg,response.idproducto);
                            })
                        })

                        $.get("listaproductoorden",{param: noorden}, function(response){

                            $(".table-listadoProductosBody tr").remove();
                            var jsonResults = JSON.parse(response);
                            $.each(jsonResults.data, function( index, response ){
                                agregarFilaProdOrden(response.noproducto,response.cantidad,response.mcubico,response.vaduana,response.pesokg);
                            })
                        })
                    }
                    else{
                        var sms = data.message;
                        $(".msgsession").attr("hidden",false);
                        $(".msg").html(sms)/*.fadeOut(1000)*/;
                    }
                },
                error:function(){
                    var sms = "Error, por favor contactar su Administrador de sistema";
                    $(".msgsession").attr("hidden",false);
                    $(".msg").html(sms)/*.fadeOut(1000)*/;
                }
            })
        }


    })



})

function agregarFilaProdudcto(noproducto, producto, articulo, categoria, um, cantidad, mcubico, vaduana, pesokg, idproducto) {

    var htmlTags = '<tr data-noproducto="'+noproducto+'"data-producto="'+producto+'" data-articulo="'+articulo+'" data-categoria="'+categoria+'" data-um="'+um+'" data-cantidad="'+cantidad+'" data-mcubico="'+mcubico+'" data-vaduana="'+vaduana+'" data-pesokg="'+pesokg+'" data-idproducto="'+idproducto+'">' +
           '<td class="rowtdnewproducto">' + noproducto + '</td>' +
           '<td class="rowtdnewproducto">' + producto + '</td>' +
           '<td class="rowtdnewproducto">' + articulo + '</td>' +
           '<td class="rowtdnewproducto">' + categoria + '</td>' +
           '<td class="rowtdnewproducto">' + um + '</td>' +
           '<td class="rowtdnewproducto">' + cantidad + '</td>' +
           '<td class="rowtdnewproducto">' + mcubico + '</td>' +
           '<td class="rowtdnewproducto">' + vaduana + '</td>' +
           '<td class="rowtdnewproducto">' + pesokg + '</td>' +
           '<td class="rowtdnewproducto" hidden>' + idproducto + '</td>' +
           '<td class="rowtdnewproducto"><button type="button" class="btn-deleteprod btn btn-sm btn-danger rounded ml-auto">Eliminar</button> <button type="button" class="btn-editprod btn btn-sm btn-warning rounded ml-auto">Editar</button></td>' +
           '</tr>';
    $('.tablanewprod tbody').append(htmlTags);
    $("#valorresto").val()
}
