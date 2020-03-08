<?php declare(strict_types=1);

namespace WsCalendar\Models\Entity;

use Shopware\Core\Checkout\Customer\CustomerEntity;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class CalendarEventsParticipant extends Entity
{
    const CONFIRM_TRUE = 1;
    const CONFIRM_MAYBE = 0;
    const CONFIRM_FALSE = -1;

    use EntityIdTrait;

    /**
     * @var int
     */
    private $eventId;

    /**
     * @var int
     */
    private $confirm;

    /**
     * @var int
     */
    private $customerId;

    /**
     * @var CustomerEntity
     */
    private $customer;

    /**
     * @var CalendarEvents
     */
    private $event;

    /**
     * @return int
     */
    public function getConfirm(): int
    {
        return $this->confirm;
    }

    /**
     * @param int $confirm
     */
    public function setConfirm(int $confirm): void
    {
        if (in_array($confirm, [self::CONFIRM_TRUE, self::CONFIRM_MAYBE, self::CONFIRM_FALSE], true)) {
            $this->confirm = $confirm;
        }
    }

    /**
     * @return int
     */
    public function getEventId(): int
    {
        return $this->eventId;
    }

    /**
     * @param int $eventId
     */
    public function setEventId(int $eventId): void
    {
        $this->eventId = $eventId;
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
     * @return CalendarEvents
     */
    public function getEvent(): CalendarEvents
    {
        return $this->event;
    }

    /**
     * @param CalendarEvents $event
     */
    public function setEvent(CalendarEvents $event): void
    {
        $this->event = $event;
    }
}
