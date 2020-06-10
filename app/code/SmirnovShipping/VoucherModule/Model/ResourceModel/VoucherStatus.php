<?php


namespace SmirnovShipping\VoucherModule\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;




class VoucherStatus extends AbstractDb
{

    public function __construct(\Magento\Framework\Model\ResourceModel\Db\Context $context)
    {
        parent::__construct($context);

    }

    protected function _construct()
    {
        $this->_init('voucher_status', 'entity_id');
    }

}
