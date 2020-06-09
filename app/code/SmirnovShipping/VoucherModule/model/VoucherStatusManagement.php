<?php


namespace SmirnovShipping\VoucherModule\model;


use Magento\Framework\Exception\LocalizedException;
use SmirnovShipping\VoucherModule\Api\VoucherStatusInterface;

/**
 * @api
 */
class VoucherStatusManagement implements VoucherStatusInterface
{
    public function __construct(
        \SmirnovShipping\VoucherModule\model\VoucherStatusFactory $voucherStatusFactory,
        \SmirnovShipping\VoucherModule\model\ResourceModel\VoucherStatus $voucherStatusResource,
        \Magento\Framework\App\RequestInterface $request,
        \SmirnovShipping\VoucherModule\model\ResourceModel\VoucherStatus\CollectionFactory $collection,
        \SmirnovShipping\VoucherModule\model\VoucherStatus $voucherStatus)
    {
        $this->voucherStatus = $voucherStatusFactory; //Model with setters and getters
        $this->voucherStatusResource = $voucherStatusResource; // ORM model
        $this->VoucherStatusCollection = $collection;
        $this->request = $request; //Some native request obj
    }

    /**
     * @inheritDoc
     */
    public function createVoucherStatus()
    {
        $voucherStatus = $this->voucherStatus->create();
        $isStatusSaved = false;
        $new_status_code = null;
        $params = $this->request->getParams();
        foreach ($params as $key => $value) {
            if($key == 'status'){
                $new_status_code = $value;
                if($new_status_code == null){
                    throw new LocalizedException(__('Failed to save status code. Please, try again!'));
                }
                $voucherStatus->setStatusCode($value);
                $voucherStatus->save();
                $isStatusSaved = true;
                break;
            }
        }
        if($isStatusSaved){
            return ['successfully saved', 'new status_code: '.$new_status_code];
        }
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
