<?php
	class OrderReportController extends AppController{

		public function index(){

			$this->setFlash('Multidimensional Array.');

			$this->loadModel('Order');
			$orders = $this->Order->find('all',array('conditions'=>array('Order.valid'=>1),'recursive'=>2));
			//debug($orders);exit;

			$this->loadModel('Portion');

			// To Do - write your own array in this format
			// $order_reports = array(
			// 	'Order 1' => array(
			// 							'Ingredient A' => 1,
			// 							'Ingredient B' => 12,
			// 							'Ingredient C' => 3,
			// 							'Ingredient G' => 5,
			// 							'Ingredient H' => 24,
			// 							'Ingredient J' => 22,
			// 							'Ingredient F' => 9,
			// 						),
			// 					  'Order 2' => array(
			// 					  		'Ingredient A' => 13,
			// 					  		'Ingredient B' => 2,
			// 					  		'Ingredient G' => 14,
			// 					  		'Ingredient I' => 2,
			// 					  		'Ingredient D' => 6,
			// 					  	),
			// 					);

			// ...

			$order_reports = array();

			foreach($orders as $order) {

				$name = $order['Order']['name'];
				$details = $order['OrderDetail'];

				foreach($details as $detail) {
					$itemId = $detail['item_id'];

					$portions = $this->Portion->find('all',array(
						'conditions'=>array(
							'Portion.valid'=>1,
							'Portion.item_id' => $itemId
						),'recursive'=>2));
					//debug($portions);exit;

					foreach($portions as $portion) {
						$portionDetails = $portion['PortionDetail'];

						foreach($portionDetails as $portionDetail) {

							//debug($portionDetail['Part']['name']);exit;
							$value = $portionDetail['value'];
							$partName = $portionDetail['Part']['name'];

							$order_reports[$name][$partName] = $value;
							
						}
					}
				}
			}

			//debug($order_reports);exit;

			$this->set('order_reports',$order_reports);

			$this->set('title',__('Orders Report'));
		}

		public function Question(){

			$this->setFlash('Multidimensional Array.');

			$this->loadModel('Order');
			$orders = $this->Order->find('all',array('conditions'=>array('Order.valid'=>1),'recursive'=>2));

			// debug($orders);exit;

			$this->set('orders',$orders);

			$this->loadModel('Portion');
			$portions = $this->Portion->find('all',array('conditions'=>array('Portion.valid'=>1),'recursive'=>2));
				
			// debug($portions);exit;

			$this->set('portions',$portions);

			$this->set('title',__('Question - Orders Report'));
		}

	}