<?php

namespace App\Command;

use App\Component\User\UserManager;
use App\Repository\UserRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'roles:add-to-user',
    description: 'Command to add roles to the user',
    aliases: ['r:add']
)]
class RolesAddToUserCommand extends Command
{
    public function __construct(
       private readonly UserManager $userManager,
       private readonly UserRepository $userRepository,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $idQuestion = new Question('Please enter user id: ');
        $roleQuestion = new Question('Please enter role: ');

        $questionHelper = $this->getHelper('question');

        $id = null;
        $user = null;
        $role = null;
        while (!$user) {
            while (!$id) {
                $id = $questionHelper->ask($input, $output, $idQuestion);

                if ($id) {
                    $io->info("Entered id: " . $id);
                } else {
                    $io->warning("Please enter user id");
                }
            }

            $user = $this->userRepository->find($id);
            if (!$user) {
                $io->warning("User not found");
                exit;
            }
        }
        while (!$role) {
            $role = $questionHelper->ask($input, $output, $roleQuestion);
            if (!$role) {
                $io->warning("Please enter role");
            }
        }
        if ($user->getRoles()) {
            $roles = $user->getRoles();
            $roles[] = $role;

            $user->setRoles($roles);
            $this->userManager->save($user, true);

            $io->success('Role added successfully');
        }


        return Command::SUCCESS;
    }
}
