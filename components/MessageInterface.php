<?php


namespace app\components;


interface MessageInterface
{
    public function send(string $message): void;
}