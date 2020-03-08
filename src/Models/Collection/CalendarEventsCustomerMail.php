<?php declare(strict_types=1);

namespace WsCalendar\Models\Collection;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;
use WsCalendar\Models\Entity\CalendarEventsCustomerMail as CalendarEventsCustomerMailEntity;

/**
 * @method void              add(\WsCalendar\Models\Entity\CalendarEventsCustomerMail $entity)
 * @method void              set(string $key, \WsCalendar\Models\Entity\CalendarEventsCustomerMail $entity)
 * @method \WsCalendar\Models\Entity\CalendarUserGroup[]    getIterator()
 * @method \WsCalendar\Models\Entity\CalendarUserGroup[]    getElements()
 * @method \WsCalendar\Models\Entity\CalendarUserGroup|null get(string $key)
 * @method \WsCalendar\Models\Entity\CalendarUserGroup|null first()
 * @method \WsCalendar\Models\Entity\CalendarUserGroup|null last()
 */
class CalendarEventsCustomerMail extends EntityCollection
{
    public function getExpectedClass(): string
    {
        return CalendarEventsCustomerMailEntity::class;
    }
}
