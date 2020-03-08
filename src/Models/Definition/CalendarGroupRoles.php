<?php declare(strict_types=1);

namespace WsCalendar\Models\Definition;

use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IntField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\System\User\UserDefinition;
use WsCalendar\Models\Entity\CalendarGroupRoles as CalendarGroupRolesEntity;

class CalendarGroupRoles extends EntityDefinition
{
    public const ENTITY_NAME = 'ws_calendar_group_roles';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection(
            [
                (new IdField('id', 'id'))->addFlags(new Required(), new PrimaryKey()),
                (new FkField('group_id', 'groupId', CalendarGroups::class))->addFlags(new Required()),
                (new FkField('role_id', 'roleId', CalendarRoles::class))->addFlags(new Required()),
                new OneToOneAssociationField('calendarGroups', 'group_id', 'groupId', CalendarGroups::class),
                new OneToOneAssociationField('calendarRoles', 'role_id', 'roleId', CalendarRoles::class),
            ]
        );
    }

    public function getEntityClass(): string
    {
        return CalendarGroupRolesEntity::class;
    }
}
