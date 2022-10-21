<?php

namespace Interface;

interface CriptografiaAssimetricaInterface
{
    public function gerarChavePrivada();

    public function gerarChavePublica();

    public function gerarChaves();
}
