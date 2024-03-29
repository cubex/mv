<?php
namespace Cubex\Mv;

use Packaged\Context\ContextAware;
use Packaged\Context\ContextAwareTrait;
use Packaged\Context\WithContextTrait;
use Packaged\Helpers\Objects;

class ViewModel implements Model, ContextAware
{
  use ContextAwareTrait;
  use WithContextTrait;

  protected string $_defaultView;

  #[\ReturnTypeWillChange]
  public function jsonSerialize()
  {
    $values = Objects::propertyValues($this);
    return empty($values) ? $this : $values;
  }

  public function setDefaultView(string $viewClass)
  {
    $this->_defaultView = $viewClass;
    return $this;
  }

  public function createView(string $viewClass = null)
  {
    if($viewClass === null && !empty($this->_defaultView))
    {
      $viewClass = $this->_defaultView;
    }

    if($viewClass === '' || !class_exists($viewClass))
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
