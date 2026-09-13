$(document).ready(function(){

    //cierra el modal de booking sin bl
    $("#btnCloseFromBooking").on("click",function(){
        $("#mBillFromBooking").modal("hide");
    })

    $("#btnCloseGoodsBl, #btnCloseGoodsBl").on("click",function(){
        $("#mGoodsbl").modal("hide");
    })

    //selecciona y desmarca todos los registros
    $("#selectAll").on("click",function(){
        $(".itemcont").prop("checked", this.checked );
    })

    //selecciona uno o todos los registros
    $("#tableContFromBooking tbody").on("click",".itemcont", function() {
        if ($(".itemcont").length == $(".itemcont:checked").length) {
          $("#selectall").prop("checked", true);
        }
        else {
          $("#selectall").prop("checked", false);

        }
    });


    //abre modal de descripcion de mercancia
    $("body").on("click","#tbodyBkCont tr .itemnewcontbl",function(e){
        var row = $(this).parents("tr");
        var equipment = row.data("nocont");
        var gross = row.data("gross");
        var booking = $("#bknumber").html();

        $("#mGoodsbl").modal({backdrop: 'static'});
        $("#txtequipmentno").val(equipment);
        $("#txtgrossbl").val(gross);
        $("#bookingnoGoodsBl").val(booking);
    })

    $("input[name=optradio]").on("click",function(){
        var input = $("input:radio[name=optradio]:checked").val();
        if(input == 'dc'){
            $("#fieldimo").attr("hidden",false);
            $("#fieldun").attr("hidden",false);
            $("#fieldfp").attr("hidden",false);
        }
        else{
            $("#fieldimo").attr("hidden",true);
            $("#fieldun").attr("hidden",true);
            $("#fieldfp").attr("hidden",true);
        }
    })

})

