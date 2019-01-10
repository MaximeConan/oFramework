<?php

namespace oFramework\Controllers;

class ErrorController extends CoreController
{
    public function page404()
    {
        http_response_code(404);
        $this->show('404');
    }
}
