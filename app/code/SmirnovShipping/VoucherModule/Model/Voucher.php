<?php


namespace SmirnovShipping\VoucherModule\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use SmirnovShipping\VoucherModule\Api\VoucherStatusManagementInterface;

/**
 * @api
 */
class Voucher extends AbstractModel implements IdentityInterface
{

    const CACHE_TAG = 'smirnovshipping_vouchermodule_voucher';

    protected $_cacheTag = 'smirnovshipping_vouchermodule_voucher';

    protected $_eventPrefix = 'smirnovshipping_vouchermodule_voucher';

    protected function _construct()
    {
        $this->_init('SmirnovShipping\VoucherModule\Model\ResourceModel\Voucher');
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
