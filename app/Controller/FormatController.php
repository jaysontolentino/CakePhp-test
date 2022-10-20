<?php
	class FormatController extends AppController{
		public $uses = array('Order');
		
		public function q1(){
			
			$this->setFlash('Question: Please change Pop Up to mouse over (soft click)');
			
			$orders = $this->Order->find('all',array('conditions'=>array('Order.valid'=>1),'recursive'=>2));

			// debug($orders);exit;

			$this->set('orders',$orders);

			//debug($orders);exit;
// 			$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
		}
		
		public function q1_detail(){

			$this->setFlash('Question: Please change Pop Up to mouse over (soft click)');
				
			
			
// 			$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
		}

		public function q1_answer() {

			$id = $this->request['pass'][0];

			$order = $this->Order->find('first', array('conditions'=>array('Order.id'=>$id),'recursive'=>2));
			$this->set('data', $order);
		}
		
	}