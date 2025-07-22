<?php
/**
 * Simple Machines Forum (SMF)
 *
 * SEO テンプレート - カスタマイズ版（重複Sitemapリンクを削除）
 *
 * @package SMF
 * @author towaidee
 * @version 1.0
 */

if (!defined('SMF'))
	die('No direct access...');

/**
 * SEO Quick search - カスタマイズ版（重複Sitemapリンクを削除）
 */
function template_seo_quicksearch()
{
	global $context, $scripturl, $txt, $modSettings, $user_info;

	// If user is not logged in, show quick search without extra sitemap link
	if ($user_info['is_guest'])
	{
		echo'
							<div class="roundframe">
								<form id="seoform" action="', $scripturl, '?action=search2" method="post" accept-charset="', $context['character_set'], '">
									<div class="centertext">
										<input type="text" name="search" value="" size="30">&nbsp;
										<input type="submit" value="', $txt['search'], '" style="padding:4px">
									</div>
									<div style="clear:both;font-size:x-small;padding-top: 10px;">
										<ul style="margin:0;display:inline; padding:0;list-style:none;">
									<li style="display:inline;padding:1px 3px 0 0"><a href="'.$scripturl.'?action=search" rel="nofollow" title="', $txt['search_advanced'], '">',$txt['search_advanced'], '</a></li>';
									
									// 重複するSitemapリンクを削除
									// if (!empty($modSettings['seo_enable_sitemap']))
				                    // 	echo'<li><a href="'.$scripturl.'?action=sitemap" title="'.$txt['seo_browsesitemap'].'">'.$txt['seo_browsesitemap'].'</a></li>';
			                    	
						echo'
								</ul>';
		}
		else
			echo'
							<div class="roundframe">
								<div class="centertext">';
							
								if (!empty($context['allow_search']))
								echo'	
									<form id="seoform" action="', $scripturl, '?action=search2" method="post" accept-charset="', $context['character_set'], '">
										<input type="text" name="search" value="" size="30">&nbsp;
										<input type="submit" value="', $txt['search'], '" style="padding:4px">
									</form>';
								else
								echo'
									', $txt['search_desc'];
						echo'
								</div>';
	
	echo'
							</div>';
}

/**
 * SEO Admin Panel - required for SEO plugin admin interface
 */
