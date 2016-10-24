<?php
/**
* Shipping defination and calculator
*
* PHP version 5.4.7
*
* @category  A3logics
* @package   A3logics_CPshipping
* @author    a3logics <manish.mittal2@a3logics.in>
* @copyright 2014 A3logics
* @license   http://www.php.net/license/3_01.txt  PHP License 3.01
* @link      http://homeurl/Cpshopping.php
* @return    shipping value
*/

/**
* A3logics_CPshipping_Model_Carrier_Cpshipping.
*
* Checks that the opening brace of a function is on the line after the
* function declaration.
*
* @category  A3logics
* @package   A3logics_CPshipping
* @author    a3logics <manish.mittal2@a3logics.in>
* @copyright 2014 A3logics
* @license   http://www.php.net/license/3_01.txt  PHP License 3.01
* @version   Release: 1.0.0
* @link      http://homeurl/Cpshopping.php
*/

class A3logics_CPshipping_Model_Carrier_Cpshipping
extends Mage_Shipping_Model_Carrier_Abstract
implements Mage_Shipping_Model_Carrier_Interface
{
    
    // @codingStandardsIgnoreStart
	protected $_code = 'cpshipping';
	// @codingStandardsIgnoreEnd
    /** 
    * Collect rates for this shipping method based on information in request 
    * 
    * @param Mage_Shipping_Model_Rate_Request $request Requested product data
    * 
    * @return Mage_Shipping_Model_Rate_Result 
    */
    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        $shippingCarrierTitle =  $this->getConfigData('title');
        if (!isset($shippingCarrierTitle) || $shippingCarrierTitle=='') {
            $shippingCarrierTitle = 'My Shipping Title';
        }
        $methodTitle =  $this->getConfigData('method_title');
        if (!isset($methodTitle) || $methodTitle=='') {
            $methodTitle = 'My Shipping Name';
        }
        $defaultShipping = $this->getConfigData('shipping_rate');
        //Default Shipping Rate defined in admin setting
        $shippingaction = $this->getConfigData('shipping_action');
        // shipping_action Defined in setting: product shipping or category shipping
        $qtyBasedShipping = $this->getConfigData('shippingaction_type');
        //1=>Yes multiply with qty, 0=> not depned on qty
        $finalShippingPrice = 0; //Final Shipping which implement on order
        $cartProductQty = Mage::getSingleton('checkout/cart')->getItemsCount();
        if ($request->getAllItems()) {
            foreach ($request->getAllItems() as $item) {
                $orderProductQty = $item->getQty();
                if ($item->getProduct()->isVirtual() || $item->getParentItem()) {
                    continue;
                }
                if ($item->getHasChildren()) {
                    $productSku = $item->getProduct()->getData('sku');
                } else {
                    $productSku = $item->getSku();
                }
                $finalShippingPrice = $this->calculateshipping(
                    $shippingaction,
                    $defaultShipping,
                    $orderProductQty,
                    $qtyBasedShipping,
                    $finalShippingPrice,
                    $productSku
                );
            }
        }
        if (isset($finalShippingPrice) && $finalShippingPrice == 0) {
        } else if (isset($finalShippingPrice)
            && ($finalShippingPrice < 0 || $finalShippingPrice=='')
        ) {
            if (isset($defaultShipping) && $defaultShipping != 0) {
                if ($qtyBasedShipping == 1) {
                    //Multiply with qty of product
                    $finalShippingPrice += $defaultShipping * $cartProductQty;
                } else {
                    //Not depend on qty of product
                    $finalShippingPrice += (float)$defaultShipping;
                }
            }
        }
        if ($request->getFreeShipping() === true) {
            $finalShippingPrice = '0.00';
        }
        $result = Mage::getModel('shipping/rate_result');
        $method = Mage::getModel('shipping/rate_result_method');
        $method->setCarrier($this->_code);
        $method->setCarrierTitle($shippingCarrierTitle);
        $method->setMethod($this->_code);
        $method->setMethodTitle($methodTitle);
        $method->setPrice($finalShippingPrice);
        //$method->setCost($this->getConfigData('shipping_rate'));
        $result->append($method);
        return $result;
    }
    /**
    * get calculateshipping Details
    * 
    * @param string  $shippingaction     shipping type product or category
    * @param float   $defaultShipping    Define default shipping
    * @param integer $orderProductQty    Total qty of product
    * @param boolean $qtyBasedShipping   Setting for multiplication with qty
    * @param float   $finalShippingPrice Total calculated shipping
    * @param string  $productSku         Product Sku
    * 
    * @author A3logics
    * @return $finalShippingPrice
    */
    public function calculateshipping(
        $shippingaction,
        $defaultShipping,
        $orderProductQty,
        $qtyBasedShipping,
        $finalShippingPrice,
        $productSku
    ) {
        $_product = Mage::getModel('catalog/product')
        ->loadByAttribute('sku', $productSku);
        $cartProductCatId = $_product->getCategoryIds();
        $pData = $_product->getData();
        $shipPrice = '';
        if ($shippingaction == 'product') {
            $shipPrice = $pData['product_shipping'];
        } else {
            $catshipPrice = 0;
            foreach ($cartProductCatId as $categoryID) {
                $categoryData = Mage::getModel("catalog/category")
                ->load($categoryID);
                $cateShippingPrice = $categoryData['shipping_price'];
                if (isset($cateShippingPrice) && $cateShippingPrice!='') {
                    if ($cateShippingPrice  >= $catshipPrice) {
                        // Set heighst shipping price if more than two categories
                        $shipPrice = $cateShippingPrice;
                    }
                }
            }
        }
        if ((isset($shipPrice) && $shipPrice == '') || (!isset($shipPrice))) {
            $shipPrice = $defaultShipping;
        }
        if ($qtyBasedShipping == 1) {
            //Multiply with qty of product
            $finalShippingPrice += (float)$shipPrice * $orderProductQty;
        } else {
            //Not depend on qty of product
            $finalShippingPrice += (float)$shipPrice;
        }
        return $finalShippingPrice;
    }
    /**
    * Get allowed shipping methods
    *
    * @return array
    */
    public function getAllowedMethods()
    {
        return array($this->_code=>$this->getConfigData('name'));
    }
} 
