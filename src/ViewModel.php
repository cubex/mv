<?php
namespace Cubex\Mv;

use Packaged\Context\ContextAware;
use Packaged\Context\ContextAwareTrait;
use Packaged\Context\WithContextTrait;
use Packaged\Helpers\Objects;

class ViewModel implements Model, ContextAware
{
  protected string $_preferredView;

  use ContextAwareTrait;
  use WithContextTrait;

  public function jsonSerialize()
  {
    $values = Objects::propertyValues($this);
    return empty($values) ? $this : $values;
  }

  public function setPreferredView(string $viewClass)
  {
    $this->_preferredView = $viewClass;
    return $this;
  }

  public function createView(string $viewClass = null)
  {
    if($viewClass === null && !empty($this->_preferredView))
    {
      $viewClass = $this->_preferredView;
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
