$(document).ready(function(){

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.btn-nuevoembarq').on('click', function(){
        $("#m-embarque").modal({backdrop: 'static'});

    })

    $('.btn-closeembarque').on('click', function(){
        $("#m-embarque").modal('hide');
        $(".formEmbarque").trigger("reset");
        $("#title-membarque").html("Nuevo Embarque");
        $("#btn-actembarque").attr("hidden",true);
        $("#btn-guardaembarque").attr("hidden",false);
        $("#txtcont").removeClass("validContainer");
        $("#txtcont").removeClass("invalidContainer");

        $("#txtorigen option:selected").text('');
        $("#txtorigen option:selected").val('');
        $(".txtconsignado option:selected").text('');
        $(".txtconsignado option:selected").val('');
        $(".txttipoemb option:selected").text('');
        $(".txttipoemb option:selected").val('');
        $(".txtipocont option:selected").text('');
        $(".txtipocont option:selected").val('');
        $(".txtbuque option:selected").text('');
        $(".txtviaje option:selected").text('');
        $(".txtbuque option:selected").val('');
        $(".txtviaje option:selected").val('');
        $(".txtviaje").empty();


        $("#txtembarque").attr("required",false);
        $("#txtbuque").attr("required",false);
        $("#txtviaje").attr("required",false);
        $("#txtfechaest").attr("required",false);
        $("#txtpol").attr("required",false);
        $("#txtpod").attr("required",false);
        $("#txtcont").attr("required",false);
        $("#txttipocont").attr("required",false);
        $("#txttara").attr("required",false);
        $("#txtpesob").attr("required",false);
        $("#txtpeson").attr("required",false);

        $("#txtembarque").attr("hidden",true);
        $("#txtbuque").attr("disabled",true);
        $("#txtviaje").attr("disabled",true);
        $("#txtfechaest").attr("disabled",true);
        $("#txtpol").attr("disabled",true);
        $("#txtpod").attr("disabled",true);
        $("#txtcont").attr("disabled",true);
        $("#txttipocont").attr("disabled",true);
        $("#txttara").attr("disabled",true);
        $("#txtpesob").attr("disabled",true);
        $("#txtpeson").attr("disabled",true);
        $(".txtmfto").attr("disabled",true);
        $(".txtdocembarque").attr("disabled",true);

        $("#txtorigen").removeClass("error");
        $("#txtorigen-error").remove();
        $("#txtembarcador").removeClass("error");
        $("#txtembarcador-error").remove();
        $("#txtconsignado").removeClass("error");
        $("#txtconsignado-error").remove();
        $("#txttipoemb").removeClass("error");
        $("#txttipoemb-error").remove();
        $("#txtbuque").removeClass("error");
        $("#txtbuque-error").remove();
        $("#txtviaje").removeClass("error");
        $("#txtviaje-error").remove();
        $("#txtpol").removeClass("error");
        $("#txtpol-error").remove();
        $("#txtpod").removeClass("error");
        $("#txtpod-error").remove();
        $("#txttipocont").removeClass("error");
        $("#txttipocont-error").remove();
        location.reload();
    });

    $(".btncerrar-embarque").on("click", function(){
        $(".embarque-principal").attr("hidden",true);
    });

    //Cierra modal de puertos
    $(".btnCloseFindPort").on("click",function(){
        $("#mFindPort").modal('hide');
        $('#mFindPort').data('modal', null);
        $("#tableTcPortBody tr").remove();
        $(".txtSearchPort").val('');
    });

    //Test MFTO
    $("#txtembarqueconf").on("change", function(){
        var emb=$("#txtembarqueconf option:selected").text();
        if(emb){
            $.ajax({
                type: "post",
                url: "listaMfto",
                data: {
                    emb: emb,
                },
                success: function (response) {

                    if(!response['success']){

                        return false;
                    }
                    else{

                        return true;
                    }
                }
            });
        }
        else{
            return false;
        }
    });

    //carga combo viaje desde el combo buque
    $("#txtbuque").on("change", function(){
        var idbuque = $(this).val();

        if($.trim(idbuque) !=''){
            $.get("voyage",{param: idbuque}, function(response){
                $("#txtviaje").empty();
                $("#txtviaje").append("<option value=''></option>")

                $.each(response, function(index,value){
                    $("#txtviaje").append("<option value="+index+">"+value+"</option>");
                });
            });
        }
    });

    $("#txttipoemb").on("change", function(){
        var tipoembarque =$(this).val();

        if(tipoembarque == "EA"){
            $("#txtdocembarque").removeAttr("disabled");
        }
        else{
            $("#txtdocembarque").attr("disabled",true);
        }
    });

    //Obtener puertos desde input
    $(document).on("dblclick", 'input[type=text]',function () {
        let id = this.id;
        var t_embarque=$("#txttipoemb option:selected").text();

        if(id=="txtpol" || id=="txtpod"){
            $("#mFindPort").modal({backdrop: 'static'});
            $(".txtSearchPort").trigger("focus");
            $(".txtSearchPort").keyup(function (e) {

                if($(".txtSearchPort").val().length >=3){

                    var trs=$("#tableTcPortBody tr").length;
                    if(trs>=1){
                        // Eliminamos la ultima columna
                        $("#tableTcPortBody tr").remove();
                    }

                    var valor = $(".txtSearchPort").val();
                    var method = 'POST';

                    $.ajax({
                        type:method,
                        url:'getport',
                        data:{
                            valor:valor,
                            t_embarque:t_embarque
                        },
                        success:function(response){
                            var jsonResults = JSON.parse(response);
                            $("#tableTcPortBody tr").remove();
                            $.each(jsonResults.data , function( index, response ) {
                                agregarFilaEmbarque(response.idport,response.country,response.port,response.code)

                            });
                        },
                        error:function(obj){
                            var sms = obj.message;
                            $(".msgsession").removeAttr("hidden");
                            $(".msg").html(sms).fadeOut( 1000 );
                        }
                    })
                }
                else{
                    $("#tableTcPortBody tr").remove();
                }
            })
        }

        $("#tableFindPort tbody").on("dblclick",".rowtdportBooking",function(){

            if(id=="txtpol"){
                var row = $(this).parents('tr');
                console.log(row);
                $("#txtpol").val(row.data("code"));
                $("#idtxtpol").val(row.data("idport"));

                $("#mFindPort").modal('hide');
                $(".txtSearchPort").val('');
                $("#tableTcPortBody tr").remove();
                id='';
            }

            if(id=="txtpod"){
                var row = $(this).parents('tr');
                $("#txtpod").val(row.data("code"));
                $("#idtxtpod").val(row.data("idport"));

                $("#mFindPort").modal('hide');
                $(".txtSearchPort").val('');
                $("#tableTcPortBody tr").remove();
                id='';
            }
        })
    })

    //Verificar Num Contenedor
    $("#txtcont").on("focusout", function(e){
        e.preventDefault();
        var cont = $("#txtcont").val();
        verificaCont(cont);
    })
});

