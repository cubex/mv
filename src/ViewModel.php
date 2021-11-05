<?php
namespace Cubex\Mv;

use Packaged\Context\ContextAware;
use Packaged\Context\ContextAwareTrait;
use Packaged\Helpers\Objects;

class ViewModel implements Model, ContextAware
{
  use ContextAwareTrait;

  public function jsonSerialize()
  {
    $values = Objects::propertyValues($this);
    return empty($values) ? $this : $values;
  }

  public function createView(string $viewClass)
  {
    if(!class_exists($viewClass))
    {
      throw new \Exception("Invalid view class provided '$viewClass'");
    }
    $view = new $viewClass($this);
    if($view instanceof ContextAware && $this->hasContext())
    {
      $view->setContext($this->getContext());
    }
    return $view;
  }
}
