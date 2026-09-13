$(document).ready(function(){

    // Write on keyup event of keyword input element
    $("#searchport").keyup(function(){
    _this = this;
    // Show only matching TR, hide rest of them
    $.each($(".tableport tbody tr"), function() {
    if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
    $(this).hide();
    else
    $(this).show();
    });
    });
})


//FUNCTIONS
function showMessage(message,error,title,reload,window){
    if(reload==true){
        if(window=="informacion"){
            // $("#modalSuccess .modal-header").removeClass("bg-*")
            $("#modalSuccess").modal("show");
            $("#msgtitle").html(title);
            $("#msgerror").html(message);
            $("#modalSuccess .modal-header").addClass("bg-primary");
        }
        else{
            if(window=="error"){
                // $("#modalSuccess .modal-header").removeClass("bg-*")
                $("#modalSuccess").modal("show");
                $("#msgtitle").html(title);
                $("#msgerror").html(message);
                $("#modalSuccess .modal-header").addClass("bg-danger");
            }
            else{
                // $("#modalSuccess .modal-header").removeClass("bg-*")
                $("#modalSuccess").modal("show");
                $("#msgtitle").html(title);
                $("#msgerror").html(message);
                $("#modalSuccess .modal-header").addClass("bg-success");


                $("#btnModalSuccess").on('click',function(){
                    location.reload();
                })
            }
        }
    }
    else{
        if(window=="informacion"){
            // $("#modalSuccess .modal-header").removeClass("bg-*")
            $("#modalSuccess").modal("show");
            $("#msgtitle").html(title);
            $("#msgerror").html(message);
            $("#modalSuccess .modal-header").addClass("bg-primary");
        }
        else{
            if(window=="error"){
                // $("#modalSuccess .modal-header").removeClass("bg-*")
                $("#modalSuccess").modal("show");
                $("#msgtitle").html(title);
                $("#msgerror").html(message);
                $("#modalSuccess .modal-header").addClass("bg-danger");
            }
            else{
                // $("#modalSuccess .modal-header").removeClass("bg-*")
                $("#modalSuccess").modal("show");
                $("#msgtitle").html(title);
                $("#msgerror").html(message);
                $("#modalSuccess .modal-header").addClass("bg-success");

                // $("#btnModalSuccess").on('click',function(){
                //     location.reload();
                // })
            }
        }
    }
}

//Recargar listado de ordenes despues de crear nuevas
function showOrdenes(noembarque){

        $("#txtembarque_ordenmodal").text(noembarque);
        $("#txtembarque_ordenmodal").val(noembarque);

        var action = $("#urlgetordenes").attr("href");
        var method = 'GET';
        var url = action+"/"+noembarque;

        $.ajax({
            type:method,
            url:url,
            data:{
                valor:noembarque
            },
            success:function(obj, status, error){
                if(status=="success"){
                    //getPortBooking(data.id,data.country,data.port,data.code)

                        // Parse Data
                    var jsonResults = JSON.parse(obj);

                    $("#tableordenesBody tr").remove();

                    if(jsonResults.data == ''){
                        $("#leyendaOrdenes").removeAttr("hidden");
                    }
                    else{
                        $("#leyendaOrdenes").attr("hidden", true);
                        $.each(jsonResults.data , function( index, obj ) {
                            /*console.log (obj.idport);
                            console.log (obj.country);*/
                            //,index[0],index[1],index.port,index.code
                            agregarFilaOrdenes(obj.no_emarque,obj.no_orden,obj.fecha,obj.remitente,obj.nombre,obj.apellidop,obj.apellidom,obj.noblhouse);

                        });
                    }
                }
            },
            error:function(obj){
                var sms = obj.message;
                $(".msgsession").removeAttr("hidden");
                $(".msg").html(sms).fadeOut( 1000 );
            }
        })
}

function agregarFila(fielda, fieldb, fieldc, idfielda, idfieldb, idfieldc) {
    var htmlTags = '<tr data-'+idfielda+'='+fielda+' data-'+idfieldb+'='+fieldb+' data-'+idfieldc+'='+fieldc+'>' +
           '<td class="rowguest">' + fielda + '</td>' +
           '<td class="rowguest">' + fieldb + '</td>' +
           '<td class="rowguest">' + fieldc + '</td>' +
           '<td class="rowguest"> <button type="button" class="btn btn-sm btn-danger rounded btnDPort">Eliminar</button> </td>'+
           '</tr>';
    $('#tableTcPort tbody').append(htmlTags);
}
