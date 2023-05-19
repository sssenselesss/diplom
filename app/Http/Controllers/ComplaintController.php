<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplaintController extends Controller
{
    //

    public function sendComplaint(Request $request){

        $validator = Validator::make($request->all(),[
            'user_id'=>'required',
            'task_id'=>'required',
            'category_id'=>'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator->errors())->withInput($request->all());
        }

        Complaint::query()->create($validator->validated());
        return back()->with(['success'=>'Жалоба успешно отправилась']);
    }

    public function blockUser(Complaint $complaint){
        $user = User::query()->where('id','=',$complaint->user_id)->first();
        if($user === null ) return back()->with(['alert'=>'Такого пользователя нет']);

        $user->update(['status'=>'banned']);

        $tasks = Task::query()->where('author_id',$complaint->user_id)->get();
        foreach ($tasks as $task){
            Task::destroy($task->id);
        }
        $complaint->update(['status'=>'reviewed']);
        return back()->with(['success'=>'Пользователь успешно заблокирован']);
    }

    public function deleteTask(Complaint $complaint){

        $task = Task::query()->where('id',$complaint->task_id)->first();
        if($task === null) return back()->with(['alert'=>'Такого задания не существует']);

        $task->delete();
        return back()->with(['success'=>'Задание успешно удалено']);
    }

    public function cancelComplaint(Complaint $complaint){
        $complaint->delete();
        return back()->with(['success'=>'Жалоба отклонена']);
    }
}
