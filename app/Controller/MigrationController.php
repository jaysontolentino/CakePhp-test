<?php

	App::uses('XLSXReader', 'Vendor');

	class MigrationController extends AppController{

		public $uses = array('Member', 'Transaction', 'TransactionItem');
		
		public function q1(){
			$this->setFlash('Question: Migration of data to multiple DB table');
// 			$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
		}
		
		public function q1_instruction(){
			$this->setFlash('Question: Migration of data to multiple DB table');
// 			$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
		}

		public function answer() {
			
			ini_set('memory_limit','256M');
			set_time_limit(0);

			$req = $this->request;

			if($req->is('post')) {

				$file = $req->data['Migration/answer']['file']['tmp_name'];

				//parse the excel file
				$xlsx = new XLSXReader($file);

				//get the content of the excel file
				$data = $xlsx->getSheetData('Sheet2');

				//remove the header
				array_shift($data);

				// debug($data);
				// exit;

				foreach($data as $item) {

					$type_no = explode(' ', trim($item[3]));

					$type = $type_no[0];
					$no = $type_no[1];
	
					$name = $item[2];
					$company = $item[5];
	
					$paytype = $item[4];
					$excelDate = $item[0];
	
					$UNIX_DATE = ($excelDate - 25569) * 86400;
					$date = gmdate("Y-m-d", $UNIX_DATE);
					$year = $item[11];
					$month = date('n', strtotime($date));
					$ref_no = $item[1];
					$receipt_no = $item[8];
					$payment_method = $item[6];
					$batch_no = $item[7];
					$cheque_no = $item[9];
					$payment_type = $item[10];
					$renewal_year = $item[11];
					$subtotal = $item[12];
					$tax = $item[13];
					$total = $item[14];
	
					$qty = 1.0;
					$unit_price = $subtotal;
					$sum = $qty * $unit_price;
	
					$indertData = array(
						'Member' => array(
							'type' => $type,
							'no' => $no,
							'name' => $name,
							'company' => $company,
							'valid' => 1,
							'created' => date('Y-m-d H:i:s'),
							'modified' => date('Y-m-d H:i:s')
						),
						'Transaction' => array(
							array(
								'member_name' => $name,
								'member_paytype' => $paytype,
								'member_company' => $company,
								'date' => $date,
								'year' => $year,
								'month' => $month,
								'ref_no' => $ref_no,
								'receipt_no' => $receipt_no,
								'payment_method' => $payment_method,
								'batch_no' => $batch_no,
								'cheque_no' => $cheque_no,
								'payment_type' => $payment_type,
								'renewal_year' => $renewal_year,
								'remarks' => null,
								'subtotal' => $subtotal,
								'tax' => $tax,
								'total' => $total,
								'valid' => 1,
								'created' => date('Y-m-d H:i:s'),
								'modified' => date('Y-m-d H:i:s'),
								'TransactionItem' => array(
									array(
										'description' => 'Being Payment for:'.$payment_type.':'.$month,
										'quantity' => $qty,
										'unit_price' => $unit_price,
										'uom' => null,
										'sum' => $sum,
										'valid' => 1,
										'created' => date('Y-m-d H:i:s'),
										'modified' => date('Y-m-d H:i:s'),
										'table' => 'Member',
										'table_id' => 1
									)
								)
							)
						
						)
					);
	
					$this->Member->saveAssociated($indertData, array('deep' => true));
					// debug($month);
					// exit;					
				}

				$this->setFlash('Data Successfully Migrated!');
			}

			$members = $this->Member->find('all', array('recursive' => 1));

			//debug($members);die;
			$this->set(compact('members'));
		}
		
	}