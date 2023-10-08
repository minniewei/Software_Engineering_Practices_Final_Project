<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // list all messages
        $messages=DB::table('messages_')->get();
        return view('HomePage',compact('messages'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // show the page for creating post
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $request->validate([ //驗證說有沒有少打title或content
            'title' => 'required|max:255',
            'content' => 'required|max:255',
        ]);
        //創建新的訊息並放入資料庫
        $message=new Message;
        $message->userid=Auth::user()->id;
        $message->content=$request->content;
        $message->title=$request->title;
        $message->save();
        //將資料庫中的訊息取出來(也可直接呼叫index方法(但我不知道怎麼做，哭))
        $messages=DB::table('messages_')->get();
        return redirect()->to('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $message = Message::find($id);
        return view('post.edit',compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([ //驗證說有沒有少打title或content
            'title' => 'required|max:255',
            'content' => 'required|max:255',
        ]);

        $message = Message::find($id);
        $message->title = request('title');
        $message->content = request('content');
        $message->userid = \Auth::id();
        $message->save();
        return redirect()->to('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Message::find($id);
        $message->delete();
        return redirect()->to('/');
    }
}
