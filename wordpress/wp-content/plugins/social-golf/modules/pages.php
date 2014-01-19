<?php
/**
 * Created by PhpStorm.
 * User: slangley
 * Date: 1/19/14
 * Time: 10:16 PM
 */

namespace social_golf\modules;

Pages::bootstrap();

final class Pages {

  private static $MENU_SLUG = 'social-golf-menu-slug';
  private static $ENTER_SCORES_MENU_SLUG = 'social-golf-enter-scores-menu-slug';
  private static $SHOW_HANDICAPS_MENU_SLUG = 'social-golf-show-handicaps';
  private static $SCHEDULE_GAME_SLUG = 'social-golf-schedule-game-slug';

  private static $ORGANIZER_CAP = 'can_organize_matches';
  private static $HANDICAP_CAP = 'can_manage_handicaps';

  public static function bootstrap() {
    add_action('social-golf-activation', __CLASS__ . '::plugin_activated');
    add_action('admin_menu', __CLASS__ . '::add_admin_pages');
  }

  public static function plugin_activated() {
    // Setup a new role for game organizers, add capabilities to editors.
    $role = add_role(
        'match_organizer',
        __('Match Organizer'),
        [
            'read' => true,
            self::$ORGANIZER_CAP => true,
            self::$HANDICAP_CAP => false,
        ]
    );

    foreach (['Editor', 'Administrator', 'Super Admin'] as $role_name) {
      $role = get_role($role_name);
      $role->add_cap(self::$ORGANIZER_CAP);
      $role->add_cap(self::$HANDICAP_CAP);
    }

    syslog(LOG_DEBUG, $role ? 'Created Role' : 'Create role failed.');
  }
  public static function add_admin_pages() {
    add_menu_page('Social Golf',
                  'Social Golf',
                  self::$ORGANIZER_CAP,
                  self::$MENU_SLUG,
                  __CLASS__ . '::display_menu_page',
                  '',
                  4.1);  // Position on the screen

    add_submenu_page(self::$MENU_SLUG,
                     'Enter Match Scores',
                     'Enter Match Scores',
                     self::$ORGANIZER_CAP,
                     self::$ENTER_SCORES_MENU_SLUG,
                     __CLASS__ . '::enter_scores_page');

    add_submenu_page(self::$MENU_SLUG,
                     'Show Member Handicaps',
                     'Show Member Handicaps',
                     self::$ORGANIZER_CAP,
                     self::$SHOW_HANDICAPS_MENU_SLUG,
                     __CLASS__ . '::show_handicaps');

    add_submenu_page(self::$MENU_SLUG,
                     'Scedhule Next game',
                     'Schedule Next game',
                     self::$ORGANIZER_CAP,
                     self::$SCHEDULE_GAME_SLUG,
                     __CLASS__ . '::scheudle_game');
  }

  public static function display_menu_page() {
    ?>
    <h3>Hello</h3>
    <?php
  }

  public static function enter_scores_page() {
    ?>
    <h3>Enter Scores Page</h3>
    <?php
  }

  public static function show_handicaps() {
    ?>
    <h3>Show Handicaps Page</h3>
    <?php
  }

  public static function schedule_game() {
    ?>
    <h3>Schedule Game Page</h3>
  <?php
  }
}