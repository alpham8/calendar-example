<?php declare(strict_types=1);

namespace WsCalendar\Models\Collection;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;
use WsCalendar\Models\Entity\CalendarGroupRoles as CalendarGroupRolesEntity;

/**
 * @method void              add(\WsCalendar\Models\Entity\CalendarGroupRoles $entity)
 * @method void              set(string $key, \WsCalendar\Models\Entity\CalendarGroupRoles $entity)
 * @method \WsCalendar\Models\Entity\CalendarGroupRoles[]    getIterator()
 * @method \WsCalendar\Models\Entity\CalendarGroupRoles[]    getElements()
 * @method \WsCalendar\Models\Entity\CalendarGroupRoles|null get(string $key)
 * @method \WsCalendar\Models\Entity\CalendarGroupRoles|null first()
 * @method \WsCalendar\Models\Entity\CalendarGroupRoles|null last()
 */
class CalendarGroupRoles extends EntityCollection
{
    public function getExpectedClass(): string
    {
        return CalendarGroupRolesEntity::class;
    }
}