//Functions
function agregarFilaEmbarque(fielda, fieldb, fieldc, fieldd) {
    var htmlTags = '<tr data-idport='+fielda+' data-country='+fieldb+' data-port='+fieldc+' data-code='+fieldd+'>'+
           '<td class="rowtdportBooking">'+fielda+'</td>'+
           '<td class="rowtdportBooking">'+fieldb+'</td>'+
           '<td class="rowtdportBooking">'+fieldc+'</td>'+
           '<td class="rowtdportBooking">'+fieldd+'</td>'+
           '</tr>';
    $('#tableFindPort tbody').append(htmlTags);
}

//Verificar Num Contenedor
function verificaCont(cont){
    if(cont.length == 11){
        $.ajax({
            type: "post",
            url: "verificaCont",
            data: {
                cont: cont,
            },
            success: function (response) {

                if(!response['success']){
                    $("#txtcont").removeClass("validContainer");
                    $("#txtcont").addClass("invalidContainer");
                    $("#txtcont").val('');
                    return false;
                }
                else{
                    $("#txtcont").removeClass("invalidContainer");
                    $("#txtcont").addClass("validContainer");
                    return true;
                }
            }
        });
    }
    else{
        $("#txtcont").removeClass("validContainer");
        $("#txtcont").addClass("invalidContainer");
        $("#txtcont").val('');
        return false;
    }
}
