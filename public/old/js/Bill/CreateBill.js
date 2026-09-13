$(document).ready(function(){

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btnSaveGoodsBl").on("click",function(e){
        e.preventDefault();


        var validaFormulario;
        var radiocargoes = $("input:radio[name=optradio]:checked").val();

        if(radiocargoes == "gc"){
            alert("funciona "+radiocargoes);
            $("#txtimoclassbl").removeProp("required");
            $("#txtimounbl").removeProp("required");
            $("#txtimoflashpointbl").removeProp("required");

            validaFormulario = $(".formgoodsbl").validate({
                rules:{
                    bookingnoGoodsBl:"required",
                    txtequipmentno:"required",
                    txtpkgs:"required",
                    txtpkgstype:"required",
                    txtgrossbl:"required",
                    txtcbms:"required",
                    txtgooddescrbl:"required"
                },
                messages:{
                    bookingnoGoodsBl:"Este campo es obligatorio",
                    txtequipmentno:"Este campo es obligatorio",
                    txtpkgs:"Este campo es obligatorio",
                    txtpkgstype:"Este campo es obligatorio",
                    txtgrossbl:"Este campo es obligatorio",
                    txtcbms:"Este campo es obligatorio",
                    txtgooddescrbl:"Este campo es obligatorio",
                }
            });
        }
        else{
            alert("funciona "+radiocargoes);
            $("#txtimoclassbl").prop("required",true);
            $("#txtimounbl").prop("required",true);
            $("#txtimoflashpointbl").prop("required",true);

            validaFormulario = $(".formgoodsbl").validate({
                rules:{
                    bookingnoGoodsBl:"required",
                    txtequipmentno:"required",
                    txtpkgs:"required",
                    txtpkgstype:"required",
                    txtgrossbl:"required",
                    txtcbms:"required",
                    txtgooddescrbl:"required",
                    txtimoclassbl:"required",
                    txtimounbl:"required",
                    txtimoflashpointbl:"required"
                },
                messages:{
                    bookingnoGoodsBl:"Este campo es obligatorio",
                    txtequipmentno:"Este campo es obligatorio",
                    txtpkgs:"Este campo es obligatorio",
                    txtpkgstype:"Este campo es obligatorio",
                    txtgrossbl:"Este campo es obligatorio",
                    txtcbms:"Este campo es obligatorio",
                    txtgooddescrbl:"Este campo es obligatorio",
                    txtimoclassbl:"Este campo es obligatorio",
                    txtimounbl:"Este campo es obligatorio",
                    txtimoflashpointbl:"Este campo es obligatorio"
                }
            });
        }


        if(validaFormulario.form()){

            var booking=$("#bookingnoGoodsBl").val();
            var equipment = $("#txtequipmentno").val();
            var pkgs = $("#txtpkgs").val();
            var pkgstype = $("#txtpkgstype").val();
            var cbms = $("#txtcbms").val();
            var goodsdecr = $("#txtgooddescrbl").val();
            var imoclass = $("#txtimoclassbl").val();
            var imoun = $("#txtimounbl").val();
            var imoflashpoint = $("#txtimoflashpointbl").val();

            var action = $("#urlbillstore").attr("href");
            var method = "POST";
            $.ajax({
                type:method,
                url:action,
                data:{
                    booking:booking,
                    equipment:equipment,
                    pkgs:pkgs,
                    pkgstype:pkgstype,
                    cbms:cbms,
                    goodsdecr:goodsdecr,
                    imoclass:imoclass,
                    imoun:imoun,
                    imoflashpoint:imoflashpoint
                },
                success:function(data){
                    if(data.success=="true"){
                        $("#msgsession").attr("hidden",true);
                        var message=data.message;
                        var title="Success!!!";
                        var error ='';
                        var reload = true
                        showMessage(message,error,title);
                        $(".formgoodsbl").trigger("reset");
                        $("#mGoodsbl").modal('hide');
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

