<?php
namespace Ex\News\Cron;

use Psr\Log\LoggerInterface;

class Auto_Update_News {
    protected $logger;

    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    }

   /**
    * Write to system.log
    *
    * @return void
    */
    public function execute() {
        $this->logger->info('Cron News Works');
    }
}
