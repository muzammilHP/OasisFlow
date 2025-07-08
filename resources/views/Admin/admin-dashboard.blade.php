<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OASISFLOW - Admin Dashboard</title>
    @vite(['resources/css/admin.css', 'resources/js/app.js'])
    <style>
        /* Custom scrollbar for table */
        .table-container {
            overflow-x: auto;
            overflow-y: hidden;
            max-width: 100%;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            scrollbar-width: thin;
            scrollbar-color: #cbd5e0 #f7fafc;
            position: relative;
        }
        
        .table-container::-webkit-scrollbar {
            height: 12px;
        }
        
        .table-container::-webkit-scrollbar-track {
            background: #f7fafc;
            border-radius: 6px;
        }
        
        .table-container::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #cbd5e0, #a0aec0);
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }
        
        .table-container::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(45deg, #a0aec0, #718096);
        }
        
        /* Delivery record table styles */
        .delivery-record-table tbody tr:hover {
            background-color: #f8f9fa !important;
            transform: translateX(2px);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .delivery-record-table td {
            transition: all 0.3s ease;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .table-container {
                margin: 0 -15px;
                border-radius: 0;
                border-left: none;
                border-right: none;
            }
        }
        
        /* Force layout fix for desktop */
        @media (min-width: 769px) {
            .main-content {
                margin-left: 280px !important;
                width: calc(100% - 280px) !important;
            }
            
            .sidebar {
                position: fixed !important;
                left: 0 !important;
                top: 0 !important;
                width: 280px !important;
                transform: translateX(0) !important;
            }
        }
        
        /* Table responsive improvements */
        #customersTable {
            min-width: 6000px; /* Increased from 4000px to accommodate wider columns */
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 14px; /* Increased from smaller sizes */
        }
        
        #customersTable th,
        #customersTable td {
            border-right: 1px solid #e9ecef;
            word-wrap: break-word;
            word-break: break-word; /* Added for better text breaking */
            vertical-align: middle;
            padding: 12px 10px; /* Increased padding */
            line-height: 1.4;
            white-space: normal; /* Allow text wrapping */
            overflow-wrap: break-word; /* Handle long words */
        }
        
        #customersTable th:last-child,
        #customersTable td:last-child {
            border-right: none;
            position: sticky;
            right: 0;
            background: white;
            z-index: 10;
            box-shadow: -2px 0 5px rgba(0,0,0,0.1);
        }
        
        /* Status column is now a regular column - no sticky positioning */
        
        /* Enhanced text sizes and readability */
        #customersTable th {
            font-size: 14px; /* Increased from 13px */
            font-weight: 800; /* Made extra bold */
            background: #f8f9fa !important;
            color: #1a1a1a !important; /* Darker text for better contrast */
            text-transform: uppercase;
            letter-spacing: 0.8px; /* Increased letter spacing */
            padding: 15px 12px; /* Increased padding */
            border-bottom: 3px solid #dee2e6 !important; /* Thicker bottom border */
        }
        
        #customersTable td {
            font-size: 14px; /* Increased from 13px */
            color: #333;
            padding: 15px 12px; /* Increased padding */
            line-height: 1.5; /* Better line height */
        }
        
        /* Customer ID styling */
        #customersTable .customer-id {
            font-weight: 700;
            color: #2196f3;
            font-size: 15px; /* Increased */
        }
        
        /* Name styling */
        #customersTable .customer-name {
            font-weight: 600;
            color: #333;
            font-size: 15px; /* Increased */
        }
        
        /* Numeric values styling */
        #customersTable .numeric-value {
            font-weight: 600;
            font-size: 14px; /* Increased */
            text-align: center;
        }
        
        /* Contact info styling */
        #customersTable .contact-info {
            font-size: 13px; /* Increased */
            color: #555;
        }
        
        /* Status badges - larger and more prominent */
        .status-badge {
            padding: 10px 18px !important; /* Increased padding */
            border-radius: 25px !important;
            font-size: 13px !important; /* Increased font size */
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            display: inline-block;
            min-width: 100px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15) !important;
        }
        
        /* Action buttons - larger and more prominent */
        .action-buttons {
            display: flex;
            gap: 8px; /* Increased gap */
            flex-wrap: nowrap;
            min-width: 150px; /* Increased min width */
        }
        
        .action-btn {
            padding: 10px 14px !important; /* Increased padding */
            font-size: 12px !important; /* Increased font size */
            border-radius: 6px !important;
            font-weight: 600 !important;
            cursor: pointer;
            transition: all 0.3s ease;
            flex: 1;
            min-width: 70px; /* Increased min width */
            text-align: center;
        }
        
        .action-btn:hover {
            transform: translateY(-2px); /* More prominent hover effect */
            box-shadow: 0 6px 15px rgba(0,0,0,0.2) !important;
        }
        
        /* Sticky columns enhancement - only Actions column fixed */
        #customersTable th:last-child,
        #customersTable td:last-child {
            position: sticky;
            right: 0;
            background: #fff3e0 !important; /* Light orange background for Actions column */
            z-index: 10;
            box-shadow: -4px 0 8px rgba(0,0,0,0.2) !important; /* Stronger shadow */
            border-left: 3px solid #ff9800 !important; /* Orange border for Actions */
            width: 170px; /* Increased width */
            min-width: 170px; /* Increased min width */
        }
        
        #customersTable th:last-child {
            background: #f57c00 !important; /* Dark orange for Actions header */
            color: white !important;
            font-weight: 900 !important; /* Extra bold for fixed header */
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="logo">
                <h1>💧 OASISFLOW</h1>
                <div class="tagline">Pure Water Delivered</div>
            </div>
            <nav class="nav-menu">
                <div class="nav-item active" data-page="dashboard">
                    <i>🏠</i>
                    <span>Dashboard</span>
                </div>
                <div class="nav-item" data-page="drivers-management">
                    <i>📦</i>
                    <span>Drivers Management</span>
                </div>
                <div class="nav-item" data-page="customers">
                    <i>📦</i>
                    <span>Customers Management</span>
                </div>
                <div class="nav-item" data-page="assign-customers">
                    <i>🏷️</i>
                    <span>Assign Customers</span>
                </div>
                <div class="nav-item" data-page="deliveries">
                    <i>📋</i>
                    <span>Deliveries Record</span>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content" style="margin-left: 280px; width: calc(100% - 280px); min-height: 100vh;">
            <!-- Top Bar -->
            <div class="topbar">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <button class="mobile-menu-btn" onclick="toggleMobileMenu()">☰</button>
                    <h2 id="page-title">Dashboard</h2>
                </div>
                <div class="user-profile">
                    <div class="weather-widget" style="padding: 10px; font-size: 12px; margin: 0;">
                        <div>Abu Dhabi: 32°C ☀️</div>
                    </div>
                    <!-- <div class="notification-icon" onclick="showNotifications()">
                        🔔
                        <div class="notification-badge">{{ $pendingCustomers > 0 ? $pendingCustomers : '0' }}</div>
                    </div> -->
                    <div class="user-avatar">AD</div>
                    <div>
                        <div style="font-weight: 600;">System Admin</div>
                        <div style="font-size: 12px; color: #666;">OasisFlow Manager</div>
                    </div>
                    <button class="logout-btn" onclick="adminLogout()" style="background: #ff4757; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-size: 14px; margin-left: 15px; transition: all 0.3s ease;" onmouseover="this.style.background='#ff3838'; this.style.transform='scale(1.05)'" onmouseout="this.style.background='#ff4757'; this.style.transform='scale(1)'">>
                        🚪 Logout
                    </button>
                </div>
            </div>

            <!-- Content Area -->
            <div class="content-area">
                <!-- Dashboard Page -->
                <div class="page-section active" id="dashboard">
                    <!-- Admin Welcome Section -->
                    <div style="background: linear-gradient(135deg, #0277bd, #0288d1); color: white; padding: 30px; border-radius: 20px; margin-bottom: 30px; position: relative; overflow: hidden;">
                        <div style="position: absolute; top: -20px; right: -20px; opacity: 0.1; font-size: 120px;">⚡</div>
                        <div style="position: relative; z-index: 2;">
                            <h2 style="margin: 0 0 10px 0; font-size: 28px;">Good morning, Admin! 👋</h2>
                            <p style="margin: 0 0 20px 0; font-size: 16px; opacity: 0.9;">Welcome to your OasisFlow management dashboard. Monitor operations and manage your water delivery service efficiently.</p>
                            <div style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                                <button class="btn" style="background: rgba(255,255,255,0.2); color: white; border: 2px solid rgba(255,255,255,0.3); padding: 12px 25px; font-size: 16px; font-weight: 600;" onclick="showPage('drivers-management')">
                                    🚚 Manage Drivers
                                </button>
                                <button class="btn" style="background: rgba(255,255,255,0.2); color: white; border: 2px solid rgba(255,255,255,0.3); padding: 12px 25px; font-size: 16px; font-weight: 600;" onclick="showPage('customers')">
                                    � Manage Customers
                                </button>
                                <div style="font-size: 14px; opacity: 0.8;">
                                    📊 System Status: <strong style="color: #4caf50;">All Systems Online</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Admin Stats Grid -->
                    <div class="stats-grid" style="margin-bottom: 30px;">
                        <div class="stat-card" style="background: linear-gradient(135deg, #4caf50, #66bb6a); color: white;">
                            <h3>Total Drivers</h3>
                            <div class="value">{{ $totalDrivers }}</div>
                            <div class="change" style="color: rgba(255,255,255,0.8);">{{ $activeDrivers }} active now</div>
                        </div>
                        <div class="stat-card" style="background: linear-gradient(135deg, #ff9800, #ffb74d); color: white;">
                            <h3>Total Customers</h3>
                            <div class="value">{{ $totalCustomers }}</div>
                            <div class="change" style="color: rgba(255,255,255,0.8);">{{ $pendingCustomers }} pending orders</div>
                        </div>
                        <div class="stat-card" style="background: linear-gradient(135deg, #9c27b0, #ba68c8); color: white;">
                            <h3>Active Deliveries</h3>
                            <div class="value">{{ $onDeliveryDrivers }}</div>
                            <div class="change" style="color: rgba(255,255,255,0.8);">drivers on delivery</div>
                        </div>
                        <div class="stat-card" style="background: linear-gradient(135deg, #f44336, #ef5350); color: white;">
                            <h3>Total Revenue</h3>
                            <div class="value">AED {{ number_format($totalRevenue, 2) }}</div>
                            <div class="change" style="color: rgba(255,255,255,0.8);">{{ $deliveredCustomers }} completed orders</div>
                        </div>
                    </div>

                    <!-- Recent Activities with Live Status -->
                    <div style="background: white; padding: 25px; border-radius: 20px; margin-bottom: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                            <h3 style="margin: 0; color: #333; font-size: 22px;">� Recent Activities</h3>
                            <button class="btn btn-primary" onclick="showPage('deliveries')" style="font-size: 14px;">View All Activities</button>
                        </div>
                        
                        <!-- Live Activity Cards -->
                        <div style="display: grid; gap: 15px;">
                            <!-- Activity 1 - New Customer Registration -->
                            <div style="border: 2px solid #e8f5e8; border-radius: 15px; padding: 20px; background: linear-gradient(135deg, #e8f5e8, #f1f8e9);">
                                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                                    <div style="flex: 1; min-width: 200px;">
                                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                                            <div style="background: #4caf50; color: white; padding: 4px 8px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                                NEW CUSTOMER
                                            </div>
                                            <div style="display: flex; align-items: center; gap: 5px;">
                                                <div style="width: 8px; height: 8px; background: #4caf50; border-radius: 50%; animation: pulse 2s infinite;"></div>
                                                <span style="color: #4caf50; font-weight: 600; font-size: 14px;">Just Now</span>
                                            </div>
                                        </div>
                                        <div style="font-size: 16px; font-weight: 600; color: #333; margin-bottom: 5px;">New customer registration in Abu Dhabi</div>
                                        <div style="font-size: 14px; color: #666;">Customer ID: #CUS{{ str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT) }} | 8 bottles ordered</div>
                                    </div>
                                    <div style="text-align: center; min-width: 120px;">
                                        <div style="background: #4caf50; color: white; padding: 8px 16px; border-radius: 25px; font-weight: 600; margin-bottom: 10px;">
                                            ✅ Registered
                                        </div>
                                        <div style="font-size: 12px; color: #4caf50; font-weight: 600;">Pending Assignment</div>
                                    </div>
                                    <div style="display: flex; gap: 10px;">
                                        <button class="btn btn-primary" onclick="showPage('customers')" style="font-size: 14px;">� View Customer</button>
                                        <button class="btn btn-secondary" onclick="showPage('assign-customers')" style="font-size: 14px;">🚚 Assign Driver</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Activity 2 - Driver Status Update -->
                            <div style="border: 2px solid #e3f2fd; border-radius: 15px; padding: 20px; background: linear-gradient(135deg, #e3f2fd, #f8f9ff);">
                                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                                    <div style="flex: 1; min-width: 200px;">
                                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                                            <div style="background: #2196f3; color: white; padding: 4px 8px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                                DRIVER UPDATE
                                            </div>
                                            <div style="display: flex; align-items: center; gap: 5px;">
                                                <div style="width: 8px; height: 8px; background: #2196f3; border-radius: 50%; animation: pulse 2s infinite;"></div>
                                                <span style="color: #2196f3; font-weight: 600; font-size: 14px;">5 mins ago</span>
                                            </div>
                                        </div>
                                        <div style="font-size: 16px; font-weight: 600; color: #333; margin-bottom: 5px;">Driver completed delivery route</div>
                                        <div style="font-size: 14px; color: #666;">Driver: {{ $drivers->first()->name ?? 'Mohammed Ali' }} | 12 deliveries completed</div>
                                    </div>
                                    <div style="text-align: center; min-width: 120px;">
                                        <div style="background: #2196f3; color: white; padding: 8px 16px; border-radius: 25px; font-weight: 600; margin-bottom: 10px;">
                                            🚚 Completed
                                        </div>
                                        <div style="font-size: 12px; color: #2196f3; font-weight: 600;">Now Available</div>
                                    </div>
                                    <div style="display: flex; gap: 10px;">
                                        <button class="btn btn-primary" onclick="showPage('drivers-management')" style="font-size: 14px;">�️ View Driver</button>
                                        <button class="btn btn-secondary" onclick="showPage('assign-customers')" style="font-size: 14px;">📋 New Assignment</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Activity 3 - System Alert -->
                            <div style="border: 2px solid #fff3e0; border-radius: 15px; padding: 20px; background: linear-gradient(135deg, #fff3e0, #fef7e0);">
                                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                                    <div style="flex: 1; min-width: 200px;">
                                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                                            <div style="background: #ff9800; color: white; padding: 4px 8px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                                SYSTEM ALERT
                                            </div>
                                            <div style="display: flex; align-items: center; gap: 5px;">
                                                <div style="width: 8px; height: 8px; background: #ff9800; border-radius: 50%; animation: pulse 2s infinite;"></div>
                                                <span style="color: #ff9800; font-weight: 600; font-size: 14px;">10 mins ago</span>
                                            </div>
                                        </div>
                                        <div style="font-size: 16px; font-weight: 600; color: #333; margin-bottom: 5px;">{{ $pendingCustomers }} customers awaiting assignment</div>
                                        <div style="font-size: 14px; color: #666;">Priority areas: Abu Dhabi, Al Ain | Requires immediate attention</div>
                                    </div>
                                    <div style="text-align: center; min-width: 120px;">
                                        <div style="background: #ff9800; color: white; padding: 8px 16px; border-radius: 25px; font-weight: 600; margin-bottom: 10px;">
                                            ⚠️ Pending
                                        </div>
                                        <div style="font-size: 12px; color: #ff9800; font-weight: 600;">Action Needed</div>
                                    </div>
                                    <div style="display: flex; gap: 10px;">
                                        <button class="btn btn-primary" onclick="showPage('assign-customers')" style="font-size: 14px;">🚚 Assign Now</button>
                                        <button class="btn btn-secondary" onclick="showPage('customers')" style="font-size: 14px;">👥 View Customers</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <h3 style="margin-bottom: 20px; color: #333; font-size: 22px;">⚡ Quick Actions</h3>
                    <div class="quick-actions">
                        <div class="action-card" onclick="showPage('drivers-management')" style="background: linear-gradient(135deg, #2196f3, #42a5f5); color: white; transform: scale(1.02); box-shadow: 0 8px 25px rgba(33, 150, 243, 0.3);">
                            <h3>� Manage Drivers</h3>
                            <p>Add, edit, or monitor driver status</p>
                            <div style="margin-top: 15px; font-size: 12px; opacity: 0.9;">⚡ {{ $activeDrivers }} drivers active</div>
                        </div>
                        <div class="action-card" onclick="showPage('customers')" style="background: linear-gradient(135deg, #4caf50, #66bb6a); color: white;">
                            <h3>👥 Manage Customers</h3>
                            <p>View and manage customer orders</p>
                            <div style="margin-top: 15px; font-size: 12px; opacity: 0.9;">💰 {{ $totalCustomers }} total customers</div>
                        </div>
                        <div class="action-card" onclick="showPage('assign-customers')" style="background: linear-gradient(135deg, #ff5722, #ff7043); color: white;">
                            <h3>� Assign Customers</h3>
                            <p>Assign customers to drivers</p>
                            <div style="margin-top: 15px; font-size: 12px; opacity: 0.9;">🚀 {{ $pendingCustomers }} pending assignments</div>
                        </div>
                        <div class="action-card" onclick="showPage('deliveries')" style="background: linear-gradient(135deg, #9c27b0, #ba68c8); color: white;">
                            <h3>� View Reports</h3>
                            <p>Monitor delivery performance</p>
                            <div style="margin-top: 15px; font-size: 12px; opacity: 0.9;">� AED {{ number_format($totalRevenue, 0) }} revenue</div>
                        </div>
                    </div>
                </div>

                <!-- Drivers Management Page -->
                <div class="page-section" id="drivers-management">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                        <h3 style="margin: 0; color: #333; font-size: 28px;">🚚 Drivers Management</h3>
                        <button class="btn btn-primary" onclick="showAddDriverModal()" style="padding: 12px 25px; font-size: 16px; font-weight: 600;">
                            <i style="margin-right: 8px;">➕</i>Add New Driver
                        </button>
                    </div>

                    <!-- Driver Stats Overview -->
                    <div class="stats-grid" style="margin-bottom: 30px;">
                        <div class="stat-card" style="background: linear-gradient(135deg, #4caf50, #66bb6a); color: white;">
                            <h3>Total Drivers</h3>
                            <div class="value">{{ $totalDrivers }}</div>
                            <div class="change" style="color: rgba(255,255,255,0.8);">+{{ $totalDrivers > 0 ? 1 : 0 }} this month</div>
                        </div>
                        <div class="stat-card" style="background: linear-gradient(135deg, #2196f3, #42a5f5); color: white;">
                            <h3>Active Drivers</h3>
                            <div class="value">{{ $activeDrivers }}</div>
                            <div class="change" style="color: rgba(255,255,255,0.8);">Currently online</div>
                        </div>
                        <div class="stat-card" style="background: linear-gradient(135deg, #ff9800, #ffb74d); color: white;">
                            <h3>On Delivery</h3>
                            <div class="value">{{ $onDeliveryDrivers }}</div>
                            <div class="change" style="color: rgba(255,255,255,0.8);">In progress</div>
                        </div>
                    </div>

                    <!-- Search and Filter Bar
                    <div style="background: white; padding: 20px; border-radius: 15px; margin-bottom: 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
                        <div style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
                            <div style="flex: 1; min-width: 250px;">
                                <input type="text" placeholder="🔍 Search drivers by name, email, or phone..." 
                                       style="width: 100%; padding: 12px 15px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;"
                                       onkeyup="filterDrivers(this.value)">
                            </div>
                            <div>
                                <select style="padding: 12px 15px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px; background: white;">
                                    <option>All Status</option>
                                    <option>Active</option>
                                    <option>Inactive</option>
                                    <option>On Delivery</option>
                                </select>
                            </div>
                            <div>
                                <select style="padding: 12px 15px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px; background: white;">
                                    <option>All Areas</option>
                                    <option>Abu Dhabi</option>
                                    <option>Dubai</option>
                                    <option>Sharjah</option>
                                </select>
                            </div>
                        </div>
                    </div> -->

                    <!-- Drivers Grid -->
                    <div class="drivers-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 20px; margin-bottom: 30px;">
                        @if($drivers->count() > 0)
                            @foreach($drivers as $driver)
                                @php
                                    $statusColors = [
                                        'active' => ['bg' => '#4caf50', 'text' => '🟢 Online'],
                                        'on_delivery' => ['bg' => '#ff9800', 'text' => '🚚 On Delivery'],
                                        'inactive' => ['bg' => '#9e9e9e', 'text' => '⚫ Offline'],
                                    ];
                                    $status = $statusColors[$driver->status] ?? $statusColors['inactive'];
                                    
                                    // Generate initials from name
                                    $nameParts = explode(' ', $driver->name);
                                    $initials = '';
                                    foreach($nameParts as $part) {
                                        $initials .= strtoupper(substr($part, 0, 1));
                                        if(strlen($initials) >= 2) break;
                                    }
                                    
                                    // Generate random avatar color
                                    $colors = ['#2196f3', '#4caf50', '#ff9800', '#9c27b0', '#f44336'];
                                    $avatarColor = $colors[abs(crc32($driver->name)) % count($colors)];
                                @endphp
                                
                                <div class="driver-card" style="background: white; border-radius: 15px; padding: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: transform 0.3s ease; position: relative;">
                                    <div style="position: absolute; top: 15px; right: 15px;">
                                        <span style="background: {{ $status['bg'] }}; color: white; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                            {{ $status['text'] }}
                                        </span>
                                    </div>
                                    
                                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                                        <div style="width: 60px; height: 60px; background: linear-gradient(135deg, {{ $avatarColor }}, {{ $avatarColor }}88); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 20px;">
                                            {{ $initials }}
                                        </div>
                                        <div>
                                            <h4 style="margin: 0 0 5px 0; color: #333; font-size: 18px;">{{ $driver->name }}</h4>
                                            <p style="margin: 0; color: #666; font-size: 14px;">Driver ID: {{ $driver->driver_id }}</p>
                                        </div>
                                    </div>
                                    
                                    <div style="margin-bottom: 15px;">
                                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                                            <span style="color: #666;">📱</span>
                                            <span style="color: #333; font-size: 14px;">{{ $driver->phone }}</span>
                                        </div>
                                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                                            <span style="color: #666;">✉️</span>
                                            <span style="color: #333; font-size: 14px;">{{ $driver->email }}</span>
                                        </div>
                                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                                            <span style="color: #666;">📍</span>
                                            <span style="color: #333; font-size: 14px;">{{ $driver->delivery_zone ?? 'Abu Dhabi Zone' }}</span>
                                        </div>
                                        <div style="display: flex; align-items: center; gap: 8px;">
                                            <span style="color: #666;">🚚</span>
                                            <span style="color: #333; font-size: 14px;">{{ $driver->vehicle_number ?? 'Not assigned' }}</span>
                                        </div>
                                    </div>
                                    
                                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px;">
                                        <div>
                                            <span style="color: #666; font-size: 12px;">Total Deliveries:</span>
                                            <div style="color: #4caf50; font-weight: 600; font-size: 16px; margin-top: 2px;">{{ $driver->total_deliveries }}</div>
                                        </div>
                                    </div>
                                    
                                    <div style="display: flex; gap: 10px; margin-top: 15px;">
                                        <!-- <button class="btn btn-primary" onclick="viewDriverDetails('{{ $driver->driver_id }}')" style="flex: 1; padding: 8px 12px; font-size: 14px;">
                                            👁️ View
                                        </button> -->
                                        <button class="btn btn-secondary" onclick="editDriver('{{ $driver->driver_id }}')" style="flex: 1; padding: 8px 12px; font-size: 14px;">
                                            ✏️ Edit
                                        </button>
                                        <button class="btn btn-danger" onclick="deleteDriver('{{ $driver->driver_id }}', '{{ $driver->name }}')" style="flex: 1; padding: 8px 12px; font-size: 14px;">
                                            🗑️ Delete
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- No drivers found -->
                            <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #666;">
                                <div style="font-size: 48px; margin-bottom: 20px;">🚚</div>
                                <h3 style="margin-bottom: 10px; color: #333;">No Drivers Found</h3>
                                <p style="margin-bottom: 20px;">Start by adding your first driver to the system.</p>
                                <button class="btn btn-primary" onclick="showAddDriverModal()" style="padding: 12px 25px; font-size: 16px; font-weight: 600;">
                                    <i style="margin-right: 8px;">➕</i>Add First Driver
                                </button>
                            </div>
                        @endif
                    </div>

                    <!-- Pagination -->
                    <!-- <div style="display: flex; justify-content: center; align-items: center; gap: 10px; margin-top: 30px;">
                        <button class="btn btn-secondary" style="padding: 8px 16px;">← Previous</button>
                        <span style="padding: 8px 16px; background: #2196f3; color: white; border-radius: 5px; font-weight: 600;">1</span>
                        <span style="padding: 8px 16px; background: #f5f5f5; border-radius: 5px; cursor: pointer;">2</span>
                        <span style="padding: 8px 16px; background: #f5f5f5; border-radius: 5px; cursor: pointer;">3</span>
                        <button class="btn btn-secondary" style="padding: 8px 16px;">Next →</button>
                    </div> -->
                </div>

                <!-- Customers -->
                <div class="page-section" id="customers">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                        <h3 style="margin: 0; color: #333; font-size: 28px;">👥 Customer Management</h3>
                        <div style="display: flex; gap: 15px;">
                            <button class="btn btn-secondary" onclick="downloadTemplate()" style="padding: 12px 25px; font-size: 16px; font-weight: 600;">
                                <i style="margin-right: 8px;">📊</i>Download Template
                            </button>
                            <button class="btn btn-primary" onclick="showImportModal()" style="padding: 12px 25px; font-size: 16px; font-weight: 600;">
                                <i style="margin-right: 8px;">📁</i>Import Excel
                            </button>
                            <button class="btn btn-primary" onclick="showAddCustomerModal()" style="padding: 12px 25px; font-size: 16px; font-weight: 600;">
                                <i style="margin-right: 8px;">➕</i>Add Customer
                            </button>
                        </div>
                    </div>

                    <!-- Customer Stats Overview -->
                    <div class="stats-grid" style="margin-bottom: 30px;">
                        <div class="stat-card" style="background: linear-gradient(135deg, #4caf50, #66bb6a); color: white;">
                            <h3>Total Customers</h3>
                            <div class="value" id="totalCustomersCount">{{ $totalCustomers ?? 0 }}</div>
                            <div class="change" style="color: rgba(255,255,255,0.8);">Total registered</div>
                        </div>
                        <div class="stat-card" style="background: linear-gradient(135deg, #ff9800, #ffb74d); color: white;">
                            <h3>Pending Orders</h3>
                            <div class="value" id="pendingCustomersCount">{{ $pendingCustomers ?? 0 }}</div>
                            <div class="change" style="color: rgba(255,255,255,0.8);">Awaiting delivery</div>
                        </div>
                        <div class="stat-card" style="background: linear-gradient(135deg, #2196f3, #42a5f5); color: white;">
                            <h3>Delivered</h3>
                            <div class="value" id="deliveredCustomersCount">{{ $deliveredCustomers ?? 0 }}</div>
                            <div class="change" style="color: rgba(255,255,255,0.8);">Completed orders</div>
                        </div>
                        <div class="stat-card" style="background: linear-gradient(135deg, #9c27b0, #ba68c8); color: white;">
                            <h3>Total Revenue</h3>
                            <div class="value" id="totalRevenueAmount">AED {{ number_format($totalRevenue ?? 0, 2) }}</div>
                            <div class="change" style="color: rgba(255,255,255,0.8);">This month</div>
                        </div>
                    </div>

                    <!-- Search and Filter Bar -->
                    <div style="background: white; padding: 20px; border-radius: 15px; margin-bottom: 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
                        <div style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
                            <div style="flex: 1; min-width: 250px;">
                                <input type="text" id="customerSearchInput" placeholder="🔍 Search customers by name, mobile, customer ID, or area..." 
                                       style="width: 100%; padding: 12px 15px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;"
                                       onkeyup="filterCustomers(this.value)">
                            </div>
                            <div>
                                <select id="statusFilter" onchange="filterCustomersByStatus(this.value)" style="padding: 12px 15px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px; background: white;">
                                    <option value="">All Status</option>
                                    <option value="pending">Pending</option>
                                    <option value="delivered">Delivered</option>
                                </select>
                            </div>
                            <div>
                                <button class="btn btn-primary" onclick="showAssignModal()" style="padding: 12px 20px; font-size: 14px;">
                                    🚚 Assign to Driver
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Customers Table -->
                    <div style="background: white; border-radius: 15px; padding: 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); margin-bottom: 30px;">
                        <div style="margin-bottom: 15px; padding: 10px; background: #e3f2fd; border-radius: 8px; border-left: 4px solid #2196f3;">
                            <p style="margin: 0; font-size: 14px; color: #1976d2;">
                                <strong>💡 Tip:</strong> You can scroll horizontally to view all customer details and use the actions column for editing or deleting customers.
                            </p>
                        </div>
                        
                        <div class="table-container">
                            <table id="customersTable">
                                <thead>
                                    <tr style="background: #f8f9fa; border-bottom: 2px solid #e9ecef;">
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 100px; min-width: 100px;">
                                            <input type="checkbox" id="selectAllCustomers" onchange="toggleSelectAllCustomers()" style="margin-right: 5px;">
                                            Select
                                        </th>
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 140px; min-width: 140px;">Customer ID</th>
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 200px; min-width: 200px;">Full Name</th>
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 160px; min-width: 160px;">Mobile Number</th>
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 160px; min-width: 160px;">Alt Mobile</th>
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 180px; min-width: 180px;">Area</th>
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 150px; min-width: 150px;">Delivery Day</th>
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 140px; min-width: 140px;">Delivery Time</th>
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 300px; min-width: 300px;">Full Address</th>
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 200px; min-width: 200px;">Office/Villa No</th>
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 220px; min-width: 220px;">Street/Building</th>
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 180px; min-width: 180px;">Landmark</th>
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 150px; min-width: 150px;">Map Location</th>
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 120px; min-width: 120px;">Lat</th>
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 120px; min-width: 120px;">Long</th>
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 130px; min-width: 130px;">Water Bottles</th>
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 140px; min-width: 140px;">Bottles Returned</th>
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 140px; min-width: 140px;">Cash Received</th>
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 150px; min-width: 150px;">Dispensers Issued</th>
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 150px; min-width: 150px;">Dispensers Sold</th>
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 180px; min-width: 180px;">Dispenser Model</th>
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 180px; min-width: 180px;">Dispenser Condition</th>
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 150px; min-width: 150px;">Security Deposit</th>
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 160px; min-width: 160px;">Product</th>
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 160px; min-width: 160px;">Coupon Serial</th>
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 140px; min-width: 140px;">Payment Type</th>
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 120px; min-width: 120px;">Price</th>
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 120px; min-width: 120px;">Pricing</th>
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 200px; min-width: 200px;">How Heard About Us</th>
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 250px; min-width: 250px;">Email</th>
                                        <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #333; width: 300px; min-width: 300px;">Remarks</th>
                                        <th style="padding: 15px 12px; text-align: center; font-weight: 900; color: white; width: 120px; min-width: 120px; background: #1976d2;">STATUS</th>
                                        <th style="padding: 15px 12px; text-align: center; font-weight: 900; color: white; width: 170px; min-width: 170px; position: sticky; right: 0; background: #f57c00; z-index: 12; box-shadow: -4px 0 8px rgba(0,0,0,0.2); border-left: 3px solid #ff9800;">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody id="customersTableBody">
                                    <!-- Dynamic content will be loaded here -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div id="customersPagination" style="display: flex; justify-content: center; align-items: center; gap: 10px; margin-top: 30px;">
                        <!-- Pagination will be generated dynamically -->
                    </div>
                </div>

                <!-- Assign Customers Page -->
                <div class="page-section" id="assign-customers">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                        <h3 style="margin: 0; color: #333; font-size: 28px;">🚚 Customer Assignments</h3>
                        <button class="btn btn-primary" onclick="showAssignModal()" style="padding: 12px 25px; font-size: 16px; font-weight: 600;">
                            <i style="margin-right: 8px;">➕</i>Assign More Customers
                        </button>
                    </div>

                    <!-- Assignment Overview Stats -->
                    <div class="stats-grid" style="margin-bottom: 30px;">
                        <div class="stat-card" style="background: linear-gradient(135deg, #4caf50, #66bb6a); color: white;">
                            <h3>Total Assignments</h3>
                            <div class="value" id="totalAssignmentsCount">0</div>
                            <div class="change" style="color: rgba(255,255,255,0.8);">Active assignments</div>
                        </div>
                        <div class="stat-card" style="background: linear-gradient(135deg, #2196f3, #42a5f5); color: white;">
                            <h3>Active Drivers</h3>
                            <div class="value" id="activeDriversCount">0</div>
                            <div class="change" style="color: rgba(255,255,255,0.8);">With assignments</div>
                        </div>
                        <div class="stat-card" style="background: linear-gradient(135deg, #ff9800, #ffb74d); color: white;">
                            <h3>Assigned Customers</h3>
                            <div class="value" id="assignedCustomersCount">0</div>
                            <div class="change" style="color: rgba(255,255,255,0.8);">Total customers</div>
                        </div>
                        <div class="stat-card" style="background: linear-gradient(135deg, #9c27b0, #ba68c8); color: white;">
                            <h3>Avg per Driver</h3>
                            <div class="value" id="avgCustomersPerDriver">0</div>
                            <div class="change" style="color: rgba(255,255,255,0.8);">Customers per driver</div>
                        </div>
                    </div>

                    <!-- Assignments by Driver -->
                    <div style="background: white; border-radius: 15px; padding: 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); margin-bottom: 30px;">
                        <h4 style="margin-bottom: 20px; color: #333; font-size: 20px;">📋 Customer Assignments by Driver</h4>
                        <div id="assignmentsByDriver" style="display: grid; gap: 20px;">
                            <!-- Dynamic content will be loaded here -->
                            <div style="text-align: center; padding: 40px; color: #666;">
                                <div style="font-size: 48px; margin-bottom: 20px;">📋</div>
                                <h3 style="margin-bottom: 10px; color: #333;">No Assignments Yet</h3>
                                <p style="margin-bottom: 20px;">Start assigning customers to drivers to manage deliveries efficiently.</p>
                                <button class="btn btn-primary" onclick="showAssignModal()" style="padding: 12px 25px; font-size: 16px; font-weight: 600;">
                                    <i style="margin-right: 8px;">🚚</i>Assign Customers Now
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Assignment Actions -->
                    <div style="display: flex; gap: 15px; justify-content: center; margin-top: 30px;">
                        <button class="btn btn-secondary" onclick="refreshAssignments()" style="padding: 12px 25px; font-size: 16px; font-weight: 600;">
                            <i style="margin-right: 8px;">🔄</i>Refresh Assignments
                        </button>
                        <button class="btn btn-secondary" onclick="downloadAssignmentReport()" style="padding: 12px 25px; font-size: 16px; font-weight: 600;">
                            <i style="margin-right: 8px;">📊</i>Download Report
                        </button>
                    </div>
                </div>

                <!-- Deliveries Record -->
                <div class="page-section" id="deliveries">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                        <h3 style="margin: 0; color: #333; font-size: 28px;">📋 Deliveries Record</h3>
                        <button class="btn btn-primary" onclick="refreshDeliveries()" style="padding: 12px 25px; font-size: 16px; font-weight: 600;">
                            <i style="margin-right: 8px;">🔄</i>Refresh Data
                        </button>
                    </div>

                    <!-- Delivery Stats Overview -->
                    <div class="stats-grid" style="margin-bottom: 30px;">
                        <div class="stat-card" style="background: linear-gradient(135deg, #4caf50, #66bb6a); color: white;">
                            <h3>Total Delivered</h3>
                            <div class="value">{{ $totalCompletedDeliveries }}</div>
                            <div class="change" style="color: rgba(255,255,255,0.8);">All time deliveries</div>
                        </div>
                        <div class="stat-card" style="background: linear-gradient(135deg, #2196f3, #42a5f5); color: white;">
                            <h3>Today's Deliveries</h3>
                            <div class="value">{{ $todayCompletedDeliveries }}</div>
                            <div class="change" style="color: rgba(255,255,255,0.8);">Completed today</div>
                        </div>
                        <div class="stat-card" style="background: linear-gradient(135deg, #ff9800, #ffb74d); color: white;">
                            <h3>This Week</h3>
                            <div class="value">{{ $thisWeekCompletedDeliveries }}</div>
                            <div class="change" style="color: rgba(255,255,255,0.8);">Weekly deliveries</div>
                        </div>
                        <div class="stat-card" style="background: linear-gradient(135deg, #9c27b0, #ba68c8); color: white;">
                            <h3>This Month</h3>
                            <div class="value">{{ $thisMonthCompletedDeliveries }}</div>
                            <div class="change" style="color: rgba(255,255,255,0.8);">Monthly deliveries</div>
                        </div>
                    </div>

                    <!-- Completed Deliveries Table -->
                    <div style="background: white; border-radius: 15px; padding: 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); margin-bottom: 30px;">
                        <h4 style="margin-bottom: 20px; color: #333; font-size: 20px;">📦 Completed Deliveries</h4>
                        
                        @if($completedDeliveries->count() > 0)
                        <div class="table-container">
                            <table class="delivery-record-table" style="width: 100%; border-collapse: collapse; margin-top: 0; font-size: 14px;">
                                <thead>
                                    <tr style="background: linear-gradient(135deg, #4caf50, #66bb6a); color: white;">
                                        <th style="padding: 15px 12px; text-align: left; font-weight: 600; border-bottom: 2px solid #45a049;">Customer ID</th>
                                        <th style="padding: 15px 12px; text-align: left; font-weight: 600; border-bottom: 2px solid #45a049;">Customer Name</th>
                                        <th style="padding: 15px 12px; text-align: left; font-weight: 600; border-bottom: 2px solid #45a049;">Phone</th>
                                        <th style="padding: 15px 12px; text-align: left; font-weight: 600; border-bottom: 2px solid #45a049;">Address</th>
                                        <th style="padding: 15px 12px; text-align: left; font-weight: 600; border-bottom: 2px solid #45a049;">Area</th>
                                        <th style="padding: 15px 12px; text-align: left; font-weight: 600; border-bottom: 2px solid #45a049;">Driver</th>
                                        <th style="padding: 15px 12px; text-align: left; font-weight: 600; border-bottom: 2px solid #45a049;">Bottles</th>
                                        <th style="padding: 15px 12px; text-align: left; font-weight: 600; border-bottom: 2px solid #45a049;">Cash Amount</th>
                                        <th style="padding: 15px 12px; text-align: left; font-weight: 600; border-bottom: 2px solid #45a049;">Completed At</th>
                                        <th style="padding: 15px 12px; text-align: left; font-weight: 600; border-bottom: 2px solid #45a049;">Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($completedDeliveries as $delivery)
                                    <tr style="border-bottom: 1px solid #e9ecef; transition: background-color 0.3s ease;">
                                        <td style="padding: 15px 12px; font-weight: 600; color: #2196f3;">{{ $delivery->customer->customer_id ?? 'N/A' }}</td>
                                        <td style="padding: 15px 12px; font-weight: 500; color: #333;">{{ $delivery->customer->full_name ?? 'N/A' }}</td>
                                        <td style="padding: 15px 12px; color: #666;">{{ $delivery->customer->mobile_number ?? 'N/A' }}</td>
                                        <td style="padding: 15px 12px; color: #666; max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $delivery->customer->full_address ?? 'N/A' }}">
                                            {{ $delivery->customer->full_address ?? 'N/A' }}
                                        </td>
                                        <td style="padding: 15px 12px; color: #666;">{{ $delivery->customer->area_name ?? 'N/A' }}</td>
                                        <td style="padding: 15px 12px; font-weight: 500; color: #ff9800;">{{ $delivery->driver->name ?? 'N/A' }}</td>
                                        <td style="padding: 15px 12px; text-align: center; font-weight: 600; color: #4caf50;">{{ $delivery->customer->water_bottles ?? 'N/A' }}</td>
                                        <td style="padding: 15px 12px; text-align: center; font-weight: 600; color: #e91e63;">AED {{ number_format($delivery->customer->cash_amount ?? 0, 2) }}</td>
                                        <td style="padding: 15px 12px; color: #666; font-size: 13px;">
                                            {{ $delivery->updated_at ? $delivery->updated_at->format('M d, Y') : 'N/A' }}<br>
                                            <small style="color: #999;">{{ $delivery->updated_at ? $delivery->updated_at->format('h:i A') : '' }}</small>
                                        </td>
                                        <td style="padding: 15px 12px; color: #666; max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $delivery->notes ?? 'No notes' }}">
                                            {{ $delivery->notes ?? 'No notes' }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div style="text-align: center; padding: 40px; color: #666;">
                            <div style="font-size: 48px; margin-bottom: 20px;">📋</div>
                            <h3 style="margin-bottom: 10px; color: #333;">No Deliveries Completed Yet</h3>
                            <p style="margin-bottom: 20px;">Completed deliveries will appear here once drivers mark them as completed.</p>
                        </div>
                        @endif
                    </div>

                    <!-- Delivery Performance Chart -->
                    <div style="background: white; border-radius: 15px; padding: 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); margin-bottom: 30px;">
                        <h4 style="margin-bottom: 20px; color: #333; font-size: 20px;">📊 Delivery Performance</h4>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                            <div style="text-align: center; padding: 20px; background: #f8f9fa; border-radius: 10px;">
                                <div style="font-size: 28px; font-weight: 600; color: #4caf50; margin-bottom: 5px;">
                                    {{ $completedDeliveries->count() > 0 ? round($completedDeliveries->count() / max($totalDrivers, 1), 1) : 0 }}
                                </div>
                                <div style="font-size: 14px; color: #666;">Avg Deliveries per Driver</div>
                            </div>
                            <div style="text-align: center; padding: 20px; background: #f8f9fa; border-radius: 10px;">
                                <div style="font-size: 28px; font-weight: 600; color: #2196f3; margin-bottom: 5px;">
                                    {{ $completedDeliveries->count() > 0 ? round($completedDeliveries->sum(function($d) { return $d->customer->water_bottles ?? 0; }) / $completedDeliveries->count(), 1) : 0 }}
                                </div>
                                <div style="font-size: 14px; color: #666;">Avg Bottles per Delivery</div>
                            </div>
                            <div style="text-align: center; padding: 20px; background: #f8f9fa; border-radius: 10px;">
                                <div style="font-size: 28px; font-weight: 600; color: #ff9800; margin-bottom: 5px;">
                                    AED {{ $completedDeliveries->count() > 0 ? number_format($completedDeliveries->sum(function($d) { return $d->customer->cash_amount ?? 0; }) / $completedDeliveries->count(), 2) : '0.00' }}
                                </div>
                                <div style="font-size: 14px; color: #666;">Avg Revenue per Delivery</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Modal -->
    <div class="modal" id="modal">
        <div class="modal-content">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 id="modal-title">Modal Title</h3>
                <button onclick="closeModal()" style="background: none; border: none; font-size: 24px; cursor: pointer;">×</button>
            </div>
            <div id="modal-body">
                Modal content goes here
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toast">
        <div id="toast-message">Notification message</div>
    </div>

    <script>
        // Initialize dashboard
        document.addEventListener('DOMContentLoaded', function() {
            // Force layout fix for desktop screens
            fixLayout();
            
            drawOrderChart();
            initializeRatings();
            startRealTimeUpdates();
            
            // Add hover effects for driver cards
            const driverCards = document.querySelectorAll('.driver-card');
            driverCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                    this.style.boxShadow = '0 8px 30px rgba(0,0,0,0.12)';
                });
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = '0 4px 20px rgba(0,0,0,0.08)';
                });
            });
            
            // Debug: Test modal functionality
            console.log('DOM loaded, modal element:', document.getElementById('modal'));
            console.log('showAddDriverModal function:', typeof showAddDriverModal);
        });

        // Fix layout function
        function fixLayout() {
            if (window.innerWidth > 768) {
                const sidebar = document.getElementById('sidebar');
                const mainContent = document.querySelector('.main-content');
                
                if (sidebar && mainContent) {
                    sidebar.style.position = 'fixed';
                    sidebar.style.left = '0';
                    sidebar.style.top = '0';
                    sidebar.style.width = '280px';
                    sidebar.style.height = '100vh';
                    sidebar.style.transform = 'translateX(0)';
                    sidebar.style.zIndex = '1000';
                    
                    mainContent.style.marginLeft = '280px';
                    mainContent.style.width = 'calc(100% - 280px)';
                    mainContent.style.minHeight = '100vh';
                }
            }
        }

        // Fix layout on window resize
        window.addEventListener('resize', fixLayout);

        // Navigation
        function showPage(pageId) {
            // Fix layout first
            fixLayout();
            
            // Hide all pages
            document.querySelectorAll('.page-section').forEach(page => {
                page.classList.remove('active');
            });
            
            // Remove active class from all nav items
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('active');
            });
            
            // Show selected page
            document.getElementById(pageId).classList.add('active');
            
            // Add active class to clicked nav item
            document.querySelector(`[data-page="${pageId}"]`).classList.add('active');
            
            // Update page title
            const titles = {
                'dashboard': 'Dashboard',
                'drivers-management': 'Drivers Management',
                'customers': 'Customers',
                'assign-customers': 'Assign Customers',
                'deliveries': 'Deliveries',
                'orders': 'My Orders',
                'deals': 'Deals & Offers',
                'coupons': 'My Coupons',
                'loyalty': 'Loyalty Program',
                'water-tracker': 'Water Tracker',
                'emergency': 'Emergency Water',
                'referral': 'Refer & Earn',
                'settings': 'Settings',
                'faqs': 'FAQs',
                'queries': 'My Queries',
                'support': 'Support',
                'complaints': 'My Complaints',
                'feedback': 'Feedback',
                'payments': 'Payments'
            };
            document.getElementById('page-title').textContent = titles[pageId] || 'Dashboard';
            
            // Load data for specific pages
            if (pageId === 'customers') {
                loadCustomersData();
            } else if (pageId === 'assign-customers') {
                loadCustomerAssignments();
            }
        }

        // Add click listeners to nav items
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function() {
                const pageId = this.getAttribute('data-page');
                showPage(pageId);
            });
        });

        // Mobile menu toggle
        function toggleMobileMenu() {
            document.getElementById('sidebar').classList.toggle('mobile-open');
        }

        // Chart drawing function
        function drawOrderChart() {
            const canvas = document.getElementById('orderChart');
            const ctx = canvas.getContext('2d');
            
            // Chart data
            const data = [45, 52, 38, 67, 73, 89, 95, 84, 76, 88, 92, 78];
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            
            // Clear canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            // Set up chart dimensions
            const padding = 60;
            const chartWidth = canvas.width - (padding * 2);
            const chartHeight = canvas.height - (padding * 2);
            
            // Find max value for scaling
            const maxValue = Math.max(...data);
            
            // Draw grid lines
            ctx.strokeStyle = '#e0e0e0';
            ctx.lineWidth = 1;
            
            // Horizontal grid lines
            for (let i = 0; i <= 5; i++) {
                const y = padding + (chartHeight / 5) * i;
                ctx.beginPath();
                ctx.moveTo(padding, y);
                ctx.lineTo(padding + chartWidth, y);
                ctx.stroke();
                
                // Y-axis labels
                ctx.fillStyle = '#666';
                ctx.font = '12px Arial';
                ctx.textAlign = 'right';
                ctx.fillText(Math.round(maxValue - (maxValue / 5) * i), padding - 10, y + 4);
            }
            
            // Draw line chart
            ctx.strokeStyle = '#0277bd';
            ctx.lineWidth = 3;
            ctx.beginPath();
            
            data.forEach((value, index) => {
                const x = padding + (chartWidth / (data.length - 1)) * index;
                const y = padding + chartHeight - (value / maxValue) * chartHeight;
                
                if (index === 0) {
                    ctx.moveTo(x, y);
                } else {
                    ctx.lineTo(x, y);
                }
                
                // Draw data points
                ctx.fillStyle = '#0277bd';
                ctx.beginPath();
                ctx.arc(x, y, 4, 0, 2 * Math.PI);
                ctx.fill();
                
                // X-axis labels
                ctx.fillStyle = '#666';
                ctx.font = '12px Arial';
                ctx.textAlign = 'center';
                ctx.fillText(months[index], x, canvas.height - 20);
            });
            
            ctx.strokeStyle = '#0277bd';
            ctx.stroke();
            
            // Chart title
            ctx.fillStyle = '#333';
            ctx.font = 'bold 16px Arial';
            ctx.textAlign = 'center';
            ctx.fillText('Monthly Orders', canvas.width / 2, 30);
        }

        // Rating system
        function initializeRatings() {
            document.querySelectorAll('.rating').forEach(rating => {
                const stars = rating.querySelectorAll('.star');
                stars.forEach(star => {
                    star.addEventListener('click', function() {
                        const ratingValue = parseInt(this.getAttribute('data-rating'));
                        const ratingContainer = this.parentElement;
                        
                        // Reset all stars in this rating
                        ratingContainer.querySelectorAll('.star').forEach(s => s.classList.remove('active'));
                        
                        // Activate stars up to the clicked one
                        for (let i = 0; i < ratingValue; i++) {
                            ratingContainer.querySelectorAll('.star')[i].classList.add('active');
                        }
                        
                        // Store rating value
                        ratingContainer.setAttribute('data-value', ratingValue);
                    });
                });
            });
        }

        // FAQ toggle
        function toggleFAQ(element) {
            const answer = element.nextElementSibling;
            const icon = element.querySelector('span');
            
            answer.classList.toggle('open');
            icon.textContent = answer.classList.contains('open') ? '▲' : '▼';
        }

        // Modal functions
        function showModal(title, content) {
            console.log('showModal called with title:', title); // Debug line
            const modal = document.getElementById('modal');
            const modalTitle = document.getElementById('modal-title');
            const modalBody = document.getElementById('modal-body');
            
            if (!modal || !modalTitle || !modalBody) {
                console.error('Modal elements not found');
                return;
            }
            
            modalTitle.textContent = title;
            modalBody.innerHTML = content;
            modal.classList.add('show');
        }

        function closeModal() {
            document.getElementById('modal').classList.remove('show');
        }

        // Toast notification
        function showToast(message, type = 'info') {
            const toast = document.getElementById('toast');
            document.getElementById('toast-message').textContent = message;
            toast.className = `toast ${type} show`;
            
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }

        // Feature functions
        function showNotifications() {
            showModal('System Notifications', `
                <div style="display: grid; gap: 15px;">
                    <div style="padding: 15px; background: #fff3e0; border-radius: 10px; border-left: 4px solid #ff9800;">
                        <h4 style="margin: 0 0 8px 0; color: #f57c00;">Pending Assignments</h4>
                        <p style="margin: 0; color: #666; font-size: 14px;">{{ $pendingCustomers }} customers need to be assigned to drivers</p>
                    </div>
                    <div style="padding: 15px; background: #e8f5e8; border-radius: 10px; border-left: 4px solid #4caf50;">
                        <h4 style="margin: 0 0 8px 0; color: #2e7d32;">System Status</h4>
                        <p style="margin: 0; color: #666; font-size: 14px;">All systems operational. {{ $activeDrivers }} drivers active</p>
                    </div>
                    <div style="padding: 15px; background: #e3f2fd; border-radius: 10px; border-left: 4px solid #2196f3;">
                        <h4 style="margin: 0 0 8px 0; color: #1976d2;">Recent Activity</h4>
                        <p style="margin: 0; color: #666; font-size: 14px;">{{ $deliveredCustomers }} deliveries completed today</p>
                    </div>
                </div>
                <div style="display: flex; gap: 10px; margin-top: 20px;">
                    <button class="btn btn-primary" onclick="closeModal(); showPage('assign-customers')">Manage Assignments</button>
                    <button class="btn btn-secondary" onclick="closeModal()">Close</button>
                </div>
            `);
        }

        function refreshDashboard() {
            showToast('Dashboard refreshed successfully', 'success');
            // In a real application, this would reload the data
            location.reload();
        }

        function downloadReport() {
            showToast('Generating report...', 'info');
            // In a real application, this would generate and download a report
            setTimeout(() => {
                showToast('Report downloaded successfully', 'success');
            }, 2000);
        }

        function showQuickOrder() {
            showModal('Quick Reorder', `
                <div class="form-group">
                    <label>Select Previous Order</label>
                    <select>
                        <option>Order #OF2024001 - 4 bottles (AED 48)</option>
                        <option>Order #OF2023087 - 6 bottles (AED 72)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Delivery Date</label>
                    <input type="date" value="2024-06-25">
                </div>
                <button class="btn btn-primary" onclick="confirmReorder()">Confirm Order</button>
            `);
        }

        function confirmReorder() {
            closeModal();
            showToast('Order placed successfully! Delivery scheduled for June 25.', 'success');
        }

        function reorder(orderId) {
            showToast(`Reordering ${orderId}...`, 'info');
            setTimeout(() => {
                showToast('Order placed successfully!', 'success');
            }, 1500);
        }

        function trackOrder(orderId) {
            showModal('Track Order', `
                <h4>Order ${orderId}</h4>
                <div class="delivery-tracker">
                    <div class="delivery-step completed">1</div>
                    <div class="delivery-step completed">2</div>
                    <div class="delivery-step active">3</div>
                    <div class="delivery-step">4</div>
                </div>
                <div style="display: flex; justify-content: space-between; font-size: 12px; margin-top: 10px;">
                    <span>Confirmed</span>
                    <span>Prepared</span>
                    <span>In Transit</span>
                    <span>Delivered</span>
                </div>
                <p style="margin-top: 20px; text-align: center;">
                    Your order is currently in transit. Expected delivery: Today, 4:30 PM
                </p>
            `);
        }

        function trackDelivery() {
            showModal('Live Delivery Tracking', `
                <div style="text-align: center;">
                    <h4>🚚 Driver: Mohammed Ali</h4>
                    <p>Vehicle: ABC-1234</p>
                    <div style="background: #f0f8ff; padding: 20px; border-radius: 10px; margin: 20px 0;">
                        <div style="font-size: 24px; margin-bottom: 10px;">📍</div>
                        <p><strong>Current Location:</strong> Al Khalidiyah</p>
                        <p><strong>ETA:</strong> 25 minutes</p>
                    </div>
                    <div class="delivery-tracker">
                        <div class="delivery-step completed">1</div>
                        <div class="delivery-step completed">2</div>
                        <div class="delivery-step active">3</div>
                        <div class="delivery-step">4</div>
                    </div>
                    <button class="btn btn-primary" onclick="callDriver()">📞 Call Driver</button>
                </div>
            `);
        }

        function callDriver() {
            showToast('Connecting to driver...', 'info');
        }

        function updateStock() {
            showModal('Update Water Stock', `
                <div class="form-group">
                    <label>Current Stock Level</label>
                    <select id="stockLevel">
                        <option value="0">Empty</option>
                        <option value="1">1 Bottle</option>
                        <option value="2">2 Bottles</option>
                        <option value="3" selected>3 Bottles</option>
                        <option value="4">4 Bottles</option>
                        <option value="5">5+ Bottles</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Auto-reorder when stock is low?</label>
                    <input type="checkbox" checked> Yes, reorder when 1 bottle remaining
                </div>
                <button class="btn btn-primary" onclick="saveStock()">Update Stock</button>
            `);
        }

        function saveStock() {
            const level = document.getElementById('stockLevel').value;
            closeModal();
            showToast(`Stock updated to ${level} bottles`, 'success');
        }

        function rescheduleDelivery() {
            showModal('Reschedule Delivery', `
                <div class="form-group">
                    <label>New Delivery Date</label>
                    <input type="date" value="2024-06-27">
                </div>
                <div class="form-group">
                    <label>Preferred Time</label>
                    <select>
                        <option>Morning (8 AM - 12 PM)</option>
                        <option>Afternoon (12 PM - 6 PM)</option>
                        <option>Evening (6 PM - 9 PM)</option>
                    </select>
                </div>
                <button class="btn btn-primary" onclick="confirmReschedule()">Confirm Reschedule</button>
            `);
        }

        function confirmReschedule() {
            closeModal();
            showToast('Delivery rescheduled successfully!', 'success');
        }

        function placeEmergencyOrder() {
            showModal('Confirm Emergency Order', `
                <div style="text-align: center;">
                    <h4>🚨 Emergency Order Confirmation</h4>
                    <div style="background: #fff3e0; padding: 15px; border-radius: 10px; margin: 15px 0;">
                        <p><strong>1 Bottle + Urgent Fee</strong></p>
                        <p>Total: AED 25</p>
                        <p>Delivery: Within 2 hours</p>
                    </div>
                    <button class="btn btn-danger" onclick="confirmEmergencyOrder()">Confirm & Pay</button>
                </div>
            `);
        }

        function confirmEmergencyOrder() {
            closeModal();
            showToast('Emergency order placed! Delivery within 2 hours.', 'success');
        }

        function shareReferralCode() {
            if (navigator.share) {
                navigator.share({
                    title: 'Join OASISFLOW',
                    text: 'Use my referral code AHMED2024 and get 25% off your first order!',
                    url: 'https://oasisflow.ae/signup?ref=AHMED2024'
                });
            } else {
                navigator.clipboard.writeText('AHMED2024');
                showToast('Referral code copied to clipboard!', 'success');
            }
        }

        function saveSettings() {
            const name = document.getElementById('customerName').value;
            const email = document.getElementById('customerEmail').value;
            const phone = document.getElementById('customerPhone').value;
            const address = document.getElementById('deliveryAddress').value;
            
            // Simulate saving
            setTimeout(() => {
                showToast('Settings saved successfully!', 'success');
            }, 500);
        }

        function submitQuery() {
            const subject = document.getElementById('querySubject').value;
            const message = document.getElementById('queryMessage').value;
            
            if (subject && message) {
                document.getElementById('querySubject').value = '';
                document.getElementById('queryMessage').value = '';
                showToast('Query submitted successfully! We\'ll respond within 24 hours.', 'success');
            } else {
                showToast('Please fill in all fields.', 'error');
            }
        }

        function submitComplaint() {
            const type = document.getElementById('complaintType').value;
            const subject = document.getElementById('complaintSubject').value;
            const description = document.getElementById('complaintDescription').value;
            
            if (subject && description) {
                document.getElementById('complaintSubject').value = '';
                document.getElementById('complaintDescription').value = '';
                showToast('Complaint submitted. Reference ID: #C' + Date.now(), 'success');
            } else {
                showToast('Please fill in all required fields.', 'error');
            }
        }

        function submitFeedback() {
            const overall = document.getElementById('overallRating').getAttribute('data-value');
            const delivery = document.getElementById('deliveryRating').getAttribute('data-value');
            const water = document.getElementById('waterRating').getAttribute('data-value');
            const comments = document.getElementById('feedbackComments').value;
            
            if (overall && delivery && water) {
                document.getElementById('feedbackComments').value = '';
                showToast('Thank you for your feedback!', 'success');
            } else {
                showToast('Please provide ratings for all categories.', 'error');
            }
        }

        function startLiveChat() {
            showModal('Live Chat Support', `
                <div style="height: 300px; border: 1px solid #e0e0e0; border-radius: 10px; padding: 15px; margin-bottom: 15px; overflow-y: auto;">
                    <div style="margin-bottom: 10px;">
                        <strong>Support Agent:</strong> Hello! How can I help you today?
                    </div>
                </div>
                <div style="display: flex; gap: 10px;">
                    <input type="text" placeholder="Type your message..." style="flex: 1;">
                    <button class="btn btn-primary">Send</button>
                </div>
            `);
        }

        function callSupport() {
            showToast('Connecting to +971 2 123 4567...', 'info');
        }

        function emailSupport() {
            window.location.href = 'mailto:support@oasisflow.ae?subject=Support Request';
        }

        function scheduleCallback() {
            showModal('Schedule Callback', `
                <div class="form-group">
                    <label>Preferred Date</label>
                    <input type="date" value="2024-06-22">
                </div>
                <div class="form-group">
                    <label>Preferred Time</label>
                    <select>
                        <option>9:00 AM - 10:00 AM</option>
                        <option>10:00 AM - 11:00 AM</option>
                        <option>2:00 PM - 3:00 PM</option>
                        <option>4:00 PM - 5:00 PM</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Reason for Call</label>
                    <textarea rows="3" placeholder="Brief description of your inquiry"></textarea>
                </div>
                <button class="btn btn-primary" onclick="confirmCallback()">Schedule Callback</button>
            `);
        }

        function confirmCallback() {
            closeModal();
            showToast('Callback scheduled! We\'ll call you tomorrow at your preferred time.', 'success');
        }

        function showTrackingHelp() {
            showModal('Order Tracking Help', `
                <h4>How to Track Your Order</h4>
                <ol>
                    <li>Go to "My Orders" section</li>
                    <li>Find your order and click "Track"</li>
                    <li>View real-time delivery status</li>
                    <li>Contact driver if needed</li>
                </ol>
                <p><strong>Need more help?</strong> Contact our support team.</p>
            `);
        }

        function showPaymentHelp() {
            showModal('Payment Help', `
                <h4>Payment Issues</h4>
                <ul>
                    <li>Check your card details</li>
                    <li>Ensure sufficient balance</li>
                    <li>Try a different payment method</li>
                    <li>Contact your bank if issues persist</li>
                </ul>
                <button class="btn btn-primary" onclick="startLiveChat()">Chat with Support</button>
            `);
        }

        function showDeliveryHelp() {
            showModal('Delivery Help', `
                <h4>Delivery Issues</h4>
                <ul>
                    <li>Check your delivery address</li>
                    <li>Ensure someone is available</li>
                    <li>Call the driver directly</li>
                    <li>Reschedule if needed</li>
                </ul>
                <button class="btn btn-primary" onclick="trackDelivery()">Track Current Delivery</button>
            `);
        }

        function showAccountHelp() {
            showModal('Account Help', `
                <h4>Account Management</h4>
                <ul>
                    <li>Update your profile in Settings</li>
                    <li>Change delivery preferences</li>
                    <li>Manage payment methods</li>
                    <li>View order history</li>
                </ul>
                <button class="btn btn-primary" onclick="showPage('settings')">Go to Settings</button>
            `);
        }

        function showNotifications() {
            showModal('Notifications', `
                <div style="max-height: 400px; overflow-y: auto;">
                    <div style="padding: 15px; border-bottom: 1px solid #f0f0f0;">
                        <strong>🚚 Order Update</strong>
                        <p>Your order #OF2024002 is out for delivery</p>
                        <small>2 minutes ago</small>
                    </div>
                    <div style="padding: 15px; border-bottom: 1px solid #f0f0f0;">
                        <strong>🎫 New Coupon</strong>
                        <p>You've received a 25% off coupon - SUMMER25</p>
                        <small>1 hour ago</small>
                    </div>
                    <div style="padding: 15px; border-bottom: 1px solid #f0f0f0;">
                        <strong>⭐ Loyalty Points</strong>
                        <p>You've earned 50 loyalty points from your last order</p>
                        <small>Yesterday</small>
                    </div>
                </div>
            `);
        }

        // Real-time updates
        function startRealTimeUpdates() {
            setInterval(() => {
                // Simulate real-time updates
                const randomUpdate = Math.random();
                
                if (randomUpdate < 0.3) {
                    // Simulate delivery progress
                    const trackerSteps = document.querySelectorAll('.delivery-step');
                    if (trackerSteps.length > 0) {
                        // Randomly advance delivery status
                    }
                }
            }, 10000); // Update every 10 seconds
        }

        // Close modal when clicking outside
        document.getElementById('modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // New Dashboard Functions
        function rateOrder(orderId) {
            showModal('Rate Your Order', `
                <div style="text-align: center;">
                    <h4>Rate Order ${orderId}</h4>
                    <p style="margin: 15px 0;">How was your delivery experience?</p>
                    
                    <div class="form-group">
                        <label>Overall Rating</label>
                        <div class="rating" id="orderRating" style="justify-content: center; margin: 15px 0;">
                            <span class="star" data-rating="1" style="font-size: 24px; cursor: pointer;">⭐</span>
                            <span class="star" data-rating="2" style="font-size: 24px; cursor: pointer;">⭐</span>
                            <span class="star" data-rating="3" style="font-size: 24px; cursor: pointer;">⭐</span>
                            <span class="star" data-rating="4" style="font-size: 24px; cursor: pointer;">⭐</span>
                            <span class="star" data-rating="5" style="font-size: 24px; cursor: pointer;">⭐</span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Comments (Optional)</label>
                        <textarea rows="3" placeholder="Share your feedback..." id="ratingComments"></textarea>
                    </div>
                    
                    <button class="btn btn-primary" onclick="submitOrderRating('${orderId}')">Submit Rating</button>
                </div>
            `);
            
            // Re-initialize rating for the modal
            setTimeout(() => {
                initializeRatings();
            }, 100);
        }

        // Drivers Management Functions
        function showAddDriverModal() {
            console.log('showAddDriverModal called'); // Debug line
            showModal('Add New Driver', `
                <form id="addDriverForm" style="max-width: 600px; margin: 0 auto;">
                    <h4 style="margin-bottom: 25px; color: #333; text-align: center;">🚚 Create New Driver Account</h4>
                    
                    <div style="display: grid; gap: 20px;">
                        <div class="form-group">
                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Full Name *</label>
                            <input type="text" id="driverName" placeholder="Enter driver's full name" 
                                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                        </div>
                        
                        <div class="form-group">
                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Email Address *</label>
                            <input type="email" id="driverEmail" placeholder="driver@example.com" 
                                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                        </div>
                        
                        <div class="form-group">
                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Phone Number *</label>
                            <input type="tel" id="driverPhone" placeholder="+971 50 123 4567" 
                                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                        </div>
                        
                        <div class="form-group">
                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Address *</label>
                            <textarea id="driverAddress" placeholder="Enter driver's complete address" rows="3"
                                      style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px; resize: vertical;"></textarea>
                        </div>
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                            <div class="form-group">
                                <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Driver ID *</label>
                                <input type="text" id="driverID" placeholder="DRV001" autocomplete="username"
                                       style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                            </div>
                            <div class="form-group">
                                <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Password *</label>
                                <input type="password" id="driverPassword" name="driverPassword" placeholder="Enter secure password" autocomplete="new-password"
                                       style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                            </div>
                        </div>
                        
                
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                            <div class="form-group">
                                <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Vehicle Number</label>
                                <input type="text" id="driverVehicle" placeholder="ABC-1234" 
                                       style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                            </div>
                        </div>
                        
                        <div style="background: #f0f8ff; padding: 15px; border-radius: 8px; border-left: 4px solid #2196f3;">
                            <h5 style="margin: 0 0 10px 0; color: #2196f3;">💼 Driver Account Information</h5>
                            <p style="margin: 0; font-size: 14px; color: #666;">The driver will use their email and password to login to the driver panel.</p>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 15px; margin-top: 30px; justify-content: center;">
                        <button type="button" class="btn btn-secondary" onclick="closeModal()" style="padding: 12px 25px; font-size: 16px;">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-primary" onclick="createDriver()" style="padding: 12px 25px; font-size: 16px;">
                            <i style="margin-right: 8px;">✅</i>Create Driver Account
                        </button>
                    </div>
                </form>
            `);
        }

        function createDriver() {
            const name = document.getElementById('driverName').value.trim();
            const email = document.getElementById('driverEmail').value.trim();
            const phone = document.getElementById('driverPhone').value.trim();
            const address = document.getElementById('driverAddress').value.trim();
            const driverID = document.getElementById('driverID').value.trim();
            const password = document.getElementById('driverPassword').value.trim();
            const vehicle = document.getElementById('driverVehicle').value.trim();
            
            // Validation
            if (!name || !email || !phone || !address || !driverID || !password) {
                showToast('Please fill in all required fields.', 'error');
                return;
            }
            
            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showToast('Please enter a valid email address.', 'error');
                return;
            }
            
            // Driver ID validation
            if (!driverID.match(/^DRV\d{3}$/)) {
                showToast('Driver ID must be in format DRV001, DRV002, etc.', 'error');
                return;
            }
            
            // Password validation
            if (password.length < 8) {
                showToast('Password must be at least 8 characters long.', 'error');
                return;
            }
            
            closeModal();
            
            // Show loading
            showToast('Creating driver account...', 'info');
            
            // Prepare data for API call
            const formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('phone', phone);
            formData.append('address', address);
            formData.append('driver_id', driverID);
            formData.append('password', password);
            formData.append('vehicle_number', vehicle);
            formData.append('_token', '{{ csrf_token() }}');
            
            // Make API call to create driver
            fetch('/admin/drivers/create', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => {
                console.log('Response status:', response.status);
                console.log('Response headers:', response.headers);
                
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    return response.json().then(data => ({ data, status: response.status }));
                } else {
                    throw new Error('Response is not JSON. Possibly redirected to login page.');
                }
            })
            .then(({ data, status }) => {
                console.log('Response data:', data);
                console.log('Response status:', status);
                
                // Check if it's an authentication error
                if (data.success === false && status === 401) {
                    showToast('Authentication required. Please login again.', 'error');
                    if (data.redirect) {
                        setTimeout(() => {
                            window.location.href = data.redirect;
                        }, 2000);
                    }
                    return;
                }
                
                if (data.success) {
                    showModal('Driver Account Created Successfully!', `
                        <div style="text-align: center;">
                            <div style="font-size: 48px; margin-bottom: 20px;">✅</div>
                            <h4 style="color: #4caf50; margin-bottom: 25px;">Account Created Successfully!</h4>
                            
                            <div style="background: #f8f9fa; padding: 20px; border-radius: 10px; margin-bottom: 20px;">
                                <h5 style="margin: 0 0 15px 0; color: #333;">Driver Details</h5>
                                <div style="text-align: left; font-size: 14px; line-height: 1.6;">
                                    <p><strong>Name:</strong> ${name}</p>
                                    <p><strong>Driver ID:</strong> ${driverID}</p>
                                    <p><strong>Email:</strong> ${email}</p>
                                    <p><strong>Phone:</strong> ${phone}</p>
                                    <p><strong>Vehicle:</strong> ${vehicle || 'Not specified'}</p>
                                </div>
                            </div>
                            
                            <div style="background: #e8f5e8; padding: 20px; border-radius: 10px; margin-bottom: 20px; border-left: 4px solid #4caf50;">
                                <h5 style="margin: 0 0 15px 0; color: #4caf50;">🔐 Login Credentials</h5>
                                <div style="text-align: left; font-size: 14px; line-height: 1.6;">
                                    <p><strong>Username:</strong> ${email}</p>
                                    <p><strong>Password:</strong> ${password}</p>
                                </div>
                            </div>
                            
                            <div style="background: #fff3e0; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                                <p style="margin: 0; font-size: 14px; color: #f57c00;">
                                    📧 Driver can now login using their email and password.
                                </p>
                            </div>
                            
                            <div style="display: flex; gap: 10px; justify-content: center;">
                                <button class="btn btn-secondary" onclick="copyCredentials('${email}', '${password}')" style="padding: 10px 20px;">
                                    📋 Copy Credentials
                                </button>
                                <button class="btn btn-primary" onclick="closeModal()" style="padding: 10px 20px;">
                                    Done
                                </button>
                            </div>
                        </div>
                    `);
                    
                    showToast('Driver account created successfully!', 'success');
                    
                    // Refresh the page to show the new driver
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    console.log('Error data:', data);
                    showToast(data.message || 'Failed to create driver account', 'error');
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                showToast('An error occurred while creating the driver account: ' + error.message, 'error');
            });
        }

        function generatePassword() {
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%';
            let password = '';
            for (let i = 0; i < 12; i++) {
                password += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            return password;
        }

        function copyCredentials(username, password) {
            const credentialsText = `OASISFLOW Driver Login Credentials\n\nUsername: ${username}\nPassword: ${password}\n\nPlease keep these credentials secure.`;
            navigator.clipboard.writeText(credentialsText).then(() => {
                showToast('Credentials copied to clipboard!', 'success');
            }).catch(() => {
                showToast('Failed to copy credentials. Please copy manually.', 'error');
            });
        }

        function viewDriverDetails(driverId) {
            // Sample driver data - in real app, this would come from backend
            const driverData = {
                'DRV001': {
                    name: 'Ahmed Mohammed',
                    email: 'ahmed.mohammed@oasisflow.ae',
                    phone: '+971 50 123 4567',
                    address: 'Al Khalidiyah, Abu Dhabi, UAE',
                    zone: 'Abu Dhabi Zone',
                    vehicle: 'ABC-1234',
                    status: 'Online',
                    rating: '4.9',
                    deliveries: '143',
                    joinDate: 'January 15, 2024',
                    lastLogin: '2 hours ago'
                },
                'DRV002': {
                    name: 'Mohammed Khalil',
                    email: 'mohammed.khalil@oasisflow.ae',
                    phone: '+971 52 987 6543',
                    address: 'Dubai Marina, Dubai, UAE',
                    zone: 'Dubai Zone',
                    vehicle: 'XYZ-5678',
                    status: 'On Delivery',
                    rating: '4.7',
                    deliveries: '89',
                    joinDate: 'March 10, 2024',
                    lastLogin: '30 minutes ago'
                },
                'DRV003': {
                    name: 'Salem Al-Rashid',
                    email: 'salem.rashid@oasisflow.ae',
                    phone: '+971 55 246 8135',
                    address: 'Al Qasba, Sharjah, UAE',
                    zone: 'Sharjah Zone',
                    vehicle: 'DEF-9012',
                    status: 'Offline',
                    rating: '4.8',
                    deliveries: '67',
                    joinDate: 'February 20, 2024',
                    lastLogin: '1 day ago'
                }
            };
            
            const driver = driverData[driverId] || driverData['DRV001'];
            
            showModal('Driver Details', `
                <div style="max-width: 600px; margin: 0 auto;">
                    <div style="text-align: center; margin-bottom: 25px;">
                        <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #2196f3, #42a5f5); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 24px; margin: 0 auto 15px;">
                            ${driver.name.split(' ').map(n => n[0]).join('')}
                        </div>
                        <h4 style="margin: 0; color: #333;">${driver.name}</h4>
                        <p style="margin: 5px 0 0 0; color: #666;">Driver ID: ${driverId}</p>
                    </div>
                    
                    <div style="background: #f8f9fa; padding: 20px; border-radius: 10px; margin-bottom: 20px;">
                        <h5 style="margin: 0 0 15px 0; color: #333;">📋 Personal Information</h5>
                        <div style="display: grid; gap: 12px; font-size: 14px;">
                            <div style="display: flex; justify-content: space-between; align-items: start;">
                                <span style="color: #666;">Email:</span>
                                <span style="color: #333; font-weight: 500; text-align: right;">${driver.email}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: start;">
                                <span style="color: #666;">Phone:</span>
                                <span style="color: #333; font-weight: 500; text-align: right;">${driver.phone}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: start;">
                                <span style="color: #666;">Address:</span>
                                <span style="color: #333; font-weight: 500; text-align: right; max-width: 60%;">${driver.address}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: start;">
                                <span style="color: #666;">Zone:</span>
                                <span style="color: #333; font-weight: 500; text-align: right;">${driver.zone}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: start;">
                                <span style="color: #666;">Vehicle:</span>
                                <span style="color: #333; font-weight: 500; text-align: right;">${driver.vehicle}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div style="background: #f8f9fa; padding: 20px; border-radius: 10px; margin-bottom: 20px;">
                        <h5 style="margin: 0 0 15px 0; color: #333;">📊 Performance Statistics</h5>
                        <div style="display: grid; gap: 12px; font-size: 14px;">
                            <div style="display: flex; justify-content: space-between;">
                                <span style="color: #666;">Current Status:</span>
                                <span style="color: ${driver.status === 'Online' ? '#4caf50' : driver.status === 'On Delivery' ? '#ff9800' : '#9e9e9e'}; font-weight: 600;">${driver.status}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <span style="color: #666;">Rating:</span>
                                <span style="color: #ff9800; font-weight: 500;">⭐ ${driver.rating}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <span style="color: #666;">Total Deliveries:</span>
                                <span style="color: #4caf50; font-weight: 600; font-size: 16px;">${driver.deliveries}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <span style="color: #666;">Join Date:</span>
                                <span style="color: #333; font-weight: 500;">${driver.joinDate}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <span style="color: #666;">Last Login:</span>
                                <span style="color: #333; font-weight: 500;">${driver.lastLogin}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div style="background: #e8f5e8; padding: 20px; border-radius: 10px; margin-bottom: 20px;">
                        <h5 style="margin: 0 0 15px 0; color: #4caf50;">🚚 Delivery Performance</h5>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 15px; text-align: center;">
                            <div>
                                <div style="font-size: 20px; font-weight: 600; color: #4caf50;">${driver.deliveries}</div>
                                <div style="font-size: 12px; color: #666;">Total Deliveries</div>
                            </div>
                            <div>
                                <div style="font-size: 20px; font-weight: 600; color: #2196f3;">${Math.round(driver.deliveries / 12)}</div>
                                <div style="font-size: 12px; color: #666;">Monthly Avg</div>
                            </div>
                            <div>
                                <div style="font-size: 20px; font-weight: 600; color: #ff9800;">${driver.rating}</div>
                                <div style="font-size: 12px; color: #666;">Avg Rating</div>
                            </div>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 10px; justify-content: center;">
                        <button class="btn btn-secondary" onclick="editDriver('${driverId}')" style="padding: 10px 20px;">
                            ✏️ Edit Driver
                        </button>
                        <button class="btn btn-primary" onclick="sendCredentials('${driverId}')" style="padding: 10px 20px;">
                            📧 Send Credentials
                        </button>
                        <button class="btn btn-danger" onclick="deleteDriver('${driverId}', '${driver.name}')" style="padding: 10px 20px;">
                            🗑️ Delete
                        </button>
                    </div>
                </div>
            `);
        }

        function editDriver(driverId) {
            // Show loading
            showToast('Loading driver details...', 'info');
            
            // Fetch driver data from backend
            fetch(`/admin/drivers/${driverId}/edit`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => {
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    return response.json().then(data => ({ data, status: response.status }));
                } else {
                    throw new Error('Response is not JSON. Possibly redirected to login page.');
                }
            })
            .then(({ data, status }) => {
                if (data.success) {
                    const driver = data.driver;
                    
                    showModal('Edit Driver', `
                        <div style="max-width: 600px; margin: 0 auto;">
                            <h4 style="margin-bottom: 25px; color: #333; text-align: center;">✏️ Edit Driver Information</h4>
                            
                            <div style="display: grid; gap: 20px;">
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Full Name *</label>
                                    <input type="text" id="editDriverName" value="${driver.name}" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                                
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Email Address *</label>
                                    <input type="email" id="editDriverEmail" value="${driver.email}" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                                
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Phone Number *</label>
                                    <input type="tel" id="editDriverPhone" value="${driver.phone}" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                                
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Address *</label>
                                    <textarea id="editDriverAddress" rows="3" 
                                              style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px; resize: vertical;">${driver.address}</textarea>
                                </div>
                                
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                                    <div class="form-group">
                                        <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Vehicle Number</label>
                                        <input type="text" id="editDriverVehicle" value="${driver.vehicle_number || ''}" 
                                               style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                    </div>
                                </div>
                                
                                
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Status *</label>
                                    <select id="editDriverStatus" style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px; background: white;">
                                        <option value="active" ${driver.status === 'active' ? 'selected' : ''}>Active</option>
                                        <option value="inactive" ${driver.status === 'inactive' ? 'selected' : ''}>Inactive</option>
                                        <option value="on_delivery" ${driver.status === 'on_delivery' ? 'selected' : ''}>On Delivery</option>
                                    </select>
                                </div>
                                
                                <div style="background: #fff3e0; padding: 15px; border-radius: 8px; border-left: 4px solid #ff9800;">
                                    <h5 style="margin: 0 0 10px 0; color: #ff9800;">🔐 Password Reset</h5>
                                    <p style="margin: 0 0 10px 0; font-size: 14px; color: #666;">Leave password field empty to keep current password.</p>
                                    <input type="password" id="editDriverPassword" placeholder="Enter new password (optional)" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                            </div>
                            
                            <div style="display: flex; gap: 15px; margin-top: 30px; justify-content: center;">
                                <button class="btn btn-secondary" onclick="closeModal()" style="padding: 12px 25px; font-size: 16px;">
                                    Cancel
                                </button>
                                <button class="btn btn-primary" onclick="updateDriver('${driver.driver_id}')" style="padding: 12px 25px; font-size: 16px;">
                                    <i style="margin-right: 8px;">✅</i>Update Driver
                                </button>
                            </div>
                        </div>
                    `);
                } else {
                    showToast(data.message || 'Failed to load driver details', 'error');
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                showToast('An error occurred while loading driver details: ' + error.message, 'error');
            });
        }

        function updateDriver(driverId) {
            const name = document.getElementById('editDriverName').value.trim();
            const email = document.getElementById('editDriverEmail').value.trim();
            const phone = document.getElementById('editDriverPhone').value.trim();
            const address = document.getElementById('editDriverAddress').value.trim();
            const vehicleNumber = document.getElementById('editDriverVehicle').value.trim();
            const status = document.getElementById('editDriverStatus').value;
            const password = document.getElementById('editDriverPassword').value.trim();
            
            // Validation
            if (!name || !email || !phone || !address || !status) {
                showToast('Please fill in all required fields.', 'error');
                return;
            }
            
            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showToast('Please enter a valid email address.', 'error');
                return;
            }
            
            // Password validation (if provided)
            if (password && password.length < 8) {
                showToast('Password must be at least 8 characters long.', 'error');
                return;
            }
            
            closeModal();
            
            // Show loading
            showToast('Updating driver information...', 'info');
            
            // Prepare data for API call
            const formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('phone', phone);
            formData.append('address', address);
            formData.append('vehicle_number', vehicleNumber);
            formData.append('status', status);
            if (password) {
                formData.append('password', password);
            }
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('_method', 'PUT');
            
            // Make API call to update driver
            fetch(`/admin/drivers/${driverId}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => {
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    return response.json().then(data => ({ data, status: response.status }));
                } else {
                    throw new Error('Response is not JSON. Possibly redirected to login page.');
                }
            })
            .then(({ data, status }) => {
                if (data.success) {
                    showToast('Driver information updated successfully!', 'success');
                    
                    // Refresh the page to show the updated data
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    console.log('Error data:', data);
                    showToast(data.message || 'Failed to update driver information', 'error');
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                showToast('An error occurred while updating driver information: ' + error.message, 'error');
            });
        }

        function deleteDriver(driverId, driverName) {
            showModal('Delete Driver', `
                <div style="text-align: center; max-width: 400px; margin: 0 auto;">
                    <div style="font-size: 48px; color: #f44336; margin-bottom: 20px;">🗑️</div>
                    <h4 style="color: #f44336; margin-bottom: 15px;">Delete Driver Account</h4>
                    <p style="margin-bottom: 25px; color: #666;">Are you sure you want to delete the account for:</p>
                    <p style="font-weight: 600; color: #333; margin-bottom: 25px;">${driverName} (${driverId})</p>
                    
                    <div style="background: #ffebee; padding: 15px; border-radius: 8px; margin-bottom: 25px; border-left: 4px solid #f44336;">
                        <p style="margin: 0; font-size: 14px; color: #c62828;">
                            ⚠️ This action cannot be undone. The driver will lose access to their account immediately.
                        </p>
                    </div>
                    
                    <div style="display: flex; gap: 15px; justify-content: center;">
                        <button class="btn btn-secondary" onclick="closeModal()" style="padding: 12px 25px; font-size: 16px;">
                            Cancel
                        </button>
                        <button class="btn btn-danger" onclick="confirmDeleteDriver('${driverId}', '${driverName}')" style="padding: 12px 25px; font-size: 16px;">
                            <i style="margin-right: 8px;">🗑️</i>Delete Account
                        </button>
                    </div>
                </div>
            `);
        }

        function confirmDeleteDriver(driverId, driverName) {
            closeModal();
            showToast('Deleting driver account...', 'info');
            
            // Make API call to delete driver
            fetch(`/admin/drivers/${driverId}`, {
                method: 'DELETE',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    return response.json().then(data => ({ data, status: response.status }));
                } else {
                    throw new Error('Response is not JSON. Possibly redirected to login page.');
                }
            })
            .then(({ data, status }) => {
                if (data.success) {
                    showToast(data.message || `Driver account for ${driverName} has been deleted successfully.`, 'success');
                    
                    // Refresh the page to show the updated driver list
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    console.log('Error data:', data);
                    showToast(data.message || 'Failed to delete driver account', 'error');
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                showToast('An error occurred while deleting driver account: ' + error.message, 'error');
            });
        }

        function sendCredentials(driverId) {
            closeModal();
            showToast('Sending login credentials to driver...', 'info');
            
            setTimeout(() => {
                showToast('Login credentials sent successfully!', 'success');
            }, 1500);
        }

        function filterDrivers(searchTerm) {
            const driverCards = document.querySelectorAll('.driver-card');
            const searchLower = searchTerm.toLowerCase();
            
            driverCards.forEach(card => {
                const driverName = card.querySelector('h4').textContent.toLowerCase();
                const driverEmail = card.querySelector('span:nth-child(2)').textContent.toLowerCase();
                const driverPhone = card.querySelector('span:nth-child(4)').textContent.toLowerCase();
                
                if (driverName.includes(searchLower) || 
                    driverEmail.includes(searchLower) || 
                    driverPhone.includes(searchLower)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function submitOrderRating(orderId) {
            const rating = document.getElementById('orderRating').getAttribute('data-value');
            const comments = document.getElementById('ratingComments').value;
            
            if (rating) {
                closeModal();
                showToast(`Thank you for rating order ${orderId}! Your feedback helps us improve.`, 'success');
            } else {
                showToast('Please select a rating before submitting.', 'error');
            }
        }

        function modifyOrder(orderId) {
            showModal('Modify Order', `
                <div>
                    <h4>Modify Order ${orderId}</h4>
                    <p style="color: #ff9800; margin-bottom: 20px;">⚠️ Order is currently being prepared. Limited modifications available.</p>
                    
                    <div class="form-group">
                        <label>Current Quantity: 8 Bottles</label>
                        <select id="newQuantity">
                            <option value="6">6 Bottles (-AED 24)</option>
                            <option value="8" selected>8 Bottles (Current)</option>
                            <option value="10">10 Bottles (+AED 24)</option>
                            <option value="12">12 Bottles (+AED 48)</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Delivery Instructions</label>
                        <textarea rows="3" placeholder="Any special delivery instructions..." id="deliveryInstructions"></textarea>
                    </div>
                    
                    <div style="display: flex; gap: 10px; margin-top: 20px;">
                        <button class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                        <button class="btn btn-primary" onclick="confirmModification('${orderId}')">Confirm Changes</button>
                    </div>
                </div>
            `);
        }

        function confirmModification(orderId) {
            const newQuantity = document.getElementById('newQuantity').value;
            const instructions = document.getElementById('deliveryInstructions').value;
            
            closeModal();
            showToast(`Order ${orderId} has been updated successfully!`, 'success');
        }

        function cancelOrder(orderId) {
            showModal('Cancel Order', `
                <div style="text-align: center;">
                    <h4 style="color: #f44336;">Cancel Order ${orderId}?</h4>
                    <p style="margin: 20px 0;">Are you sure you want to cancel this order? This action cannot be undone.</p>
                    
                    <div style="background: #fff3e0; padding: 15px; border-radius: 10px; margin: 15px 0;">
                        <p><strong>Refund Information:</strong></p>
                        <p>Full refund will be processed within 3-5 business days</p>
                    </div>
                    
                    <div style="display: flex; gap: 10px; justify-content: center; margin-top: 20px;">
                        <button class="btn btn-secondary" onclick="closeModal()">Keep Order</button>
                        <button class="btn btn-danger" onclick="confirmCancellation('${orderId}')">Yes, Cancel Order</button>
                    </div>
                </div>
            `);
        }

        function confirmCancellation(orderId) {
            closeModal();
            showToast(`Order ${orderId} has been cancelled. Refund will be processed within 3-5 business days.`, 'success');
        }

        // Auto-hide toast
        document.addEventListener('DOMContentLoaded', function() {
            // Show welcome message
            setTimeout(() => {
                showToast('Welcome back, Admin! Welcome to Oasis Flow.', 'success');
            }, 1000);
            
            // Load customers data when customers page is shown
            const navItems = document.querySelectorAll('.nav-item');
            navItems.forEach(item => {
                item.addEventListener('click', function() {
                    const pageId = this.getAttribute('data-page');
                    if (pageId === 'customers') {
                        loadCustomersData();
                    }
                });
            });
        });

        // Customer Management Functions
        let currentCustomers = [];
        let selectedCustomerIds = [];

        function loadCustomersData() {
            showToast('Loading customers data...', 'info');
            
            fetch('/admin/customers', {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    currentCustomers = data.customers;
                    updateCustomersTable(data.customers);
                    updateCustomerStats(data.stats);
                } else {
                    showToast('Failed to load customers data', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error loading customers data', 'error');
            });
        }

        function updateCustomersTable(customers) {
            const tbody = document.getElementById('customersTableBody');
            tbody.innerHTML = '';

            if (customers.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="32" style="text-align: center; padding: 40px; color: #666;">
                            <div style="font-size: 48px; margin-bottom: 20px;">👥</div>
                            <h3 style="margin-bottom: 10px; color: #333;">No Customers Found</h3>
                            <p style="margin-bottom: 20px;">Import customers from CSV or add them manually.</p>
                        </td>
                    </tr>
                `;
                return;
            }

            customers.forEach(customer => {
                // Enhanced status badge with better styling
                let statusBadge = '';
                switch(customer.status) {
                    case 'delivered':
                        statusBadge = '<span style="background: linear-gradient(45deg, #4caf50, #66bb6a); color: white; padding: 6px 16px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 0 2px 8px rgba(76, 175, 80, 0.3);">✅ Delivered</span>';
                        break;
                    case 'cancelled':
                        statusBadge = '<span style="background: linear-gradient(45deg, #f44336, #ef5350); color: white; padding: 6px 16px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 0 2px 8px rgba(244, 67, 54, 0.3);">❌ Cancelled</span>';
                        break;
                    default:
                        statusBadge = '<span style="background: linear-gradient(45deg, #ff9800, #ffb74d); color: white; padding: 6px 16px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 0 2px 8px rgba(255, 152, 0, 0.3);">⏳ Pending</span>';
                }

                // Helper function to safely display values - showing more text
                const safeDisplay = (value, maxLength = 50) => { // Increased from 20 to 50
                    if (!value || value === 'null' || value === 'undefined') return 'N/A';
                    const str = String(value);
                    return str; // Removed truncation to show full text
                };

                // Format delivery day
                const deliveryDay = customer.delivery_day || 'Not Set';
                
                // Full address without truncation
                const fullAddress = customer.full_address || 'N/A';
                
                // Google map link
                const mapLocation = customer.google_map_location_link 
                    ? `<a href="${customer.google_map_location_link}" target="_blank" style="color: #2196f3; text-decoration: none; font-weight: 600;">📍 View Map</a>`
                    : '<span style="color: #999;">No Map</span>';

                const row = `
                    <tr style="border-bottom: 1px solid #e9ecef; transition: all 0.3s ease;" class="customer-row" data-customer-id="${customer.customer_id}" onmouseover="this.style.backgroundColor='#f8f9fa'" onmouseout="this.style.backgroundColor='transparent'">
                        <td style="padding: 12px 10px; width: 100px; min-width: 100px; text-align: center;">
                            <input type="checkbox" class="customer-checkbox" value="${customer.customer_id}" onchange="toggleCustomerSelection('${customer.customer_id}')" style="transform: scale(1.2);">
                        </td>
                        <td class="customer-id" style="width: 140px; min-width: 140px;">${customer.customer_id}</td>
                        <td class="customer-name" style="width: 200px; min-width: 200px;" title="${customer.full_name}">${customer.full_name}</td>
                        <td class="contact-info" style="width: 160px; min-width: 160px;">${customer.mobile_number || 'N/A'}</td>
                        <td class="contact-info" style="width: 160px; min-width: 160px;">${customer.alternative_mobile_number || 'N/A'}</td>
                        <td class="contact-info" style="width: 180px; min-width: 180px;" title="${customer.area_name || 'N/A'}">${safeDisplay(customer.area_name)}</td>
                        <td style="color: #555; font-weight: 500; width: 150px; min-width: 150px;" title="${deliveryDay}">${deliveryDay}</td>
                        <td style="color: #666; width: 140px; min-width: 140px;">${safeDisplay(customer.delivery_time)}</td>
                        <td style="color: #666; width: 300px; min-width: 300px;" title="${fullAddress}">${fullAddress}</td>
                        <td style="color: #666; width: 200px; min-width: 200px;" title="${customer.office_villa_flat_room_no || 'N/A'}">${safeDisplay(customer.office_villa_flat_room_no)}</td>
                        <td style="color: #666; width: 220px; min-width: 220px;" title="${customer.street_name_building_name || 'N/A'}">${safeDisplay(customer.street_name_building_name)}</td>
                        <td style="color: #666; width: 180px; min-width: 180px;" title="${customer.nearest_landmark || 'N/A'}">${safeDisplay(customer.nearest_landmark)}</td>
                        <td style="width: 150px; min-width: 150px; text-align: center;">${mapLocation}</td>
                        <td class="numeric-value" style="width: 120px; min-width: 120px;">${customer.lat || 'N/A'}</td>
                        <td class="numeric-value" style="width: 120px; min-width: 120px;">${customer.long || 'N/A'}</td>
                        <td class="numeric-value" style="color: #333; width: 130px; min-width: 130px;">${customer.no_of_water_bottles_issued || 0}</td>
                        <td class="numeric-value" style="color: #333; width: 140px; min-width: 140px;">${customer.of_bottles_returned || 0}</td>
                        <td class="numeric-value" style="color: #333; width: 140px; min-width: 140px;">${customer.of_bottles_cash_received || 0}</td>
                        <td class="numeric-value" style="color: #333; width: 150px; min-width: 150px;">${customer.no_of_water_despenser_issued || 0}</td>
                        <td class="numeric-value" style="color: #333; width: 150px; min-width: 150px;">${customer.no_of_water_despenser_sold || 0}</td>
                        <td style="color: #666; width: 180px; min-width: 180px;" title="${customer.water_despenser_model_number || 'N/A'}">${safeDisplay(customer.water_despenser_model_number)}</td>
                        <td style="color: #666; width: 180px; min-width: 180px;" title="${customer.water_despense_condition || 'N/A'}">${safeDisplay(customer.water_despense_condition)}</td>
                        <td class="numeric-value" style="color: #2e7d32; font-weight: 700; width: 150px; min-width: 150px;">AED ${parseFloat(customer.security_deposit || 0).toFixed(2)}</td>
                        <td style="color: #666; width: 160px; min-width: 160px;" title="${customer.select_product || 'N/A'}">${safeDisplay(customer.select_product)}</td>
                        <td style="color: #666; width: 160px; min-width: 160px;" title="${customer.coupon_book_serial_number || 'N/A'}">${safeDisplay(customer.coupon_book_serial_number)}</td>
                        <td class="numeric-value" style="color: #666; width: 140px; min-width: 140px;">${customer.payment_type || 'N/A'}</td>
                        <td class="numeric-value" style="color: #2e7d32; font-weight: 700; width: 120px; min-width: 120px;">AED ${parseFloat(customer.price || 0).toFixed(2)}</td>
                        <td class="numeric-value" style="color: #2e7d32; font-weight: 700; width: 120px; min-width: 120px;">AED ${parseFloat(customer.pricing || 0).toFixed(2)}</td>
                        <td style="color: #666; width: 200px; min-width: 200px;" title="${customer.how_you_heard_about_us || 'N/A'}">${safeDisplay(customer.how_you_heard_about_us)}</td>
                        <td class="contact-info" style="width: 250px; min-width: 250px;" title="${customer.email_address || 'N/A'}">${safeDisplay(customer.email_address)}</td>
                        <td style="color: #666; width: 300px; min-width: 300px;" title="${customer.remarks || 'N/A'}">${safeDisplay(customer.remarks)}</td>
                        <td style="width: 120px; min-width: 120px; text-align: center;">
                            <div class="status-badge" style="${statusBadge.includes('Delivered') ? 'background: linear-gradient(45deg, #4caf50, #66bb6a); color: white; box-shadow: 0 2px 8px rgba(76, 175, 80, 0.3);' : statusBadge.includes('Cancelled') ? 'background: linear-gradient(45deg, #f44336, #ef5350); color: white; box-shadow: 0 2px 8px rgba(244, 67, 54, 0.3);' : 'background: linear-gradient(45deg, #ff9800, #ffb74d); color: white; box-shadow: 0 2px 8px rgba(255, 152, 0, 0.3);'}">
                                ${statusBadge.includes('Delivered') ? '✅ Delivered' : statusBadge.includes('Cancelled') ? '❌ Cancelled' : '⏳ Pending'}
                            </div>
                        </td>
                        <td style="width: 170px; min-width: 170px; position: sticky; right: 0; background: #fff3e0; z-index: 10; box-shadow: -4px 0 8px rgba(0,0,0,0.2); border-left: 3px solid #ff9800;">
                            <div class="action-buttons">
                                <button class="action-btn" onclick="editCustomer('${customer.customer_id}')" style="background: linear-gradient(45deg, #6c757d, #868e96); color: white; border: none;">
                                    ✏️ Edit
                                </button>
                                <button class="action-btn" onclick="deleteCustomer('${customer.customer_id}', '${customer.full_name}')" style="background: linear-gradient(45deg, #dc3545, #e55a64); color: white; border: none;">
                                    🗑️ Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
                tbody.innerHTML += row;
            });
        }

        function updateCustomerStats(stats) {
            document.getElementById('totalCustomersCount').textContent = stats.total;
            document.getElementById('pendingCustomersCount').textContent = stats.pending;
            document.getElementById('deliveredCustomersCount').textContent = stats.delivered;
            document.getElementById('totalRevenueAmount').textContent = 'AED ' + parseFloat(stats.revenue || 0).toFixed(2);
        }

        function showImportModal() {
            showModal('Import Customers from CSV', `
                <div style="max-width: 500px; margin: 0 auto;">
                    <div style="background: #e3f2fd; padding: 20px; border-radius: 10px; margin-bottom: 25px; border-left: 4px solid #2196f3;">
                        <h5 style="margin: 0 0 10px 0; color: #1976d2;">📊 CSV Format Requirements</h5>
                        <p style="margin: 0; font-size: 14px; color: #333;">
                            Your CSV file should have the following columns:<br>
                            <strong>Column 1:</strong> Name, <strong>Column 2:</strong> Full Address, <strong>Column 3:</strong> Price, <strong>Column 4:</strong> Quantity, <strong>Column 5:</strong> Coupon Quantity, <strong>Column 6:</strong> Cash Amount
                        </p>
                    </div>
                    
                    <form id="importForm" enctype="multipart/form-data">
                        <div class="form-group" style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 10px; font-weight: 600; color: #555;">Select CSV File *</label>
                            <input type="file" id="excelFile" accept=".csv" 
                                   style="width: 100%; padding: 12px; border: 2px dashed #e0e0e0; border-radius: 8px; font-size: 14px; background: #fafafa;">
                            <small style="color: #666; font-size: 12px;">Supported formats: .csv (Max: 10MB)</small>
                        </div>
                    </form>
                    
                    <div style="display: flex; gap: 15px; margin-top: 25px; justify-content: center;">
                        <button class="btn btn-secondary" onclick="closeModal()" style="padding: 12px 25px; font-size: 16px;">
                            Cancel
                        </button>
                        <button class="btn btn-primary" onclick="importCustomers()" style="padding: 12px 25px; font-size: 16px;">
                            <i style="margin-right: 8px;">📁</i>Import Customers
                        </button>
                    </div>
                </div>
            `);
        }

        function importCustomers() {
            const fileInput = document.getElementById('excelFile');
            const file = fileInput.files[0];
            
            if (!file) {
                showToast('Please select an Excel file to import', 'error');
                return;
            }
            
            closeModal();
            showToast('Importing customers from Excel...', 'info');
            
            const formData = new FormData();
            formData.append('excel_file', file);
            formData.append('_token', '{{ csrf_token() }}');
            
            fetch('/admin/customers/import', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast(data.message, 'success');
                    loadCustomersData(); // Reload the table
                    
                    if (data.errors && data.errors.length > 0) {
                        setTimeout(() => {
                            showModal('Import Summary', `
                                <div>
                                    <h4 style="color: #4caf50; margin-bottom: 15px;">✅ Import Completed</h4>
                                    <p style="margin-bottom: 20px;"><strong>Successfully imported:</strong> ${data.imported_count} customers</p>
                                    ${data.errors.length > 0 ? `
                                        <div style="background: #fff3e0; padding: 15px; border-radius: 8px; border-left: 4px solid #ff9800;">
                                            <h5 style="margin: 0 0 10px 0; color: #f57c00;">⚠️ Some rows had issues:</h5>
                                            <ul style="margin: 0; padding-left: 20px;">
                                                ${data.errors.map(error => `<li style="margin-bottom: 5px;">${error}</li>`).join('')}
                                            </ul>
                                        </div>
                                    ` : ''}
                                </div>
                            `);
                        }, 2000);
                    }
                } else {
                    showToast(data.message || 'Failed to import customers', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error importing customers', 'error');
            });
        }

        function downloadTemplate() {
            window.open('/admin/customers/template', '_blank');
            showToast('Downloading customer import template...', 'info');
        }

        function showAddCustomerModal() {
            showModal('Add New Customer', `
                <div style="max-width: 900px; margin: 0 auto; max-height: 80vh; overflow-y: auto;">
                    <h4 style="margin-bottom: 25px; color: #333; text-align: center;">👥 Add New Customer</h4>
                    
                    <form id="addCustomerForm">
                        <!-- Basic Information -->
                        <div style="margin-bottom: 25px;">
                            <h5 style="color: #2196f3; margin-bottom: 15px; border-bottom: 2px solid #e0e0e0; padding-bottom: 5px;">📋 Basic Information</h5>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Customer ID *</label>
                                    <input type="text" id="customerIdInput" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Full Name *</label>
                                    <input type="text" id="fullNameInput" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 15px;">
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Mobile Number *</label>
                                    <input type="tel" id="mobileNumberInput" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Alternative Mobile Number</label>
                                    <input type="tel" id="altMobileInput" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                            </div>
                            <div class="form-group" style="margin-top: 15px;">
                                <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Email Address</label>
                                <input type="email" id="emailInput" 
                                       style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                            </div>
                        </div>

                        <!-- Address Information -->
                        <div style="margin-bottom: 25px;">
                            <h5 style="color: #2196f3; margin-bottom: 15px; border-bottom: 2px solid #e0e0e0; padding-bottom: 5px;">📍 Address Information</h5>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Office No/Villa No/Flat No/Room No</label>
                                    <input type="text" id="roomNoInput" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Street Name/Building Name</label>
                                    <input type="text" id="streetInput" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 15px;">
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Area Name</label>
                                    <input type="text" id="areaInput" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Nearest Landmark</label>
                                    <input type="text" id="landmarkInput" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                            </div>
                            <div class="form-group" style="margin-top: 15px;">
                                <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Full Address *</label>
                                <textarea id="fullAddressInput" rows="3" 
                                          style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px; resize: vertical;"></textarea>
                            </div>
                        </div>

                        <!-- Geo Location -->
                        <div style="margin-bottom: 25px;">
                            <h5 style="color: #2196f3; margin-bottom: 15px; border-bottom: 2px solid #e0e0e0; padding-bottom: 5px;">🌍 Geo Location</h5>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Latitude</label>
                                    <input type="number" id="latInput" step="0.0000001" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Longitude</label>
                                    <input type="number" id="longInput" step="0.0000001" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 15px;">
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Plus Code</label>
                                    <input type="text" id="plusCodeInput" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Geo Location (Lat,Long)</label>
                                    <input type="text" id="geoLocationInput" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 15px;">
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Google Map Location Link</label>
                                    <input type="url" id="googleMapInput" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">DMT Location Link</label>
                                    <input type="url" id="dmtLocationInput" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                            </div>
                            <div class="form-group" style="margin-top: 15px;">
                                <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Point WKT</label>
                                <textarea id="pointWktInput" rows="2" 
                                          style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px; resize: vertical;"></textarea>
                            </div>
                        </div>

                        <!-- Delivery Information -->
                        <div style="margin-bottom: 25px;">
                            <h5 style="color: #2196f3; margin-bottom: 15px; border-bottom: 2px solid #e0e0e0; padding-bottom: 5px;">🚚 Delivery Information</h5>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Delivery Day</label>
                                    <select id="deliveryDayInput" style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                        <option value="">Select Day</option>
                                        <option value="Monday">Monday</option>
                                        <option value="Tuesday">Tuesday</option>
                                        <option value="Wednesday">Wednesday</option>
                                        <option value="Thursday">Thursday</option>
                                        <option value="Friday">Friday</option>
                                        <option value="Saturday">Saturday</option>
                                        <option value="Sunday">Sunday</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Delivery Time</label>
                                    <input type="time" id="deliveryTimeInput" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                            </div>
                        </div>

                        <!-- Product Information -->
                        <div style="margin-bottom: 25px;">
                            <h5 style="color: #2196f3; margin-bottom: 15px; border-bottom: 2px solid #e0e0e0; padding-bottom: 5px;">💧 Product Information</h5>
                            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">No of Water Bottles Issued</label>
                                    <input type="number" id="bottlesIssuedInput" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Of Bottles Returned</label>
                                    <input type="number" id="bottlesReturnedInput" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Of Bottles Cash Received</label>
                                    <input type="number" id="bottlesCashInput" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; margin-top: 15px;">
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">No of Water Dispenser Issued</label>
                                    <input type="number" id="dispenserIssuedInput" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">No of Water Dispenser Sold</label>
                                    <input type="number" id="dispenserSoldInput" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Water Dispenser Model Number</label>
                                    <input type="text" id="dispenserModelInput" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 15px;">
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Water Dispenser Condition</label>
                                    <select id="dispenserConditionInput" style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                        <option value="">Select Condition</option>
                                        <option value="new">New</option>
                                        <option value="good">Good</option>
                                        <option value="fair">Fair</option>
                                        <option value="poor">Poor</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Select Product</label>
                                    <select id="selectProductInput" style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                        <option value="">Select Product</option>
                                        <option value="water_bottle">Water Bottle</option>
                                        <option value="water_dispenser">Water Dispenser</option>
                                        <option value="both">Both</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Information -->
                        <div style="margin-bottom: 25px;">
                            <h5 style="color: #2196f3; margin-bottom: 15px; border-bottom: 2px solid #e0e0e0; padding-bottom: 5px;">💳 Payment Information</h5>
                            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Payment Type</label>
                                    <select id="paymentTypeInput" style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                        <option value="">Select Payment Type</option>
                                        <option value="cash">Cash</option>
                                        <option value="card">Card</option>
                                        <option value="online">Online</option>
                                        <option value="bank_transfer">Bank Transfer</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Price (AED)</label>
                                    <input type="number" id="priceInput" step="0.01" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Pricing (AED)</label>
                                    <input type="number" id="pricingInput" step="0.01" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 15px;">
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Security Deposit (AED)</label>
                                    <input type="number" id="securityDepositInput" step="0.01" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Coupon Book Serial Number</label>
                                    <input type="text" id="couponSerialInput" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div style="margin-bottom: 25px;">
                            <h5 style="color: #2196f3; margin-bottom: 15px; border-bottom: 2px solid #e0e0e0; padding-bottom: 5px;">ℹ️ Additional Information</h5>
                            <div class="form-group">
                                <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">How did you hear about us?</label>
                                <select id="hearAboutUsInput" style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                    <option value="">Select Option</option>
                                    <option value="social_media">Social Media</option>
                                    <option value="friend_referral">Friend Referral</option>
                                    <option value="online_search">Online Search</option>
                                    <option value="advertisement">Advertisement</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="form-group" style="margin-top: 15px;">
                                <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Remarks</label>
                                <textarea id="remarksInput" rows="2" 
                                          style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px; resize: vertical;"></textarea>
                            </div>
                        </div>

                        <!-- Document Upload -->
                        <div style="margin-bottom: 25px;">
                            <h5 style="color: #2196f3; margin-bottom: 15px; border-bottom: 2px solid #e0e0e0; padding-bottom: 5px;">📄 Document Upload</h5>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Water Dispenser Picture</label>
                                    <input type="file" id="dispenserPictureInput" accept="image/*" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Customer Registration Form</label>
                                    <input type="file" id="registrationFormInput" accept="image/*,application/pdf" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 15px;">
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Customer Emirates ID Front</label>
                                    <input type="file" id="emiratesIdFrontInput" accept="image/*" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Customer Emirates ID Back</label>
                                    <input type="file" id="emiratesIdBackInput" accept="image/*" 
                                           style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                </div>
                            </div>
                            <div class="form-group" style="margin-top: 15px;">
                                <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Company Trade Mark</label>
                                <input type="file" id="tradeMarkInput" accept="image/*" 
                                       style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                            </div>
                        </div>
                        
                        <div style="display: flex; gap: 15px; margin-top: 30px; justify-content: center;">
                            <button type="button" class="btn btn-secondary" onclick="closeModal()" style="padding: 12px 25px; font-size: 16px;">
                                Cancel
                            </button>
                            <button type="button" class="btn btn-primary" onclick="createCustomer()" style="padding: 12px 25px; font-size: 16px;">
                                <i style="margin-right: 8px;">✅</i>Add Customer
                            </button>
                        </div>
                    </form>
                </div>
            `);
        }

        function createCustomer() {
            const customerId = document.getElementById('customerIdInput').value.trim();
            const fullName = document.getElementById('fullNameInput').value.trim();
            const mobileNumber = document.getElementById('mobileNumberInput').value.trim();
            const fullAddress = document.getElementById('fullAddressInput').value.trim();
            
            if (!customerId || !fullName || !mobileNumber || !fullAddress) {
                showToast('Please fill in all required fields.', 'error');
                return;
            }
            
            const formData = new FormData();
            formData.append('customer_id', customerId);
            formData.append('full_name', fullName);
            formData.append('mobile_number', mobileNumber);
            formData.append('alternative_mobile_number', document.getElementById('altMobileInput').value);
            formData.append('office_villa_flat_room_no', document.getElementById('roomNoInput').value);
            formData.append('street_name_building_name', document.getElementById('streetInput').value);
            formData.append('area_name', document.getElementById('areaInput').value);
            formData.append('nearest_landmark', document.getElementById('landmarkInput').value);
            formData.append('full_address', fullAddress);
            formData.append('email_address', document.getElementById('emailInput').value);
            formData.append('delivery_day', document.getElementById('deliveryDayInput').value);
            formData.append('delivery_time', document.getElementById('deliveryTimeInput').value);
            formData.append('lat', document.getElementById('latInput').value);
            formData.append('long', document.getElementById('longInput').value);
            formData.append('plus_code', document.getElementById('plusCodeInput').value);
            formData.append('geo_location_lat_long', document.getElementById('geoLocationInput').value);
            formData.append('google_map_location_link', document.getElementById('googleMapInput').value);
            formData.append('dmt_location_link', document.getElementById('dmtLocationInput').value);
            formData.append('point_wkt', document.getElementById('pointWktInput').value);
            formData.append('no_of_water_bottles_issued', document.getElementById('bottlesIssuedInput').value);
            formData.append('of_bottles_returned', document.getElementById('bottlesReturnedInput').value);
            formData.append('of_bottles_cash_received', document.getElementById('bottlesCashInput').value);
            formData.append('no_of_water_despenser_issued', document.getElementById('dispenserIssuedInput').value);
            formData.append('no_of_water_despenser_sold', document.getElementById('dispenserSoldInput').value);
            formData.append('water_despenser_model_number', document.getElementById('dispenserModelInput').value);
            formData.append('water_despense_condition', document.getElementById('dispenserConditionInput').value);
            formData.append('select_product', document.getElementById('selectProductInput').value);
            formData.append('payment_type', document.getElementById('paymentTypeInput').value);
            formData.append('price', document.getElementById('priceInput').value);
            formData.append('pricing', document.getElementById('pricingInput').value);
            formData.append('security_deposit', document.getElementById('securityDepositInput').value);
            formData.append('coupon_book_serial_number', document.getElementById('couponSerialInput').value);
            formData.append('how_you_heard_about_us', document.getElementById('hearAboutUsInput').value);
            formData.append('remarks', document.getElementById('remarksInput').value);
            
            // Handle file uploads
            if (document.getElementById('dispenserPictureInput').files[0]) {
                formData.append('water_despenser_picture', document.getElementById('dispenserPictureInput').files[0]);
            }
            if (document.getElementById('registrationFormInput').files[0]) {
                formData.append('customer_registration_form', document.getElementById('registrationFormInput').files[0]);
            }
            if (document.getElementById('emiratesIdFrontInput').files[0]) {
                formData.append('customer_emirates_id_front', document.getElementById('emiratesIdFrontInput').files[0]);
            }
            if (document.getElementById('emiratesIdBackInput').files[0]) {
                formData.append('customer_emirates_id_back', document.getElementById('emiratesIdBackInput').files[0]);
            }
            if (document.getElementById('tradeMarkInput').files[0]) {
                formData.append('company_trade_mark', document.getElementById('tradeMarkInput').files[0]);
            }
            
            closeModal();
            showToast('Creating customer...', 'info');
            
            formData.append('_token', '{{ csrf_token() }}');
            
            fetch('/admin/customers/create', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Customer created successfully!', 'success');
                    loadCustomersData();
                } else {
                    showToast(data.message || 'Failed to create customer', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error creating customer', 'error');
            });
        }

        function editCustomer(customerId) {
            showToast('Loading customer details...', 'info');
            
            fetch(`/admin/customers/${customerId}/edit`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const customer = data.customer;
                    
                    showModal('Edit Customer', `
                        <div style="max-width: 800px; margin: 0 auto;">
                            <h4 style="margin-bottom: 25px; color: #333; text-align: center;">✏️ Edit Customer Information</h4>
                            
                            <form id="editCustomerForm">
                                <div style="display: grid; gap: 20px;">
                                    <!-- Customer ID (readonly) -->
                                    <div class="form-group">
                                        <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Customer ID *</label>
                                        <input type="text" id="editCustomerId" value="${customer.customer_id}" readonly
                                               style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px; background: #f5f5f5;">
                                    </div>
                                    
                                    <!-- Basic Information -->
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                                        <div class="form-group">
                                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Full Name *</label>
                                            <input type="text" id="editCustomerFullName" value="${customer.full_name || ''}" 
                                                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                        </div>
                                        <div class="form-group">
                                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Mobile Number *</label>
                                            <input type="text" id="editCustomerMobile" value="${customer.mobile_number || ''}" 
                                                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                        </div>
                                    </div>
                                    
                                    <!-- Contact Information -->
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                                        <div class="form-group">
                                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Alternative Mobile</label>
                                            <input type="text" id="editCustomerAltMobile" value="${customer.alternative_mobile_number || ''}" 
                                                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                        </div>
                                        <div class="form-group">
                                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Email Address</label>
                                            <input type="email" id="editCustomerEmail" value="${customer.email_address || ''}" 
                                                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                        </div>
                                    </div>
                                    
                                    <!-- Address Information -->
                                    <div class="form-group">
                                        <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Full Address *</label>
                                        <textarea id="editCustomerAddress" rows="3" 
                                                  style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px; resize: vertical;">${customer.full_address || ''}</textarea>
                                    </div>
                                    
                                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
                                        <div class="form-group">
                                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Office/Villa/Flat/Room No</label>
                                            <input type="text" id="editCustomerOfficeVilla" value="${customer.office_villa_flat_room_no || ''}" 
                                                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                        </div>
                                        <div class="form-group">
                                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Street/Building Name</label>
                                            <input type="text" id="editCustomerStreetBuilding" value="${customer.street_name_building_name || ''}" 
                                                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                        </div>
                                        <div class="form-group">
                                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Nearest Landmark</label>
                                            <input type="text" id="editCustomerLandmark" value="${customer.nearest_landmark || ''}" 
                                                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                        </div>
                                    </div>
                                    
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                                        <div class="form-group">
                                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Area Name</label>
                                            <input type="text" id="editCustomerArea" value="${customer.area_name || ''}" 
                                                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                        </div>
                                        <div class="form-group">
                                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">How You Heard About Us</label>
                                            <input type="text" id="editCustomerHowHeard" value="${customer.how_you_heard_about_us || ''}" 
                                                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                        </div>
                                    </div>
                                    
                                    <!-- Delivery Information -->
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                                        <div class="form-group">
                                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Delivery Day</label>
                                            <input type="text" id="editCustomerDeliveryDay" value="${customer.delivery_day || ''}" 
                                                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                        </div>
                                        <div class="form-group">
                                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Delivery Time</label>
                                            <input type="text" id="editCustomerDeliveryTime" value="${customer.delivery_time || ''}" 
                                                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                        </div>
                                    </div>
                                    
                                    <!-- Map Information -->
                                    <div class="form-group">
                                        <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Google Map Location Link</label>
                                        <input type="url" id="editCustomerMapLink" value="${customer.google_map_location_link || ''}" 
                                               style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                    </div>
                                    
                                    <!-- Coordinates -->
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                                        <div class="form-group">
                                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Latitude</label>
                                            <input type="number" id="editCustomerLat" step="any" value="${customer.lat || ''}" 
                                                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                        </div>
                                        <div class="form-group">
                                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Longitude</label>
                                            <input type="number" id="editCustomerLong" step="any" value="${customer.long || ''}" 
                                                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                        </div>
                                    </div>
                                    
                                    <!-- Water Bottles Information -->
                                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
                                        <div class="form-group">
                                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Water Bottles Issued</label>
                                            <input type="number" id="editCustomerBottles" value="${customer.no_of_water_bottles_issued || ''}" 
                                                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                        </div>
                                        <div class="form-group">
                                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Bottles Returned</label>
                                            <input type="number" id="editCustomerBottlesReturned" value="${customer.of_bottles_returned || ''}" 
                                                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                        </div>
                                        <div class="form-group">
                                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Bottles Cash Received</label>
                                            <input type="number" id="editCustomerBottlesCash" value="${customer.of_bottles_cash_received || ''}" 
                                                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                        </div>
                                    </div>
                                    
                                    <!-- Dispenser Information -->
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                                        <div class="form-group">
                                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Dispensers Issued</label>
                                            <input type="number" id="editCustomerDispensersIssued" value="${customer.no_of_water_despenser_issued || ''}" 
                                                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                        </div>
                                        <div class="form-group">
                                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Dispensers Sold</label>
                                            <input type="number" id="editCustomerDispensersSold" value="${customer.no_of_water_despenser_sold || ''}" 
                                                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                        </div>
                                    </div>
                                    
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                                        <div class="form-group">
                                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Dispenser Model</label>
                                            <input type="text" id="editCustomerDispenserModel" value="${customer.water_despenser_model_number || ''}" 
                                                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                        </div>
                                        <div class="form-group">
                                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Dispenser Condition</label>
                                            <input type="text" id="editCustomerDispenserCondition" value="${customer.water_despense_condition || ''}" 
                                                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                        </div>
                                    </div>
                                    
                                    <!-- Product and Payment Information -->
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                                        <div class="form-group">
                                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Product</label>
                                            <input type="text" id="editCustomerProduct" value="${customer.select_product || ''}" 
                                                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                        </div>
                                        <div class="form-group">
                                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Coupon Book Serial Number</label>
                                            <input type="text" id="editCustomerCouponSerial" value="${customer.coupon_book_serial_number || ''}" 
                                                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                        </div>
                                    </div>
                                    
                                    <!-- Business Information -->
                                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
                                        <div class="form-group">
                                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Price (AED)</label>
                                            <input type="number" id="editCustomerPrice" step="0.01" value="${customer.price || ''}" 
                                                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                        </div>
                                        <div class="form-group">
                                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Pricing (AED)</label>
                                            <input type="number" id="editCustomerPricing" step="0.01" value="${customer.pricing || ''}" 
                                                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                        </div>
                                        <div class="form-group">
                                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Security Deposit (AED)</label>
                                            <input type="number" id="editCustomerSecurityDeposit" step="0.01" value="${customer.security_deposit || ''}" 
                                                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                                        </div>
                                    </div>
                                    
                                    <!-- Payment and Status -->
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                                        <div class="form-group">
                                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Payment Type</label>
                                            <select id="editCustomerPaymentType" style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px; background: white;">
                                                <option value="">Select Payment Type</option>
                                                <option value="cash" ${customer.payment_type === 'cash' ? 'selected' : ''}>Cash</option>
                                                <option value="card" ${customer.payment_type === 'card' ? 'selected' : ''}>Card</option>
                                                <option value="online" ${customer.payment_type === 'online' ? 'selected' : ''}>Online</option>
                                                <option value="bank_transfer" ${customer.payment_type === 'bank_transfer' ? 'selected' : ''}>Bank Transfer</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Status *</label>
                                            <select id="editCustomerStatus" style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px; background: white;">
                                                <option value="pending" ${customer.status === 'pending' ? 'selected' : ''}>Pending</option>
                                                <option value="delivered" ${customer.status === 'delivered' ? 'selected' : ''}>Delivered</option>
                                                <option value="cancelled" ${customer.status === 'cancelled' ? 'selected' : ''}>Cancelled</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <!-- Remarks -->
                                    <div class="form-group">
                                        <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Remarks</label>
                                        <textarea id="editCustomerRemarks" rows="3" 
                                                  style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px; resize: vertical;">${customer.remarks || ''}</textarea>
                                    </div>
                                </div>
                                
                                <div style="margin-top: 30px; text-align: center; display: flex; gap: 15px; justify-content: center;">
                                    <button type="button" onclick="updateCustomer('${customer.customer_id}')" 
                                            style="background: linear-gradient(45deg, #28a745, #34ce57); color: white; border: none; padding: 12px 30px; border-radius: 25px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);">
                                        ✅ Update Customer
                                    </button>
                                    <button type="button" onclick="closeModal()" 
                                            style="background: linear-gradient(45deg, #6c757d, #868e96); color: white; border: none; padding: 12px 30px; border-radius: 25px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;">
                                        ❌ Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    `);
                } else {
                    showToast(data.message || 'Failed to load customer details', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error loading customer details', 'error');
            });
        }

        function updateCustomer(customerId) {
            const fullName = document.getElementById('editCustomerFullName').value.trim();
            const mobile = document.getElementById('editCustomerMobile').value.trim();
            const address = document.getElementById('editCustomerAddress').value.trim();
            const status = document.getElementById('editCustomerStatus').value;
            
            // Collect all form fields
            const altMobile = document.getElementById('editCustomerAltMobile').value.trim();
            const email = document.getElementById('editCustomerEmail').value.trim();
            const officeVilla = document.getElementById('editCustomerOfficeVilla').value.trim();
            const streetBuilding = document.getElementById('editCustomerStreetBuilding').value.trim();
            const landmark = document.getElementById('editCustomerLandmark').value.trim();
            const area = document.getElementById('editCustomerArea').value.trim();
            const howHeard = document.getElementById('editCustomerHowHeard').value.trim();
            const deliveryDay = document.getElementById('editCustomerDeliveryDay').value.trim();
            const deliveryTime = document.getElementById('editCustomerDeliveryTime').value.trim();
            const mapLink = document.getElementById('editCustomerMapLink').value.trim();
            const lat = document.getElementById('editCustomerLat').value;
            const long = document.getElementById('editCustomerLong').value;
            const bottles = document.getElementById('editCustomerBottles').value;
            const bottlesReturned = document.getElementById('editCustomerBottlesReturned').value;
            const bottlesCash = document.getElementById('editCustomerBottlesCash').value;
            const dispensersIssued = document.getElementById('editCustomerDispensersIssued').value;
            const dispensersSold = document.getElementById('editCustomerDispensersSold').value;
            const dispenserModel = document.getElementById('editCustomerDispenserModel').value.trim();
            const dispenserCondition = document.getElementById('editCustomerDispenserCondition').value.trim();
            const product = document.getElementById('editCustomerProduct').value.trim();
            const couponSerial = document.getElementById('editCustomerCouponSerial').value.trim();
            const price = document.getElementById('editCustomerPrice').value;
            const pricing = document.getElementById('editCustomerPricing').value;
            const securityDeposit = document.getElementById('editCustomerSecurityDeposit').value;
            const paymentType = document.getElementById('editCustomerPaymentType').value;
            const remarks = document.getElementById('editCustomerRemarks').value.trim();
            
            if (!fullName || !mobile || !status) {
                showToast('Please fill in all required fields (Name, Mobile, Status).', 'error');
                return;
            }
            
            closeModal();
            showToast('Updating customer...', 'info');
            
            const formData = new FormData();
            formData.append('full_name', fullName);
            formData.append('mobile_number', mobile);
            formData.append('full_address', address);
            formData.append('status', status);
            formData.append('alternative_mobile_number', altMobile);
            formData.append('email_address', email);
            formData.append('office_villa_flat_room_no', officeVilla);
            formData.append('street_name_building_name', streetBuilding);
            formData.append('nearest_landmark', landmark);
            formData.append('area_name', area);
            formData.append('how_you_heard_about_us', howHeard);
            formData.append('delivery_day', deliveryDay);
            formData.append('delivery_time', deliveryTime);
            formData.append('google_map_location_link', mapLink);
            formData.append('lat', lat || '');
            formData.append('long', long || '');
            formData.append('no_of_water_bottles_issued', bottles || '');
            formData.append('of_bottles_returned', bottlesReturned || '');
            formData.append('of_bottles_cash_received', bottlesCash || '');
            formData.append('no_of_water_despenser_issued', dispensersIssued || '');
            formData.append('no_of_water_despenser_sold', dispensersSold || '');
            formData.append('water_despenser_model_number', dispenserModel);
            formData.append('water_despense_condition', dispenserCondition);
            formData.append('select_product', product);
            formData.append('coupon_book_serial_number', couponSerial);
            formData.append('price', price || '');
            formData.append('pricing', pricing || '');
            formData.append('security_deposit', securityDeposit || '');
            formData.append('payment_type', paymentType);
            formData.append('remarks', remarks);
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('_method', 'PUT');
            
            fetch(`/admin/customers/${customerId}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Customer updated successfully!', 'success');
                    loadCustomersData();
                } else {
                    console.error('Update failed:', data);
                    let errorMessage = data.message || 'Failed to update customer';
                    if (data.errors) {
                        const errorList = Object.values(data.errors).flat();
                        errorMessage += ': ' + errorList.join(', ');
                    }
                    showToast(errorMessage, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error updating customer', 'error');
            });
        }

        function deleteCustomer(customerId, customerName) {
            showModal('Delete Customer', `
                <div style="text-align: center; max-width: 400px; margin: 0 auto;">
                    <div style="font-size: 48px; color: #f44336; margin-bottom: 20px;">🗑️</div>
                    <h4 style="color: #f44336; margin-bottom: 15px;">Delete Customer</h4>
                    <p style="margin-bottom: 25px; color: #666;">Are you sure you want to delete the customer:</p>
                    <p style="font-weight: 600; color: #333; margin-bottom: 25px;">${customerName} (${customerId})</p>
                    
                    <div style="background: #ffebee; padding: 15px; border-radius: 8px; margin-bottom: 25px; border-left: 4px solid #f44336;">
                        <p style="margin: 0; font-size: 14px; color: #c62828;">
                            ⚠️ This action cannot be undone. All customer data will be permanently deleted.
                        </p>
                    </div>
                    
                    <div style="display: flex; gap: 15px; justify-content: center;">
                        <button class="btn btn-secondary" onclick="closeModal()" style="padding: 12px 25px; font-size: 16px;">
                            Cancel
                        </button>
                        <button class="btn btn-danger" onclick="confirmDeleteCustomer('${customerId}', '${customerName}')" style="padding: 12px 25px; font-size: 16px;">
                            <i style="margin-right: 8px;">🗑️</i>Delete Customer
                        </button>
                    </div>
                </div>
            `);
        }

        function confirmDeleteCustomer(customerId, customerName) {
            closeModal();
            showToast('Deleting customer...', 'info');
            
            fetch(`/admin/customers/${customerId}`, {
                method: 'DELETE',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast(`Customer ${customerName} deleted successfully!`, 'success');
                    loadCustomersData();
                } else {
                    showToast(data.message || 'Failed to delete customer', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error deleting customer', 'error');
            });
        }

        function filterCustomers(searchTerm) {
            const rows = document.querySelectorAll('.customer-row');
            const searchLower = searchTerm.toLowerCase();
            
            rows.forEach(row => {
                const customerId = row.cells[1].textContent.toLowerCase();
                const fullName = row.cells[2].textContent.toLowerCase();
                const mobileNumber = row.cells[3].textContent.toLowerCase();
                const area = row.cells[4].textContent.toLowerCase();
                
                if (customerId.includes(searchLower) || 
                    fullName.includes(searchLower) || 
                    mobileNumber.includes(searchLower) ||
                    area.includes(searchLower)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function filterCustomersByStatus(status) {
            const rows = document.querySelectorAll('.customer-row');
            
            rows.forEach(row => {
                if (!status) {
                    row.style.display = '';
                    return;
                }
                
                const statusCell = row.cells[8];
                const rowStatus = statusCell.textContent.toLowerCase().includes('delivered') ? 'delivered' : 'pending';
                
                if (rowStatus === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function toggleCustomerSelection(customerId) {
            if (selectedCustomerIds.includes(customerId)) {
                selectedCustomerIds = selectedCustomerIds.filter(id => id !== customerId);
            } else {
                selectedCustomerIds.push(customerId);
            }
            
            updateSelectAllCheckbox();
        }

        function toggleSelectAllCustomers() {
            const selectAllCheckbox = document.getElementById('selectAllCustomers');
            const customerCheckboxes = document.querySelectorAll('.customer-checkbox');
            
            if (selectAllCheckbox.checked) {
                selectedCustomerIds = [];
                customerCheckboxes.forEach(checkbox => {
                    checkbox.checked = true;
                    selectedCustomerIds.push(checkbox.value);
                });
            } else {
                selectedCustomerIds = [];
                customerCheckboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
            }
        }

        function updateSelectAllCheckbox() {
            const selectAllCheckbox = document.getElementById('selectAllCustomers');
            const customerCheckboxes = document.querySelectorAll('.customer-checkbox');
            const checkedCheckboxes = document.querySelectorAll('.customer-checkbox:checked');
            
            if (checkedCheckboxes.length === 0) {
                selectAllCheckbox.indeterminate = false;
                selectAllCheckbox.checked = false;
            } else if (checkedCheckboxes.length === customerCheckboxes.length) {
                selectAllCheckbox.indeterminate = false;
                selectAllCheckbox.checked = true;
            } else {
                selectAllCheckbox.indeterminate = true;
                selectAllCheckbox.checked = false;
            }
        }

        function showAssignModal() {
            if (selectedCustomerIds.length === 0) {
                showToast('Please select customers to assign', 'error');
                return;
            }
            
            showToast('Loading available drivers...', 'info');
            
            fetch('/admin/customers', {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && data.drivers) {
                    const driversOptions = data.drivers.map(driver => 
                        `<option value="${driver.driver_id}">${driver.name} (${driver.driver_id})</option>`
                    ).join('');
                    
                    showModal('Assign Customers to Driver', `
                        <div style="max-width: 500px; margin: 0 auto;">
                            <h4 style="margin-bottom: 25px; color: #333; text-align: center;">🚚 Assign ${selectedCustomerIds.length} Customer(s) to Driver</h4>
                            
                            <div style="background: #e3f2fd; padding: 20px; border-radius: 10px; margin-bottom: 25px; border-left: 4px solid #2196f3;">
                                <h5 style="margin: 0 0 10px 0; color: #1976d2;">📋 Selected Customers</h5>
                                <p style="margin: 0; font-size: 14px; color: #333;">
                                    ${selectedCustomerIds.length} customers selected for assignment
                                </p>
                            </div>
                            
                            <div class="form-group" style="margin-bottom: 25px;">
                                <label style="display: block; margin-bottom: 10px; font-weight: 600; color: #555;">Select Driver *</label>
                                <select id="assignDriverSelect" style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px; background: white;">
                                    <option value="">-- Select Driver --</option>
                                    ${driversOptions}
                                </select>
                            </div>
                            
                            <div style="display: flex; gap: 15px; margin-top: 25px; justify-content: center;">
                                <button class="btn btn-secondary" onclick="closeModal()" style="padding: 12px 25px; font-size: 16px;">
                                    Cancel
                                </button>
                                <button class="btn btn-primary" onclick="assignCustomersToDriver()" style="padding: 12px 25px; font-size: 16px;">
                                    <i style="margin-right: 8px;">✅</i>Assign Customers
                                </button>
                            </div>
                        </div>
                    `);
                } else {
                    showToast('Failed to load drivers', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error loading drivers', 'error');
            });
        }

        function assignCustomersToDriver() {
            const driverId = document.getElementById('assignDriverSelect').value;
            
            if (!driverId) {
                showToast('Please select a driver', 'error');
                return;
            }
            
            closeModal();
            showToast('Assigning customers to driver...', 'info');
            
            const formData = new FormData();
            formData.append('driver_id', driverId);
            selectedCustomerIds.forEach(customerId => {
                formData.append('customer_ids[]', customerId);
            });
            formData.append('_token', '{{ csrf_token() }}');
            
            fetch('/admin/customers/assign', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast(data.message, 'success');
                    selectedCustomerIds = [];
                    document.querySelectorAll('.customer-checkbox').forEach(cb => cb.checked = false);
                    updateSelectAllCheckbox();
                    // Refresh assignments if we're on the assign-customers page
                    if (document.getElementById('assign-customers').classList.contains('active')) {
                        loadCustomerAssignments();
                    }
                } else {
                    showToast(data.message || 'Failed to assign customers', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error assigning customers', 'error');
            });
        }

        // Customer Assignment Functions
        function loadCustomerAssignments() {
            fetch('/admin/customer-assignments', {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateAssignmentStats(data.assignments);
                    updateAssignmentsList(data.assignments);
                } else {
                    console.error('Failed to load assignments:', data.message);
                    showToast('Failed to load assignments', 'error');
                }
            })
            .catch(error => {
                console.error('Error loading assignments:', error);
                showToast('Error loading assignments', 'error');
            });
        }

        function updateAssignmentStats(assignments) {
            const totalAssignments = assignments.reduce((sum, driver) => sum + driver.customers.length, 0);
            const activeDrivers = assignments.length;
            const avgCustomersPerDriver = activeDrivers > 0 ? Math.round(totalAssignments / activeDrivers) : 0;

            document.getElementById('totalAssignmentsCount').textContent = totalAssignments;
            document.getElementById('activeDriversCount').textContent = activeDrivers;
            document.getElementById('assignedCustomersCount').textContent = totalAssignments;
            document.getElementById('avgCustomersPerDriver').textContent = avgCustomersPerDriver;
        }

        function updateAssignmentsList(assignments) {
            const container = document.getElementById('assignmentsByDriver');
            
            if (assignments.length === 0) {
                container.innerHTML = `
                    <div style="text-align: center; padding: 40px; color: #666;">
                        <div style="font-size: 48px; margin-bottom: 20px;">📋</div>
                        <h3 style="margin-bottom: 10px; color: #333;">No Assignments Yet</h3>
                        <p style="margin-bottom: 20px;">Start assigning customers to drivers to manage deliveries efficiently.</p>
                        <button class="btn btn-primary" onclick="showAssignModal()" style="padding: 12px 25px; font-size: 16px; font-weight: 600;">
                            <i style="margin-right: 8px;">🚚</i>Assign Customers Now
                        </button>
                    </div>
                `;
                return;
            }

            let html = '';
            assignments.forEach(driverAssignment => {
                const driver = driverAssignment.driver;
                const customers = driverAssignment.customers;
                
                html += `
                    <div style="background: #f8f9fa; border-radius: 15px; padding: 25px; margin-bottom: 20px; border-left: 5px solid #2196f3;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                            <div>
                                <h4 style="margin: 0; color: #333; font-size: 18px;">
                                    <i style="margin-right: 8px;">🚚</i>${driver.name}
                                </h4>
                                <p style="margin: 5px 0 0 0; color: #666; font-size: 14px;">
                                    Driver ID: ${driver.driver_id} | Mobile: ${driver.mobile_number}
                                </p>
                            </div>
                            <div style="text-align: right;">
                                <span style="background: #2196f3; color: white; padding: 8px 16px; border-radius: 20px; font-size: 14px; font-weight: 600;">
                                    ${customers.length} Customer${customers.length !== 1 ? 's' : ''}
                                </span>
                            </div>
                        </div>
                        
                        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 15px;">
                `;
                
                customers.forEach(customer => {
                    const assignedDate = customer.assigned_at ? new Date(customer.assigned_at).toLocaleDateString('en-US', { 
                        year: 'numeric', 
                        month: 'short', 
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    }) : 'Invalid Date';
                    
                    html += `
                        <div style="background: white; border-radius: 10px; padding: 15px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); border-left: 3px solid #4caf50;">
                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 10px;">
                                <div>
                                    <h5 style="margin: 0 0 5px 0; color: #333; font-size: 16px;">${customer.full_name}</h5>
                                    <p style="margin: 0; color: #666; font-size: 12px;">ID: ${customer.customer_id}</p>
                                </div>
                                <button onclick="unassignCustomer('${customer.customer_id}', '${driver.driver_id}')" 
                                        style="background: #f44336; color: white; border: none; padding: 4px 8px; border-radius: 5px; cursor: pointer; font-size: 10px;"
                                        title="Remove assignment">
                                    ✕
                                </button>
                            </div>
                            <div style="font-size: 12px; color: #666; margin-bottom: 8px;">
                                <div style="margin-bottom: 4px;">📱 ${customer.mobile_number || 'N/A'}</div>
                                <div style="margin-bottom: 4px;">📍 ${customer.area_name || 'N/A'}</div>
                                <div style="margin-bottom: 4px;" title="${customer.full_address || 'N/A'}">
                                    🏠 ${customer.full_address ? (customer.full_address.length > 50 ? customer.full_address.substring(0, 50) + '...' : customer.full_address) : 'N/A'}
                                </div>
                            </div>
                            <div style="font-size: 11px; color: #999; border-top: 1px solid #eee; padding-top: 8px;">
                                <div>📅 Assigned: ${assignedDate}</div>
                                <div>👤 By: ${customer.assigned_by || 'Admin'}</div>
                            </div>
                        </div>
                    `;
                });
                
                html += `
                        </div>
                    </div>
                `;
            });
            
            container.innerHTML = html;
        }

        function unassignCustomer(customerId, driverId) {
            if (confirm('Are you sure you want to remove this customer assignment?')) {
                fetch(`/admin/customer-assignments/${customerId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast('Customer unassigned successfully!', 'success');
                        loadCustomerAssignments();
                    } else {
                        showToast(data.message || 'Failed to unassign customer', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Error unassigning customer', 'error');
                });
            }
        }

        function refreshAssignments() {
            showToast('Refreshing assignments...', 'info');
            loadCustomerAssignments();
        }

        function downloadAssignmentReport() {
            showToast('Generating assignment report...', 'info');
            // You can implement report generation logic here
            setTimeout(() => {
                showToast('Report download started!', 'success');
            }, 1500);
        }

        // Refresh deliveries data
        function refreshDeliveries() {
            showToast('Refreshing delivery data...', 'info');
            
            fetch('/admin/delivery-records', {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateDeliveryRecordsTable(data.data);
                    showToast('Delivery data refreshed successfully!', 'success');
                } else {
                    showToast('Failed to refresh delivery data', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error refreshing delivery data', 'error');
                // Fallback to page reload
                setTimeout(() => {
                    location.reload();
                }, 1000);
            });
        }

        // Update delivery records table
        function updateDeliveryRecordsTable(data) {
            // Update stats cards
            const statsCards = document.querySelectorAll('#deliveries .stat-card .value');
            if (statsCards.length >= 4) {
                statsCards[0].textContent = data.stats.total;
                statsCards[1].textContent = data.stats.today;
                statsCards[2].textContent = data.stats.this_week;
                statsCards[3].textContent = data.stats.this_month;
            }

            // Update table if it exists
            const tableBody = document.querySelector('#deliveries .delivery-record-table tbody');
            if (tableBody && data.completedDeliveries.length > 0) {
                let html = '';
                data.completedDeliveries.forEach(delivery => {
                    html += `
                        <tr style="border-bottom: 1px solid #e9ecef; transition: background-color 0.3s ease;">
                            <td style="padding: 15px 12px; font-weight: 600; color: #2196f3;">${delivery.customer_id}</td>
                            <td style="padding: 15px 12px; font-weight: 500; color: #333;">${delivery.customer_name}</td>
                            <td style="padding: 15px 12px; color: #666;">${delivery.phone}</td>
                            <td style="padding: 15px 12px; color: #666; max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="${delivery.address}">
                                ${delivery.address}
                            </td>
                            <td style="padding: 15px 12px; color: #666;">${delivery.area}</td>
                            <td style="padding: 15px 12px; font-weight: 500; color: #ff9800;">${delivery.driver_name}</td>
                            <td style="padding: 15px 12px; text-align: center; font-weight: 600; color: #4caf50;">${delivery.bottles}</td>
                            <td style="padding: 15px 12px; text-align: center; font-weight: 600; color: #e91e63;">AED ${parseFloat(delivery.cash_amount).toFixed(2)}</td>
                            <td style="padding: 15px 12px; color: #666; font-size: 13px;">${delivery.completed_at}</td>
                            <td style="padding: 15px 12px; color: #666; max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="${delivery.notes}">
                                ${delivery.notes}
                            </td>
                        </tr>
                    `;
                });
                tableBody.innerHTML = html;
            }
        }

        // Admin logout function
        function adminLogout() {
            if (confirm('Are you sure you want to logout?')) {
                // Create a form to submit POST request for logout
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("admin.logout") }}';
                
                // Add CSRF token
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                form.appendChild(csrfToken);
                
                // Submit the form
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html>
