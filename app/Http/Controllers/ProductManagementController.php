<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use App\Employee;
use App\City;
use App\Division;

class ProductManagementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = DB::table('employees')
        ->leftJoin('category', 'employees.category_id', '=', 'category.id')
        ->select('employees.*','category.name as category_name', 'category.id as category_id')
        ->paginate(5);

        return view('product-mgmt/index', ['employees' => $product]);
    }







    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $cities = City::all();
        // $states = State::all();
        $categoris = Division::all();
        return view('product-mgmt/create', [
        'categoris' => $categoris]);
    }







    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateInput($request);
        // Upload image
        $path = $request->file('picture')->store('avatars');
        $keys = ['productName', 'aboutProduct','Status',
        'Price', 'category_id'];
        $input = $this->createQueryInput($keys, $request);
        $input['picture'] = $path;
        // Not implement yet
        // $input['company_id'] = 0;
        Employee::create($input);

        return redirect()->intended('/employee-management');
    }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function edit($id)
    {

        $product = Employee::find($id);
        // Redirect to state list if updating state wasn't existed
        if ($product == null) {
            return redirect()->intended('/employee-management');
        }

        $categoris = Division::all();
        return view('product-mgmt/edit', ['employees' => $product, 'categoris' => $categoris]);
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Employee::findOrFail($id);
        $this->validateInput($request);
        // Upload image
        $keys = ['productName', 'aboutProduct','Status',
        'Price','category_id'];
        $input = $this->createQueryInput($keys, $request);
        if ($request->file('picture')) {
            $path = $request->file('picture')->store('avatars');
            $input['picture'] = $path;
        }

        Employee::where('id', $id)
            ->update($input);

        return redirect()->intended('/employee-management');
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {

        $keys = ['Status'];
        $input = $this->createQueryInput($keys, $request);
         Employee::where('id', $id)->update($input);

         return redirect()->intended('/employee-management');
    }


    /**
     * Load image resource.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function load($name) {
        $path = storage_path().'/app/avatars/'.$name;
        if (file_exists($path)) {
            return Response::download($path);
        }
    }




    public function search(Request $request) {
        $constraints = [
            'productName' => $request['productName'],
        ];
        $employees = $this->doSearchingQuery($constraints);
        return view('product-mgmt/index', ['employees' => $employees, 'searchingVals' => $constraints]);
    }
/*
    /**
     * @param $constraints
     * @return mixed
     */


    private function doSearchingQuery($constraints) {
        $query = DB::table('employees')
            ->leftJoin('category', 'employees.category_id', '=', 'category.id')
            ->select('employees.productName as employee_name', 'employees.*','category.name as category_name', 'category.id as category_id', 'category.name as category_name', 'category.id as category_id');
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where($fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(5);
    }

















    private function validateInput($request) {
        $this->validate($request, [
            'productName' => 'required|max:60',
            'aboutProduct' => 'required',
            'Price' => 'required|numeric',
            'Status'=> 'required',
            'category_id' => 'required'
        ]);
    }






    private function createQueryInput($keys, $request) {
        $queryInput = [];
        for($i = 0; $i < sizeof($keys); $i++) {
            $key = $keys[$i];
            $queryInput[$key] = $request[$key];
        }

        return $queryInput;
    }
}
