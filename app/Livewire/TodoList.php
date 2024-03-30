<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{
    public $name = '';
    public $search;
    public $todoId;
    public $editName;

    public $is_completed;

    public function create()
    {
        $validate = $this->validate([
            'name' => 'required|min:2|max:255',
        ]);

        Todo::create($validate);

        $this->reset();

        session()->flash('success', 'Todo created successfully');
    }

    public function delete(Todo $id)
    {
        $id->delete();
    }

    public function togglechecked($id)
    {
        $todo = Todo::find($id);
        $todo->is_completed = !$todo->is_completed;
        $todo->save();
    }

    public function edit(Todo $todo){
        $this->todoId = $todo->id;
        $this->editName = $todo->name;
    }

    public function cancel(){
        $this->reset(['todoId', 'editName']);
    }

    public function update(){
        $todo = Todo::find($this->todoId);

        $validate = $this->validate([
            'editName' => 'required|min:2|max:255',
        ]);
        $todo->name = $validate['editName'];
        $todo->save();
        $this->cancel();
    }
    public function render()
    {
        $todos = Todo::latest()->where('name', 'like', "%{$this->search}%")->paginate(5);

        return view('livewire.todo-list', compact('todos'));
    }
}
