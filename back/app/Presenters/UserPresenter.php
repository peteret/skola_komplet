<?php

namespace App\Presenters;

use App\Model\Form\UserFormFactory;
use App\Model\Repository\UserRepository;
use Nette\Application\UI\Form;
use Nette\Database\Table\ActiveRow;

class UserPresenter extends BasePresenter
{
    private ActiveRow $editUser;

    public function __construct(
        private UserFormFactory $userFormFactory,
        private UserRepository $userRepository,
    ) {
    }

    public function beforeRender()
    {
        parent::beforeRender();
        $this->template->page = "user";
    }

    public function actionEdit(int $id): void
    {
        $this->template->editUser = $this->userRepository->getById($id);
        if ($this->template->editUser == null) {
            $this->flashMessage('Tento uživatel neexistuej', 'alert-danger');
            $this->redirect('User:list');
        }
        $this->editUser = $this->template->editUser;
    }

    public function actionDelete(int $id): void
    {
        $this->userRepository->delete($id);
        $this->flashMessage('Uživatel byl úspěšně smazán.', 'alert-success');
        $this->redirect('User:list');
    }

    public function renderList(): void
    {
        $this->template->users = $this->userRepository->getAll();
    }

    protected function createComponentAddUserForm(): Form
    {
        return $this->userFormFactory->create(
            function (int $userId) {
                $this->flashMessage('Uživatel byl úspěšně vytvořen.', 'alert-success');
                $this->redirect('User:edit', $userId);
            },
            null,
            function () {
                $this->flashMessage('Chyba! Uživatel nemohl být registrován, protože tento e-mail je již zaregistrován.', 'alert-danger');
            }
        );
    }

    protected function createComponentEditUserForm(): Form
    {
        return $this->userFormFactory->create(
            function (int $userId) {
                $this->flashMessage('Uživatel byl úspěšně aktualizován.', 'alert-success');
                $this->redirect('User:edit', $userId);
            },
            $this->editUser,
            function () {
                $this->flashMessage('Chyba! Uživatel nemohl být upraven, protože nově zadaný e-mail je již zaregistrován.', 'alert-danger');
            }
        );
    }


}
