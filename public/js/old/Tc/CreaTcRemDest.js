$(document).ready(function(){

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btnSaveRemDest").on('click',function(e){
        e.preventDefault();

        var validaFormulario = $(".formRemDest").validate({
            rules:{
                txtci:{
                    // required:true,
                    digits:true,
                    rangelength: [11, 11]
                },
                txtnombre:"required",
                txtapellidop:"required",
                txtapellidom:"required",
                txttelefono:{
                    required:true,
                    digits:true
                },
                txtnacionalidad:"required",
                txtcalle:"required",
                txtnocalle:{
                    required:true
                },
                txtentrecalle:"required",
                txtprov:"required",
                txtmcpio:"required",
                txtcp:"required"
            },
            messages:{
                txtci:{
                    // required:"Este campo es obligatorio",
                    digits:"Este campo solo permite digitos",
                    rangelength:"Este campo solo permite 11 caracteres"
                },
                txtnombre:"Este campo es obligatorio",
                txtapellidop:"Este campo es obligatorio",
                txtapellidom:"Este campo es obligatorio",
                txttelefono:{
                    required:"Este campo es obligatorio",
                    digits:"Este campo solo permite digitos"
                },
                txtnacionalidad:"Este campo es obligatorio",
                txtcalle:"Este campo es obligatorio",
                txtnocalle:"Este campo es obligatorio",
                txtentrecalle:"Este campo es obligatorio",
                txtprov:"Este campo es obligatorio",
                txtmcpio:"Este campo es obligatorio",
                txtcp:"Este campo es obligatorio"
            }
        })

        if(validaFormulario.form()){
            var action = $(".formRemDest").attr("action");
            var method = $(".formRemDest").attr("method");

            var ci = $("#txtci").val();
            var nombre = $("#txtnombre").val();
            var apellidop = $("#txtapellidop").val();
            var apellidom = $("#txtapellidom").val();
            var pasaporte = $("#txtpasaporte").val();
            var telefono = $("#txttelefono").val();
            var nacionalidad = $("#txtnacionalidad").val();
            var calle = $("#txtcalle").val();
            var no_calle = $("#txtnocalle").val();
            var apto = $("#txtapto").val();
            var entrecalle = $("#txtentrecalle").val();
            var provincia = $("#txtprov option:selected").text();
            var municipio = $("#txtmcpio option:selected").text();
            var cp = $("#txtcp option:selected").val();

            $.ajax({
                type:method,
                url:action,
                data:{
                    ci:ci,
                    nombre:nombre,
                    apellidop:apellidop,
                    apellidom:apellidom,
                    pasaporte:pasaporte,
                    telefono:telefono,
                    nacionalidad:nacionalidad,
                    calle:calle,
                    no_calle:no_calle,
                    apto:apto,
                    entrecalle:entrecalle,
                    provincia:provincia,
                    municipio:municipio,
                    cp:cp
                },
                success:function(data){
                    if(data.success=="true"){
                        $("#msgsession").attr("hidden",true);
                        var message=data.message;
                        var title="Success!!!";
                        var error ='';
                        var reload = true;
                        var windows="informacion";
                        showMessage(message,error,title,reload,windows);
                        $(".formRemDest").trigger("reset");
                        $("#mRemDest").modal('hide');
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

