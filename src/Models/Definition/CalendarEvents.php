<?php declare(strict_types=1);

namespace WsCalendar\Models\Definition;

use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\DateTimeField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use WsCalendar\Models\Entity\CalendarEvents as CalendarEventsEntity;

class CalendarEvents extends EntityDefinition
{
    public const ENTITY_NAME = 'ws_calendar_events';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection(
            [
                (new IdField('id', 'id'))->addFlags(new Required(), new PrimaryKey()),
                (new DateTimeField('start_date', 'startDate'))->addFlags(new Required()),
                (new DateTimeField('end_date', 'endDate'))->addFlags(new Required()),
                (new StringField('description', 'description'))->addFlags(new Required()),
                new StringField('area', 'area'),
                new StringField('link', 'link')
            ]
        );
    }

    public function getEntityClass(): string
    {
        return CalendarEventsEntity::class;
    }
}
