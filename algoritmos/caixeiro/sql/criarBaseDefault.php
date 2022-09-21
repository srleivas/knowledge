<?php

declare(strict_types=1);

require_once($_SERVER['DOCUMENT_ROOT'] . '/knowledge/util/Utils.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/knowledge/db/ConexaoDatabase.php');


class GeradorTabelaCsv
{
    private $db;
    private $executarSql;
    public $novaTabelaCampos = [
        'id' => 'SERIAL',
        'nome' => 'TEXT',
        'latitude' => 'DOUBLE PRECISION',
        'longitude' => 'DOUBLE PRECISION',
    ];

    public function __construct()
    {
        $this->db = new DB;
        $this->db->connect();

        if (isset($_POST['executar_sql'])) {
            $this->executarSql = $_POST['executar_sql'];
        }
    }

    public function importaCsvEmTabela(string $caminhoArquivo)
    {
        $criaTabelaTemporariasql = '';
        $copiaCsvSql = '';
        $nomeTabela = 'destinos';

        if (!file_exists($caminhoArquivo)) {
            throw new Exception('Arquivo não encontrado!');
        }

        $csv = fopen($caminhoArquivo, 'r');
        $colunasPrimeiraLinha = fgetcsv($csv);

        $criaTabelaTemporariasql .= $this->criarSqlTabelaTemporária($colunasPrimeiraLinha, $nomeTabela);
        $copiaCsvSql = $this->criarSqlTabelaFromCsv($caminhoArquivo, $nomeTabela);

        $this->criarSqlNovaTabela($this->novaTabelaCampos, 'destinos');

        // if ($this->executarSql === '0') {
        //     dump($criaTabelaTemporariasql);
        //     dump($copiaCsvSql);
        // }

        // if ($this->executarSql === '1') {
        //     $this->db->query($criaTabelaTemporariasql);
        //     $this->db->query($copiaCsvSql);
        // }
    }

    protected function criarSqlTabelaTemporária(array $colunas): string
    {
        $sql = "CREATE TEMP TABLE temp_table (";

        foreach ($colunas as $nomeColuna) {
            $sql .= "$nomeColuna TEXT,";
        }

        $sql = rtrim($sql, ',');
        $sql .= ');';

        return $sql;
    }

    protected function criarSqlTabelaFromCsv(string $caminhoArquivo): string
    {
        $sql = <<<END
        COPY temp_table FROM '{$caminhoArquivo}'
        DELIMITER ',' CSV HEADER;
        END;

        return $sql;
    }

    protected function criarSqlNovaTabela(array $campos, string $nomeTabela): string
    {
        $camposSql = '';

        if (is_array($campos)) {
            foreach ($campos as $key => $value) {
                $camposSql .= "{$key} {$value},";
            }

            $camposSql = rtrim($camposSql, ',');
        }

        // Mudarei
        $this->db->query("DROP TABLE IF EXISTS {$nomeTabela};");

        $sql = <<<END
        CREATE TABLE {$nomeTabela} (
            $camposSql
        );
        END;

        $this->db->query($sql);

        return $sql;
    }
}

$GeradorTabelaCsv = new GeradorTabelaCsv;
$GeradorTabelaCsv->importaCsvEmTabela($_SERVER['DOCUMENT_ROOT'] . '/knowledge/db/csv/worldcities.csv');
?>

<button><a href="./index.php" style="text-decoration:none;color:inherit">Voltar</a></button>