<?php
/**
 * Simple Machines Forum (SMF)
 *
 * ウィジェット管理のテンプレートファイル
 *
 * @package SMF
 * @author towaidee
 * @version 1.0
 */

if (!defined('SMF'))
	die('No direct access...');

/**
 * ウィジェット一覧テンプレート
 */
function template_widget_list()
{
	global $context, $txt, $scripturl;

	// Determine the current admin area for proper URL generation
	$area = isset($_REQUEST['area']) && $_REQUEST['area'] == 'managewidgets' ? 'managewidgets' : 'modsettings';
	$sa_param = $area == 'managewidgets' ? '' : ';sa=widgets';
	$waction_param = $area == 'modsettings' ? ';waction=' : ';sa=';

	echo '
	<div class="cat_bar">
		<h3 class="catbg">Widget Management</h3>
	</div>
	<div class="windowbg">
		<div class="content">
			<div class="widget_management_controls">
				<a href="', $scripturl, '?action=admin;area=', $area, $sa_param, $waction_param, 'add" class="button_submit">
					<span>Add Widget</span>
				</a>
				<a href="', $scripturl, '?action=admin;area=', $area, $sa_param, $waction_param, 'settings" class="button_submit">
					<span>Widget Settings</span>
				</a>
			</div>
			<br>
			<div class="information">
				<strong>Widget Management Instructions:</strong><br>
				• <strong>Add Widget:</strong> Create new widgets with custom HTML, AdSense codes, or built-in types<br>
				• <strong>Toggle Enable/Disable:</strong> Click the checkmark icon to enable/disable widgets<br>
				• <strong>Edit:</strong> Modify widget content, position, and display settings<br>
				• <strong>Delete:</strong> Remove widgets permanently<br>
				• <strong>Display Order:</strong> Lower numbers appear first in the sidebar
			</div>
			<br>';

	if (empty($context['widgets']))
	{
		echo '
			<div class="information">
				No widgets have been created yet. Click "Add Widget" to create your first widget.
			</div>';
	}
	else
	{
		echo '
			<table class="table_grid">
				<thead>
					<tr class="catbg">
						<th scope="col" style="width: 20%">Widget Title</th>
						<th scope="col" style="width: 15%">Type</th>
						<th scope="col" style="width: 10%">Position</th>
						<th scope="col" style="width: 10%">Order</th>
						<th scope="col" style="width: 10%">Enabled</th>
						<th scope="col" style="width: 25%">Display Pages</th>
						<th scope="col" style="width: 10%">Actions</th>
					</tr>
				</thead>
				<tbody>';

		foreach ($context['widgets'] as $widget)
		{
			$widget_types = array(
				'html' => 'HTML Content',
				'php' => 'PHP Code',
				'recent_posts' => 'Recent Posts',
				'japanese_jobs' => 'Japanese Jobs',
				'stats' => 'Forum Statistics',
				'adsense' => 'AdSense Code',
				'custom' => 'Custom Content'
			);

			echo '
					<tr class="windowbg">
						<td><strong>', $widget['title'], '</strong><br><small>', $widget['name'], '</small></td>
						<td>', isset($widget_types[$widget['type']]) ? $widget_types[$widget['type']] : ucfirst($widget['type']), '</td>
						<td>', $widget['position'] == 'left' ? 'Left Sidebar' : 'Right Sidebar', '</td>
						<td>', $widget['order'], '</td>
						<td>
							<a href="', $scripturl, '?action=admin;area=', $area, $sa_param, $waction_param, 'toggle;id=', $widget['id'], ';', $context['session_var'], '=', $context['session_id'], '">
								<span class="', $widget['enabled'] ? 'generic_icons valid' : 'generic_icons invalid', '" title="', $widget['enabled'] ? 'Widget is enabled' : 'Widget is disabled', '"></span>
							</a>
						</td>
						<td><small>', $widget['pages'], '</small></td>
						<td>
							<a href="', $scripturl, '?action=admin;area=', $area, $sa_param, $waction_param, 'edit;id=', $widget['id'], '" class="button_link">
								Edit
							</a>
							<a href="', $scripturl, '?action=admin;area=', $area, $sa_param, $waction_param, 'delete;id=', $widget['id'], ';', $context['session_var'], '=', $context['session_id'], '" onclick="return confirm(\'Are you sure you want to delete this widget?\')" class="button_link">
								Delete
							</a>
						</td>
					</tr>';
		}

		echo '
				</tbody>
			</table>';
	}

	echo '
		</div>
	</div>';
}

