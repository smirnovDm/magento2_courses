<?php


namespace SmirnovShipping\VoucherModule\Api;

/**
 * @api
 */
interface VoucherInterface
{
    /**
     * @return array | string[]
     */
    public function createVoucher();

    /**
     * @param int $id
     * @return array | string[]
     */
    public function deleteVoucherById($id);

    /**
     * @return array | string[]
     */
    public function getAllVouchers();

    /**
     * @param int $id
     * @return array | string[]
     */
    public function getAllVouchersByCustomerId($id);
}
