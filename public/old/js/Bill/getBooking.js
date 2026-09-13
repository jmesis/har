$(document).ready(function(){

    //Abre modal para seleccionar booking para bl
    $(".btnPanelNewBill").on("click",function(){
        $("#mBillFromBooking").modal({backdrop: 'static'});

        var trs=$("#tbodyFromBooking tr").length;
            if(trs>=1){
                // Eliminamos la ultima columna
                $("#tbodyFromBooking tr").remove();
            }

        $.get("frombooking", function(obj, status, error){
            if(status=="success"){
                // Parse Data
                var jsonResults = JSON.parse(obj);

                  $.each(jsonResults.data , function( index, obj ) {
                  /*   console.log (obj.idport);
                     console.log (obj.country);
                     console.log (obj.code); */
                     agregarFilaBooking(obj.vessel,obj.voyage,obj.nobooking,obj.shipper)

                });
            }
        })
    })

    //Carga contenedores del booking seleccionado
    $("#tableFromBooking tbody").on("click",".rowtdBooking",function(){

        var row = $(this).parents('tr');
        //row.css("background","");
        //row.css("background","darkturquoise");
        var nobooking = (row.data("nobooking"));

        var trs=$("#tbodyContFromBooking tr").length;
            if(trs>=1){
                // Eliminamos la ultima columna
                $("#tbodyContFromBooking tr").remove();

            }

        $.get("contfrombooking", {param: nobooking}, function(obj, status, error){
            if(status=="success"){
                // Parse Data
                var jsonResults = JSON.parse(obj);

                  $.each(jsonResults.data , function( index, obj ) {
                    /* console.log (obj.nocont);
                     console.log (obj.tara);
                     console.log (obj.type); */
                     agregarFilaContFromBooking(nobooking,obj.nocont,obj.tara,obj.type)

                });
            }
        })
    });

    //Carga los datos del booking para el nuevo bl
    $('#btnNewBillFromBooking').on("click",function(){

        $("#mBillFromBooking").modal("hide");
        $("#cardlistbill").attr("hidden",true);
        $("#billofladingNew").attr("hidden",false);

        var datos=[];
        var objetos={};
        var booking,nocont;

        //if($("#selectAll").prop("checked") || $(".itemcont").length == $(".itemcont:checked").length){
            $("#tableContFromBooking input[type=checkbox]:checked").each(function(index){

                var row = $(this).closest("tr")[0];
                booking =  row.cells[1].innerHTML;
                nocont =  row.cells[2].innerHTML;
                //alert(booking+"***"+nocont);
                datos.push({
                    "nobooking"  : booking,
                    "nocont"  : nocont
                });
            });
            objetos.datos=datos;

            $("#bookingNo").html("Booking No.  "+"<span><strong class='bg-primary text-white' id=bknumber>"+booking+"</strong></span>");

            var trs=$("#tbodyBkCont tr").length;
            if(trs>=1){
                // Eliminamos la ultima columna
                $("#tbodyBkCont tr").remove();
            }

            if($.trim(booking) !=''){
                $.get("getbooking",{param: objetos.datos}, function(obj, status, error){

                    $("#bkviaje").empty();
                    $("#bkviaje").append("<option value=''></option>");

                    if(status=="success"){
                        // Parse Data

                        var jsonResults = JSON.parse(obj);
                        //console.log(jsonResults[0]);

                        $("#tableTcPortBody tr").remove();
                        $("#btnbkNewCont").attr("hidden",true);
                          $.each(jsonResults.data , function( index, obj ) {
                          /* console.log (obj.idport);
                             console.log (obj.country);
                             console.log (obj.code); */

                            $("#bkbuque option:selected").text(obj.vessel);
                            $("#bkviaje option:selected").text(obj.voyage);
                            $("#bkviaje").attr("required",false);
                            $("#txtorigen option:selected").text(obj.origen);
                            $("#txtembarque option:selected").text(obj.tipoembarque);
                            $("#bkshipper option:selected").text(obj.shipper);
                            $("#bkconsignee option:selected").text(obj.consignee);
                            $("#bknotify option:selected").text(obj.notify);
                            $("#bknotifys option:selected").text(obj.notifys);
                            $("#bkshipperdir").val(obj.addshipper);
                            $("#bkconsigneedir").val(obj.addconsignee);
                            $("#bknotifydir").val(obj.addnotify);
                            $("#bknotifysdir").val(obj.addnotifys);
                            $("#txtpol").val(obj.pol);
                            $("#txtpod").val(obj.pod);
                            $("#txtpd").val(obj.pd);
                            $("#txtpor").val(obj.por);

                            $("#bkbuque").attr("disabled",true);
                            $("#bkviaje").attr("disabled",true);
                            $("#txtorigen").attr("disabled",true);
                            $("#txtembarque").attr("disabled",true);
                            $("#bkshipper").attr("disabled",true);
                            $("#bkconsignee").attr("disabled",true);
                            $("#bknotify").attr("disabled",true);
                            $("#bknotifys").attr("disabled",true);
                            $("#txtpol").attr("disabled",true);
                            $("#txtpod").attr("disabled",true);
                            $("#txtpd").attr("disabled",true);
                            $("#txtpor").attr("disabled",true);
                             //$("#bkviaje").append("<option value="+obj.voyage+">"+obj.voyage+"</option>");
                             agregarFilaContBooking(obj.nocont,obj.tara,obj.type,obj.typeofgoods,obj.gross,obj.seal,obj.delivery);
                        });
                    }
                })
            }
        //}
        /*else{

            $("#tableContFromBooking input[type=checkbox]:checked").each(function(index){

                var row = $(this).closest("tr")[0];
                booking =  row.cells[1].innerHTML;
                nocont =  row.cells[2].innerHTML;

                datos.push({
                    "nobooking"  : booking,
                    "nocont"  : nocont
                });
            });
            objetos.datos=datos;

            $("#bookingNo").html("Booking No.  "+"<span><strong id=bknumber>"+booking+"</strong></span>");

            var trs=$("#tbodyBkCont tr").length;
            if(trs>=1){
                // Eliminamos la ultima columna
                $("#tbodyBkCont tr").remove();
            }

            if($.trim(booking) !=''){
                $.get("getbooking",{param: objetos.datos}, function(obj, status, error){

                    $("#bkviaje").empty();
                    $("#bkviaje").append("<option value=''></option>");

                    if(status=="success"){
                        // Parse Data
                        var jsonResults = JSON.parse(obj);

                         $("#tableTcPortBody tr").remove();
                          $.each(jsonResults.data , function( index, obj ) {
                          // console.log (obj.idport);

                            $("#bkbuque option:selected").text(obj.vessel);
                            $("#bkviaje option:selected").text(obj.voyage);
                            $("#bkviaje").attr("required",false);
                            $("#txtorigen option:selected").text(obj.origen);
                            $("#txtembarque option:selected").text(obj.tipoembarque);
                            $("#bkshipper option:selected").text(obj.shipper);
                            $("#bkconsignee option:selected").text(obj.consignee);
                            $("#bknotify option:selected").text(obj.notify);
                            $("#bknotifys option:selected").text(obj.notifys);
                            $("#bkshipperdir").val(obj.addshipper);
                            $("#bkconsigneedir").val(obj.addconsignee);
                            $("#bknotifydir").val(obj.addnotify);
                            $("#bknotifysdir").val(obj.addnotifys);
                            $("#txtpol").val(obj.pol);
                            $("#txtpod").val(obj.pod);
                            $("#txtpd").val(obj.pd);
                            $("#txtpor").val(obj.por);

                            $("#bkbuque").attr("disabled",true);
                            $("#bkviaje").attr("disabled",true);
                            $("#txtorigen").attr("disabled",true);
                            $("#txtembarque").attr("disabled",true);
                            $("#bkshipper").attr("disabled",true);
                            $("#bkconsignee").attr("disabled",true);
                            $("#bknotify").attr("disabled",true);
                            $("#bknotifys").attr("disabled",true);
                            $("#txtpol").attr("disabled",true);
                            $("#txtpod").attr("disabled",true);
                            $("#txtpd").attr("disabled",true);
                            $("#txtpor").attr("disabled",true);
                             //$("#bkviaje").append("<option value="+obj.voyage+">"+obj.voyage+"</option>");
                             agregarFilaContBooking(obj.nocont,obj.tara,obj.type,obj.typeofgoods,obj.gross,obj.seal,obj.delivery);
                        });
                    }
                })
            }
        }*/

    });
})

