<?php
/**
 * Simple Machines Forum (SMF)
 *
 * @package SMF
 * @author Simple Machines https://www.simplemachines.org
 * @copyright 2025 Simple Machines and individual contributors
 * @license https://www.simplemachines.org/about/smf/license.php BSD
 *
 * @version 2.1.5
 */

/**
 * This is just the basic "login" form.
 */
function template_login()
{
	global $context, $settings, $scripturl, $modSettings, $txt;

	echo '
		<div class="login">
			<div class="cat_bar">
				<h3 class="catbg">
					<span class="main_icons login"></span> ', $txt['login'], '
				</h3>
			</div>
			<div class="roundframe">
				<form class="login" action="', $context['login_url'], '" name="frmLogin" id="frmLogin" method="post" accept-charset="', $context['character_set'], '">';

	// Did they make a mistake last time?
	if (!empty($context['login_errors']))
		echo '
					<div class="errorbox">', implode('<br>', $context['login_errors']), '</div>
					<br>';

	// Or perhaps there's some special description for this time?
	if (isset($context['description']))
		echo '
					<div class="information">', $context['description'], '</div>';

	// Now just get the basic information - username, password, etc.
	echo '
					<dl>
						<dt>', $txt['username'], ':</dt>
						<dd>
							<input type="text" id="', !empty($context['from_ajax']) ? 'ajax_' : '', 'loginuser" name="user" size="20" value="', $context['default_username'], '" required>
						</dd>
						<dt>', $txt['password'], ':</dt>
						<dd>
							<input type="password" id="', !empty($context['from_ajax']) ? 'ajax_' : '', 'loginpass" name="passwrd" value="', $context['default_password'], '" size="20" required>
						</dd>
					</dl>
					<dl>
						<dt>', $txt['time_logged_in'], ':</dt>
						<dd>
							<select name="cookielength" id="cookielength">';

	foreach ($context['login_cookie_times'] as $cookie_time => $cookie_txt)
		echo '
								<option value="', $cookie_time, '"', $modSettings['cookieTime'] == $cookie_time ? ' selected' : '', '>', $txt[$cookie_txt], '</option>';

	echo '
							</select>
						</dd>';

	// If they have deleted their account, give them a chance to change their mind.
	if (isset($context['login_show_undelete']))
		echo '
						<dt class="alert">', $txt['undelete_account'], ':</dt>
						<dd><input type="checkbox" name="undelete"></dd>';

	echo '
					</dl>
					<p>
						<input type="submit" value="', $txt['login'], '" class="button">
					</p>
					<p class="smalltext">
						<a href="', $scripturl, '?action=reminder">', $txt['forgot_your_password'], '</a>
					</p>';
	if (!empty($modSettings['registration_method']) && $modSettings['registration_method'] == 1)
		echo '
					<p class="smalltext">
						', sprintf($txt['welcome_guest_activate'], $scripturl), '
					</p>';
	echo '
					<input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '">
					<input type="hidden" name="', $context['login_token_var'], '" value="', $context['login_token'], '">
					<script>
						setTimeout(function() {
							document.getElementById("', !empty($context['from_ajax']) ? 'ajax_' : '', isset($context['default_username']) && $context['default_username'] != '' ? 'loginpass' : 'loginuser', '").focus();
						}, 150);';

	if (!empty($context['from_ajax']) && ((empty($modSettings['allow_cors']) || empty($modSettings['allow_cors_credentials']) || empty($context['valid_cors_found']) || !in_array($context['valid_cors_found'], array('samel', 'subsite')))))
	{
		echo '
						form = $("#frmLogin");
						form.submit(function(e) {
							e.preventDefault();
							e.stopPropagation();

							$.ajax({
								url: form.prop("action") + (form.prop("action").indexOf("?") !== -1 ? ";" : "?") + "ajax",
								method: "POST",
								headers: {
									"X-SMF-AJAX": 1
								},
								xhrFields: {
									withCredentials: typeof allow_xhjr_credentials !== "undefined" ? allow_xhjr_credentials : false
								},
								data: form.serialize(),
								success: function(data) {';


		// While a nice action is to replace the document body after a login, this may fail on CORS requests because the action may not be redirected back to the page they started the login process from.  So for these cases, we simply just reload the page.
		if (empty($context['valid_cors_found']) || $context['valid_cors_found'] == 'same')
			echo '
									if (data.indexOf("<bo" + "dy") > -1) {
										document.open();
										document.write(data);
										document.close();
									}
									else
										form.parent().html($(data).find(".roundframe").html());';
		else
			echo '
									if ($(data).find(".roundframe").length > 0 && $(data).find("body").length == 0) {
										form.parent().html($(data).find(".roundframe").html());
									}
									else {
										window.location.reload();
									}';

		echo '
								},
								error: function(xhr) {
									var data = xhr.responseText;
									if (data.indexOf("<bo" + "dy") > -1) {
										document.open();
										document.write(data);
										document.close();
									}
									else
										form.parent().html($(data).filter("#fatal_error").html());
								}
							});

							return false;
						});';
	}

	echo '
					</script>
				</form>';

	if (!empty($context['can_register']))
		echo '
				<hr>
				<div class="centertext">
					', sprintf($txt['register_prompt'], $scripturl), '
				</div>';

	// It is a long story as to why we have this when we're clearly not going to use it.
	if (!empty($context['from_ajax']))
		echo '
				<br>
				<a href="javascript:self.close();"></a>';

	echo '
			</div><!-- .roundframe -->
		</div><!-- .login -->';
}

