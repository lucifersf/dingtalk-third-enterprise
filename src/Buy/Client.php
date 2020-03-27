<?php

namespace Lucifer\DingTalk\ThirdParty\Enterprise\Buy;

use Lucifer\DingTalk\ThirdParty\Enterprise\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 获取内购商品SKU页面地址
     *
     * @param string      $goodsCode
     * @param string      $callbackPage
     *
     * @return mixed
     */
    public function getSkuPage($goodsCode, $callbackPage)
    {
        $params = [
            'goods_code' => $goodsCode,
            'callback_page' => $callbackPage,
        ];
        return $this->client->get('topapi/appstore/internal/skupage/get', $params);
    }

    /**
     * 内购商品订单处理完成
     *
     * @param Number      $bizOrderId
     *
     * @return mixed
     */
    public function orderFinish($bizOrderId)
    {
        return $this->client->get('topapi/appstore/internal/order/finish', ['biz_order_id' => $bizOrderId]);
    }

    /**
     * 获取内购订单信息
     *
     * @param Number      $bizOrderId
     *
     * @return mixed
     */
    public function getOrder($bizOrderId)
    {
        return $this->client->get('topapi/appstore/internal/order/get', ['biz_order_id' => $bizOrderId]);
    }

    /**
     * 应用内购商品核销
     *
     * @param Number      $bizOrderId
     * @param string      $requestId
     * @param Number      $quantity
     * @param string      $userId
     *
     * @return mixed
     */
    public function orderConsume($bizOrderId, $requestId, $quantity, $userId)
    {
        $params = [
            'biz_order_id' => $bizOrderId,
            'request_id' => $requestId,
            'quantity' => $quantity,
            'userid' => $userId,
        ];
        return $this->client->postQuery('topapi/appstore/internal/order/consume', [], $params);
    }

    /**
     * 获取未处理的已支付订单
     *
     * @param Number      $page
     * @param Number      $pageSize
     * @param string      $itemCode
     *
     * @return mixed
     */
    public function getUnfinishedOrderList($page, $pageSize, $itemCode = null)
    {
        $params = [
            'page' => $page,
            'page_size' => $pageSize,
        ];
        if (!empty($itemCode)) {
            $params['item_code'] = $itemCode;
        }
        return $this->client->get('topapi/appstore/internal/unfinishedorder/list', $params);
    }
}