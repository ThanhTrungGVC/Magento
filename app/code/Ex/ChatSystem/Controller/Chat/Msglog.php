<?php
namespace Ex\ChatSystem\Controller\Chat;

use Magento\Customer\Controller\AccountInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Display Hello on screen
 */
class Msglog extends \Magento\Framework\App\Action\Action
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

    protected $chat;
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
        \Ex\ChatSystem\Model\Chat $chat,
        \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Customer\Model\Session $customerSession
        ) {
        $this->chat                 = $chat;
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
        $chat = $this->chat->load($this->_helper->getIp(),'ip');

        if($this->_customerSession->getCustomer()->getEmail()) {
            $message = $this->_message->getCollection()->addFieldToFilter('customer_email',$this->_customerSession->getCustomer()->getEmail());
        } else {
           $message = $this->_message->getCollection()->addFieldToFilter('chat_id',$chat->getId());
        }
        $count = count($message);
        $i=0;

        foreach ($message as $key => $_message) {
            $i++;
            $date_sent = $_message['created_at'];
            $day_sent = substr($date_sent, 8, 2);
            $month_sent = substr($date_sent, 5, 2);
            $year_sent = substr($date_sent, 0, 4);
            $hour_sent = substr($date_sent, 11, 2);
            $min_sent = substr($date_sent, 14, 2);

            if (!$_message['user_id'])
            {
                print '<div class="msg-user">
                        <p>'.$_message['body_msg'].'</p>
                        <div class="info-msg-user">
                            You
                        </div>
                    </div> ';

            } else {

                print '<div class="msg">
                    <p>'.$_message['body_msg'].'</p>
                    <div class="info-msg">
                        '.$_message['user_name'].'
                    </div>
                </div>';
                if($count == $i) {
                    echo "
                    <script>require(['jquery'],function($) { $('.chat-message-counter').css('display','inline'); });</script>
                    ";
                }

            }
        }
        exit;
    }
}
