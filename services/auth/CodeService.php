<?php


namespace app\services\auth;


use app\components\CodeGenerator;
use app\components\MessageInterface;
use app\models\auth\AuthByPhoneForm;

class CodeService
{
    private CodeSaver $codeSaver;
    private AuthByPhoneForm $form;
    private MessageInterface $message;
    private CodeGenerator $codeGenerator;

    public function __construct(
        CodeSaver $codeSaver,
        AuthByPhoneForm $form,
        MessageInterface $message,
        CodeGenerator $codeGenerator
    ) {
        $this->codeSaver = $codeSaver;
        $this->form = $form;
        $this->message = $message;
        $this->codeGenerator = $codeGenerator;
    }

    public function run(): void
    {
        $code = $this->codeGenerator->generate();
        $this->form->code = $code;
        $this->codeSaver->saveByAuthForm($this->form);
        $this->message->send($code);
    }
}