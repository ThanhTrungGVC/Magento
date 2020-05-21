<?php

namespace Ex\ChatSystem\Block\Adminhtml\Chat\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('ticket_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Chat Information'));
    }

    /**
     * @return $this
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareLayout()
    {
        $this->addTab(
                'main_section',
                [
                    'label' => __('General'),
                    'content' => $this->getLayout()->createBlock('Ex\ChatSystem\Block\Adminhtml\Chat\Edit\Tab\Main')->toHtml()
                ]
            );
          $this->addTab(
                'customer_information',
                [
                    'label' => __('Customer Information'),
                    'content' => $this->getLayout()->createBlock('Ex\ChatSystem\Block\Adminhtml\Chat\Edit\Tab\Customer')->toHtml()
                ]
            );
    }
}
