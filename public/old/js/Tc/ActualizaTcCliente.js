$(document).ready(function(){

    var id;
    var row;
    var name;
    var address;


    //Carga los datos de una tabla en formulario
    $("#tableTcClienteBody tr").on("click",".btnEditarCliente",function(e){
        row = $(this).parents('tr');
        id = row.data('idcustomers');
        name=row.data('name');
        address=row.data('address');
        e.preventDefault();

        $(".idcliente").val(id);
        $(".clientename").val(name);
        $(".clientedir").html(address);

        $("#btnUpdateCliente").removeAttr("hidden");
        $("#btnSaveCliente").attr("hidden","true");

        $("#mCliente").modal({backdrop: 'static'});
        $(".clientename").focus();
    })

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btnUpdateCliente").on("click",function(e){
        e.preventDefault();

        var validaFormulario = $("#formCliente").validate({
            rules:{
                idcliente:"required",
                clientename:"required",
                clientedir:"required"
            },
            messages:{
                idcliente:"Este campo es obligatorio",
                clientename:"Este campo es obligatorio",
                clientedir:"Este campo es obligatorio"
            }
        })


        if(validaFormulario.form()){

            var id=$(".idcliente").val();
            var clientename = $(".clientename").val();
            var clientedir = $(".clientedir").val();

            var action = $("#urlclienteupdate").attr("href");
            var method = 'PATCH';
            var url = action+"/"+id;

            $.ajax({
                type:method,
                url:url,
                data:{
                    idcliente:id,
                    clientename:clientename,
                    clienteaddress:clientedir
                },
                success:function(data){
                    if(data.success=="true"){
                        $("#msgsession").attr("hidden");
                        var message=data.message;
                        var title="Success!!!";
                        var error ='';
                        var reload = true
                        showMessage(message,error,title,reload);
                        $("#formCliente").trigger("reset");
                        $("#btnUpdateCliene").attr("hidden");
                        $("#btnSaveCliente").removeAttr("hidden");
                        $("#mCliente").modal('hide');

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
