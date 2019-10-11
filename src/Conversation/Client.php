<?php


namespace Lucifer\DingTalk\ThirdParty\Enterprise\Conversation;

use Lucifer\DingTalk\ThirdParty\Enterprise\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 发送普通消息
     *
     * @param string $sender
     * @param string $cid
     * @param array  $message
     *
     * @return mixed
     */
    public function sendGeneralMessage($sender, $cid, $message)
    {
        return $this->client->postJson('message/send_to_conversation', [
            'sender' => $sender, 'cid' => $cid, 'msg' => $message,
        ]);
    }

    /**
     * 发送工作通知消息
     *
     * @param array $params
     *
     * @return mixed
     */
    public function sendCorporationMessage($params)
    {
        return $this->client->postJson('topapi/message/corpconversation/asyncsend_v2', $params);
    }
}
