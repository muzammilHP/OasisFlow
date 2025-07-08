<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OASISFLOW - Driver Dashboard</title>
    @vite(['resources/css/driver-panel.css', 'resources/js/app.js'])
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
                    <div class="user-avatar">AH</div>
                    <div>
                        <div style="font-weight: 600;">Ahmed Hassan</div>
                        <div style="font-size: 12px; color: #666;">Premium Customer</div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="content-area">
                <!-- Dashboard Page -->
                <div class="page-section active" id="dashboard">
                    <!-- Personalized Welcome Section -->
                    <div style="background: linear-gradient(135deg, #0277bd, #0288d1); color: white; padding: 30px; border-radius: 20px; margin-bottom: 30px; position: relative; overflow: hidden;">
                        <div style="position: absolute; top: -20px; right: -20px; opacity: 0.1; font-size: 120px;">💧</div>
                        <div style="position: relative; z-index: 2;">
                            <h2 style="margin: 0 0 10px 0; font-size: 28px;">Good morning, Ahmed! 🌅</h2>
                            <p style="margin: 0 0 20px 0; font-size: 16px; opacity: 0.9;">Welcome back to your hydration dashboard. Stay refreshed, stay healthy!</p>
                            <div style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                                <button class="btn" style="background: rgba(255,255,255,0.2); color: white; border: 2px solid rgba(255,255,255,0.3); padding: 12px 25px; font-size: 16px; font-weight: 600;" onclick="showQuickOrder()">
                                    💧 Order Now
                                </button>
                                <div style="font-size: 14px; opacity: 0.8;">
                                    ⏰ Next scheduled delivery: <strong>June 25, 2024</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Grid -->
                    <div class="stats-grid" style="margin-bottom: 30px;">
                        <div class="stat-card" style="background: linear-gradient(135deg, #4caf50, #66bb6a); color: white;">
                            <h3>Total Orders</h3>
                            <div class="value">247</div>
                            <div class="change" style="color: rgba(255,255,255,0.8);">+12 this month</div>
                        </div>
                        <div class="stat-card" style="background: linear-gradient(135deg, #ff9800, #ffb74d); color: white;">
                            <h3>Water Bottles Delivered</h3>
                            <div class="value">1,235</div>
                            <div class="change" style="color: rgba(255,255,255,0.8);">+45 this month</div>
                        </div>
                        <div class="stat-card" style="background: linear-gradient(135deg, #9c27b0, #ba68c8); color: white;">
                            <h3>Active Coupons</h3>
                            <div class="value">8</div>
                            <div class="change" style="color: rgba(255,255,255,0.8);">2 expiring soon</div>
                        </div>
                        <div class="stat-card" style="background: linear-gradient(135deg, #f44336, #ef5350); color: white;">
                            <h3>Total Savings</h3>
                            <div class="value">AED 892</div>
                            <div class="change" style="color: rgba(255,255,255,0.8);">+AED 67 this month</div>
                        </div>
                    </div>

                    <!-- Recent Orders with Live Status -->
                    <div style="background: white; padding: 25px; border-radius: 20px; margin-bottom: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                            <h3 style="margin: 0; color: #333; font-size: 22px;">📦 Recent Orders</h3>
                            <button class="btn btn-primary" onclick="showPage('orders')" style="font-size: 14px;">View All Orders</button>
                        </div>
                        
                        <!-- Live Order Status Cards -->
                        <div style="display: grid; gap: 15px;">
                            <!-- Order 1 - In Transit -->
                            <div style="border: 2px solid #e3f2fd; border-radius: 15px; padding: 20px; background: linear-gradient(135deg, #e3f2fd, #f8f9ff);">
                                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                                    <div style="flex: 1; min-width: 200px;">
                                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                                            <div style="background: #2196f3; color: white; padding: 4px 8px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                                #OF2024002
                                            </div>
                                            <div style="display: flex; align-items: center; gap: 5px;">
                                                <div style="width: 8px; height: 8px; background: #4caf50; border-radius: 50%; animation: pulse 2s infinite;"></div>
                                                <span style="color: #4caf50; font-weight: 600; font-size: 14px;">Live Tracking</span>
                                            </div>
                                        </div>
                                        <div style="font-size: 16px; font-weight: 600; color: #333; margin-bottom: 5px;">6 Water Bottles - AED 72</div>
                                        <div style="font-size: 14px; color: #666;">Ordered: June 18, 2024</div>
                                    </div>
                                    <div style="text-align: center; min-width: 120px;">
                                        <div style="background: #4caf50; color: white; padding: 8px 16px; border-radius: 25px; font-weight: 600; margin-bottom: 10px;">
                                            🚚 In Transit
                                        </div>
                                        <div style="font-size: 12px; color: #666;">ETA: 2:30 PM</div>
                                        <div style="font-size: 12px; color: #4caf50; font-weight: 600;">Driver: Ali Mohammed</div>
                                    </div>
                                    <div style="display: flex; gap: 10px;">
                                        <button class="btn btn-secondary" onclick="trackOrder('#OF2024002')" style="font-size: 14px;">📍 Track</button>
                                        <button class="btn btn-primary" onclick="callDriver()" style="font-size: 14px;">📞 Call</button>
                                    </div>
                                </div>
                                <!-- Progress Bar -->
                                <div style="margin-top: 15px;">
                                    <div style="display: flex; justify-content: space-between; font-size: 12px; color: #666; margin-bottom: 5px;">
                                        <span>Order Confirmed</span>
                                        <span>Prepared</span>
                                        <span>In Transit</span>
                                        <span>Delivered</span>
                                    </div>
                                    <div style="background: #e0e0e0; height: 6px; border-radius: 3px; overflow: hidden;">
                                        <div style="background: linear-gradient(90deg, #4caf50, #66bb6a); height: 100%; width: 75%; border-radius: 3px; animation: progressPulse 2s ease-in-out infinite;"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Order 2 - Delivered -->
                            <div style="border: 2px solid #e8f5e8; border-radius: 15px; padding: 20px; background: linear-gradient(135deg, #e8f5e8, #f1f8e9);">
                                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                                    <div style="flex: 1; min-width: 200px;">
                                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                                            <div style="background: #4caf50; color: white; padding: 4px 8px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                                #OF2024001
                                            </div>
                                            <div style="color: #4caf50; font-size: 12px;">✅ Recently Delivered</div>
                                        </div>
                                        <div style="font-size: 16px; font-weight: 600; color: #333; margin-bottom: 5px;">4 Water Bottles - AED 48</div>
                                        <div style="font-size: 14px; color: #666;">Delivered: June 15, 2024 at 3:45 PM</div>
                                    </div>
                                    <div style="text-align: center; min-width: 120px;">
                                        <div style="background: #4caf50; color: white; padding: 8px 16px; border-radius: 25px; font-weight: 600; margin-bottom: 10px;">
                                            ✅ Delivered
                                        </div>
                                        <div style="font-size: 12px; color: #4caf50; font-weight: 600;">Rating: ⭐⭐⭐⭐⭐</div>
                                    </div>
                                    <div style="display: flex; gap: 10px;">
                                        <button class="btn btn-secondary" onclick="reorder('#OF2024001')" style="font-size: 14px;">🔄 Reorder</button>
                                        <button class="btn btn-primary" onclick="rateOrder('#OF2024001')" style="font-size: 14px;">⭐ Rate</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Order 3 - Preparing -->
                            <div style="border: 2px solid #fff3e0; border-radius: 15px; padding: 20px; background: linear-gradient(135deg, #fff3e0, #fef7e0);">
                                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                                    <div style="flex: 1; min-width: 200px;">
                                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                                            <div style="background: #ff9800; color: white; padding: 4px 8px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                                #OF2024003
                                            </div>
                                            <div style="display: flex; align-items: center; gap: 5px;">
                                                <div style="width: 8px; height: 8px; background: #ff9800; border-radius: 50%; animation: pulse 2s infinite;"></div>
                                                <span style="color: #ff9800; font-weight: 600; font-size: 14px;">Processing</span>
                                            </div>
                                        </div>
                                        <div style="font-size: 16px; font-weight: 600; color: #333; margin-bottom: 5px;">8 Water Bottles - AED 96</div>
                                        <div style="font-size: 14px; color: #666;">Ordered: Today at 10:30 AM</div>
                                    </div>
                                    <div style="text-align: center; min-width: 120px;">
                                        <div style="background: #ff9800; color: white; padding: 8px 16px; border-radius: 25px; font-weight: 600; margin-bottom: 10px;">
                                            🔄 Preparing
                                        </div>
                                        <div style="font-size: 12px; color: #666;">Est. Delivery: Tomorrow</div>
                                    </div>
                                    <div style="display: flex; gap: 10px;">
                                        <button class="btn btn-secondary" onclick="modifyOrder('#OF2024003')" style="font-size: 14px;">✏️ Modify</button>
                                        <button class="btn" style="background: #ffecb3; color: #f57c00; font-size: 14px;" onclick="cancelOrder('#OF2024003')">❌ Cancel</button>
                                    </div>
                                </div>
                                <!-- Progress Bar -->
                                <div style="margin-top: 15px;">
                                    <div style="display: flex; justify-content: space-between; font-size: 12px; color: #666; margin-bottom: 5px;">
                                        <span>Order Confirmed</span>
                                        <span>Preparing</span>
                                        <span>Ready</span>
                                        <span>Delivered</span>
                                    </div>
                                    <div style="background: #e0e0e0; height: 6px; border-radius: 3px; overflow: hidden;">
                                        <div style="background: linear-gradient(90deg, #ff9800, #ffb74d); height: 100%; width: 50%; border-radius: 3px; animation: progressPulse 2s ease-in-out infinite;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <h3 style="margin-bottom: 20px; color: #333; font-size: 22px;">⚡ Quick Actions</h3>
                    <div class="quick-actions">
                        <div class="action-card" onclick="showQuickOrder()" style="background: linear-gradient(135deg, #2196f3, #42a5f5); color: white; transform: scale(1.02); box-shadow: 0 8px 25px rgba(33, 150, 243, 0.3);">
                            <h3>💧 Order Now</h3>
                            <p>Quick order your usual bottles</p>
                            <div style="margin-top: 15px; font-size: 12px; opacity: 0.9;">⚡ Same-day delivery available</div>
                        </div>
                        <div class="action-card" onclick="showPage('deals')" style="background: linear-gradient(135deg, #4caf50, #66bb6a); color: white;">
                            <h3>🏷️ View Deals</h3>
                            <p>Check latest offers and discounts</p>
                            <div style="margin-top: 15px; font-size: 12px; opacity: 0.9;">💰 Save up to 30%</div>
                        </div>
                        <div class="action-card" onclick="showPage('emergency')" style="background: linear-gradient(135deg, #ff5722, #ff7043); color: white;">
                            <h3>🚨 Emergency Order</h3>
                            <p>Same-day delivery available</p>
                            <div style="margin-top: 15px; font-size: 12px; opacity: 0.9;">🚀 Within 2 hours</div>
                        </div>
                        <div class="action-card" onclick="trackDelivery()" style="background: linear-gradient(135deg, #9c27b0, #ba68c8); color: white;">
                            <h3>🚚 Track Delivery</h3>
                            <p>Monitor your current order</p>
                            <div style="margin-top: 15px; font-size: 12px; opacity: 0.9;">📍 Live GPS tracking</div>
                        </div>
                    </div>
                </div>

                <!-- Order Now Page -->
                <div class="page-section" id="order-now">
                    <section class="coupons-section">
                <h1>Coupons</h1>
                <p>Save more with our coupon books! Enjoy bigger savings on larger packages.</p>
                <div class="coupons-container">
                    <div class="coupon-card">
                        <img src="{{ asset('images/coupon3.webp') }}" alt="Coupon Book" class="coupon-image">
                        <div class="coupon-info">
                            <h2>Coupon Book CB-11</h2>
                            <p>Get 11 coupons for AED 250. Each coupon is worth AED 25.</p>
                            <p class="coupon-last-p">Can be redeemed for 5-gallon bottles.</p>
                        </div>
                        <button class="coupon-button" onclick="window.open('https://wa.me/971566660755','_blank')">Order Now</button>
                    </div>
                    <div class="coupon-card">
                        <img src="{{ asset('images/coupon4.webp') }}" alt="Coupon Book" class="coupon-image">
                        <div class="coupon-info">
                            <h2>Coupon Book CB-28</h2>
                            <p>Get 28 coupons for AED 600. Each coupon is worth AED 25.</p>
                            <p class="coupon-last-p">Can be redeemed for 5-gallon bottles.</p>
                        </div>
                        <button class="coupon-button" onclick="window.open('https://wa.me/971566660755','_blank')">Order Now</button>
                    </div>
                    <div class="coupon-card">
                        <img src="{{ asset('images/coupon5.webp') }}" alt="Coupon Book" class="coupon-image">
                        <div class="coupon-info">
                            <h2>Coupon Book CB-58</h2>
                            <p>Get 58 coupons for AED 1,200. Each coupon is worth AED 25.</p>
                            <p class="coupon-last-p">Can be redeemed for 5-gallon bottles.</p>
                        </div>
                        <button class="coupon-button" onclick="window.open('https://wa.me/971566660755','_blank')">Order Now</button>
                    </div>

                    <h1>Special Offers</h1>

                    <div class="coupon-card second-last-coupon">
                        <img src="{{ asset('images/coupon1.webp') }}" alt="Coupon Book" class="coupon-image">
                        <div class="coupon-info">
                            <h2>Coupon Book CB-75 with free Dispenser(For Lifetime)</h2>
                            <p>Get 75 coupons for AED 590.</p>
                            <p class="coupon-last-p">Can be redeemed for 5-gallon bottles.</p>
                        </div>
                        <button class="coupon-button" onclick="window.open('https://wa.me/971566660755','_blank')">Order Now</button>
                    </div>
                                        <div class="coupon-card last-coupon">
                        <img src="{{ asset('images/coupon2.webp') }}" alt="Coupon Book" class="coupon-image">
                        <div class="coupon-info">
                            <h2>Coupon Book CB-75 and Free Dispenser(Returnable after Stopping Service)</h2>
                            <p>Get 75 coupons for AED 490.</p>
                            <p class="coupon-last-p">Can be redeemed for 5-gallon bottles.</p>
                        </div>
                        <button class="coupon-button" onclick="window.open('https://wa.me/971566660755','_blank')">Order Now</button>
                    </div>
                </div>
            </section>
                </div>

                <!-- Deals Page -->
                <div class="page-section" id="deals">
                    <h3 style="margin-bottom: 20px;">Current Deals & Offers</h3>
                    
                    <div class="stats-grid">
                        <div class="action-card" style="background: linear-gradient(135deg, #ff6b6b, #ffa726);">
                            <h3>🔥 Flash Sale</h3>
                            <p>25% OFF on orders above AED 100</p>
                            <div style="margin-top: 15px;">
                                <button class="btn" style="background: white; color: #ff6b6b;">Grab Now</button>
                            </div>
                        </div>
                        
                        <div class="action-card" style="background: linear-gradient(135deg, #4caf50, #66bb6a);">
                            <h3>🎁 Bundle Deal</h3>
                            <p>Buy 10 bottles, get 2 FREE</p>
                            <div style="margin-top: 15px;">
                                <button class="btn" style="background: white; color: #4caf50;">Order Now</button>
                            </div>
                        </div>
                        
                        <div class="action-card" style="background: linear-gradient(135deg, #9c27b0, #ba68c8);">
                            <h3>⭐ Premium Deal</h3>
                            <p>Subscribe & save 30% monthly</p>
                            <div style="margin-top: 15px;">
                                <button class="btn" style="background: white; color: #9c27b0;">Subscribe</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- My Coupons Page -->
                <div class="page-section" id="coupons">
                    <h3 style="margin-bottom: 20px;">My Coupons</h3>
                    
                    <div class="coupon-card">
                        <h3>SUMMER25</h3>
                        <p>25% off on next order</p>
                        <div style="margin-top: 15px;">
                            <small>Valid until: June 30, 2024</small>
                            <button class="btn" style="background: white; color: #ff6b6b; margin-left: 15px;">Apply Now</button>
                        </div>
                    </div>
                    
                    <div class="coupon-card" style="background: linear-gradient(45deg, #4caf50, #66bb6a);">
                        <h3>LOYAL50</h3>
                        <p>AED 50 off on orders above AED 200</p>
                        <div style="margin-top: 15px;">
                            <small>Valid until: July 15, 2024</small>
                            <button class="btn" style="background: white; color: #4caf50; margin-left: 15px;">Apply Now</button>
                        </div>
                    </div>
                </div>

                <!-- Loyalty Program Page -->
                <div class="page-section" id="loyalty">
                    <div class="loyalty-card">
                        <h3 style="text-align: center;">🏆 Loyalty Points</h3>
                        <div class="loyalty-points">2,847</div>
                        <div style="text-align: center;">
                            <p>Next Reward: 153 points away</p>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 75%;"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="stats-grid">
                        <div class="stat-card">
                            <h3>Available Rewards</h3>
                            <div class="value">5</div>
                            <div class="change">2 new this week</div>
                        </div>
                        <div class="stat-card">
                            <h3>Points This Month</h3>
                            <div class="value">247</div>
                            <div class="change">+45 from last month</div>
                        </div>
                    </div>
                </div>

                <!-- Water Tracker Page -->
                <div class="page-section" id="water-tracker">
                    <h3 style="margin-bottom: 20px;">Water Consumption Tracker</h3>
                    
                    <div class="stats-grid">
                        <div class="stat-card" style="text-align: center;">
                            <h3>Current Stock</h3>
                            <div class="water-level">
                                <div class="water-fill" style="height: 60%;"></div>
                            </div>
                            <div class="value">3 Bottles</div>
                            <button class="btn btn-primary" onclick="updateStock()">Update Stock</button>
                        </div>
                        
                        <div class="stat-card">
                            <h3>Monthly Consumption</h3>
                            <div class="value">18 Bottles</div>
                            <div class="change">+2 from last month</div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 85%;"></div>
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <h3>Next Delivery</h3>
                            <div class="value">June 25</div>
                            <div class="change">In 3 days</div>
                            <button class="btn btn-secondary" onclick="rescheduleDelivery()">Reschedule</button>
                        </div>
                    </div>
                </div>

                <!-- Emergency Water Page -->
                <div class="page-section" id="emergency">
                    <div style="background: linear-gradient(135deg, #ff5722, #ff7043); color: white; padding: 25px; border-radius: 15px; margin-bottom: 30px; text-align: center;">
                        <h3>🚨 Emergency Water Delivery</h3>
                        <p>Same-day delivery within 2 hours</p>
                    </div>
                    
                    <div class="form-group">
                        <label>Number of 5-Gallon Bottles</label>
                        <select>
                            <option>1 Bottle - AED 15 (+ AED 10 urgent fee)</option>
                            <option>2 Bottles - AED 30 (+ AED 15 urgent fee)</option>
                            <option>3 Bottles - AED 45 (+ AED 20 urgent fee)</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Preferred Delivery Time</label>
                        <select>
                            <option>ASAP (within 2 hours)</option>
                            <option>Morning (8 AM - 12 PM)</option>
                            <option>Afternoon (12 PM - 6 PM)</option>
                            <option>Evening (6 PM - 9 PM)</option>
                        </select>
                    </div>
                    
                    <button class="btn btn-danger" style="width: 100%; font-size: 16px; padding: 15px;" onclick="placeEmergencyOrder()">
                        🚨 Place Emergency Order
                    </button>
                </div>

                <!-- Refer & Earn Page -->
                <div class="page-section" id="referral">
                    <div style="background: linear-gradient(135deg, #673ab7, #9c27b0); color: white; padding: 25px; border-radius: 15px; margin-bottom: 30px; text-align: center;">
                        <h3>👥 Refer Friends & Earn</h3>
                        <p>Get AED 25 for each successful referral</p>
                    </div>
                    
                    <div class="stats-grid">
                        <div class="stat-card">
                            <h3>Total Referrals</h3>
                            <div class="value">12</div>
                            <div class="change">+3 this month</div>
                        </div>
                        <div class="stat-card">
                            <h3>Earnings</h3>
                            <div class="value">AED 300</div>
                            <div class="change">+AED 75 this month</div>
                        </div>
                    </div>
                    
                    <div style="background: white; padding: 25px; border-radius: 15px; text-align: center;">
                        <h4>Your Referral Code</h4>
                        <div style="background: #f5f5f5; padding: 15px; border-radius: 10px; font-size: 24px; font-weight: bold; color: #0277bd; margin: 15px 0;">
                            AHMED2024
                        </div>
                        <button class="btn btn-primary" onclick="shareReferralCode()">Share Code</button>
                    </div>
                </div>

                <!-- Settings Page -->
                <div class="page-section" id="settings">
                    <h3 style="margin-bottom: 20px;">Account Settings</h3>
                    
                    <div style="background: white; padding: 25px; border-radius: 15px;">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" value="Ahmed Hassan" id="customerName">
                        </div>
                        
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" value="ahmed.hassan@email.com" id="customerEmail">
                        </div>
                        
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="tel" value="+971 50 123 4567" id="customerPhone">
                        </div>
                        
                        <div class="form-group">
                            <label>Delivery Address</label>
                            <textarea id="deliveryAddress" rows="3">Apartment 405, Marina Plaza, Al Reem Island, Abu Dhabi</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>Preferred Delivery Time</label>
                            <select id="preferredTime">
                                <option>Morning (8 AM - 12 PM)</option>
                                <option>Afternoon (12 PM - 6 PM)</option>
                                <option>Evening (6 PM - 9 PM)</option>
                            </select>
                        </div>
                        
                        <button class="btn btn-primary" onclick="saveSettings()">💾 Save Changes</button>
                    </div>
                </div>

                <!-- FAQs Page -->
                <div class="page-section" id="faqs">
                    <h3 style="margin-bottom: 20px;">Frequently Asked Questions</h3>
                    
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            How often should I order water bottles?
                            <span>▼</span>
                        </div>
                        <div class="faq-answer">
                            For a family of 4, we recommend ordering 8-10 bottles per month. This ensures fresh water supply and optimal hydration for your family.
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            What are your delivery hours?
                            <span>▼</span>
                        </div>
                        <div class="faq-answer">
                            We deliver from 8 AM to 9 PM, Sunday to Thursday. Friday and Saturday deliveries are available from 10 AM to 8 PM.
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            How do I return empty bottles?
                            <span>▼</span>
                        </div>
                        <div class="faq-answer">
                            Our delivery team will collect empty bottles during your next delivery. We provide AED 2 credit for each returned bottle.
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            Can I change my delivery schedule?
                            <span>▼</span>
                        </div>
                        <div class="faq-answer">
                            Yes, you can modify your delivery schedule anytime through your dashboard or by calling our customer service.
                        </div>
                    </div>
                </div>

                <!-- My Queries Page -->
                <div class="page-section" id="queries">
                    <h3 style="margin-bottom: 20px;">My Queries</h3>
                    
                    <div style="background: white; padding: 25px; border-radius: 15px; margin-bottom: 20px;">
                        <h4>Submit New Query</h4>
                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" placeholder="Enter query subject" id="querySubject">
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea rows="4" placeholder="Describe your query in detail" id="queryMessage"></textarea>
                        </div>
                        <button class="btn btn-primary" onclick="submitQuery()">Submit Query</button>
                    </div>
                    
                    <h4>Previous Queries</h4>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Query ID</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Response</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#Q001</td>
                                <td>Delivery Schedule Change</td>
                                <td>2024-06-10</td>
                                <td><span class="status-badge status-delivered">Resolved</span></td>
                                <td>Schedule updated successfully</td>
                            </tr>
                            <tr>
                                <td>#Q002</td>
                                <td>Water Quality Question</td>
                                <td>2024-06-15</td>
                                <td><span class="status-badge status-pending">In Progress</span></td>
                                <td>Under review</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Support Page -->
                <div class="page-section" id="support">
                    <h3 style="margin-bottom: 20px;">Customer Support</h3>
                    
                    <div class="stats-grid">
                        <div class="action-card" onclick="startLiveChat()">
                            <h3>💬 Live Chat</h3>
                            <p>Chat with our support team</p>
                            <small>Available 24/7</small>
                        </div>
                        
                        <div class="action-card" onclick="callSupport()">
                            <h3>📞 Call Support</h3>
                            <p>+971 2 123 4567</p>
                            <small>8 AM - 10 PM daily</small>
                        </div>
                        
                        <div class="action-card" onclick="emailSupport()">
                            <h3>📧 Email Support</h3>
                            <p>support@oasisflow.ae</p>
                            <small>Response within 2 hours</small>
                        </div>
                        
                        <div class="action-card" onclick="scheduleCallback()">
                            <h3>📅 Schedule Callback</h3>
                            <p>Request a callback</p>
                            <small>Choose your time</small>
                        </div>
                    </div>
                    
                    <div style="background: white; padding: 25px; border-radius: 15px; margin-top: 20px;">
                        <h4>Quick Help</h4>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-top: 15px;">
                            <button class="btn btn-secondary" onclick="showTrackingHelp()">🚚 Track My Order</button>
                            <button class="btn btn-secondary" onclick="showPaymentHelp()">💳 Payment Issues</button>
                            <button class="btn btn-secondary" onclick="showDeliveryHelp()">📦 Delivery Problems</button>
                            <button class="btn btn-secondary" onclick="showAccountHelp()">👤 Account Help</button>
                        </div>
                    </div>
                </div>

                <!-- My Complaints Page -->
                <div class="page-section" id="complaints">
                    <h3 style="margin-bottom: 20px;">My Complaints</h3>
                    
                    <div style="background: white; padding: 25px; border-radius: 15px; margin-bottom: 20px;">
                        <h4>File New Complaint</h4>
                        <div class="form-group">
                            <label>Complaint Type</label>
                            <select id="complaintType">
                                <option>Delivery Issue</option>
                                <option>Water Quality</option>
                                <option>Customer Service</option>
                                <option>Billing Problem</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" placeholder="Brief description" id="complaintSubject">
                        </div>
                        <div class="form-group">
                            <label>Detailed Description</label>
                            <textarea rows="4" placeholder="Provide detailed information about your complaint" id="complaintDescription"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Priority</label>
                            <select id="complaintPriority">
                                <option>Low</option>
                                <option>Medium</option>
                                <option>High</option>
                                <option>Urgent</option>
                            </select>
                        </div>
                        <button class="btn btn-danger" onclick="submitComplaint()">Submit Complaint</button>
                    </div>
                    
                    <h4>Previous Complaints</h4>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Complaint ID</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Resolution</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#C001</td>
                                <td>Delivery Issue</td>
                                <td>2024-06-08</td>
                                <td>High</td>
                                <td><span class="status-badge status-delivered">Resolved</span></td>
                                <td>Compensated with free delivery</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Feedback Page -->
                <div class="page-section" id="feedback">
                    <h3 style="margin-bottom: 20px;">Customer Feedback</h3>
                    
                    <div style="background: white; padding: 25px; border-radius: 15px;">
                        <h4>Rate Our Service</h4>
                        
                        <div class="form-group">
                            <label>Overall Experience</label>
                            <div class="rating" id="overallRating">
                                <span class="star" data-rating="1">⭐</span>
                                <span class="star" data-rating="2">⭐</span>
                                <span class="star" data-rating="3">⭐</span>
                                <span class="star" data-rating="4">⭐</span>
                                <span class="star" data-rating="5">⭐</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Delivery Quality</label>
                            <div class="rating" id="deliveryRating">
                                <span class="star" data-rating="1">⭐</span>
                                <span class="star" data-rating="2">⭐</span>
                                <span class="star" data-rating="3">⭐</span>
                                <span class="star" data-rating="4">⭐</span>
                                <span class="star" data-rating="5">⭐</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Water Quality</label>
                            <div class="rating" id="waterRating">
                                <span class="star" data-rating="1">⭐</span>
                                <span class="star" data-rating="2">⭐</span>
                                <span class="star" data-rating="3">⭐</span>
                                <span class="star" data-rating="4">⭐</span>
                                <span class="star" data-rating="5">⭐</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Additional Comments</label>
                            <textarea rows="4" placeholder="Share your experience and suggestions" id="feedbackComments"></textarea>
                        </div>
                        
                        <button class="btn btn-primary" onclick="submitFeedback()">Submit Feedback</button>
                    </div>
                </div>

                <!-- Payments Page -->
                <div class="page-section" id="payments">
                    <h3 style="margin-bottom: 20px;">Payment History</h3>
                    
                    <div class="stats-grid">
                        <div class="stat-card">
                            <h3>Total Spent</h3>
                            <div class="value">AED 2,847</div>
                            <div class="change">This year</div>
                        </div>
                        <div class="stat-card">
                            <h3>Pending Payments</h3>
                            <div class="value">AED 72</div>
                            <div class="change">1 invoice due</div>
                        </div>
                        <div class="stat-card">
                            <h3>Saved via Coupons</h3>
                            <div class="value">AED 892</div>
                            <div class="change">31% savings</div>
                        </div>
                    </div>
                    
                    <h4>Payment Methods</h4>
                    <div style="background: white; padding: 20px; border-radius: 15px; margin-bottom: 20px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                            <div>
                                <strong>💳 **** **** **** 4567</strong>
                                <div style="font-size: 12px; color: #666;">Expires 12/25</div>
                            </div>
                            <span class="status-badge status-delivered">Primary</span>
                        </div>
                        <button class="btn btn-secondary">Add New Card</button>
                    </div>
                    
                    <h4>Recent Transactions</h4>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Order ID</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2024-06-15</td>
                                <td>#OF2024001</td>
                                <td>AED 48</td>
                                <td>Credit Card</td>
                                <td><span class="status-badge status-delivered">Paid</span></td>
                                <td><button class="btn btn-secondary">Receipt</button></td>
                            </tr>
                            <tr>
                                <td>2024-06-18</td>
                                <td>#OF2024002</td>
                                <td>AED 72</td>
                                <td>Credit Card</td>
                                <td><span class="status-badge status-pending">Pending</span></td>
                                <td><button class="btn btn-primary">Pay Now</button></td>
                            </tr>
                        </tbody>
                    </table>
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
            drawOrderChart();
            initializeRatings();
            startRealTimeUpdates();
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
            document.getElementById('modal-title').textContent = title;
            document.getElementById('modal-body').innerHTML = content;
            document.getElementById('modal').classList.add('show');
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
                showToast('Welcome back, Ahmed! You have 3 new notifications.', 'success');
            }, 1000);
        });
    </script>
</body>
</html>
