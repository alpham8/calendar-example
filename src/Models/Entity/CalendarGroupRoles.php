<?php declare(strict_types=1);

namespace WsCalendar\Models\Entity;

use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class CalendarGroupRoles extends Entity
{
    use EntityIdTrait;

    /**
     * @var int
     */
    private $groupId;

    /**
     * @var int
     */
    private $roleId;

    /**
     * @var CalendarGroups
     */
    private $calendarGroups;

    /**
     * @var CalendarRoles
     */
    private $calendarRoles;

    /**
     * @return int
     */
    public function getGroupId(): int
    {
        return $this->groupId;
    }

    /**
     * @param int $groupId
     */
    public function setGroupId(int $groupId): void
    {
        $this->groupId = $groupId;
    }

    /**
     * @return int
     */
    public function getRoleId(): int
    {
        return $this->roleId;
    }

    /**
     * @param int $roleId
     */
    public function setRoleId(int $roleId): void
    {
        $this->roleId = $roleId;
    }

    /**
     * @return CalendarGroups
     */
    public function getCalendarGroups(): CalendarGroups
    {
        return $this->calendarGroups;
    }

    /**
     * @param CalendarGroups $calendarGroups
     */
    public function setCalendarGroups(CalendarGroups $calendarGroups): void
    {
        $this->calendarGroups = $calendarGroups;
    }

    /**
     * @return CalendarRoles
     */
    public function getCalendarRoles(): CalendarRoles
    {
        return $this->calendarRoles;
    }

    /**
     * @param CalendarRoles $calendarRoles
     */
    public function setCalendarRoles(CalendarRoles $calendarRoles): void
    {
        $this->calendarRoles = $calendarRoles;
    }
}