function template_seo_admin_panel()
{
	global $context, $txt, $settings, $sourcedir, $scripturl, $modSettings, $latest_version;
	
	// Show stats?
	echo '
	<div class="cat_bar">
		<h3 class="catbg">
			', $txt['stats_center'], '
		</h3>
	</div>
	<div class="windowbg">
		<span class="topslice"><span></span></span>
		<div class="content">';
		
	// No tracking? No party
	if (empty($modSettings['hitStats']))
	{
		echo'
			<div align="center">
				<a href="', $scripturl, '?action=admin;area=seo_admin;', $context['session_var'], '=', $context['session_id'],';enableTracking">
				', $txt['no_tracking_enabled_found'], '
			</div>';
	}
	// If enabled, show the graph!
	else
	{
		echo '
			<div id="placeholder" style="margin: 0 auto 20px auto;"></div>
			<form method="post" action="', $scripturl, '?action=admin;area=seo_admin;', $context['session_var'], '=', $context['session_id'], '">
				<fieldset>
				<legend>', $txt['seo_set_date'], '</legend>
				<div class="floatleft" style="width: 25%;">
					&nbsp;
				</div>
				<div class="floatleft" style="width: 25%;">
					', $txt['calendar_year'],' 
					<select name="year" id="year">';
						
						for ($year = 2008; $year < (date('Y') + 1); $year++)
							echo'
								<option value="', $year, '" ', (!isset($_REQUEST['year']) && date('Y') == $year ? 'selected="selected"' : '') , ' ', ((isset($_REQUEST['year']) && ($_REQUEST['year'] == $year)) ? 'selected="selected"' : ''),'>', $year,'</option>';
								
					echo'
					</select>
				</div>
				<div class="floatleft" style="width: 25%;">
					<span class="floatleft">
						', $txt['calendar_month'],' 
					</span>
					<div class="floatright" style="width: 80%; text-align: left;">
						<input type="radio" value="1" name="nomonth"', empty($_REQUEST['nomonth']) ? '' : ' checked="checked"', ' onclick="document.getElementById(\'month\').disabled = true; document.getElementById(\'month_selection\').style.color = \'grey\';" /> ', $txt['seo_month_none'],'<br />
						<input type="radio" value="0" name="nomonth"', empty($_REQUEST['nomonth']) ? ' checked="checked"' : '', ' onclick="document.getElementById(\'month\').disabled = false; document.getElementById(\'month_selection\').style.color = \'#000\';" /> <span id="month_selection" ', empty($_REQUEST['nomonth']) ? '' : ' style="color: grey;"', '>', $txt['seo_analytics_specific'],'</span>
						<select name="month" id="month"', empty($_REQUEST['nomonth']) ? '' : ' disabled="disabled"', '>';
							
							foreach( $txt['months'] as $i => $month)
								echo'
									<option value="', $i, '" ', (!isset($_REQUEST['month']) && date('n') == $i ? 'selected="selected"' : '') , '  ', (isset($_REQUEST['month']) && $_REQUEST['month'] == $i ? 'selected="selected"' : '') , '>', $month,'</option>';
							
						echo'
							</select>
					</div>
				</div>
				<div class="floatleft" style="width: 25%;">
					&nbsp;
				</div>
				<br class="clear" /><br class="clear" />
				<div align="center">
					<input type="submit" name="submit" value="', $txt['seo_submit'],'" class="button_submit" />
				</div>
				</fieldset>
			</form>';
			
	}
	
	// Complete our panel!
	echo '
			</div>
		<span class="botslice"><span></span></span>
	</div>
	<div id="admin_main_section">';
	
	if (empty($modSettings['seo_disable_warnings']))
	{
		echo'
			<div class="floatleft" style="width: 48%;">
				<div class="cat_bar">
					<h3 class="catbg">
						<span class="ie6_header floatleft"><a href="', $scripturl, '?action=admin;area=seo_warning">', $txt['seo_recent_warnings'],'</a></span>
					</h3>
				</div>
				<div class="windowbg">
					<span class="topslice"><span></span></span>
					<div class="content">
						<div id="version_details">';
						
							if (empty($context['seo_warnings_portal']))
								echo'<div align="center" style="font-weight: bold;">' , $txt['seo_warning_none'], '</div>';
							else
							{
								echo'
									<ol>';
									
								foreach ($context['seo_warnings_portal'] as $warn)
									echo ' <li>', $warn, '</li>';
									
								echo'
									</ol>';
							}
				echo'
						</div>
					</div>
					<span class="botslice"><span></span></span>
				</div>
			</div>
			<div class="floatright" style="width: 48%;">';
	}
	else
		echo'
			<div>';
			
	echo '
				<div class="cat_bar">
					<h3 class="catbg">
						<a href="', $scripturl,'?action=admin;area=sengines;sa=logs">', $txt['seo_recent_spiders'], '</a>
					</h3>
				</div>
				<div class="windowbg">
					<span class="topslice"><span></span></span>
					<div class="content">
						<div id="version_details">';
							
							if ((isset($modSettings['spider_mode']) && empty($modSettings['spider_mode'])) || (isset($context['admin_features']) && !in_array('sp', $context['admin_features'])))
								echo'
									<div align="center">
										<strong>
												<a href="', $scripturl, '?action=admin;area=corefeatures;', $context['session_var'], '=', $context['session_id'],'" style="color: red !important;">
													' , $txt['seo_enable_spiders'], '
												</a>
										</strong>
									</div>';
							elseif (empty($context['seo_spiders_log']))
								echo'
									<div align="center">
										<strong>' , $txt['seo_no_spiders'], '</strong>
									</div>';
							else
							{
								echo'
									<ol>';
									
								foreach ($context['seo_spiders_log'] AS $spider)
									echo ' <li> ' . $spider['spider_name'] . ' ' . $txt['on'] . ' ' . timeformat($spider['log_time']) . '</li>';
									
								echo'
									</ol>';
							}
							
						echo'
							</div>
						</div>
					<span class="botslice"><span></span></span>
				</div>
			</div>
		</div>
		<div class="cat_bar">
			<h3 class="catbg">
				', $txt['seo_quick_links'],'
			</h3>
		</div>
		<div class="windowbg clear_right">
			<span class="topslice"><span></span></span>
				<div class="content">
					<ul class="seo_quick_links flow_hidden" id="quick_tasks">';
						
						if (!empty($context['seo_menu']))
						{
							foreach ($context['seo_menu'] AS $item => $array)
								echo'
									<li>
										<a href="', $array[0], '"><img class="home_image png_fix" alt="" src="'.$settings['default_images_url'].'/seo/', $array[1], '"></a>
										<h5><a href="', $array[0], '">', $txt['seo_admin_' . $item], '</a></h5>
										<span class="task">'.$txt['seo_admin_' . $item . '_desc'].'</span>
									</li>';
						}
								
				echo'
					</ul>
				</div>
			<span class="botslice clear"><span></span></span>
		</div>';
	 
}

