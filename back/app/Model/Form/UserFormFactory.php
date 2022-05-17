<?php

namespace App\Model\Form;

use App\Model\Repository\TeamRepository;
use App\Model\Repository\UserRepository;
use Nette\Application\UI\Form;
use Nette\Database\Table\ActiveRow;
use Nette\Forms\Form as FormAlias;
use Nette\Security\Passwords;
use Nette\Utils\Image;
use Nette\Utils\Strings;

class UserFormFactory
{
    public function __construct(
        private FormFactory $factory,
        private UserRepository $userRepository,
        private Passwords $passwords,
    ) {
    }

    public function create(callable $onSuccess, ?ActiveRow $user, callable $onError): Form
    {
        $form = $this->factory->create();

        $form->addEmail('email')
            ->setDefaultValue($user->email ?? null)
            ->addRule(FormAlias::EMAIL, 'Zadaný e-mail není validní.')
            ->setRequired('E-mail uživatele je povninné pole.');

        $form->addText('phone')
            ->setDefaultValue($user->phone ?? null);

        $form->addText('name')
            ->setDefaultValue($user->name ?? null);

        $form->addText('surname')
            ->setDefaultValue($user->surname ?? null);

        $form->addPassword('password');

        $form->addSubmit('submit', 'submit');

        $form->onSuccess[] = function (Form $form, \stdClass $values) use ($onSuccess, $user, $onError): void {
            if ($user == null) {
                if ($this->userRepository->getUserByEmail($values->email) != null) {
                    $onError();
                    return;
                }
                $user = $this->userRepository->insert(['email' => $values->email, 'phone' => $values->phone, 'name' => $values->name, 'surname' => $values->surname, 'password' => $this->passwords->hash($values->password), 'role' => 'user']);
            } else {
                if ($user->email != $values->email) {
                    if ($this->userRepository->getUserByEmail($values->email) != null) {
                        $onError();
                        return;
                    }
                }
                if ($values->password == null) {
                    $password = $user->password;
                } else {
                    $password = $this->passwords->hash($values->password);
                }
                $this->userRepository->update($user->user_id, ['email' => $values->email, 'phone' => $values->phone, 'name' => $values->name, 'surname' => $values->surname, 'password' => $password]);
            }

            $onSuccess($user->user_id);
        };

        return $form;
    }
}
