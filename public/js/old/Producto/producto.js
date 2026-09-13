$(document).ready(function(){

    var idproducto = $("#txtidproducto");
    var noproducto = $("#txtproductono");
    var noorden = $("#txtnoorden_prod_nuevo");

    var producto = $("#txtproducto option:selected");
    var articulo = $("#txtarticulo");
    var categoria = $("#txtcategoria");
    var um = $("#txtumedida");
    var cantidad = $("#txtcantidad");
    var mcubico = $("#txtmcubico");
    var alto = $("#txtaltom3");
    var largo = $("#txtlargom3");
    var ancho = $("#txtanchom3");
    var vaduana = $("#txtvaduana");
    var pesokg = $("#txtpesokg");
    var pvolumen = $("#txtmcubicokg");

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
    });


    //Limpia Formulario
    $("#btn-clearProducto").on("click", function(){
        $("#txtproducto").prop('selectedIndex',0);
        $("#txtproducto option:selected").text('');
        $("#txtproducto option:selected").val('');
        $("#txtarticulo").val('');
        $("#txtcategoria").val('');
        $("#txtumedida").val('');
        $("#txtcantidad").val('');
        $("#txtmcubico").val('');
        $("#txtvaduana").val('');
        $("#txtpesokg").val('');
        $("#txtaltom3").val('');
        $("#txtlargom3").val('');
        $("#txtanchom3").val('');
        $("#txtmcubicokg").val('');

        $("#btn-saveProducto").removeAttr("hidden");
        $("#btn-updateProducto").attr("hidden", true);
    });

    //Agregar nuevo producto
    $('.btn-nuevoproducto').on('click', function(){
        $(".orden-nuevoproducto").attr("hidden",false);
        $(".orden-datalle").attr("hidden",true);


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
        $(".tablanewprodBody tr").remove();

        var orden = $("#txtnoorden_prod").val();
        var dest = $("#txtdest_prod").val();
        var embarque = $("#txtnoembarque_prod").val();

        $("#txtnoorden_prod_nuevo").val(orden);
        $("#txtdest_prod_nuevo").val(dest);
        $("#idembarque").val(embarque);

        $.get("noproducto",{param:"1"}, function(response){
            $("#txtproductono").val(response);
        })


    })

    //Cierra nuevo producto
    $(".btncerrar-nuevoproducto").on("click", function(){

        $(".orden-nuevoproducto").attr("hidden",true);
        $(".orden-datalle").attr("hidden",false);
        $(".btn-actproducto").attr("hidden",true);
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
        $(".tablanewprodBody tr").remove();
    })

    //Cierra listado productos
    $(".btncerrar-listadoProducto").on("click", function(){
        $(".orden-datalle").attr("hidden",true);
    })

    // //Carga combo producto
    // $("#txtproducto").on("load", function(){
    //    getDataCombo();
    // })

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
    });

    //Selecciona datos segun Producto
    $("#txtproducto").on("change", function(){
        var idproducto = $(this).val();
        var orden = $("#txtnoorden_prod_nuevo").val();

        $.ajax({
            type:'POST',
            url:'articuloscapitulo',
            data:{
                idproducto:idproducto,
                orden:orden
            },
            success:function(obj, status, error){

                // if(obj.success == false){
                //     var message = "Este producto ya existe en esta orden";
                //     var title="Error!!!";
                //     var error ='';
                //     var reload = false
                //     var win="error"
                //     showMessage(message,error,title,reload,win);

                //     $("#txtcategoria").val("");
                //     $("#txtarticulo").val("");
                //     $("#txtumedida").val("");
                //     $("#txtcantidad").val("");
                //     $("#txtvaduana").val("");
                //     $("#txtmcubico").val("");
                //     $("#txtpesokg").val("");
                // }
                // else{

                    // $("#txtcategoria").val("");
                    // $("#txtarticulo").val("");
                    // $("#txtumedida").val("");
                    // $("#txtcantidad").val("");
                    // $("#txtvaduana").val("");
                    // $("#txtmcubico").val("");
                    // $("#txtpesokg").val("");

                    var jsonResults = JSON.parse(obj);
                    $.each(jsonResults.data, function( index, obj ) {

                        if(obj.producto=="MISCELANEA (1.5)"){
                            $("#txtcantidad").val(0);

                            $("#txtaltom3").val("50");
                            $("#txtlargom3").val("100");
                            $("#txtanchom3").val("40");
                            $("#txtmcubico").val("0.2");
                            $("#txtpesokg").val("0");
                            $("#txtmcubicokg").val("0");
                            $(".txtm3").attr("disabled",true);
                            $("#txtpesokg").attr("disabled",true);
                        }
                        else{
                            $("#txtpesokg").val("");
                            $(".txtm3").removeAttr("disabled");
                            $("#txtpesokg").removeAttr("disabled");
                            $("#txtaltom3").val("");
                            $("#txtlargom3").val("");
                            $("#txtanchom3").val("");
                            $("#txtmcubico").val("");
                        }
                        $("#txtcategoria").val(obj.capitulo);
                        $("#txtarticulo").val(obj.articulo);
                        $("#txtumedida").val(obj.um);
                        // $("#txtcantidad").val(obj.cantidad);
                        $("#txtvaduana").val(obj.valor);

                    });
                // }
            },
            error:function(obj){
                var sms = obj.message;
                $(".msgsession").removeAttr("hidden");
                $(".msg").html(sms).fadeOut( 1000 );
            }
        });
    });

    //Calcula M3 y KG
    $("#btnCalculaM3").on("click", function(){
        var largo=$("#txtlargom3").val();
        var alto=$("#txtaltom3").val();
        var ancho=$("#txtanchom3").val();
        var embarque = $("#idembarque").val();

        var mcubico = ((largo/100)*(alto/100)*(ancho/100));
        var pesovolumen = ((largo)*(alto)*(ancho));
        var kg;

        if(embarque.substr(3,2)=="EM"){
            kg=0;
        }
        else{
           kg = pesovolumen/5000;
        }

        $("#txtmcubico").val(mcubico.toPrecision(3));
        $("#txtmcubicokg").val(kg.toFixed(0));
    });

    //Abre nuevo producto pero ya con los detalles de la tabla
    $(".table_listadoproducto tbody").on("dblclick",".rowtdproductoorden", function(){

        var row = $(this).parents('tr');
        var noproducto = (row.data("noproducto"));
        var orden = $("#txtnoorden_prod").val();
        var dest = $("#txtdest_prod").val();
        var embarque = $("#txtnoembarque_prod").val();

        $(".orden-nuevoproducto").attr("hidden",false);
        $(".orden-datalle").attr("hidden",true);
        $("#txtnoorden_prod_nuevo").val(orden);
        $("#txtdest_prod_nuevo").val(dest);
        $("#txtproductono").val(noproducto);
        $("#idembarque").val(embarque);

        $(".btn-actproducto").removeAttr("hidden");
        $("#btn-guardexit").attr("hidden",true);
        $("#btn-guardcontinuar").attr("hidden", true);

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
                    agregarFilaProdudcto(response.noproducto, response.producto, response.articulo, response.categoria, response.um, response.cantidad, response.mcubico, response.vaduana, response.pesokg,response.idproducto,response.largo,response.alto,response.ancho,response.pesovolumen,response.ow);
                });
            }
        });
    });

    //Carga formulario de productos para editar alguno
    $(".tablanewprod tbody").on("click",".btn-editprod", function(e){
        e.preventDefault();

        $("#btn-saveProducto").attr("hidden",true);
        $("#btn-updateProducto").removeAttr("hidden");

        var row = $(this).parents('tr');

        var productoField    = (row.data("producto"));
        var articuloField    = (row.data("articulo"));
        var categoriaField   = (row.data("categoria"));
        var umField         = (row.data("um"));
        var cantidadField    = (row.data("cantidad"));
        var mcubicoField     = (row.data("mcubico"));
        var largoField     = (row.data("largo"));
        var altoField     = (row.data("alto"));
        var anchoField     = (row.data("ancho"));
        var vaduanaField     = (row.data("vaduana"));
        var pesokgField      = (row.data("pesokg"));
        var pesovolumen      = (row.data("pesovolumen"));
        var idproductoField      = (row.data("idproducto"));
        var ows = (row.data("ow"));

        producto.val(productoField);
        producto.text(productoField);
        articulo.val(articuloField);
        categoria.val(categoriaField);
        um.val(umField);
        cantidad.val(cantidadField);
        mcubico.val(mcubicoField);
        largo.val(largoField);
        alto.val(altoField);
        ancho.val(anchoField);
        vaduana.val(vaduanaField);
        pesokg.val(pesokgField);
        idproducto.val(idproductoField);
        pvolumen.val(pesovolumen);
        if(ows=="1"){
            $("#ow").prop("checked", true);
        }
        else{
            $("#ow").prop("checked", false);
        }
    });
});

