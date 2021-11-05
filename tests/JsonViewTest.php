<?php
namespace Cubex\Mv\Tests;

use Cubex\Mv\ArrayModel;
use Cubex\Mv\JsonView;
use Cubex\Mv\Model;
use Cubex\Mv\ViewModel;
use PHPUnit\Framework\TestCase;

class JsonViewTest extends TestCase
{
  /**
   * @dataProvider viewResults
   */
  public function testResults($testName, $model, $flags, $expect)
  {
    $view = new JsonView($model);
    if(is_int($flags))
    {
      $view->setFlags($flags);
    }
    self::assertEquals($expect, $view->render(), $testName . " - Render");
    self::assertEquals($expect, $view->produceSafeHTML()->getContent(), $testName . " - SafeHtml");
  }

  public function viewResults()
  {
    return [
      ["Null Check", null, null, "null"],
      ["Simple Json", new JsonViewTestData(), 0, '{"a":"b"}'],
      ["Empty", new ViewModel(), 0, '{}'],
      ["Array", $this->_arrayModel(), 0, '["a","b","c"]'],
    ];
  }

  protected function _arrayModel()
  {
    $model = new ArrayModel();
    $model->addItem("a");
    $model->addItem("b");
    $model->addItem("c");
    return $model;
  }
}

class JsonViewTestData implements Model
{
  public function jsonSerialize()
  {
    return ["a" => "b"];
  }
}
