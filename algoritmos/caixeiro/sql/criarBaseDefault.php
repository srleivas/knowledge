<?php

declare(strict_types=1);

require_once($_SERVER['DOCUMENT_ROOT'] . '/knowledge/util/Utils.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/knowledge/db/ConexaoDatabase.php');
require_once('./GeradorTabelaRotasRelacionamento.php');

class GeradorTabelaCsv
{
    private $db;
    private $executarSql;
    public $novaTabelaCampos = [
        'id' => 'serial UNIQUE',
        'nome' => 'TEXT',
        'latitude' => 'DOUBLE PRECISION',
        'longitude' => 'DOUBLE PRECISION',
        'pais' => 'TEXT'
    ];
    public $mapaRelacionamentoCsvNovaTabela = [
        'nome' => 'city',
        'latitude' => 'lat::DOUBLE PRECISION',
        'longitude' => 'lng::DOUBLE PRECISION',
        'pais' => 'country'
    ];
    public $novaTabelaNome = 'destinos';

    public function __construct($executarSql = true)
    {
        $this->db = new DB;
        $this->db->connect();
        $this->executarSql = $executarSql;
    }

    public function importaCsvEmTabela(string $caminhoArquivo)
    {
        if (!file_exists($caminhoArquivo)) {
            throw new Exception('Arquivo não encontrado!');
        }

        $csv = fopen($caminhoArquivo, 'r');
        $colunasPrimeiraLinha = fgetcsv($csv);

        $conjuntoQuery = [];

        $conjuntoQuery[] = $this->criarSqlTabelaTemporaria($colunasPrimeiraLinha);
        $conjuntoQuery[] = $this->criarSqlTabelaFromCsv($caminhoArquivo);
        $conjuntoQuery[] = $this->criarSqlDropTableIfExists();
        $conjuntoQuery[] = $this->criarSqlNovaTabela();
        $conjuntoQuery[] = $this->criarSqlCopiaDadosTabelaTemporaria();

        $this->executarSql($conjuntoQuery);
    }

    protected function criarSqlTabelaTemporaria(array $colunas): string
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

    protected function criarSqlNovaTabela(): string
    {
        $camposSql = '';

        if (is_array($this->novaTabelaCampos)) {
            foreach ($this->novaTabelaCampos as $key => $value) {
                $camposSql .= "{$key} {$value},";
            }

            $camposSql = rtrim($camposSql, ',');
        }

        $sql = <<<END
        CREATE TABLE {$this->novaTabelaNome} (
            $camposSql
        );
        END;

        return $sql;
    }

    protected function criarSqlDropTableIfExists()
    {
        return "DROP TABLE IF EXISTS {$this->novaTabelaNome};";
    }

    protected function criarSqlCopiaDadosTabelaTemporaria()
    {
        $sqlInsertCamposNovaTabela = '(';
        $sqlSelectCamposTabelaCsv = '';

        foreach ($this->mapaRelacionamentoCsvNovaTabela as $insertColuna => $selectColunaCsv) {
            $sqlInsertCamposNovaTabela .= "{$insertColuna},";
            $sqlSelectCamposTabelaCsv .= "{$selectColunaCsv},";
        }

        $sqlInsertCamposNovaTabela = rtrim($sqlInsertCamposNovaTabela, ',');
        $sqlSelectCamposTabelaCsv = rtrim($sqlSelectCamposTabelaCsv, ',');

        $sqlInsertCamposNovaTabela .= ')';

        $sql = <<<END
        INSERT INTO {$this->novaTabelaNome} {$sqlInsertCamposNovaTabela}
        SELECT {$sqlSelectCamposTabelaCsv} FROM temp_table
        END;

        return $sql;
    }

    protected function executarSql(array $conjuntoQuery): void
    {
        if ($this->executarSql == false) {
            dump($conjuntoQuery, false);
        }

        if ($this->executarSql == true) {
            foreach ($conjuntoQuery as $sql) {
                $this->db->query($sql);
            }
        }
    }
}
$caminhoCsv = $_SERVER['DOCUMENT_ROOT'] . '/knowledge/db/csv/worldcities.csv';
$executarSql = isset($_POST['executarSql']) ? $_POST['executarSql'] : false;

$GeradorTabelaCsv = new GeradorTabelaCsv($executarSql);
$GeradorTabelaCsv->importaCsvEmTabela($caminhoCsv);
?>

<button><a href="./index.php" style="text-decoration:none;color:inherit">Voltar</a></button>