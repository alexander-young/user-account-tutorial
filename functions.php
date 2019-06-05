<?php

add_action('wp_ajax_user_account_save', 'user_account_save');
function user_account_save(){
  
  $fillable = [
    'first_name',
    'last_name',
    'email',
    'favorite_basketball_team',
    'favorite_ice_cream',
    'relationship_status',
    'subscriptions'
  ];

  $required = [
    'first_name',
    'last_name'
  ];

  $missing_fields = [];
  foreach( $required as $required_key ){
    if( empty( $_POST[$required_key] ) ){
      $missing_fields[] = ucwords( str_replace('_', ' ', $required_key) );
    }
  }

  if( ! empty($missing_fields) ){
    $message = '';
    foreach( $missing_fields as $missing_field ){
      $message .= '<strong>' . $missing_field . '</strong> is a required field. Please Fix. <br>';
    }
    wp_send_json_error($message);
  }

  $ready_for_save = [];
  foreach( $fillable as $key ){

    if( is_array( $_POST[$key] ) && ! empty( $_POST[$key] ) ){

      $sanitized_items = [];

      foreach( $_POST[$key] as $item ){
        $sanitized_items[] = sanitize_text_field($item);
      }

      $ready_for_save[$key] = $sanitized_items;

    } else {

      if( $key === 'email' ){

        $ready_for_save[$key] = sanitize_email($_POST[$key]);

      } else if( $key === 'favorite_basketball_team' ){

        // sanitize_user_meta_favorite_basketball_team
        $sanitized_basketball_team = sanitize_meta($key, $_POST[$key], 'user');

        if( ! $sanitized_basketball_team ){
          wp_send_json_error('Something went wrong with updating your favorite basketball team! Please try again later.');
        }

        $ready_for_save[$key] = $sanitized_basketball_team;

      } else {

        if( ! empty( $_POST[$key] ) ){
          $ready_for_save[$key] = sanitize_text_field($_POST[$key]);
        }

      }



    }


  }

  foreach( $ready_for_save as $meta_key => $meta_value ){
    update_user_meta( get_current_user_id(), $meta_key, $meta_value );
  }

  wp_send_json_success($ready_for_save);


}

add_filter('sanitize_user_meta_favorite_basketball_team', function( $basketball_team ){
    return ( in_array( $basketball_team, get_all_basketball_teams() ) ) ? $basketball_team : false;
});

function get_all_basketball_teams(){
  return [
    'Utah Jazz',
    'LA Lakers',
    'Houston Rockets',
    'NY Knicks',
    'Boston Celtics',
  ];
}