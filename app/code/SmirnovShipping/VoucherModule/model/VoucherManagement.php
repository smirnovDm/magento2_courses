<?php


namespace SmirnovShipping\VoucherModule\model;
use Magento\Framework\Exception\LocalizedException;
use mysql_xdevapi\Exception;
use SmirnovShipping\VoucherModule\Api\VoucherInterface;


class VoucherManagement implements VoucherInterface
{

    protected $jsonHelper;

    public function __construct(
        \SmirnovShipping\VoucherModule\model\VoucherFactory $voucher,
        \SmirnovShipping\VoucherModule\model\ResourceModel\Voucher $resourceVoucher,
        \Magento\Framework\App\RequestInterface $request,
        \SmirnovShipping\VoucherModule\model\ResourceModel\Voucher\CollectionFactory $collection,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \SmirnovShipping\VoucherModule\model\VoucherStatusFactory $voucherStatus,
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
    public function createVoucher()
    {

        $params = $this->request->getParams();
        if(count($params) !== 3){
            throw new LocalizedException(__("Invalid input data.You should to add customer_id, status_id, voucher_code"));
        }
        if(!array_key_exists('customer_id', $params)){
            throw new LocalizedException((__("Invalid 'customer_id' key. Please, try again!")));
        }
        if(!array_key_exists('status_id', $params)){
            throw new LocalizedException((__("Invalid 'status_id' key. Please, try again!")));
        }
        if(!array_key_exists('voucher_code', $params)){
            throw new LocalizedException((__("Invalid 'voucher_code' key. Please, try again!")));
        }
        foreach ($params as $value){
            if($value == null){
                throw new LocalizedException(__("All data is required! Please entry value fields again"));
            }
        }
        $customer = $this->customerFactory->create()->load((int)$params['customer_id']);
        $voucherStatus = $this->voucherStatus->create()->load((int)$params['status_id']);
        if(!$customer || !$customer->getId()){
            throw new LocalizedException(__('Invalid customer id'));
        }
        if(!$voucherStatus || !$voucherStatus->getId()){
            throw new LocalizedException(__('Invalid voucher_status id'));
        }
        $voucher = $this->voucher->create();
        $voucher->setCustomerId((int)$params['customer_id']);
        $voucher->setStatusId((int)$params['status_id']);
        $voucher->setVoucherCode($params['voucher_code']);
        $voucher->save();
        return [$params, 'voucher was successfully created!'];
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
        $j = 0;
        $data = [];
        $voucherCollection = $this->voucherCollection->create();
        foreach ($voucherCollection as $voucher){
            $j++;
            $data[] = "$j. ".$voucher->getVoucherCode();
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
