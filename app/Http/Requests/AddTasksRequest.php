<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddTasksRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
    {
        return true;
    }
	
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            	'task_date'	 	=> 'required',
	    		'account_id' 	=> 'required',
	    		'task_priority' => 'required',
	    		'task_status' 	=> 'required',
	    		'task_type'		=> 'required',
	    		'task_owner'	=> 'required',
		];
	}
}
