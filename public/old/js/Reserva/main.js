
$(document).ready(function(){

    /*
    if($("#bkheadervessel").text() != null){
        $(".btnNuevaReserva").attr("disabled",true);
    }
    else{
        $(".btnNuevaReserva").attr("disabled",false);
    }

    //Selecciona buque y viaje para booking
    $(".rowtdbuque").on("click",function(e){
        e.preventDefault();
        var row = $(this).parents('tr');
        var buque=row.data("buque");
        var viaje = row.data("viaje");

        $("#bkheadervessel").html(buque);
        $("#bkheadervoyage").html(viaje);
        $(".btnNuevaReserva").attr("disabled",false);
    })

    //abre modal para reserva
    $(".btnNuevaReserva").on("click",function(e){
        $(".formReserva").trigger("reset");
        $("#mReserva").modal({backdrop: 'static'});
        var buque=$("#bkheadervessel").text();
        var viaje=$("#bkheadervoyage").text();
        $("#bkbuque").val(buque);
        $("#bkviaje").val(viaje);
    })

    //cierra el modal para reserva
    $("#btnCloseBooking").on("click",function(){
        $("#mReserva").modal('hide');
        $(".formReserva").trigger("reset");
    })
    */

    $(".btnCloseFindPort").on("click",function(){
        $("#mFindPort").modal('hide');
        $("#tableTcPortBody tr").remove();
        $(".txtSearchPort").val('');
    })

    //abre modal para agregar contendores
    $(".btnbkNewCont").on("click",function(e){
        $("#divNewContainer").attr("hidden",false);
        //$("#mNewCont").modal({backdrop: 'static'});
       /* $(".btnbkNewCont").text('Add');
        $(".btnbkNewCont").removeClass('btn-outline-primary');
        $(".btnbkNewCont").addClass('btn-info');
        $(".btnbkNewCont").attr("id","btnbkAddCont");
        $("#btnbkAddCont").removeClass("btnbkNewCont"); */
        $("#btnbkAddCont").attr("hidden", false);
        $("#btnbkNewCont").attr("hidden", true);
        $("#txtbkCont").trigger("focus");
    })

    //cierra el modal para agregar contenedores
    $(".btnbkCloseAddCont").on("click",function(){
        $("#mNewCont").modal('hide');
        $(".formmNewCont").trigger("reset");
        $("#btnSaveBooking, #btnUpdateBooking, #btnCloseBooking").attr("disabled",false);
    })

     //Agrega informacion al campo dir
     $(".bkshipper").on("change",function(){
        var shipperdir = $(".bkshipper option:selected").val();
        $(".bkshipperdir").html(shipperdir);
    })

    $(".bkconsignee").on("change",function(){
        var consigneedir = $(".bkconsignee option:selected").val();
        $(".bkconsigneedir").html(consigneedir);
    })

    $(".bknotify").on("change",function(){
        var notifydir = $(".bknotify option:selected").val();
        $(".bknotifydir").html(notifydir);
    })

    $(".bknotifys").on("change",function(){
        var notifysdir = $(".bknotifys option:selected").val();
        $(".bknotifydirs").html(notifysdir);
    })

    $(".btnPanelNewBooking").on("click", function(){
        $("#cardlistbooking").attr("hidden",true);
        $("#formBooking").attr("hidden", false);
        $("#btnSaveBooking").attr("hidden",false);
    })

    $("#btnCloseBooking").on("click", function(){
        $("#cardlistbooking").attr("hidden",false);
        $("#formBooking").attr("hidden", true);
        $("#btnSaveBooking").attr("hidden",true);
    })

    //carga combo viaje desde el combo buque
    $("#bkbuque").on("change", function(){
        var vesselid = $(this).val();

        if($.trim(vesselid) !=''){
            $.get("voyage",{param: vesselid}, function(response){
                $("#bkviaje").empty();
                $("#bkviaje").append("<option value=''></option>")

                $.each(response, function(index,value){
                    $("#bkviaje").append("<option value="+index+">"+value+"</option>");
                })
            })
        }
    })

    //Agrega cont al tabla para nuevo booking
    $(".btnbkAddCont").on("click",function(){
        $(".msgsession").attr("hidden",true);
        var nocont = $("#txtbkCont").val().toUpperCase();
        var tara = $("#txtbktara").val();
        var typecont = $("#txtbktypecont option:selected").val();
        var typegoods = $("#txtbkgooddescr option:selected").text();
        var idtype = $("#txtbkgooddescr option:selected").val();
        var gross = $("#txtbkgross").val();
        var seal =  $("#txtbkseals").val().toUpperCase();
        var movement =  $("#txtdelivery option:selected").text();
        var idmovement =  $("#txtdelivery option:selected").val();

        var headnocont,headtara,headtypecont,headtypegoods,headgroos,headseal,headmovement;

        if(nocont != "" && tara !="" && typecont !="- Select..." && typegoods !="" && gross != "" && seal !="" && movement!=""){
            agregarFilaContBooking(nocont, tara, typecont, typegoods, idtype, gross, seal, movement, idmovement, headnocont, headtara, headtypecont,headtypegoods,headgroos,headseal,headmovement);
           // $("#mNewCont").modal("hide");
            $(".msgsession").attr("hidden",true);

            $("#txtbkCont").val('');
            $("#txtbktara").val('');
            $("#txtbkgross").val('');
            $("#txtbkseals").val('');

        }
        else{
            var sms = "Please, you should fill the blank";
            $(".msgsession").attr("hidden",false);
            $(".msg").html(sms);
        }
    })

    //Obtener puertos desde input
    $(document).on("dblclick", 'input[type=text]',function () {
       let id = this.id;

        $("#mFindPort").modal({backdrop: 'static'});
        $(".txtSearchPort").trigger("focus");
        $(".txtSearchPort").keyup(function (e) {
            if($(".txtSearchPort").val().length >=4){


            var trs=$("#tableTcPortBody tr").length;
            if(trs>=1){
                // Eliminamos la ultima columna
                $("#tableTcPortBody tr").remove();
            }

            var valor = $(".txtSearchPort").val();
            var action = $("#urlgetport").attr("href");
            var method = 'GET';
            var url = action+"/"+valor;

            $.ajax({
                type:method,
                url:url,
                data:{
                    valor:valor
                },
                success:function(obj, status, error){
                   if(status=="success"){
                       //getPortBooking(data.id,data.country,data.port,data.code)

                            // Parse Data
                        var jsonResults = JSON.parse(obj);

                        $("#tableTcPortBody tr").remove();
                         $.each(jsonResults.data , function( index, obj ) {
                         /*   console.log (obj.idport);
                            console.log (obj.country);
                            console.log (obj.code); */
                            agregarFilaPortBooking(obj.idport,obj.country,obj.port,obj.code,index[0],index[1],index.port,index.code)

                        });

                    }
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

        $("#tableFindPort tbody").on("dblclick",".rowtdportBooking",function(){

            if(id=="txtpol"){
                var row = $(this).parents('tr');
                $("#txtpol").val(row.data("port"));
                $("#txtidpol").val(row.data("idport"));

                $("#mFindPort").modal('hide');
                $(".txtSearchPort").val('');
                $("#tableTcPortBody tr").remove();
                id='';
            }

            if(id=="txtpod"){
                var row = $(this).parents('tr');
                $("#txtpod").val(row.data("port"));
                $("#txtidpod").val(row.data("idport"));

                $("#mFindPort").modal('hide');
                $(".txtSearchPort").val('');
                $("#tableTcPortBody tr").remove();
                id='';
            }
            if(id=="txtpd"){
                var row = $(this).parents('tr');
                $("#txtpd").val(row.data("port"));
                $("#txtidpd").val(row.data("idport"));

                $("#mFindPort").modal('hide');
                $(".txtSearchPort").val('');
                $("#tableTcPortBody tr").remove();
                id='';
            }

            if(id=="txtpor"){
                var row = $(this).parents('tr');
                $("#txtpor").val(row.data("port"));
                $("#txtidpor").val(row.data("idport"));

                $("#mFindPort").modal('hide');
                $(".txtSearchPort").val('');
                $("#tableTcPortBody tr").remove();
                id='';
            }
        })
    });




    //TEST PENDIENTE A REVISION
   // $(document).on("keyup", 'input[type=text]',function () {
       // let id = this.id;

        // $("#mFindPort").modal({backdrop: 'static'});
       //  $(".txtSearchPort").trigger("focus");

        //$("#testpol").keydown(function(e) {
        //    if($("#testpol").val().length >3){


                /* var trs=$("#tableTcPortBody tr").length;
                if(trs>=1){
                    // Eliminamos la ultima columna
                    $("#tableTcPortBody tr").remove();
                } */
                /*
                var valor = $("#testpol").val();
                var action = $("#urlgetport").attr("href");
                var method = 'GET';
                var url = action+"/"+valor;

                $.ajax({
                    type:method,
                    url:url,
                    data:{
                        valor:valor
                    },
                    success:function(obj, status, error){
                        if(status=="success"){
                            //getPortBooking(data.id,data.country,data.port,data.code)

                                // Parse Data
                            var jsonResults = JSON.parse(obj);

                            //$("#tableTcPortBody tr").remove();
                            $.each(jsonResults.data , function( index, obj ) {
                               agregarDataList(obj.country,obj.port,obj.code)
                            });

                        }
                    },
                    error:function(obj){
                        var sms = obj.message;
                        $(".msgsession").removeAttr("hidden");
                        $(".msg").html(sms).fadeOut( 1000 );
                    }
                })
            }
        })*/
})


//Functions
function agregarFilaPortBooking(fielda, fieldb, fieldc, fieldd, idfielda, idfieldb, idfieldc,idfieldd) {
    var htmlTags = '<tr data-idport='+fielda+' data-country='+fieldb+' data-port='+fieldc+' data-code='+fieldd+'>' +
           '<td class="rowtdportBooking">' + fielda + '</td>' +
           '<td class="rowtdportBooking">' + fieldb + '</td>' +
           '<td class="rowtdportBooking">' + fieldc + '</td>' +
           '<td class="rowtdportBooking">' + fieldd + '</td>' +
           '</tr>';
    $('#tableFindPort tbody').append(htmlTags);
}


function agregarFilaContBooking(nocont, tara, typecont,typegoods,idtype,gross,seal, movement,idmovement, headnocont, headtara, headtypecont,headtypegoods,headgroos,headseal,headmovement) {
    var htmlTags = '<tr data-nocont='+headnocont+' data-tara='+headtara+' data-typecont='+headtypecont+' data-typegoods='+headtypegoods+' data-gross='+headgroos+' data-seal='+headseal+' data-movement='+headmovement+'>' +
           '<td class="rowtdportBooking">' + nocont + '</td>' +
           '<td class="rowtdportBooking">' + tara + '</td>' +
           '<td class="rowtdportBooking">' + typecont + '</td>' +
           '<td class="rowtdportBooking">' + typegoods + '</td>'+
           '<td class="rowtdportBooking" hidden>' + idtype + '</td>'+
           '<td class="rowtdportBooking">' + gross + '</td>' +
           '<td class="rowtdportBooking">' + seal + '</td>'+
           '<td class="rowtdportBooking">' + movement + '</td>'+
           '<td class="rowtdportBooking" hidden>' + idmovement + '</td>'+
           '<td class="rowtdportBooking"><button type="button" class="btn btn-sm btn-danger"><span class="fa fa-trash-alt"></span></button></td>'+
           '<td class="rowtdportBooking" hidden></td>'
           '</tr>';
    $('#tableBkCont tbody').append(htmlTags);
}

/* Pendiente a revision
function agregarDataList(fieldb,fieldc,fieldd){
    var htmldatalist ='<option data-tokens="'+fieldb+'" value="'+fieldd+'">"'+fieldc+' - '+fieldd+' - '+fieldb+'"</option>'
    $("#testpollist").append(htmldatalist);


}
*/
