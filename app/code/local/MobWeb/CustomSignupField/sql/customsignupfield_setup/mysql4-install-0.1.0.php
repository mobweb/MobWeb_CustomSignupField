<?php

/*
 *
 * Create the attribute in the DB using the installer
 *
 */
$installer = $this;
$installer->startSetup();
$this->addAttribute('customer', 'signup_code', array(
    'type' => 'varchar',
    'input' => 'text',
    'label' => 'Signup Code',
    'global' => 1,
    'visible' => 1,
    'required' => 0,
    'user_defined' => 1,
    'default' => null,
    'visible_on_front' => 1
));

$customer = Mage::getModel('customer/customer');
$attrSetId = $customer->getResource()->getEntityType()->getDefaultAttributeSetId();
$this->addAttributeToSet('customer', $attrSetId, 'General', 'signup_code');

$installer->endSetup();

/*
 *
 * After the attribute has been installed in the DB, force its display on the
 * relevant forms
 *
 */
$signup_code = Mage::getSingleton('eav/config')
    ->getAttribute('customer', 'signup_code');
$signup_code->setData('used_in_forms', array(
    'adminhtml_customer',
    'customer_account_create',
    'checkout_register'
));
$signup_code->save();