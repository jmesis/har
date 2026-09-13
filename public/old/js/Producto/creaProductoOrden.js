$(document).ready(function(){

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btn-guardexit").on("click",function(e){
        var datos=[];
        var objeto={};

        var noproducto, producto, um, cantidad, mcubico, vaduana, pesokg;
        var noorden=$("#txtnoorden_prod_nuevo").val();


        $(".tablanewprod tr").each(function(index){
            $(this).children("td").each(function(index2){
                switch(index2){
                    case 0:
                        noproducto=$(this).text();
                        break;
                    case 1:
                        producto=$(this).text();
                        break;
                    case 4:
                        um=$(this).text();
                        break;
                    case 5:
                        cantidad=$(this).text();
                        break;
                    case 6:
                        mcubico=$(this).text();
                        break;
                    case 7:
                        vaduana=$(this).text();
                        break;
                    case 8:
                        pesokg=$(this).text();
                        break;
                }
            })
            datos.push({
                "noproducto" : noproducto,
                "producto"   : producto,
                "um"         : um,
                "cantidad"   : cantidad,
                "mcubico"    : mcubico,
                "vaduana"    : vaduana,
                "pesokg"     : pesokg
            });

        })
        objeto.datos=datos;

        var action = $("#formProducto").attr("action");
        var method = $("#formProducto").attr("method");

        $.ajax({
            type:method,
            url:action,
            data:{
                datos:objeto.datos,
                orden:noorden
            },
            success:function(data){
                if(data.success=="true"){
                    $(".msgsession").attr("hidden",true);
                    var message=data.message;
                    var title="Success!!!";
                    var error ='';
                    var reload = false;
                    var window = 'success'
                    showMessage(message,error,title,reload,window);
                    $(".orden-nuevoproducto").attr("hidden",true);
                    $(".orden-datalle").removeAttr("hidden");
                    $(".btn-actproducto").attr("hidden",true);
                    $("#btn-guardexit").removeAttr("hidden");

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
                    $(".msg").html(sms);
                }
            },
            error:function(){
                var sms = "Error, por favor contactar su Administrador de sistema";
                $(".msgsession").attr("hidden",false);
                $(".msg").html(sms);
            }
        })
    })
})
