<?php
ini_set("display_errors",1);
error_reporting(E_ALL);
function processHTML()
{
    $html = file_get_contents("exp/airlinestable.xml");
    $dom = new domDocument();

    /**
     * * load the html into the object **
     */
    $dom->loadHTML($html);

    /**
     * * discard white space **
     */
    $dom->preserveWhiteSpace = false;

    /**
     * * the table by its tag name **
     */
    $tables = $dom->getElementsByTagName('table');

    /**
     * * get all rows from the table **
     */
    $rows = $tables->item(0)->getElementsByTagName('tr');

    /**
     * * loop over the table rows **
     */
    $data = array();
    $continue = true;
    foreach ($rows as $row) {
        /**
         * * get each column by tag name **
         */
        if ($continue) {
            $continue = false;
            continue;
        }
        $cols = $row->getElementsByTagName('td');

        /**
         * * echo the values **
         */
        echo 'Designation: ' . $cols->item(0)->nodeValue . '<br />';
        echo 'Manager: ' . $cols->item(1)->nodeValue . '<br />';
        echo 'Team: ' . $cols->item(2)->nodeValue;
        echo '<hr />';

        $data[$cols->item(1)->nodeValue] = $cols->item(2)->nodeValue;
    }

    file_put_contents("exp/airlines.php", '<?php $data = ' . var_export($data, 1) . '; ?>');
}


function dumpLogos() {
    global $db;
    $dir = 'include/entrypoints/site/airlinelogos/AirlineLogo/';
    $counter = 0;
    if ($handle = opendir($dir)) {
        while (false !== ($file = readdir($handle))) {
            $counter++;
            if($counter <=2) {
                continue;
            }
            
            $sql = "insert into airlinelogos (filename) values ('".$file."')";
            $db->query($sql);
            echo $file.'<br />';
        
            
            
            
        }
        closedir($handle);
    }
}


function dumpAirlineNames() {
    global $db;
    require_once 'exp/airlines.php';
    $names = array();
    foreach($data as $name) {
        $names[$name] = 
        $sql = "insert into airlinenames (name) values ('".addslashes($name)."')";
        $db->query($sql);
        
    }
}



function fixImages() {
    global $db;
    
    
    $dir = 'include/entrypoints/site/airlinelogos/AirlineLogo/';
    
    
    $sql = "select * from airlinenames where status not in ('exact') ";
    $rows = $db->fetchrows($sql,array("id"));
    
    /*
    
    $exactMatchFound = array();
    foreach($rows as $row) {
        $name = $row['name'];
        
         $name = trim($name);
        $logo = $name.'.gif';
        $sql = "update airlinenames set logo = '".addslashes($logo)."' ,name ='".addslashes($name)."' where id = '".$row['id']."'";
        $db->query($sql);
        continue;
       
        $sql= "select * from airlinelogos where filename like '".addslashes($name)."%'";
        $data = $db->fetchrows($sql,array("id"),"filename");
        
        if($data) {
            $exactMatchFound[$row['id']] = $row;
        }
    
    }
      */
       
     
    $renameFound = array();
    foreach($rows as $id => $row) {
    
        if(empty($row['name'])) {
            continue;
        }
        $name = $row['name'];
        $sql= "select * from airlinelogos where filename like '".addslashes($name)."%'";
        $datar = $db->fetchrows($sql,array("id"));
        
        if($datar) {
            
            foreach($datar as $data) {
            $data['airlinename'] = $name;
            $renameFound[]= $data;
            $fix = $name.".gif";
            $sql = "update airlinenames set status ='fixed',fixlogo='".addslashes($data['filename'])."' where id = '".$id."'";
            $db->query($sql);
            }
            
        }
    } 
    
    
    echo "<pre>";
    print_r($renameFound);
    
    die;
    
    
    
    
}

function checkFixed() {
    global $db;
    
    
    $dir = 'include/entrypoints/site/airlinelogos/AirlineLogo/';
    $absdir = '/var/www/html/phpframework/include/entrypoints/site/airlinelogos/AirlineLogo/';
    
    
    $sql = "select * from airlinenames where status ='fixed' ";
    $rows = $db->fetchrows($sql,array("id"));
    $counter  = 0 ;
    $notfound = array();
    $found = array();
    foreach ($rows as $row) {
        
        $counter++;
        
        $logo = $row['fixlogo'];
        
        if(file_exists($dir.$logo)) {
            //shell_exec("mv ".$absdir.$logo." ".$absdir.$row['name'].'.gif');
            
            rename($absdir.$logo, $absdir.$row['name'].'.gif');
            $found[] = $row;
        } else {
            $notfound[] = $row;
        }
        
        
    }
    
    
    echo "<pre>";
    print_r($found);
    die;
}
//dumpLogos();
//dumpAirlineNames();
//fixImages();

checkFixed();
?>