@extends('layouts.app')
@section('content')
    @error('error')
    <toast time="1.5" message="{{$message}}" start="true"></toast>
    @enderror
    <div class="rounded-2xl bg-white w-full h-full">
         @livewire('home')
    </div>
@endsection
@push('css')
@livewireStyles
@endpush
@push('scripts')
@livewireScripts
@endpush
