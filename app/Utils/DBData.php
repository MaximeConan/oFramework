<?php

namespace oFramework\Utils;

use \PDO;
use \Exception;

use oKanban\Models\ListModel;

class DBData
{
    /**
     * @var PDO
     */
    private $databaseHandler;

    /**
     * @return void
     */
    public function __construct()
    {
        // Récupération des données du fichier de config
        //   la fonction parse_ini_file parse le fichier et retourne un array associatif
        // Attention, "config.conf" ne doit pas être versionné,
        //   on versionnera plutôt un fichier d'exemple "config.dist.conf" ne contenant aucune valeur
        $configData = parse_ini_file(__DIR__ . '/../config.conf');

        try {
            $this->databaseHandler = new PDO(
                "mysql:host={$configData['DB_HOST']};dbname={$configData['DB_NAME']};charset=utf8",
                $configData['DB_USERNAME'],
                $configData['DB_PASSWORD'],
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING) // Affiche les erreurs SQL à l'écran
            );
        }
        catch (Exception $exception) {
            echo 'Erreur de connexion...<br>';
            echo $exception->getMessage().'<br>';
            echo '<pre>';
            echo $exception->getTraceAsString();
            echo '</pre>';
            exit;
        }
    }

    /**
     * Get all lists
     *
     * @return ListModel[]
     */
    public function getLists()
    {
        $listsQuery = "
            SELECT
                `id`,
                `name`,
                `order`,
                `created_at` AS 'createdAt',
                `updated_at` AS 'updatedAt'
            FROM `list`
            ORDER BY `order` ASC
        ";

        $listsQueryStatement = $this
            ->databaseHandler
            ->query($listsQuery)
        ;

        $listsQueryStatement->setFetchMode(
            PDO::FETCH_CLASS,
            'oKanban\Models\ListModel'
        );

        $lists = $listsQueryStatement->fetchAll();

        return $lists;
    }

    /**
     * Get all lists
     *
     * @param int $id
     *
     * @return ListModel
     */
    public function getList($id)
    {
        $listQuery = "
            SELECT
                `id`,
                `name`,
                `order`,
                `created_at` AS 'createdAt',
                `updated_at` AS 'updatedAt'
            FROM `list`
            WHERE `id` = :id
        ";

        $listQueryStatement = $this
            ->databaseHandler
            ->prepare($listQuery)
        ;

        $listQueryStatement->bindValue(
            ':id',
            $id,
            PDO::PARAM_INT
        );

        $listQueryStatement->execute();

        $listQueryStatement->setFetchMode(
            PDO::FETCH_CLASS,
            'oKanban\Models\ListModel'
        );

        $list = $listQueryStatement->fetch();

        return $list;
    }

    /**
     * @param ListModel $list List to create
     *
     * @return ListModel
     */
    public function createList(ListModel $list)
    {
        $insertListQuery = '
            INSERT INTO `list` (`name`, `order`)
            VALUES (:name, :order)
        ';

        $insertListQueryStatement = $this->databaseHandler->prepare($insertListQuery);

        $insertListQueryStatement->bindValue(
            ':name',
            $list->getName(),
            PDO::PARAM_STR
        );

        $insertListQueryStatement->bindValue(
            ':order',
            $list->getOrder(),
            PDO::PARAM_INT
        );

        $insertListQuerySucceeded = $insertListQueryStatement->execute();

        // Tester la valeur de retour $affectedRows pour déclencher une erreur

        if ($insertListQuerySucceeded) {
            $listId = $this->databaseHandler->lastInsertId();

            $newList = $this->getList($listId);
        } else {
            // Erreur
            // throw Exception ...
            $newList = null;
        }

        return $newList;
    }

    /**
     * @param string $name
     * @param int $order
     *
     * @return int
     */
    public function createListBis($name, $order)
    {
        $insertListQuery = '
            INSERT INTO `list` (`name`, `order`)
            VALUES (:name, :order)
        ';

        /**
         * @var PDOStatement
         */
        $insertListQueryStatement = $this->databaseHandler->prepare($insertListQuery);

        $insertListQueryStatement->bindValue(
            ':name',
            $name,
            PDO::PARAM_STR
        );

        $insertListQueryStatement->bindValue(
            ':order',
            $order,
            PDO::PARAM_INT
        );

        $insertListQuerySucceeded = $insertListQueryStatement->execute();

        // Tester la valeur de retour $affectedRows pour déclencher une erreur

        if ($insertListQuerySucceeded) {
            $listId = $this->databaseHandler->lastInsertId();
        } else {
            // Erreur lors de l'éxécution de la requête
            //throw new Exception('Error message ...');

            $listId = null;
        }

        return $listId;
    }
}