/**
 * TFA authentication form
 */
function template_login_tfa()
{
	global $context, $scripturl, $txt;

	echo '
		<div class="login">
			<div class="cat_bar">
				<h3 class="catbg">
					', $txt['tfa_profile_label'], '
				</h3>
			</div>
			<div class="roundframe">';

	if (!empty($context['tfa_error']) || !empty($context['tfa_backup_error']))
		echo '
				<div class="error">
					', $txt['tfa_' . (!empty($context['tfa_error']) ? 'code_' : 'backup_') . 'invalid'], '
				</div>';

	echo '
				<form action="', $context['tfa_url'], '" method="post" id="frmTfa">
					<div id="tfaCode">
						<p style="margin-bottom: 0.5em">', $txt['tfa_login_desc'], '</p>
						<div class="centertext">
							<strong>', $txt['tfa_code'], ':</strong>
							<input type="text" name="tfa_code" value="', !empty($context['tfa_value']) ? $context['tfa_value'] : '', '">
							<input type="submit" class="button" name="submit" value="', $txt['login'], '">
						</div>
						<hr>
						<div class="centertext">
							<input type="button" class="button" name="backup" value="', $txt['tfa_backup'], '">
						</div>
					</div>
					<div id="tfaBackup" style="display: none;">
						<p style="margin-bottom: 0.5em">', $txt['tfa_backup_desc'], '</p>
						<div class="centertext">
							<strong>', $txt['tfa_backup_code'], ': </strong>
							<input type="text" name="tfa_backup" value="', !empty($context['tfa_backup']) ? $context['tfa_backup'] : '', '">
							<input type="submit" class="button" name="submit" value="', $txt['login'], '">
						</div>
					</div>
				</form>
				<script>
					form = $("#frmTfa");';

	if (!empty($context['from_ajax']))
	{
		echo '
					form.submit(function(e) {
						// If we are submitting backup code, let normal workflow follow since it redirects a couple times into a different page
						if (form.find("input[name=tfa_backup]:first").val().length > 0)
							return true;

						e.preventDefault();
						e.stopPropagation();

						$.ajax({
							url: form.prop("action") + (form.prop("action").indexOf("?") !== -1 ? ";" : "?") + "ajax",
							method: "POST",
							headers: {
								"X-SMF-AJAX": 1
							},
							xhrFields: {
								withCredentials: typeof allow_xhjr_credentials !== "undefined" ? allow_xhjr_credentials : false
							},
							data: form.serialize(),
							success: function(data) {
								if (data.indexOf("<bo" + "dy") > -1) {';

		if (empty($context['valid_cors_found']) || $context['valid_cors_found'] == 'same')
			echo '
									document.location = ', JavaScriptEscape(!empty($_SESSION['login_url']) ? $_SESSION['login_url'] : $scripturl), ';';
		else
			echo '
									window.location.reload();';

		echo '
								}
								else {
									window.location.reload();
								}
							},
							error: function(xhr) {
								var data = xhr.responseText;
								if (data.indexOf("<bo" + "dy") > -1) {
									document.open();
									document.write(data);
									document.close();
								}
								else
									form.parent().html($(data).filter("#fatal_error").html());
							}
						});

						return false;
					});';
	}

	echo '
					form.find("input[name=backup]").click(function(e) {
						$("#tfaBackup").show();
						$("#tfaCode").hide();
					});
				</script>
			</div><!-- .roundframe -->
		</div><!-- .login -->';
}

/**
 * Tell a guest to get lost or login!
 */