function agregarFilaBooking(vessel,voyage,nobooking,shipper){
    var htmlTags = '<tr data-vessel='+vessel+' data-voyage='+voyage+' data-nobooking='+nobooking+' data-shipper='+shipper+'>' +
           '<td class="rowtdBooking">' + vessel + '</td>' +
           '<td class="rowtdBooking">' + voyage + '</td>' +
           '<td class="rowtdBooking">' + nobooking + '</td>' +
           '<td class="rowtdBooking">' + shipper + '</td>'
           '</tr>';
    $('#tableFromBooking tbody').append(htmlTags);
}

function agregarFilaContBooking(nocont,tara,type,typeofgoods,gross,seal,delivery){
    var htmlTags = '<tr data-nocont='+nocont+' data-tara='+tara+' data-type='+type+' data-typeofgoods='+typeofgoods+' data-gross='+gross+' data-seal='+seal+' data-typeofgoods='+delivery+'>' +
           '<td class="rowtdCont">' + nocont + '</td>' +
           '<td class="rowtdCont">' + tara + '</td>' +
           '<td class="rowtdCont">' + type + '</td>' +
           '<td class="rowtdCont">' + typeofgoods + '</td>'+
           '<td class="rowtdCont">' + gross + '</td>' +
           '<td class="rowtdCont">' + seal + '</td>' +
           '<td class="rowtdCont">' + delivery + '</td>'+
           '<td class="rowtdCont" style="text-align: center"><button type="button" class="btn btn-sm btn-dark itemnewcontbl"><i class="fa fa-folder-plus mr-1"></i>Add Item</td>'
           '</tr>';
    $('#tableBkCont tbody').append(htmlTags);
}

