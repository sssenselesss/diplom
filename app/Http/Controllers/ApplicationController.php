<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Feedback;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function respondUsers($id)
    {

        $resUsers = Application::query()
            ->where('customer_id', '=', Auth::user()->id)
            ->where('task_id', $id)
            ->where('status', '=', 'waiting')
            ->get();


        return view('respondUsers', ['resUsers' => $resUsers]);
    }

    public function respond(Request $request, Task $task)
    {
        $customer = $task->author_id;
        $executor = Auth::user()->id;
        $task_id = $task->id;

        Application::query()->create(['task_id' => $task_id, 'customer_id' => $customer, 'executor_id' => $executor]);

        return back()->with(['success' => 'Заявка успещно оставлена']);
    }

    public function respondAccept(Application $application)
    {

        $application->update(['status' => 'at_work']);

        $task = Task::query()->where('id', $application->task_id)->first();
        $task->update(['status' => 'at_work']);
        Application::query()->where('task_id','=',$task->id)
            ->where('executor_id','!=',$application->executor_id)
            ->delete();
        return redirect()->route('catalog');
    }

    public function ordersCustomer()
    {


        $executors = Application::query()
            ->where('customer_id', '=', Auth::user()->id)
            ->where('status','!=','waiting')
            ->orderBy('status')
            ->get();

        $feedbacksm = [];

        $feedbacks = Feedback::all();
        foreach ($feedbacks as $fb) {
            array_push($feedbacksm,$fb->order_id);
        }



        return view('myOrdersCustomer', [ 'executors' => $executors,'feedbacksm'=>$feedbacksm]);
    }

    public function ordersExecutor()
    {

        $orders = Application::query()
            ->where('executor_id', '=', Auth::user()->id)
            ->orderBy('status')
            ->get();


        return view('myOrdersExecutor', ['orders' => $orders,]);
    }

    public function finishOrder(Application $application){
        $task = Task::query()->where('id','=',$application->task_id)->first();
        $task->update(['status'=>'finished']);
        $application->update(['status'=>'finished']);
        return back();
    }

    public function respondCancel($id){
        Application::destroy($id);
        return back()->with(['success'=>'Заявка отклонена']);
    }

    public function ordersAll(){
        if(Auth::check()){
            $executors =  Task::query()->where('author_id',Auth::user()->id)->get();
        }

        return view('myOrdersAll',['executors'=>$executors]);
    }
}
