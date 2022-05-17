<?php

namespace App\Presenters;

use App\Model\Form\UploadFormFactory;
use App\Model\Repository\UploadRepository;
use Nette\Application\UI\Form;

class UploadPresenter extends BasePresenter
{
    public function __construct(
        private UploadRepository $uploadRepository,
        private UploadFormFactory $uploadFormFactory,
    ) {
    }

    public function beforeRender()
    {
        parent::beforeRender();
        $this->template->page = "upload";
    }

    public function renderDefault(): void
    {
        $this->template->uploads = $this->uploadRepository->getAll();
    }

    public function actionDelete(int $id): void
    {
        $upload = $this->uploadRepository->getById($id);
        unlink($upload->url);
        $this->uploadRepository->delete($id);
        $this->flashMessage('Súbor úspešne zmazaný', 'alert-success');
        $this->redirect('Upload:');
    }

    protected function createComponentAddUploadForm(): Form
    {
        return $this->uploadFormFactory->create(
            function (string $url): void {
                $this->flashMessage('Súbor byl úspešne nahraný!', 'alert-success');
                $this->flashMessage('URL: ' . $this->template->baseUrl . '/' . $url, 'alert-info');
                $this->redirect('this');
            }
        );
    }
}
