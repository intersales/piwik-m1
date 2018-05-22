<?php
    class Intersales_Piwik_Block_Widget_Optout extends Mage_Core_Block_Template implements Mage_Widget_Block_Interface {
		/**
         * Init
         */
        protected function _construct() {
            $this->setTemplate('intersales/piwik/widget/optout.phtml');
        }

        /**
         * Can show
         * @return bool
         */
        public function canShow() {
            $hidePiwiNotice = Mage::getModel('core/cookie')->get('hide_piwik_notice');
            return !$hidePiwiNotice && Mage::helper('intersales_piwik')->isEnabled();;
        }

        /**
         * Retrieve piwik url
         * @return string
         */
        public function getPiwikUrl() {
            return Mage::app()->getStore()->isCurrentlySecure() ? 'https:' : 'http:' . Mage::helper('intersales_piwik')->getRelativePiwikUrl();
        }

        /**
         * Retrieve site id
         * @return string
         */
        public function getSiteId() {
            return Mage::helper('intersales_piwik')->getSiteId();
        }

        public function getModuleParam() {
            if($this->getData('use_custom_opt_out') == 1) {
                return 'CustomOptOut';
            } else {
                return 'CoreAdminHome';
            }
        }
    }