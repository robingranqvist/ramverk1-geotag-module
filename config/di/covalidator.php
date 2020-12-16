<?php
/**
 * Configuration file for Covaldiator.
 */
return [
    // Services to add to the container.
    "services" => [
        "covalidator" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Robin\Covalidator\Covalidator();
                $obj->setDI($this);
                return $obj;
            }
        ],
    ],
];


// return [

//     // Services to add to the container.
//     "services" => [
//         "covalidator" => [
//             "shared" => true,
//             //"callback" => "\Anax\Response\Response",
//             "callback" => function () {
//                 $obj = new \Anax\Covalidator\Test();
//                 $di = new \Anax\DI\DI();
//                 $di->set("covalidator", "\Anax\Covalidator\Test");
//                 $obj->setDI($this);
//                 return $obj;
//             }
//         ],
//     ],
// ];
