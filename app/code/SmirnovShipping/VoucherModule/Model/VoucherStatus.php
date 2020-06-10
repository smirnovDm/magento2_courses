<?php


namespace SmirnovShipping\VoucherModule\Model;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;


class VoucherStatus extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'smirnovshipping_vouchermodule_voucher_status';

    protected $_cacheTag = 'smirnovshipping_vouchermodule_voucher_status';

    protected $_eventPrefix = 'smirnovshipping_vouchermodule_voucher_status';

    protected function _construct()
    {
        $this->_init('SmirnovShipping\VoucherModule\Model\ResourceModel\VoucherStatus');

    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
