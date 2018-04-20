<?php

namespace Model\JsonRPC;

/**
 * Description of JsonRPC
 *
 * @author devel
 */
abstract class JsonRPC {

    /**
     *
     * @var array
     */
    protected $payload = [];

    const _JSON_RPC = "2.0";

    /**
     *
     * @var int
     */
    private $id;

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * 
     * @return array
     */
    public function getPayload() {
        $this->payload["jsonrpc"] = self::_JSON_RPC;
        $this->payload["id"] = $this->id;
    }

}
