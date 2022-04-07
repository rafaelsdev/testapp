<?php
namespace ASPTest\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use ASPTest\Controller\UserController;

class CreatePasswordCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'ASPTest:password-create';

    protected function configure(): void
    {
        $this
          ->addArgument('id', InputArgument::REQUIRED, 'User ID')
          ->addArgument('password', InputArgument::REQUIRED, 'Password')
          ->addArgument('password_confirm', InputArgument::REQUIRED, 'Password Confirmation');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        
        if(!empty($input->getArgument('id')) ){

            if(filter_var($input->getArgument('id'), FILTER_VALIDATE_INT)){

                    $id = $input->getArgument('id');

                    $user = new UserController();

                    $userData = $user -> getUser($id);

                    if(isset($userData[0]) && is_object($userData[0])){                    

                        $password = $input -> getArgument('password');
                        $password_confirm = $input -> getArgument('password_confirm');

                        // Check if password has 1 special character, 1 number, 1 upper case character
                        if(preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,100}$/',$password)){

                            // Check if password and password validation match
                            if($password === $password_confirm){


                                $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);


                                $passwordData = [
                                  'user_id' => $id
                                  ,'password' => $password
                                ];

                                $user -> setPassword($passwordData);

                            }else{

                                $output -> writeln("Invalid Password. Password and password confirmation didnt match.");

                            }


                        }else{

                            $output -> writeln('Invalid password. Your password must have 1 special character 1 number and 1 uppercase letter and be atleast 6 characters long.');

                        }

                    }else{

                        $output -> writeln('User not found');
                    }

            }else{
                $output->writeln('Error - A valid ID must be informed');
                return  Command::INVALID; 
            }
  
        }else{
            $output->writeln('Error - A valid ID must be informed');
            return  Command::INVALID; 
        }

 

        // ... put here the code to create the user

        // this method must return an integer number with the "exit status code"
        // of the command. You can also use these constants to make code more readable

        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;

        // or return this to indicate incorrect command usage; e.g. invalid options
        // or missing arguments (its equivalent to returning int(2))
        // return Command::INVALID
    }
}