<?php

    function query_array_merge($array){
        parse_str($_SERVER['QUERY_STRING'], $query_array);
        foreach($array as $key => $val)
            $query_array[$key] = $val;
        return http_build_query($query_array);
    }
