@extends('layouts.app')
@section('content')
      @if ($errors->any())
          <note-component errors="{{$errors}}"></note-component>
      @else
          <note-component errors="" note='{{$note}}' csrf="{{csrf_token()}}" readonly="false"></note-component>
      @endif

@endsection
