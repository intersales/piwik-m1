<?php
	/**
	 * Ajax Controller
	 *
	 * @category   Intersales
	 * @package    Intersales_Piwik
	 * @author     Daniel Rose <dr@intersales>
	 */
	class Intersales_Piwik_AjaxController extends Mage_Core_Controller_Front_Action {
		/**
		 * Hide action
		 */
		public function hideAction() {
			Mage::getModel('core/cookie')->set('hide_piwik_notice', true, true);
		}
	}