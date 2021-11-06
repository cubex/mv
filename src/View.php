<?php
namespace Cubex\Mv;

use Packaged\Ui\Renderable;

/**
 * A view must be constructed with a model
 */
interface View extends Renderable
{
  public function __construct(?Model $data);
}
