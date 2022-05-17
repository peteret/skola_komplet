<?php

namespace App\Presenters;

use App\Model\Form\LoginFormFactory;
use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;
use Nette\Security\Passwords;

class LoginPresenter extends Presenter
{
    public function __construct(
        private LoginFormFactory $loginFormFactory,
        private Passwords $passwords,
    ) {
    }

    public function renderHeslo($id){
        echo $this->passwords->hash($id);
    }

    protected function createComponentLoginForm(): Form
    {
        return $this->loginFormFactory->create(
            function (): void {
                $this->redirect('Ring:');
            },
            function (string $error): void {
                $this->flashMessage($error, 'alert-danger');
            }
        );
    }
}