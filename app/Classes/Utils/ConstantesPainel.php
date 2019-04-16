<?php


namespace App\Classes\Utils;


class ConstantesPainel
{
    /**
     * Status senhas
     */
    const AGUARDANDO_CHAMADA = 1;
    const CHAMADA_RECEPCAO = 2;
    const CHAMADA_MEDICO = 3;
    const ATENDIDA = 4;
    const CANCELADA = 5;

    /**
     * Valor limite de senhas
     */
    const LIMITE_SENHAS = 50;
}