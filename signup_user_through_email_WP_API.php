//------- Add this functions.php

add_action('rest_api_init', 'register_custom_endpoint');

function register_custom_endpoint() {
    register_rest_route('my-custom-endpoint/v1', '/register', array(
        'methods'  => 'POST',
        'callback' => 'process_registration_request',
    ));
}

function process_registration_request(WP_REST_Request $request) {
    // Handle the form submission logic here
    $email = $request->get_param('email');


	$user_exists = email_exists($email);

	if (!$user_exists) {
		// Register the user as a Subscriber
		$user_id = wp_create_user($email, wp_generate_password(), $email);
		wp_update_user(array('ID' => $user_id, 'role' => 'subscriber'));

		// Send the default password reset email
		wp_new_user_notification($user_id, null, 'user');
	
		// Return a response if needed
	    $response = 'Registration successful';
	}else{
		$response = 'User already exists';
	}

	return new WP_REST_Response($response, 200);

}




//---------- Add this on front-end to call above API
<form id="registration-form" action="" method="POST">
  <input type="email" name="email" placeholder="Enter your email" required>
  <button type="button" id="submit-button">Sign UP Now</button>
  <div id="success-message" style="display: none;"></div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  jQuery(document).ready(function($) {
    var registrationForm = $('#registration-form');
    var successMessage = $('#success-message');
    var submitButton = $('#submit-button');

    submitButton.on('click', function() {
      var formData = registrationForm.serialize();

      $.ajax({
        type: 'POST',
        url: 'https://www.savingspree.com.au/wp-json/my-custom-endpoint/v1/register', // Replace 'your-endpoint-url' with the actual URL to process the form submission
        data: formData,
        success: function(response) {
          // Display success message
          successMessage.css('display', 'block');
          successMessage.text('Registration successful, please check your email to set the passowrd!');

          // Reset the form
          registrationForm[0].reset();
        },
        error: function(jqXHR, textStatus, errorThrown) {
          // Handle error if needed
          //console.error('Registration failed. Please try again.');
          successMessage.css('display', 'block');
          successMessage.text('Error occured, email already exists!');
        }
      });
    });
  });
</script>




