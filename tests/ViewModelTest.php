<?php
namespace Cubex\Mv\Tests;

use Cubex\Mv\JsonView;
use Cubex\Mv\ViewModel;
use PHPUnit\Framework\TestCase;

class ViewModelTest extends TestCase
{
  public function testViewCreation()
  {
    $model = new ViewModel();
    $view = $model->createView(JsonView::class);
    self::assertInstanceOf(JsonView::class, $view);
  }

  public function testInvalidClassViewCreation()
  {
    self::expectExceptionMessage("Invalid view class provided 'NotAValidClass'");
    $model = new ViewModel();
    $model->createView("NotAValidClass");
  }
}
