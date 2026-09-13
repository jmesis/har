$(document).ready(function(){

    var idtable;
    var row;
    var type;
    var descr;
    var teus;

    //Carga los datos de una tabla en formulario
    $("#tableTcTipoContBody tr").on("click",".btnEditarCont",function(e){
        row = $(this).parents('tr');
        idtable = row.data('idcontainer');
        type=row.data('type');
        descr=row.data('description');
        teus =row.data('teus');
        e.preventDefault();

        $("#titletipocont").html("Actualizar Tipo de Contenedor");
        $("#txttipocont").val(type);
        $("#txttipocontdescripcion").val(descr);
        $("#txtteus").val(teus);
        $("#idtipocont").val(idtable);

        $("#btnUpdateCont").removeAttr("hidden");
        $("#btnSaveCont").attr("hidden","true");

        $("#mTipoCont").modal({backdrop: 'static'});
        $(".txttipocont").focus();
    })

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btnUpdateCont").on("click",function(e){
        e.preventDefault();

        var validaFormulario = $("#formTipoCont").validate({
            rules:{
                txttipocont:"required",
                txttipocontdescripcion:"required",
                txtteus:{
                    required:true,
                    number:true,
                }
            },
            messages:{
                txttipocont:"Este campo es obligatorio",
                txttipocontdescripcion:"Este campo es obligatorio",
                txtteus:{
                    required:"Este campo es obligatorio",
                    numeric:"Es un campo numerico",
                }
            }
        })


        if(validaFormulario.form()){

            var id=$("#idtipocont").val();
            var tipocont = $("#txttipocont").val();
            var descr = $("#txttipocontdescripcion").val();
            var teus = $("#txtteus").val();

            var action = $("#urlcontupdate").attr("href");
            var method = 'PATCH';
            var url = action+"/"+id;

            $.ajax({
                type:method,
                url:url,
                data:{
                    id:id,
                    type:tipocont,
                    description:descr,
                    teus:teus
                },
                success:function(data){
                    if(data.success=="true"){
                        $("#msgsession").attr("hidden");
                        var message=data.message;
                        var title="Success!!!";
                        var error ='';
                        var reload = true;
                        var windows = "informacion";
                        showMessage(message,error,title,reload,windows);
                        $("#formTipoCont").trigger("reset");
                        $("#mTipoCont").modal('hide');

                        $("#btnUpdateCont").attr("hidden", true);
                        $("#btnSaveCont").removeAttr("hidden");
                        $("#titletipocont").html("Nuevo Tipo de Contenedor");

                    }
                    else{
                        var sms = data.message;
                        $(".msgsession").attr("hidden");
                        $(".msg").html(sms);
                    }
                },
                error:function(data){
                    var sms = data.message;
                    $(".msgsession").removeAttr("hidden");
                    $(".msg").html(sms);
                }
            })
        }
    })
})
