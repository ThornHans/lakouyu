<?php
 



function listFolderFiles($dir){
	    $fileInfo     = scandir($dir);
	    $allFileLists = [];
	    $path = '';
	    
	    $allPathLists = [];



	    foreach ($fileInfo as $folder) {
	        if ($folder !== '.' && $folder !== '..') {
	            if (is_dir($dir .  DIRECTORY_SEPARATOR. $folder) === true) {
	            	
	                 listFolderFiles($dir . DIRECTORY_SEPARATOR. $folder);
	             
	                
 
	            } else {
	                // $allFileLists[$folder] = $folder;
	                $full_path = $dir . DIRECTORY_SEPARATOR. $folder;
	                $allFileLists[$folder] = $full_path;

	            }
	            
	        }
	    }

	    return $full_path;

	}//end listFolderFiles()
	    
         
?>