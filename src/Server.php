<?php

namespace Puerari\Cwp;

/**
 * @trait Server
 * @package Puerari\Cwp
 * @author Leandro Puerari <leandro@puerari.com.br>
 */
trait Server
{
    /**
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK, mjs -> openvz
     */
    public function listServerType()
    {
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'list';
        $this->cwpuri = 'typeserver';
        return $this->execCurl();
    }
}
