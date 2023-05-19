<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    //

    public function create(Request $request){

        $validator = Validator::make($request->all(),[
            'rate'=>'required',
            'order_id'=>'required',
            'task_id'=>'required',
            'executor_id'=>'required',
            'customer_id'=>'required',
            'text'=>'required|max:300',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator->errors())->withInput($request->all());
        }

        Feedback::query()->create($validator->validated());

        return back()->with(['success'=>'Отзыв успешно добавлен!']);

    }

    public function destroy($id){

        $feedback = Feedback::query()->where('id',$id)->first();
        if ($feedback === null){
            return back()->with(['alert'=>'Отзыва с таким id не существует']);
        }


        Feedback::destroy($id);
        return back()->with(['success'=>'Отзыв успешно удален']);
    }
}
