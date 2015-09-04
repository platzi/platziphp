<?php
namespace PlatziPHP\Infrastructure;

use PlatziPHP\Domain\EntityNotFound;

abstract class BaseRepository
{
    private static $pdo;

    /**
     * @return string
     */
    abstract protected function table();

    /**
     * @param array $result
     * @return object
     */
    abstract protected function mapEntity(array $result);

    /**
     * @return \PDO
     */
    protected function getPDO()
    {
        if (!self::$pdo) {
            self::$pdo = new \PDO(
                'mysql:host=127.0.0.1;dbname=platziphp',
                'guiwoda',
                'guiwoda'
            );
        }

        return self::$pdo;
    }

    public function find($id)
    {
        $pdo = $this->getPDO();

        $statement = $pdo->prepare(
            'SELECT * FROM '.$this->table().' WHERE id = :id'
        );

        $statement->bindParam(':id', $id, \PDO::PARAM_INT);

        $statement->execute();
        $result = $statement->fetch();

        if ($result === false) {
            throw new EntityNotFound(
                $id,
                $this->table() . " $id does not exist."
            );
        }

        return $this->mapEntity($result);
    }
}