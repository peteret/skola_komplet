<?php

namespace App\Model\Form;

use App\Model\Repository\UploadRepository;
use Nette\Application\UI\Form;
use Nette\Utils\Strings;

class UploadFormFactory
{
    public function __construct(
        private FormFactory $factory,
        private UploadRepository $uploadRepository,
    ) {
    }

    public function create(callable $onSuccess): Form
    {
        $form = $this->factory->create();
        $form->addText('name')
            ->setRequired('Názov súboru je povinné pole.');

        $form->addUpload('file')
            ->setRequired('Súbor je povinné nahrať.');


        $form->addSubmit('submit', 'submit');

        $form->onSuccess[] = function (Form $form, \stdClass $values) use ($onSuccess): void {
            $url = "";
            if ($values->file != null) {
                if (filesize($values->file) > 0 && $values->file->isOk()) {
                    $file = $values->file;
                    $url = 'assets/upload/' . date('Y-m-d') . '-' . uniqid('upload') . '-' . Strings::webalize($values->name) . '-' .$values->file->name;
                    $file->move($url);
                }
            }
            $this->uploadRepository->insert(['name' => $values->name, 'url' => $url]);
            $onSuccess($url);
        };

        return $form;
    }
}
