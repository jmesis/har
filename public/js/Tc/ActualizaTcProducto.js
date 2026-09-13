$(document).ready(function(){

    var idproducto;
    //carga el modal de embarque para modificar informacion
    $("#tableItemProd tbody").on("click",".btn-EditarItemProd",function(){

        var row = $(this).parents('tr');

        idproducto = (row.data("idarticulo"));
        var producto = (row.data("producto"));
        var idcapitulo = (row.data("idcapitulo"));
        var capitulo = (row.data("capitulo"));
        var idcaparticulo = (row.data("idcaparticulo"));
        var articulo = (row.data("articulo"));
        var finicio = (row.data("f_inicio")).substring(0,10);
        var ffin = (row.data("f_ffin")).substring(0,10);

        $("#mItemProd").modal({backdrop: 'static'});
        $("#title-mitemprod").html("Actualizar Producto");
        $("#btnUpdateItemProd").attr("hidden",false);
        $("#btn-guardaItemProd").attr("hidden",true);

        $(".txtmproducto").val(producto);
        $(".txtmcapitulo option:selected").text(capitulo);
        $(".txtmcapitulo option:selected").val(idcapitulo);
        $(".txtfinicio").val(finicio);
        $(".txtffin").val(ffin);
        $(".txtmarticulo").append("<option value="+idcaparticulo+">"+articulo+"</option>");


        //Actualizamos el producto
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#btnUpdateItemProd").on("click", function(e){
            e.preventDefault();

            var validaFormulario = $(".formmItemProd").validate({
                rules:{
                    txtmproducto:"required",
                    txtmcapitulo:"required",
                    txtmarticulo:"required",
                    txtfinicio:"required"
                },
                messages:{
                    txtmproducto:"Este campo es obligatorio",
                    txtmcapitulo:"Este campo es obligatorio",
                    txtmarticulo:"Este campo es obligatorio",
                    txtfinicio:"Este campo es obligatorio"
                }
            });

            if(validaFormulario.form()){

                idproducto = idproducto;
                var producto = $("#txtmproducto").val();
                var idcapitulo = $("#txtmcapitulo option:selected").val();
                var capitulo = $("#txtmcapitulo option:selected").text();
                var articulo = $("#txtmarticulo option:selected").text();
                var finicio = $("#txtfinicio").val();
                var ffin = $("#txtffin").val();

                var action = $("#urlitemprodupdate").attr("href");
                var method = 'PATCH';
                var url = action+"/"+idproducto;

                $.ajax({
                    type:method,
                    url:url,
                    data:{
                        idcapitulo:idcapitulo,
                        producto:producto,
                        capitulo:capitulo,
                        articulo:articulo,
                        finicio:finicio,
                        ffin:ffin
                    },
                    success:function(data){
                        if(data.success=="true"){
                            $("#msgsession").attr("hidden",true);
                            var message=data.message;
                            var title="Success!!!";
                            var error ='';
                            var reload = true;
                            var window="informacion";
                            showMessage(message,error,title,reload,window);
                            
                            $(".formmItemProd").trigger("reset");
                            $("#mItemProd").modal('hide');
                            $("#title-mitemprod").html("Nuevo Producto");
                            $("#btnUpdateItemProd").attr("hidden",true);
                            $("#btn-guardaItemProd").removeAttr("hidden");
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
})
