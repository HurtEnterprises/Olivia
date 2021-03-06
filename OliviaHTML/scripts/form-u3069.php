<?php 
/* 	
If you see this text in your browser, PHP is not configured correctly on this hosting provider. 
Contact your hosting provider regarding PHP configuration for your site.

PHP file generated by Adobe Muse CC 2018.0.0.379
*/

require_once('form_process.php');

$form = array(
	'subject' => 'Question Template Form Submission',
	'heading' => 'New Form Submission',
	'success_redirect' => '',
	'resources' => array(
		'checkbox_checked' => 'Checked',
		'checkbox_unchecked' => 'Unchecked',
		'submitted_from' => 'Form submitted from website: %s',
		'submitted_by' => 'Visitor IP address: %s',
		'too_many_submissions' => 'Too many recent submissions from this IP',
		'failed_to_send_email' => 'Failed to send email',
		'invalid_reCAPTCHA_private_key' => 'Invalid reCAPTCHA private key.',
		'invalid_reCAPTCHA2_private_key' => 'Invalid reCAPTCHA 2.0 private key.',
		'invalid_reCAPTCHA2_server_response' => 'Invalid reCAPTCHA 2.0 server response.',
		'invalid_field_type' => 'Unknown field type \'%s\'.',
		'invalid_form_config' => 'Field \'%s\' has an invalid configuration.',
		'unknown_method' => 'Unknown server request method'
	),
	'email' => array(
		'from' => 'info@hurttechnologies.com',
		'to' => 'info@hurttechnologies.com'
	),
	'fields' => array(
		'custom_U3120' => array(
			'order' => 1,
			'type' => 'string',
			'label' => '1. I engage in moderate physical activity outside of work for at least 20-30 minutes during the week',
			'required' => true,
			'errors' => array(
				'required' => 'Field \'1. I engage in moderate physical activity outside of work for at least 20-30 minutes during the week\' is required.'
			)
		),
		'custom_U3132' => array(
			'order' => 2,
			'type' => 'string',
			'label' => '2. My physical activity includes things like stretching, running, and lifting weights',
			'required' => true,
			'errors' => array(
				'required' => 'Field \'2. My physical activity includes things like stretching, running, and lifting weights\' is required.'
			)
		),
		'custom_U3144' => array(
			'order' => 3,
			'type' => 'string',
			'label' => '3. I try to vary how I travel to and from various locations  (such as stairs instead of  elevator,  biking or walking instead of driving)',
			'required' => true,
			'errors' => array(
				'required' => 'Field \'3. I try to vary how I travel to and from various locations  (such as stairs instead of  elevator,  biking or walking instead of driving)\' is required.'
			)
		),
		'custom_U3156' => array(
			'order' => 5,
			'type' => 'string',
			'label' => '4. I take the health benefits of physical activities and their lasting impact seriously',
			'required' => true,
			'errors' => array(
				'required' => 'Field \'4. I take the health benefits of physical activities and their lasting impact seriously\' is required.'
			)
		),
		'custom_U3168' => array(
			'order' => 4,
			'type' => 'string',
			'label' => '5. I enjoy seated activities (such as knitting, watching television) rather than physical activities',
			'required' => true,
			'errors' => array(
				'required' => 'Field \'5. I enjoy seated activities (such as knitting, watching television) rather than physical activities\' is required.'
			)
		)
	)
);

process_form($form);
?>
