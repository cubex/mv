<?php
namespace Cubex\Mv;

use Packaged\SafeHtml\ISafeHtmlProducer;
use Packaged\Ui\Renderable;

/**
 * A view must be constructed with a model
 */
interface View extends ISafeHtmlProducer, Renderable
{
  public function __construct(?Model $data);
}
