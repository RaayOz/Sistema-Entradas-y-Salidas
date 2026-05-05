<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function setMensaje($tipo, $texto)
{
    $_SESSION['msg'] = [
        "tipo" => $tipo,
        "texto" => $texto
    ];
}

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
