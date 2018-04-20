<?php

namespace Model\JsonRPC;

/**
 * Description of JsonrpcError
 *
 * @author devel
 */
class ErrorJsonRPC extends JsonRPC implements IJsonRPC {

    const _PARSE_ERROR = -32700;
    const _INVALID_REQUEST = -32600;
    const _METHOD_NOT_FOUND = -32601;
    const _INVALID_PARAMS = -32602;
    const _INTERNAL_ERROR = -32603;
    const _INVALID_PARAM_OBJECT= -32604;
    const _INVALID_PARAM_ARRAY= -32605;
    const _SERVER_ERROR = -32099;

    private $messages = [
        self::_PARSE_ERROR => "Parse error",
        self::_INVALID_REQUEST => "Invalid Request",
        self::_METHOD_NOT_FOUND => "Method not found",
        self::_INVALID_PARAMS => "Invalid params",
        self::_INTERNAL_ERROR => "Internal error",
        self::_INVALID_PARAM_OBJECT=> "Invalid param object",
        self::_INVALID_PARAM_ARRAY=> "Invalid param array",
        self::_SERVER_ERROR => "Server error"
    ];

    /**
     *
     * @var int
     */
    private $code;

    function getCode() {
        return $this->code;
    }

    function setCode($code) {
        $this->code = $code;
        return $this;
    }

    /**
     *
     * @var array
     */
    private $error;

    function getError() {
        $this->error = [
            "code" => $this->code,
            "message" => $this->messages[$this->code]
        ];
        return $this->error;
    }

    public function getPayload() {
        parent::getPayload();
        $this->payload["error"] = $this->getError();

        return $this->payload;
    }

}
