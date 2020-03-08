<?php declare(strict_types=1);

namespace WsCalendar;

use Shopware\Core\Framework\DataAbstractionLayer\Indexing\Indexer\InheritanceIndexer;
use Shopware\Core\Framework\DataAbstractionLayer\Indexing\MessageQueue\IndexerMessageSender;
use Shopware\Core\Framework\Plugin;
use Shopware\Core\Framework\Plugin\Context\ActivateContext;

class WsCalendar extends Plugin
{
    public function getStorefrontScriptPath(): string
    {
        return 'Resources/app/storefront/src/js';
    }

    public function activate(ActivateContext $activateContext): void
    {
        $indexerMessageSender = $this->container->get(IndexerMessageSender::class);
        $indexerMessageSender->partial(new \DateTimeImmutable(), [InheritanceIndexer::getName()]);
    }
}
