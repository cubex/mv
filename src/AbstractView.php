<?php
namespace Cubex\Mv;

abstract class AbstractView implements View
{
  protected ?Model $_model;

  public function __construct(?Model $data) { $this->_model = $data; }

  public function render(): string
  {
    return $this->produceSafeHTML()->getContent();
  }
}
