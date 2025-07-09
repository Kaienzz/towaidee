<?php
/**********************************************************************************
* Seo.template.php																  *															
***********************************************************************************
*																				  *
* SMFPacks SEO Pro v2.4															  *
* Copyright (c) 2011-2019 by SMFPacks.com. All rights reserved.					  *
* Powered by www.smfpacks.com													  *
* Created by NIBOGO for SMFPacks.com											  *
*																				  *
***********************************************************************************
* You can't redistribute this program, this is a PAID Mod and only can be		  *
* downloaded from the SMFPacks site (http://www.smfpacks.com if you downloaded	  *
* this package from another website please report it to the SMFPacks Team.		  *
**********************************************************************************/

function template_seo_error_pages()
{
	global $context, $txt, $scripturl, $modSettings;

	echo '
		<div style="width: 80%; margin-right: auto; margin-left: auto;">
			<div class="cat_bar">
				<h3 class="catbg">
					', $txt['seo_error' . $_GET['c']], '
				</h3>
			</div>
			<div class="windowbg">
				<span class="topslice"><span></span></span>
					<div class="content">
						', $txt['seo_error' . $_GET['c'] . '_desc'];
					
					if (!empty($modSettings['seo_error404']) && $modSettings['seo_error404'] == 'custom' && !empty($modSettings['seo_error404_custompage']) && $_GET['c'] == '404')
						echo'
							<br class="clear" /><br class="clear" />
								', $modSettings['seo_error404_custompage'];
					elseif ($_GET['c'] == '404')
					{
							echo'
								<br class="clear" /><br class="clear" />
								', $txt['seo_useful'], '<br />
			                    <ul>
									<li><a href="'.$scripturl.'" title="', $txt['seo_index'], '">',$txt['seo_index'], '</a></li>
									<li><a href="'.$scripturl.'?action=help" rel="nofollow" title="', $txt['seo_help'], '">',$txt['seo_help'], '</a></li>
									<li><a href="'.$scripturl.'?action=search" rel="nofollow" title="', $txt['search_advanced'], '">',$txt['search_advanced'], '</a></li>';
									
									if (!empty($modSettings['seo_enable_sitemap']))
				                    	echo'<li><a href="'.$scripturl.'?action=sitemap" title="'.$txt['seo_browsesitemap'].'">'.$txt['seo_browsesitemap'].'</a></li>';
			                    	
							echo'
								</ul>';
					}
					else
						echo'
							<br class="clear" />';
					
					echo'
						<br class="clear" />
							', $txt['error_url'], ' <a href="',  $context['request_url'],  '" rel="nofollow">', $context['request_url'], '</a>';
							
				echo'
					</div>
				<span class="botslice"><span></span></span>
			</div>
		</div>
		<br class="clear" />
		<div align="center">
			<a href="javascript:history.go(-1)">
				', $txt['back'], '
			</a>
		</div>';
}

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
						
						foreach ($context['seo_menu'] AS $item => $array)
							echo'
								<li>
									<a href="', $array[0], '"><img class="home_image png_fix" alt="" src="'.$settings['default_images_url'].'/seo/', $array[1], '"></a>
									<h5><a href="', $array[0], '">', $txt['seo_admin_' . $item], '</a></h5>
									<span class="task">'.$txt['seo_admin_' . $item . '_desc'].'</span>
								</li>';
								
				echo'
					</ul>
				</div>
			<span class="botslice clear"><span></span></span>
		</div>';
	 
}

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
		</div>';
		
		if (!empty($context['seo_description']))
			echo'
				<div class="description">
					', $context['seo_description'], '
				</div>';
				
		echo'
		<div class="windowbg">
			<span class="topslice"><span></span></span>
			<div class="content"><ul style="list-style: none;">';
			
				if (!empty($context['topics']))
					foreach ($context['topics'] as $topic)
					{
						++$topic_number;
						
						echo '
						<li>', $topic_number, '. <a href="', $scripturl, '?topic=', $topic['id_topic'], '.0">', $topic['subject'], '</a></li>';
					}
				else
					echo'
						<li>', $txt['sitemap_no_topics'], '</li>';
					
			echo'
			</ul></div>
			<span class="botslice"><span></span></span>
		</div>
		<div class="pagesection">
				<div class="pagelinks floatleft">', $txt['pages'], ': ', $context['page_index'], '</div>
		</div>
	</div>';
}

