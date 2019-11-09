<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use DB;
use App\Accounts;
use App\Contacts;
use App\Skills;
use App\User;
use Response;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class CsvUploadController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard After Login.
     *
     * @return \Illuminate\Http\Response
     */

    public function csvToArray($filename = '', $delimiter = ',')
    { 

        if(!file_exists($filename) || !is_readable($filename))
            return FALSE;
        $header = Null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== FALSE)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
            {
                if(!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }

    public function freelancercsvToArray($filename = '', $delimiter = ',')
    { 

        if(!file_exists($filename) || !is_readable($filename))
            return FALSE;
        $header = Null;
        $data = array();
        $num = 1;
        if (($handle = fopen($filename, 'r')) !== FALSE)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
            {
              if($num == 1){ $num++; continue; }
              $number = count($row);
              $num++;
                if(!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }

    public function importCsv(Request $request)
    {
        $attach_doc  = $request->file('attach_csv');
        $name       = $attach_doc->getClientOriginalName();
        $type       = $attach_doc->getClientOriginalExtension();
        $allowed =  array('csv');
        if(!in_array($type,$allowed) ) {
          \Session::flash('message', "Only CSV File is Imported Please Select CSV File Only");
          return redirect('/dashboard');
        }
        $size       = $attach_doc->getClientSize();
            if($size > 2097152) {
                return redirect('admin/opportunity/edit/'.$id)->with('message', 'Please Upload File Size less then 2 MB');
            }
        $save       = $attach_doc->storeAs('admin/csv/upload',$name);
        $path_url   = storage_path('app/').$save;
        $data = $this->csvToArray($path_url);

        foreach ($data as $data) {
            $account = new Accounts();
            $contacts = new Contacts();
            if($data['Account name']==''){
               \Session::flash('message', "Account Name must be filled in CSV File");
                return redirect('/dashboard');  
            }else{
            $account->account_name = $data['Account name'];  
            }
            if($data['Manager']==''){
                \Session::flash('message', "Manager Name must be filled in CSV File");
                return redirect('/dashboard');   
            }else{
               $contacts_name = $data['Manager']; 
               $contacts_name = explode(" ",$contacts_name);
               $contacts->first_name = $contacts_name[0];
              if(array_key_exists('1', $contacts_name))
              {
                $contacts->last_name = $contacts_name[1];
              }
            if($data['Emails']==''){
                \Session::flash('message', "Email must be filled in CSV File");
                return redirect('/dashboard');   
            }else{
               $contacts->email_id = $data['Emails'];
            } 
            if($data['Zipcode']==''){
                \Session::flash('message', "Zipcode must be filled in CSV File");
                return redirect('/dashboard');   
            }else{
               $contacts->pincode = $data['Zipcode'];
            } 
            if($data['Mobile']==''){
                \Session::flash('message', "Mobile must be filled in CSV File");
                return redirect('/dashboard');   
            }else{
               $contacts->mobile = $data['Mobile'];
            } 
            if($data['Phone number']==''){
                \Session::flash('message', "Phone number must be filled in CSV File");
                return redirect('/dashboard');   
            }else{
               $contacts->phone = $data['Phone number'];
            } 
            if($data['Job Title']==''){
                \Session::flash('message', "Job Title must be filled in CSV File");
                return redirect('/dashboard');   
            }else{
               $contacts->job_title = $data['Job Title'];
            }
            if($data['Notes']==''){
                \Session::flash('message', "Notes must be filled in CSV File");
                return redirect('/dashboard');   
            }else{
               $contacts->notes = $data['Notes'];
            } 
            if($data['City']==''){
                \Session::flash('message', "City must be filled in CSV File");
                return redirect('/dashboard');   
            }else{
               $contacts->city = $data['City'];
            }
            if($data['Department']==''){
                \Session::flash('message', "Department must be filled in CSV File");
                return redirect('/dashboard');   
            }else{
              $contacts->departement = $data['Department'];
            }
            if($data['Country']==''){
                \Session::flash('message', "Country must be filled in CSV File");
                return redirect('/dashboard');   
            }else{
              $contacts->country = $data['Country'];
            }
            try { 
                $account->save();
                $account_id = DB::table('accounts')
                ->select('id')
                ->orderBy('id', 'desc')->first();
                $contacts->account_id = $account_id->id;
                $contacts->save();
            } catch(\Illuminate\Database\QueryException $ex){ 
              $errorCode = $ex->errorInfo[1];
                if($errorCode == 1062){
                    \Session::flash('message', "Duplicate Entry for Email Address in CSV File");
                          return redirect('/dashboard'); 
                }else{
                    \Session::flash('message', $ex->getMessage());
                          return redirect('/dashboard'); 
                }  
            }
            
            }
        }

         \Session::flash('message', "Data imported successfully");
            return redirect('/dashboard');     
    }


    public function freelancerimportCsv(Request $request)
    {
        $attach_doc  = $request->file('attach_csv');
        $name       = $attach_doc->getClientOriginalName();
        $type       = $attach_doc->getClientOriginalExtension();
        $allowed =  array('csv');
        if(!in_array($type,$allowed) ) {
          \Session::flash('user_message', "Only CSV File is Imported Please Select CSV File Only");
          return redirect('/admin/freelancers');
        }
        $size       = $attach_doc->getClientSize();
            if($size > 2097152) {
                return redirect('admin/opportunity/edit/'.$id)->with('user_message', 'Please Upload File Size less then 2 MB ');
            }
        $save       = $attach_doc->storeAs('admin/csv/upload',$name);
        $path_url   = storage_path('app/').$save;
        $data = $this->freelancercsvToArray($path_url);
        //unset($data[])
        //print_r($data); die;
        foreach ($data as $data) {
            //print_r($data); die;
            $user = new User();
            $skills = new Skills();
            if($data['Candidate Name']==''){
               \Session::flash('user_message', "Candidate Name must be filled in CSV File");
                return redirect('/admin/freelancers');  
            }else{
                $candidate_name = $data['Candidate Name']; 
                $candidate_name = explode(" ",$candidate_name);
                if(count($candidate_name)>3){
                  \Session::flash('user_message', "Invalid Candidate Name in CSV File");
                     return redirect('/admin/freelancers'); 
                }elseif(count($candidate_name)==3){
                    $user->first_name = $candidate_name[0];
                    $user->middle_name = $candidate_name[1];
                    $user->last_name = $candidate_name[2];
                }elseif(count($candidate_name)==2){
                    $user->first_name = $candidate_name[0];
                    $user->last_name = $candidate_name[1];
                }elseif(count($candidate_name)==1){
                    \Session::flash('user_message', "Enter Candidate Full Name in CSV File");
                     return redirect('/admin/freelancers'); 
                }
            }
            if($data['Email']==''){
               \Session::flash('user_message', "Email must be filled in CSV File");
                return redirect('/admin/freelancers');  
            }else{
            $user->email = $data['Email'];
            }
            if($data['Password']==''){
               \Session::flash('user_message', "Password must be filled in CSV File");
                return redirect('/admin/freelancers');  
            }else{
            $user->password = bcrypt($data['Password']);
            }
            if($data['Mobile']==''){
               \Session::flash('user_message', "Mobile must be filled in CSV File");
                return redirect('/admin/freelancers');  
            }else{
            $user->Mobile = $data['Mobile'];
            }

            try { 
                $user->save();
                $user_id = $user->id;
                $skills->user_id = $user_id;
                $skills->cv_recieved = '0';
                $skills->hourly_rate = $data['Hourly Rate'];
                $skills->role_definition = $data['Role'];
                $skills->availability = $data['Availability'];
                $skills->availability_date = $data['Available Date'];
                $skills->availability_per_week = $data['Availability In Week'];
                $skills->travelling = $data['Travelling'];
                $skills->category_skills = $data['Skills'];
                $skills->core_competences = $data['Core Competences'];
                $skills->general_notes = $data['General Notes'];
                $skills->save();


            } catch(\Illuminate\Database\QueryException $ex){ 
              $errorCode = $ex->errorInfo[1];
                if($errorCode == 1062){
                    \Session::flash('user_message', "Duplicate Entry for Email Address in CSV File");
                          return redirect('/admin/freelancers'); 
                }else{
                    \Session::flash('user_message', $ex->getMessage());
                          return redirect('/admin/freelancers'); 
                }  
            }

           }


         \Session::flash('user_message', "Data imported successfully");
            return redirect('/admin/freelancers');   
         }


    public function freelancerExportCSV()
    {

      $filename = "freelancers.csv";
      $handle = fopen($filename, 'w+');
      fputcsv($handle, array('First and Last Name','unique Email','User Password','all data in comma seperated','Hourly Rate(1-7) Example 1,2,3', 'Role(1-14) Example 1,2,12','Availability(0=>parttime or 1=>Full Time or 2=>Not Available)','Available Date(YYYY-mm-dd) Format','Availability In Week(1-5) Example 1,2,3','Travelling(1-5) Example 1,2,3','Skills(1-133) Example 1,33,31','Core Competences(1-133) Only 5 Competences','General Notes(comments)'));
      fputcsv($handle, array('Candidate Name', 'Email', 'Password', 'Mobile','Hourly Rate','Role','Availability','Available Date','Availability In Week','Travelling','Skills','Core Competences','General Notes'));
      fputcsv($handle, array('John Doe', 'john@gmail.com', 'johndoe123','8989898989'));
      fclose($handle);

      $headers = array(
          'Content-Type' => 'text/csv',
      );

      return Response::download($filename, 'freelancers.csv', $headers);
      
    }

    public function ExportCSV()
    {

      $filename = "Sample.csv";
      $handle = fopen($filename, 'w+');
      fputcsv($handle, array('Account name', 'Manager', 'Emails', 'Zipcode','Mobile','Phone number','Job Title','Department','Notes','City','Country'));
      fputcsv($handle, array('BMW', 'Tata Sighn', 'john@gmail.com','8989','9090909090','0522767676','HR Manager','HR','Storage & Organization','Lucknow','India'));
      fclose($handle);

      $headers = array(
          'Content-Type' => 'text/csv',
      );

      return Response::download($filename, 'Sample.csv', $headers);
      
    }


}
