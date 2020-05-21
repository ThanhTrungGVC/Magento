<?php
namespace Ex\ChatSystem\Model\TransportBuilder;

/**
 * Interceptor class for @see \Ex\ChatSystem\Model\TransportBuilder
 */
class Interceptor extends \Ex\ChatSystem\Model\TransportBuilder implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Mail\Template\FactoryInterface $templateFactory, \Magento\Framework\Mail\MessageInterface $message, \Magento\Framework\Mail\Template\SenderResolverInterface $senderResolver, \Magento\Framework\ObjectManagerInterface $objectManager, \Magento\Framework\Mail\TransportInterfaceFactory $mailTransportFactory, ?\Magento\Framework\Mail\MessageInterfaceFactory $messageFactory = null, ?\Magento\Framework\Mail\EmailMessageInterfaceFactory $emailMessageInterfaceFactory = null, ?\Magento\Framework\Mail\MimeMessageInterfaceFactory $mimeMessageInterfaceFactory = null, ?\Magento\Framework\Mail\MimePartInterfaceFactory $mimePartInterfaceFactory = null, ?\Magento\Framework\Mail\AddressConverter $addressConverter = null)
    {
        $this->___init();
        parent::__construct($templateFactory, $message, $senderResolver, $objectManager, $mailTransportFactory, $messageFactory, $emailMessageInterfaceFactory, $mimeMessageInterfaceFactory, $mimePartInterfaceFactory, $addressConverter);
    }

    /**
     * {@inheritdoc}
     */
    public function setTemplateOptions($templateOptions)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setTemplateOptions');
        if (!$pluginInfo) {
            return parent::setTemplateOptions($templateOptions);
        } else {
            return $this->___callPlugins('setTemplateOptions', func_get_args(), $pluginInfo);
        }
    }
}