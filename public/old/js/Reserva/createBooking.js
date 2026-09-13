$(document).ready(function(){

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btnSaveBooking").on("click",function(e){
        e.preventDefault();

        var validaFormulario = $(".formBooking").validate({
            rules:{
                bkbuque:"required",
                bkviaje:"required",
                txtorigen:"required",
                txtembarque:"required",
                bkshipper:"required",
                bkconsignee:"required",
                bknotify:"required",
                bkviaje:"required",
                txtpol:"required",
                txtpod: "required",
                txtpd: "required"
            },
            messages:{
                tcbuque:"Este campo es obligatorio",
                bkviaje:"Este campo es obligatorio",
                txtorigen:"Este campo es obligatorio",
                txtembarque:"Este campo es obligatorio",
                bkshipper:"Este campo es obligatorio",
                bkconsignee:"Este campo es obligatorio",
                bknotify:"Este campo es obligatorio",
                bkviaje:"Este campo es obligatorio",
                txtpol:"Este campo es obligatorio",
                txtpod: "Este campo es obligatorio",
                txtpd: "Este campo es obligatorio"
            }
        });

        if(validaFormulario.form()){

            var bkbuque = $(".bkbuque option:selected").val();
            var bkviaje = $(".bkviaje option:selected").val();
            var txtorigen = $(".txtorigen option:selected").val();
            var txtembarque = $(".txtembarque option:selected").val();
            var bkshipper = $(".bkshipper option:selected").text();
            var bkconsignee = $(".bkconsignee option:selected").text();
            var bknotify = $(".bknotify option:selected").text();
            var bknotifys = $(".bknotifys option:selected").text();
            var txtpol = $(".txtpol").val();
            var txtpod = $(".txtpod").val();
            var txtpd = $(".txtpd").val();
            var txtpor = $(".txtpor").val();
            var txtidpol = $(".txtidpol").val();
            var txtidpod = $(".txtidpod").val();
            var txtidpd = $(".txtidpd").val();
            var txtidpor = $(".txtidpor").val();

            var datos=[];
            var objeto={};
            var nocont,tara,typecont,typegoods,idtype,gross,seals,movement,idmovement;

            $("#tableBkCont tr").each(function(index){
                $(this).children("td").each(function(index2){
                    switch(index2){
                        case 0:
                            nocont=$(this).text();
                            break;
                        case 1:
                            tara=$(this).text();
                            break;
                        case 2:
                            typecont=$(this).text();
                            break;
                        case 3:
                            typegoods=$(this).text();
                            break;
                        case 4:
                            idtype=$(this).text();
                            break;
                        case 5:
                            gross=$(this).text();
                            break;
                        case 6:
                            seals=$(this).text();
                            break;
                        case 7:
                            movement=$(this).text();
                            break;
                        case 8:
                            idmovement=$(this).text();
                            break;
                    }
                })
                datos.push({
                    "equipment"  : nocont,
                    "tara"  : tara,
                    "type" : typecont,
                    "goods" : typegoods,
                    "idgoods" : idtype,
                    "gross": gross,
                    "seals" : seals,
                    "movement" : movement,
                    "idmovement" : idmovement
                });

            })
            objeto.datos=datos;

            var action = $("#urlbookingstore").attr("href");
            var method = "POST";
            $.ajax({
                type:method,
                url:action,
                data:{
                    bkbuque:bkbuque,
                    bkviaje:bkviaje,
                    txtorigen:txtorigen,
                    txtembarque:txtembarque,
                    bkshipper:bkshipper,
                    bkconsignee:bkconsignee,
                    bknotify:bknotify,
                    bknotifys:bknotifys,
                    txtpol:txtpol,
                    txtpod:txtpod,
                    txtpd:txtpd,
                    txtpor:txtpor,
                    txtidpol:txtidpol,
                    txtidpod:txtidpod,
                    txtidpd:txtidpd,
                    txtidpor:txtidpor,
                    datos:objeto.datos
                },
                success:function(data){
                    if(data.success=="true"){
                        $("#msgsession").attr("hidden",true);
                        var message=data.message;
                        var title="Success!!!";
                        var error ='';
                        var reload = true
                        showMessage(message,error,title,reload);
                        $(".formBooking").trigger("reset");
                        //$("#mReserva").modal('hide');
                    }
                    else{
                        var sms = data.message;
                        $(".msgsession").attr("hidden",false);
                        $(".msg").html(sms).fadeOut(1000);
                    }
                },
                error:function(){
                    var sms = "Error, por favor contactar su Administrador de sistema";
                    $(".msgsession").attr("hidden",false);
                    $(".msg").html(sms).fadeOut(1000);
                }
            })
        }
    })
})

