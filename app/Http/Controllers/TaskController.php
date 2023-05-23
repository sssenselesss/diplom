<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Article;
use App\Models\ComplaintCategotirs;
use App\Models\Task;
use App\Models\User;
use App\Models\UserCategory;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    //

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:10',
            'category_id' => 'required',
            'description' => 'required|max:300',
            'option' => 'max:300',
            'place' => 'required|max:255',
            'price' => 'required|max:10|numeric',
            'date_start' => 'required',
            'date_end' => 'required',
            'image' => 'required|mimes:png,jpeg,jpg'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput($request->all());
        }

        $image = null;

        if ($request->file('image')) {
            $image = $request->file('image')->store('public/assets/taskImages');
        }
        $author = auth()->user()->id;

        Task::query()->create(['image' => $image, 'author_id' => $author] + $validator->validated());

        return redirect()->route('catalog');
    }

    public function singleTask($id)
    {


        $task = Task::query()->where('id', '=', $id)->first();
        $task_app = null;
        $respond_count = 0;
        $executor = null;

        if(Auth::check()){
            $task_app = Application::query()->where('task_id','=',$id)
                ->where('executor_id','=',Auth::user()->id)->first();
            $respond_count =  Application::query()->where('task_id','=',$id)
                ->where('customer_id','=',Auth::user()->id)
                ->where('status','=','waiting')->get();

            $executor = Application::query()->where('task_id','=',$id)
                ->where('executor_id','=',Auth::user()->id)->first();
        }



        $compCategories = ComplaintCategotirs::all();


        return view('singleTask', ['task' => $task,'task_app'=>$task_app,
            'respond_count'=>$respond_count,'executor'=>$executor,'compCategories'=>$compCategories]);
    }

    public function update(Request $request, Task $task)
    {


        $validator = Validator::make($request->all(), [
            'title' => 'required|min:10|max:30',
            'category_id' => 'required',
            'description' => 'required|max:300',
            'option' => 'max:300',
            'place' => 'required|max:255',
            'price' => 'required|max:10',
            'date_start' => 'required',
            'date_end' => 'required',
            'image' => 'mimes:png,jpeg,jpg'
        ]);


        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput($request->all());
        }

        $validated = $validator->validated();

        if ($request->file('image')) {
            $request->validate(['image' => 'mimes:jpg,jpeg,png']);

            $image = $request->file('image')->store('public/assets/taskImages');
            $validated['image'] = $image;
        }

        $task->update($validated);

        return redirect()->route('singleTask', $task->id);
    }

    public function destroy($id)
    {


        Task::destroy($id);
        $tasks = Task::all();
        return redirect()->route('catalog', ['tasks' => $tasks]);
    }

    public function becomeExecutor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'experience' => 'required|min:10',
            'about' => 'required|min:30',
            'categories' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput($request->all());
        }

        $user = User::query()->where('id', '=', auth()->user()->id)->first();

        $validated = $validator->validated();
        $experience = $validated['experience'];
        $about = $validated['about'];

        foreach ($validated['categories'] as $category) {
            UserCategory::query()->create(['user_id' => $user->id, 'category_id' => $category]);
        }

        User::query()->where('id', '=', $user->id)->update(['role' => 'executor', 'experience' => $experience, 'about' => $about]);


        return redirect()->route('main');


    }
}
