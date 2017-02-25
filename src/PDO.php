<?php


namespace Previewtechs\Database\MySQL;

/**
 * Class PDO
 * @package Previewtechs\Database\MySQL
 */
class PDO
{
    /**
     * @var \PDO
     */
    protected $db;

    /**
     * @var \PDOStatement
     */
    private $statement;

    /**
     * PDO constructor.
     * @param $dsn
     * @param null $username
     * @param null $password
     * @param array $options
     * @throws \Exception
     */
    public function __construct($dsn, $username = null, $password = null, $options = [])
    {
        $options = array_merge($options, [
            \PDO::ATTR_PERSISTENT => true,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);

        try {
            $this->db = new \PDO($dsn, $username, $password, $options);
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @param $query
     */
    public function query($query)
    {
        $this->statement = $this->db->prepare($query);
    }

    /**
     * @param $param
     * @param $value
     * @param null $type
     */
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = \PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = \PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = \PDO::PARAM_NULL;
                    break;
                default:
                    $type = \PDO::PARAM_STR;
            }
        }

        $this->statement->bindValue($param, $value, $type);
    }

    /**
     * @return bool
     */
    public function execute()
    {
        return $this->statement->execute();
    }

    /**
     * @return array
     */
    public function resultSet()
    {
        $this->execute();
        return $this->statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @return mixed
     */
    public function single()
    {
        $this->execute();
        return $this->statement->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->statement->rowCount();
    }

    /**
     * @return string
     */
    public function lastInsertedId()
    {
        return $this->db->lastInsertId();
    }

    /**
     * @return bool
     */
    public function beginTransaction()
    {
        return $this->db->beginTransaction();
    }

    /**
     * @return bool
     */
    public function endTransaction()
    {
        return $this->db->commit();
    }

    /**
     * @return bool
     */
    public function cancelTransaction()
    {
        return $this->db->rollBack();
    }

    /**
     * @return bool
     */
    public function debugDumpsParams()
    {
        return $this->statement->debugDumpParams();
    }
}
