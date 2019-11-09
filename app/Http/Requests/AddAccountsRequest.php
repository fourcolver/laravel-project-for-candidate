<?php 

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddAccountsRequest extends Request {

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
            	'account_name'	 		=> 'required',
            	'pincode'		 		=> 'required',
            	'country'	 	 		=> 'required',
            	'telephone'	 			=> 'required|numeric',
		];
	}
	
}
