<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */
    'owner_name' => 'My Garden',
    'prefijo' =>'myg-',

    'situacion' => [
        '4' => [
            'produccion' => 1,
            'name' => 'PEDIDO',
            'val' => 'Pedido'
        ],
        '6' => [
            'produccion' => 1,
            'name' => 'PRODUCCION',
            'val' => 'Producción'
        ],
        '3' => [
            'produccion' => 1,
            'name' => 'FINALIZADO',
            'val' => 'Finalizado'
        ],
        '1' => [
            'produccion' => 0,
            'name' => 'ANULADO',
            'val' => 'Anulado'
        ],
        '5' => [
            'produccion' => 0,
            'name' => 'PRESUPUESTO',
            'val' => 'Presupuesto'
        ],
        
        '7' => [
            'produccion' => 0,
            'name' => 'RETENER',
            'val' => 'Retener'
        ],
        '2' => [
            'produccion' => 0,
            'name' => 'ELIMINADO',
            'val' => 'Eliminado'
        ]
    ],

    'estado_envio' => [
        '1' => [
            'name' => 'Chofer asignado',
            'val' => 'CHOFER ASIGNADO'
        ],
        '2' => [
            'name' => 'Devuelto',
            'val' => 'DEVUELTO'
        ],
        '3' => [
            'name' => 'En camino',
            'val' => 'EN CAMINO'
        ],
        '4' => [
            'name' => 'Entregado',
            'val' => 'ENTREGADO'
        ]
    ],

    'estado_pedido' => [
        '1' => [
            'name' => 'A pagar',
            'val' => 'A PAGAR'
        ],
        '2' => [
            'name' => 'Cobrado',
            'val' => 'COBRADO'
        ]
    ],


    'tipo_pago' => [
        '1' => [
            'id' => 1,
            'name' => 'CONTADO'
        ],
        '2' => [
            'id' => 1,
            'name' => 'CREDITO'
        ]
    ],

    'formas_pagos' => [
        '1' => [
            'id' => 'EFECTIVO',
            'name' => 'Efectivo'
        ],
        '2' => [
            'id' => 'TARJETA',
            'name' => 'Tarjeta'
        ],
        '3' => [
            'id' => 'TARJETA',
            'name' => 'Cheque'
        ],
        '4' => [
            'id' => 'TRANSFERENCIA',
            'name' => 'Tras. Bancaria'
        ],
        '5' => [
            'id' => 'TIGO MONEY',
            'name' => 'Tigo Money'
        ]

    ],

    'tipo_persona' => [
        '1' => [
            'id' => 'F',
            'name' => 'Física'
        ],
        '2' => [
            'id' => 'N',
            'name' => 'Física/Nombre Fantasía'
        ],
        '3' => [
            'id' => 'J',
            'name' => 'Jurídica'
        ],
        '4' => [
            'id' => 'L',
            'name' => 'Libre de impuesto'
        ]
    ],

    'tipo_doc_persona' => [
        '1' => [
            'id' => 'CI',
            'name' => 'CI'
        ],
        '2' => [
            'id' => 'DNI',
            'name' => 'Pasaporte'
        ]
    ],

    'pos' => [
        '1' => [
            'id' => '1',
            'name' => 'Punto de venta 1'
        ],
        '2' => [
            'id' => '2',
            'name' => 'Punto de venta 2'
        ]
    ]


];
