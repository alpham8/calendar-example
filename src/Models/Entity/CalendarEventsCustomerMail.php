<?php declare(strict_types=1);

namespace WsCalendar\Models\Entity;

use Shopware\Core\Checkout\Customer\CustomerEntity;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class CalendarEventsCustomerMail extends Entity
{
    use EntityIdTrait;

    /**
     * @var int
     */
    private $eventId;

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