/**
 * Sitemap index page - required for sitemap functionality
 */
function template_seo_sitemap_index()
{
    global $scripturl, $context, $txt; 

    echo '
    <div style="width: 60%; margin-left: auto; margin-right: auto;">
    	<div class="cat_bar">
				<h3 class="catbg">
					<span class="ie6_header floatleft">', $txt['seo_sitemap'], ' - ', $context['forum_name'], '</span>
				</h3>
		</div>
		<div class="windowbg">
			<span class="topslice"><span></span></span>
			<div class="content">';
				foreach ($context['jump_to'] as $category)
				{
					echo'
					<span style="font-size: 1.1em; font-weight: bold;">', $category['name'], '</span>:<br />
					<ul style="list-style: none;">';
						foreach ($category['boards'] as $board)
							echo '
							<li style="padding-left: 10px;">' . str_repeat('&nbsp;&nbsp;&nbsp; ', $board['child_level']) . ' <a href="'.$scripturl.'?action=sitemap;b='.$board['id'].'">' . $board['name'] . '</a></li>';
					
					echo'
					</ul><br />';		
				}
			echo'
			</div>
			<span class="botslice"><span></span></span>
		</div>
		<a href="', $scripturl, '?action=sitemap;xml">XML Format</a>
    </div>';
}

/**
 * Sitemap board page - required for sitemap functionality
 */
function template_seo_sitemap_board()
{
    global $scripturl, $context, $txt; 
	
	$topic_number = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
	
    echo '
    <div style="width: 60%; margin-left: auto; margin-right: auto;">
	    <div class="pagesection">
				<div class="pagelinks floatleft">', $txt['pages'], ': ', $context['page_index'], '</div>
		</div>
    	<div class="cat_bar">
				<h3 class="catbg">
					<span class="ie6_header floatleft">', $txt['seo_sitemap'], ' - ', $context['board']['board_name'], '</span>
				</h3>
		</div>
		<div class="windowbg">
			<span class="topslice"><span></span></span>
			<div class="content">';
				
				if (!empty($context['topics']))
				{
					echo'
					<ul style="list-style: none; margin-left:0px; margin-bottom:20px;">';
						foreach($context['topics'] as $topic)
						{
							echo '
							<li><a href="' . $topic['href'] . '">' . $topic['subject'] . '</a> (' .$topic['num_replies']. ' replies)</li>';
						}
					echo'
					</ul>';
				}
				else
					echo '
					<ul>
						<li>', $txt['sitemap_no_topics'], '</li>
					</ul>';
				
			echo'
			</div>
			<span class="botslice"><span></span></span>
		</div>
		<div class="pagesection">
				<div class="pagelinks floatleft">', $txt['pages'], ': ', $context['page_index'], '</div>
		</div>
    </div>';
}

/**
 * XML Sitemap index - required for XML sitemap functionality
 */
function template_seo_sitemap_xml_index()
{
	global $boarddir;
	// Delegate to default theme
	$original_func = 'template_seo_sitemap_xml_index';
	if (file_exists($boarddir . '/Themes/default/Seo.template.php')) {
		include_once($boarddir . '/Themes/default/Seo.template.php');
		if (function_exists($original_func)) {
			$original_func();
		}
	}
}

/**
 * XML Sitemap board - required for XML sitemap functionality
 */
function template_seo_sitemap_xml_board()
{
	global $boarddir;
	// Delegate to default theme
	$original_func = 'template_seo_sitemap_xml_board';
	if (file_exists($boarddir . '/Themes/default/Seo.template.php')) {
		include_once($boarddir . '/Themes/default/Seo.template.php');
		if (function_exists($original_func)) {
			$original_func();
		}
	}
}

/**
 * XML Sitemap style - required for XML sitemap functionality
 */
function template_sitemap_style()
{
	global $boarddir;
	// Delegate to default theme
	$original_func = 'template_sitemap_style';
	if (file_exists($boarddir . '/Themes/default/Seo.template.php')) {
		include_once($boarddir . '/Themes/default/Seo.template.php');
		if (function_exists($original_func)) {
			$original_func();
		}
	}
}

?>