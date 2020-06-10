<?php


namespace SmirnovShipping\VoucherModule\Api;



/**
 * @api
 */
interface VoucherInterface
{
    /**
     * @param int $customer_id
     * @param int $status_id
     * @param string $voucher_code
     * @return array | string[]
     */
    public function createVoucher($customer_id, $status_id, $voucher_code);

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
