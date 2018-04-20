<?php

namespace Model\JsonRPC;

/**
 * Description of JsonrpcSuccess
 *
 * @author devel
 */
class SuccessJsonRPC extends JsonRPC implements IJsonRPC {

    /**
     *
     * @var mixed
     */
    private $result;

    function getResult() {
        return $this->result;
    }

        
    function setResult($result) {
        $this->result = $result;
        return $this;
    }

    public function getPayload() {
        parent::getPayload();
        $this->payload["result"] = $this->getResult();
        return $this->payload;
    }

}
