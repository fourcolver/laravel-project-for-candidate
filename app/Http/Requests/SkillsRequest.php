<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class SkillsRequest extends Request {

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
            	'freelancer_name'	 		=> 'required',
            	'freelancer_email'		 	=> 'required',
            	'freelancer_mobile'			=> 'required',
		];
	}
	
}
