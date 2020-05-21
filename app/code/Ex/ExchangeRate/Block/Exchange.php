<?php
namespace Ex\ExchangeRate\Block;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class Exchange extends Template
{
  public function get_xml_exchangeRate()
  {
      $url="https://portal.vietcombank.com.vn/Usercontrols/TVPortal.TyGia/pXML.aspx?b=68";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_URL, $url);    // get the url contents
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

      $data = curl_exec($ch); // execute curl request
      curl_close($ch);

      $xml = simplexml_load_string($data);

      return $xml;
  }
}
