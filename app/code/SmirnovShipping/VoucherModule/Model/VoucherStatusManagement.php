<?php


namespace SmirnovShipping\VoucherModule\Model;


use Magento\Framework\Exception\LocalizedException;
use SmirnovShipping\VoucherModule\Api\VoucherStatusInterface;

/**
 * @api
 */
class VoucherStatusManagement implements VoucherStatusInterface
{
    public function __construct(
        \SmirnovShipping\VoucherModule\Model\VoucherStatusFactory $voucherStatusFactory,
        \SmirnovShipping\VoucherModule\Model\ResourceModel\VoucherStatus $voucherStatusResource,
        \Magento\Framework\App\RequestInterface $request,
        \SmirnovShipping\VoucherModule\Model\ResourceModel\VoucherStatus\CollectionFactory $collection,
        \SmirnovShipping\VoucherModule\Model\VoucherStatus $voucherStatus)
    {
        $this->voucherStatus = $voucherStatusFactory; //Model with setters and getters
        $this->voucherStatusResource = $voucherStatusResource; // ORM model
        $this->VoucherStatusCollection = $collection;
        $this->request = $request; //Some native request obj
    }

    /**
     * @inheritDoc
     */
    public function createVoucherStatus($voucher_status)
    {
        $voucherStatus = $this->voucherStatus->create();
        if(!$voucher_status){
            throw new LocalizedException(__("Invalid voucher_status value"));
        }
        $voucherStatus->setStatusCode($voucher_status);
        $voucherStatus->save();
        return ['voucher status was successfully created'];
    }

    /**
     * @inheritDoc
     */
    public function deleteVoucherStatusById($id)
    {
        $voucherStatus = $this->voucherStatus->create()->load($id);
        if(!$id || !$voucherStatus->getId()){
            throw new LocalizedException(__("Invalid voucher id"));
        }
        $voucherStatus->delete();
        return ['record was successfully deleted!'];
    }

    /**
     * @inheritDoc
     */
    public function getAllVoucherStatuses()
    {
        $data = [];
        $voucherStatusCollection = $this->VoucherStatusCollection->create();
        foreach ($voucherStatusCollection as $voucherStatus){
            $data[] = "voucher status: ".$voucherStatus->getStatusCode();
        }
        return $data;
    }
}
