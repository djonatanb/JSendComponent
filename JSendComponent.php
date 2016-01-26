<?php
App::uses('Component', 'Controller');

class JSendComponent extends Component {



	public $allowedTypes = array(
		'success',
		'fail',
		'error'
	);

	public function startup(Controller $controller) { 
		$this->controller = $controller;
	}

	/**
	 * To be used when the data could be processed by the model
	 * @param [type] $data [description]
	 */
  	public function setJsonSuccess($data){
		return array(
			'status' => 'success',
			'data' => $data
		);
	}

	/**
	 * To be used when the data didn't pass the validation, 
	 * will usually receive the validation error from the model
	 * @param [type] $data [description]
	 */
	public function setJsonFail($data){
		return array(
			'status' => 'fail',
			'data' => $data
		);
	}

	/**
	 * To be used when something wrong happened, wrong method accessed or user doesn't have permission
	 * @param [type] $message [description]
	 */
	public function setJsonError($message){
		return array(
			'status' => 'error',
			'message' => $message
		);
	}

	public function setJson($data, $type = 'success'){
		if (in_array($type, $this->allowedTypes)) {
			$method = "setJson" . ucfirst($type);
			return $this->controller->set('jsonResponse', $this->{$method}($data));
		}

		throw new NotFoundException('only three json types allowed');
	}


	public function setSerialize(){
		$this->controller->set(array(
		 	'_serialize' => 'jsonResponse'
		));	
	}
}