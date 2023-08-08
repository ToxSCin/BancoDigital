<?php

    use BancoDigital\Controller\ChavePixController;
    use BancoDigital\Controller\CorrentistaController;

    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    switch ($url)
    {
        case '/correntista/salvar':
            CorrentistaController::salvar();
        break;

        case '/conta/extrato':
        break;

        case '/conta/pix/enviar':
        break;

        case '/conta/pix/receber':
        break;

        case '/correntista/entrar':
            CorrentistaController::login();
        break;

        default:
            http_response_code(403);
        break;
    }

?>