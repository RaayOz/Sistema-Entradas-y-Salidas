<?php
/**
 * Funciones para manejar mensajes flash en la sesión.
 *
 * Permite almacenar un mensaje en la sesión y mostrarlo una sola vez
 * en la siguiente carga de página.
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/**
 * Guarda un mensaje temporal en la sesión.
 *
 * @param string $tipo  Tipo de mensaje: 'exito', 'error', etc.
 * @param string $texto Texto que se mostrará al usuario.
 * @return void
 */
function setMensaje($tipo, $texto)
{
    $_SESSION['msg'] = [
        "tipo" => $tipo,
        "texto" => $texto
    ];
}

/**
 * Muestra el mensaje guardado en sesión y lo elimina inmediatamente.
 *
 * @return void
 */
function mostrarMensaje()
{
    if (isset($_SESSION['msg'])) {
        $tipo = $_SESSION['msg']['tipo'];
        $texto = $_SESSION['msg']['texto'];
        echo "
        <div id='modalMensaje' class='modal-mensaje'>
            <div class='modal-contenido $tipo'>
                <p>$texto</p>
            </div>
        </div>
        ";
        unset($_SESSION['msg']);
    }
}