function template_seo_sitemap_xml_index()
{
    global $scripturl, $context, $boardurl, $modSettings;   

    echo $context['xml_output'];  
}

function template_seo_sitemap_xml_board()
{
    global $scripturl, $context, $boardurl, $modSettings;   
    
    // Just print the output!
    echo $context['xml_output'];  
}

function template_seo_custom_meta_tags()
{
	global $context, $settings, $options, $scripturl, $txt, $modSettings;
	
	echo'
		<div class="cat_bar">
			<h3 class="catbg">
				', $context[$context['admin_menu_name']]['tab_data']['title'], '
			</h3>
		</div>';

	// First section is for adding/removing words from the censored list.
	echo '
	<div id="admincenter">
		<form action="', $scripturl, '?action=admin;area=seo_meta;sa=custom" method="post" accept-charset="', $context['character_set'], '">
			<div class="windowbg">
				<span class="topslice"><span></span></span>
				<div class="content">
					<p>', $txt['seo_custom_meta_where'], '</p>
					<p class="smalltext">
						', $txt['seo_custom_meta_where_description'], '
					</p>';

	foreach ($context['censored_words'] as $vulgar => $proper)
		echo '
					<div style="margin-top: 1ex;"><input type="text" name="censor_vulgar[]" value="', $vulgar, '" size="40" /> => <input type="text" name="censor_proper[]" value="', $proper, '" size="40" /></div>';

	// Now provide a way to censor more words.
	echo '
					<noscript>
						<div style="margin-top: 1ex;"><input type="text" name="censor_vulgar[]" size="20" class="input_text" /> => <input type="text" name="censor_proper[]" size="20" class="input_text" /></div>
					</noscript>
					<div id="moreRedirections"></div><div style="margin-top: 1ex; display: none;" id="moreRedirects_link"><a href="#;" onclick="addNewRedirect(); return false;">', $txt['seo_custom_meta_clickadd'], '</a></div>
						<script type="text/javascript"><!-- // --><![CDATA[
							document.getElementById("moreRedirects_link").style.display = "";

							function addNewRedirect()
							{
								setOuterHTML(document.getElementById("moreRedirections"), \'<div style="margin-top: 1ex;"><input type="text" name="censor_vulgar[]" size="40" class="input_text" /> => <input type="text" name="censor_proper[]" size="40" class="input_text" /><\' + \'/div><div id="moreRedirections"><\' + \'/div>\');
							}
						// ]]></script>
						<input type="submit" name="save_censor" value="', $txt['save'], '" class="button_submit" />
				</div>
				<span class="botslice"><span></span></span>
			</div>
			<input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '" />
		</form>
	</div>
	<br class="clear" />';
}

function template_seo_redirects()
{
	global $context, $settings, $options, $scripturl, $txt, $modSettings;
	
	echo'
		<div class="cat_bar">
			<h3 class="catbg">
				', $context[$context['admin_menu_name']]['tab_data']['title'], '
			</h3>
		</div>';

	// First section is for adding/removing words from the censored list.
	echo '
	<div id="admincenter">
		<form action="', $scripturl, '?action=admin;area=seo_settings;sa=seo_redirects" method="post" accept-charset="', $context['character_set'], '">
			<div class="windowbg">
				<span class="topslice"><span></span></span>
				<div class="content">
					<p>', $txt['seo_redirects_where'], '</p>
					<p class="smalltext">
						', $txt['seo_redirects_where_description'], '
					</p>';

	foreach ($context['censored_words'] as $vulgar => $proper)
		echo '
					<div style="margin-top: 1ex;"><input type="text" name="censor_vulgar[]" value="', $vulgar, '" size="40" /> => <input type="text" name="censor_proper[]" value="', $proper, '" size="40" /></div>';

	// Now provide a way to censor more words.
	echo '
					<noscript>
						<div style="margin-top: 1ex;"><input type="text" name="censor_vulgar[]" size="20" class="input_text" /> => <input type="text" name="censor_proper[]" size="20" class="input_text" /></div>
					</noscript>
					<div id="moreRedirections"></div><div style="margin-top: 1ex; display: none;" id="moreRedirects_link"><a href="#;" onclick="addNewRedirect(); return false;">', $txt['seo_redirects_clickadd'], '</a></div>
						<script type="text/javascript"><!-- // --><![CDATA[
							document.getElementById("moreRedirects_link").style.display = "";

							function addNewRedirect()
							{
								setOuterHTML(document.getElementById("moreRedirections"), \'<div style="margin-top: 1ex;"><input type="text" name="censor_vulgar[]" size="40" class="input_text" /> => <input type="text" name="censor_proper[]" size="40" class="input_text" /><\' + \'/div><div id="moreRedirections"><\' + \'/div>\');
							}
						// ]]></script>
						<input type="submit" name="save_censor" value="', $txt['save'], '" class="button_submit" />
				</div>
				<span class="botslice"><span></span></span>
			</div>
			<input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '" />
		</form>
	</div>
	<br class="clear" />';
}

// Based on SMF Censor
function template_edit_acronym_parser()
{
	global $context, $settings, $options, $scripturl, $txt, $modSettings;

	// First section is for adding/removing words from the censored list.
	echo '
	<div id="admincenter">
		<form action="', $scripturl, '?action=admin;area=seo_acronym" method="post" accept-charset="', $context['character_set'], '">
			<div class="cat_bar">
				<h3 class="catbg">
					', $txt['seo_acronym'], '
				</h3>
			</div>
			<div class="description">
				', $txt['seo_acronym_parser_desc'], '
			</div>
			<div class="windowbg">
				<span class="topslice"><span></span></span>
				<div class="content">
					<p>', $txt['seo_acronym_parser_where'], '</p>';

	// Show text boxes for censoring [bad   ] => [good  ].
	foreach ($context['censored_words'] as $vulgar => $proper)
		echo '
					<div style="margin-top: 1ex;"><input type="text" name="censor_vulgar[]" value="', $vulgar, '" size="20" /> => <input type="text" name="censor_proper[]" value="', $proper, '" size="20" /></div>';

	// Now provide a way to censor more words.
	echo '
					<noscript>
						<div style="margin-top: 1ex;"><input type="text" name="censor_vulgar[]" size="20" class="input_text" /> => <input type="text" name="censor_proper[]" size="20" class="input_text" /></div>
					</noscript>
					<div id="moreCensoredWords"></div><div style="margin-top: 1ex;" id="moreCensoredWords_link"><a href="javascript:addNewWord();">', $txt['seo_acronym_clickadd'], '</a></div>
						<script type="text/javascript"><!-- // --><![CDATA[
							document.getElementById("moreCensoredWords_link").style.display = "";

							function addNewWord()
							{
								setOuterHTML(document.getElementById("moreCensoredWords"), \'<div style="margin-top: 1ex;"><input type="text" name="censor_vulgar[]" size="20" class="input_text" /> => <input type="text" name="censor_proper[]" size="20" class="input_text" /><\' + \'/div><div id="moreCensoredWords"><\' + \'/div>\');
							}
						// ]]></script>
						<hr width="100%" size="1" class="hrcolor" />
						<dl class="settings">
							<dt>
								<label for="censorWholeWord_check">', $txt['censor_whole_words'], ':</label>
							</dt>
							<dd>
								<input type="checkbox" name="acronymWholeWord" value="1" id="acronymWholeWord_check"', empty($modSettings['acronymWholeWord']) ? '' : ' checked="checked"', ' class="input_check" />
							</dd>
							<dt>
								<label for="acronymIgnoreCase_check">', $txt['seo_acronym_case'], ':</label>
							</dt>
							<dd>
								<input type="checkbox" name="acronymIgnoreCase" value="1" id="acronymIgnoreCase_check"', empty($modSettings['acronymIgnoreCase']) ? '' : ' checked="checked"', ' class="input_check" />
							</dd>
						</dl>
						<input type="submit" name="save_censor" value="', $txt['save'], '" class="button_submit" />
				</div>
				<span class="botslice"><span></span></span>
			</div>
			<input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '" />
		</form>
	</div>
	<br class="clear" />';
}

function template_seo_redirect()
{
	global $txt, $modSettings, $context;
	
	echo'
		<div class="cat_bar">
			<h3 class="catbg">', sprintf($txt['seo_being_redirected'], $context['url']),'</h3>
		</div>
		<div class="windowbg">
			<span class="topslice"><span></span></span>
			<div class="content">
				', sprintf($txt['seo_being_redirected_desc'], $context['seconds']),'
			</div>
			<span class="botslice"><span></span></span>
		</div>';
}

function template_seo_warning()
{
	global $context, $txt, $scripturl;
	
	// Show the page index... "Pages: [1]".
	    echo '
		   	<div class="pagesection">
		   		<div class="pagelinks floatleft">
			   		', $txt['pages'], ': ', $context['page_index'], '
			   	</div>
			   	<div class="floatright buttonlist">
			   		<ul>
			   			<li>
			   				<a class="button_strip_reply active" href="', $scripturl, '?action=admin;area=seo_warning;killemall">
			   					<span>
			   						', $txt['remove_all'], '
			   					</span>
			   				</a>
			   			</li>
			   		</ul>
			   	</div>
			</div>
		   	<div class="cat_bar">
				<h3 class="catbg">', $context['page_title'],'</h3>
			</div>
		<div class="windowbg">
			<span class="topslice"><span></span></span>
				<div class="content">';
			
		if (empty($context['seo_warnings']))
			echo'
				<p align="center">
					', $txt['seo_warning_none'],'
				</p>';
		else
		{
			echo'
				<ul>';
				
			foreach ($context['seo_warnings'] as $id => $warn)
				echo'
					<li>', $warn,' <a href="', $scripturl, '?action=admin;area=seo_warning;w=', $id, '" title="', $txt['seo_dismiss'], '"><span style="color: red;">[X]</span></a></li>';
			
			echo'
				</ul>';
		}
		
		echo'
				</div>
			<span class="botslice"><span></span></span>
		</div>';
		
		// Show the page index... "Pages: [1]".
	    echo '
		  <div class="pagesection">
		   		<div class="pagelinks floatleft">
			   		', $txt['pages'], ': ', $context['page_index'], '
			   	</div>
			   	<div class="floatright buttonlist">
			   		<ul>
			   			<li>
			   				<a class="button_strip_reply active" href="', $scripturl, '?action=admin;area=seo_warning;killemall">
			   					<span>
			   						', $txt['remove_all'], '
			   					</span>
			   				</a>
			   			</li>
			   		</ul>
			   	</div>
			</div>';
}

function template_seo_cloud()
{
	global $txt, $context, $scripturl, $modSettings;
	
	// Notify!
	if (isset($_GET['hits']))
		echo'
			<div class="windowbg" id="profile_success">
				', $txt['seo_cloud_reset_success'], '
			</div>';
			
	if (isset($_GET['clean']))
	echo'
		<div class="windowbg" id="profile_success">
			', $txt['seo_cloud_clean_success'], '
		</div>';
	
	echo '
	<div id="admincenter">
		<form action="', $scripturl, '?action=admin;area=seo_cloud;save" method="post" accept-charset="', $context['character_set'], '">
			<div class="windowbg">
				<span class="topslice"><span></span></span>
				<div class="content">';
				
				if (!empty($context['popular_tags']))
				{
					echo'
					<h3>
						', $txt['seo_cloud_popular_tags_desc'], ':
					</h3>
					<div style="width: 1000px; overflow: auto;">
						<div id="information"></div>
					</div>
					<script type="text/javascript"><!-- // --><![CDATA[
						arrayOfData = new Array(';
					
						$colors = array('#222222', '#7D252B', '#EB9781', '#FFD2B5', '#4A4147');
						$color = 0;
						$i = 0;
						
						foreach ($context['popular_tags'] as $name => $value)
					  	{
					  		++$i;
					  		
					  		echo' [' . $value . ',\'' . str_replace("'", '&#39;', $name) . '\',\'' . $colors[$color] . '\']';
					  		
					  		++$color;
					  		
					  		if ($i != count($context['popular_tags']))
					  			echo',';
					  			
					  		if ($color == 5)
					  			$color = 0;
					  	}
					  	
					  	echo');
					
						$jnoconflict(\'#information\').jqbargraph({
						  	 data: arrayOfData,';
						
						if (count($context['popular_tags']) / 12 == 0)
						  	echo'width: ' . 1000 * (count($context['popular_tags']) / 13) . ',';
						else
							echo'width: ' . 1000 * (count($context['popular_tags']) / 12) . ',';
						  	 
						echo'
							height: 500
						});
					// ]]></script>
					<hr />';
				}
				
				echo'
					<p>', $txt['seo_cloud_banned'], '</p>';
	
			foreach ($context['banned_tags'] as $tag)
				echo '
					<div style="margin-top: 1ex;"><input type="text" name="bannedtags[]" value="', $tag, '" size="20" /></div>';

	echo '
					<noscript>
						<div style="margin-top: 1ex;"><input type="text" name="bannedtags[]" size="20" class="input_text" /></div>
					</noscript>
					<div id="moreCensoredWords"></div>
					<div style="margin-top: 1ex; display: none;" id="moreCensoredWords_link"><a href="#;" onclick="addNewWord(); return false;">', $txt['seo_tags_clickadd'], '</a></div>
						<script type="text/javascript"><!-- // --><![CDATA[
							document.getElementById("moreCensoredWords_link").style.display = "";

							function addNewWord()
							{
								setOuterHTML(document.getElementById("moreCensoredWords"), \'<div style="margin-top: 1ex;"><input type="text" name="bannedtags[]" size="20" class="input_text" /><\' + \'/div><div id="moreCensoredWords"><\' + \'/div>\');
							}
						// ]]></script>
						<hr width="100%" size="1" class="hrcolor" />
						<dl class="settings">
							<dt>
								<label for="seo_cloud_index_check">', $txt['seo_cloud_index'], ':</label>
							</dt>
							<dd>
								<input type="checkbox" name="seo_cloud_index" value="1" id="seo_cloud_index_check"', empty($modSettings['seo_cloud_index']) ? '' : ' checked="checked"', ' class="input_check" />
							</dd>
							<dt>
								<label for="seo_cloud_boards_check">', $txt['seo_cloud_boards'], ':</label>
							</dt>
							<dd>
								<input type="checkbox" name="seo_cloud_boards" value="1" id="seo_cloud_boards_check"', empty($modSettings['seo_cloud_boards']) ? '' : ' checked="checked"', ' class="input_check" />
							</dd>
							<dt>
								<label for="seo_cloud_topics_check">', $txt['seo_cloud_topics'], ':</label>
							</dt>
							<dd>
								<input type="checkbox" name="seo_cloud_topics" value="1" id="seo_cloud_topics_check"', empty($modSettings['seo_cloud_topics']) ? '' : ' checked="checked"', ' class="input_check" />
							</dd>
						</dl>
						<hr width="100%" size="1" class="hrcolor" />
						<dl class="settings">
							<dt>
								<label for="seo_tag_together_check">', $txt['seo_tag_together'], ':</label>
								<div class="smalltext">', $txt['seo_tag_together_desc'], '</div>
							</dt>
							<dd>
								<input type="checkbox" name="seo_tag_together" value="1" id="seo_tag_together_check"', empty($modSettings['seo_tag_together']) ? '' : ' checked="checked"', ' class="input_check" />
							</dd>
							<dt>
								<label for="seo_tag_together_check">', $txt['seo_tag_only_guests'], ':</label>
							</dt>
							<dd>
								<input type="checkbox" name="seo_tag_only_guests" value="1" id="seo_tag_only_guests_check"', empty($modSettings['seo_tag_only_guests']) ? '' : ' checked="checked"', ' class="input_check" />
							</dd>
							<dt>
								<label for="seo_tag_min_check">', $txt['seo_tag_min'], ':</label>
								<div class="smalltext">', $txt['seo_tag_min_desc'], '</div>
							</dt>
							<dd>
								<input type="text" size="5" name="seo_tag_min" id="seo_tag_min_check"', empty($modSettings['seo_tag_min']) ? '' : ' value="' . $modSettings['seo_tag_min'] . '"', ' />
							</dd>
							<dt>
								<label for="seo_tag_max_check">', $txt['seo_tag_max'], ':</label>
								<div class="smalltext">', $txt['seo_tag_max_desc'], '</div>
							</dt>
							<dd>
								<input type="text" size="5" name="seo_tag_max" id="seo_tag_max_check"', empty($modSettings['seo_tag_max']) ? '' : ' value="' . $modSettings['seo_tag_max'] . '"', ' />
							</dd>
							<dt>
								<label for="seo_cloud_reset_check">', $txt['seo_cloud_reset'], ':</label>
							</dt>
							<dd>
								<input type="checkbox" name="seo_cloud_reset" value="1" id="seo_cloud_reset_check" class="input_check" onclick="return document.getElementById(\'seo_cloud_reset_check\').checked ? confirm(\'' . $txt['seo_cloud_reset_confirm'] . '\') : true;" />
							</dd>
							<dt>
								<label for="seo_cloud_clean_check">', $txt['seo_cloud_clean'], ':</label>
							</dt>
							<dd>
								<input type="checkbox" name="seo_cloud_clean" value="1" id="seo_cloud_clean_check" class="input_check" onclick="return document.getElementById(\'seo_cloud_clean_check\').checked ? confirm(\'' . $txt['seo_cloud_clean_confirm'] . '\') : true;" />
							</dd>
						</dl>
						<input type="submit" name="save_censor" value="', $txt['save'], '" class="button_submit" />
				</div>
				<span class="botslice"><span></span></span>
			</div>
			<input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '" />
		</form>
	</div>
	<br class="clear" />';
}

function template_seo_cloud_popular_tags()
{
	global $txt, $context, $scripturl, $modSettings;
	
	echo'
		<div class="windowbg">
			<span class="topslice"><span></span></span>
				<div class="content">';
	
	if (!empty($context['popular_tags']))
	{
		echo'
		<h3>
			', $txt['seo_cloud_popular_tags_desc'], ':
		</h3>
		<div style="width: 1000px; overflow: auto;">
			<div id="information"></div>
		</div>
		<script type="text/javascript"><!-- // --><![CDATA[
			arrayOfData = new Array(';
		
			$colors = array('#222222', '#7D252B', '#EB9781', '#FFD2B5', '#4A4147');
			$color = 0;
			$i = 0;
			
			foreach ($context['popular_tags'] as $name => $value)
		  	{
		  		++$i;
		  		
		  		echo' [' . $value . ',\'' . str_replace("'", '&#39;', $name) . '\',\'' . $colors[$color] . '\']';
		  		
		  		++$color;
		  		
		  		if ($i != count($context['popular_tags']))
		  			echo',';
		  			
		  		if ($color == 5)
		  			$color = 0;
		  	}
		  	
		  	echo');
		
			$jnoconflict(\'#information\').jqbargraph({
			  	 data: arrayOfData,';
			
			if (count($context['popular_tags']) / 12 == 0)
			  	echo'width: ' . 1000 * (count($context['popular_tags']) / 13) . ',';
			else
				echo'width: ' . 1000 * (count($context['popular_tags']) / 12) . ',';
			  	 
			echo'
				height: 500
			});
		// ]]></script>
		<hr />';
	}
	else
		echo'
			<div align="center">
				', $txt['seo_cloud_popular_tags_none'], '
			</div>';
	
	echo'
				</div>
			<span class="botslice"><span></span></span>
		</div>';
	
	echo'
		<br class="clear" />';
}

function template_sitemap_style()
{
	global $txt, $mbname;
			
	echo'<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet 
  version="1.0"
  xmlns:sm="http://www.sitemaps.org/schemas/sitemap/0.9"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
  xmlns:fo="http://www.w3.org/1999/XSL/Format"
  xmlns="http://www.w3.org/1999/xhtml">
    <xsl:output method="html" indent="yes" encoding="UTF-8"/>
    <xsl:template match="/">
        <html>
            <head>
                <title>', sprintf($txt['seo_sitemap_xml_title'], $mbname), '</title>
                <style type="text/css">
                body
                {
                        background-color: #e0e0e0;
                        margin: 0;
                        text-align: center;
                        font-family: Helvetica, Arial, sans-serif;
                        
                }
                .content
                {
                        border: 1px solid #b5b5b5;
                        margin: 10px auto;
                        width: 80%;
                        text-align:left;
                        -moz-border-radius:5px;
                        -webkit-border-radius:5px;
                        border-top-left-radius:5px;
                        background-color: #fff;
                }
                a:link
                {
                        color: #0180AF;
                        text-decoration: none;
                }
                a:visited
                {
                        color: #0180AF;
                        text-decoration: underline;
                }
                h1
                {
                        background-color: #8F8D8D;
                        padding: 8px;
                        color: #fff;
                        text-align: left;
                        font-size: 20px;
                        margin: 0px;
                        -moz-border-radius-topleft:5px;
                        -moz-border-radius-topright:5px;
                        -webkit-border-top-left-radius:5px;
                        -webkit-border-top-right-radius:5px;
                        border-top-left-radius:5px;
                        border-top-right-radius:5px;
                }
                h3
                {
                        font-size: 12px;
                        margin: 0px;
                        padding: 5px;
                        font-weight: normal;
                }
                table
                {
                	overflow: hidden;
                }
                th
                {
                        text-align: center;
                        background: #e0e0e0;
                        color: #000;
                        padding: 4px;
                        font-weight: normal;
                        font-size: 12px;
                        text-align: left;
                        font-family: Helvetica, Arial, sans-serif;
                }
                td
                {
                        font-size:12px;
                        font-family: Helvetica, Arial, sans-serif;
                        padding:6px 4px;
                        text-align:left;
                        overflow: hidden;
                        color: #8F8D8D;
                }
                td a
                {
                	color: #8F8D8D;
                	text-decoration: none;
                }
                td a:visited
                {
                	color: #8F8D8D;
                }
                tr
                {
                    background: #fff;
                }
                tr:nth-child(odd)
                {
                	background: #EBEBEB;
                }
                .footer
                {
                        background:#8F8D8D;
                        color: #fff;
                        padding:5px;
                        -moz-border-radius-bottomleft:5px;
                        -moz-border-radius-bottomright:5px;
                        -webkit-border-bottom-left-radius:5px;
                        -webkit-border-bottom-right-radius:5px;
                        border-bottom-left-radius:5px;
                        border-bottom-right-radius:5px;
                        font-size: 12px;
                }
                .footer a
                {
                	color: #fff;
                }
                .changefreq
                {
                	text-align: center;
                }
                </style>
            </head>
            <body>
                <div class="content">
                    <h1>', sprintf($txt['seo_sitemap_xml_title'], $mbname), '</h1>
                    <h3>
                        <xsl:choose>
                            <xsl:when test="sm:sitemapindex"> 
                                ', $txt['seo_sitemap_number_sitemap'], ': <xsl:value-of select="count(sm:sitemapindex/sm:sitemap)"/>
                            </xsl:when>
                            <xsl:otherwise> 
                                ', $txt['seo_sitemap_number_urls'], ': <xsl:value-of select="count(sm:urlset/sm:url)"/>
                            </xsl:otherwise>
                        </xsl:choose>
                    </h3>
                    <xsl:apply-templates/>
                    <div class="footer">
                    	<a href="http://www.smfpacks.com/">
                    		Created by SMFPacks SEO Pro Mod
                    	</a>
                    </div>
                </div>
            </body>
        </html>
    </xsl:template>
    <xsl:template match="sm:sitemapindex">
        <table cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <th>', $txt['seo_sitemap_url'], '</th>
                <th />
                <th>', $txt['seo_sitemap_last'], '</th>
            </tr>
            <xsl:for-each select="sm:sitemap">
                <tr>
                    <xsl:variable name="loc">
                        <xsl:value-of select="sm:loc" />
                    </xsl:variable>
                    <xsl:variable name="lastmodified">
                        <xsl:value-of select="sm:lastmodified"/>
                    </xsl:variable>
                    <td><a href="{$loc}"><xsl:value-of select="sm:loc"/></a></td>
                    <td><xsl:value-of select="sm:lastmodified"/></td>
                    <xsl:apply-templates/>
                </tr>
            </xsl:for-each>
        </table>
    </xsl:template>
    <xsl:template match="sm:urlset">
        <table cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <th width="5%" />
                <th width="50%">', $txt['seo_sitemap_url'], '</th>
                <th width="20%">', $txt['seo_sitemap_last'], '</th>
                <th width="15%" class="changefreq">', $txt['seo_sitemap_change'], '</th>
                <th width="10%" class="changefreq">', $txt['seo_sitemap_priority'], '</th>
            </tr>
            <xsl:for-each select="sm:url">
                <tr>
                    <xsl:variable name="loc">
                        <xsl:value-of select="sm:loc"/>
                    </xsl:variable>
          			<xsl:variable name="priority">
                        <xsl:value-of select="sm:priority"/>
                    </xsl:variable>
                    <xsl:variable name="lastmodified">
                        <xsl:value-of select="sm:lastmodified"/>
                    </xsl:variable>
                    <xsl:variable name="changefreq">
                        <xsl:value-of select="sm:changefreq"/>
                    </xsl:variable>
                    <xsl:variable name="pos">
                            <xsl:value-of select="position()"/>
                    </xsl:variable>
		    <td><xsl:value-of select="$pos"/></td>
                    <td><div class="overflow"><a href="{$loc}" target="_blank"><xsl:value-of select="sm:loc"/></a></div></td>
                    <xsl:apply-templates/>
                </tr>
            </xsl:for-each>
        </table>
    </xsl:template>
    <xsl:template match="sm:loc|image:image">
    </xsl:template>
    <xsl:template match="sm:lastmod">
    <td>
    	<xsl:apply-templates/>
    </td>
    </xsl:template>
    <xsl:template match="sm:changefreq|sm:priority">
    <td class="changefreq">
    	<xsl:apply-templates/>
    </td>
    </xsl:template>
</xsl:stylesheet>';

	die();
}

function template_seo_view_tag()
{
	global $context, $tag, $txt;
	
	echo'
		<div class="cat_bar">
			<h3 class="catbg">
				', $context['page_title'], '
			</h3>
		</div>
		<div class="windowbg">
			<span class="topslice"><span></span></span>
				<div class="content">';
	
	if (empty($context['results']))
		echo'
			<div align="center">
				', $txt['seo_cloud_popular_tags_none'], '
			</div>';
	else
	{
		echo'
			<ul class="left_admmenu">';
			
		foreach($context['results'] as $result)
		{
			echo'
				<li>
					', $result['area'], ' (', $result['hits'], ' ', ($result['hits'] > 1 ? $txt['seo_tag_cloud_hits'] : $txt['seo_tag_cloud_hit']), ')
				</li>
				<li>
					&nbsp;
				</li>';
		}
		
		echo'
			</ul>';
	}
		
	echo'
				</div>
			<span class="botslice"><span></span></span>
		</div>
		<div align="center">
			<a href="javascript:history.go(-1)">
				', $txt['back'], '
			</a>
		</div>
		<br class="clear" />';
}

function template_pretty_test_changes()
{
	global $tests, $context, $txt, $scripturl;
	
	echo'
	<form action="', $scripturl, '?action=admin;area=seo_settings;sa=seo_settings;confirmpretty" method="post" accept-charset="UTF-8">
		<div class="cat_bar">
			<h3 class="catbg">
				', $txt['confirm_pretty_changes'], '
			</h3>
		</div>
		<div class="description alert">
			', $txt['confirm_pretty_changes_desc'], '
		</div>
		<div class="windowbg">
			<span class="topslice"><span></span></span>
				<div class="content">';
		
			foreach ($tests as $test)
				echo'
					<div>
						', str_replace('<a', '<a target="_blank"', $test), '
					</div>';
			
	echo'
					<hr class="hrcolor clear">
					<div class="righttext">
						<input type="submit" value="', $txt['repair_attachments_cancel'], '" class="button_submit" name="cancel" onclick="return confirm(', JavascriptEscape($txt['pretty_cancel_submit']), ');" />
						<input type="submit" value="', $txt['save'], '" class="button_submit" name="save" onclick="return confirm(', JavascriptEscape($txt['pretty_confirm_submit']), ');" />
					</div>
				</div>
			<span class="botslice"><span></span></span>
		</div>
	</form>';
}