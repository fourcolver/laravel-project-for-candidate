<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class OpportunityRequest extends Request {

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
            	'name'	 			=> 'required',
            	'close_date'		=> 'required',
            	'probability'	 	=> 'required',
            	'source'			=> 'required',
            	'technology'	 	=> 'required',
            	'client_name'	 	=> 'required',
            	'client_number'	 	=> 'required',
		];
	}
	
}
