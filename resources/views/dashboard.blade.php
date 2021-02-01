@extends('layouts.app')
@section('content')
    @error('error')
    <toast time="1.5" message="{{$message}}" start="true"></toast>
    @enderror
    <div class="border-l-2 border-gray-600 flex bg-white w-full h-full">
        <div class="w-7/12 h-full"> @livewire('home')</div>
        <note url="{{url('/')}}" token="{{csrf_token()}}"></note>

    </div>
@endsection
@push('css')
    @livewireStyles
@endpush
@push('scripts')
    @livewireScripts
@endpush
