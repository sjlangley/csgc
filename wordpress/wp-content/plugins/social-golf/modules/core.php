<?php
/**
 * Created by PhpStorm.
 * User: slangley
 * Date: 1/19/14
 * Time: 1:37 PM
 */

namespace social_golf\modules;

Core::bootstrap();

final class Core {
  public static function bootstrap() {
    add_action('social-golf-activation', __CLASS__. '::on_activation');
  }

  public static function on_activation() {

  }
}
