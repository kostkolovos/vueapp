@extends('layouts.app')

@section('content')
    <question-category :question_categories="{{$questionCategories}}"></question-category>
@endsection
