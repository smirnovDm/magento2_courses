<?php


namespace SmirnovShipping\VoucherModule\model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Voucher extends AbstractDb
{
    public function __construct(\Magento\Framework\Model\ResourceModel\Db\Context $context)
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('voucher', 'entity_id');
    }
}
