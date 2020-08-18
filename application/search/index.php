 <?php


      $files = get_filelist_as_array('/application/views/',
        true,'',false);


      if($files){
        foreach ($files as $file) {
            // $file = str_replace('/var/www/html/', 'http://lakouyu.com/', $file);

            // //$data = file_get_contents($file);

            // if(strpos($data, $q )){
                array_push($urls, $file);

            // }
            // else{
            //  $urls = ['not in'];

            // }
            
        }
    }


    else{
        $urls = ['nix'];
    }
    
    print_r($urls);


 public function get_filelist_as_array($dir, $recursive = true, $basedir = '', $include_dirs = false) {
            if ($dir == '') {return array();} else {$results = array(); $subresults = array();}
            if (!is_dir($dir)) {$dir = dirname($dir);} // so a files path can be sent
            if ($basedir == '') {$basedir = realpath($dir).DIRECTORY_SEPARATOR;}

            $files = scandir($dir);
            foreach ($files as $key => $value){
                if ( ($value != '.') && ($value != '..') ) {
                    $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
                    if (is_dir($path)) {
                        // optionally include directories in file list
                        if ($include_dirs) {$subresults[] = str_replace($basedir, '', $path);}
                        // optionally get file list for all subdirectories
                        if ($recursive) {
                            $subdirresults = get_filelist_as_array($path, $recursive, $basedir, $include_dirs);
                            $results = array_merge($results, $subdirresults);
                        }
                    } else {
                        // strip basedir and add to subarray to separate file list
                        $subresults[] = str_replace($basedir, '', $path);
                    }
                }
            }
            // merge the subarray to give the list of files then subdirectory files
            if (count($subresults) > 0) {$results = array_merge($subresults, $results);}
            
            return $results;
        }
?>