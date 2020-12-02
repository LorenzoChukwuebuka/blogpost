<?php
    date_default_timezone_set("Africa/Lagos");
    function time_elapsed_string( $ptime ){
        $now = date('Y-m-d H:i:s');
        $now = strtotime($now);
        $ptime = strtotime($ptime);
        $estimate_time = $now - $ptime;
        // echo $now.'<br>'.$ptime.'<br>'.$estimate_time;
        if( $estimate_time < 1 )
        {
            return 'less than 1 second ago';
        }
        
        $condition = array(
            12 * 30 * 24 * 60 * 60  =>  'year',
            30 * 24 * 60 * 60       =>  'month',
            24 * 60 * 60            =>  'day',
            60 * 60                 =>  'hour',
            60                      =>  'minute',
            1                       =>  'second'
        );

        foreach( $condition as $secs => $str )
        {
            $d = $estimate_time / $secs;
            
            if( $d >= 1 )
            {
                $r = round( $d );
                return 'about ' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
            }
        }
    }

    // function time_elapsed_string( $ptime ){
    //     $estimate_time = time() - $ptime;

    //     if( $estimate_time < 1 )
    //     {
    //         return 'less than 1 second ago';
    //     }

    //     $condition = array(
    //                 12 * 30 * 24 * 60 * 60  =>  'year',
    //                 30 * 24 * 60 * 60       =>  'month',
    //                 24 * 60 * 60            =>  'day',
    //                 60 * 60                 =>  'hour',
    //                 60                      =>  'minute',
    //                 1                       =>  'second'
    //     );

    //     foreach( $condition as $secs => $str )
    //     {
    //         $d = $estimate_time / $secs;

    //         if( $d >= 1 )
    //         {
    //             $r = round( $d );
    //             return 'about ' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
    //         }
    //     }
    // }
?>