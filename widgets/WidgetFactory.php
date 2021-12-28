<?php


namespace app\widgets;


use yii\base\Widget;

class WidgetFactory
{
    private string $className;
    private array $config;

    public function __construct(string $className, array $config = [])
    {
        $this->className = $className;
        $this->config = $config;
    }

    public function build(): string
    {
        /** @var Widget $widgetClass */
        $widgetClass = $this->className;
        return $widgetClass::widget($this->config);
    }
}