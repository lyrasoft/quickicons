<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	mod_quickicon
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

$doc = JFactory::getDocument();
JHtml::_('behavior.modal');

$doc->addStyleSheet('modules/mod_akquickicons/css/akquickicons.css');

$tabs = count($buttons) > 1 ? true : false ;

$keys = array_keys($buttons);
$uniqid = uniqid();

ModAkquickiconsHelper::loadFontAwesome();
?>
<style type="text/css">
	.pane-sliders .panel .tabs h3 {
		background-color: transparent ;
	}
</style>
<?php if (!empty($buttons)): ?>

	<!-- Icons -->	
	<?php echo $tabs ? JHtmlBootstrap::startTabSet('iconTab-' . $uniqid, array('active' => 'tab-' . $uniqid . '-'.$keys[0])) : null ; ?>
	
	<?php foreach( $buttons as $key => $group ): ?>
		
		<?php echo $tabs ? JHtmlBootstrap::addTab('iconTab-' . $uniqid, 'tab-' . $uniqid . '-'.$key, $group[0]['cat_title']) : null ;?>
		<div class="cpanel akicon-module">
			<?php foreach( $group as $button ): ?>
			<div class="<?php echo (JVERSION >= 3) ? '' : 'icon-wrapper'; ?>">
				<div class="icon <?php echo $button['class']?>" id="<?php echo JArrayHelper::getValue($button, 'id'); ?>">
					<a href="<?php echo $button['link']; ?>"
						class="<?php echo $button['params']->get('target') == 'modal' ? 'modal' : ''; ?>"
						target="<?php echo $button['params']->get('target') == 'blank' ? '_blank' : '_self'; ?>"
					>
						<?php echo ModAkquickiconsHelper::getButtonImage($button); ?>
						<div>
							<span><?php echo $button['text']; ?></span>
						</div>
					</a>
				</div>
			</div>
			<?php endforeach; ?>
			<div class="clearfix"></div>
		</div>
		<div class="clr"></div>
		<?php echo $tabs ? JHtmlBootstrap::endTab() : null ; ?>
		
	<?php endforeach; ?>
	
	<?php echo $tabs ? JHtmlBootstrap::endTabSet() : null ; ?>
	
<?php endif;?>
<div class="clearfix clr"></div>