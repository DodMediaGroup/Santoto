jQuery(document).ready(function($){
    $('#Alumnos_password').val($('#Alumnos_username').val());
    $('#Alumnos_username').on('keyup', function(){
        $('#Alumnos_password').val($('#Alumnos_username').val());
    });
});