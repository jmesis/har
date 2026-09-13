
$(document).ready(function(){

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btnSavePort").on("click",function(e){
    //$("#tableTcPort thead tr").on("click","#btnSavePort",function(){
        var datos=[];
        var objeto={};
        var country,port,code;


        $("#tableTcPort tr").each(function(index){
            $(this).children("td").each(function(index2){
                switch(index2){
                    case 0:
                        country=$(this).text();
                        break;
                    case 1:
                        port=$(this).text();
                        break;
                    case 2:
                        code=$(this).text();
                        break;
                }
            })
            datos.push({
                "country"    : country,
                "port"  : port,
                "code" : code
            });

        })
        objeto.datos=datos;

        var action = $("#formtcpuerto").attr("action");
        var method = $("#formtcpuerto").attr("method");

        $.ajax({
            type:method,
            url:action,
            data:{
                datos:objeto.datos
            },
            success:function(data){
                if(data.success=="true"){
                    $(".msgsession").attr("hidden",true);
                    $("#btnSavePort").attr("hidden");
                    var message=data.message;
                    var title="Success!!!";
                    var error ='';
                    var reload = true
                    showMessage(message,error,title,reload);
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
    })
})