function template_kick_guest()
{
	global $context, $settings, $scripturl, $modSettings, $txt;

	// This isn't that much... just like normal login but with a message at the top.
	echo '
	<form action="', $context['login_url'], '" method="post" accept-charset="', $context['character_set'], '" name="frmLogin" id="frmLogin">
		<div class="login">
			<div class="cat_bar">
				<h3 class="catbg">', $txt['warning'], '</h3>
			</div>';

	// Show the message or default message.
	echo '
			<p class="information centertext">
				', empty($context['kick_message']) ? $txt['only_members_can_access'] : $context['kick_message'], '<br>';

	if ($context['can_register'])
		echo sprintf($txt['login_below_or_register'], $scripturl . '?action=signup', $context['forum_name_html_safe']);
	else
		echo $txt['login_below'];

	// And now the login information.
	echo '
			<div class="cat_bar">
				<h3 class="catbg">
					<span class="main_icons login"></span> ', $txt['login'], '
				</h3>
			</div>
			<div class="roundframe">
				<dl>
					<dt>', $txt['username'], ':</dt>
					<dd><input type="text" name="user" size="20"></dd>
					<dt>', $txt['password'], ':</dt>
					<dd><input type="password" name="passwrd" size="20"></dd>
					<dt>', $txt['time_logged_in'], ':</dt>
					<dd>
							<select name="cookielength" id="cookielength">';

	foreach ($context['login_cookie_times'] as $cookie_time => $cookie_txt)
		echo '
								<option value="', $cookie_time, '"', $modSettings['cookieTime'] == $cookie_time ? ' selected' : '', '>', $txt[$cookie_txt], '</option>';

	echo '
							</select>
					</dd>
				</dl>
				<p class="centertext">
					<input type="submit" value="', $txt['login'], '" class="button">
				</p>
				<p class="centertext smalltext">
					<a href="', $scripturl, '?action=reminder">', $txt['forgot_your_password'], '</a>
				</p>
			</div>
			<input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '">
			<input type="hidden" name="', $context['login_token_var'], '" value="', $context['login_token'], '">
		</div><!-- .login -->
	</form>';

	// Do the focus thing...
	echo '
	<script>
		document.forms.frmLogin.user.focus();
	</script>';
}

/**
 * This is for maintenance mode.
 */
function template_maintenance()
{
	global $context, $settings, $txt, $modSettings;

	// Display the administrator's message at the top.
	echo '
	<form action="', $context['login_url'], '" method="post" accept-charset="', $context['character_set'], '">
		<div class="login" id="maintenance_mode">
			<div class="cat_bar">
				<h3 class="catbg">', $context['title'], '</h3>
			</div>
			<div class="information">
				<img class="floatleft" src="', $settings['images_url'], '/construction.png" width="40" height="40" alt="', $txt['in_maintain_mode'], '">
				', $context['description'], '<br class="clear">
			</div>
			<div class="title_bar">
				<h4 class="titlebg">', $txt['admin_login'], '</h4>
			</div>
			<div class="roundframe">
				<dl>
					<dt>', $txt['username'], ':</dt>
					<dd><input type="text" name="user" size="20"></dd>
					<dt>', $txt['password'], ':</dt>
					<dd><input type="password" name="passwrd" size="20"></dd>
					<dt>', $txt['time_logged_in'], ':</dt>
					<dd>
							<select name="cookielength" id="cookielength">';

	foreach ($context['login_cookie_times'] as $cookie_time => $cookie_txt)
		echo '
								<option value="', $cookie_time, '"', $modSettings['cookieTime'] == $cookie_time ? ' selected' : '', '>', $txt[$cookie_txt], '</option>';

	echo '
							</select>
					</dd>
				</dl>
				<input type="submit" value="', $txt['login'], '" class="button">
				<br class="clear">
			</div>
			<input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '">
			<input type="hidden" name="', $context['login_token_var'], '" value="', $context['login_token'], '">
		</div><!-- #maintenance_mode -->
	</form>';
}

/**
 * This is for the security stuff - makes administrators login every so often.
 */
