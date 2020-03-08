<?php declare(strict_types=1);

namespace WsCalendar\Models\Collection;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;
use WsCalendar\Models\Entity\CalendarRoles as CalendarRolesEntity;

/**
 * @method void              add(\WsCalendar\Models\Entity\CalendarRoles $entity)
 * @method void              set(string $key, \WsCalendar\Models\Entity\CalendarRoles $entity)
 * @method \WsCalendar\Models\Entity\CalendarRoles[]    getIterator()
 * @method \WsCalendar\Models\Entity\CalendarRoles[]    getElements()
 * @method \WsCalendar\Models\Entity\CalendarRoles|null get(string $key)
 * @method \WsCalendar\Models\Entity\CalendarRoles|null first()
 * @method \WsCalendar\Models\Entity\CalendarRoles|null last()
 */
class CalendarRoles extends EntityCollection
{
    public function getExpectedClass(): string
    {
        return CalendarRolesEntity::class;
    }
}
