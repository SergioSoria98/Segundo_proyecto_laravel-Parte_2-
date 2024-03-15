<?php

namespace App\Http\Controllers;


use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\MessageWasReceived;
use App\Repositories\MessagesInterface;

class MessagesController extends Controller
{
    protected $messages;

    function __construct(MessagesInterface $messages)
    {
        $this->messages = $messages;
        $this->middleware('auth', ['except' => ['create', 'store']]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = $this->messages->getPaginated();

        return view('messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('messages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = $this->messages->store($request);

        event(new MessageWasReceived($message));

        return redirect()->route('mensajes.create')->with('info', 'Hemos recibido tu mensaje');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $message = $this->messages->findById($id);
         

        return view('messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $message = $this->messages->findById($id);

        return view('messages.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $message = $this->messages->update($request, $id);

        return redirect()->route('mensajes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->messages->destroy($id);

        return redirect()->route('mensajes.index');
    }
}
