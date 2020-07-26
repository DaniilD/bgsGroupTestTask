<?php


namespace App\Http\Controllers;


use App\Event;
use App\Jobs\SendMailJob;
use App\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //Подучить всех участников мероприятий
    public function getAllMember(){
        $members = Member::all();
        return response()->json($members);
    }

    //Получить определенного участника
    public function getMember($id){
        $member = Member::find($id);
        return response()->json($member);
    }

    //Получить участников по мероприятию
    public function getFilterMember($event_id){
        $member = Member::where('event_id', $event_id)->get();
        return response()->json($member);
    }

    //Создать Участника мероприятия
    public function createMember(Request  $request){
        $this->validate($request, [
            "name" => "required",
            "last_name" => "required",
            "email" => "required|email|unique:members",
            "event_id"=>"required"
        ]);

        try{
            $member = Member::add($request->all());
            dispatch(new SendMailJob($request->get("email"), "bgs@mail.ru", "Email отправлен...Создан новый участник"));
        }catch (\Exception $e){
            return response()->json(array("Fail"=>True));
        }

        return response()->json($member);
    }

    //Обновить информацию об Участнике мероприятия
    public function updateMember(Request $request, $id){
        $this->validate($request, [
            "email" => "email|unique:members",
        ]);

        $member = Member::find($id);
        if ($member){//если удалось найти участника то обновляем информацию об этом участнике
            if ($request->get("name") != NULL)
                $member->name = $request->get("name");
            if ($request->get("last_name") != NULL)
                $member->last_name = $request->get("last_name");
            if ($request->get("email") != NULL)
                $member->email = $request->get("email");
            if ($request->get("event_id") != NULL)
                $member->event_id = $request->get("event_id");
            $member->save();
            return response()->json($member);
        }else{
            return response()->json(array("Fail"=>True));
        }

    }

    //Удалить информацию об участнике мероприятия
    public function deleteMember($id){
        $member = Member::find($id);
        $result = array();
        if($member){ //если удалось найти участника то удаляем его
            if ($member->delete()){
                $result["isDeleted"] = true;
            }else{
                $result["isDeleted"] = false;
            }
        }else{
            $result["isDeleted"] = false;
        }

        return response()->json($result);
    }

}
