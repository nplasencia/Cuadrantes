(function($){
    $('#holidays1').daterangepicker(
        {
            format: 'DD/MM/YYYY',
            separator: ' - ',
            locale: {
                applyLabel: 'Guardar',
                cancelLabel: 'Cancelar',
                fromLabel: 'Desde',
                toLabel: 'Hasta',
                daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                firstDay: 1
            }
        }
    );

    $('#holidays2').daterangepicker(
        {
            format: 'DD/MM/YYYY',
            separator: ' - ',
            locale: {
                applyLabel: 'Guardar',
                cancelLabel: 'Cancelar',
                fromLabel: 'Desde',
                toLabel: 'Hasta',
                daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                firstDay: 1
            }
        }
    );

    $('#examplemorning').DataTable(
        {
            scrollY:        "500px",
            scrollX:        true,
            scrollCollapse: true,
            paging:         false,
            searching:      false,
            info:           false,
            ordering:       false,
            fixedColumns:   {
                leftColumns: 1,
            }
        }
    );

    $('#exampleafternoon').DataTable(
        {
            scrollY:        "500px",
            scrollX:        true,
            scrollCollapse: true,
            paging:         false,
            searching:      false,
            info:           false,
            ordering:       false,
            fixedColumns:   {
                leftColumns: 1,
            }
        }
    );

}(jQuery));

$(document).ready(function () {
    
    /*$('.btn-delete').click(function (e) {
        e.preventDefault();
        
        var form = $('#form-delete');
        
        var button = $(this);
        var bus = button.closest('.bus');
        var id = bus.data('id');
        
        var action = form.attr('action').replace(':id', id);
        bus.addClass('hidden');
        $('#alert-success').removeClass('hide');
        $('#alert-success').addClass('in');
        $.post(action, form.serialize(), function (response) {
            $('#alert-success').text(response['msg']);
        }).fail(function(){
            //alert
        })
    })*/

    $('#routeSelect').change(function(e) {
        e.preventDefault();

        var form = $('#form-timetable');

        var select = $(this);
        var selectTimetable = $('#timetableSelect');

        var action = form.attr('action').replace(':route_id', select.val());
        select.prop('disabled', 'disabled');
        $.post(action, form.serialize(), function (response) {
            selectTimetable.find('option').remove();
            $.each(response, function(i, v){
                selectTimetable.append('<option value="' + v[0] + '">' + v[1] + '</option>');
            })
        }).fail(function(response){
            //Mensaje de error
        })
        select.prop('disabled', false);

    });
    
});