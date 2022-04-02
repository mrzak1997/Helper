<?php

include "../Model/FlowChart/InsertFlowChartModel.php";

class flowchart_management{
    public function main($nodes_arr,$information){

        $information["project_id"] = $this->insert_project_name($information);

        $Response["status_loc"]="create_flowchart";
        $Response["Token"]=null;
        $Response["role"]=null;

        if(!$this->isEmpty($information) && !$this->isEmpty($nodes_arr)){
            $Response["status_loc"]="create_flowchart";
            $Response["status_number"]=753;
            $Response["Token"]=null;
            $Response["role"]=null;
            return $this->getResponseMessage($Response);
        }

        if(!$information["project_id"]){
            //yek proje ba in nam mojod ast
            $Response["status_number"]=750;
            return $this->getResponseMessage($Response);
        }
        if($this->insert_nodes($nodes_arr,$information)){
            //proje ejad shod
            $Response["status_number"]=200;
            return $this->getResponseMessage($Response);
        }else{
            //eshkal dar ejad proje
            $Response["status_number"]=755;
            return $this->getResponseMessage($Response);
        }
    
    }
    private function isEmpty($user){
        foreach($user as $string){
            if($string == null){
                return false;
            }
        }
        return true;
    }
    private function insert_project_name($information){
        $InsertFlowChart = new InsertFlowChartModel();
        
        return $InsertFlowChart->insert_project_name($information["username"],$information["project_name"]); 
    }
    private function insert_nodes($nodes_arr,$information){
        $InsertFlowChart = new InsertFlowChartModel();
        
        return $InsertFlowChart->insert_nodes($nodes_arr,$information); 
    }
    public function getResponseMessage($Response_data){
        $GetResponseMessage = new GetResponseMessage();
        $MakeResponse = new MakeResponse();

        return $MakeResponse->globalResponse($GetResponseMessage ->GetResponse($Response_data)); 
    }
}
?>