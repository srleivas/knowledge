<?php

namespace Criptografia;

interface CriptografiaAssimetricaAbstract
{
    public function gerarChavePrivada();

    public function gerarChavePublica();

    public function gerarChaves();
}
