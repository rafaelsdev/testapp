<?php
namespace ASPTest\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use ASPTest\Controller\UserController;


class CreateUserCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'ASPTest:create-user';
    protected static $defaultDescription = 'Cria um novo usuario.';

    protected function configure(): void
    {
        $this
          ->addArgument('name', InputArgument::REQUIRED, 'Users first name')
          ->addArgument('last_name', InputArgument::REQUIRED, 'Users last name')
          ->addArgument('e_mail', InputArgument::REQUIRED, 'Users e-mail')
          ->addArgument('age', InputArgument::OPTIONAL, 'Users age');

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        

        if(!empty($input->getArgument('name')) 
            && strlen($input->getArgument('name')) >= 2 
            && $input->getArgument('name') <= 35){

            $firstName = $input->getArgument('name');


        }else{
            $output->writeln('Error - First name must be informed and must be between 2 and 35 characters long');
            return  Command::INVALID;
        }
        
        if(!empty($input->getArgument('last_name')) 
            && strlen($input->getArgument('last_name')) >= 2 
            && $input->getArgument('last_name') <=35){

            $lastName = $input->getArgument('last_name');

        }else{
            $output->writeln('Error - Second name must be informed and must be between 2 and 35 characters long');
            return  Command::INVALID;
        }

   //     $input->getArgument('second_name');

        if (filter_var($input->getArgument('e_mail'), FILTER_VALIDATE_EMAIL)) {

            $email = $input->getArgument('e_mail');

        }else{
            $email = $input->getArgument('e_mail');
            $output->writeln("Email address '$email' is invalid.\n");
            return  Command::INVALID;

        }

        
        if(!empty($input->getArgument('age'))){

            $age = $input->getArgument('age');

            if($age < 0 || $age > 150){
                $output->writeln("A valid age must be informed");
                return  Command::INVALID;
                #return ;
            }
        } else {
            $age = null;
        }


        $dataSet = [
            'firstname' => $firstName
            ,'lastname' => $lastName
            ,'email' => $email
            ,'age' => (int) $age
        ];

        

     //   UserController::setUserData($dataSet);

        $user = new UserController();

        $rs = $user -> addUser($dataSet);

        if($rs){
            echo json_encode($dataSet);
        }else{
             $output->writeln("Failed to register user."); 
        }

        //var_dump($user);

       
        return Command::SUCCESS;

    }
}