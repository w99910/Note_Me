@extends('layouts.app')
@section('content')
    @error('error')
    <toast time="1.5" message="{{$message}}" start="true"></toast>
    @enderror
    <div class="border-l-2 border-gray-600 flex bg-white w-full h-full">
        <div class="w-7/12 h-full"> @livewire('home')</div>
        <div class="absolute overflow-hidden pl-8 top-0 right-0 w-5/12 flex flex-col h-full">
            <div class="w-full h-full p-1 bg-white">
                <div class="w-full h-full border-2 border-gray-700 flex flex-col bg-secondary">
                    <div class="w-full flex justify-between items-center">
                        <div class="w-6/12 h-full p-1">
                            <weather></weather>
                        </div>
                        <div class="w-6/12 h-full p-1">
                            <tiny-calendar></tiny-calendar>
                        </div>
                    </div>
                    <div class="w-full h-2/6 flex items-center p-1">
                        <trash url="{{url('/')}}" token="{{csrf_token()}}"></trash>
                    </div>
                    <div class="w-full h-2/10 flex p-1">
                        <quote></quote>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    @livewireStyles
@endpush
@push('scripts')
    @livewireScripts
@endpush
