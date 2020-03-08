<?php declare(strict_types=1);

namespace WsCalendar\Models\Definition;

use Shopware\Core\Checkout\Customer\CustomerDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\DateTimeField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IntField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class CalendarEventsCustomerMail extends EntityDefinition
{
    public const ENTITY_NAME = 'ws_calendar_events_customer_mail';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new Required(), new PrimaryKey()),
            (new FkField('event_id', 'eventId', CalendarEvents::class))->addFlags(new Required()),
            (new FkField('customer_id', 'customerId', CustomerDefinition::class))->addFlags(new Required()),
            (new DateTimeField('created_at', 'createdAt'))->addFlags(new Required()),
            (new DateTimeField('updated_at', 'updatedAt'))->addFlags(new Required()),
            new OneToOneAssociationField('event', 'event_id', 'eventId', CalendarEvents::class),
            new OneToOneAssociationField('customer', 'customer_id', 'customerId', CustomerDefinition::class),
        ]);
    }

    public function getEntityClass(): string
    {
        return WsCalendar\Models\Entity\CalendarEventsCustomerMail::class;
    }
}
