<?php
namespace Cubex\Mv;

use Packaged\Context\ContextAware;
use Packaged\Context\ContextAwareTrait;

abstract class AbstractView implements View, ContextAware
{
  use ContextAwareTrait;

  protected ?Model $_model;

  public function __construct(?Model $data) { $this->_model = $data; }

  public function render(): string
  {
    return $this->produceSafeHTML()->getContent();
  }
}
