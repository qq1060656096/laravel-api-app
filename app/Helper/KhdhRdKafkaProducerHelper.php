<?php
namespace App\Helper;

use RdKafka\Producer;
use RdKafka\ProducerTopic;
use RdKafka\Conf;
/**
 *
 * 客户订货kafka生产者
 * Created by PhpStorm.
 * Email: 1060656096@qq.com
 * User: zwei
 * Date: 2018-08-18
 * Time: 11:51
 */
class KhdhRdKafkaProducerHelper extends RdKafkaProducerHelper
{


    /**
     * 发送事件
     * @param string $eventKey 事件
     * @param array $data 事件数据
     * @param string $ip
     * return null
     */
    public static function sendEvent($eventKey, array $data, $ip = null)
    {
        $ip = $ip === null ? self::getClientIp() : $ip;
        $key        = '';
        $event      = [
            'id'        => self::getEventId($ip),
            'eventKey'  => $eventKey,
            'data'      => $data,
            'time'      => time(),
            'ip'        => $ip,
        ];
        $event  = json_encode($event);
        $topicList  = [config('kafka.khdh-topic')];
        return self::sendMessage($topicList, $event, $key);
    }
}