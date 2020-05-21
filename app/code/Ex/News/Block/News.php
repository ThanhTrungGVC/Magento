<?php
namespace Ex\News\Block;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class News extends Template
{
  public function get_xml_new()
  {
      $url="https://vnexpress.net/rss/khoa-hoc.rss";
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
