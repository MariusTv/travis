<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Keyword;

use App\KeywordProperty;

use Response;

class KeywordTreeController extends Controller
{

    /**
     * Default view for keyword
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {



        return view('keywords/index');
    }


    /**
     *  Store data to DB
     *
     * @param Request $request
     */
    public function store(Request $request)
            {

                if($request->ajax()){

                    // Get data for relational table


                    $keyword_en = $request->input('keyword_en');
                    dd($keyword_en);

                    $latin = $request->input('latin');

                    $local_lang = $request->input('local_lang');

                    $keyword_de = $request->input('keyword_de');

                    $plural_en = $request->input('plural_en');

                    $plural_de = $request->input('plural_de');

                    $keyword = $request->all();

                    $create = Keyword::create($keyword);

                    $id = $create->id;



//                    foreach($keyword_en as $en){
//
//                        $propertyThree = new KeywordProperty();
//
//                        $propertyThree->keyword_id = $id;
//
//                        $propertyThree->value = $en;
//
//                        $propertyThree->save();
//
//                    }
//
//
//
//
//                     //Set the keyword id in properties table
//
//
//                    $property = new KeywordProperty();
//
//                    $property->keyword_id = $id;
//
//                    $property->value = $latin;
//
//                    $property->save();
//
//
//                    $propertyTwo = new KeywordProperty();
//
//                    $propertyTwo->keyword_id = $id;
//
//                    $propertyTwo->value = $local_lang;
//
//                    $propertyTwo->save();
//
//
//                   // $propertyThree = new KeywordProperty;
//
//
//
//
//
//
//                    $propertyFour = new KeywordProperty();
//
//                    $propertyFour->keyword_id = $id;
//
//                    $propertyFour->value = $keyword_de;
//
//                    $propertyFour->save();
//
//
//                    $propertyFive = new KeywordProperty();
//
//                    $propertyFive->keyword_id = $id;
//
//                    $propertyFive->value = $plural_en;
//
//                    $propertyFive->save();
//
//
//                    $propertySix = new KeywordProperty();
//
//                    $propertySix->keyword_id = $id;
//
//                    $propertySix->value = $plural_de;
//
//                    $propertySix->save();


            return Response::json([
                'success' => true,
                'id' => $create->id,
                'nagi' => $latin
            ]);

        }

    }
    
    public function update($id, Request $request)
    {
        if($request->ajax()){

            $updatedKeywordset = $request->all();

            $keyword = Keyword::findOrFail($id);

            $keyword->update($updatedKeywordset);

            return Response::json([
                'updated' => 'veikia'
            ]);
            
        }
    }

}
