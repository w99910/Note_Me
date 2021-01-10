@extends('layouts.app')
@section('content')
      @if ($errors->any())
          <note-component errors="{{$errors}}"></note-component>
      @else
          <note-component errors="" note="{{\App\Models\Note::find(4)}}" csrf="{{csrf_token()}}"></note-component>
      @endif

@endsection
