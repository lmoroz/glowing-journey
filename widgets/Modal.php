<?php


namespace app\widgets;


use yii\base\Widget;

class Modal extends Widget
{
    public string $idElement;
    public string $title;
    public WidgetFactory $content;

    public function run(): string
    {
        return $this->render('modal', [
            'idElement' => $this->idElement,
            'title' => $this->title,
            'content' => $this->content,
        ]);
    }
}