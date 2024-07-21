<?php
    header('Content-Type: text/json');

    switch (filter_input(INPUT_GET, 'action')) {
        case 'zamestnanci-delete':
            echo json_encode(['status'=>'OK']);
            break;
        case 'oddelenia-delete':
            echo json_encode(['status'=>'OK']);
            break;
        case 'pouzivatelia-delete':
            echo json_encode(['status'=>'OK']);
            break;
    }