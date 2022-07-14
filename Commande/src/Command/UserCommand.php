<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use App\Repository\UserRepository;

class UserCommand extends Command
{
    protected static $defaultName = 'app:sending-mail';
    protected static $defaultDescription = 'hello user we are sending your email';
    private $userRepository;
    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    public function __construct( MailerInterface $MailerInterface,UserRepository $userRepository)

    { 
        parent::__construct(null);
        $this->MailerInterface = $MailerInterface;
        $this->userRepository = $userRepository;
 
    }

   
    protected function execute(InputInterface $input, OutputInterface $output): int
    {   $io = new SymfonyStyle($input, $output);

        $users = $this->userRepository
        -> findallUsers('admin@admin.com');
        $io->progressStart(count($users));
        foreach ($users as $user) {
            $io->progressAdvance();
            $Address=$user->getEmail();
            $Name=$user->getUsername();

        $email = (new Email())
        

        ->from('admin@admin.com')
        ->to($Address)
        ->subject('Time for Symfony Mailer!')
        ->text('Sending emails is fun again!')
        ->html('Bonjour '.$Name.', Bienvenue a talan Academy');
        sleep(5);
        $this->MailerInterface->send($email);}

        $io->progressFinish();
        $io->success('Email sent to users!');
        return 0;
       
    }
       
        // $arg1 = $input->getArgument('arg1');

        // if ($arg1) {
        //     $io->note(sprintf('You passed an argument: %s', $arg1));
        // }

        // if ($input->getOption('option1')) {
        //     // ...
        // }

        // $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

  
    }

