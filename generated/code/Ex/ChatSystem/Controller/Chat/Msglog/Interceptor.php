<?php
namespace Ex\ChatSystem\Controller\Chat\Msglog;

/**
 * Interceptor class for @see \Ex\ChatSystem\Controller\Chat\Msglog
 */
class Interceptor extends \Ex\ChatSystem\Controller\Chat\Msglog implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Store\Model\StoreManager $storeManager, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Ex\ChatSystem\Helper\Data $helper, \Ex\ChatSystem\Model\ChatMessage $message, \Ex\ChatSystem\Model\Chat $chat, \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory, \Magento\Framework\Registry $registry, \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList, \Magento\Customer\Model\Session $customerSession)
    {
        $this->___init();
        parent::__construct($context, $storeManager, $resultPageFactory, $helper, $message, $chat, $resultForwardFactory, $registry, $cacheTypeList, $customerSession);
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        if (!$pluginInfo) {
            return parent::dispatch($request);
        } else {
            return $this->___callPlugins('dispatch', func_get_args(), $pluginInfo);
        }
    }
}
