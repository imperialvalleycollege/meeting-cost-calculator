<?php 
require 'code/vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/', function () {
    $jsonString = file_get_contents('code/data/ivc_salary_per_second.json');
    /*
    
    $data = json_decode($jsonString);
    $data = (array) $data;
    
    ksort($data);
    
    echo "<pre>";
        echo print_r($data['victor.jaime'], true);
    echo "</pre>";
    
    echo "Victor Jaime's Salary Per Hour is: $" . number_format($data['victor.jaime']->SAL_SECOND * 3600, 2);
    echo "<br />";
    echo "Hello, Homepage"; */
    $title = 'Homepage';
    //$body = 'Cool stuff here'; 
    
    ob_start();

    include 'code/templates/views/heading.php';

    $body = ob_get_contents();
    
    ob_get_clean();
    
    include 'code/templates/default.php';
});

// API group
$app->group('/api', function () use ($app) {
    // Get book with ID
    $app->get('/:username', function ($username) {
        $jsonString = file_get_contents('code/data/ivc_salary_per_second.json');
        $data = json_decode($jsonString);
        $data = (array) $data;
        
        if (isset($data[$username]))
        {
            $record = $data[$username];
            header("Content-Type: application/json");
            echo json_encode($record);
            exit;    
        }
        
        header("Content-Type: application/json");
            echo json_encode("No record found!");
            exit;    
        
    });
    
    
    $app->get('/salary-greater-than/:number', function ($number) {
        $jsonString = file_get_contents('code/data/ivc_salary_per_second.json');
        $data = json_decode($jsonString);
        $data = (array) $data;
        
        $greaterThanList = array();
        foreach($data as $username => $user)
        {
            if (($user->SAL_SECOND * 3600) > $number)
            {
                $greaterThanList[$username] = $user;
            }
        }
        
        if (isset($data[$username]))
        {
            $record = $data[$username];
            header("Content-Type: application/json");
            echo json_encode($greaterThanList);
            exit;    
        }
        
        header("Content-Type: application/json");
            echo json_encode("No records found where salary per hour exceeded" . $number . "!");
            exit;    
        
    });    
});

$app->run();