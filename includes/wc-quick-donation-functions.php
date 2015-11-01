<?php

if(! function_exists('wcqd_get_message')){
    function wcqd_get_message($id,$search_replace = array()){
        $message = WC_QD()->db()->get_message($id,$search_replace);
        return $message;
    }
} 

if(! function_exists('wcqd_is_donation')){
    function wcqd_is_donation($order_id = ''){
        if(empty($order_id)){return false;}
        $is_donation = WC_QD()->db()->_is_donation($order_id);
        return $is_donation;
    }
}


if(! function_exists('wcqd_project_limit')){
    /**
     * To Get Projects Min & Max Limit
     * @param  [int] [$project_id = 0] [Post id of the donation project]
     * @param  [int] [$type = 'min']   [use min / max to get the limit]
     * @return [int] [return limit value]
     */
    function wcqd_project_limit($project_id = 0, $type = 'min'){
        if(empty($project_id)){return false; }
        if($type !== 'min' && $type !== 'max'){return false;}
        $function_toCal = $type.'_project';
        $limit = WC_QD()->db()->{$function_toCal}($project_id);
        return $limit;
}
}

if(! function_exists('wcqd_get_project_from_order')){
    /**
     * Returns Project ID From Order ID
     * @param  [int] [$order_id = ''] [pass the order id to get the project id]
     * @return int / boolean  [returns project id if exist or returns false]
     */
    function wcqd_get_project_from_order($order_id = ''){ 
        $is_donation = WC_QD()->db()->_is_donation($order_id);
        if($is_donation){
            $project = WC_QD()->db()->get_project_id($order_id);
            return $project;
        } 
        return false;
    }
}

if(! function_exists('wcqd_get_project_name')){
    /**
     * Returns Project Title From Order ID
     * @param  [int] [$order_id = ''] [pass the order id to get the project title]
     * @return int / boolean  [returns project id if exist or returns false]
     */
    function wcqd_get_project_name($order_id = '', $default_title = ''){  
        $project_id = wcqd_get_project($order_id); 
        $title = get_the_title($project_id);
        if(empty($title)){return $default_title;}
        return $title;
    }
}

   
?>