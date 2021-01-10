<div class="rounded-2xl bg-white p-4 w-full h-full flex flex-col">
    @error('title')
    <div class="w-full bg-soft-yellow px-2 py-1">{{$message}}</div>
    @enderror
    @error('content')
    <div class="w-full bg-soft-yellow px-2 py-1">{{$message}}</div>
    @enderror
    <div class="w-full">
        <label>
            <input wire:model.lazy="title" placeholder="Enter Title" class="w-full focus:outline-none border-b-2 px-3 py-2">
        </label>
    </div>
    <div class="h-full w-full mt-2 mb-2">
        <label>
            <textarea wire:model.lazy="content" placeholder="Enter Content" class="w-full h-full focus:outline-none focus:ring border-none" style="outline: none;"></textarea>
        </label>
    </div>
    <div class="mt-1 z-10">
        <button wire:click="create_post" class="rounded-lg px-5 py-3  bg-green-500 text-white hover:cursor-pointer">Create</button>
    </div>
</div>

