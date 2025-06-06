$(document).ready(function () {
    $('#formulario').on('submit', function (e) {
      e.preventDefault();
  
      $.ajax({
        type: 'POST',
        url: 'procesar.php',
        data: $(this).serialize(),
        dataType: 'json',
        success: function (respuesta) {
          if (respuesta.estado === 'ok') {
            $('#respuesta').html(`
              <div class="alert alert-success" role="alert">
                <i class="fas fa-check-circle"></i> ${respuesta.mensaje}
              </div>
            `);
            $('#formulario')[0].reset(); // limpia el formulario
          } else {
            $('#respuesta').html(`
              <div class="alert alert-danger" role="alert">
                <i class="fas fa-times-circle"></i> ${respuesta.mensaje}
              </div>
            `);
          }
        },
        error: function () {
          $('#respuesta').html(`
            <div class="alert alert-warning" role="alert">
              <i class="fas fa-exclamation-triangle"></i> Error en la comunicación con el servidor.
            </div>
          `);
        }
      });
    });
  });