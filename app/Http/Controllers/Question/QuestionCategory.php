<?php


namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class QuestionCategory extends Controller
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
     * Show All Categories.
     *
     * @return Renderable
     */
    public function list(): Renderable
    {
        return view('question.question_category', ['questionCategories' => $this->questionCategoryFetch()]);
    }

    /**
     * Fetch Categories.
     *
     * @return mixed
     */
    public function questionCategoryFetch()
    {
        return \App\Models\QuestionCategory::with('questions')->get()->sortBy([
            ['id', 'desc']
        ]);
    }


    /**
     * Delete Category.
     *
     * @param $id
     * @return bool
     */
    public function deleteCategory($id): bool
    {
        return \App\Models\QuestionCategory::find($id)->delete();
    }

    /**
     * Create Category.
     * @param Request $request
     * @return mixed
     */
    public function createCategory(Request $request)
    {
        return \App\Models\QuestionCategory::create([
            'title' => $request->get('title')
        ]);
    }

    /**
     * Edit Category.
     *
     * @param Request $request
     * @return mixed
     */
    public function editCategory(Request $request)
    {
        return \App\Models\QuestionCategory::find($request->get('id'))->update([
            'title' => $request->get('title')
        ]);
    }
}
