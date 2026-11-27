<?php
/**
 * Native theme enquiry form.
 *
 * @package Ovents
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const OVENTS_ENQUIRY_OPTION_THROTTLE = 'ovents_enquiry_last_submit';

/**
 * Budget range options.
 *
 * @return array<string, string>
 */
function ovents_enquiry_budget_choices() {
	return array(
		''        => 'Prefer not to say',
		'under15' => 'Under £15,000',
		'15-30'   => '£15,000 – £30,000',
		'30-60'   => '£30,000 – £60,000',
		'60plus'  => '£60,000+',
	);
}

/**
 * Handle POST before output.
 */
add_action(
	'template_redirect',
	function () {
		if ( 'POST' !== ( $_SERVER['REQUEST_METHOD'] ?? '' ) ) {
			return;
		}
		if ( empty( $_POST['ovents_enquiry_submit'] ) || ! is_page( 'contact' ) ) {
			return;
		}
		$result = ovents_process_enquiry_form();
		if ( is_wp_error( $result ) ) {
			$GLOBALS['ovents_enquiry_errors'] = $result;
			return;
		}
		wp_safe_redirect( add_query_arg( 'enquiry', 'thanks', wp_get_referer() ? wp_get_referer() : home_url( '/contact/' ) ) );
		exit;
	}
);

/**
 * @return true|WP_Error
 */
function ovents_process_enquiry_form() {
	if ( ! isset( $_POST['ovents_enquiry_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ovents_enquiry_nonce'] ) ), 'ovents_enquiry' ) ) {
		return new WP_Error( 'nonce', __( 'Your session expired. Please try again.', 'ovents' ) );
	}

	if ( ! empty( $_POST['ovents_website'] ) ) {
		return new WP_Error( 'spam', __( 'Unable to send your message.', 'ovents' ) );
	}

	$last = (int) get_transient( OVENTS_ENQUIRY_OPTION_THROTTLE . '_' . ovents_enquiry_client_key() );
	if ( $last && ( time() - $last ) < 60 ) {
		return new WP_Error( 'rate', __( 'Please wait a minute before sending another enquiry.', 'ovents' ) );
	}

	$fields = ovents_enquiry_sanitize_post();
	$errors = ovents_enquiry_validate( $fields );
	if ( $errors->has_errors() ) {
		return $errors;
	}

	$sent = ovents_enquiry_send_mail( $fields );
	if ( ! $sent ) {
		return new WP_Error( 'mail', __( 'We could not send your message. Please email info@ovents.co.uk or call +44 7447 462409.', 'ovents' ) );
	}

	set_transient( OVENTS_ENQUIRY_OPTION_THROTTLE . '_' . ovents_enquiry_client_key(), time(), 300 );

	return true;
}

/**
 * @return string
 */
function ovents_enquiry_client_key() {
	$ip = isset( $_SERVER['REMOTE_ADDR'] ) ? (string) $_SERVER['REMOTE_ADDR'] : 'unknown';
	return md5( $ip );
}

/**
 * @return array<string, string>
 */
function ovents_enquiry_sanitize_post() {
	$raw = wp_unslash( $_POST );
	return array(
		'first_name'   => isset( $raw['ovents_first_name'] ) ? sanitize_text_field( $raw['ovents_first_name'] ) : '',
		'last_name'    => isset( $raw['ovents_last_name'] ) ? sanitize_text_field( $raw['ovents_last_name'] ) : '',
		'email'        => isset( $raw['ovents_email'] ) ? sanitize_email( $raw['ovents_email'] ) : '',
		'phone'        => isset( $raw['ovents_phone'] ) ? sanitize_text_field( $raw['ovents_phone'] ) : '',
		'event_type'   => isset( $raw['ovents_event_type'] ) ? sanitize_text_field( $raw['ovents_event_type'] ) : '',
		'event_date'   => isset( $raw['ovents_event_date'] ) ? sanitize_text_field( $raw['ovents_event_date'] ) : '',
		'location'     => isset( $raw['ovents_location'] ) ? sanitize_text_field( $raw['ovents_location'] ) : '',
		'guests'       => isset( $raw['ovents_guests'] ) ? sanitize_text_field( $raw['ovents_guests'] ) : '',
		'budget'       => isset( $raw['ovents_budget'] ) ? sanitize_text_field( $raw['ovents_budget'] ) : '',
		'message'      => isset( $raw['ovents_message'] ) ? sanitize_textarea_field( $raw['ovents_message'] ) : '',
		'consent'      => ! empty( $raw['ovents_consent'] ) ? '1' : '',
	);
}