function agregarFilaProdudcto(noproducto, producto, articulo, categoria, um, cantidad, mcubico, vaduana, pesokg, idproducto,largo,alto,ancho,pesovolumen,ow) {

    var htmlTags = '<tr id="'+idproducto+'" data-noproducto="'+noproducto+'"data-producto="'+producto+'" data-articulo="'+articulo+'" data-categoria="'+categoria+'" data-um="'+um+'" data-cantidad="'+cantidad+'" data-mcubico="'+mcubico+'" data-vaduana="'+vaduana+'" data-pesokg="'+pesokg+'" data-idproducto="'+idproducto+'" data-largo="'+largo+'" data-alto="'+alto+'" data-ancho="'+ancho+'" data-pesovolumen="'+pesovolumen+'" data-ow="'+ow+'">'+
           '<td class="rowtdnewproducto">'+noproducto+'</td>'+
           '<td class="rowtdnewproducto">'+producto+'</td>'+
           '<td class="rowtdnewproducto">'+articulo+'</td>'+
           '<td class="rowtdnewproducto">'+categoria+'</td>'+
           '<td class="rowtdnewproducto">'+um+'</td>'+
           '<td class="rowtdnewproducto">'+cantidad+'</td>'+
           '<td class="rowtdnewproducto">'+mcubico.toFixed(5)+'</td>'+
           '<td class="rowtdnewproducto">'+vaduana+'</td>'+
           '<td class="rowtdnewproducto">'+pesokg.toFixed(2)+'</td>'+
           '<td class="rowtdnewproducto" hidden>'+idproducto+'</td>'+
           '<td class="rowtdnewproducto" hidden>'+largo+'</td>'+
           '<td class="rowtdnewproducto" hidden>'+alto+'</td>'+
           '<td class="rowtdnewproducto" hidden>'+ancho+'</td>'+
           '<td class="rowtdnewproducto" hidden>'+pesovolumen+'</td>'+
           '<td class="rowtdnewproducto" hidden>'+ow+'</td>'+
           '<td class="rowtdnewproducto"><button type="button" class="btn btn-sm btn-warning rounded ml-auto mr-1 btn-editprod"><i class="far fa-edit"></i></button><button type="button" class="btn btn-sm btn-danger rounded ml-auto btn-deleteprod"><i class="fas fa-trash-alt" data-toggle="tooltip" title="Eliminar"></i></button></td>' +
           '</tr>';
    $('.tablanewprod tbody').append(htmlTags);
    $("#valorresto").val();
}

