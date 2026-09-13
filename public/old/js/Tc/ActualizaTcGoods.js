$(document).ready(function(){

    var id;
    var row;
    var description;

    //Carga los datos de una tabla en formulario
    $("#tableTcGoods tr").on("click",".btnEditGoods",function(e){
        row = $(this).parents('tr');
        id = row.data('idgoods');
        description=row.data('description');
        e.preventDefault();

        $(".idgoods").val(id);
        $(".txtgoodsdescr").val(description);

        $("#btnUpdateGoods").removeAttr("hidden");
        $("#btnSaveGoods").attr("hidden","true");

        $("#mGoods").modal({backdrop: 'static'});
        $(".txtgoodsdescr").focus();
    })

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btnUpdateGoods").on("click",function(e){
        e.preventDefault();

        var validaFormulario = $("#formGoods").validate({
            rules:{
                idgoods:"required",
                txtgoodsdescr:"required"
            },
            messages:{
                idgoods:"Este campo es obligatorio",
                txtgoodsdescr:"Este campo es obligatorio"
            }
        })


        if(validaFormulario.form()){

            var id=$(".idgoods").val();
            var description = $(".txtgoodsdescr").val();

            var action = $("#urlgoodsupdate").attr("href");
            var method = 'PATCH';
            var url = action+"/"+id;

            $.ajax({
                type:method,
                url:url,
                data:{
                    id:id,
                    description:description
                },
                success:function(data){
                    if(data.success=="true"){
                        $("#msgsession").attr("hidden");
                        var message=data.message;
                        var title="Success!!!";
                        var error ='';
                        var reload = true
                        showMessage(message,error,title,reload);
                        $("#formGoods").trigger("reset");
                        $("#btnUpdateGoods").attr("hidden",true);
                        $("#btnSaveGoods").removeAttr("hidden");
                        $("#mGoods").modal('hide');

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

