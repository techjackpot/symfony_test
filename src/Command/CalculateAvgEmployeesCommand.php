<?php

namespace App\Command;

use App\Repository\LocationRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CalculateAvgEmployeesCommand extends Command
{
    protected static $defaultName = 'calculate:avg-employees';
    /**
     * @var LocationRepository
     */
    private $repository;

    public function __construct(LocationRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    protected function configure()
    {
        $this
            ->setDescription('Calculate avg num of employees')
            ->addArgument('location-ids', InputArgument::OPTIONAL, 'Location ids, comma separated list');
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $ids = [];

        if($input->getArgument('location-ids')){
            $ids = explode(',', $input->getArgument('location-ids'));
        }

        $io->note(sprintf('Avg num of employees: %s', $this->repository->countAvgNumOfEmployees($ids)));

        return 0;
    }
}
