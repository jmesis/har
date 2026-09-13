$(document).ready(function(){

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btnSaveCont").on('click',function(){
       // e.preventDefault();

        var validaFormulario = $("#formTipoCont").validate({
            rules:{
                txttipocont:"required",
                txttipocontdescripcion:"required",
                txtteus:{
                    required:true,
                    number:true
                }
            },
            messages:{
                txttipocont:"Este campo es obligatorio",
                txttipocontdescripcion:"Este campo es obligatorio",
                txtteus:{
                    required:"Este campo es obligatorio",
                    numeric:"Este un campo numerico"
                }
            }
        })

        if(validaFormulario.form()){
            var action = $("#formTipoCont").attr("action");
            var method = $("#formTipoCont").attr("method");

            var tipocont = $("#txttipocont").val();
            var descr = $("#txttipocontdescripcion").val();
            var teus = $("#txtteus").val();


            $.ajax({
                type:method,
                url:action,
                data:{
                    type:tipocont,
                    description:descr,
                    teus:teus
                },
                success:function(data){
                    if(data.success=="true"){
                        $("#msgsession").attr("hidden",true);
                        var message=data.message;
                        var title="Success!!!";
                        var error ='';
                        var reload = true;
                        var windows = "informacion";
                        showMessage(message,error,title,reload,windows);
                        $("#formTipoCont").trigger("reset");
                        $("#mTipoCont").modal('hide');
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
        }
    })
})

