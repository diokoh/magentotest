<?php
namespace G3n0s\BlogManager\Controller\Manage;
use Magento\Customer\Controller\AbstractAccount;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session;
class Delete extends AbstractAccount
{
    public $blogFactory;
    public $messageManager;
    public $customerSession;
    
    public function __construct(
        Context $context,
        \G3n0s\BlogManager\Model\BlogFactory $blogFactory,
        Session $customerSession,
        \Magento\Framework\Serialize\Serializer\Json $jsonData
    ) {
        $this->blogFactory=$blogFactory;
        $this->customerSession = $customerSession;
        $this->jsonData = $jsonData;
        parent::__construct($context);
    }
    public function execute()
    {
        $blogId = $this->getRequest()->getParam('id');
        $customerId = $this->customerSession->getCustomer()->getId();
        $isAuthorized = $this->blogFactory->create()
                        ->getCollection()
                        ->addFieldToFilter('user_id',['eq'=>$customerId])
                        ->addFieldToFilter('entity_id',['eq'=>$blogId])
                        ->getSize();
        if(!$isAuthorized){
            $msg=__('You are not authorised to delete this blog.');
            $success=0;
        }else{
            $blog = $this->blogFactory->create()->load($blogId);
            $blog->delete();
            $success=1;
        }     
        $this->getResponse()->setHeader('Content-type', 'application/javascript');
        $this->getResponse()->setBody(
            $this->jsonData->serialize(
                    [
                        'success' => $success,
                        'message' => $msg
                    ]
                ));
    }
}