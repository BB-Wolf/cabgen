<?php

error_reporting(E_ALL);


$dir='/home/bitrix/ext_www/cablegen.sianlab.site/';
$output='index.php';
$templateFile='index.tpl';  
$noneBabylon='parts_new/none_babylon_functions.js';
$predefinedModels='parts_new/predefined_models.js';
$light='parts_new/light.js';
$matFile='parts_new/materials.js';

$getVersionFile = file_get_contents($dir.'version.json');
$versionData = json_decode($getVersionFile,true);


$template=file_get_contents($dir.$templateFile);


$openDir=array_diff(scandir($dir.'parts_new/'),array('..','.'));
foreach($openDir as $key=>$value)
{
    $fileContent=file_get_contents($dir.'parts_new/'.$value);
    $filePart=str_replace('.js','',$value);
    $filePlacer='<'.trim($filePart).'>';
    $template=str_replace($filePlacer,$fileContent,$template);
}




if( isset($argv[1]) && $argv[1]=='latest') {
    $getminor = $versionData['current'];
    $minorEx = explode('.',$getminor);
    $minorEx[count($minorEx)-1] = $minorEx[count($minorEx)-1]+1;
    $minorNew = implode('.',$minorEx);
    if(!is_dir($dir.$versionData['latestFolder'].'/'.$minorNew)){
        mkdir($dir.$versionData['latestFolder'].'/'.$minorNew);
    }
    file_put_contents($dir.$versionData['latestFolder'].'/'.$minorNew.'/index.php',$template);
    $versionData['current'] = $minorNew;
    file_put_contents('/home/bitrix/ext_www/cablegen.sianlab.site/version.json',json_encode($versionData)  );
}

if(isset($argv[0]) && $argv[0]!='latest') {
    file_put_contents($dir . $versionData['bleedingEdgeFolder'] . '/index.php', $template);
}


if( isset($argv[1]) && $argv[1]=='minor') {
    $getminor = $versionData['current'];
    $minorEx = explode('.',$getminor);
    echo count($minorEx);
    if(count($minorEx)<3)
    {
        array_push($minorEx,1);
        $minorNew = implode('.',$minorEx);
        if(!is_dir($dir.'minor/'.$minorNew)){
            mkdir($dir.'minor/'.$minorNew);}
        file_put_contents($dir.'minor/'.$minorNew.'/index.php',$template);
        $versionData['minor'] = $minorNew;
        $versionData['current'] = $minorNew;
    }else
    {
        $minorEx[count($minorEx)-1] = $minorEx[count($minorEx)-1]+1;
        $minorNew = implode('.',$minorEx);
        while(is_dir($dir.'minor/'.$minorNew))
        {
            $minorEx[count($minorEx)-1] = $minorEx[count($minorEx)-1]+1;
            $minorNew = implode('.',$minorEx);
        }
        $minorNew = implode('.',$minorEx);
        if(!is_dir($dir.'minor/'.$minorNew)){
            mkdir($dir.'minor/'.$minorNew);}
        file_put_contents($dir.'minor/'.$minorNew.'/index.php',$template);
        $versionData['minor'] = $minorNew;
    }
    file_put_contents('/home/bitrix/ext_www/cablegen.sianlab.site/version.json',json_encode($versionData)  );
}