function agregarFilaContFromBooking(booking,nocont,tara,type){
    var htmlTags = '<tr data-booking='+booking+' data-nocont='+nocont+' data-tara='+tara+' data-type='+type+'>' +
        '<td class="rowtdContFb"><input type="checkbox" class="itemcont"></td>' +
        '<td class="rowtdContFb" hidden>' + booking + '</td>' +
        '<td class="rowtdContFb">' + nocont + '</td>' +
        '<td class="rowtdContFb">' + tara + '</td>' +
        '<td class="rowtdContFb">' + type + '</td>'
        '</tr>';
    $('#tableContFromBooking tbody').append(htmlTags);
}


/*
    $("#tableFromBooking tbody").on("dblclick",".rowtdBooking",function(){
        $("#mBillFromBooking").modal("hide");
        $("#cardlistbill").attr("hidden",true);
        $("#billofladingNew").attr("hidden",false);

        var row = $(this).parents('tr');
        var nobooking = (row.data("nobooking"));
        $("#bookingNo").html("Booking No.  "+"<span><strong id=bknumber>"+nobooking+"</strong></span>");
        var trs=$("#tbodyBkCont tr").length;
            if(trs>=1){
                // Eliminamos la ultima columna
                $("#tbodyBkCont tr").remove();
            }

        if($.trim(nobooking) !=''){
            $.get("getbooking",{param: nobooking}, function(obj, status, error){

                $("#bkviaje").empty();
                $("#bkviaje").append("<option value=''></option>");

                if(status=="success"){
                    // Parse Data
                    var jsonResults = JSON.parse(obj);

                     $("#tableTcPortBody tr").remove();
                      $.each(jsonResults.data , function( index, obj ) {
                      // console.log (obj.idport);

                        $("#bkbuque option:selected").text(obj.vessel);
                        $("#bkviaje option:selected").text(obj.voyage);
                        $("#bkviaje").attr("required",false);
                        $("#txtorigen option:selected").text(obj.origen);
                        $("#txtembarque option:selected").text(obj.tipoembarque);
                        $("#bkshipper option:selected").text(obj.shipper);
                        $("#bkconsignee option:selected").text(obj.consignee);
                        $("#bknotify option:selected").text(obj.notify);
                        $("#bknotifys option:selected").text(obj.notifys);
                        $("#bkshipperdir").val(obj.addshipper);
                        $("#bkconsigneedir").val(obj.addconsignee);
                        $("#bknotifydir").val(obj.addnotify);
                        $("#bknotifysdir").val(obj.addnotifys);
                        $("#txtpol").val(obj.pol);
                        $("#txtpod").val(obj.pod);
                        $("#txtpd").val(obj.pd);
                        $("#txtpor").val(obj.por);

                        $("#bkbuque").attr("disabled",true);
                        $("#bkviaje").attr("disabled",true);
                        $("#txtorigen").attr("disabled",true);
                        $("#txtembarque").attr("disabled",true);
                        $("#bkshipper").attr("disabled",true);
                        $("#bkconsignee").attr("disabled",true);
                        $("#bknotify").attr("disabled",true);
                        $("#bknotifys").attr("disabled",true);
                        $("#txtpol").attr("disabled",true);
                        $("#txtpod").attr("disabled",true);
                        $("#txtpd").attr("disabled",true);
                        $("#txtpor").attr("disabled",true);
                         //$("#bkviaje").append("<option value="+obj.voyage+">"+obj.voyage+"</option>");
                         agregarFilaContBooking(obj.nocont,obj.tara,obj.type,obj.typeofgoods,obj.gross,obj.seal,obj.delivery)
                    });
                }
            })
        }
    });*/
