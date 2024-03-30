<div>
    @include('livewire.includes.create-todo-box')

    <div id="search-box" class="flex flex-col items-center px-2 my-4 justify-center">
        <div class="flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
            <input type="text" placeholder="Search..."
                class="bg-gray-100 ml-2 rounded px-4 py-2 hover:bg-gray-100" />
        </div>
        <span class="text-red-500 text-xs block mt-2">Error</span>
    </div>

    <div id="todos-list">
        @foreach ($todos as $todo)
            @include('livewire.includes.todo-card')
        @endforeach
    </div>

    <div class="my-2">
        {{ $todos->links() }}
    </div>
</div>
