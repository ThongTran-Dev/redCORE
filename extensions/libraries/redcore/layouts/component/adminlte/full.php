<?php
/**
 * @package     RedCORE.AdminLTE.Backend
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2008 - 2015 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;
?>
<div class="redcore">
	<div class="wrapper">
		<header class="main-header">
			<?php echo RLayoutHelper::render('component.adminlte.header', array()); ?>
		</header>
		<aside class="main-sidebar">
			<?php echo RLayoutHelper::render('component.adminlte.sidebar', array()); ?>
		</aside>
		<div class="content-wrapper">
			<section class="content-header clearfix">
				<?php echo RLayoutHelper::render('component.adminlte.content.header', $displayData); ?>
			</section>
			<section class="content">
				<?php echo RLayoutHelper::render('component.adminlte.content.body', $displayData); ?>
			</section>
		</div>
		<footer class="main-footer">
			<?php echo RLayoutHelper::render('component.adminlte.content.footer', $displayData); ?>
		</footer>
	</div>
</div>
