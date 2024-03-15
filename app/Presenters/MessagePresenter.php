<?php 

namespace App\Presenters;

use App\Models\Message;
use App\Presenters\Presenter;
use Illuminate\Support\HtmlString;

class MessagePresenter extends Presenter
{


    public function userName()
    {
        if($this->model->user_id){
            return $this->userLink();
        }
        return $this->model->nombre;
    }

    public function userEmail()
    {
        if($this->model->user_id){
            return $this->model->user->email;
        }
        return $this->model->email;
    }

    public function link()
    {
        return new HtmlString( "<a href='" . route('mensajes.show', $this->model->id) . "'>" . $this->model->mensaje . "</a>");
    }

    public function userLink()
    {
        return $this->model->user->present()->link();
    }

    public function tags()
    {

        if ($this->model->tags){ 
            return $this->model->tags->pluck('name')->implode(', '); 
        }
        else{
        return 'No hay nota asociada';
        }
    }

    public function notes()
    {
        if ($this->model->note) {
            return $this->model->note->body;
        } else {
            return 'No hay nota asociada';
        }
    }
}