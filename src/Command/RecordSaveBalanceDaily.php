<?php
namespace App\Command;

use App\Repository\TransactionRepository;
use App\Service\SaveBalanceService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RecordSaveBalanceDaily extends Command
{
    private $saveBalance;

    protected static $defaultName = 'app:save:balance';


    public function __construct(SaveBalanceService $saveBalance, TransactionRepository $transactionRepository)
    {
        $this->saveBalance = $saveBalance;
        $this->transactionRepository = $transactionRepository;

        parent::__construct();
    }

    protected function configure()
    {
    $this
    ->setDescription('Record balance daily')
    ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $transactions = $this->transactionRepository->findAll();
            $this->saveBalance->globalBalance($transactions);
            return Command::SUCCESS;

        }catch(Exception $e){
            return Command::FAILURE;
        }

    }
}
