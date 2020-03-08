<?php declare(strict_types=1);

namespace WsCalendar\Models\Definition;

use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\DateField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IntField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\System\User\UserDefinition;
use WsCalendar\Models\Entity\CalendarEventsAcl as CalendarEventsAclEntity;

class CalendarEventsAcl extends EntityDefinition
{
    public const ENTITY_NAME = 'ws_calendar_events_acl';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection(
            [
                (new IdField('id', 'id'))->addFlags(new Required(), new PrimaryKey()),
                (new FkField('event_id', 'eventId', CalendarRoles::class))->addFlags(new Required()),
                (new FkField('role_id', 'roleId', CalendarRoles::class))->addFlags(new Required()),
                new OneToOneAssociationField('calendarRoles', 'role_id', 'roleId', CalendarRoles::class),
                new OneToOneAssociationField('calendarEvents', 'event_id', 'eventId', CalendarEvents::class),
            ]
        );
    }

    public function getEntityClass(): string
    {
        return CalendarEventsAclEntity::class;
    }
}
