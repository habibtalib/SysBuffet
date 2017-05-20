        window.onload = function(){
              $('#success-aceptar').hide();
              $('#success-rechazar').hide();
        }   

        function rechazar(id){
          $('#idRechazar').val(id);
        }

        function efectuarRechazo(){
          motivoRechazo = $('#motivo').val();
          a_rechazar = $('#idRechazar').val();
          var url_enviar = "/"+'pedidos'+"/"+a_rechazar+"/rechazar";
          var token = $('#btn-token').data('token');
            $.ajax({
            url:url_enviar,
            type: 'get',
            data: {_method: 'get', motivo:motivoRechazo, _token : token},
            success:function(msg){
              if (msg.msj == 'destroyed'){
                $('#success-rechazar').fadeIn('slow');
                setTimeout(function(){
                              location.reload();
                }, 2000);
              }
            }
            });
        }

        function aceptar(id){
          $('#idAceptar').val(id);
        }

        function efectuarPedido(){
          idAceptar = $('#idAceptar').val();
          var url_enviar = "/"+'pedidos'+"/"+idAceptar+"/aceptar";
          var token = $('#btn-token').data('token');
            $.ajax({
            url:url_enviar,
            type: 'get',
            data: {_method: 'get', _token : token},
            success:function(msg){
              if (msg.msj == 'aceptado'){
                $('#success-aceptar').fadeIn('slow');
                setTimeout(function(){
                              location.reload();
                }, 2000);
              }
            }
            });
        }
