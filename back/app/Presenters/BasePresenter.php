<?php

namespace App\Presenters;

use App\Model\Repository\UserRepository;

class BasePresenter extends \Nette\Application\UI\Presenter
{
    private UserRepository $userRepository;

    public function beforeRender()
    {
        parent::beforeRender();
        if ($this->user->isLoggedIn()) {
            $this->template->userInfo = $this->userRepository->getById($this->user->getId());
        } else {
            $this->flashMessage('Pre vstup do administrácie se musíte prihlásiť', 'alert-danger');
            $this->redirect('Login:');
        }
        $this->template->page = "";
    }

    public function injectUserRepository(UserRepository $userRepository): void
    {
        $this->userRepository = $userRepository;
    }
}