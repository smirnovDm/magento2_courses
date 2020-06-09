<?php


namespace SmirnovShipping\VoucherModule\Api;


/**
 * @api
 */
interface VoucherStatusInterface
{
    /**
     * @return array | string[]
     */
    public function createVoucherStatus();

    /**
     * @param int $id
     * @return array | string[]
     */
    public function deleteVoucherStatusById($id);

    /**
     * @return array | string[]
     */
    public function getAllVoucherStatuses();
}
