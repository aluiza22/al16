<?php
/**
* Shipping attributes installer
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

$installer = $this;
$installer->startSetup();
//Categories typically only have one attribute set, this will retrieve its ID
$setId = Mage::getSingleton('eav/config')->getEntityType('catalog_category')
->getDefaultAttributeSetId();
//Add group to entity & set
$installer->addAttributeGroup('catalog_category', $setId, 'Category Shipping');
$installer->addAttribute(
    "catalog_category",
    "shipping_price",
    array (
    "group" => 'Category Shipping',
    "type" => "text",
    "backend" => "",
    "frontend" => "",
    "label" => "Category Shipping Price",
    "input" => "text",
    "class" => "",
    "source" => "",
    "global" => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
    "visible" => true,
    "required" => false,
    "user_defined" => false,
    "default" => "",
    "searchable" => false,
    "filterable" => false,
    "comparable" => false,
    "visible_on_front" => false,
    "unique" => false,
    "note" => "Flat Rate Shipping  for the  Category" 
    )
);
$installer->endSetup();
$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();

// the attribute added will be displayed under the Genral TAB
$setup->addAttribute(
    'catalog_product',
    'product_shipping',
    array (
    'group' => 'General',
    'input' => 'text',
    'type' => 'text',
    'label' => 'Product Shipping',
    'backend' => '',
    'visible' => 1,
    'required' => 0,
    'user_defined' => 1,
    'searchable' => 0,
    'filterable' => 0,
    'comparable' => 0,
    'visible_on_front' => 1,
    'visible_in_advanced_search' => 0,
    'is_html_allowed_on_front' => 1,
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL 
    )
);
$installer->endSetup();
