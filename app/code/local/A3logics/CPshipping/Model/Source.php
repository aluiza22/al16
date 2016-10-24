<?php
/**
* Create custom dropdown in admin shipping setting
*
* PHP version 5.4.7
*
* @category  A3logics
* @package   A3logics_CPshipping
* @author    a3logics <manish.mittal2@a3logics.in>
* @copyright 2014 A3logics
* @license   http://www.php.net/license/3_01.txt  PHP License 3.01
* @link      http://homeurl/Cpshopping.php
*/

/**
* A3logics_CPshipping_Model_Source.
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
class A3logics_CPshipping_Model_Source
{
    /** 
    * 
    * Create array for dropdown
    * @return array
    */
    public function toOptionArray()
    {
        return array(
               array('value' => 'product', 'label' =>'Product Shipping'),
               array('value' => 'category', 'label' => 'Category Shipping'),
               );
    }
}

