@extends('layouts.app')
@section('content')
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
