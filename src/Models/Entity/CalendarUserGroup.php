<?php declare(strict_types=1);

namespace WsCalendar\Models\Entity;

use Shopware\Core\Checkout\Customer\CustomerEntity;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class CalendarUserGroup extends Entity
{
    use EntityIdTrait;

    /**
     * @var int
     */
    private $groupId;

    /**
     * @var int
     */
    private $customerId;

    /**
     * @var \DateTimeInterface
     */
    private $createdAt;

    /**
     * @var CalendarGroups
     */
    private $calendarGroups;

    /**
     * @var CustomerEntity
     */
    private $customer;

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
    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    /**
     * @param int $customerId
     */
    public function setCustomerId(int $customerId): void
    {
        $this->customerId = $customerId;
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
     * @return CustomerEntity
     */
    public function getCustomer(): CustomerEntity
    {
        return $this->customer;
    }

    /**
     * @param CustomerEntity $customer
     */
    public function setCustomer(CustomerEntity $customer): void
    {
        $this->customer = $customer;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $createdAt
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
