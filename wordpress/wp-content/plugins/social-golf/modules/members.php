<?php
/**
 * Created by PhpStorm.
 * User: slangley
 * Date: 1/19/14
 * Time: 1:49 PM
 */

namespace social_golf\modules;

Members::bootstrap();

final class Members {
  public static function bootstrap() {
    // Actions
    add_action('social-golf-activation', __CLASS__. '::on_activation');
    add_action('user_register', __CLASS__ . '::user_registered');
    add_action('edit_user_profile', __CLASS__ . '::add_user_meta_fields');
    add_action('show_user_profile', __CLASS__ . '::add_user_meta_fields');
    // Registration form hooks
    add_action('register_form' , __CLASS__ . '::register_form');
    add_filter('registration_errors', __CLASS__ . '::registration_errors', 10, 3);
    add_action('user_register', __CLASS__ . '::user_register');

    // Additional Profile Fields
    add_action('personal_options_update', __CLASS__ . '::save_extra_profile_fields');
    add_action('edit_user_profile_update', __CLASS__ . '::save_extra_profile_fields');
    // Filters
    add_filter('user_contactmethods', __CLASS__ . '::add_userfields');
  }

  public static function on_activation() {

  }

  public static function register_form() {
    $member_id = isset($_POST['member_id']) ? $_POST['member_id'] : '';
    ?>
    <p>
      <label for="member_id"><?php _e('Member Number','social-golf') ?><br />
        <input type="text"
               name="member_id"
               id="member_id"
               class="input"
               value="<?php echo esc_attr(stripslashes($member_id)); ?>"
               size="5" />
      </label>
    </p>
    <?php
  }

  public static function registration_errors($errors, $sanitized_user_login, $user_email) {
    if (empty($_POST['member_id'])) {
      $errors->add('member_id_error',
                   __('<strong>ERROR</strong> You must include a member id', 'social-golf'));
    }
    return $errors;
  }

  public static function user_register($user_id) {
    if (isset($_POST['member_id'])) {
      update_user_meta($user_id, 'member_id', $_POST['member_id']);
    }
  }

  public static function user_registered($user_id) {

  }

  public static function add_user_meta_fields($user) {
    ?>
      <h3>Social Golf Member Info</h3>
    <?php
  }

  public static function save_extra_profile_fields($user_id) {
    if (!current_user_can('edit_user', $user_id)) {
      return false;
    }
    // Update the additional user metadata here.
    update_user_meta($user_id, 'golf_link_number', '');
  }

  public static function add_userfields($user_contact) {
    $user_contact['sjl'] = __('SJL');
    return $user_contact;
  }
}
