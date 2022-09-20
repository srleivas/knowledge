<?php

namespace Criptografia;

require_once(__DIR__ . '/../interface/CriptografiaAssimetricaInterface.php');

class Assimetrica implements CriptografiaAssimetricaAbstract
{
    /**
     * Retorna o múltiplo divisor comum
     * @return int mdc
     */
    public function retornaMdc(int $a, int $b): int
    {
        $resto = 0;

        while (true) {
            $resto = $a % $b;

            if ($resto == 0) {
                return $b;
            }

            $b = $resto;
            $a = $b;
        }
    }

    public function gerarChavePrivada()
    {
    }

    public function gerarChavePublica()
    {
    }

    public function gerarChaves()
    {
        $mdc = $this->retornaMdc(20, 100);
    }
}
