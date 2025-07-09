<?php

/*******************************************************************************
 * Hide Message Icons
 *
 * A modification for SMF 2.1 that hides the message icon feature.
 *
 * Copyright (c) 2019 Jon Stovell
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 ******************************************************************************/

if (!defined('SMF'))
	die('No direct access...');

/**
 * Removes the icon select menu from the posting header.
 *
 * Called by:
 * 		integrate_post_end
 */
function hide_message_icons_select()
{
	global $context;

	unset($context['posting_fields']['icon']);
}

/**
 * Blanks out and hides the icons on the message index.
 *
 * CSS targets blank.png specifically in order to avoid hiding any other images,
 * e.g. the watched topic and participation icons.
 *
 * Called by:
 * 		integrate_messageindex_buttons
 */
function hide_message_icons_messageindex(&$normal_buttons)
{
	global $context, $settings;

	// Use blank image (except for poll, moved, and recycled)
	foreach ($context['topics'] as $id => $topic)
	{
		if (!in_array($context['topics'][$id]['first_post']['icon'], array('poll', 'moved', 'recycled')))
		{
			$context['topics'][$id]['icon_url'] = $settings['default_images_url'] . '/blank.png';
			$context['topics'][$id]['first_post']['icon_url'] = $settings['default_images_url'] . '/blank.png';
		}

		$context['topics'][$id]['last_post']['icon_url'] = $settings['default_images_url'] . '/blank.png';
	}

	addInlineCSS('.board_icon img[src$="blank.png"] {display: none;}');
}

/**
 * Hides the .messageicon span in the topic display
 *
 * Called by:
 * 		integrate_display_topic
 */
function hide_message_icons_display_topic(&$topic_selects, &$topic_tables, &$topic_parameters)
{
	addInlineCSS('.messageicon {display: none;}');
}

/**
 * Blanks out the icon for each message in the topic display, in case hiding the
 * whole .messageicon span fails for some reason
 *
 * Called by:
 * 		integrate_prepare_display_context
 */
function hide_message_icons_display_context(&$output, &$message, $counter)
{
	global $settings;

	$output['icon_url'] = $settings['default_images_url'] . '/blank.png';
}
