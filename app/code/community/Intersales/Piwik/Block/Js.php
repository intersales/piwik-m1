<?php
    /**
     * Js Block
     *
     * @category   Intersales
     * @package    Intersales_Piwik
     * @author     Daniel Rose <dr@intersales>
     */
    class Intersales_Piwik_Block_Js extends Mage_Core_Block_Template {
        /**
         * Can show
         * @return mixed
         */
        public function canShow() {
            return Mage::helper('intersales_piwik')->isEnabled();
        }

        /**
         * Retrieve site id
         * @return mixed
         */
        public function getSiteId() {
            return Mage::helper('intersales_piwik')->getSiteId();
        }

        /**
         * Retrieve relative piwik url
         * @return mixed|string
         */
        public function getRelativePiwikUrl() {
            return Mage::helper('intersales_piwik')->getRelativePiwikUrl();
        }

		/**
		 * Retrieve piwik url
		 * @return string
		 */
		public function getPiwikUrl() {
			$useHttps = Mage::app()->getStore()->isCurrentlySecure();
			$relativePiwikUrl = Mage::helper('intersales_piwik')->getRelativePiwikUrl();
			$piwikUrl = $useHttps ? 'https:' . $relativePiwikUrl : 'http:' . $relativePiwikUrl;

			return $piwikUrl;
		}

		/**
		 * Retrieve js code for product view
		 * @return string
		 */
		public function getJsCodeForProductView() {
			$currentProduct = Mage::registry('current_product');

			if(!($currentProduct instanceof Mage_Catalog_Model_Product))
				return '';

			$sku = $currentProduct->getSku();
			$name = $currentProduct->getName();
			$price = $currentProduct->getFinalPrice();

			return '_paq.push([\'setEcommerceView\', \'' . $sku . '\', \'' . $name . '\', false, ' . $price . ']);' . "\n";
		}

		/**
		 * Retrieve js code for category view
		 * @return string
		 */
		public function getJsCodeForCategoryView() {
			$currentCategory = Mage::registry('current_category');

			if(!($currentCategory instanceof Mage_Catalog_Model_Category))
				return '';

			$name = $currentCategory->getName();

			return '_paq.push([\'setEcommerceView\', false, false, \'' . $name . '\']);' . "\n";
		}

		/**
		 * Retrieve js code for success page
		 * @return string
		 */
		public function getJsCodeForSuccessPage() {
			$originalPathInfo = $this->getRequest()->getOriginalPathInfo();

			if($originalPathInfo == '/checkout/onepage/success/') {
				$lastOderId = Mage::getSingleton('checkout/session')->getLastOrderId();

				if(!$lastOderId)
					return '';

				$order = Mage::getModel('sales/order')->load($lastOderId);
				$result = array();

				foreach ($order->getAllVisibleItems() as $item) {
					$result[] = sprintf('_paq.push([\'addEcommerceItem\', \'%s\', \'%s\', \'%s\', %s, %s]);',
						$this->jsQuoteEscape($item->getSku()),
						$this->jsQuoteEscape($item->getName()),
						'',
						$item->getBaseRowTotalInclTax(),
						$item->getQtyOrdered()
					);
				}

				/** var $order Mage_Sales_Model_Order */

				$result[] = sprintf('_paq.push([\'trackEcommerceOrder\', \'%s\', %s, %s, %s, %s]);',
					$order->getIncrementId(),
					$order->getBaseGrandTotal(),
					$order->getBaseSubtotalInclTax(),
					$order->getBaseTaxAmount(),
					$order->getBaseShippingInclTax(),
					$order->getBaseDiscountAmount()
				);

				return implode("\n", $result);
			}

			return '';
		}

		public function getJsCodeForSearchResult() {
			$jsCode = '';
			$originalPathInfo = $this->getRequest()->getOriginalPathInfo();

			if($originalPathInfo == '/catalogsearch/result/') {
				$queryText = Mage::helper('catalogsearch')->getQuery()->getQueryText();
				$numberOfResults = Mage::helper('catalogsearch')->getQuery()->getNumResults();

				//$jsCode = '_paq.push([\'setCustomUrl\', document.URL + \'&search_count=' . $numberOfResults . '\']);' . "\n";
				$jsCode = '_paq.push([\'trackSiteSearch\', \'' . $queryText . '\', null, ' . $numberOfResults . ']);' . "\n";
			}

			return $jsCode;
		}

		public function getJsCodeFor404Page() {
			$jsCode = '';
			$actionName = Mage::app()->getRequest()->getActionName();

			if($actionName == 'noRoute') {
				$jsCode = '_paq.push([\'setDocumentTitle\', \'404/URL = \' + String(document.location.pathname+document.location.search).replace(/\//g,\'%2f\') + \'/From = \' + String(document.referrer).replace(/\//g, \'%2f\')]);' . "\n";
			}

			return $jsCode;
		}
    }