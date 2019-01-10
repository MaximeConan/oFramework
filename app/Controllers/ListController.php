<?php

namespace oFramework\Controllers;

use oFramework\Controllers\CoreController;

use oKanban\Models\ListModel;

use oFramework\Utils\DBData;

class ListController extends CoreController
{
    public function createList()
    {
        $list = new ListModel;

        $name = strval($_POST['name']);
        $order = intval($_POST['order']);

        $list
            ->setName($name)
            ->setOrder($order)
        ;

        $dbData = new DBData;
        $list = $dbData->createList($list);

        dump($list);
        exit;

        /*
        $listId = $dbData->createListBis($name, $order);

        if (isset($listId)) {
            // ...
        }
        */
    }
}
