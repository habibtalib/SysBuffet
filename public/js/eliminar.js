var a_eliminar;
window.onload = function(){
      $('#error-message').hide();
      $('#success-message').hide();
      //$('#loginModal').modal(); sirve para abrir el modal cuando carga la pagina
}

function eliminar(recurso, id){
  a_eliminar = { resource: recurso, id_d: id };
  $('#eliminarModal').modal();

}

function eliminarItem(){
  var url_enviar = "/"+a_eliminar.resource+"/"+a_eliminar.id_d;
  var token = $('#btn-token').data('token');
    $.ajax({
    url:url_enviar,
    type: 'delete',
    data: {_method: 'delete', _token : token},
    success:function(msg){
      if (msg.msj == 'destroyed'){
        $( "#error-message" ).hide();
        $('#success-message').fadeIn('slow');
        setTimeout(function(){
                      location.reload();
        }, 2000);
      } else{
          $( "#error-message" ).fadeIn( "slow");
      }
    }
    });
}
