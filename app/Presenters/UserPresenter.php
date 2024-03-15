<?php 

namespace App\Presenters;

use Illuminate\Support\HtmlString;

class UserPresenter extends Presenter
{
    public function link()
    {
        return new HtmlString( "<a href='" . route('usuarios.show', $this->model->id) . "'>" . $this->model->name . "</a>");
    }

    public function roles()
    {
        return $this->model->roles->pluck('display_name')->implode(' - ');
    }

    public function notes()
    {
        if ($this->model->note) {
            return $this->model->note->body;
        } else {
            return 'No hay nota asociada';
        }
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
}