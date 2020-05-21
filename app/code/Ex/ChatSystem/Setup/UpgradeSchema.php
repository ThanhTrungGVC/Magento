<?php
namespace Ex\ChatSystem\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

/**
 * @codeCoverageIgnore
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        $table = $installer->getTable('ex_chatsystem_chat');

        $installer->getConnection()->addColumn(
            $table,
            'ip',
            [
                'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length'   => 255,
                'nullable' => true,
                'comment'  => 'Ip'
            ]
        );

         $installer->getConnection()->addColumn(
            $table,
            'current_url',
            [
                'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length'   => 255,
                'nullable' => true,
                'comment'  => 'Current Url'
            ]
        );

         $installer->getConnection()->addColumn(
            $table,
            'number_message',
            [
                'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                'length'   => 11,
                'nullable' => true,
                'comment'  => 'Number Message'
            ]
        );
        $installer->getConnection()->addColumn(
            $table,
            'status',
             [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                'unsigned' => true,
                'nullable' => false,
                'default' => '1',
                'comment' => 'Status'
            ]
        );
        $installer->getConnection()->addColumn(
            $table,
            'answered',
           [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                'unsigned' => true,
                'nullable' => false,
                'default' => '1',
                'comment' => 'Answered'
            ]
        );
        $installer->endSetup();
    }
}
