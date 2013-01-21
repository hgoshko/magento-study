<?php
/**
 * Created by JetBrains PhpStorm.
 * User: e.goshko
 * Date: 1/17/13
 * Time: 1:50 PM
 * To change this template use File | Settings | File Templates.
 */

class Ism_Deliveryat_Model_Observer {

	public function addDeliveryat($observer)
	{
		/** @var $quote Mage_Sales_Model_Quote */
		$quote = $observer->getQuote();

		/** @var $request Mage_Core_Controller_Request_Http */
		$request = $observer->getRequest();
		$deliver_date = $request->getParam('deliver-at');

		//var_dump(array_keys($quote->getData()));
	}

}