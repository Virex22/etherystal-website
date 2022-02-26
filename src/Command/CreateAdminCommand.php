<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateAdminCommand extends Command
{
    protected static $defaultName = 'CreateAdmin';
    protected static $defaultDescription = 'create user';

    protected function configure(): void
    {
        $this
        ->addArgument('nom', InputArgument::REQUIRED, 'Argument description')
        ->addArgument('pass', InputArgument::REQUIRED, 'Argument description')
        ;
    }
    
    private $encoder;
    private $manager;

    public function __construct(UserPasswordHasherInterface $encoder, EntityManagerInterface $manager)
    {
        parent::__construct();
        $this->encoder = $encoder;
        $this->manager = $manager;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $nom = $input->getArgument('nom');
        $pass = $input->getArgument('pass');

        $userAdmin = new User();
        $userAdmin->setUsername($nom)
            ->setPassword($this->encoder->hashPassword($userAdmin, $pass))
            ->setRoles(["ROLE_ADMIN"]);
        $this->manager->persist($userAdmin);

        $this->manager->flush();

        $io->success('User added.');

        return Command::SUCCESS;
    }
}