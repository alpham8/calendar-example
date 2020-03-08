<?php declare(strict_types=1);

namespace WsCalendar\Models\Definition;

use Shopware\Core\Checkout\Customer\CustomerDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IntField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class CalendarEventsParticipant extends EntityDefinition
{
    public const ENTITY_NAME = 'ws_calendar_events_participant';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new Required(), new PrimaryKey()),
            (new IntField('confirm', 'confirm'))->addFlags(new Required()),
            (new FkField('event_id', 'eventId', CalendarEvents::class))->addFlags(new Required()),
            (new FkField('customer_id', 'customerId', CustomerDefinition::class))->addFlags(new Required()),
            new OneToOneAssociationField('event', 'event_id', 'eventId', CalendarEvents::class),
            new OneToOneAssociationField('customer', 'customer_id', 'customerId', CustomerDefinition::class),
        ]);
    }

    public function getEntityClass(): string
    {
        return WsCalendar\Models\Entity\CalendarUserGroup::class;
    }
}
