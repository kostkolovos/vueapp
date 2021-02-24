<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class Question extends Controller
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
        return view('question.question', ['questions' => $this->questionFetch()]);
    }

    /**
     * Fetch Categories.
     *
     * @return mixed
     */
    public function questionFetch()
    {
        return \App\Models\Question::with('questionCategory')->get()->sortBy([
            ['id', 'desc']
        ]);
    }


    /**
     * Create Question.
     * @param Request $request
     * @return mixed
     */
    public function createQuestion(Request $request)
    {
        return \App\Models\Question::create([
            'title' => $request->get('title'),
            'question' => $request->get('question'),
            'question_category_id' => $request->get('question_category')['id']
        ]);
    }


    /**
     * Edit Question.
     *
     * @param Request $request
     * @return mixed
     */
    public function editQuestion(Request $request)
    {
        return \App\Models\Question::find($request->get('id'))->update([
            'title' => $request->get('title'),
            'question' => $request->get('question'),
            'question_category_id' => $request->get('question_category')['id']
        ]);

    }

    /**
     * Delete Question.
     *
     * @param $id
     * @return bool
     */
    public function deleteQuestion($id): bool
    {
        return \App\Models\Question::find($id)->delete();
    }

}