function template_admin_login()
{
	global $context, $settings, $scripturl, $txt, $modSettings;

	// Since this should redirect to whatever they were doing, send all the get data.
	echo '
	<form action="', !empty($modSettings['force_ssl']) ? strtr($scripturl, array('http://' => 'https://')) : $scripturl, $context['get_data'], '" method="post" accept-charset="', $context['character_set'], '" name="frmLogin" id="frmLogin">
		<div class="login" id="admin_login">
			<div class="cat_bar">
				<h3 class="catbg">
					<span class="main_icons login"></span> ', $txt['login'], '
				</h3>
			</div>
			<div class="roundframe centertext">';

	if (!empty($context['incorrect_password']))
		echo '
				<div class="error">', $txt['admin_incorrect_password'], '</div>';

	echo '
				<strong>', $txt['password'], ':</strong>
				<input type="password" name="', $context['sessionCheckType'], '_pass" size="24">
				<a href="', $scripturl, '?action=helpadmin;help=securityDisable_why" onclick="return reqOverlayDiv(this.href);" class="help"><span class="main_icons help" title="', $txt['help'], '"></span></a><br>
				<input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '">
				<input type="hidden" name="', $context['admin-login_token_var'], '" value="', $context['admin-login_token'], '">
				<input type="submit" value="', $txt['login'], '" class="button">';

	// Make sure to output all the old post data.
	echo $context['post_data'], '
			</div><!-- .roundframe -->
		</div><!-- #admin_login -->
		<input type="hidden" name="', $context['sessionCheckType'], '_hash_pass" value="">
	</form>';

	// Focus on the password box.
	echo '
	<script>
		document.forms.frmLogin.', $context['sessionCheckType'], '_pass.focus();
	</script>';
}

/**
 * Activate your account manually?
 */
function template_retry_activate()
{
	global $context, $txt, $scripturl;

	// Just ask them for their code so they can try it again...
	echo '
		<form action="', $scripturl, '?action=activate;u=', $context['member_id'], '" method="post" accept-charset="', $context['character_set'], '">
			<div class="title_bar">
				<h3 class="titlebg">', $context['page_title'], '</h3>
			</div>
			<div class="roundframe">
				<dl>';

	// You didn't even have an ID?
	if (empty($context['member_id']))
		echo '
					<dt>', $txt['invalid_activation_username'], ':</dt>
					<dd><input type="text" name="user" size="30"></dd>';

	echo '
					<dt>', $txt['invalid_activation_retry'], ':</dt>
					<dd><input type="text" name="code" size="30"></dd>
				</dl>
				<p><input type="submit" value="', $txt['invalid_activation_submit'], '" class="button"></p>
			</div>
		</form>';
}

/**
 * The form for resending the activation code.
 */
function template_resend()
{
	global $context, $txt, $scripturl;

	// Just ask them for their code so they can try it again...
	echo '
		<form action="', $scripturl, '?action=activate;sa=resend" method="post" accept-charset="', $context['character_set'], '">
			<div class="title_bar">
				<h3 class="titlebg">', $context['page_title'], '</h3>
			</div>
			<div class="roundframe">
				<dl>
					<dt>', $txt['invalid_activation_username'], ':</dt>
					<dd><input type="text" name="user" size="40" value="', $context['default_username'], '"></dd>
				</dl>
				<p>', $txt['invalid_activation_new'], '</p>
				<dl>
					<dt>', $txt['invalid_activation_new_email'], ':</dt>
					<dd><input type="text" name="new_email" size="40"></dd>
					<dt>', $txt['invalid_activation_password'], ':</dt>
					<dd><input type="password" name="passwd" size="30"></dd>
				</dl>';

	if ($context['can_activate'])
		echo '
				<p>', $txt['invalid_activation_known'], '</p>
				<dl>
					<dt>', $txt['invalid_activation_retry'], ':</dt>
					<dd><input type="text" name="code" size="30"></dd>
				</dl>';

	echo '
				<p><input type="submit" value="', $txt['invalid_activation_resend'], '" class="button"></p>
			</div><!-- .roundframe -->
		</form>';
}

/**
 * Confirm a logout.
 */
function template_logout()
{
	global $context, $settings, $scripturl, $modSettings, $txt;

	// This isn't that much... just like normal login but with a message at the top.
	echo '
	<form action="', $scripturl . '?action=logout;', $context['session_var'], '=', $context['session_id'], '" method="post" accept-charset="', $context['character_set'], '" name="frmLogout" id="frmLogout">
		<div class="logout">
			<div class="cat_bar">
				<h3 class="catbg">', $txt['logout_confirm'], '</h3>
			</div>
			<div class="roundframe">
				<p class="information centertext">
					', $txt['logout_notice'], '
				</p>

				<p class="centertext">
					<input type="submit" value="', $txt['logout'], '" class="button">
					<input type="submit" name="cancel" value="', $txt['logout_return'], '" class="button">
				</p>
			</div>
		</div><!-- .logout -->
	</form>';
}

?>