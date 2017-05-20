
        operacion = '{{ $operacion }}';
        carrito = {};
        var input = document.getElementById('carrito');
        input.value = null;

        function agregarProducto()
        {
          var productoNombre = $('#productoComprar :selected').text();
          var productoComprar = $("#productoComprar").val();
          var cantidadComprar = $("#cantidadComprar").val();
          carrito[productoComprar] = { cantidad: cantidadComprar, producto_id: productoComprar };

          $("#"+productoComprar).remove(); 
          $('#productosComprados').append('<tr class="table-gray" id="' + productoComprar +'"> <th>' + productoNombre + '</th> <th>' + cantidadComprar + '</th> <th><button class="btn-sm btn-danger" onclick="borrarDelCarrito('+productoComprar+')"> Remover </a></th> </tr>' );

          $('#carrito').val(JSON.stringify(carrito));
        }

        function borrarDelCarrito(idProducto)
        {
          delete carrito[idProducto]; // Chequear valores null, en servidor.
          $("#"+idProducto).remove(); 
          $('#carrito').val(JSON.stringify(carrito));
        }

        function agregarAlCarrito(productoNuevo, cantidadNueva){
          carrito[productoNuevo] = { cantidad: cantidadNueva, producto_id: productoNuevo };
          $('#carrito').val(JSON.stringify(carrito));
        }