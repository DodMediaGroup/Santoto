jQuery(document).ready(function($){
    $('.btn__send-form').on('click', function(e){
        e.preventDefault();
        var form = $(this).parents('tr').find('form');
        form.submit();
    });

    $('#Alumnos_username').on('keyup', function(e){
        var value = $(this).val();
        if(value.length >= 3){
            getAlumnos(value);
        }
        else
            $('#alumnos_showload').empty();
    });
});

var getAlumnos = function(value){
    var url = $('#alumno-form').attr('action');
    $.ajax(url, {
        type: 'GET',
        dataType: 'json',
        data: {username: value}
    })
        .done(function(data){
            var table = $('#alumnos_showload');
            table.empty();
            $.each(data, function(key, value){
                var tr = $('<tr>')
                    .append($('<td>').html(key + 1))
                    .append($('<td>').html(value.username))
                    .append($('<td>').html(value.nombres+' '+value.apellidos));
                if(value.grupo == ''){
                    tr.append($('<td>')
                        .append($('<div>', {class: 'btn-group btn-group-xs'})
                            .append($('<a>', {
                                text: 'Agregar',
                                class: 'btn btn-success'})
                                .attr('href', (table.attr('data-url-go')+'?alumno='+value.id)))))
                }
                else{
                    tr.append($('<td>'));
                }
                table.append(tr);
            });
        })
        .fail(function(){

        })
        .always(function(){

        });
};