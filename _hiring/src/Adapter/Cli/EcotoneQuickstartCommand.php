<?php declare(strict_types=1);

namespace Hiring\Adapter\Cli;


use Hiring\Application\EcotoneQuickstart;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EcotoneQuickstartCommand extends Command
{
    /**
     * @var EcotoneQuickstart
     */
    private $ecotoneQuickstart;

    public function __construct(EcotoneQuickstart $ecotoneQuickstart)
    {
        parent::__construct("ecotone:quickstart");
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
