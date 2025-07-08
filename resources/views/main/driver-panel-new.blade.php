<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OASISFLOW -  Dashboard</title>
    @vite(['resources/css/customer-panel.css', 'resources/js/app.js'])
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
                    <div class="weather-widget" style="padding: 10px; font-size: 12px; margin: 0;">
                        <div>Abu Dhabi: 32°C ☀️</div>
                    </div>
                    <div class="notification-icon" onclick="showNotifications()">
                        🔔
                        <div class="notification-badge">3</div>
                    </div>
                    <div class="user-avatar">DR</div>
                    <div>
                        <div style="font-weight: 600;" id="driverNameDisplay">Driver Name</div>
                        <div style="font-size: 12px; color: #666;">Driver</div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="content-area">
                <!-- Dashboard Page -->
                <div class="page-section active" id="dashboard">
                    <!-- Driver Welcome Section -->
                    <div style="background: linear-gradient(135deg, #0277bd, #0288d1); color: white; padding: 30px; border-radius: 20px; margin-bottom: 30px; position: relative; overflow: hidden;">
                        <div style="position: absolute; top: -20px; right: -20px; opacity: 0.1; font-size: 120px;">🚚</div>
                        <div style="position: relative; z-index: 2;">
                            <h2 style="margin: 0 0 10px 0; font-size: 28px;">Good morning, Driver! 🌅</h2>
                            <p style="margin: 0 0 20px 0; font-size: 16px; opacity: 0.9;">Welcome to your delivery dashboard. Ready to serve our customers!</p>
                            <div style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                                <button class="btn" style="background: rgba(255,255,255,0.2); color: white; border: 2px solid rgba(255,255,255,0.3); padding: 12px 25px; font-size: 16px; font-weight: 600;" onclick="showPage('assigned-deliveries')">
                                    📦 View Deliveries
                                </button>
                                <div style="font-size: 14px; opacity: 0.8;">
                                    ⏰ Today's deliveries: <strong><span id="todayDeliveryCount">Loading...</span></strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Driver Stats Grid -->
                    <div class="stats-grid" style="margin-bottom: 30px;">
                        <div class="stat-card" style="background: linear-gradient(135deg, #4caf50, #66bb6a); color: white;">
                            <h3>Total Deliveries</h3>
                            <div class="value" id="totalDeliveries">0</div>
                            <div class="change" style="color: rgba(255,255,255,0.8);">All time</div>
                        </div>
                        <div class="stat-card" style="background: linear-gradient(135deg, #ff9800, #ffb74d); color: white;">
                            <h3>Today's Deliveries</h3>
                            <div class="value" id="todayDeliveries">0</div>
                            <div class="change" style="color: rgba(255,255,255,0.8);">Completed today</div>
                        </div>
                        <div class="stat-card" style="background: linear-gradient(135deg, #9c27b0, #ba68c8); color: white;">
                            <h3>Pending Deliveries</h3>
                            <div class="value" id="pendingDeliveries">0</div>
                            <div class="change" style="color: rgba(255,255,255,0.8);">Need attention</div>
                        </div>
                        <div class="stat-card" style="background: linear-gradient(135deg, #2196f3, #42a5f5); color: white;">
                            <h3>Driver Rating</h3>
                            <div class="value" id="driverRating">5.0</div>
                            <div class="change" style="color: rgba(255,255,255,0.8);">⭐ Average rating</div>
                        </div>
                    </div>

                    <!-- Recent Assignments -->
                    <div style="background: white; padding: 25px; border-radius: 20px; margin-bottom: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                            <h3 style="margin: 0; color: #333; font-size: 22px;">📦 Recent Assignments</h3>
                            <button class="btn btn-primary" onclick="showPage('assigned-deliveries')" style="font-size: 14px;">View All Assignments</button>
                        </div>
                        
                        <div id="recentAssignments">
                            <div style="text-align: center; padding: 40px; color: #666;">
                                <div style="font-size: 48px; margin-bottom: 20px;">📦</div>
                                <p>Loading recent assignments...</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Assigned Deliveries Page -->
                <div class="page-section" id="assigned-deliveries">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                        <h2 style="margin: 0; color: #333; font-size: 28px;">📦 Assigned Deliveries</h2>
                        <button class="btn btn-primary" onclick="refreshAssignedDeliveries()" style="padding: 12px 20px; font-size: 14px;">
                            🔄 Refresh
                        </button>
                    </div>

                    <!-- Delivery Filters -->
                    <div style="background: white; padding: 20px; border-radius: 15px; margin-bottom: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                        <div style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
                            <label style="font-weight: 600; color: #555;">Filter by Status:</label>
                            <select id="deliveryStatusFilter" onchange="filterDeliveries()" style="padding: 8px 12px; border: 2px solid #e0e0e0; border-radius: 6px; font-size: 14px;">
                                <option value="all">All Deliveries</option>
                                <option value="pending">Pending</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                            <button class="btn btn-secondary" onclick="markAllCompleted()" style="margin-left: auto;">
                                ✅ Mark All Completed
                            </button>
                        </div>
                    </div>

                    <!-- Assigned Deliveries Table -->
                    <div style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                        <div style="overflow-x: auto;">
                            <table id="assignedDeliveriesTable" style="width: 100%; border-collapse: collapse;">
                                <thead>
                                    <tr style="background: #f8f9fa;">
                                        <th style="padding: 15px; text-align: left; font-weight: 600; color: #333; border-bottom: 2px solid #dee2e6;">Customer ID</th>
                                        <th style="padding: 15px; text-align: left; font-weight: 600; color: #333; border-bottom: 2px solid #dee2e6;">Customer Name</th>
                                        <th style="padding: 15px; text-align: left; font-weight: 600; color: #333; border-bottom: 2px solid #dee2e6;">Mobile</th>
                                        <th style="padding: 15px; text-align: left; font-weight: 600; color: #333; border-bottom: 2px solid #dee2e6;">Address</th>
                                        <th style="padding: 15px; text-align: left; font-weight: 600; color: #333; border-bottom: 2px solid #dee2e6;">Delivery Day</th>
                                        <th style="padding: 15px; text-align: center; font-weight: 600; color: #333; border-bottom: 2px solid #dee2e6;">Status</th>
                                        <th style="padding: 15px; text-align: center; font-weight: 600; color: #333; border-bottom: 2px solid #dee2e6;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="assignedDeliveriesTableBody">
                                    <!-- Dynamic content will be loaded here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Delivery History Page -->
                <div class="page-section" id="delivery-history">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                        <h2 style="margin: 0; color: #333; font-size: 28px;">📋 Delivery History</h2>
                        <div style="display: flex; gap: 10px;">
                            <button class="btn btn-secondary" onclick="exportDeliveryHistory()" style="padding: 12px 20px; font-size: 14px;">
                                📥 Export History
                            </button>
                            <button class="btn btn-primary" onclick="refreshDeliveryHistory()" style="padding: 12px 20px; font-size: 14px;">
                                🔄 Refresh
                            </button>
                        </div>
                    </div>

                    <!-- History Filters -->
                    <div style="background: white; padding: 20px; border-radius: 15px; margin-bottom: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                        <div style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
                            <label style="font-weight: 600; color: #555;">Filter by Date:</label>
                            <input type="date" id="historyDateFrom" style="padding: 8px 12px; border: 2px solid #e0e0e0; border-radius: 6px; font-size: 14px;">
                            <span style="color: #666;">to</span>
                            <input type="date" id="historyDateTo" style="padding: 8px 12px; border: 2px solid #e0e0e0; border-radius: 6px; font-size: 14px;">
                            <button class="btn btn-primary" onclick="filterDeliveryHistory()" style="padding: 8px 16px;">
                                🔍 Filter
                            </button>
                        </div>
                    </div>

                    <!-- Delivery History Table -->
                    <div style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                        <div style="overflow-x: auto;">
                            <table id="deliveryHistoryTable" style="width: 100%; border-collapse: collapse;">
                                <thead>
                                    <tr style="background: #f8f9fa;">
                                        <th style="padding: 15px; text-align: left; font-weight: 600; color: #333; border-bottom: 2px solid #dee2e6;">Date</th>
                                        <th style="padding: 15px; text-align: left; font-weight: 600; color: #333; border-bottom: 2px solid #dee2e6;">Customer</th>
                                        <th style="padding: 15px; text-align: left; font-weight: 600; color: #333; border-bottom: 2px solid #dee2e6;">Address</th>
                                        <th style="padding: 15px; text-align: center; font-weight: 600; color: #333; border-bottom: 2px solid #dee2e6;">Bottles Delivered</th>
                                        <th style="padding: 15px; text-align: center; font-weight: 600; color: #333; border-bottom: 2px solid #dee2e6;">Status</th>
                                        <th style="padding: 15px; text-align: center; font-weight: 600; color: #333; border-bottom: 2px solid #dee2e6;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="deliveryHistoryTableBody">
                                    <!-- Dynamic content will be loaded here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Settings Page -->
                <div class="page-section" id="settings">
                    <h2 style="margin-bottom: 30px; color: #333; font-size: 28px;">⚙️ Driver Settings</h2>
                    
                    <div style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                        <h3 style="margin-bottom: 20px; color: #333;">Profile Information</h3>
                        <form id="driverSettingsForm">
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                                <div>
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Name</label>
                                    <input type="text" id="driverName" readonly style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; background: #f5f5f5;">
                                </div>
                                <div>
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Driver ID</label>
                                    <input type="text" id="driverIdField" readonly style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; background: #f5f5f5;">
                                </div>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                                <div>
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Phone</label>
                                    <input type="text" id="driverPhone" readonly style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; background: #f5f5f5;">
                                </div>
                                <div>
                                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Email</label>
                                    <input type="email" id="driverEmail" readonly style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; background: #f5f5f5;">
                                </div>
                            </div>
                            <div style="margin-bottom: 20px;">
                                <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #555;">Address</label>
                                <textarea id="driverAddress" rows="3" readonly style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; background: #f5f5f5; resize: vertical;"></textarea>
                            </div>
                            <div style="text-align: center; margin-top: 30px;">
                                <button type="button" onclick="logout()" style="background: linear-gradient(45deg, #f44336, #e53935); color: white; border: none; padding: 12px 30px; border-radius: 25px; font-weight: 600; cursor: pointer; font-size: 16px;">
                                    🚪 Logout
                                </button>
                            </div>
                        </form>
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
                <button onclick="closeModal()" style="background: none; border: none; font-size: 24px; cursor: pointer; color: #666;">&times;</button>
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
        // Global variables
        let currentDriver = null;
        let assignedDeliveries = [];
        let deliveryHistory = [];

        // Initialize dashboard
        document.addEventListener('DOMContentLoaded', function() {
            loadDriverProfile();
            loadAssignedDeliveries();
            loadDriverStats();
            
            // Add navigation listeners
            document.querySelectorAll('.nav-item').forEach(item => {
                item.addEventListener('click', function() {
                    const pageId = this.getAttribute('data-page');
                    showPage(pageId);
                });
            });
        });

        // Navigation
        function showPage(pageId) {
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
                'assigned-deliveries': 'Assigned Deliveries',
                'delivery-history': 'Delivery History',
                'settings': 'Settings'
            };
            document.getElementById('page-title').textContent = titles[pageId] || 'Dashboard';
            
            // Load data for specific pages
            if (pageId === 'assigned-deliveries') {
                loadAssignedDeliveries();
            } else if (pageId === 'delivery-history') {
                loadDeliveryHistory();
            }
        }

        // Load driver profile
        function loadDriverProfile() {
            fetch('/driver/profile', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    currentDriver = data.driver;
                    updateDriverProfile(data.driver);
                } else {
                    showToast('Failed to load driver profile', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error loading driver profile', 'error');
            });
        }

        // Update driver profile in UI
        function updateDriverProfile(driver) {
            document.getElementById('driverNameDisplay').textContent = driver.name;
            document.getElementById('driverName').value = driver.name;
            document.getElementById('driverIdField').value = driver.driver_id;
            document.getElementById('driverPhone').value = driver.phone;
            document.getElementById('driverEmail').value = driver.email;
            document.getElementById('driverAddress').value = driver.address;
            document.getElementById('driverRating').textContent = parseFloat(driver.rating || 0).toFixed(1);
            document.getElementById('totalDeliveries').textContent = driver.total_deliveries || 0;
        }

        // Load assigned deliveries
        function loadAssignedDeliveries() {
            fetch('/driver/assigned-deliveries', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    assignedDeliveries = data.deliveries;
                    updateAssignedDeliveriesTable(data.deliveries);
                    updateRecentAssignments(data.deliveries.slice(0, 3)); // Show first 3
                } else {
                    showToast('Failed to load assigned deliveries', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error loading assigned deliveries', 'error');
            });
        }

        // Update assigned deliveries table
        function updateAssignedDeliveriesTable(deliveries) {
            const tableBody = document.getElementById('assignedDeliveriesTableBody');
            
            if (deliveries.length === 0) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 40px; color: #666;">
                            <div style="font-size: 48px; margin-bottom: 20px;">📦</div>
                            <p>No deliveries assigned yet.</p>
                        </td>
                    </tr>
                `;
                return;
            }

            let html = '';
            deliveries.forEach(delivery => {
                const customer = delivery.customer;
                const statusBadge = getStatusBadge(delivery.delivery_status || 'pending');
                
                html += `
                    <tr style="border-bottom: 1px solid #e9ecef;">
                        <td style="padding: 15px; font-weight: 600; color: #2196f3;">${customer.customer_id}</td>
                        <td style="padding: 15px; font-weight: 600;">${customer.full_name}</td>
                        <td style="padding: 15px;">${customer.mobile_number}</td>
                        <td style="padding: 15px; max-width: 200px;" title="${customer.full_address}">${customer.full_address ? (customer.full_address.length > 50 ? customer.full_address.substring(0, 50) + '...' : customer.full_address) : 'N/A'}</td>
                        <td style="padding: 15px;">${customer.delivery_day || 'N/A'}</td>
                        <td style="padding: 15px; text-align: center;">${statusBadge}</td>
                        <td style="padding: 15px; text-align: center;">
                            <div style="display: flex; gap: 5px; justify-content: center;">
                                <button onclick="markDeliveryCompleted('${customer.customer_id}')" 
                                        style="background: #4caf50; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 12px;">
                                    ✅ Complete
                                </button>
                                <button onclick="callCustomer('${customer.mobile_number}')" 
                                        style="background: #2196f3; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 12px;">
                                    📞 Call
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            });
            
            tableBody.innerHTML = html;
        }

        // Update recent assignments
        function updateRecentAssignments(deliveries) {
            const container = document.getElementById('recentAssignments');
            
            if (deliveries.length === 0) {
                container.innerHTML = `
                    <div style="text-align: center; padding: 40px; color: #666;">
                        <div style="font-size: 48px; margin-bottom: 20px;">📦</div>
                        <p>No recent assignments.</p>
                    </div>
                `;
                return;
            }

            let html = '<div style="display: grid; gap: 15px;">';
            deliveries.forEach(delivery => {
                const customer = delivery.customer;
                html += `
                    <div style="background: #f8f9fa; border-radius: 10px; padding: 15px; border-left: 4px solid #2196f3;">
                        <div style="display: flex; justify-content: between; align-items: center;">
                            <div>
                                <h4 style="margin: 0 0 5px 0; color: #333;">${customer.full_name}</h4>
                                <p style="margin: 0; color: #666; font-size: 14px;">📞 ${customer.mobile_number}</p>
                                <p style="margin: 5px 0 0 0; color: #666; font-size: 14px;">📍 ${customer.area_name || 'N/A'}</p>
                            </div>
                            <div style="text-align: right;">
                                ${getStatusBadge(delivery.delivery_status || 'pending')}
                            </div>
                        </div>
                    </div>
                `;
            });
            html += '</div>';
            
            container.innerHTML = html;
        }

        // Get status badge HTML
        function getStatusBadge(status) {
            const badges = {
                'pending': '<span style="background: #ff9800; color: white; padding: 4px 12px; border-radius: 15px; font-size: 12px; font-weight: 600;">⏳ Pending</span>',
                'in_progress': '<span style="background: #2196f3; color: white; padding: 4px 12px; border-radius: 15px; font-size: 12px; font-weight: 600;">🚚 In Progress</span>',
                'completed': '<span style="background: #4caf50; color: white; padding: 4px 12px; border-radius: 15px; font-size: 12px; font-weight: 600;">✅ Completed</span>'
            };
            return badges[status] || badges['pending'];
        }

        // Load driver stats
        function loadDriverStats() {
            fetch('/driver/stats', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('todayDeliveries').textContent = data.stats.today_deliveries || 0;
                    document.getElementById('pendingDeliveries').textContent = data.stats.pending_deliveries || 0;
                    document.getElementById('todayDeliveryCount').textContent = data.stats.today_deliveries || 0;
                }
            })
            .catch(error => {
                console.error('Error loading stats:', error);
            });
        }

        // Mark delivery as completed
        function markDeliveryCompleted(customerId) {
            if (confirm('Mark this delivery as completed?')) {
                fetch('/driver/complete-delivery', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    },
                    body: JSON.stringify({
                        customer_id: customerId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast('Delivery marked as completed!', 'success');
                        loadAssignedDeliveries();
                        loadDriverStats();
                    } else {
                        showToast(data.message || 'Failed to update delivery status', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Error updating delivery status', 'error');
                });
            }
        }

        // Call customer
        function callCustomer(phoneNumber) {
            if (phoneNumber && phoneNumber !== 'N/A') {
                window.location.href = `tel:${phoneNumber}`;
            } else {
                showToast('Phone number not available', 'error');
            }
        }

        // Refresh functions
        function refreshAssignedDeliveries() {
            showToast('Refreshing deliveries...', 'info');
            loadAssignedDeliveries();
        }

        function refreshDeliveryHistory() {
            showToast('Refreshing history...', 'info');
            loadDeliveryHistory();
        }

        // Load delivery history
        function loadDeliveryHistory() {
            fetch('/driver/delivery-history', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    deliveryHistory = data.history;
                    updateDeliveryHistoryTable(data.history);
                } else {
                    showToast('Failed to load delivery history', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error loading delivery history', 'error');
            });
        }

        // Update delivery history table
        function updateDeliveryHistoryTable(history) {
            const tableBody = document.getElementById('deliveryHistoryTableBody');
            
            if (history.length === 0) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px; color: #666;">
                            <div style="font-size: 48px; margin-bottom: 20px;">📋</div>
                            <p>No delivery history yet.</p>
                        </td>
                    </tr>
                `;
                return;
            }

            let html = '';
            history.forEach(delivery => {
                const deliveryDate = new Date(delivery.completed_at).toLocaleDateString();
                const customer = delivery.customer;
                
                html += `
                    <tr style="border-bottom: 1px solid #e9ecef;">
                        <td style="padding: 15px;">${deliveryDate}</td>
                        <td style="padding: 15px; font-weight: 600;">${customer.full_name}</td>
                        <td style="padding: 15px; max-width: 200px;" title="${customer.full_address}">${customer.full_address ? (customer.full_address.length > 50 ? customer.full_address.substring(0, 50) + '...' : customer.full_address) : 'N/A'}</td>
                        <td style="padding: 15px; text-align: center;">${delivery.bottles_delivered || 'N/A'}</td>
                        <td style="padding: 15px; text-align: center;">${getStatusBadge('completed')}</td>
                        <td style="padding: 15px; text-align: center;">
                            <button onclick="viewDeliveryDetails('${delivery.id}')" 
                                    style="background: #2196f3; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 12px;">
                                👁️ View
                            </button>
                        </td>
                    </tr>
                `;
            });
            
            tableBody.innerHTML = html;
        }

        // Modal functions
        function showModal(title, content) {
            document.getElementById('modal-title').textContent = title;
            document.getElementById('modal-body').innerHTML = content;
            document.getElementById('modal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('modal').style.display = 'none';
        }

        // Toast notification
        function showToast(message, type = 'info') {
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toast-message');
            
            toastMessage.textContent = message;
            toast.className = `toast ${type}`;
            toast.style.display = 'block';
            
            setTimeout(() => {
                toast.style.display = 'none';
            }, 3000);
        }

        // Logout function
        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                fetch('/driver/logout', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    }
                })
                .then(response => response.json())
                .then(data => {
                    showToast('Logged out successfully', 'success');
                    setTimeout(() => {
                        window.location.href = '/';
                    }, 1000);
                })
                .catch(error => {
                    console.error('Error:', error);
                    window.location.href = '/';
                });
            }
        }

        // Mobile menu toggle
        function toggleMobileMenu() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('mobile-active');
        }

        // Close modal when clicking outside
        document.getElementById('modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Placeholder functions for other features
        function filterDeliveries() {
            const filter = document.getElementById('deliveryStatusFilter').value;
            // Filter logic would go here
        }

        function markAllCompleted() {
            if (confirm('Mark all pending deliveries as completed?')) {
                // Bulk update logic would go here
            }
        }

        function exportDeliveryHistory() {
            showToast('Export feature coming soon!', 'info');
        }

        function filterDeliveryHistory() {
            showToast('Filtering history...', 'info');
        }

        function viewDeliveryDetails(deliveryId) {
            showToast('Delivery details feature coming soon!', 'info');
        }

        function showNotifications() {
            showModal('Notifications', '<p>No new notifications</p>');
        }
    </script>
</body>
</html>
