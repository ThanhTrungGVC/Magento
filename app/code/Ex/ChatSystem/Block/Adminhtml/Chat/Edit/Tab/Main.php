<?php
namespace Ex\ChatSystem\Block\Adminhtml\Chat\Edit\Tab;

class Main extends \Magento\Framework\View\Element\Template
{
     /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    protected $_template = 'Ex_ChatSystem::chat/chat.phtml';

    protected $_columnDate = 'main_table.created_at';

      /**
     * @var \Magento\Framework\Data\Form\FormKey
     */
    protected $formKey;

    protected $authSession;

    protected $messsage;
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Backend\Model\Auth\Session $authSession,
        \Ex\ChatSystem\Model\ChatMessage $messsage
    ) {
        parent::__construct($context);
        $this->_coreRegistry = $registry;
        $this->formKey   = $context->getFormKey();
        $this->authSession = $authSession;
        $this->messsage = $messsage;

    }

    public function getCurrentChat() {
        return $this->_coreRegistry->registry('exchatsystem_chat');
    }
    public function getFormKey() {
        return $this->formKey->getFormKey();
    }

    public function getUser() {
        $user = $this->authSession->getUser();
        return $user;
    }
    public function isRead() {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance ();
        $chat = $objectManager->create('Ex\ChatSystem\Model\Chat')->load($this->getCurrentChat()->getData('chat_id'));
        //$messsage = $objectManager->create('Ex\ChatSystem\Model\ChatMessage')->load()->getCollection(); 
        $messsage = $this->messsage->getCollection()->addFieldToFilter('chat_id',$this->getCurrentChat()->getData('chat_id'))->addFieldToFilter('is_read',1);
        foreach ($messsage as $key => $_messsage) {
            $_messsage->setData('is_read',0)->save();
        }

        $chat->setData('is_read',0)->save();

        return;
    }
}
