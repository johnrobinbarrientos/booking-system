<?php

namespace App\Main;

class AdminMenu
{
    /**
     * List of side menu items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function menu()
    {
        return [
            'dashboard' => [
                'icon' => 'home',
                'route_name' => 'dashboard',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Dashboard',
            ],
            'Bookings' => [
                'icon' => 'calendar',
                'title' => 'Bookings',
                'sub_menu' => [
                    'new-booking' => [
                        'icon' => 'plus',
                        'route_name' => 'bookings.create',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'New Booking',
                    ],
                    'all-booking' => [
                        'icon' => '',
                        'route_name' => 'bookings.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'All Booking',
                    ],
                ]
            ],
            'Clients' => [
                'icon' => 'users',
                'title' => 'Clients',
                'sub_menu' => [
                    'add-new-client' => [
                        'icon' => '',
                        'route_name' => 'clients.create',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Add New Client',
                    ],
                    'all-client' => [
                        'icon' => '',
                        'route_name' => 'clients.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'All Client',
                    ],
                ]
            ],
            'Projects' => [
                'icon' => 'briefcase',
                'title' => 'Projects',
                'sub_menu' => [
                    'add-new-project' => [
                        'icon' => '',
                        'route_name' => 'projects.create',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Add New Project',
                    ],
                    'all-projects' => [
                        'icon' => '',
                        'route_name' => 'projects.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'All Project',
                    ],
                ]
            ],
            'SubContractors' => [
                'icon' => 'users',
                'title' => 'Sub Contractors',
                'sub_menu' => [
                    'add-new-subbie' => [
                        'icon' => '',
                        'route_name' => 'subbies.create',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Add New Subbie',
                    ],
                    'all-subbies' => [
                        'icon' => '',
                        'route_name' => 'subbies.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'All Subbie',
                    ],
                ]
            ],
            'Concrete Suppliers' => [
                'icon' => 'zap',
                'title' => 'Concrete Suppliers',
                'sub_menu' => [
                    'add-new-supplier' => [
                        'icon' => '',
                        'route_name' => 'concreteSuppliers.create',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Add New Supplier',
                    ],
                    'all-suppliers' => [
                        'icon' => '',
                        'route_name' => 'concreteSuppliers.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'All Concrete Suppliers',
                    ],
                ]
            ],
            'Job Types' => [
                'icon' => 'zap',
                'title' => 'Job Types',
                'sub_menu' => [
                    'add-new-type' => [
                        'icon' => '',
                        'route_name' => 'concreteTypes.create',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Add New Job Type',
                    ],
                    'all-suppliers' => [
                        'icon' => '',
                        'route_name' => 'concreteTypes.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'All Job Types',
                    ],
                ]
            ],
            'devider',
            'Pumps' => [
                'icon' => 'truck',
                'title' => 'Pumps',
                'sub_menu' => [
                    'add-new-pump' => [
                        'icon' => '',
                        'route_name' => 'pumps.create',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Add New Pump',
                    ],
                    'all-pumps' => [
                        'icon' => '',
                        'route_name' => 'pumps.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'All Pumps',
                    ],
                ]
               
            ],
            'Pump Make' => [
                'icon' => 'truck',
                'title' => 'Pump Manufacturer',
                'sub_menu' => [
                    'add-new-make' => [
                        'icon' => '',
                        'route_name' => 'pumpMake.create',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Add New Make',
                    ],
                    'all-makes' => [
                        'icon' => '',
                        'route_name' => 'pumpMake.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'All Makes',
                    ],
                ]
               
            ],
            
            'Pricing' => [
                'icon' => 'dollar-sign',
                'title' => 'Pricing',
                'sub_menu' => [
                    'Pump Prices' => [
                        'icon' => 'dollar-sign',
                        'route_name' => 'pump-prices.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Pricing Table'
                    ],
                ]
            ],

            'Workers' => [
                'icon' => 'users',
                'title' => 'Workers',
                'sub_menu' => [
                    'add-new-worker' => [
                        'icon' => '',
                        'route_name' => 'workers.create',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Add New Worker',
                    ],
                    'all-worker' => [
                        'icon' => '',
                        'route_name' => 'workers.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'All Worker',
                    ],
                ]
            ],
            'Users' => [
                'icon' => 'users',
                'route_name' => 'users.index',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Users'
            ],
            'Reports' => [
                'icon' => 'printer',
                'title' => 'Reports',
                'sub_menu' => [
                    'Pumps' => [
                        'icon' => 'truck',
                        'title' => 'Pumps',
                        'sub_menu' => [
                            'Pumps Health' => [
                                'icon' => 'truck',
                                'route_name' => 'pumpHealth',
                                'params' => [
                                    'layout' => 'side-menu'
                                ],
                                'title' => 'Health Report',
                            ],
                            'Pumps Financial' => [
                                'icon' => 'truck',
                                'route_name' => 'pumpFinancialHistory',
                                'params' => [
                                    'layout' => 'side-menu'
                                ],
                                'title' => 'Financial Report',
                            ], 
                            'Pumps History' => [
                                'icon' => 'truck',
                                'route_name' => 'pumpHistory',
                                'params' => [
                                    'layout' => 'side-menu'
                                ],
                                'title' => 'History Report',
                            ],
                        ]
                    ],
                    'Clients' => [
                        'icon' => 'truck',
                        'title' => 'Clients',
                        'sub_menu' => [
                            'Clients Financial' => [
                                'icon' => 'users',
                                'route_name' => 'clientFinancialHistory',
                                'params' => [
                                    'layout' => 'side-menu'
                                ],
                                'title' => 'Financial Report',
                            ],
                        ]
                    ],
                    'Workers' => [
                        'icon' => 'truck',
                        'title' => 'Workers',
                        'sub_menu' => [
                            'Expiring Licenses' => [
                                'icon' => 'users',
                                'route_name' => 'expiringLicenses',
                                'params' => [
                                    'layout' => 'side-menu'
                                ],
                                'title' => 'Expiring Licenses',
                            ],
                        ]
                    ],
                ]
            ],
            'devider',
            'Account' => [
                'icon' => 'settings',
                'route_name' => 'profile',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Account'
            ],
            'Logout' => [
                'icon' => 'log-out',
                'route_name' => 'user.logout',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Logout'
            ],
        ];
    }
}
