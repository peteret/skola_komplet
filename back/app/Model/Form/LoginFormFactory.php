<?php

namespace App\Model\Form;

use App\Model\Repository\UserRepository;
use Nette\Application\UI\Form;
use Nette\Security\Passwords;
use Nette\Security\User;

class LoginFormFactory
{
    public function __construct(
        private FormFactory $factory,
        private UserRepository $userRepository,
        private Passwords $passwords,
        private User $user,
    ) {
    }

    public function create(callable $onSuccess, callable $onError): Form
    {
        $form = $this->factory->create();
        $form->addText('nick')
            ->setRequired('Nick je povinné pole.');

        $form->addPassword('password')
            ->setRequired('Heslo je povinné pole.');

        $form->addSubmit('submit', 'submit');

        $form->onSuccess[] = function (Form $form, \stdClass $values) use ($onSuccess, $onError): void {
            $user = $this->userRepository->getUserByEmail($values->nick);
            if ($user == null) {
                $onError("Zle dfs prihlasovacie údaje.");
                return;
            }
            if ($this->passwords->verify($values->password, $user->password) === false) {
                $onError("Zle prihlasovacie údaje.");
                return;
            }

            $this->user->login($values->nick, $values->password);

            $onSuccess();
        };

        return $form;
    }
}