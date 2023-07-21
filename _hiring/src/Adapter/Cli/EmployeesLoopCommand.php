<?php declare(strict_types=1);

namespace Hiring\Adapter\Cli;

use Hiring\Application\EmployeesLoopQuickstart;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EmployeesLoopCommand extends Command
{
    /**
     * @var EmployeesLoopQuickstart
     */
    private $ecotoneQuickstart;

    public function __construct(EmployeesLoopQuickstart $ecotoneQuickstart)
    {
        parent::__construct("ecotone:loop");
        $this->ecotoneQuickstart = $ecotoneQuickstart;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("<comment>Running example...</comment>");
        $this->ecotoneQuickstart->run();
        $output->writeln("\n<info>Good job, scenario ran with success!</info>");

        return 0;
    }
}
