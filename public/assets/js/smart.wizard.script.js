$(document).ready(function () {
//    $.noConflict();


    $("#smartwizard").on("showStep", function (e, anchorObject, stepNumber, stepDirection, stepPosition) {
        if (stepPosition === 'first') {
            $("#prev-btn").addClass('disabled');
        } else if (stepPosition === 'final') {
            $("#next-btn").addClass('disabled');
        } else {
            $("#prev-btn").removeClass('disabled');
            $("#next-btn").removeClass('disabled');
        }
    });
    /*var btnFinal = $('<button></button>').text('Finalizar')
        .addClass('btn btn-info')
        .on('click', function () { alert('Final Clickado'); });*/
    var btnCancelar = $('<button></button>').text('Cancelar')
        .addClass('btn btn-danger')
        .on('click', function () { $('#smartwizard').smartWizard("reset"); });

    $('#smartwizard').smartWizard({
        selected: 0,
        theme: 'default',
        showStepURLhash: true,
        transitionEffect: "fade",
        keyNavigation:false,
        lang:{
            next:'Siguiente',
            previous:'Atras'
        },
        toolbarSettings: {
            toolbarPosition: 'bottom',
            toolbarButtonPosition: 'end',
            //toolbarExtraButtons: [btnFinal]
        }
    });


    $("#reset-btn").on("click", function () {
        $('#smartwizard').smartWizard("reset");
        return true;
    });

    $("#prev-btn").on("click", function () {
        $('#smartwizard').smartWizard("prev");
        return true;
    });

    $("#next-btn").on("click", function () {
        $('#smartwizard').smartWizard("next");
        return true;
    });

});
