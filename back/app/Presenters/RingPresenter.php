<?php

namespace App\Presenters;

use App\Model\Form\RingFormFactory;
use App\Model\Repository\HourRepository;
use Nette\Application\Responses\FileResponse;
use Nette\Application\UI\Form;
use Nette\Utils\FileSystem;

class RingPresenter extends BasePresenter
{
    public function __construct(
        private HourRepository $hourRepository,
        private RingFormFactory $ringFormFactory,
    )
    {
    }

    public function beforeRender()
    {
        parent::beforeRender();
        $this->template->page = "ring";
    }
    public function actionPlay($id){
        $song = $this->hourRepository->getByHourId($id);
        $song = $song->ref('song', 'song_id');
        $response = new FileResponse($song->url, "Zovnenie.mp3", 'audio/mpeg', false);
        $this->sendResponse($response);
    }


    protected function createComponentEditRingForm(): Form
    {
        return $this->ringFormFactory->create(
            function (): void {
                $this->flashMessage('Zvonenie úspešne upravené', 'alert-success');
                $this->redirect('Ring:', );
            },
        );
    }
}