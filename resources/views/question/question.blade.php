@extends('layouts.app')

@section('content')
    <questions :questions="{{$questions}}"></questions>
@endsection
