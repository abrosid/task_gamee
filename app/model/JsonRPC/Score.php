<?php

namespace Model\JsonRPC;

/**
 * Description of Score
 *
 * @author devel
 */
class Score {

    use \Nette\SmartObject;

    public function __construct(\stdClass $obj) {
        $this->userId = $obj->userId;
        $this->gameId = $obj->gameId;
        $this->score = $obj->score;
    }

    private $userId;
    private $gameId;
    private $score;

    function getUserId() {
        return $this->userId;
    }

    function getGameId() {
        return $this->gameId;
    }

    function getScore() {
        return $this->score;
    }

    function setUserId($userId) {
        $this->userId = $userId;
    }

    function setGameId($gameId) {
        $this->gameId = $gameId;
    }

    function setScore($score) {
        $this->score = $score;
    }

    function toArray() {

        return get_object_vars($this);
    }

}

class ScoreRepository extends \Model\PredisBase {

    public function save(Score $score) {
        try {
            $this->redisClient->pipeline()
                    ->zRem($score->getGameId(), $score->getUserId())
                    ->zAdd($score->getGameId(), $score->getScore(), $score->getUserId())
                    ->execute();
            return TRUE;
        } catch (Exception $exc) {
            return false;
        }
    }

    public function topTen($gameId) {
        $res = [];
        $userIds = $this->redisClient->zRevRange($gameId, 0, 9, ['withscores' => TRUE]);
        foreach ($userIds as $userId => $userScore) {
            array_push($res, [
                'gameId' => $gameId,
                'userId' => $userId,
                'score' => $userScore
            ]);
        }
        return $res;
    }

}
