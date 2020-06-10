<?php


namespace SmirnovShipping\VoucherModule\Api;


/**
 * @api
 */
interface VoucherStatusInterface
{
    /**
     * @param string $voucher_status
     * @return array | string[]
     */
    public function createVoucherStatus($voucher_status);

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
