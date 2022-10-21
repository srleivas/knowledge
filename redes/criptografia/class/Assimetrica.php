<?php

namespace Class;

use Interface\CriptografiaAssimetricaInterface;

class Assimetrica implements CriptografiaAssimetricaInterface
{
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
}
