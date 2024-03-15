<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Cache;

class CacheMessages implements MessagesInterface
{
    protected $messages;

    public function __construct(Messages $messages)
    {
        $this->messages = $messages;
    }

    public function getPaginated()
    {
        $key = "messages.page." . request('page', 1);



        return Cache::rememberForever($key, function(){
            return $this->messages->getPaginated();
        });
    }

    public function store($request)
    {
        $message = $this->messages->store($request);

        Cache::flush();

        return $message;
    }

    public function findById($id)
    {
        return Cache::rememberForever("messages.{$id}", function() use ($id){
            return $this->messages->findById($id);
        });
    }

    public function update($request, $id)
    {
        $message = $this->messages->update($request, $id);

        Cache::flush();

        return $message;
    }

    public function destroy($id)
    {
        $message = $this->messages->destroy($id);

        Cache::flush();

        return $message;
    }
}