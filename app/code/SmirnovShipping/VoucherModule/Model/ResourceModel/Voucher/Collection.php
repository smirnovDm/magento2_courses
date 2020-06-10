<?php


namespace SmirnovShipping\VoucherModule\Model\ResourceModel\Voucher;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected $_eventPrefix = 'smirnovshipping_vouchermodule_voucher_collection';
    protected $_eventObject = 'voucher_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('SmirnovShipping\VoucherModule\Model\Voucher', 'SmirnovShipping\VoucherModule\Model\ResourceModel\Voucher');
    }
}
