<?php
	/**
	 * Default Helper
	 *
	 * @category   Intersales
	 * @package    Intersales_Piwik
	 * @author     Daniel Rose <dr@intersales>
	 */
	class Intersales_Piwik_Helper_Data extends Mage_Core_Helper_Abstract {
        const XML_PATH_GENERAL_ACTIVE = 'intersales_piwik/general/active';
        const XML_PATH_GENERAL_SITE_ID = 'intersales_piwik/general/site_id';
        const XML_PATH_GENERAL_URL = 'intersales_piwik/general/relative_url';

        /**
         * Is module enabled
         *
         * @param null $store
         * @return bool
         */
        public function isEnabled($store = null) {
            return Mage::getStoreConfig(self::XML_PATH_GENERAL_ACTIVE, $store) == 1;
        }

        /**
         * Retrieve site id
         * @param null $store
         * @return mixed
         */
        public function getSiteId($store = null) {
            return Mage::getStoreConfig(self::XML_PATH_GENERAL_SITE_ID, $store);
        }

        /**
         * Retrieve relative piwik url
         * @param null $store
         * @return mixed|string
         */
        public function getRelativePiwikUrl($store = null) {
            return Mage::getStoreConfig(self::XML_PATH_GENERAL_URL, $store);
        }
    }