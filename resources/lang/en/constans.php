<?php

return [
    'menu' => [
    	'ventas' => [
    		'title' => 'Sales',
    		'submenu' => [
	    		'pedidos' => [
	    			'title' => 'Orders',
	    			'action1' => 'Order list',
	    			'action2' => 'POS'
	    		],
	    		'facturacion' => [
	    			'title' => 'Invoices',
	    			'action1' => 'List of invoices'
	    		],
	    		'remisiones' => [
	    			'title' => 'Remissions',
	    			'action1' => 'List of referrals'
	    		],
	    		'cobros' => [
	    			'title' => 'Payments',
	    			'action1' => 'Consulta de cobranzas'
	    		]
	    	]
    	],
    	'contactos' => [
    		'title' => 'Contacts',
    		'submenu' => [
	    		'clientes' => [
	    			'title' => 'Clients',
	    			'action1' => 'List of clients',
	    			'action2' => 'Add new client'
	    		]
	    	]
    	]

    ]
];