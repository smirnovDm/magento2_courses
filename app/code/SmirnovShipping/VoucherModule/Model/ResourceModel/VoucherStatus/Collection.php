<?php


namespace SmirnovShipping\VoucherModule\Model\ResourceModel\VoucherStatus;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected $_eventPrefix = 'smirnovshipping_vouchermodule_voucher_status_collection';
    protected $_eventObject = 'voucher_status_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('SmirnovShipping\VoucherModule\Model\VoucherStatus', 'SmirnovShipping\VoucherModule\Model\ResourceModel\VoucherStatus');
    }
}
