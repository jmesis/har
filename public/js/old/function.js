jQuery(function(){

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


//esta funcion te permite trabajar con ambos modal
(function($, window) {
    'use strict';

    var MultiModal = function(element) {
        this.$element = $(element);
        this.modalCount = 0;
    };

    MultiModal.BASE_ZINDEX = 1040;

    MultiModal.prototype.show = function(target) {
        var that = this;
        var $target = $(target);
        var modalIndex = that.modalCount++;

        $target.css('z-index', MultiModal.BASE_ZINDEX + (modalIndex * 20) + 10);

        // Bootstrap triggers the show event at the beginning of the show function and before
        // the modal backdrop element has been created. The timeout here allows the modal
        // show function to complete, after which the modal backdrop will have been created
        // and appended to the DOM.
        window.setTimeout(function() {
            // we only want one backdrop; hide any extras
            if(modalIndex > 0)
                $('.modal-backdrop').not(':first').addClass('hidden');

            that.adjustBackdrop();
        });
    };

    MultiModal.prototype.hidden = function(target) {
        this.modalCount--;

        if(this.modalCount) {
           this.adjustBackdrop();
            // bootstrap removes the modal-open class when a modal is closed; add it back
            $('body').addClass('modal-open');
        }
    };

    MultiModal.prototype.adjustBackdrop = function() {
        var modalIndex = this.modalCount - 1;
        $('.modal-backdrop:first').css('z-index', MultiModal.BASE_ZINDEX + (modalIndex * 20));
    };

    function Plugin(method, target) {
        return this.each(function() {
            var $this = $(this);
            var data = $this.data('multi-modal-plugin');

            if(!data)
                $this.data('multi-modal-plugin', (data = new MultiModal(this)));

            if(method)
                data[method](target);
        });
    }

    $.fn.multiModal = Plugin;
    $.fn.multiModal.Constructor = MultiModal;

    $(document).on('show.bs.modal', function(e) {
        $(document).multiModal('show', e.target);
    });

    $(document).on('hidden.bs.modal', function(e) {
        $(document).multiModal('hidden', e.target);
    });
}(jQuery, window));
})


//FUNCTIONS
function showMessage(message,error,title,reload,window){
    if(reload==true){
        if(window=="informacion"){
            $("#modalSuccess .modal-header").removeClass("bg-warning bg-danger").addClass("bg-primary");
            $("#modalSuccess").modal("show");
            $("#msgtitle").html(title);
            $("#msgerror").html(message);
            $("#btnModalSuccess").on('click',function(){
                location.reload();
            });
        }
        else{
            if(window=="error"){
                $("#modalSuccess .modal-header").removeClass("bg-primary bg-warning").addClass("bg-danger");
                $("#modalSuccess").modal("show");
                $("#msgtitle").html(title);
                $("#msgerror").html(message);

            }
            else{
                $("#modalSuccess .modal-header").removeClass("bg-primary bg-danger").addClass("bg-warning");
                $("#modalSuccess").modal("show");
                $("#msgtitle").html(title);
                $("#msgerror").html(message);
            }
        }
    }
    else{
        if(window=="informacion"){
            $("#modalSuccess .modal-header").removeClass("bg-warning bg-danger").addClass("bg-primary");
            $("#modalSuccess").modal("show");
            $("#msgtitle").html(title);
            $("#msgerror").html(message);
            // $("#modalSuccess .modal-header").addClass("bg-primary");
        }
        else{
            if(window=="error"){
                $("#modalSuccess .modal-header").removeClass("bg-primary bg-warning").addClass("bg-danger");
                $("#modalSuccess").modal("show");
                $("#msgtitle").html(title);
                $("#msgerror").html(message);
                // $("#modalSuccess .modal-header").addClass("bg-danger");
            }
            else{
                $("#modalSuccess .modal-header").removeClass("bg-primary bg-danger").addClass("bg-warning");
                $("#modalSuccess").modal("show");
                $("#msgtitle").html(title);
                $("#msgerror").html(message);
                // $("#modalSuccess .modal-header").addClass("bg-warning");

                // $("#btnModalSuccess").on('click',function(){
                //     location.reload();
                // })
            }
        }
    }
}



function showMessageDelete(message,title){
    $("#modalDelete").modal("show");
    $("#msgtitledelete").html(title);
    $("#msgerrordelete").html(message);
    $("#modalDelete .modal-header").addClass("bg-danger");
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
