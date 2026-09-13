$(document).ready(function(){
    //carga el modal de embarque para modificar informacion
    $(".tablelistadoembarque tbody").on("click",".btn-editarembarque",function(){

        $("#title-membarque").html("Actualizar Embarque");

        var row = $(this).parents('tr');
        //row.css("background","");
        //row.css("background","darkturquoise");
        var noembarque = (row.data("no_embarque"));
        var origen = (row.data("origen"));
        var tipoembarque = (row.data("tipoembarque"));
        var buque = (row.data("buque"));
        var viaje = (row.data("viaje"));
        var embarcador = (row.data("embarcador"));
        var consignado = (row.data("consignado"));
        var pol = (row.data("pol"));
        var pod = (row.data("pod"));
        var idpol = (row.data("idpol"));
        var idpod = (row.data("idpod"));
        var tipocont = (row.data("tipocont"));
        var contenedor = (row.data("contenedor"));
        var p_bruto = (row.data("p_bruto"));
        var p_neto = (row.data("p_neto"));
        var tara = (row.data("tara"));
        var fecha_est = (row.data("fecha_est")).substring(0,10);
        var codigoorigen = (row.data("codigoorigen"));
        var codigoembarque = (row.data("codigoembarque"));

        $("#m-embarque").modal({backdrop: 'static'});
        $("#txtembarque").attr("hidden",false);
        $("#btn-actembarque").attr("hidden",false);
        $("#btn-guardaembarque").attr("hidden",true);
        $("#txtviaje").empty();

        $(".txtembarque").val(noembarque);
        $(".title-membarque").html("Actualizar Embarque");
        $(".txtorigen option:selected").text(origen);
        $(".txtorigen option:selected").val(codigoorigen);
        $(".txtembarcador option:selected").text(embarcador);
        $(".txtconsignado option:selected").text(consignado);
        $(".txtembarcador option:selected").val(embarcador);
        $(".txtconsignado option:selected").val(consignado);
        $(".txttipoemb option:selected").text(tipoembarque);
        $(".txttipoemb option:selected").val(codigoembarque);
        $(".txttipocont option:selected").text(tipocont);
        $(".txttipocont option:selected").val(tipocont);
        $(".txtbuque option:selected").text(buque);
        $(".txtbuque option:selected").val(buque);
        $(".txtviaje").append("<option value="+viaje+">"+viaje+"</option>");
        $(".txtcont").val(contenedor);
        $(".txtpol").val(pol);
        $(".txtpod").val(pod);
        $(".idtxtpol").val(idpol);
        $(".idtxtpod").val(idpod);
        $(".txtpesob").val(p_bruto);
        $(".txtpeson").val(p_neto);
        $(".txttara").val(tara);
        $(".txtfechaest").val(fecha_est);
        $(".txtembarque").val(noembarque);

        $(".txtbuque").attr("required",true);
        $(".txtviaje").attr("required",true);
        $(".txtpol").attr("required",true);
        $(".txtpod").attr("required",true);
        $(".txttipocont").attr("required",true);
        $(".idtxtpod").attr("required",true);
        $(".idtxtpod").attr("required",true);

        $(".idtxtpol").attr("disabled",true);
        $(".idtxtpod").attr("disabled",true);
        $(".txtbuque").attr("disabled",false);
        $(".txtviaje").attr("disabled",false);
        $(".txtfechaest").attr("disabled",false);
        $(".txtpol").attr("disabled",false);
        $(".txtpod").attr("disabled",false);
        $(".txtcont").attr("disabled",false);
        $(".txttipocont").attr("disabled",false);
        $(".txttara").attr("disabled",false);
        $(".txtpesob").attr("disabled",false);
        $(".txtpeson").attr("disabled",false);

    })
})
