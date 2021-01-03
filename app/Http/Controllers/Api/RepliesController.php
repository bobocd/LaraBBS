<?php

namespace App\Http\Controllers\Api;

use App\Models\Topic;
use App\Models\Reply;
use App\Http\Requests\Api\ReplyRequest;
use App\Transformers\ReplyTransformer;
use App\User;

class RepliesController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index(Topic $topic){
        $replies = $topic->replies()->paginate(20);
        return $this->response->paginator($replies, new ReplyTransformer())->setStatusCode(201);
    }

    public function userIndex(User $user){

        $replies = $user->replies()->paginate(20);
        return $this->response->paginator($replies, new ReplyTransformer())->setStatusCode(201);
    }
    public function store(ReplyRequest $request,Topic $topic, Reply $reply)
    {

        $reply->content = $request->content;
        $reply->topic_id = $topic->id;
        $reply->user_id = $this->user()->id;
        $reply->save();
//        $reply->create(['content'=>'回复内容','topic_id'=>'1','user_id'=>'13']);
        return $this->response->item($reply, new ReplyTransformer())
            ->setStatusCode(201);
    }

    public function destroy(Topic $topic, Reply $reply)
    {
        if ($reply->topic_id != $topic->id) {
            return $this->response->errorBadRequest();
        }
        $this->authorize('destroy', $reply);
        $reply->delete();
        return $this->response->noContent();
    }
}
