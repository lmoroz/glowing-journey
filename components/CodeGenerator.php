<?php


namespace app\components;


use Yii;
use yii\base\Component;

class CodeGenerator extends Component
{
    public bool $isFake = false;
    public string $fakeCode = '000000';

    public function generate(): string
    {
        if ($this->isFake) {
            return $this->fakeCode;
        }
        return random_int(100000, 999999);
    }

}