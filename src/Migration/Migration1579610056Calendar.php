<?php declare(strict_types=1);

namespace WsCalendar\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\InheritanceUpdaterTrait;
use Shopware\Core\Framework\Migration\MigrationStep;
use Shopware\Core\Framework\Uuid\Uuid;
use WsCalendar\Models\Entity\CalendarAcl;
use WsCalendar\Models\Entity\CalendarRoles;

class Migration1579610056Calendar extends MigrationStep
{
    use InheritanceUpdaterTrait;

    public function getCreationTimestamp(): int
    {
        return 1579610056;
    }

    public function update(Connection $connection): void
    {
        $connection->beginTransaction();
        try {
            $connection->executeQuery(
                '
            CREATE TABLE IF NOT EXISTS `ws_calendar_groups` (
              `id` BINARY(16) NOT NULL,
              `name` char(100) NOT NULL,
              `created_at` DATETIME NOT NULL,
              `updated_at` DATETIME,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        '
            );

            $connection->executeQuery(
                '
            CREATE TABLE IF NOT EXISTS `ws_calendar_roles` (
              `id` BINARY(16) NOT NULL,
              `name` char(100) NOT NULL,
              `created_at` DATETIME NOT NULL,
              `updated_at` DATETIME,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        '
            );

            $connection->executeQuery(
                '
            CREATE TABLE IF NOT EXISTS `ws_calendar_events` (
              `id` BINARY(16) NOT NULL,
              `start_date` DATETIME NOT NULL,
              `end_date` DATETIME NOT NULL,
              `description` CHAR(255) NOT NULL,
              `area` CHAR(100) DEFAULT NULL,
              `link` VARCHAR(1000) DEFAULT NULL,
              `created_at` DATETIME NOT NULL,
              `updated_at` DATETIME,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        '
            );

            $connection->executeQuery(
                '
            CREATE TABLE IF NOT EXISTS `ws_calendar_user_groups` (
              `id` BINARY(16) NOT NULL,
              `customer_id` BINARY(16) NOT NULL,
              `group_id` BINARY(16) NOT NULL,
              `created_at` DATETIME NOT NULL,
              `updated_at` DATETIME,
              PRIMARY KEY (`id`, `customer_id`, `group_id`),
              CONSTRAINT `fk.ws_calendar_user_groups.group_id` FOREIGN KEY (`group_id`)
                REFERENCES `ws_calendar_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `fk.ws_calendar_user_groups.customer_id` FOREIGN KEY (`customer_id`)
                REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        '
            );

            $connection->executeQuery(
                '
            CREATE TABLE IF NOT EXISTS `ws_calendar_group_roles` (
              `id` BINARY(16) NOT NULL,
              `role_id` BINARY(16) NOT NULL,
              `group_id` BINARY(16) NOT NULL,
              `created_at` DATETIME NOT NULL,
              `updated_at` DATETIME,
              PRIMARY KEY (`id`, `role_id`, `group_id`),
              CONSTRAINT `fk.ws_calendar_group_roles.role_id` FOREIGN KEY (`role_id`)
                REFERENCES `ws_calendar_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `fk.ws_calendar_group_roles.group_id` FOREIGN KEY (`group_id`)
                REFERENCES `ws_calendar_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        '
            );

            $connection->executeQuery(
                '
            CREATE TABLE IF NOT EXISTS `ws_calendar_events_acl` (
              `id` BINARY(16) NOT NULL,
              `role_id` BINARY(16) NOT NULL,
              `event_id` BINARY(16) NOT NULL,
              `created_at` DATETIME NOT NULL,
              `updated_at` DATETIME,
              PRIMARY KEY (`id`, `role_id`, `event_id`),
              CONSTRAINT `fk.ws_calendar_events_acl.role_id` FOREIGN KEY (`role_id`)
                REFERENCES `ws_calendar_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `fk.ws_calendar_events_acl.event_id` FOREIGN KEY (`event_id`)
                REFERENCES `ws_calendar_events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        '
            );

            $connection->executeQuery(
                '
            CREATE TABLE IF NOT EXISTS `ws_calendar_events_participant` (
              `id` BINARY(16) NOT NULL,
              `confirm` TINYINT(1) NOT NULL,
              `event_id` BINARY(16) NOT NULL,
              `customer_id` BINARY(16) NOT NULL,
              `created_at` DATETIME NOT NULL,
              `updated_at` DATETIME,
              PRIMARY KEY (`id`, `event_id`, `customer_id`),
              CONSTRAINT `fk.ws_calendar_events_participant.event_id` FOREIGN KEY (`event_id`)
                REFERENCES `ws_calendar_events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.ws_calendar_events_participant.customer_id` FOREIGN KEY (`customer_id`)
                REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        '
            );

            $connection->executeQuery(
                '
            CREATE TABLE IF NOT EXISTS `ws_calendar_events_customer_mail` (
              `id` BINARY(16) NOT NULL,
              `event_id` BINARY(16) NOT NULL,
              `customer_id` BINARY(16) NOT NULL,
              `created_at` DATETIME NOT NULL,
              `updated_at` DATETIME,
              PRIMARY KEY (`id`, `event_id`, `customer_id`),
              CONSTRAINT `fk.ws_calendar_events_customer_mail.event_id` FOREIGN KEY (`event_id`)
                REFERENCES `ws_calendar_events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.ws_calendar_events_customer_mail.customer_id` FOREIGN KEY (`customer_id`)
                REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        '
            );

//            $connection->executeQuery(
//                'INSERT INTO ws_calendar_roles (id, `name`) VALUES(UNHEX(\''
//                .CalendarAcl::ROLE_READ
//                .'\'), \'read\'),(UNHEX(\''.CalendarAcl::ROlE_WRITE.'\'), \'write\');'
//            );
            $connection->insert(
                'ws_calendar_roles',
                [
                    'id' => hex2bin(CalendarAcl::ROLE_READ),
                    'name' => 'read'
                ]
            );
            $connection->insert(
                'ws_calendar_roles',
                [
                    'id' => hex2bin(CalendarAcl::ROlE_WRITE),
                    'name' => 'write'
                ]
            );

            $mitglieder = 'a3896a895db3477788dc2c7a427f6330';
            $admins = 'f9c25c6f51e3456b95bb249acac47fbb';

//            $connection->executeQuery(
//                'INSERT INTO ws_calendar_groups(id, `name`) '
//                .'VALUES(UNHEX(\''.$mitglieder.'\'), \'Mitglieder\'), (UNHEX(\''.$admins.'\'), \'Administratoren\');'
//            );

            $connection->insert(
                'ws_calendar_groups',
                [
                    'id' => hex2bin($mitglieder),
                    'name' => 'Mitglieder'
                ]
            );
            $connection->insert(
                'ws_calendar_groups',
                [
                    'id' => hex2bin($admins),
                    'name' => 'Administratoren'
                ]
            );

//            $connection->executeQuery(
//                'INSERT INTO ws_calendar_group_roles(id, role_id, group_id) VALUES('
//                .'UNHEX(UUID()), \''.CalendarAcl::ROLE_READ.'\', UNHEX(\''.$mitglieder.'\')), '
//                .'(UNHEX(UUID()), \''.CalendarAcl::ROLE_READ.'\', UNHEX(\''.$admins.'\')), '
//                .'(UNHEX(UUID()), \''.CalendarAcl::ROlE_WRITE.'\', UNHEX(\''.$admins.'\'));'
//            );

            $connection->insert(
                'ws_calendar_group_roles',
                [
                    'id' => Uuid::randomBytes(),
                    'role_id' => hex2bin(CalendarAcl::ROLE_READ),
                    'group_id' => hex2bin($mitglieder)
                ]
            );
            $connection->insert(
                'ws_calendar_group_roles',
                [
                    'id' => Uuid::randomBytes(),
                    'role_id' => hex2bin(CalendarAcl::ROLE_READ),
                    'group_id' => hex2bin($admins)
                ]
            );
            $connection->insert(
                'ws_calendar_group_roles',
                [
                    'id' => Uuid::randomBytes(),
                    'role_id' => hex2bin(CalendarAcl::ROlE_WRITE),
                    'group_id' => hex2bin($admins)
                ]
            );
        } catch (\Exception $ex) {
            $connection->rollBack();
            throw $ex;
        }

        $updateInheritance = true;
        try {
            $builder = $connection->createQueryBuilder();
            $builder->select('cust.ws_calendar_user_groups')
                ->from('customer', 'cust')
                ->setMaxResults(1);
            $stmt = $builder->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if (!empty($data)) {
                $updateInheritance = false;
            } else {
                $updateInheritance = true;
            }
        } catch (\Exception $ex) {
            $updateInheritance = true;
        }

        try {
            if ($updateInheritance) {
                $this->updateInheritance($connection, 'customer', 'ws_calendar_user_groups');
            }
            $connection->commit();
        } catch (\Exception $ex) {
            $connection->rollBack();
            throw $ex;
        }
    }

    public function updateDestructive(Connection $connection): void
    {
        // implement update destructive
    }
}