/**
 * ウィジェット編集/追加テンプレート
 */
function template_widget_edit()
{
	global $context, $txt, $scripturl;

	// Determine the current admin area for proper URL generation
	$area = isset($_REQUEST['area']) && $_REQUEST['area'] == 'managewidgets' ? 'managewidgets' : 'modsettings';
	$sa_param = $area == 'managewidgets' ? '' : ';sa=widgets';
	$waction_param = $area == 'modsettings' ? ';waction=' : ';sa=';

	echo '
	<script>
		function changeWidgetType(type) {
			var contentArea = document.getElementById("widget_content_area");
			var phpWarning = document.getElementById("php_warning");
			
			if (type === "php") {
				contentArea.style.display = "block";
				phpWarning.style.display = "block";
			} else if (type === "html" || type === "adsense" || type === "custom") {
				contentArea.style.display = "block";
				phpWarning.style.display = "none";
			} else if (type === "recent_posts" || type === "japanese_jobs" || type === "stats") {
				contentArea.style.display = "none";
				phpWarning.style.display = "none";
			} else {
				contentArea.style.display = "none";
				phpWarning.style.display = "none";
			}
		}
		
		window.onload = function() {
			changeWidgetType(document.getElementById("widget_type").value);
		}
	</script>

	<div class="cat_bar">
		<h3 class="catbg">', $context['is_new'] ? 'Add Widget' : 'Edit Widget', '</h3>
	</div>
	<div class="windowbg">
		<div class="content">
			<form action="', $scripturl, '?action=admin;area=', $area, $sa_param, $waction_param, 'save" method="post" accept-charset="UTF-8">
				<input type="hidden" name="widget_id" value="', $context['widget']['id'], '">
				
				<dl class="settings">
					<dt>
						<strong><label for="widget_name">Widget Name</label></strong><br>
						<span class="smalltext">Internal name for this widget (used for identification)</span>
					</dt>
					<dd>
						<input type="text" name="widget_name" id="widget_name" value="', htmlspecialchars($context['widget']['name']), '" size="40" class="input_text" required>
					</dd>

					<dt>
						<strong><label for="widget_title">Widget Title</label></strong><br>
						<span class="smalltext">Title displayed in the sidebar</span>
					</dt>
					<dd>
						<input type="text" name="widget_title" id="widget_title" value="', htmlspecialchars($context['widget']['title']), '" size="40" class="input_text" required>
					</dd>

					<dt>
						<strong><label for="widget_type">Widget Type</label></strong>
					</dt>
					<dd>
						<select name="widget_type" id="widget_type" onchange="changeWidgetType(this.value)">
							<option value="html"', $context['widget']['type'] == 'html' ? ' selected' : '', '>HTML Content</option>
							<option value="php"', $context['widget']['type'] == 'php' ? ' selected' : '', '>PHP Code</option>
							<option value="recent_posts"', $context['widget']['type'] == 'recent_posts' ? ' selected' : '', '>Recent Posts</option>
							<option value="japanese_jobs"', $context['widget']['type'] == 'japanese_jobs' ? ' selected' : '', '>Japanese Jobs</option>
							<option value="stats"', $context['widget']['type'] == 'stats' ? ' selected' : '', '>Forum Statistics</option>
							<option value="adsense"', $context['widget']['type'] == 'adsense' ? ' selected' : '', '>AdSense Code</option>
							<option value="custom"', $context['widget']['type'] == 'custom' ? ' selected' : '', '>Custom Content</option>
						</select>
					</dd>

					<dt>
						<strong><label for="position">Position</label></strong>
					</dt>
					<dd>
						<select name="position" id="position">
							<option value="left"', $context['widget']['position'] == 'left' ? ' selected' : '', '>Left Sidebar</option>
							<option value="right"', $context['widget']['position'] == 'right' ? ' selected' : '', '>Right Sidebar</option>
						</select>
					</dd>

					<dt>
						<strong><label for="display_order">Display Order</label></strong><br>
						<span class="smalltext">Lower numbers appear first (0-999)</span>
					</dt>
					<dd>
						<input type="number" name="display_order" id="display_order" value="', $context['widget']['order'], '" min="0" max="999" class="input_text">
					</dd>

					<dt>
						<strong><label for="display_pages">Display Pages</label></strong><br>
						<span class="smalltext">JSON array of page types where this widget should appear. Example: ["index","messageindex","display"]</span>
					</dt>
					<dd>
						<textarea name="display_pages" id="display_pages" rows="3" cols="50" class="input_text">', htmlspecialchars($context['widget']['pages']), '</textarea>
					</dd>

					<dt>
						<strong><label for="is_enabled">Enabled</label></strong>
					</dt>
					<dd>
						<input type="checkbox" name="is_enabled" id="is_enabled" value="1"', $context['widget']['enabled'] ? ' checked' : '', ' class="input_check">
					</dd>
				</dl>

				<div id="widget_content_area" style="display: none;">
					<hr>
					<dl class="settings">
						<dt>
							<strong><label for="widget_content">Widget Content</label></strong><br>
							<span class="smalltext">Enter HTML, PHP code, AdSense code, or other content</span>
						</dt>
						<dd>
							<textarea name="widget_content" id="widget_content" rows="10" cols="80" class="input_text">', htmlspecialchars($context['widget']['content']), '</textarea>
						</dd>
					</dl>
					
					<div id="php_warning" class="errorbox" style="display: none;">
						<strong>Security Warning: PHP Code</strong><br>
						PHP code execution is a powerful feature that can be dangerous. Only use this if you understand PHP programming and the security implications.
					</div>
				</div>

				<hr class="hrcolor">
				<div class="righttext">
					<input type="submit" value="', $context['is_new'] ? 'Add Widget' : 'Save Changes', '" class="button_submit">
					<a href="', $scripturl, '?action=admin;area=', $area, $sa_param, $waction_param, 'list" class="button_link">Cancel</a>
				</div>
				<input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '">
			</form>
		</div>
	</div>';
}

