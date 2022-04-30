<?php


namespace App\Services;
use App\Models\LogsModel;
use Exception;

class LogServices{
    /**
     * @param array $arr Required
     * @param string $description Required
     * @param string $user_id optional
     * @param string $client_id optional
     * @param string $demat_id optional
     * @param string $data optional
     * @param string $created_at optional
     * @param string $updated_at optional
     * @param string $updated_at optional
     * @param string $created_by optional
     * @param string $updated_by optional
     * @param string $deleted_by optional
     */
    public static function logEvent(array $arr){
        try{
            $log['description'] = array_key_exists("desc",$arr)?$arr['desc']:null;
            $log['user_id'] = array_key_exists("user_id",$arr)?$arr['user_id']:null;
            $log['client_id'] = array_key_exists("client_id",$arr)?$arr['client_id']:null;
            $log['demat_id'] = array_key_exists("demat_id",$arr)?$arr['demat_id']:null;
            $log['data'] = array_key_exists("data",$arr)?$arr['data']:null;
            if(is_array($log['data'])){
                $log['data'] = json_encode($log['data']);
            }
            $log['created_at'] = array_key_exists("created_at",$arr)?$arr['created_at']:date("Y-m-d h:s:i");
            $log['updated_at'] = array_key_exists("updated_at",$arr)?$arr['updated_at']:date("Y-m-d h:s:i");
            $log['deleted_at'] = array_key_exists("updated_at",$arr)?$arr['updated_at']:date("Y-m-d h:s:i");
            $log['created_by'] = array_key_exists("created_by",$arr)?$arr['created_by']:auth()->user()->id;
            $log['updated_by'] = array_key_exists("updated_by",$arr)?$arr['updated_by']:null;
            $log['deleted_by'] = array_key_exists("deleted_by",$arr)?$arr['deleted_by']:null;
            LogsModel::create($log);
        }catch(Exception $e){
            LogsModel::create(["description"=>"Unable to create logs. ".$e->getMessage(),"data"=>json_encode($arr)]);
        }
    }

    public function getActivity(){
        return LogsModel::orderBy("id","DESC")->get();
    }

    public function getActivityById($id){
        return LogsModel::where("created_by",$id)->orderBy("id","DESC")->get();
    }
}
