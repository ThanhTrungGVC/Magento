<?php

namespace Ex\ChatSystem\Controller\Adminhtml\Chat;

use Magento\Customer\Controller\AccountInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Display Hello on screen
 */
class Sendmsg extends \Magento\Framework\App\Action\Action
{
    protected $_cacheTypeList;
    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $_request;

    /**
     * @var \Magento\Framework\App\ResponseInterface
     */
    protected $_response;

    /**
     * @var \Magento\Framework\Controller\Result\RedirectFactory
     */
    protected $resultRedirectFactory;

    /**
     * @var \Magento\Framework\Controller\ResultFactory
     */
    protected $resultFactory;

    /**
     * @var \Ex\ChatSystem\Helper\Data
     */
    protected $_helper;

    /**
     * @var \Magento\Framework\Controller\Result\ForwardFactory
     */
    protected $resultForwardFactory;

    protected $_message;
    /**
     * @param Context                                             $context
     * @param \Magento\Store\Model\StoreManager                   $storeManager
     * @param \Magento\Framework\View\Result\PageFactory          $resultPageFactory
     * @param \Ex\ChatSystem\Helper\Data                               $helper
     * @param \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory
     * @param \Magento\Framework\Registry                         $registry
     */
    public function __construct(
        Context $context,
        \Magento\Store\Model\StoreManager $storeManager,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Ex\ChatSystem\Helper\Data $helper,
        \Ex\ChatSystem\Model\ChatMessage $message,
        \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Customer\Model\Session $customerSession
        ) {
        $this->resultPageFactory    = $resultPageFactory;
        $this->_helper              = $helper;
        $this->_message             = $message;
        $this->resultForwardFactory = $resultForwardFactory;
        $this->_coreRegistry        = $registry;
        $this->_cacheTypeList       = $cacheTypeList;
        $this->_customerSession     = $customerSession;
        $this->_request             = $context->getRequest();
        parent::__construct($context);
    }

    /**
     * Default customer account page
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $data = $this->_request->getPostValue();
         $data['current_time'] = $this->_helper->getCurrentTime();
        if(!empty($data)){
            $responseData = [];
            $message = $this->_message;

            try{
                $message->setData($data)->save();
                $chat = $this->_objectManager->create('Ex\ChatSystem\Model\Chat')->load($data['chat_id']);
                $number_message = $chat->getData('number_message') + 1;
                $chat->setUserName($data['user_name'])->setData('is_read',3)->setData('answered',0)->setData('number_message',$number_message)->save();
                $this->_cacheTypeList->cleanType('full_page');
                if($data['customer_name'] && $this->_helper->getConfig('email_settings/enable_email')) {
                    $data['url'] = $this->_helper->getUrl();
                    $this->sender->sendAdminChat($data);
                }
            }catch(\Exception $e){
                $this->messageManager->addError(
                    __('We can\'t process your request right now. Sorry, that\'s all we know.')
                    );
                return;
            }
        }
    }
}
