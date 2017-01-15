jQuery(document).ready(function($){
    $('.btn__send-form').on('click', function(e){
        e.preventDefault();
        var form = $(this).parents('tr').find('form');
        form.submit();
    });
});