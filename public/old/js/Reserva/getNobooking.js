$(document).ready(function(){

    $(".btnGetNoBooking").on("click", function(){

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var validaFormulario = $("#formReserva #RequestNoReserva").validate({
            rules:{
                bkbuque:"required",
                bkviaje:"required",
                txtorigen:"required",
                txtembarque:"required"
            },
            messages:{
                bkbuque:"Este campo es obligatorio",
                bkviaje:"Este campo es obligatorio",
                txtorigen:"Este campo es obligatorio",
                txtembarque:"Este campo es obligatorio"
            }
        })


        if(validaFormulario.form()){

            var bkbuque=$(".bkbuque").val();
            var bkviaje = $(".bkviaje").val();
            var txtorigen = $(".txtorigen option:selected").val();
            var txtembarque = $(".txtembarque option:selected").val();

            var action = $("#urlGetNoBooking").attr("href");
            var method = 'POST';
            var url = action;


            $.ajax({
                type:method,
                url:url,
                data:{
                    bkbuque:bkbuque,
                    bkviaje:bkviaje,
                    txtorigen:txtorigen,
                    txtembarque:txtembarque
                },
                success:function(data){
                    if(data.success=="true"){
                       alert("funciona");
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
