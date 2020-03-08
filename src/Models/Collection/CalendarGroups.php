<?php declare(strict_types=1);

namespace WsCalendar\Models\Collection;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;
use WsCalendar\Models\Entity\CalendarGroups as CalendarGroupsEntity;

/**
 * @method void              add(\WsCalendar\Models\Entity\CalendarGroups $entity)
 * @method void              set(string $key, \WsCalendar\Models\Entity\CalendarGroups $entity)
 * @method \WsCalendar\Models\Entity\CalendarGroups[]    getIterator()
 * @method \WsCalendar\Models\Entity\CalendarGroups[]    getElements()
 * @method \WsCalendar\Models\Entity\CalendarGroups|null get(string $key)
 * @method \WsCalendar\Models\Entity\CalendarGroups|null first()
 * @method \WsCalendar\Models\Entity\CalendarGroups|null last()
 */
class CalendarGroups extends EntityCollection
{
    public function getExpectedClass(): string
    {
        return CalendarGroupsEntity::class;
    }
}