/**
 * @param array<string, string> $fields Fields.
 * @return WP_Error
 */
function ovents_enquiry_validate( $fields ) {
	$err = new WP_Error();
	if ( '' === $fields['first_name'] ) {
		$err->add( 'first_name', __( 'Please enter your first name.', 'ovents' ) );
	}
	if ( '' === $fields['last_name'] ) {
		$err->add( 'last_name', __( 'Please enter your last name.', 'ovents' ) );
	}
	if ( '' === $fields['email'] || ! is_email( $fields['email'] ) ) {
		$err->add( 'email', __( 'Please enter a valid email address.', 'ovents' ) );
	}
	if ( '' === $fields['event_type'] ) {
		$err->add( 'event_type', __( 'Please choose an event type.', 'ovents' ) );
	}
	if ( '' === $fields['message'] ) {
		$err->add( 'message', __( 'Please tell us about your event.', 'ovents' ) );
	}
	if ( '' === $fields['consent'] ) {
		$err->add( 'consent', __( 'Please confirm you agree to our privacy policy.', 'ovents' ) );
	}
	return $err;
}

/**
 * @param array<string, string> $fields Fields.
 */
function ovents_enquiry_send_mail( $fields ) {
	$budget_labels = ovents_enquiry_budget_choices();
	$budget        = isset( $budget_labels[ $fields['budget'] ] ) ? $budget_labels[ $fields['budget'] ] : $fields['budget'];

	$body = "New website enquiry\n\n";
	foreach (
		array(
			'Name'        => $fields['first_name'] . ' ' . $fields['last_name'],
			'Email'       => $fields['email'],
			'Phone'       => $fields['phone'],
			'Event type'  => $fields['event_type'],
			'Event date'  => $fields['event_date'],
			'Location'    => $fields['location'],
			'Guests'      => $fields['guests'],
			'Budget'      => $budget,
			'Message'     => $fields['message'],
		) as $label => $value
	) {
		$body .= $label . ': ' . $value . "\n";
	}

	$headers = array(
		'Content-Type: text/plain; charset=UTF-8',
		'Reply-To: ' . $fields['first_name'] . ' ' . $fields['last_name'] . ' <' . $fields['email'] . '>',
	);

	return wp_mail( 'info@ovents.co.uk', 'Website enquiry from ' . $fields['first_name'] . ' ' . $fields['last_name'], $body, $headers );
}

/**
 * Set From address and name for enquiry emails.
 */
add_filter( 'wp_mail_from', function( $from_email ) {
	if ( ! is_email( $from_email ) ) {
		return 'info@ovents.co.uk';
	}
	return 'info@ovents.co.uk';
}, 10 );

add_filter( 'wp_mail_from_name', function( $from_name ) {
	return 'Ovents';
}, 10 );

/**
 * Render enquiry form markup.
 */
