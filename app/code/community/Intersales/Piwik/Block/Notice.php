<?php
	/**
	 * Notice Block
	 *
	 * @category   Intersales
	 * @package    Intersales_Piwik
	 * @author     Daniel Rose <dr@intersales>
	 */
	class Intersales_Piwik_Block_Notice extends Mage_Core_Block_Template {
		const XML_PATH_NOTICE_ACTIVE = 'intersales_piwik/notice/active';
		const XML_PATH_NOTICE_CONTENT = 'intersales_piwik/notice/content';
		const XML_PATH_NOTICE_LINK_TEXT = 'intersales_piwik/notice/link_text';
		const XML_PATH_NOTICE_LINK_TARGET = 'intersales_piwik/notice/link_target';
		const XML_PATH_NOTICE_CMS_OPTOUT = 'intersales_piwik/notice/cms_optout';
        const XML_PATH_NOTICE_POSITION = 'intersales_piwik/notice/position';

		/**
		 * Can show
		 * @return bool
		 */
		public function canShow() {
			$hidePiwiNotice = Mage::getModel('core/cookie')->get('hide_piwik_notice');

			return !$hidePiwiNotice
				&& Mage::helper('intersales_piwik')->isEnabled()
				&& Mage::getStoreConfig(self::XML_PATH_NOTICE_ACTIVE) == 1;
		}

		/**
		 * Retrieve content
		 * @return mixed
		 */
		public function getContent() {
            $content = Mage::getStoreConfig(self::XML_PATH_NOTICE_CONTENT);
            $optOutUrl = Mage::getUrl(Mage::getStoreConfig(self::XML_PATH_NOTICE_CMS_OPTOUT));
            $linkText = Mage::getStoreConfig(self::XML_PATH_NOTICE_LINK_TEXT);
			$linkTarget = Mage::getStoreConfig(self::XML_PATH_NOTICE_LINK_TARGET);


            $tmp = str_replace('###LINK###','<a href="' . $optOutUrl . '" target="' . $linkTarget . '">' . $linkText . '</a>', $content);

            if($tmp != '') {
                $content = $tmp;
            } else {
                $content .= ' <a href="' . $optOutUrl . '" target="' . $linkTarget . '">' . $linkText . '</a>';
            }

			return $content;
		}

		/**
		 * Retrieve ajax hide url
		 * @return string
		 */
		public function getAjaxHideUrl() {
			return $this->getUrl('intersales_piwik/ajax/hide');
		}

        /**
         * Retrieve css class
         * @return string
         */
        public function getCssClass() {
            $cssClass = 'bottom';
            $position = Mage::getStoreConfig(self::XML_PATH_NOTICE_POSITION);

            if($position == Intersales_Piwik_Model_Adminhtml_System_Config_Source_Topbottom::TOP) {
                $cssClass = 'top';
            }

            return $cssClass;
        }

		/**
		 * Get block cache life time
		 *
		 * @return null
		 */
		public function getCacheLifetime() {
			return null;
		}
	}