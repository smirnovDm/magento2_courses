<?php


namespace SmirnovShipping\VoucherModule\Model;
use Magento\Framework\Exception\LocalizedException;
use SmirnovShipping\VoucherModule\Api\VoucherInterface;


class VoucherManagement implements VoucherInterface
{

    protected $jsonHelper;

    public function __construct(
        \SmirnovShipping\VoucherModule\Model\VoucherFactory $voucher,
        \SmirnovShipping\VoucherModule\Model\ResourceModel\Voucher $resourceVoucher,
        \Magento\Framework\App\RequestInterface $request,
        \SmirnovShipping\VoucherModule\Model\ResourceModel\Voucher\CollectionFactory $collection,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \SmirnovShipping\VoucherModule\Model\VoucherStatusFactory $voucherStatus,
        \Magento\Framework\Serialize\Serializer\Json $json)
    {
        $this->voucher = $voucher;
        $this->resourceVoucher = $resourceVoucher;
        $this->request = $request;
        $this->voucherCollection = $collection;
        $this->customerFactory = $customerFactory;
        $this->voucherStatus = $voucherStatus;
        $this->json = $json;
    }

    /**
     * @inheritDoc
     */
    public function createVoucher($customer_id, $status_id, $voucher_code)
    {
        $customer = $this->customerFactory->create()->load($customer_id);
        $voucherStatus = $this->voucherStatus->create()->load($status_id);
        $voucher = $this->voucher->create();
        if(!$customer || !$customer->getId()){
            throw new LocalizedException(__("Invalid customer id"));
        }
        if(!$voucherStatus || !$voucherStatus->getId()){
            throw new LocalizedException(__("Invalid status id"));
        }
        if(!$voucherStatus){
            throw new LocalizedException(__("Invalid voucher_code value"));
        }
        $voucher->setCustomerId($customer_id);
        $voucher->setStatusId($status_id);
        $voucher->setVoucherCode($voucher_code);
        $voucher->save();
        return ['voucher was successfully create'];
    }

    /**
     * @inheritDoc
     */
    public function deleteVoucherById($id)
    {
        $voucher = $this->voucher->create()->load($id);
        if(!$id || !$voucher->getId()){
            throw new LocalizedException(__("Invalid voucher id"));
        }
        $voucher->delete();
        return ['record was successfully deleted!'];
    }

    /**
     * @inheritDoc
     */
    public function getAllVouchers()
    {
        $data = [];
        $voucherCollection = $this->voucherCollection->create();
        foreach ($voucherCollection as $voucher){
            $data[] = $voucher->getVoucherCode();
        }
        return $data;
    }

    /**
     * @inheritDoc
     */
    public function getAllVouchersByCustomerId($id)
    {
        $data = [];
        $customer = $this->customerFactory->create()->load((int)$id);
        $voucherCollection = $this->voucherCollection->create();
        if(!$customer || !$customer->getId()){
            throw new LocalizedException(__("Invalid customer id"));
        }
        $voucherCollection->addFieldToFilter('customer_id', $customer->getId());
        foreach ($voucherCollection as $voucher){
            $data[] = $voucher->getVoucherCode();
        }
        $data = $this->json->serialize($data);
        return $data;
    }

}
