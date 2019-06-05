<?php
/*
Template Name: Front
*/

get_header();

$user_meta = get_user_meta( get_current_user_id() );
$subscriptions = unserialize($user_meta['subscriptions'][0]);

?>

<form id="user-account">

  <div class="grid-container">
        <div class="grid-x grid-padding-x align-middle">
            <div class="cell auto">

                <h2>My Account</h2>

            </div>
            <div class="cell auto text-right">

                <img src="https://www.gravatar.com/avatar/<?= md5($user_meta['email'][0]); ?>?s=75" />

            </div>
        </div>

        <hr>

    <div class="grid-x grid-padding-x">
      <div class="medium-4 cell">

        <label>First Name*
          <input name="first_name" type="text" value="<?= $user_meta['first_name'][0]; ?>">
                </label>
                
      </div>
      <div class="medium-4 cell">

        <label>Last Name*
          <input name="last_name" type="text" value="<?= $user_meta['last_name'][0]; ?>">
                </label>
                
            </div>
            <div class="medium-4 cell">

        <label>Email
          <input name="email" type="email" value="<?= $user_meta['email'][0]; ?>">
                </label>
                
            </div>
            <div class="medium-6 cell">

        <label>Favorite Basketball Team
          <select name="favorite_basketball_team">
                        <option <?php selected( $user_meta['favorite_basketball_team'][0], 'Utah Jazz' ) ?>>Utah Jazz</option>
                        <option <?php selected($user_meta['favorite_basketball_team'][0], 'LA Lakers') ?>>LA Lakers</option>
                        <option <?php selected($user_meta['favorite_basketball_team'][0], 'Houston Rockets') ?>>Houston Rockets</option>
                        <option <?php selected($user_meta['favorite_basketball_team'][0], 'NY Knicks') ?>>NY Knicks</option>
                        <option <?php selected($user_meta['favorite_basketball_team'][0], 'Boston Celtics') ?>>Boston Celtics</option>
                    </select>
                </label>
                
            </div>
            <div class="medium-6 cell">

        <label>Favorite Ice Cream
          <select name="favorite_ice_cream">
                        <option <?php selected($user_meta['favorite_ice_cream'][0], 'Vanilla') ?>>Vanilla</option>
                        <option <?php selected($user_meta['favorite_ice_cream'][0], 'Chocolate') ?>>Chocolate</option>
                        <option <?php selected($user_meta['favorite_ice_cream'][0], 'Strawberry') ?>>Strawberry</option>
                        <option <?php selected($user_meta['favorite_ice_cream'][0], 'Sherbert') ?>>Sherbert</option>
                    </select>
                </label>
                
            </div>
            <fieldset class="medium-6 cell">
                <legend>Relationship Status</legend>
                
                <input 
                    <?php checked($user_meta['relationship_status'][0], 'Single') ?>
                    id="relationship-single"
                    type="radio"
                    name="relationship_status"
                    value="Single">
                    <label for="relationship-single">Single</label>

                <input
                <?php checked($user_meta['relationship_status'][0], 'Married') ?>
                id="relationship-married"
                type="radio"
                name="relationship_status"
                value="Married">
                    <label for="relationship-married">Married</label>

                <input
                <?php checked($user_meta['relationship_status'][0], 'Other') ?>
                id="relationship-other"
                type="radio"
                name="relationship_status"
                value="Other">
                    <label for="relationship-other">Other</label>

            </fieldset>
            <fieldset class="large-6 cell">
                <legend>Do you subscribe to any of these streaming services?</legend>

                <input
                <?php checked( in_array('Netflix', $subscriptions) ); ?>
                id="netflix"
                name="subscriptions[]"
                type="checkbox"
                value="Netflix">
                    <label for="netflix">Netflix</label>

                <input <?php checked(in_array('Hulu', $subscriptions)); ?> id="hulu" name="subscriptions[]" type="checkbox" value="Hulu">
                    <label for="hulu">Hulu</label>

                <input <?php checked(in_array('YouTube TV', $subscriptions)); ?> id="youtubetv" name="subscriptions[]" type="checkbox" value="YouTube TV">
                    <label for="youtubetv">YouTube TV</label>

                <input <?php checked(in_array('Sling', $subscriptions)); ?> id="sling" name="subscriptions[]" type="checkbox" value="Sling">
                    <label for="sling">Sling</label>

            </fieldset>
        </div>

        <hr>

        <div class="grid-x grid-padding-x">
            <div class="large-6 cell">

                <div class="callout success hide">
                    <h5>Hooray!</h5>
                    <p>Your information was saved successfully.</p>
                </div>

                <div class="callout alert hide">
                    <h5>Error!</h5>
                    <p></p>
                </div>

            </div>
            <div class="large-6 text-right cell">

                <button class="button primary" type="submit">Save</button>

            </div>
        </div>
    </div>

</form>

<?php get_footer();
