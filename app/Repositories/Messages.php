<?php

namespace App\Repositories;


use App\Models\Message;
use Psr\Http\Message\MessageInterface;

class Messages implements MessagesInterface
{
    public function getPaginated()
    {
        return Message::with(['user', 'note', 'tags'])
                    ->orderBy('created_at', request('sorted', 'DESC'))
                    ->paginate(10);

    }


    public function store($request)
    {
        $message = Message::create($request->all());

        $message->user_id = auth()->id();
        $message->save();

        return $message;
    }


    public function findById($id)
    {
        return Message::findOrFail($id);
    }


    public function update($request, $id)
    {
        return Message::findOrFail($id)->update($request->all());
    }


    public function destroy($id) 
    {
        return Message::findOrFail($id)->delete();
    }

}



