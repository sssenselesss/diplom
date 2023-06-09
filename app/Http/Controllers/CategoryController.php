<?php

namespace App\Http\Controllers;

use App\Models\TaskCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function destroy($id){
        TaskCategory::destroy($id);
        return back()->with(['success'=>'Категория успешно удалена']);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'main_category'=>'required',
            'name'=>'required|max:60'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator->errors())->withInput($request->all());
        }

        TaskCategory::query()->create($validator->validated());

        return back()->with(['success'=>'Категория успешно добавлена']);
    }
}
