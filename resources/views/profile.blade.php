@extends('layouts.note_layout')
@section('content')
        <profile localization="{{$localization}}" locale="{{$locale}}" user="{{$user}}"></profile>
@endsection
