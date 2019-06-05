import axios from 'axios';

document.addEventListener('DOMContentLoaded', () => {

  const user_account_form = document.getElementById('user-account');

  if( user_account_form.length > 0 ){

    const success_callout = document.querySelector('.callout.success');
    const alert_callout = document.querySelector('.callout.alert');
    const submit_button = document.querySelector('[type="submit"]');

    user_account_form.addEventListener("submit", (e) => {

      alert_callout.classList.add('hide');
      success_callout.classList.add('hide');
      submit_button.classList.add('disabled');

      // do something
      e.preventDefault();

      const form_data = new FormData(user_account_form);
      form_data.append('action', 'user_account_save');

      axios.post('http://useraccount.local/wp-admin/admin-ajax.php', form_data).then( response => {
        console.log({response});

        submit_button.classList.remove('disabled');

        if( response.data.success ){
          success_callout.classList.remove('hide');
        } else {
          document.querySelector('.callout.alert p').innerHTML = response.data.data;
          alert_callout.classList.remove('hide');
        }
        // trigger success messages
        // trigger fail messages
      } );

      

    });

  }


});