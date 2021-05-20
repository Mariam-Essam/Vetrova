<?php

namespace App\Http\Controllers;

use App\Category;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class TypeController extends Controller
{
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validateWithBag("storeType", [
            "category" => "required|numeric|exists:categories,id",
            "name"  => [
                "required",
                "string",
                "min:3",
                Rule::unique("types")->where(function($q) use ($request){
                    $q->where("category_id", $request->category);
                    return $q;
                })
            ]
        ]);

        $type = new Type();

        $type->name = $request->name;
        $type->category_id = $request->category;

        $type->save();

    
        Session::flash("success", $type->name . " type created successfully");

        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validateWithBag("updateType", [
            "type"  => "required|numeric|exists:types,id",
            "name"  => [
                "required",
                "string",
                "min:3",
                Rule::unique("types")->where(function($q) use ($request){
                    $q->where("id", "!=", $request->type);
                    $q->whereRaw("category_id IN (SELECT category_id FROM types WHERE id = " . intval($request->type) .")");
                    return $q;
                })
            ]
        ]);

        $type = Type::where("id", $request->type)->firstOrFail();
        $type->name = $request->name;
    
        $type->save();

    
        Session::flash("success", "The name updated successfully to " . $type->name);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        //
    }
}
