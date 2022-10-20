<?php

class FileUploadController extends AppController {
	public function index() {
		$this->set('title', __('File Upload Answer'));

		$req = $this->request;

		$arr = array();

		if($req->is('post')) {

			$fileUpload = $req->data['FileUpload'];
			$fileName = $fileUpload['file']['tmp_name'];

			$file = fopen($fileName, "r");

			$data = fgetcsv($file, 1000, ",");

			$str = implode(" ", $data);

			$newStr = preg_replace("/[-\s:]/", "-", $str);

			$dataArr = explode('-', $newStr);

			array_shift($dataArr);
			array_shift($dataArr);

			$insertData = array();

			for($i = 0; $i < count($dataArr); $i += 2) {
				$insertData[] = array(
					'name' => $dataArr[$i],
					'email' => $dataArr[$i+1],
					'valid' => 1,
					'created' => date('Y-m-d H:i:s'),
					'modified' => date('Y-m-d H:i:s')
				);
			}

			$this->FileUpload->saveMany($insertData);
			$this->setFlash('Data Imported');
		}

		$file_uploads = $this->FileUpload->find('all');
		$this->set(compact('file_uploads'));
	}
}