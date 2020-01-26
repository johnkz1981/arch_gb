<?php

interface IArea
{
  public function getArea(int $diagonal): float;
}

interface ICircle
{
  function circleArea(int $circumference);
}

interface ISquare
{
  function squareArea(int $sideSquare);
}

class CircleAreaLib
{
  public function getCircleArea(int $diagonal)
  {
    $area = (M_PI * $diagonal ** 2) / 4;

    return $area;
  }
}

class SquareAreaLib
{
  public function getSquareArea(int $diagonal)
  {
    $area = ($diagonal**2)/2;

    return $area;
  }
}

class CircleAdapter implements ICircle, IArea
{
  private $circleAreaLib;
  public function __construct(CircleAreaLib $circleAreaLib)
  {
    $this->circleAreaLib = $circleAreaLib;
  }

  function circleArea(int $circumference)
  {
    return $this->circleAreaLib->getCircleArea($circumference);
  }

  public function getArea(int $diagonal): float
  {
    return $this->circleArea($diagonal);
  }
}

class SquareAdapter implements ISquare, IArea
{
  private $squareAreaLib;
  public function __construct(SquareAreaLib $squareAreaLib)
  {
    $this->squareAreaLib = $squareAreaLib;
  }

  function squareArea(int $sideSquare)
  {
    return $this->squareAreaLib->getSquareArea($sideSquare);
  }

  public function getArea(int $diagonal): float
  {
    return $this->squareArea($diagonal);
  }
}

function testAdapter(int $diagonal)
{
  $square = new SquareAdapter(new SquareAreaLib());
  print $square->getArea($diagonal) . PHP_EOL;

  $square = new CircleAdapter(new CircleAreaLib());
  print $square->getArea($diagonal);
}

testAdapter(5);