function ovents_render_enquiry_form() {
	if ( isset( $_GET['enquiry'] ) && 'thanks' === $_GET['enquiry'] ) {
		?>
		<div class="enquiry-thanks" role="status" tabindex="-1" id="enquiry-thanks">
			<p class="enquiry-thanks__title"><?php esc_html_e( 'Thank you for your enquiry', 'ovents' ); ?></p>
			<p><?php esc_html_e( 'We have received your message and will reply within one to two business days.', 'ovents' ); ?></p>
		</div>
		<?php
		return;
	}

	$values = ovents_enquiry_sanitize_post();
	if ( empty( $values['first_name'] ) && 'POST' === ( $_SERVER['REQUEST_METHOD'] ?? '' ) ) {
		$values = ovents_enquiry_sanitize_post();
	} elseif ( empty( $values['first_name'] ) ) {
		$values = array_fill_keys( array_keys( $values ), '' );
	}

	if ( '' === $values['event_type'] && isset( $_GET['type'] ) ) {
		$type = strtolower( sanitize_text_field( wp_unslash( (string) $_GET['type'] ) ) );
		if ( 'corporate' === $type ) {
			$values['event_type'] = 'Corporate';
		}
	}
	if ( '' === $values['message'] && isset( $_GET['package'] ) ) {
		$pkg     = sanitize_key( wp_unslash( (string) $_GET['package'] ) );
		$labels  = array(
			'full'          => __( 'Full package', 'ovents' ),
			'lite-planning' => __( 'Lite planning package', 'ovents' ),
			'day'           => __( 'Day coordination package', 'ovents' ),
		);
		if ( isset( $labels[ $pkg ] ) ) {
			/* translators: %s: package name */
			$values['message'] = sprintf( __( "I'd like to book a free discovery call about the %s.", 'ovents' ), $labels[ $pkg ] );
		}
	}

	/** @var WP_Error|null $errors */
	$errors     = isset( $GLOBALS['ovents_enquiry_errors'] ) ? $GLOBALS['ovents_enquiry_errors'] : null;
	$first_err  = ( $errors && $errors->has_errors() ) ? array_key_first( $errors->get_error_codes() ) : '';
	$privacy    = get_page_by_path( 'privacy-policy' );
	$privacy_url = $privacy ? get_permalink( $privacy ) : home_url( '/privacy-policy/' );
	?>
	<form class="enquiry-form" method="post" action="<?php echo esc_url( get_permalink() ); ?>#enquiry-form" novalidate>
		<?php wp_nonce_field( 'ovents_enquiry', 'ovents_enquiry_nonce' ); ?>
		<input type="hidden" name="ovents_enquiry_submit" value="1">
		<div class="enquiry-honeypot visually-hidden" aria-hidden="true">
			<label for="ovents_website">Website</label>
			<input type="text" name="ovents_website" id="ovents_website" tabindex="-1" autocomplete="off">
		</div>

		<?php if ( $errors && $errors->has_errors() ) : ?>
			<div class="enquiry-errors" role="alert">
				<p><?php esc_html_e( 'Please correct the following:', 'ovents' ); ?></p>
				<ul>
					<?php foreach ( $errors->get_error_messages() as $message ) : ?>
						<li><?php echo esc_html( $message ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>

		<div class="enquiry-grid">
			<?php
			ovents_enquiry_field(
				'text',
				'ovents_first_name',
				__( 'First name', 'ovents' ),
				$values['first_name'],
				true,
				$errors,
				$first_err === 'first_name'
			);
			ovents_enquiry_field(
				'text',
				'ovents_last_name',
				__( 'Last name', 'ovents' ),
				$values['last_name'],
				true,
				$errors,
				$first_err === 'last_name'
			);
			ovents_enquiry_field(
				'email',
				'ovents_email',
				__( 'Email', 'ovents' ),
				$values['email'],
				true,
				$errors,
				$first_err === 'email'
			);
			ovents_enquiry_field(
				'tel',
				'ovents_phone',
				__( 'Phone', 'ovents' ),
				$values['phone'],
				false,
				$errors,
				false
			);
			?>
			<div class="enquiry-field enquiry-field--full">
				<label for="ovents_event_type"><?php esc_html_e( 'Event type', 'ovents' ); ?> <span class="required">*</span></label>
				<select name="ovents_event_type" id="ovents_event_type" required <?php echo $first_err === 'event_type' ? ' autofocus' : ''; ?> aria-describedby="<?php echo $errors && $errors->get_error_message( 'event_type' ) ? 'ovents_event_type-error' : ''; ?>">
					<option value=""><?php esc_html_e( 'Please select', 'ovents' ); ?></option>
					<?php foreach ( array( 'Wedding', 'Corporate', 'Private party', 'Other' ) as $opt ) : ?>
						<option value="<?php echo esc_attr( $opt ); ?>" <?php selected( $values['event_type'], $opt ); ?>><?php echo esc_html( $opt ); ?></option>
					<?php endforeach; ?>
				</select>
				<?php if ( $errors && $errors->get_error_message( 'event_type' ) ) : ?>
					<p class="field-error" id="ovents_event_type-error"><?php echo esc_html( $errors->get_error_message( 'event_type' ) ); ?></p>
				<?php endif; ?>
			</div>
			<?php
			ovents_enquiry_field( 'date', 'ovents_event_date', __( 'Event date', 'ovents' ), $values['event_date'], false, $errors, false );
			ovents_enquiry_field( 'text', 'ovents_location', __( 'Location', 'ovents' ), $values['location'], false, $errors, false );
			ovents_enquiry_field( 'text', 'ovents_guests', __( 'Approximate guest numbers', 'ovents' ), $values['guests'], false, $errors, false );
			?>
			<div class="enquiry-field enquiry-field--full">
				<label for="ovents_budget"><?php esc_html_e( 'Budget range (optional)', 'ovents' ); ?></label>
				<select name="ovents_budget" id="ovents_budget">
					<?php foreach ( ovents_enquiry_budget_choices() as $val => $label ) : ?>
						<option value="<?php echo esc_attr( $val ); ?>" <?php selected( $values['budget'], $val ); ?>><?php echo esc_html( $label ); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="enquiry-field enquiry-field--full">
				<label for="ovents_message"><?php esc_html_e( 'Message', 'ovents' ); ?> <span class="required">*</span></label>
				<textarea name="ovents_message" id="ovents_message" rows="5" required <?php echo $first_err === 'message' ? ' autofocus' : ''; ?> aria-describedby="<?php echo $errors && $errors->get_error_message( 'message' ) ? 'ovents_message-error' : ''; ?>"><?php echo esc_textarea( $values['message'] ); ?></textarea>
				<?php if ( $errors && $errors->get_error_message( 'message' ) ) : ?>
					<p class="field-error" id="ovents_message-error"><?php echo esc_html( $errors->get_error_message( 'message' ) ); ?></p>
				<?php endif; ?>
			</div>
			<div class="enquiry-field enquiry-field--full enquiry-field--consent">
				<input type="checkbox" name="ovents_consent" id="ovents_consent" value="1" <?php checked( $values['consent'], '1' ); ?> required <?php echo $first_err === 'consent' ? ' autofocus' : ''; ?> aria-describedby="<?php echo $errors && $errors->get_error_message( 'consent' ) ? 'ovents_consent-error' : ''; ?>">
				<label for="ovents_consent">
					<?php esc_html_e( 'I agree to the', 'ovents' ); ?>
					<a href="<?php echo esc_url( $privacy_url ); ?>"><?php esc_html_e( 'privacy policy', 'ovents' ); ?></a>
					<?php esc_html_e( 'and consent to Ovents storing my details to respond to this enquiry.', 'ovents' ); ?>
				</label>
				<?php if ( $errors && $errors->get_error_message( 'consent' ) ) : ?>
					<p class="field-error" id="ovents_consent-error"><?php echo esc_html( $errors->get_error_message( 'consent' ) ); ?></p>
				<?php endif; ?>
			</div>
		</div>
		<div class="enquiry-form__actions">
			<button type="submit" class="btn btn-primary enquiry-form__submit"><?php esc_html_e( 'Send enquiry', 'ovents' ); ?></button>
			<p class="enquiry-form__note"><?php esc_html_e( 'Fields marked * are required.', 'ovents' ); ?></p>
		</div>
	</form>
	<?php
}

/**
 * Single form field.
 *
 * @param string         $type     Input type.
 * @param string         $name     Name/id.
 * @param string         $label    Label.
 * @param string         $value    Value.
 * @param bool           $required Required.
 * @param WP_Error|null  $errors   Errors.
 * @param bool           $autofocus Autofocus.
 */
function ovents_enquiry_field( $type, $name, $label, $value, $required, $errors, $autofocus ) {
	$code = str_replace( 'ovents_', '', $name );
	$err  = $errors && $errors->get_error_message( $code ) ? ' ' . $name . '-error' : '';
	?>
	<div class="enquiry-field">
		<label for="<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $label ); ?><?php echo $required ? ' <span class="required">*</span>' : ''; ?></label>
		<input type="<?php echo esc_attr( $type ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>" <?php echo $required ? 'required' : ''; ?><?php echo $autofocus ? ' autofocus' : ''; ?><?php echo $err ? ' aria-describedby="' . esc_attr( trim( $err ) ) . '"' : ''; ?>>
		<?php if ( $errors && $errors->get_error_message( $code ) ) : ?>
			<p class="field-error" id="<?php echo esc_attr( $name ); ?>-error"><?php echo esc_html( $errors->get_error_message( $code ) ); ?></p>
		<?php endif; ?>
	</div>
	<?php
}

add_shortcode(
	'ovents_enquiry_form',
	function () {
		ob_start();
		ovents_render_enquiry_form();
		return ob_get_clean();
	}
);