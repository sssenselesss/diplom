<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Complaint;
use App\Models\ComplaintCategotirs;
use App\Models\Feedback;
use App\Models\MainTaskCategory;
use App\Models\Task;
use App\Models\TaskCategory;
use App\Models\User;
use App\Models\UserCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{
    public function main()
    {
        $feedbacks = Feedback::query()->orderBy('id')->limit(10)->get();
        $articles = Article::query()->limit(4)->get();
        return view('main', ['articles' => $articles,'feedbacks'=>$feedbacks]);
    }

    public function catalog()

    {
        $total = Task::query()->where('status','new')->get();

        $mainCat = MainTaskCategory::all();
        $subCat = TaskCategory::all();
        $tasks = Task::query()->where('status','=','new')
            ->orderByDesc('id')->paginate(10);
        $categories1 = [];
        return view('catalog', ['tasks' => $tasks,
            'mainCat' => $mainCat, 'subCat' => $subCat,'total'=>$total,
            'categories1'=>$categories1]);
    }

    public function catalogSearch(Request $request)
    {

        $tasks = Task::query()->where('id', '!=', null);
        $total = Task::all();

        if ($request->has('search')) {
            if ($request['search'] === null) {

                $tasks;

            }else{
                $search = $request['search'];
                $tasks =  Task::query()->where('title', 'LIKE', "%${search}%");
            }
        }
$categories1 =[];
        $mainCat = MainTaskCategory::all();
        $subCat = TaskCategory::all();

        return view('catalog', ['tasks' => $tasks->paginate(10)->withQueryString(), 'mainCat' => $mainCat,
            'subCat' => $subCat,'total'=>$total,'categories1'=>$categories1]);
    }

    public function catalogFilter(Request $request){

        $tasks = Task::query()->where('id', '!=', null);
        $total = Task::all();

        if ($request->has('categories')) {
            if ($request['categories'] === null) {

                $tasks;

            }else{
                $categories = $request->get('categories');
                $tasks = Task::query()->whereIn('category_id',$categories);

            }
        }
        $categories1 = $categories;
        $mainCat = MainTaskCategory::all();
        $subCat = TaskCategory::all();
        return view('catalog', ['tasks' => $tasks->paginate(10)->withQueryString(),
            'mainCat'=>$mainCat,'subCat'=>$subCat,'total'=>$total,'categories1'=>$categories1]);


    }

    public function createTask()

    {
        $mainCat = MainTaskCategory::all();
        $subCat = TaskCategory::all();
        return view('createTask', ['mainCat' => $mainCat, 'subCat' => $subCat]);
    }

    public function frequent()
    {
        return view('frequentQuestions');
    }

    public function articles()
    {
        $articles = Article::all();
        return view('articles', ['articles' => $articles]);
    }

    public function articleCreate()
    {
        $categories = ArticleCategory::all();
        return view('createArticle', ['categories' => $categories]);
    }

    public function profile(User $user)
    {



        $categs = DB::table('task_categories as cats')
            ->join('user_categories as usCat', 'cats.id', '=', 'usCat.category_id')
            ->where('user_id', '=', $user->id)->get();
        $mainCats = [];
        foreach ($categs as $cat) {
            array_push($mainCats, $cat->main_category);
        }
        $main = MainTaskCategory::query()->whereIn('id', $mainCats)->get();


         $feedbacks = Feedback::query()->where('executor_id','=',$user->id)
             ->get();

            $average = Feedback::query()->where('executor_id','=',$user->id)
                ->orWhere('customer_id','=',$user->id)->average('rate');

            $created =  count(Task::query()->where('author_id','=',$user->id)->get()) ;
            $finished = count(Application::query()->where('status','=','finished')
            ->where('executor_id','=',$user->id)->get());

        return view('profile', ['user' => $user,
            'categs' => $categs,
            'main' => $main,
            'feedbacks'=>$feedbacks,
            'average'=>$average,
            'created'=>$created,'finished'=>$finished]);
    }

    public function adminAllUsers()
    {
        $users = User::paginate(10);
        return view('adminAllUsers', ['users' => $users]);
    }
    public function adminAllCategories(){
        $mainCat = MainTaskCategory::all();
        $subCat = TaskCategory::all();
        return view('adminAllCategories',['mainCat'=>$mainCat,'subCat'=>$subCat]);
    }

    public  function adminAllTasks(Request $request){



        if($request->has('search')){
            $search = $request['search'];

            $tasks = Task::query()->where('title','LIKE',"%{$search}%");
        }else{
            $tasks = Task::query();
        }


        return view('adminAllTasks',['tasks'=>$tasks->paginate(10)->withQueryString()]);
    }

    public function search(Request $request)
    {
        $search = $request->search;


        $users = User::query()->where('name', 'LIKE', "%{$search}%")
            ->orWhere('id', 'LIKE', "%{$search}%")->paginate();
        return view('adminAllUsers', ['users' => $users]);
    }

    public function editArticle($id)
    {
        $article = Article::query()->where('id', $id)->first();

        $categories = ArticleCategory::all();
        return view('editArticle', ['article' => $article, 'categories' => $categories]);
    }

    public function updateTask($id)
    {

        $task = Task::query()->where('id', $id)->first();




        $mainCat = MainTaskCategory::all();
        $subCat = TaskCategory::all();
        return view('updateTask', ['mainCat' => $mainCat, 'subCat' => $subCat, 'task' => $task]);
    }

    public function becomeExecutor()
    {
        $mainCat = MainTaskCategory::all();
        $subCat = TaskCategory::all();
        return view('becomeExecutor', ['mainCat' => $mainCat, 'subCat' => $subCat]);
    }

    public  function resetPassword(){
        return view('resetPassword');
    }

    public function allComplaints(){
        $comps = Complaint::query()->where('id','!=',null)->paginate(10)->withQueryString();

        return view('adminAllComplaints',['comps'=>$comps]);
    }





}
