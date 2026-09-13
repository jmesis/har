$(document).ready(function(){

    var id;
    var row;
    var buque;
    var imo;

    //Carga los datos de una tabla en formulario
    $("#tableTcBuqueBody tr").on("click",".btnEditarBuque",function(e){
        row = $(this).parents('tr');
        id = row.data('idbuque');
        buque=row.data('buque');
        imo=row.data('noimo');
        e.preventDefault();

        $(".txttcbuque").val(buque);
        $(".txttcbuqueimo").val(imo);
        $(".txttcidbuque").val(id);

        $("#lbl-titlebuque").html("Actualizar Buque");
        $("#btnUpdateBuque").attr("hidden",false);
        $("#btnSaveBuque").attr("hidden",true);


        $("#mBuque").modal({backdrop: 'static'});
        $(".txttcbuque").focus();
    })

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btnUpdateBuque").on("click",function(e){
        e.preventDefault();

        var validaFormulario = $("#formAV").validate({
            rules:{
                txttcidbuque:"required",
                txttctcbuque:"required"
            },
            messages:{
                txttcidbuque:"Este campo es obligatorio",
                txttctcbuque:"Este campo es obligatorio"
            }
        })


        if(validaFormulario.form()){

            var id=$(".txttcidbuque").val();
            var buque = $(".txttcbuque").val();
            var buqueimo = $(".txttcbuqueimo").val();

            var action = $("#urlbuqueupdate").attr("href");
            var method = 'PATCH';
            var url = action+"/"+id;

            $.ajax({
                type:method,
                url:url,
                data:{
                    id:id,
                    buque:buque,
                    buqueimo:buqueimo
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
                        $("#formAV").trigger("reset");
                        $("#btnUpdateBuque").attr("hidden");
                        $("#btnSaveBuque").removeAttr("hidden");
                        $("#mBuque").modal('hide');

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
