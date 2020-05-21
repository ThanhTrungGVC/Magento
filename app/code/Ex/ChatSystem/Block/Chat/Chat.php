<?php
namespace Ex\ChatSystem\Block\Chat;

class Chat extends \Magento\Framework\View\Element\Template
{
     /**
     *
     * @var int
     */
    private $_username = - 1;
    /**
     *
     * @var Magento\Framework\App\Action\Session
     */
    protected $_customerSession;
    /**
     *
     * @var \Magento\Customer\Model\Url
     */
    protected $chat;
     /**
     *
     * @var \Ex\ChatSystem\Helper\Data
     */
    protected $helper;
    /**
     *
     * @var \Magento\Customer\Model\Url
     */
    protected $_customerUrl;
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Customer\Model\Session $customerSession
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Ex\ChatSystem\Helper\Url $customerUrl,
        \Ex\ChatSystem\Helper\Data $helper,
        \Ex\ChatSystem\Model\Chat $chat,
        array $data = []
    ) {
        $this->helper = $helper;
        $this->chat = $chat;
        $this->_customerSession  = $customerSession;
        $this->_customerUrl = $customerUrl;
        parent::__construct($context, $data);
    }

    public function isLogin() {
        if ($this->_customerSession->isLoggedIn()) {
            return true;
        }
        return false;
    }
    public function getChatId() {

        if($this->isLogin()) {
            $chat = $this->chat->getCollection()->addFieldToFilter('customer_email',$this->getCustomer()->getData('email'));
            if(count($chat) > 0) {
                $chat_id = $chat->getFirstItem()->getData('chat_id');
            }else {
                $objectManager  = \Magento\Framework\App\ObjectManager::getInstance ();
                $chatModel      = $objectManager->create ( 'Ex\ChatSystem\Model\Chat' );

                $chatModel->setCustomerId($this->getCustomerSession()->getCustomerId())->setCustomerName($this->getCustomer()->getData('firstname').' '.$this->getCustomer()->getData('lastname'))->setCustomerEmail($this->getCustomer()->getData('email'));
                $chatModel->save();
                $chat_id = $chatModel->getData('chat_id');
            }
        } else {
            $chat = $this->chat->getCollection()->addFieldToFilter('ip',$this->helper->getIp());
            if(count($chat) > 0) {
                $chat_id = $chat->getFirstItem()->getData('chat_id');
            } else {
                $objectManager  = \Magento\Framework\App\ObjectManager::getInstance ();
                $chatModel      = $objectManager->create ( 'Ex\ChatSystem\Model\Chat' );
                $chatModel->setIp($this->helper->getIp());
                $chatModel->save();
                $chat_id = $chatModel->getData('chat_id');
            }
        }
        return $chat_id;
    }
    public function getCurrentUrl()
    {
        return $this->_urlBuilder->getCurrentUrl();
    }

    public function getCustomerSession()
    {
        return $this->_customerSession;
    }
    public function getCustomer()
    {
        return $this->getCustomerSession()->getCustomer();
    }
     /**
     * Retrieve form posting url
     *
     * @return string
     */
    public function getPostActionUrl() {
        $post_action_url = $this->_customerUrl->getLoginPostUrl ();
        $post_action_url = str_replace("/exchatsystem/","/", $post_action_url);
        return $post_action_url;
    }

    /**
     * Retrieve password forgotten url
     *
     * @return string
     */
    public function getForgotPasswordUrl() {
        return $this->_customerUrl->getForgotPasswordUrl ();
    }


    public function getRegisterUrl() {
        return $this->_customerUrl->getRegisterUrl ();
    }
    /**
     * Retrieve username for form field
     *
     * @return string
     */
    public function getUsername() {
        if (- 1 === $this->_username) {
            $this->_username = $this->_customerSession->getUsername ( true );
        }
        return $this->_username;
    }

    /**
     * Check if autocomplete is disabled on storefront
     *
     * @return bool
     */
    public function isAutocompleteDisabled() {
        return ( bool ) ! $this->_scopeConfig->getValue ( \Magento\Customer\Model\Form::XML_PATH_ENABLE_AUTOCOMPLETE, \Magento\Store\Model\ScopeInterface::SCOPE_STORE );
    }
}
