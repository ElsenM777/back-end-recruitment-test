<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Query;
use App\Models\Question;
use App\Models\Answer;
use App\Models\AnswerQuestion;
use Faker\Factory as Faker;


class QueryController extends Controller
{
    public function index(){
        return view('query.index',['queries' => Query::all()]);
    }

    public function new_query(){
        return view('query.add');
    }

    public function new_query_post(Request $req){
        $req->validate([
            'ad'  => 'required | min:3 | max:100 ',
            'say' => 'required | numeric| min:1 | max:30'   
        ]);
        $Faker = Faker::create();
        $queryLastId = Query::insertGetId([
            'name'  => $req->post('ad'),
            'count' => $req->post('say')
        ]); 
        for($i=0; $i<$req->post('say'); $i++){
            $questions[$i] = ['body' => $Faker->text($maxNbChars=100)];
        }  
        $lastInsertedQuestions = Query::find($queryLastId)->question()->createMany($questions);
        foreach($lastInsertedQuestions as $key => $lastQuestion){
            $answerCount = rand(2,5);
            $correct     = rand(1,$answerCount);
            for ($i=0; $i<$answerCount; $i++) { 
                if($correct == $i+1){
                    $answers[$i] = ['body' => $Faker->name, 'correct' => 1];
                }else{
                    $answers[$i] = ['body' => $Faker->name];
                }
            }
            Question::find($lastQuestion->id)->answer()->createMany($answers);
        }
        return redirect('new-query')->with('status', 'Sorğu əlavə olundu!');
    }

    public function query($id){
        $query = Query::find($id);
        $questionClass = new Question;
        $resultClass = new AnswerQuestion;
        if(!$query){
            abort(404);
        }
        $questions = $query->question;
        return view('query.query',[
            'query'    => $query,
            'questions' => $questions,
            'questionClass' => $questionClass,
            'resultClass' => $resultClass
        ]);
    }

    public function query_save(Request $req){
        $answers = $req->post();
        unset($answers['_token']);
        unset($answers['_query']);
        $s=0;
        foreach($answers as $key => $answer){
            AnswerQuestion::updateOrInsert(
                ['question_id' => $key],
                ['answer_id' => $answer]
            );
        }
        echo '<i class="fas fa-check text-success"></i> Dəyişikliklər yadda saxlanıldı.';
    }

    public function query_result(Request $req){
        $answers = $req->post();
        $query = $answers['_query'];
        unset($answers['_query']);
        unset($answers['_token']);
        $count = Query::find($query)->count;
        $correct_count = 0;
        if(Query::find($query)->result == -1){
            if($count == count($answers)){
                foreach($answers as $key => $answer){
                    if(Answer::find($answer)->correct == 1){
                        $correct_count++;
                    }
                    AnswerQuestion::updateOrInsert(
                        ['question_id' => $key],
                        ['answer_id' => $answer]
                    );
                    Query::where('id',$query)->update([
                        'result' => $correct_count
                    ]);
                }
                echo '<i class="fas fa-times text-warning"></i> Nəticəniz '.$correct_count.'/'.$count.' ('.round($correct_count/$count*100).'%)';
            }else{
                echo '<i class="fas fa-times text-danger"></i> Nəticəni göstərmə üçün bütün suallara cavab verilməlidi!';
            }
        }
    }
}
