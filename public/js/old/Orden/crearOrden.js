

$(document).ready(function(){

    var validaFormulario = $(".formOrden").validate({
        rules:{
            txtembarque_ordenmodal:"required",
            txttipoenvio:"required",
            txtremitente:"required",
            txtdestinatario_input:"required",
            txtrem_nomb:"required",
            txtrem_apellp:"required",
            txtrem_apellm:"required",
            txtdestinatario:"required",
            fentrada:"required"
        },
        messages:{
            txtembarque_ordenmodal:"Este campo es obligatorio",
            txttipoenvio:"Este campo es obligatorio",
            txtremitente:"Este campo es obligatorio",
            txtdestinatario_input:"Este campo es obligatorio",
            txtrem_nomb:"Este campo es obligatorio",
            txtrem_apellp:"Este campo es obligatorio",
            txtrem_apellm:"Este campo es obligatorio",
            txtdestinatario:"Este campo es obligatorio",
            fentrada:"Este campo es obligatorio"
        }
    });


    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btn-guardorden").on("click",function(e){

        e.preventDefault();
        if (validaFormulario.form()){

            var noembarque = $("#txtembarque_ordenmodal").val();
            var tipoembarque = $("#txttipoenvio option:selected").text();
            var remitente;
            var destinatario;
            var iddestinatario = $("#txtiddestinatario_input").val();
            var fentrada = $("#txtfentrada").val();
            var resultado;

            if(tipoembarque.substr(1,3) == "ENA" || tipoembarque.substr(1,3) == "MNJ"){

                remitente = $("#txtremitente option:selected").text();
                destinatario = $("#txtdestinatario_input").val();
            }
            else{
                nombre = $("#txtrem_nomb").val();
                apellidop = $("#txtrem_apellp").val();
                apellidom = $("#txtrem_apellm").val();

                remitente = nombre+" "+apellidop+" "+apellidom;
                destinatario = $("#txtdestinatario option:selected").text();
            }

            if((tipoembarque.substr(1,3) == "ENA" || tipoembarque.substr(1,3)=="MNJ") && remitente==destinatario){
                resultado=1;
            }
            else{
                if(tipoembarque.substr(1,3) == "ENV" && remitente != destinatario){
                    resultado=1;
                }
                else{
                    resultado=0;
                }
            }

            if(resultado==1){
                var action = $("#formOrden").attr("href");
                var method = $("#formOrden").attr("method");
                $.ajax({
                    type:method,
                    url:action,
                    data:{
                        noembarque:noembarque,
                        tipoenvio:tipoembarque,
                        remitente:remitente,
                        destinatario:destinatario,
                        iddestinatario:iddestinatario,
                        fentrada:fentrada
                    },
                    success:function(data){
                        if(data.success=="true"){
                            $("#msgsession").attr("hidden",true);
                            var message=data.message;
                            var title="Informacion !!!";
                            var error ='';
                            var reload = false;
                            var win = "informacion";
                            showMessage(message,error,title,reload,win);
                            $("#m-orden").modal('hide');
                            $(".formOrden").trigger("reset");
                            $("#div_remselect").attr("hidden",true);
                            $("#div_destinput").attr("hidden",true);
                            $("#div_reminput").attr("hidden",true);
                            $("#div_destselect").attr("hidden",true);
                            showOrdenes(noembarque);
                        }
                        else{
                            var message = data.message;
                            var title="Atencion!!!";
                            var error ='';
                            var reload = false
                            var win="error"
                            showMessage(message,error,title,reload,win);
                        }
                    },
                    error:function(){
                        var message = "Error, por favor contactar su Administrador de sistema";
                        var title="Error!!!";
                        var error ='';
                        var reload = false
                        var win="error"
                        showMessage(message,error,title,reload,win);
                    }
                })
            }
            else{
                var message = "Por favor revise su formulario";
                var title="Atencion!!!";
                var error ='';
                var reload = false
                var win="warning"
                showMessage(message,error,title,reload,win);

            }
        }
        else{
            var message = "Por favor revise su formulario";;
            var title="Atencion!!!";
            var error ='';
            var reload = false
            var win="warning"
            showMessage(message,error,title,reload,win);
        }
    })
})

