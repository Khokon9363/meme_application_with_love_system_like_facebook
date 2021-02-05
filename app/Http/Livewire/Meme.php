<?php

namespace App\Http\Livewire;

use App\Models\Love;
use App\Models\Meme as ModelsMeme;
use Livewire\Component;

class Meme extends Component
{
    
    public $title;
    public $meme;
    
    public $memes;
    public $howMany = 4;

    public $collapsed = true;

    public function validation()
    {
        $this->collapsed = false;

        $this->validate([
            'title' => 'required|max:200',
            'meme'  => 'required|max:600'
        ]);

    }
    public function store()
    {
        $this->validation();

        $meme = new ModelsMeme();
        
        $meme->user_id = (auth()->check()) ? auth()->user()->id : null ;
        
        $meme->title = $this->title;
        $meme->meme = $this->meme;
        $meme->save();

        $this->title = null;
        $this->meme = null;

        $this->collapsed = true;
        session()->flash('success', 'Meme posted successfully');
    }

    public function love($id)
    {
        $love = new Love();
        $love->meme_id = $id;
        $love->user_id = auth()->user()->id;
        $love->save();

        session()->flash('success', 'Thanks for your love');
    }

    public function loadMore()
    {
        $this->howMany += 4;
    }

    public function getMemes()
    {
        $this->memes = ModelsMeme::with('user','loves')->orderBy('created_at', 'DESC')->take($this->howMany)->get();
    }

    public function render()
    {
        $this->getMemes();
        
        return view('livewire.meme');
    }
}
