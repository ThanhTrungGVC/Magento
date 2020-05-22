<?php
namespace Magento\BundleGraphQl\Model\Resolver\Product\Fields\DynamicWeight;

/**
 * Interceptor class for @see \Magento\BundleGraphQl\Model\Resolver\Product\Fields\DynamicWeight
 */
class Interceptor extends \Magento\BundleGraphQl\Model\Resolver\Product\Fields\DynamicWeight implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct()
    {
        $this->___init();
    }

    /**
     * {@inheritdoc}
     */
    public function resolve(\Magento\Framework\GraphQl\Config\Element\Field $field, $context, \Magento\Framework\GraphQl\Schema\Type\ResolveInfo $info, ?array $value = null, ?array $args = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'resolve');
        if (!$pluginInfo) {
            return parent::resolve($field, $context, $info, $value, $args);
        } else {
            return $this->___callPlugins('resolve', func_get_args(), $pluginInfo);
        }
    }
}
