<?php declare(strict_types=1);

namespace Hiring\Application\Model;

use Ecotone\Messaging\Attribute\Asynchronous;
use Ecotone\Modelling\Attribute\EventHandler;

class EmployeeNotifier
{
    #[Asynchronous("employees")]
    #[EventHandler('employee.was_engaged', endpointId: 'employee_engaged_endpoint')]
    public function notifyAbout(EmployeeWasEngagedEvent $event): void
    {
        echo "Employee with id {$event->getEmployeeId()} was engaged!\n";
    }
}
