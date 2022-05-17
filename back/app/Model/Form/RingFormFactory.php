<?php

namespace App\Model\Form;

use App\Model\Repository\HourRepository;
use App\Model\Repository\UploadRepository;
use Nette\Application\UI\Form;
use Nette\Database\Table\ActiveRow;

class RingFormFactory
{
    public function __construct(
        private FormFactory $factory,
        private UploadRepository $uploadRepository,
        private HourRepository $hourRepository,
    )
    {
    }

    public function create(callable $onSuccess): Form
    {
        $actual = $this->hourRepository->getList();
        $form = $this->factory->create();

        $form->addSelect('hour1')
            ->setItems($this->uploadRepository->fetchPairs())
            ->setDefaultValue($actual["999"] ?? null);
        $form->addSelect('hour1k')
            ->setItems($this->uploadRepository->fetchPairs())
            ->setDefaultValue($actual["1"] ?? null);
        $form->addSelect('hour2')
            ->setItems($this->uploadRepository->fetchPairs())
            ->setDefaultValue($actual["2"] ?? null);
        $form->addSelect('hour2k')
            ->setItems($this->uploadRepository->fetchPairs())
            ->setDefaultValue($actual["3"] ?? null);
        $form->addSelect('hour3')
            ->setItems($this->uploadRepository->fetchPairs())
            ->setDefaultValue($actual["4"] ?? null);
        $form->addSelect('hour3k')
            ->setItems($this->uploadRepository->fetchPairs())
            ->setDefaultValue($actual["5"] ?? null);
        $form->addSelect('hour4')
            ->setItems($this->uploadRepository->fetchPairs())
            ->setDefaultValue($actual["6"] ?? null);
        $form->addSelect('hour4k')
            ->setItems($this->uploadRepository->fetchPairs())
            ->setDefaultValue($actual["7"] ?? null);
        $form->addSelect('hour5')
            ->setItems($this->uploadRepository->fetchPairs())
            ->setDefaultValue($actual["8"] ?? null);
        $form->addSelect('hour5k')
            ->setItems($this->uploadRepository->fetchPairs())
            ->setDefaultValue($actual["9"] ?? null);
        $form->addSelect('hour6')
            ->setItems($this->uploadRepository->fetchPairs())
            ->setDefaultValue($actual["10"] ?? null);
        $form->addSelect('hour6k')
            ->setItems($this->uploadRepository->fetchPairs())
            ->setDefaultValue($actual["11"] ?? null);
        $form->addSelect('hour7')
            ->setItems($this->uploadRepository->fetchPairs())
            ->setDefaultValue($actual["12"] ?? null);
        $form->addSelect('hour7k')
            ->setItems($this->uploadRepository->fetchPairs())
            ->setDefaultValue($actual["13"] ?? null);
        $form->addSelect('hour8')
            ->setItems($this->uploadRepository->fetchPairs())
            ->setDefaultValue($actual["14"] ?? null);
        $form->addSelect('hour8k')
            ->setItems($this->uploadRepository->fetchPairs())
            ->setDefaultValue($actual["15"] ?? null);



        $form->addSubmit('submit', 'submit');

        $form->onSuccess[] = function (Form $form, \stdClass $values) use ($onSuccess, $actual): void {
            if ($actual == null) {
                $a = "a;";
            } else {
                bdump($values);
                $this->hourRepository->updateSong("999", $values->hour1);
                $this->hourRepository->updateSong("1", $values->hour1k);
                $this->hourRepository->updateSong("2", $values->hour2);
                $this->hourRepository->updateSong("3", $values->hour2k);
                $this->hourRepository->updateSong("4", $values->hour3);
                $this->hourRepository->updateSong("5", $values->hour3k);
                $this->hourRepository->updateSong("6", $values->hour4);
                $this->hourRepository->updateSong("7", $values->hour4k);
                $this->hourRepository->updateSong("8", $values->hour5);
                $this->hourRepository->updateSong("9", $values->hour5k);
                $this->hourRepository->updateSong("10", $values->hour6);
                $this->hourRepository->updateSong("11", $values->hour6k);
                $this->hourRepository->updateSong("12", $values->hour7);
                $this->hourRepository->updateSong("13", $values->hour7k);
                $this->hourRepository->updateSong("14", $values->hour8);
                $this->hourRepository->updateSong("15", $values->hour8k);
                $onSuccess("1");
            }
        };

        return $form;
    }
}