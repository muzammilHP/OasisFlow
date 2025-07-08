<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OASISFLOW - Driver Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            color: #333;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: transform 0.3s ease;
        }

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logo h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .tagline {
            font-size: 12px;
            opacity: 0.8;
        }

        .nav-menu {
            list-style: none;
        }

        .nav-item {
            padding: 15px 20px;
            margin-bottom: 8px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 16px;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .nav-item.active {
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .nav-item i {
            font-size: 20px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .main-content.full-width {
            margin-left: 0;
        }

        .topbar {
            background: white;
            padding: 15px 25px;
            border-radius: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .logout-btn {
            background: #ff4757;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s ease;
        }

        .logout-btn:hover {
            background: #ff3838;
        }

        /* Content Area */
        .content-area {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            min-height: 600px;
        }

        .page-section {
            display: none;
        }

        .page-section.active {
            display: block;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card h3 {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stat-card .value {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .stat-card .change {
            font-size: 14px;
            color: #28a745;
        }

        /* Table Styles */
        .table-container {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .data-table th,
        .data-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .data-table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #555;
            white-space: nowrap;
        }

        .data-table tr:hover {
            background: #f8f9fa;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s ease;
            margin-right: 5px;
        }

        .btn-primary {
            background: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background: #0056b3;
        }

        .btn-success {
            background: #28a745;
            color: white;
        }

        .btn-success:hover {
            background: #1e7e34;
        }

        .btn-info {
            background: #17a2b8;
            color: white;
        }

        .btn-info:hover {
            background: #138496;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-active {
            background: #d4edda;
            color: #155724;
        }

        .status-completed {
            background: #cce5ff;
            color: #004085;
        }

        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        /* Loading Spinner */
        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 50px;
        }

        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #667eea;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Welcome Section */
        .welcome-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .welcome-section::before {
            content: '🚚';
            position: absolute;
            top: -20px;
            right: -20px;
            font-size: 120px;
            opacity: 0.1;
        }

        .welcome-section h2 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .welcome-section p {
            font-size: 16px;
            opacity: 0.9;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-menu-btn {
                display: block;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .user-profile {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="logo">
                <h1>💧 OASISFLOW</h1>
                <div class="tagline">Driver Dashboard</div>
            </div>
            <nav class="nav-menu">
                <div class="nav-item active" data-page="dashboard">
                    <i>🏠</i>
                    <span>Dashboard</span>
                </div>
                <div class="nav-item" data-page="assigned-deliveries">
                    <i>📦</i>
                    <span>Assigned Deliveries</span>
                </div>
                <div class="nav-item" data-page="delivery-history">
                    <i>📋</i>
                    <span>Delivery History</span>
                </div>
                <div class="nav-item" data-page="settings">
                    <i>⚙️</i>
                    <span>Settings</span>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Bar -->
            <div class="topbar">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <button class="mobile-menu-btn" onclick="toggleMobileMenu()">☰</button>
                    <h2 id="page-title">Dashboard</h2>
                </div>
                <div class="user-profile">
                    <div class="user-avatar" id="driverAvatar">DR</div>
                    <div>
                        <div style="font-weight: 600;" id="driverName">Loading...</div>
                        <div style="font-size: 12px; color: #666;" id="driverStatus">Driver</div>
                    </div>
                    <button class="logout-btn" onclick="logout()">Logout</button>
                </div>
            </div>

            <!-- Content Area -->
            <div class="content-area">
                <!-- Dashboard Page -->
                <div class="page-section active" id="dashboard">
                    <!-- Welcome Section -->
                    <div class="welcome-section">
                        <h2 id="welcomeMessage">Welcome back, Driver!</h2>
                        <p>Your delivery dashboard is ready. Check your assigned deliveries and track your progress.</p>
                    </div>

                    <!-- Stats Grid -->
                    <div class="stats-grid">
                        <div class="stat-card" style="border-left: 4px solid #28a745;">
                            <h3>Total Assignments</h3>
                            <div class="value" id="totalAssignments">0</div>
                            <div class="change" id="totalAssignmentsChange">Loading...</div>
                        </div>
                        <div class="stat-card" style="border-left: 4px solid #007bff;">
                            <h3>Active Deliveries</h3>
                            <div class="value" id="activeDeliveries">0</div>
                            <div class="change" id="activeDeliveriesChange">Loading...</div>
                        </div>
                        <div class="stat-card" style="border-left: 4px solid #17a2b8;">
                            <h3>Completed Deliveries</h3>
                            <div class="value" id="completedDeliveries">0</div>
                            <div class="change" id="completedDeliveriesChange">Loading...</div>
                        </div>
                        <div class="stat-card" style="border-left: 4px solid #ffc107;">
                            <h3>Driver Rating</h3>
                            <div class="value" id="driverRating">0.0</div>
                            <div class="change" id="driverRatingChange">⭐ Stars</div>
                        </div>
                    </div>
                </div>

                <!-- Assigned Deliveries Page -->
                <div class="page-section" id="assigned-deliveries">
                    <h3 style="margin-bottom: 20px;">📦 Assigned Deliveries</h3>
                    <div class="table-container">
                        <div class="loading" id="deliveriesLoading">
                            <div class="spinner"></div>
                        </div>
                        <table class="data-table" id="deliveriesTable" style="display: none;">
                            <thead>
                                <tr>
                                    <th>Customer ID</th>
                                    <th>Customer Name</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Area</th>
                                    <th>Delivery Day</th>
                                    <th>Delivery Time</th>
                                    <th>Bottles</th>
                                    <th>Assigned Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="deliveriesTableBody">
                                <!-- Dynamic content will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Delivery History Page -->
                <div class="page-section" id="delivery-history">
                    <h3 style="margin-bottom: 20px;">📋 Delivery History</h3>
                    <div class="table-container">
                        <div class="loading" id="historyLoading">
                            <div class="spinner"></div>
                        </div>
                        <table class="data-table" id="historyTable" style="display: none;">
                            <thead>
                                <tr>
                                    <th>Customer ID</th>
                                    <th>Customer Name</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Area</th>
                                    <th>Assigned Date</th>
                                    <th>Completed Date</th>
                                    <th>Status</th>
                                    <th>Notes</th>
                                </tr>
                            </thead>
                            <tbody id="historyTableBody">
                                <!-- Dynamic content will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Settings Page -->
                <div class="page-section" id="settings">
                    <h3 style="margin-bottom: 20px;">⚙️ Settings</h3>
                    <div class="table-container">
                        <div id="settingsContent">
                            <h4>Driver Profile</h4>
                            <div id="driverProfile">
                                <div class="loading">
                                    <div class="spinner"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Global variables
        let currentPage = 'dashboard';
        let driverData = null;
        let assignedDeliveries = [];
        let deliveryHistory = [];
        let driverStats = {};

        // CSRF token for AJAX requests
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Initialize the application
        document.addEventListener('DOMContentLoaded', function() {
            initializeApp();
            setupEventListeners();
        });

        // Initialize app
        async function initializeApp() {
            try {
                await loadDriverProfile();
                await loadDriverStats();
                await loadAssignedDeliveries();
                await loadDeliveryHistory();
                updateDashboard();
            } catch (error) {
                console.error('Error initializing app:', error);
                showError('Failed to load driver data. Please refresh the page.');
            }
        }

        // Setup event listeners
        function setupEventListeners() {
            // Navigation
            document.querySelectorAll('.nav-item').forEach(item => {
                item.addEventListener('click', function() {
                    const page = this.dataset.page;
                    showPage(page);
                });
            });

            // Mobile menu
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    document.getElementById('sidebar').classList.remove('show');
                }
            });
        }

        // API Functions
        async function apiRequest(endpoint, options = {}) {
            const defaultOptions = {
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            };

            const finalOptions = { ...defaultOptions, ...options };
            
            try {
                const response = await fetch(endpoint, finalOptions);
                const data = await response.json();
                
                if (!response.ok) {
                    throw new Error(data.message || 'API request failed');
                }
                
                return data;
            } catch (error) {
                console.error('API Error:', error);
                throw error;
            }
        }

        // Load driver profile
        async function loadDriverProfile() {
            try {
                const response = await apiRequest('/driver/profile');
                driverData = response.driver;
                updateDriverInfo();
            } catch (error) {
                console.error('Error loading driver profile:', error);
                showError('Failed to load driver profile');
            }
        }

        // Load driver statistics
        async function loadDriverStats() {
            try {
                const response = await apiRequest('/driver/stats');
                driverStats = response.stats;
                updateStatsDisplay();
            } catch (error) {
                console.error('Error loading driver stats:', error);
                showError('Failed to load driver statistics');
            }
        }

        // Load assigned deliveries
        async function loadAssignedDeliveries() {
            try {
                const response = await apiRequest('/driver/assigned-deliveries');
                assignedDeliveries = response.deliveries;
                updateAssignedDeliveriesTable();
            } catch (error) {
                console.error('Error loading assigned deliveries:', error);
                showError('Failed to load assigned deliveries');
            }
        }

        // Load delivery history
        async function loadDeliveryHistory() {
            try {
                const response = await apiRequest('/driver/delivery-history');
                deliveryHistory = response.history;
                updateDeliveryHistoryTable();
            } catch (error) {
                console.error('Error loading delivery history:', error);
                showError('Failed to load delivery history');
            }
        }

        // Update driver info in the UI
        function updateDriverInfo() {
            if (!driverData) return;

            document.getElementById('driverName').textContent = driverData.name;
            document.getElementById('driverAvatar').textContent = driverData.name.split(' ').map(n => n[0]).join('').toUpperCase();
            document.getElementById('welcomeMessage').textContent = `Welcome back, ${driverData.name}!`;
            document.getElementById('driverStatus').textContent = `Driver ID: ${driverData.id}`;
            
            // Update settings page
            updateSettingsPage();
        }

        // Update stats display
        function updateStatsDisplay() {
            if (!driverStats) return;

            document.getElementById('totalAssignments').textContent = driverStats.total_assignments || 0;
            document.getElementById('activeDeliveries').textContent = driverStats.active_assignments || 0;
            document.getElementById('completedDeliveries').textContent = driverStats.completed_deliveries || 0;
            document.getElementById('driverRating').textContent = parseFloat(driverStats.driver_rating || 0).toFixed(1);
            
            document.getElementById('totalAssignmentsChange').textContent = `${driverStats.this_month_assignments || 0} this month`;
            document.getElementById('activeDeliveriesChange').textContent = 'Current assignments';
            document.getElementById('completedDeliveriesChange').textContent = 'Total completed';
            document.getElementById('driverRatingChange').textContent = '⭐ Stars';
        }

        // Update assigned deliveries table
        function updateAssignedDeliveriesTable() {
            const loading = document.getElementById('deliveriesLoading');
            const table = document.getElementById('deliveriesTable');
            const tbody = document.getElementById('deliveriesTableBody');

            loading.style.display = 'none';
            table.style.display = 'table';

            tbody.innerHTML = '';

            if (assignedDeliveries.length === 0) {
                tbody.innerHTML = '<tr><td colspan="10" style="text-align: center; padding: 20px;">No assigned deliveries found</td></tr>';
                return;
            }

            assignedDeliveries.forEach(delivery => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${delivery.customer_id}</td>
                    <td>${delivery.customer_name}</td>
                    <td>${delivery.customer_phone}</td>
                    <td title="${delivery.customer_address}">${truncateText(delivery.customer_address, 30)}</td>
                    <td>${delivery.area_name}</td>
                    <td>${delivery.delivery_day}</td>
                    <td>${delivery.delivery_time}</td>
                    <td>${delivery.bottles_required}</td>
                    <td>${formatDate(delivery.assigned_at)}</td>
                    <td>
                        <button class="btn btn-success" onclick="completeDelivery(${delivery.id})">Complete</button>
                        ${delivery.google_map_link ? `<a href="${delivery.google_map_link}" target="_blank" class="btn btn-info">Map</a>` : ''}
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        // Update delivery history table
        function updateDeliveryHistoryTable() {
            const loading = document.getElementById('historyLoading');
            const table = document.getElementById('historyTable');
            const tbody = document.getElementById('historyTableBody');

            loading.style.display = 'none';
            table.style.display = 'table';

            tbody.innerHTML = '';

            if (deliveryHistory.length === 0) {
                tbody.innerHTML = '<tr><td colspan="9" style="text-align: center; padding: 20px;">No delivery history found</td></tr>';
                return;
            }

            deliveryHistory.forEach(delivery => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${delivery.customer_id}</td>
                    <td>${delivery.customer_name}</td>
                    <td>${delivery.customer_phone}</td>
                    <td title="${delivery.customer_address}">${truncateText(delivery.customer_address, 30)}</td>
                    <td>${delivery.area_name}</td>
                    <td>${formatDate(delivery.assigned_at)}</td>
                    <td>${formatDate(delivery.completed_at)}</td>
                    <td><span class="status-badge status-${delivery.status}">${delivery.status}</span></td>
                    <td>${delivery.notes || '-'}</td>
                `;
                tbody.appendChild(row);
            });
        }

        // Update settings page
        function updateSettingsPage() {
            if (!driverData) return;

            const profileDiv = document.getElementById('driverProfile');
            profileDiv.innerHTML = `
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                    <div>
                        <strong>Name:</strong> ${driverData.name}<br>
                        <strong>Email:</strong> ${driverData.email}<br>
                        <strong>Phone:</strong> ${driverData.phone}<br>
                        <strong>Driver ID:</strong> ${driverData.id}
                    </div>
                    <div>
                        <strong>Address:</strong> ${driverData.address}<br>
                        <strong>Vehicle Number:</strong> ${driverData.vehicle_number || 'Not assigned'}<br>
                        <strong>Status:</strong> ${driverData.status}<br>
                        <strong>Total Deliveries:</strong> ${driverData.total_deliveries || 0}
                    </div>
                </div>
            `;
        }

        // Complete delivery
        async function completeDelivery(assignmentId) {
            if (!confirm('Are you sure you want to mark this delivery as completed?')) {
                return;
            }

            const notes = prompt('Add any notes for this delivery (optional):');

            try {
                await apiRequest('/driver/complete-delivery', {
                    method: 'POST',
                    body: JSON.stringify({
                        assignment_id: assignmentId,
                        notes: notes
                    })
                });

                showSuccess('Delivery marked as completed successfully!');
                
                // Refresh data
                await loadAssignedDeliveries();
                await loadDeliveryHistory();
                await loadDriverStats();
                
                updateDashboard();
            } catch (error) {
                console.error('Error completing delivery:', error);
                showError('Failed to complete delivery: ' + error.message);
            }
        }

        // Logout function
        async function logout() {
            if (!confirm('Are you sure you want to logout?')) {
                return;
            }

            try {
                await apiRequest('/driver/logout', {
                    method: 'POST'
                });

                window.location.href = '/driver-login';
            } catch (error) {
                console.error('Error logging out:', error);
                showError('Failed to logout: ' + error.message);
            }
        }

        // Show page
        function showPage(pageId) {
            // Update navigation
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('active');
            });
            document.querySelector(`[data-page="${pageId}"]`).classList.add('active');

            // Update page title
            const pageTitles = {
                'dashboard': 'Dashboard',
                'assigned-deliveries': 'Assigned Deliveries',
                'delivery-history': 'Delivery History',
                'settings': 'Settings'
            };
            document.getElementById('page-title').textContent = pageTitles[pageId] || pageId;

            // Show page content
            document.querySelectorAll('.page-section').forEach(section => {
                section.classList.remove('active');
            });
            document.getElementById(pageId).classList.add('active');

            currentPage = pageId;
        }

        // Toggle mobile menu
        function toggleMobileMenu() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        }

        // Update dashboard
        function updateDashboard() {
            updateDriverInfo();
            updateStatsDisplay();
            updateAssignedDeliveriesTable();
            updateDeliveryHistoryTable();
        }

        // Utility functions
        function formatDate(dateString) {
            if (!dateString) return 'N/A';
            return new Date(dateString).toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        function truncateText(text, maxLength) {
            if (!text) return '';
            return text.length > maxLength ? text.substring(0, maxLength) + '...' : text;
        }

        function showSuccess(message) {
            alert('Success: ' + message);
        }

        function showError(message) {
            alert('Error: ' + message);
        }
    </script>
</body>
</html>
