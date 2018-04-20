<?php

namespace ApiModule;

use Nette,
    \Model\JsonRPC\JsonrpcService;

class MainPresenter extends Nette\Application\UI\Presenter {

    /**
     *
     * @var JsonrpcService
     * @inject
     */
    public $jsonRPCService;

    public function startup() {
        parent::startup();
    }

    public function actionIndex() {
        $str = file_get_contents("php://input");
        $rcp = json_decode($str);
        $res=null;
        if (count($rcp)) {
            $res = $this->jsonRPCService->handle($rcp);
        } else {
            $res = $this->jsonRPCService->rpcError(\Model\JsonRPC\ErrorJsonRPC::_INVALID_REQUEST);
        }

        if ($res) {
            if (is_array($res)) {
                $payload = array_filter($res, function($val) {
                    return $val != NULL;
                });
            } else {
                $payload = $res;
            }
            $this->presenter->sendJson($payload);
        }
        $this->terminate();
    }
    
    

}
