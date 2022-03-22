<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;


class EmployeeController extends Controller
{
    
    public function viewcreate(){
        return view('employee-create');
    }

    public function create(Request $request){
        // if($request->session()->has('access')){
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:employees',
                'password'=>'required|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                'cpassword' => 'required|same:password',
                'address' => 'required',
                'gender' => 'required'
                ]);

                // print_r($request->all());

            try {
                $employee = new Employee;
                $employee->name = $request['name'];
                $employee->email = $request['email'];
                $employee->gender = $request['gender'];
                $employee->address = $request['address'];
                $employee->status = $request['status'];
                $employee->password =  Crypt::encryptString($request['password']); 
                $employee->save();
            } catch (\Throwable $th) {
                dd($th);
            }

            return redirect('/');

        // }else{
        //     return redirect('/');
        // }

    }

    public function loginp(Request $request){


        $employees = Employee::where('email', $request['email'])
        ->select(['employee_id', 'password'])
        ->get();
        $pass = $employees->map->only(['password','employee_id']);
        $valpass = $pass[0]['password'];
        $eid = $pass[0]['employee_id'];

        try {
            $matchpass = strcmp($request['passwords'],Crypt::decryptString($valpass) );
            
            if($matchpass == 0){
                $request->session()->put('access',$eid);
                return redirect('/view');
            }else{
                return redirect('/');
            }


        } catch (DecryptException $e) {
            return redirect('/');
        }
           
    }

    public function view(Request $request){
        if($request->session()->has('access')){
            // $employees = Employee::all();
            $employees = Employee::where('status', '1')
                ->select(['employee_id', 'name', 'email', 'gender','password', 'address', 'status'])
                ->orderBy('name')
                ->get();
            $data = compact('employees');
            return view('employee-view')->with($data);
        }else{
            return redirect('/');
        }
    }

    public function edit($id, Request $request){
        if($request->session()->has('access')){
            $employee = Employee::find($id);
            if(is_null($employee)){
                return redirect('employee/view');
            }
            else{
                $title = 'Update employee';
                $data = compact('employee','title');
                return view('employee-update')->with($data);
            }
        }else{
            return redirect('/');
        }
    }

    public function update($id, Request $request){

    if($request->session()->has('access')){

        $matchp = strcmp($request['oldpassword'],Crypt::decryptString($request['hashpassword']) );
        if($matchp != 0){
                $employee = Employee::find($id);
                if(is_null($employee)){
                    return redirect('employee/view');
                }
                $notmatch = "xx";
                $title = 'Update employee';
                return view('employee-update',compact('notmatch','title','employee'));
        }


            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                'cpassword' => 'required|same:password',
                'address' => 'required',
                'gender' => 'required'
            ]);


            $employee = Employee::find($id);
            $employee->name = $request['name'];
            $employee->email = $request['email'];
            $employee->gender = $request['gender'];
            $employee->address = $request['address'];
            $employee->status = $request['status'];
            $employee->password =  Crypt::encryptString($request['password']); 
            $employee->save();

            return redirect()->route('view');
        }else{
            return redirect('/');
        }

    }

    public function delete($id, Request $request){
        if($request->session()->has('access')){
            Employee::where('employee_id', $id)->update(['status' => 0]);
           return redirect()->route('view');
        }else{
            return redirect('/');
        }
    }

    function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }

}
