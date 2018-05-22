<?php
    /**
     * Topbottom Source Model
     *
     * @category   Intersales
     * @package    Intersales_Piwik
     * @author     Daniel Rose <dr@intersales>
     */
    class Intersales_Piwik_Model_Adminhtml_System_Config_Source_Topbottom {
        const TOP = 0;
        const BOTTOM = 1;

        /**
         * Options getter
         *
         * @return array
         */
        public function toOptionArray() {
            return array(
                array(
                    'value' => 0,
                    'label'=>Mage::helper('intersales_piwik')->__('Top')
                ), array(
                    'value' => 1,
                    'label'=>Mage::helper('intersales_piwik')->__('Bottom')
                )
            );
        }

        /**
         * Get options in "key-value" format
         *
         * @return array
         */
        public function toArray() {
            return array(
                0 => Mage::helper('intersales_piwik')->__('Top'),
                1 => Mage::helper('intersales_piwik')->__('Bottom'),
            );
        }
    }