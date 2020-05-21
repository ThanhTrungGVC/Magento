<?php


namespace Ex\ChatFacebook\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const FACEBOOK_MESSENGER_ENABLE = 'ex_chatfacebook/general/facebook_messenger_enable';
    const FACEBOOK_MESSENGER_CUSTOMER_CHAT_CODE = 'ex_chatfacebook/general/facebook_messenger_customer_chat_code';
    const TAWK_TO_WIDGET_ENABLE = 'ex_chatfacebook/general/tawk_enable';
    const TAWK_TO_WIDGET_CODE = 'ex_chatfacebook/general/tawk_widget_code';

    /**
     * Retrieve the facebook messenger status
     *
     * @return boolean
     */
    public function getFacebookMessengerStatus()
    {
        return $this->scopeConfig->isSetFlag(
            self::FACEBOOK_MESSENGER_ENABLE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Retrieve the facebook messenger customer chat code
     *
     * @return string
     */
    public function getFacebookMessengerChatCode()
    {
        return '      <!-- Your customer chat code -->
      <div class="fb-customerchat"
        attribution=setup_tool
        page_id="112604557109963"
  logged_in_greeting="Xin chào! Tôi có thể giúp gì cho bạn?"
  logged_out_greeting="Xin chào! Tôi có thể giúp gì cho bạn?">
      </div>';
    }

    /**
     * Retrieve the tawk.to widget status
     *
     * @return boolean
     */
    public function getTawkToWidgetStatus()
    {
        return $this->scopeConfig->isSetFlag(
            self::TAWK_TO_WIDGET_ENABLE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Retrieve the Tawk.to widget code
     *
     * @return string
     */
    public function getTawkToWidgetCode()
    {
        return $this->scopeConfig->getValue(
            self::TAWK_TO_WIDGET_CODE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
