$(document).ready(function(){

    var id;
    var row;
    var buque;
    var viaje;

    //Carga los datos de una tabla en formulario
    $("#tableViajeBody tr").on("click",".btnEditarViaje",function(e){
        row = $(this).parents('tr');
        id = row.data('idviaje');
        idbuque = row.data('idbuque');
        buque=row.data('buque');
        viaje=row.data('viaje');
        e.preventDefault();

        $("#titleviaje").html("Actualizar Viaje");
        $("#buquetxt").val(buque);
        $("#viaje").val(viaje);
        $("#idviaje").val(id);
        $("#idbuque").val(idbuque);

        $("#btnUpdateViaje").removeAttr("hidden");
        $("#btnSaveViaje").attr("hidden",true);

        $("#mViaje").modal({backdrop: 'static'});
        $("#buque").hide();
        $("#buquetxt").attr("hidden",false);
    })

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btnUpdateViaje").on("click",function(e){
        e.preventDefault();

        var validaFormulario = $("#formViaje").validate({
            rules:{
                idviaje:"required",
                idbuque:"required",
                buque:"required",
                viaje:"required"
            },
            messages:{
                idviaje:"Este campo es obligatorio",
                idbuque:"Este campo es obligatorio",
                buque:"Este campo es obligatorio",
                viaje:"Este campo es obligatorio"
            }
        })


        if(validaFormulario.form()){

            var id=$("#idviaje").val();
            var idbuque = $("#idbuque").val();
            var viaje = $("#viaje").val();

            var action = $("#urlviajeupdate").attr("href");
            var method = 'PATCH';
            var url = action+"/"+id;

            $.ajax({
                type:method,
                url:url,
                data:{
                    idviaje:id,
                    idbuque:idbuque,
                    viaje:viaje
                },
                success:function(data){
                    if(data.success=="true"){
                        $("#msgsession").attr("hidden");
                        var message=data.message;
                        var title="Success!!!";
                        var error ='';
                        var reload = true
                        showMessage(message,error,title,reload);
                        $("#formViaje").trigger("reset");
                        $("#btnUpdateViaje").attr("hidden");
                        $("#btnSaveViaje").removeAttr("hidden");
                        $("#mViaje").modal('hide');

                        $("#titleviaje").html("Nuevo Viaje");
                        $("#buque").show();
                        $("#buquetxt").attr("hidden",true);
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
