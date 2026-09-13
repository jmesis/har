$(document).ready(function(){

    var id;
    var row;
    var nombre;
    var apellidop;
    var apellidom;
    var ci;
    var pasaporte;
    var calle;
    var no_calle;
    var apto;
    var entrecalle;
    var nacionalidad;
    var telefono;
    var provincia;
    var municipio;
    var cp;


    //Carga los datos de una tabla en formulario
    $("#tableTcRemDestBody tr").on("click",".btnEditarRemDest",function(e){
        $(".inputremdest").prop("disabled",false);
        row = $(this).parents('tr');
        id = row.data('idremdest');
        ci=row.data('ci');
        nombre=row.data('nombre');
        apellidop = row.data('apellidop');
        apellidom = row.data('apellidom');
        pasaporte=row.data('pasaporte');
        calle=row.data('calle');
        no_calle = row.data('no_calle');
        apto=row.data('apto');
        entrecalle=row.data('entrecalle');
        nacionalidad = row.data('nacionalidad');
        telefono=row.data('telefono');
        provincia=row.data('provincia');
        municipio=row.data('municipio');
        cp=row.data('cp')

        e.preventDefault();

        $("#txtci").val(ci);
        $("#txtnombre").val(nombre);
        $("#txtapellidop").val(apellidop);
        $("#txtapellidom").val(apellidom);
        $("#txtpasaporte").val(pasaporte);
        $("#txttelefono").val(telefono);
        $("#txtnacionalidad").val(nacionalidad);
        $("#txtcalle").val(calle);
        $("#txtnocalle").val(no_calle);
        $("#txtapto").val(apto);
        $("#txtentrecalle").val(entrecalle);
        $("#txtprov option:selected").text(provincia);
        $("#txtprov option:selected").val(provincia);
        $("#txtmcpio").append("<option value="+municipio+">"+municipio+"</option>");
        $("#txtcp").append("<option value="+cp+">"+cp+"</option>");

        $("#title-mremdest").html("Actualizar Cliente");
        $("#btnUpdateRemDest").attr("hidden",false);
        $("#btnSaveRemDest").attr("hidden",true);
        // $("#txtci").attr("disabled",true);


        $("#mRemDest").modal({backdrop: 'static'});
        $("#txtci").focus();
    })

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btnUpdateRemDest").on("click",function(e){
        e.preventDefault();

        var validaFormulario = $(".formRemDest").validate({
            rules:{
                txtci:{
                    // required:true,
                    digits:true,
                    rangelength: [11, 11]
                },
                txtnombre:"required",
                txtapellidop:"required",
                txtapellidom:"required",
                txttelefono:{
                    required:true,
                    digits:true
                },
                txtnacionalidad:"required",
                txtcalle:"required",
                txtnocalle:{
                    required:true
                },
                txtentrecalle:"required",
                txtprov:"required",
                txtmcpio:"required",
                txtcp:"required"
            },
            messages:{
                txtci:{
                    // required:"Este campo es obligatorio",
                    digits:"Este campo solo permite digitos",
                    rangelength:"Este campo solo permite 11 caracteres"
                },
                txtnombre:"Este campo es obligatorio",
                txtapellidop:"Este campo es obligatorio",
                txtapellidom:"Este campo es obligatorio",
                txttelefono:{
                    required:"Este campo es obligatorio",
                    digits:"Este campo solo permite digitos"
                },
                txtnacionalidad:"Este campo es obligatorio",
                txtcalle:"Este campo es obligatorio",
                txtnocalle:"Este campo es obligatorio",
                txtentrecalle:"Este campo es obligatorio",
                txtprov:"Este campo es obligatorio",
                txtmcpio:"Este campo es obligatorio",
                txtcp:"Este campo es obligatorio"
            }
        })


        if(validaFormulario.form()){

            var ci = $("#txtci").val();
            var nombre = $("#txtnombre").val();
            var apellidop = $("#txtapellidop").val();
            var apellidom = $("#txtapellidom").val();
            var pasaporte = $("#txtpasaporte").val();
            var telefono = $("#txttelefono").val();
            var nacionalidad = $("#txtnacionalidad").val();
            var calle = $("#txtcalle").val();
            var no_calle = $("#txtnocalle").val();
            var apto = $("#txtapto").val();
            var entrecalle = $("#txtentrecalle").val();
            var provincia = $("#txtprov option:selected").text();
            var municipio = $("#txtmcpio option:selected").text();
            var cp = $("#txtcp option:selected").val();

            var action = $("#urlremdestupdate").attr("href");
            var method = 'PATCH';
            var url = action+"/"+id;

            $.ajax({
                type:method,
                url:url,
                data:{
                    id:id,
                    ci:ci,
                    nombre:nombre,
                    apellidop:apellidop,
                    apellidom:apellidom,
                    pasaporte:pasaporte,
                    telefono:telefono,
                    nacionalidad:nacionalidad,
                    calle:calle,
                    no_calle:no_calle,
                    apto:apto,
                    entrecalle:entrecalle,
                    provincia:provincia,
                    municipio:municipio,
                    cp:cp
                },
                success:function(data){
                    if(data.success=="true"){
                        $("#msgsession").attr("hidden");
                        var message=data.message;
                        var title="Success!!!";
                        var error ='';
                        var reload = true;
                        var windows="informacion";
                        showMessage(message,error,title,reload,windows);
                        $(".formRemDest").trigger("reset");
                        $("#btnUpdateRemDest").attr("hidden");
                        $("#btnSaveRemDest").removeAttr("hidden");
                        $("#mRemDest").modal('hide');
                        $("#txtci").removeAttr("disabled");
                        $("#txtprov").prop('selectedIndex',0);
                        $("#txtmcpio").prop('selectedIndex',0);
                        $("#txtcp").prop('selectedIndex',0);

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
