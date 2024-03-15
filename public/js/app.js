
console.log("app.js cargado correctamente");

$('form').on('submit', function(){
    $(this).find('input[type=submit]').attr('disabled', true);
});