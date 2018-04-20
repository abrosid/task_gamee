<?php

namespace Model\JsonRPC;

/**
 * Description of JsonRPCService
 *
 * @author devel
 */
class JsonrpcService {

    /**
     * @var ScoreRepository
     */
    private $scoreRepository;

    /**
     * @var SuccessJsonRPC
     */
    private $successJsonRPC;

    /**
     * @var ErrorJsonRPC
     */
    private $errorJsonRPC;
    private $id;

    public function __construct(ScoreRepository $scoreRepository
    , ErrorJsonRPC $jsonrpcError
    , SuccessJsonRPC $jsonrpcSuccess) {
        $this->scoreRepository = $scoreRepository;
        $this->errorJsonRPC = $jsonrpcError;
        $this->successJsonRPC = $jsonrpcSuccess;
    }

    /**
     * 
     * @param mixed $rcp
     * @return array payload
     */
    public function handle($rpc) {
        if (is_object($rpc)) {
            return $this->handleObject($rpc);
        } elseif (is_array($rpc)) {
            return $this->handleBatch($rpc);
        } else {
            return $this->rpcError(ErrorJsonRPC::_INVALID_REQUEST);
        }
    }

    /**
     * 
     * @param \stdClass $obj
     * @return array
     */
    function handleObject(\stdClass $obj) {
        $params = isset($obj->params) ? $obj->params : NULL;
        $this->id = isset($obj->id) ? $obj->id : NULL;
        if ($obj->jsonrpc === JsonRPC::_JSON_RPC) {
            if ($obj->method && $params) {
                return $this->handleMethod($obj->method, $params);
            } else {
                return $this->rpcError(ErrorJsonRPC::_INVALID_REQUEST);
            }
        } else {
            return $this->rpcError(ErrorJsonRPC::_INVALID_REQUEST);
        }
    }

    /**
     * 
     * @param array $rpc
     * @return array
     */
    function handleBatch(array $rpc) {
        $payloads = count($rpc) ? [] : $this->rpcError(ErrorJsonRPC::_INVALID_REQUEST);
        foreach ($rpc as $obj) {
            if (is_object($obj)) {
                $payloads[] = $this->handleObject($obj);
            } else {
                $payloads[] = $this->rpcError(ErrorJsonRPC::_INVALID_REQUEST);
            }
        }
        return $payloads;
    }

    /**
     * 
     * @param atring $method
     * @param \stdClass $params
     * @return array
     */
    private function handleMethod($method, $params) {
        switch ($method) {
            case "score":
                return $this->handleScore($params);
            case "topten":
                return $this->handleTopten($params);
            default:
                return $this->rpcError(ErrorJsonRPC::_METHOD_NOT_FOUND);
        }
    }

    /**
     * 
     * @param mixed $params
     * @return array
     */
    private function handleScore($params) {
        if (is_object($params) && $this->validParams($params)) {
            $score = new Score($params);
            if ($this->scoreRepository->save($score)) {
                return $this->rpcSuccess($score->toArray());
            }
            return $this->rpcError(ErrorJsonRPC::_INTERNAL_ERROR);
        }
        return $this->rpcError(ErrorJsonRPC::_INVALID_PARAMS);
    }

    /**
     * 
     * @param mixed $params
     * @return array
     */
    private function handleTopten($params) {
        if (is_object($params) && isset($params->gameId) && $params->gameId) {
            try {
                $result = $this->scoreRepository->topTen($params->gameId);
                return $this->rpcSuccess($result);
            } catch (Exception $exc) {
                return $this->rpcError(ErrorJsonRPC::_INTERNAL_ERROR);
            }
        }
        return $this->rpcError(ErrorJsonRPC::_INVALID_PARAMS);
    }

    /**
     * 
     * @param \stdClass $params
     * @return boolean
     */
    private function validParams(\stdClass $params) {
        return isset($params->gameId) && isset($params->userId) && isset($params->score);
    }

    /**
     * 
     * @param int $code
     * @return array
     */
    public function rpcError($code = ErrorJsonRPC::_SERVER_ERROR) {
        if ($this->id) {
            return $this->errorJsonRPC->setId($this->id)->setCode($code)->getPayload();
        }
    }

    /**
     * 
     * @param array $result
     * @return array
     */
    public function rpcSuccess(array $result=[]) {
        if ($this->id) {
            return $this->successJsonRPC->setId($this->id)->setResult($result)->getPayload();
        }
    }

}
