<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Emails;
use Exception;
use Illuminate\Http\Request;

class PostEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        abort(404, 'Your error message');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);
        $tmp = $request->json()->all();
        //dd($tmp);

        // validator input
        $mess = "";
        $code = 0;
        try{
            if(empty($tmp["token"])){
                $mess = "TOKEN ERROR";
                $code = 400;
            }else{
                // check token
                if($tmp["token"]=="TMS"){
                    // check all data input
                    if(empty($tmp["email"]) || empty($tmp["sender"]) || empty($tmp["subject"]) || empty($tmp["content"])){
                        $mess = "ERROR DATA";
                        $code = 401;
                    }else{
                        try{
                            $em = Emails::create($tmp);
                            $em -> save();
                            $mess = "ADD OK";
                            $code = 200;
                        }catch(Exception $ex){
                            $mess = "ERROR ADD";
                            $code = 402;
                        }
                    }
                }else{
                    $mess = "TOKEN WRONG";
                    $code = 403;
                }
            }
        }catch(Exception $exx){
            $mess = "ERROR UNKNOW";
            $code = 500;
        }
        return ["code" => $code, "mess" => $mess];
        // $food = Emails::create([
        //     'name' => $request->input('name'),
        //     'count' => $request->input('count'),
        //     'description' => $request->input('description'),
        //     'category_id' => $request->input('category_id'),
        //     'image_path' => $generatedImageName
        // ]);
        // //save to Database
        // $food->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
