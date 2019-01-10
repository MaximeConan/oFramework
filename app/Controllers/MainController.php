<?php

namespace oFramework\Controllers;

use oFramework\Controllers\CoreController;
use oFramework\Utils\DBData;

class MainController extends CoreController
{
    public function home()
    {
        $dbData = new DBData;
        $lists = $dbData->getLists();

        dump($lists);

        $this->show('home');
    }
}