/**
 * ウィジェット設定テンプレート
 */
function template_widget_settings()
{
	global $context, $txt, $scripturl;

	// Determine the current admin area for proper URL generation
	$area = isset($_REQUEST['area']) && $_REQUEST['area'] == 'managewidgets' ? 'managewidgets' : 'modsettings';
	$sa_param = $area == 'managewidgets' ? '' : ';sa=widgets';
	$waction_param = $area == 'modsettings' ? ';waction=' : ';sa=';

	echo '
	<div class="cat_bar">
		<h3 class="catbg">Widget Settings</h3>
	</div>
	<div class="windowbg">
		<div class="content">
			<form action="', $scripturl, '?action=admin;area=', $area, $sa_param, $waction_param, 'settings;save" method="post" accept-charset="UTF-8">
				<dl class="settings">
					<dt>
						<strong><label for="widget_enable_caching">Enable Widget Caching</label></strong><br>
						<span class="smalltext">Cache widget content to improve performance</span>
					</dt>
					<dd>
						<input type="checkbox" name="widget_enable_caching" id="widget_enable_caching" value="1" class="input_check">
					</dd>

					<dt>
						<strong><label for="widget_cache_time">Cache Time (seconds)</label></strong><br>
						<span class="smalltext">How long to cache widget content (60-3600 seconds)</span>
					</dt>
					<dd>
						<input type="number" name="widget_cache_time" id="widget_cache_time" value="300" min="60" max="3600" class="input_text">
					</dd>

					<dt>
						<strong><label for="widget_allow_php">Allow PHP Code Execution</label></strong><br>
						<span class="smalltext">WARNING: Only enable if you trust all administrators. This allows execution of PHP code in widgets.</span>
					</dt>
					<dd>
						<input type="checkbox" name="widget_allow_php" id="widget_allow_php" value="1" class="input_check">
					</dd>
				</dl>

				<div class="infobox">
					These settings control the global behavior of the widget system. Use caution when enabling PHP execution.
				</div>

				<hr class="hrcolor">
				<div class="righttext">
					<input type="submit" value="Save Settings" class="button_submit">
					<a href="', $scripturl, '?action=admin;area=', $area, $sa_param, $waction_param, 'list" class="button_link">Back to Widget List</a>
				</div>
				<input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '">
			</form>
		</div>
	</div>';
}

?>