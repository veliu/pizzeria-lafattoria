<?php
$projectPath = __DIR__ ;
//Declare directories which contains php code
$scanDirectories = [
   $projectPath . '/assets/',
   $projectPath . '/config/',
   $projectPath . '/src/',
   $projectPath . '/templates/',
   $projectPath . '/node_modules/'
];
//Optionally declare standalone files
$scanFiles = [];
return [
'composerJsonPath' => $projectPath . '/composer.json',
'vendorPath' => $projectPath . '/vendor/',
'scanDirectories' => $scanDirectories,
'scanFiles'=>$scanFiles
];
