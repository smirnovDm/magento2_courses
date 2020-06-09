<?php


namespace SmirnovShipping\VoucherModule\model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use SmirnovShipping\VoucherModule\Api\VoucherStatusInterface;



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
