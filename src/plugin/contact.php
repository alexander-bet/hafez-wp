<?php
class hafez_WP_Mail_From
{
	protected $name;

	protected $email;

	public function __construct($name = '', $email = '')
	{
		$this->setEmail($email)->setName($name);
	}

	public function setEmail($value)
	{
		$this->email = $value;
		return $this;
	}

	public function setName($value)
	{
		$this->name = $value;
		return $this;
	}

	public function filterEmailFrom($content_type)
	{
		return $this->email;
	}

	public function filterNameFrom($name)
	{
		return $this->name;
	}

	public function addFilters()
	{
		add_filter('wp_mail_from', array($this, 'filterEmailFrom'));
		add_filter('wp_mail_from_name', array($this, 'filterNameFrom'));

		return $this;
	}
}
$hafez_mail_from = new hafez_WP_Mail_From();

/**
 * Send Contact Message
 * 
 * @param array $data
 * @return mixed
 * @throws Exception 
 */
function hafez_send_contact($data)
{
	$return = true;

	try {

		if (!wp_verify_nonce($_REQUEST['_wpnonce'])) {
			throw new Exception(esc_html__('Something went wrong. Please refresh the page and try again.', 'hafez'));
		}

		foreach ($data as $k => $val) {
			$data[$k] = wp_filter_nohtml_kses(trim($val));
		}

		if (!$data['name']) {
			throw new Exception(esc_html__('Please enter your name.', 'hafez'));
		}

		if (!is_email($data['email'])) {
			throw new Exception(esc_html__('Please enter a valid email address.', 'hafez'));
		}
		if (!$data['message']) {
			throw new Exception(esc_html__('Please enter your message.', 'hafez'));
		}

		do_action('hafez_contact_form_send', $data);

		$redirectUrl = get_permalink();
		$redirectUrl = substr_count($redirectUrl, '?') ? '&success' : '?success';
		wp_redirect($redirectUrl);
		exit;
	} catch (Exception $e) {
		$return = array(
			'error' => 1,
			'msg'   => $e->getMessage(),
		);
	}

	return $return;
}


/**
 * Send Contact Form Email
 * 
 * @param array $data 
 */
function hafez_contact_email_send($data)
{
	global $hafez_mail_from;
	try {
		$subject = esc_html__('New contact message from ', 'hafez') . get_bloginfo('name');
		$admin_email = get_option('admin_email');
		$message_label = esc_html__('Message', 'hafez');
		$email_label = esc_html__('Email', 'hafez');
		$phone_label = esc_html__('Phone', 'hafez');
		$name_lable = esc_html__('Name', 'hafez');
		$sent_from = esc_html__('Sent from', 'hafez') . get_bloginfo('name');

		if ($data['subject']) {
			$subject = $data['subject'];
		}
		if ($data['receive']) {
			$admin_email = $data['receive'];
		}

		$body = "
			{$name_lable}: {$data['name']}

			{$email_label}: {$data['email']}

			{$phone_label}: {$data['phone']}

			{$message_label}: {$data['message']}

			------------

			{$sent_from}
		";

		$hafez_mail_from->setName($data['name'])->setEmail($data['email'])->addFilters();

		wp_mail($admin_email, $subject, $body);
	} catch (Exception $e) {
	}
}
add_action('hafez_contact_form_send', 'hafez_contact_email_send');
