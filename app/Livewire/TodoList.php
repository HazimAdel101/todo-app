<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination;
    public $name = '';

    public $search;

    public function create(){
        $validate = $this->validate([
            'name' => 'required|min:2|max:255',
        ]);

        Todo::create($validate);

        $this->reset();

        session()->flash('success', 'Todo created successfully');
    }

    public function delete(Todo $id){
        $id->delete();
    }

    public function render()
    {
        $todos = Todo::latest()->where('name', 'like', "%{$this->search}%")->paginate(5);

        return view('livewire.todo-list', compact('todos'));
    }
}
