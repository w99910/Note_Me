@extends('layouts.note_layout')
@section('content')
      @if ($errors->any())
          <note-component errors="{{$errors}}" csrf="{{csrf_token()}}" url="{{url('/')}}" readonly="false" localization="{{$localization}}" locale="{{$locale}}"></note-component>
      @else
          <note-component errors="" note='{{$note}}' csrf="{{csrf_token()}}" url="{{url('/')}}" readonly="false" localization="{{$localization}}" locale="{{$locale}}"></note-component>
      @endif

@endsection
