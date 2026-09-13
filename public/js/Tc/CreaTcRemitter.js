$(document).ready(function(){

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btnSaveRemitter").on('click',function(e){
        e.preventDefault();

        var validaFormulario = $(".formTcremitter").validate({
            rules:{
                txtRemitterId:"required",
                txtRemitterName:"required",
                txtRemitterApellidop:"required",
                txtRemitterApellidom:"required",
                txtRemitterTelef:{
                    required:true,
                    number:true
                },
                txtRemitterDir:"required",
                txtRemitterEmail:{
                    required:true,
                    email:true
                }
            },
            messages:{
                txtRemitterId:"Este campo es obligatorio",
                txtRemitterName:"Este campo es obligatorio",
                txtRemitterApellidop:"Este campo es obligatorio",
                txtRemitterApellidom:"Este campo es obligatorio",
                txtRemitterTelef:{
                    "required":"Este campo es obligatorio",
                    "number": "Debe introducir solo numeros"
                },
                txtRemitterDir:"Este campo es obligatorio",
                txtRemitterEmail:{
                    "required":"Este campo es obligatorio",
                    "number": "Format aaa@aaa.com"
                }
            }
        })

        if(validaFormulario.form()){
            var action = $(".formTcremitter").attr("action");
            var method = $(".formTcremitter").attr("method");

            var id = $("#txtRemitterId").val();
            var nombre = $("#txtRemitterName").val();
            var apellidop = $("#txtRemitterApellidop").val();
            var apellidom = $("#txtRemitterApellidom").val();
            var telefono = $("#txtRemitterTelef").val();
            var dir = $("#txtRemitterDir").val();
            var email = $("#txtRemitterEmail").val();

            $.ajax({
                type:method,
                url:action,
                data:{
                    number:id,
                    nombre:nombre,
                    apellidop:apellidop,
                    apellidom:apellidom,
                    telefono:telefono,
                    dir:dir,
                    email:email
                },
                success:function(data){
                    if(data.success=="true"){
                        $("#msgsession").attr("hidden",true);
                        var message=data.message;
                        var title="Success!!!";
                        var error ='';
                        var reload = false;
                        var windows="informacion";
                        showMessage(message,error,title,reload,windows);
                        $(".formTcremitter").trigger("reset");
                        $("#mTcremitter").modal('hide');
                        $("#tableRemittersBody tr").remove();
                        $.ajax({
                            type: "POST",
                            url: "listaremitentes",
                            success:function(response){
                                var jsonResults = JSON.parse(response);
                                $.each(jsonResults.data, function( index, response ){
                                    agregarFilaRemitters(response.idremitter,response.number,response.name,response.lastnamep,response.lastnamem);
                                });
                            }
                        });
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

