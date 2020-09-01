<?php

namespace App\Http\Controllers;

use App\Poll;
use App\PollAnswers;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function savePoll(Request $request){
        try {
            $poll = new Poll();
            $poll->title = $request->pollTitle;
            $poll->save();
            $answerList = json_decode($request->answersList, true);
            foreach ($answerList as $item){
                if (!empty($item)){
                    $answer = new PollAnswers();
                    $answer->answer = $item;
                    $answer->id_poll = $poll->id;
                    $answer->save();
                }
            }
            return json_encode(['status' => true, 'url' => base64_encode($poll->id)]);
        }catch (\Exception $exception){
            return json_encode(['status' => false, 'error' => $exception->getMessage()]);
        }


    }
}
