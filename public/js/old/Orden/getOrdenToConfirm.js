$(document).ready(function(){

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#txtordenconf").delayPasteKeyUp(function(){
        var bulto = $("#txtordenconf").val();
        var embarque = $.trim($("#txtembarqueconf option:selected").text());
        $.ajax({
            type: "post",
            url: "listaBultoConfirmado",
            data: {
                embarque: embarque,
                pieza: bulto,
            },
            success: function (response) {
                if(response.success == "true"){
                    $(".TablaListaOrdenConfirmadaBody tr").remove();
                    getOrdenes(embarque);
                }
                else{
                    var message="Error, contactar al administrador del sistema";
                    var title="Atencion";
                    var error ='';
                    var win = 'informacion';
                    var reload=false;
                    showMessage(message,error,title,reload,win);
                }
            }
        });
        $("#txtordenconf").val("");
     }, 200);
})


$.fn.delayPasteKeyUp = function(fn, ms){
  var timer = 0;
  $(this).on("propertychange input", function()
  {
   clearTimeout(timer);
   timer = setTimeout(fn, ms);
  });
};
