<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddContactsRequest extends Request {

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
            	'first_name'	 => 'required|min:3',
	    		'last_name' 	 => 'required|min:3',
	    		'job_title' 	 => 'required',
	    		'departement' 	 => 'required',
	    		
	    		'mobile'		 => 'required|min:10|numeric',
	    		'email_id'		 => 'required|email',
	    		'zipcode'		 => 'required',
	    		'country'		 => 'required',
		];
	}

	

	
}
