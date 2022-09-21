<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/knowledge/util/Utils.php');

class DB
{
    private $host = 'localhost';
    private $port = '5432';
    private $dbname = 'caixeiro_viajante';
    private $user = 'postgres';
    public $db;
    public $lastQuery;

    function connect()
    {
        $connection = new PDO("pgsql:host={$this->host} port={$this->port} dbname={$this->dbname} user={$this->user}");

        $this->db = $connection;
    }

    function query(string $query)
    {
        $this->lastQuery = $query;
        $result = null;

        try {
            $this->db->beginTransaction();

            $result = $this->db->query($query);

            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();
            echo $e->getMessage();
        }

        if ($result instanceof PDOStatement) {
            $result = $result->fetchAll();
        };

        $this->lastQueryResult = $result;

        return $result;
    }
}
