<?php

interface INotificator
{
  public function send(string $message): string;
}

class Message implements INotificator
{
  public function send(string $message): string
  {
    return  $message;
  }
}

abstract class Decorator implements INotificator
{
  protected $notificator = null;

  public function __construct(INotificator $notificator)
  {
    $this->notificator = $notificator;
  }
}

class Sms extends Decorator
{
  public function send(string $message): string
  {
    echo 'Отправка по sms ' . $message . PHP_EOL;
    return $this->notificator->send($message);
  }
}

class Facebook extends Decorator
{
  public function send(string $message): string
  {
    echo 'Отправка по facebook' . $message . PHP_EOL;
    return $this->notificator->send($message);
  }
}

class Slack extends Decorator
{
  public function send(string $message): string
  {
    echo 'Отправка по slack' . $message . PHP_EOL;
    return $this->notificator->send($message);
  }
}

function testDecorator(string $text)
{
  $messageSend =
    new Sms(
      new Facebook (
        new Slack(
          new Message()
        )
      ));
  echo $messageSend->send($text);
}

testDecorator(' text 2');

