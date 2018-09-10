<?php

return [
    'menu' => [
    	'ventas' => [
    		'title' => 'Ventas',
    		'submenu' => [
	    		'pedidos' => [
	    			'title' => 'Pedidos',
	    			'action1' => 'Lista de pedidos',
	    			'action2' => 'POS'
	    		],
	    		'facturacion' => [
	    			'title' => 'Facturación',
	    			'action1' => 'Lista de facturas'
	    		],
	    		'remisiones' => [
	    			'title' => 'Remisiones',
	    			'action1' => 'Lista de remisiones'
	    		],
	    		'cobros' => [
	    			'title' => 'Cobros',
	    			'action1' => 'Consulta de cobranzas'
	    		]
	    	]
    	],
    	'contactos' => [
    		'title' => 'Contactos',
    		'submenu' => [
	    		'clientes' => [
	    			'title' => 'Clientes',
	    			'action1' => 'Lista de clientes',
	    			'action2' => 'Nuevo cliente'
	    		]
	    	]
    	]
    ]
];