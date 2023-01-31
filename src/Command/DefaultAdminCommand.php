<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'default:admin',
    description: 'Add a short description for your command',
)]
class DefaultAdminCommand extends Command
{
    private $doctrine;
    private $userPasswordHasher;

    public function __construct(EntityManagerInterface $doctrine, UserPasswordHasherInterface $userPasswordHasher)
    {
        parent::__construct();
        $this->doctrine = $doctrine;
        $this->userPasswordHasher = $userPasswordHasher;
    }    



    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, "Email de l'utilistaeur")
            ->addArgument('password', InputArgument::REQUIRED, "Mot de passe de l'utilistaeur")
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
      
            ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');

        $user = new User();
        $user->setEmail($email);
        $user->setPassword(
            $this->userPasswordHasher->hashPassword(
                $user,
                $password
            )
        );
        $this->doctrine->persist($user);
        $this->doctrine->flush();

        // if ($arg1) {
        //     $io->note(sprintf('You passed an argument: %s', $arg1));
        // }

        // if ($input->getOption('option1')) {
        //     // ...
        // }

        
        $io->success('Your admin user has been successfully created! ');

        return Command::SUCCESS;
    }
}
