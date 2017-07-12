<?php

/**
 * @file
 * Default theme implementation to present all user profile data.
 *
 * This template is used when viewing a registered member's profile page,
 * e.g., example.com/user/123. 123 being the users ID.
 *
 * Use render($user_profile) to print all profile items, or print a subset
 * such as render($user_profile['user_picture']). Always call
 * render($user_profile) at the end in order to print all remaining items. If
 * the item is a category, it will contain all its profile items. By default,
 * $user_profile['summary'] is provided, which contains data on the user's
 * history. Other data can be included by modules. $user_profile['user_picture']
 * is available for showing the account picture.
 *
 * Available variables:
 *   - $user_profile: An array of profile items. Use render() to print them.
 *   - Field variables: for each field instance attached to the user a
 *     corresponding variable is defined; e.g., $account->field_example has a
 *     variable $field_example defined. When needing to access a field's raw
 *     values, developers/themers are strongly encouraged to use these
 *     variables. Otherwise they will have to explicitly specify the desired
 *     field language, e.g. $account->field_example['en'], thus overriding any
 *     language negotiation rule that was previously applied.
 *
 * @see user-profile-category.tpl.php
 *   Where the html is handled for the group.
 * @see user-profile-item.tpl.php
 *   Where the html is handled for each item in the group.
 * @see template_preprocess_user_profile()
 *
 * @ingroup themeable
 */
?>
<div class="profile"<?php print $attributes; ?>>

<?php
global $user;

if (!isset($account)) {
  $account = $user;
}
?>

<h3>Account Information</h3>
<section id="acount-Information">
    <?php
         $account = $GLOBALS['user'];
         $username = $account->name;
        if (module_exists('commerce_addressbook')) {
            $billing_profile_id = commerce_addressbook_get_default_profile_id($account->uid, 'billing');
            if ($billing_profile_id) {
              $billing_profile = commerce_customer_profile_load($billing_profile_id);
              $username = $billing_profile->commerce_customer_address[LANGUAGE_NONE][0]['name_line'];
            }
        }
    ?>
    <?php
        if (module_exists('commerce_addressbook')) {
            $shipping_profile_id = $billing_profile_id = NULL;
            // Customer Profile
            print '<div id="customer-profile"><h6>Customer Profile</h6><p>' . $username .'<br>'. $account->mail . '</p>' . l(t('Edit'), 'user/' . $account->uid . '/edit', array('attributes'=>array('class'=>'action-button'))) .'</div>';
            // Shipping Details
            if (commerce_addressbook_profile_page_access($account, 'shipping')) {
                $shipping_profile_id = commerce_addressbook_get_default_profile_id($account->uid, 'shipping');
                if ($shipping_profile_id) {
                    $shipping_profile = commerce_customer_profile_load($shipping_profile_id);
                    $shipping_profile_render = entity_view('commerce_customer_profile', array($shipping_profile), 'full');
                    $shipping_profile_render = reset($shipping_profile_render);
                    $shipping_profile_output = drupal_render($shipping_profile_render);
                }
                else {
                    $shipping_profile_output = '<p>' . t('No default shipping profile') . '</p>';
                }
                print '<div id="shipping-address"><h6>Shipping Address</h6>' . $shipping_profile_output . l(t('Edit'), 'user/' . $account->uid . '/addressbook/shipping', array('attributes'=>array('class'=>'action-button'))). '</div>';
            }
            // Billing Info
            if (commerce_addressbook_profile_page_access($account, 'billing')) {
                $billing_profile_id = commerce_addressbook_get_default_profile_id($account->uid, 'billing');
                if ($billing_profile_id) {
                  $billing_profile = commerce_customer_profile_load($billing_profile_id);
                  $billing_profile_render = entity_view('commerce_customer_profile', array($billing_profile), 'full');
                  $billing_profile_render = reset($billing_profile_render);
                  $billing_profile_output = drupal_render($billing_profile_render);
                }
                else {
                  $billing_profile_output = '<p>' . t('No default billing profile') . '</p>';
                }
                print '<div id="billing-address"><h6>Billing Address</h6>' . $shipping_profile_output . l(t('Edit'), 'user/' . $account->uid . '/addressbook/billing', array('attributes'=>array('class'=>'action-button'))). '</div>';
            }
        } 
    ?>
</section>

<div class="recent-orders">
<h3>Order History</h3>
<?php print views_embed_view('commerce_backoffice_user_orders', 'block_1', $account->uid); ?>
</div>

 <?php //print render($user_profile); ?>
</div>
<?php
	// print kpr($user_profile);
	// print kpr($account);
?>