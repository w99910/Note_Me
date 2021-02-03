@extends('layouts.note_layout')
@section('content')
    <calendar url="{{url('/')}}" locale="{{$locale}}" localization="{{$localization}}"></calendar>
@endsection
