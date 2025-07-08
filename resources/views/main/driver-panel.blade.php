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
            max-width: calc(100vw - 280px); 
            overflow-x: auto;
        }

        .main-content.full-width {
            margin-left: 0;
            max-width: 100vw;
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            cursor: pointer;
            padding: 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
            width: 45px;
            height: 45px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .mobile-menu-btn:hover {
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
            transform: scale(1.05);
        }

        .mobile-menu-btn .hamburger-line {
            display: block;
            width: 20px;
            height: 2px;
            background: white;
            margin: 3px 0;
            transition: all 0.3s ease;
            transform-origin: center;
        }

        .mobile-menu-btn.active .hamburger-line:nth-child(1) {
            transform: rotate(45deg) translate(6px, 6px);
        }

        .mobile-menu-btn.active .hamburger-line:nth-child(2) {
            opacity: 0;
        }

        .mobile-menu-btn.active .hamburger-line:nth-child(3) {
            transform: rotate(-45deg) translate(6px, -6px);
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
            width: 100%;
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

        /* Table Styles - Clean and Fixed */
        .table-container {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
            overflow-y: hidden;
            max-width: 100%;
            max-height: 80vh;
            border: 1px solid #e9ecef;
            margin-bottom: 20px;
            position: relative;
            scrollbar-width: thin;
            scrollbar-color: #667eea #f7fafc;
        }

        .table-container::-webkit-scrollbar {
            height: 14px;
        }

        .table-container::-webkit-scrollbar-track {
            background: #f1f3f5;
            border-radius: 7px;
        }

        .table-container::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 7px;
            border: 2px solid #f1f3f5;
        }

        .table-container::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(45deg, #5a67d8, #6b46c1);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0;
            min-width: 1900px;
            font-size: 16px;
            table-layout: fixed;
            background: white;
        }

        /* Fixed column widths for all 10 columns - Much wider for better visibility */
        .data-table th:nth-child(1),
        .data-table td:nth-child(1) { width: 142px; min-width: 130px; } /* Customer ID */
        .data-table th:nth-child(2),
        .data-table td:nth-child(2) { width: 180px; min-width: 180px; } /* Customer Name */
        .data-table th:nth-child(3),
        .data-table td:nth-child(3) { width: 160px; min-width: 160px; } /* Phone Number */
        .data-table th:nth-child(4),
        .data-table td:nth-child(4) { width: 320px; min-width: 320px; } /* Delivery Address */
        .data-table th:nth-child(5),
        .data-table td:nth-child(5) { width: 140px; min-width: 140px; } /* Area */
        .data-table th:nth-child(6),
        .data-table td:nth-child(6) { width: 140px; min-width: 140px; } /* Delivery Day */
        .data-table th:nth-child(7),
        .data-table td:nth-child(7) { width: 120px; min-width: 120px; } /* Time */
        .data-table th:nth-child(8),
        .data-table td:nth-child(8) { width: 100px; min-width: 100px; } /* Bottles */
        .data-table th:nth-child(9),
        .data-table td:nth-child(9) { width: 170px; min-width: 170px; } /* Assigned Date */
        .data-table th:nth-child(10),
        .data-table td:nth-child(10) { width: 250px; min-width: 250px; } /* Actions - Much wider */

        .data-table th,
        .data-table td {
            padding: 18px 14px;
            text-align: left;
            border-bottom: 1px solid #e9ecef;
            border-right: 1px solid #e9ecef;
            vertical-align: middle;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.5;
        }

        /* Actions column - Fixed positioning */
        .data-table th:nth-child(10),
        .data-table td:nth-child(10) {
            position: sticky;
            right: 0;
            background: linear-gradient(135deg, #fff8e1 0%, #fff3c4 100%) !important;
            z-index: 20;
            box-shadow: -4px 0 12px rgba(0,0,0,0.15) !important;
            border-left: 3px solid #ff9800 !important;
            border-right: none;
        }

        .data-table th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            color: white !important;
            font-weight: 700;
            font-size: 15px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            white-space: nowrap;
            border-bottom: 3px solid #5a67d8 !important;
            position: sticky;
            top: 0;
            z-index: 15;
            height: 55px;
        }

        .data-table th:nth-child(10) {
            background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%) !important;
            color: white !important;
            font-weight: 800 !important;
            font-size: 15px;
            position: sticky;
            right: 0;
            z-index: 25;
            box-shadow: -4px 0 12px rgba(0,0,0,0.15) !important;
            border-left: 3px solid #ff9800 !important;
        }

        .data-table tbody tr {
            transition: all 0.3s ease;
        }

        .data-table tbody tr:hover {
            background: linear-gradient(135deg, #f8f9ff 0%, #f1f3ff 100%) !important;
        }

        .data-table tbody tr:hover td:nth-child(10) {
            background: linear-gradient(135deg, #fff3e0 0%, #ffe0b3 100%) !important;
        }

        .data-table td {
            color: #333;
            font-size: 15px;
            background: white;
        }

        /* Enhanced column-specific styling */
        .data-table .customer-id {
            font-weight: 700;
            color: #667eea !important;
            font-size: 16px;
            font-family: 'Courier New', monospace;
        }

        .data-table .customer-name {
            font-weight: 600;
            color: #333 !important;
            font-size: 16px;
        }

        .data-table .phone-number {
            font-family: 'Courier New', monospace;
            color: #28a745 !important;
            font-size: 15px;
        }

        .data-table .address-cell {
            color: #555 !important;
            line-height: 1.4;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 14px;
        }

        .data-table .address-cell:hover {
            white-space: normal;
            word-wrap: break-word;
            background: #fff3cd !important;
            position: relative;
            z-index: 10;
        }

        .data-table .area-name {
            font-weight: 500;
            color: #6c757d !important;
            font-size: 15px;
        }

        .data-table .delivery-day {
            font-weight: 500;
            color: #495057 !important;
            font-size: 15px;
        }

        .data-table .delivery-time {
            font-family: 'Courier New', monospace;
            color: #17a2b8 !important;
            font-weight: 600;
            font-size: 15px;
        }

        .data-table .bottles-count {
            text-align: center;
            font-weight: 700;
            color: #fd7e14 !important;
            font-size: 17px;
        }

        .data-table .assigned-date {
            font-size: 14px;
            color: #6c757d !important;
            font-family: 'Courier New', monospace;
        }

        /* Action buttons - Enhanced styling */
        .action-buttons {
            display: flex;
            gap: 8px;
            justify-content: center;
            align-items: center;
            flex-wrap: nowrap;
            min-width: 220px;
            padding: 6px;
        }

        .action-btn {
            padding: 10px 14px !important;
            font-size: 12px !important;
            border-radius: 6px !important;
            font-weight: 600 !important;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            text-decoration: none !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 70px;
            white-space: nowrap;
            line-height: 1.2;
            height: 36px;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2) !important;
        }

        .btn-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
            color: white !important;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #218838 0%, #1ea080 100%) !important;
            box-shadow: 0 4px 12px rgba(40,167,69,0.4) !important;
        }

        .btn-info {
            background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%) !important;
            color: white !important;
        }

        .btn-info:hover {
            background: linear-gradient(135deg, #138496 0%, #5a32a3 100%) !important;
            box-shadow: 0 4px 12px rgba(23,162,184,0.4) !important;
        }

        .btn-primary {
            background: linear-gradient(135deg, #007bff 0%, #6610f2 100%) !important;
            color: white !important;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0056b3 0%, #520dc2 100%) !important;
            box-shadow: 0 4px 12px rgba(0,123,255,0.4) !important;
        }

        /* Enhanced status badges */
        .status-badge {
            padding: 6px 12px !important;
            border-radius: 20px !important;
            font-size: 11px !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            display: inline-block;
            min-width: 80px;
            text-align: center;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1) !important;
        }

        .status-active {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%) !important;
            color: #155724 !important;
            border: 1px solid #b8dabd;
        }

        .status-completed {
            background: linear-gradient(135deg, #cce5ff 0%, #b3d7ff 100%) !important;
            color: #004085 !important;
            border: 1px solid #9ec5fe;
        }

        .status-cancelled {
            background: linear-gradient(135deg, #f8d7da 0%, #f1aeb5 100%) !important;
            color: #721c24 !important;
            border: 1px solid #f1aeb5;
        }
        /* Loading Spinner */
        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 60px;
            background: linear-gradient(135deg, #f8f9ff 0%, #e3f2fd 100%);
            border-radius: 15px;
        }

        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #667eea;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            box-shadow: 0 4px 20px rgba(102, 126, 234, 0.2);
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

        /* Responsive table adjustments */
        @media (max-width: 1400px) {
            .data-table {
                min-width: 1000px;
            }
        }

        @media (max-width: 1200px) {
            .data-table {
                min-width: 1200px; /* Maintain minimum width for proper display */
            }
            
            .main-content {
                max-width: calc(100vw - 280px);
            }
        }

        @media (max-width: 900px) {
            .data-table {
                min-width: 800px;
            }
        }

        @media (max-width: 1024px) and (min-width: 769px) {
            /* Tablet styles */
            .sidebar {
                width: 250px;
            }

            .main-content {
                margin-left: 250px;
                max-width: calc(100vw - 250px);
            }

            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            }

            .data-table {
                min-width: 1000px;
                font-size: 14px;
            }

            .data-table th,
            .data-table td {
                padding: 12px 8px;
                font-size: 13px;
            }

            .action-btn {
                padding: 8px 12px !important;
                font-size: 11px !important;
            }
        }

        @media (max-width: 768px) {
            /* Show hamburger menu button */
            .mobile-menu-btn {
                display: flex !important;
            }

            /* Hide sidebar by default on mobile */
            .sidebar {
                transform: translateX(-100%);
                z-index: 1000;
                box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            /* Full width main content on mobile */
            .main-content {
                margin-left: 0;
                max-width: 100vw;
                padding: 15px;
                overflow-x: auto;
            }

            .main-content.full-width {
                margin-left: 0;
            }

            /* Mobile topbar adjustments */
            .topbar {
                padding: 12px 20px;
                margin-bottom: 15px;
            }

            .topbar h2 {
                font-size: 20px !important;
            }

            .user-profile {
                gap: 10px;
            }

            .user-avatar {
                width: 35px;
                height: 35px;
                font-size: 14px;
            }

            .logout-btn {
                padding: 6px 12px;
                font-size: 12px;
            }

            /* Content area mobile adjustments */
            .content-area {
                padding: 20px;
                border-radius: 10px;
            }

            /* Stats grid mobile responsive */
            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 15px;
                margin-bottom: 20px;
            }

            .stat-card {
                padding: 20px;
            }

            .stat-card .value {
                font-size: 28px;
            }

            /* Welcome section mobile */
            .welcome-section {
                padding: 20px;
                margin-bottom: 20px;
            }

            .welcome-section h2 {
                font-size: 22px;
            }

            .welcome-section p {
                font-size: 14px;
            }

            /* Mobile search section */
            .search-section-mobile {
                flex-direction: column;
                align-items: stretch !important;
                gap: 10px !important;
            }

            .search-section-mobile > div:first-child {
                min-width: auto !important;
            }

            .search-section-mobile .search-controls {
                flex-direction: column;
                gap: 10px !important;
            }

            #customerSearch {
                font-size: 16px; /* Prevent zoom on iOS */
            }

            #searchFilter {
                font-size: 16px;
                width: 100%;
            }

            /* Mobile table container */
            .table-container {
                padding: 15px;
                margin-bottom: 15px;
                border-radius: 10px;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            /* Mobile table styles */
            .data-table {
                min-width: 800px;
                font-size: 12px;
            }

            .data-table th,
            .data-table td {
                padding: 10px 6px;
                font-size: 11px;
            }

            .data-table th {
                font-size: 10px;
                height: 45px;
            }

            /* Mobile column widths */
            .data-table th:nth-child(1),
            .data-table td:nth-child(1) { width: 80px; min-width: 80px; }
            .data-table th:nth-child(2),
            .data-table td:nth-child(2) { width: 120px; min-width: 120px; }
            .data-table th:nth-child(3),
            .data-table td:nth-child(3) { width: 120px; min-width: 120px; }
            .data-table th:nth-child(4),
            .data-table td:nth-child(4) { width: 200px; min-width: 200px; }
            .data-table th:nth-child(5),
            .data-table td:nth-child(5) { width: 80px; min-width: 80px; }
            .data-table th:nth-child(6),
            .data-table td:nth-child(6) { width: 80px; min-width: 80px; }
            .data-table th:nth-child(7),
            .data-table td:nth-child(7) { width: 70px; min-width: 70px; }
            .data-table th:nth-child(8),
            .data-table td:nth-child(8) { width: 60px; min-width: 60px; }
            .data-table th:nth-child(9),
            .data-table td:nth-child(9) { width: 100px; min-width: 100px; }
            .data-table th:nth-child(10),
            .data-table td:nth-child(10) { width: 140px; min-width: 140px; }

            /* Mobile action buttons */
            .action-buttons {
                gap: 4px;
                min-width: 130px;
                padding: 2px;
            }

            .action-btn {
                padding: 6px 8px !important;
                font-size: 9px !important;
                min-width: 50px;
                height: 28px;
                border-radius: 4px !important;
            }

            /* Mobile delivery counters */
            .delivery-counters-mobile {
                flex-direction: column !important;
                gap: 10px !important;
                align-items: stretch !important;
            }

            .delivery-counters-mobile > div {
                justify-content: space-between !important;
                padding: 8px 12px;
                background: #f8f9fa;
                border-radius: 6px;
            }

            /* Mobile page headers */
            .page-header-mobile {
                flex-direction: column !important;
                align-items: stretch !important;
                gap: 15px !important;
                margin-bottom: 20px !important;
            }

            .page-header-mobile h2 {
                font-size: 22px !important;
                margin: 0 !important;
            }

            .page-header-mobile .header-buttons {
                display: flex;
                gap: 8px;
                flex-wrap: wrap;
            }

            .page-header-mobile .header-buttons button {
                flex: 1;
                min-width: 120px;
                padding: 10px 15px !important;
                font-size: 13px !important;
            }

            /* Mobile settings page */
            .settings-grid-mobile {
                grid-template-columns: 1fr !important;
                gap: 15px !important;
            }

            .settings-actions-mobile {
                flex-direction: column !important;
                gap: 10px !important;
            }

            .settings-actions-mobile button {
                width: 100% !important;
                justify-content: center !important;
            }
        }

        @media (max-width: 480px) {
            /* Extra small devices */
            .topbar {
                padding: 10px 15px;
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
            }

            .topbar > div:first-child {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .user-profile {
                flex-direction: column;
                align-items: center;
                gap: 8px;
            }

            .content-area {
                padding: 15px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .welcome-section {
                padding: 15px;
            }

            .welcome-section h2 {
                font-size: 20px;
            }

            /* Ultra mobile table */
            .data-table {
                min-width: 600px;
                font-size: 10px;
            }

            .data-table th,
            .data-table td {
                padding: 8px 4px;
                font-size: 10px;
            }

            .action-btn {
                padding: 4px 6px !important;
                font-size: 8px !important;
                min-width: 40px;
                height: 24px;
            }

            /* Mobile search improvements */
            .search-section-mobile input {
                padding: 12px 15px;
                font-size: 16px;
            }

            .search-section-mobile select,
            .search-section-mobile button {
                padding: 12px 15px;
                font-size: 16px;
            }

            /* Delivery counters in single column */
            .delivery-counters-mobile {
                flex-direction: column !important;
                gap: 8px !important;
            }

            .delivery-counters-mobile > div {
                flex-direction: column !important;
                text-align: center !important;
                gap: 4px !important;
            }

            /* Header buttons stack vertically */
            .page-header-mobile .header-buttons {
                flex-direction: column;
            }

            .page-header-mobile .header-buttons button {
                width: 100%;
                min-width: auto;
            }

            /* Settings actions full width */
            .settings-actions-mobile {
                flex-direction: column !important;
            }

            .settings-actions-mobile button {
                width: 100% !important;
                margin-bottom: 8px;
            }

            /* Mobile profile adjustments */
            .user-profile {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                width: 100%;
            }

            .user-profile > div {
                display: none; /* Hide user info on very small screens */
            }

            .logout-btn {
                font-size: 11px;
                padding: 5px 10px;
            }
        }

        /* Mobile overlay for sidebar */
        .mobile-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            transition: opacity 0.3s ease;
            opacity: 0;
        }

        .mobile-overlay.show {
            opacity: 1;
        }

        @media (max-width: 768px) {
            .mobile-overlay.show {
                display: block;
            }
        }

        /* Improved sidebar transitions */
        .sidebar {
            transition: transform 0.3s cubic-bezier(0.4, 0.0, 0.2, 1);
        }

        /* Smooth scrolling for mobile */
        html {
            scroll-behavior: smooth;
        }

        /* Better mobile table scrolling */
        .table-container {
            scrollbar-width: thin;
            scrollbar-color: #667eea #f7fafc;
        }

        /* Mobile-first form elements */
        input, select, textarea {
            font-size: 16px !important; /* Prevent zoom on iOS */
        }

        /* Mobile-optimized buttons */
        @media (max-width: 768px) {
            .welcome-section button {
                width: 100% !important;
                text-align: center !important;
                padding: 15px !important;
                font-size: 16px !important;
            }
        }

        /* Touch-friendly improvements */
        @media (hover: none) and (pointer: coarse) {
            .nav-item {
                padding: 18px 20px;
                font-size: 17px;
            }

            .action-btn {
                min-height: 44px;
                min-width: 60px;
                padding: 12px 16px !important;
                font-size: 12px !important;
            }

            .logout-btn {
                min-height: 44px;
                padding: 12px 16px;
                font-size: 14px;
            }

            button {
                min-height: 44px;
                min-width: 44px;
            }

            /* Larger touch targets for mobile */
            .mobile-menu-btn {
                min-height: 50px;
                min-width: 50px;
            }

            /* Better spacing for mobile interactions */
            .topbar {
                min-height: 70px;
            }

            .user-profile {
                gap: 12px;
            }

            .user-avatar {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }
        }

        /* Search functionality styles */
        #customerSearch:focus {
            border-color: #667eea !important;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            outline: none;
        }

        #searchFilter:focus {
            border-color: #667eea !important;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            outline: none;
        }

        .search-highlight {
            background-color: #fff3cd !important;
            font-weight: bold;
            color: #856404 !important;
        }

        /* Performance optimizations */
        .data-table {
            will-change: transform;
        }

        .sidebar {
            will-change: transform;
        }

        .mobile-overlay {
            will-change: opacity;
        }

        /* Accessibility improvements */
        .mobile-menu-btn:focus {
            outline: 2px solid #fff;
            outline-offset: 2px;
        }

        .nav-item:focus {
            outline: 2px solid rgba(255, 255, 255, 0.5);
            outline-offset: 2px;
        }

        /* Screen reader text */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        /* High contrast mode support */
        @media (prefers-contrast: high) {
            .sidebar {
                background: #000;
                color: #fff;
            }

            .nav-item:hover {
                background: #333;
            }

            .data-table th {
                background: #000 !important;
                color: #fff !important;
            }
        }

        /* Reduced motion support */
        @media (prefers-reduced-motion: reduce) {
            .sidebar {
                transition: none;
            }

            .mobile-overlay {
                transition: none;
            }

            .hamburger-line {
                transition: none;
            }

            .nav-item {
                transition: none;
            }

            .action-btn {
                transition: none;
            }
        }

        /* Dark mode support - commented out to preserve original colors */
        /*
        @media (prefers-color-scheme: dark) {
            body {
                background: #1a1a1a;
                color: #e0e0e0;
            }

            .content-area {
                background: #2d2d2d;
                color: #e0e0e0;
            }

            .topbar {
                background: #2d2d2d;
                color: #e0e0e0;
            }

            .data-table td {
                background: #2d2d2d;
                color: #e0e0e0;
            }

            .table-container {
                background: #2d2d2d;
                border-color: #444;
            }
        }
        */
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Mobile Overlay -->
        <div class="mobile-overlay" id="mobileOverlay" onclick="closeMobileMenu()"></div>
        
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
                    <button class="mobile-menu-btn" onclick="toggleMobileMenu()" aria-label="Toggle mobile menu" aria-expanded="false">
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                        <span class="sr-only">Menu</span>
                    </button>
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
                        <div style="margin-top: 20px;">
                            <button onclick="showPage('assigned-deliveries')" style="background: rgba(255,255,255,0.2); color: white; border: 2px solid rgba(255,255,255,0.3); padding: 12px 25px; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer;">
                                📦 View My Deliveries
                            </button>
                        </div>
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

                    <!-- Quick Summary -->
                    <div style="background: white; padding: 25px; border-radius: 15px; margin-bottom: 20px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
                        <h3 style="margin: 0 0 20px 0; color: #333; font-size: 20px;">📋 Today's Summary</h3>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                            <div style="text-align: center; padding: 20px; background: #e8f5e8; border-radius: 10px;">
                                <div style="font-size: 24px; font-weight: bold; color: #28a745;" id="todayDeliveries">0</div>
                                <div style="color: #666; font-size: 14px;">Deliveries Today</div>
                            </div>
                            <div style="text-align: center; padding: 20px; background: #fff3cd; border-radius: 10px;">
                                <div style="font-size: 24px; font-weight: bold; color: #fd7e14;" id="pendingDeliveries">0</div>
                                <div style="color: #666; font-size: 14px;">Pending Deliveries</div>
                            </div>
                            <div style="text-align: center; padding: 20px; background: #d1ecf1; border-radius: 10px;">
                                <div style="font-size: 24px; font-weight: bold; color: #17a2b8;" id="totalBottles">0</div>
                                <div style="color: #666; font-size: 14px;">Total Bottles</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Assigned Deliveries Page -->
                <div class="page-section" id="assigned-deliveries">
                    <div class="page-header-mobile" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
                        <h2 style="margin: 0; color: #333; font-size: 28px;">📦 Assigned Deliveries</h2>
                        <div class="header-buttons" style="display: flex; gap: 10px;">
                            <button onclick="refreshDeliveries()" style="background: #28a745; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; font-size: 14px;">
                                🔄 Refresh
                            </button>
                            <button onclick="markAllCompleted()" style="background: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; font-size: 14px;">
                                ✅ Mark All Complete
                            </button>
                        </div>
                    </div>

                    <!-- Search and Filters -->
                    <div style="background: white; padding: 20px; border-radius: 15px; margin-bottom: 20px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
                        <!-- Search Section -->
                        <div style="margin-bottom: 20px;">
                            <h4 style="margin-bottom: 15px; color: #333; font-size: 16px;">🔍 Search Customers</h4>
                            <div class="search-section-mobile" style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
                                <div style="flex: 1; min-width: 300px;">
                                    <input type="text" id="customerSearch" placeholder="Search by name, phone, address, or customer ID..." 
                                           style="width: 100%; padding: 12px 16px; border: 2px solid #e9ecef; border-radius: 8px; font-size: 14px; transition: border-color 0.3s ease;"
                                           onkeyup="searchCustomers()" 
                                           onfocus="this.style.borderColor='#667eea'" 
                                           onblur="this.style.borderColor='#e9ecef'">
                                </div>
                                <div class="search-controls" style="display: flex; gap: 10px;">
                                    <select id="searchFilter" onchange="searchCustomers()" 
                                            style="padding: 12px 16px; border: 2px solid #e9ecef; border-radius: 8px; font-size: 14px; background: white; cursor: pointer;">
                                        <option value="all">All Fields</option>
                                        <option value="name">Name Only</option>
                                        <option value="phone">Phone Only</option>
                                        <option value="address">Address Only</option>
                                        <option value="area">Area Only</option>
                                        <option value="customer_id">Customer ID Only</option>
                                    </select>
                                    <button onclick="clearSearch()" 
                                            style="padding: 12px 16px; background: #6c757d; color: white; border: none; border-radius: 8px; cursor: pointer; font-size: 14px; font-weight: 600;">
                                        Clear
                                    </button>
                                </div>
                            </div>
                            <div id="searchResults" style="margin-top: 10px; font-size: 14px; color: #666; display: none;">
                                <!-- Search results info will be displayed here -->
                            </div>
                        </div>
                        
                        <!-- Delivery Counters -->
                        <div class="delivery-counters-mobile" style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap; padding-top: 15px; border-top: 1px solid #e9ecef;">
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <label style="font-weight: 600; color: #555;">📊 Total Assigned:</label>
                                <span id="assignedCount" style="background: #007bff; color: white; padding: 4px 12px; border-radius: 15px; font-weight: 600;">0</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <label style="font-weight: 600; color: #555;">✅ Completed:</label>
                                <span id="completedCount" style="background: #28a745; color: white; padding: 4px 12px; border-radius: 15px; font-weight: 600;">0</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <label style="font-weight: 600; color: #555;">⏳ Pending:</label>
                                <span id="pendingCount" style="background: #fd7e14; color: white; padding: 4px 12px; border-radius: 15px; font-weight: 600;">0</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <label style="font-weight: 600; color: #555;">🔍 Filtered:</label>
                                <span id="filteredCount" style="background: #17a2b8; color: white; padding: 4px 12px; border-radius: 15px; font-weight: 600;">0</span>
                            </div>
                        </div>
                    </div>

                    <div class="table-container">
                        <div class="loading" id="deliveriesLoading">
                            <div class="spinner"></div>
                        </div>
                        <table class="data-table" id="deliveriesTable" style="display: none;">
                            <thead>
                                <tr>
                                    <th>Customer ID</th>
                                    <th>Customer Name</th>
                                    <th>Phone Number</th>
                                    <th>Delivery Address</th>
                                    <th>Area</th>
                                    <th>Delivery Day</th>
                                    <th>Time</th>
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
                    <h2 style="margin-bottom: 30px; color: #333; font-size: 28px;">⚙️ Driver Settings</h2>
                    
                    <div style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); margin-bottom: 20px;">
                        <h3 style="margin-bottom: 20px; color: #333;">👤 Profile Information</h3>
                        <div id="driverProfile">
                            <div class="loading">
                                <div class="spinner"></div>
                            </div>
                        </div>
                    </div>

                    <div style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); margin-bottom: 20px;">
                        <h3 style="margin-bottom: 20px; color: #333;">📊 Performance Stats</h3>
                        <div class="settings-grid-mobile" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                            <div style="text-align: center; padding: 20px; background: #f8f9fa; border-radius: 10px;">
                                <div style="font-size: 24px; font-weight: bold; color: #007bff;" id="settingsTotalAssignments">0</div>
                                <div style="color: #666; font-size: 14px;">Total Assignments</div>
                            </div>
                            <div style="text-align: center; padding: 20px; background: #f8f9fa; border-radius: 10px;">
                                <div style="font-size: 24px; font-weight: bold; color: #28a745;" id="settingsCompletedDeliveries">0</div>
                                <div style="color: #666; font-size: 14px;">Completed Deliveries</div>
                            </div>
                            <div style="text-align: center; padding: 20px; background: #f8f9fa; border-radius: 10px;">
                                <div style="font-size: 24px; font-weight: bold; color: #ffc107;" id="settingsDriverRating">0.0</div>
                                <div style="color: #666; font-size: 14px;">Driver Rating</div>
                            </div>
                        </div>
                    </div>

                    <div style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                        <h3 style="margin-bottom: 20px; color: #333;">🔧 Actions</h3>
                        <div class="settings-actions-mobile" style="display: flex; gap: 15px; flex-wrap: wrap;">
                            <button onclick="refreshAllData()" style="background: #17a2b8; color: white; border: none; padding: 12px 24px; border-radius: 8px; cursor: pointer; font-size: 14px; font-weight: 600;">
                                🔄 Refresh All Data
                            </button>
                            <button onclick="exportDeliveryReport()" style="background: #6f42c1; color: white; border: none; padding: 12px 24px; border-radius: 8px; cursor: pointer; font-size: 14px; font-weight: 600;">
                                📄 Export Report
                            </button>
                            <button onclick="logout()" style="background: #dc3545; color: white; border: none; padding: 12px 24px; border-radius: 8px; cursor: pointer; font-size: 14px; font-weight: 600;">
                                🚪 Logout
                            </button>
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
                    
                    // Close mobile menu when navigation item is clicked
                    if (window.innerWidth <= 768) {
                        closeMobileMenu();
                    }
                });
            });

            // Mobile menu
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    closeMobileMenu();
                    // Reset hamburger menu state
                    const menuBtn = document.querySelector('.mobile-menu-btn');
                    if (menuBtn) {
                        menuBtn.classList.remove('active');
                    }
                }
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768) {
                    const sidebar = document.getElementById('sidebar');
                    const menuBtn = document.querySelector('.mobile-menu-btn');
                    
                    if (!sidebar.contains(event.target) && !menuBtn.contains(event.target)) {
                        if (sidebar.classList.contains('show')) {
                            closeMobileMenu();
                        }
                    }
                }
            });

            // Handle touch events for better mobile interaction
            let touchStartX = 0;
            let touchStartY = 0;
            
            document.addEventListener('touchstart', function(e) {
                touchStartX = e.touches[0].clientX;
                touchStartY = e.touches[0].clientY;
            });

            document.addEventListener('touchend', function(e) {
                if (window.innerWidth <= 768) {
                    const touchEndX = e.changedTouches[0].clientX;
                    const touchEndY = e.changedTouches[0].clientY;
                    const deltaX = touchEndX - touchStartX;
                    const deltaY = touchEndY - touchStartY;
                    
                    // Swipe right to open menu (from left edge)
                    if (deltaX > 50 && Math.abs(deltaY) < 100 && touchStartX < 20) {
                        openMobileMenu();
                    }
                    // Swipe left to close menu
                    else if (deltaX < -50 && Math.abs(deltaY) < 100 && document.getElementById('sidebar').classList.contains('show')) {
                        closeMobileMenu();
                    }
                }
            });

            // Prevent body scroll when mobile menu is open
            document.getElementById('sidebar').addEventListener('transitionend', function() {
                if (this.classList.contains('show')) {
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = '';
                }
            });

            // Handle keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && window.innerWidth <= 768) {
                    const sidebar = document.getElementById('sidebar');
                    if (sidebar.classList.contains('show')) {
                        closeMobileMenu();
                    }
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

            // Use filtered deliveries if search is active, otherwise use all deliveries
            const deliveriesToShow = isSearchActive ? filteredDeliveries : assignedDeliveries;

            if (deliveriesToShow.length === 0) {
                if (isSearchActive) {
                    tbody.innerHTML = '<tr><td colspan="10" style="text-align: center; padding: 40px; color: #666;"><div style="font-size: 48px; margin-bottom: 20px;">�</div><p>No customers found matching your search</p><p style="margin-top: 10px; color: #999;">Try adjusting your search terms or clear the search</p></td></tr>';
                } else {
                    tbody.innerHTML = '<tr><td colspan="10" style="text-align: center; padding: 40px; color: #666;"><div style="font-size: 48px; margin-bottom: 20px;">�📦</div><p>No assigned deliveries found</p></td></tr>';
                }
                updateDeliveryCounters(assignedDeliveries.length, 0, assignedDeliveries.length);
                return;
            }

            let totalBottles = 0;
            deliveriesToShow.forEach(delivery => {
                totalBottles += parseInt(delivery.bottles_required) || 0;
                
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="customer-id">${delivery.customer_id}</td>
                    <td class="customer-name">${delivery.customer_name}</td>
                    <td class="phone-number contact-info">
                        <a href="tel:${delivery.customer_phone}" style="color: #28a745; text-decoration: none;">
                            📞 ${delivery.customer_phone}
                        </a>
                    </td>
                    <td class="address-cell" title="${delivery.customer_address || 'N/A'}">
                        ${delivery.customer_address || 'N/A'}
                    </td>
                    <td class="area-name">${delivery.area_name || 'N/A'}</td>
                    <td class="delivery-day">${delivery.delivery_day || 'N/A'}</td>
                    <td class="delivery-time">${delivery.delivery_time || 'N/A'}</td>
                    <td class="bottles-count numeric-value">${delivery.bottles_required || 0}</td>
                    <td class="assigned-date">${formatDate(delivery.assigned_at)}</td>
                    <td class="actions-cell">
                        <div class="action-buttons">
                            <button class="action-btn btn-success" onclick="completeDelivery(${delivery.id})">
                                ✅ Complete
                            </button>
                            ${delivery.google_map_link ? `<a href="${delivery.google_map_link}" target="_blank" class="action-btn btn-info">📍 Map</a>` : ''}
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });

            // Update counters
            updateDeliveryCounters(assignedDeliveries.length, 0, assignedDeliveries.length);
            
            // Update total bottles
            document.getElementById('totalBottles').textContent = totalBottles;
            
            // Update filtered count
            updateFilteredCount(deliveriesToShow.length);
        }

        // Update delivery counters
        function updateDeliveryCounters(total, completed, pending) {
            document.getElementById('assignedCount').textContent = total;
            document.getElementById('completedCount').textContent = completed;
            document.getElementById('pendingCount').textContent = pending;
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
                tbody.innerHTML = '<tr><td colspan="9" style="text-align: center; padding: 40px; color: #666;"><div style="font-size: 48px; margin-bottom: 20px;">📋</div><p>No delivery history found</p></td></tr>';
                return;
            }

            deliveryHistory.forEach(delivery => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="customer-id">${delivery.customer_id}</td>
                    <td class="customer-name">${delivery.customer_name}</td>
                    <td class="phone-number contact-info">${delivery.customer_phone}</td>
                    <td class="address-cell" title="${delivery.customer_address}">${truncateText(delivery.customer_address, 30)}</td>
                    <td class="area-name">${delivery.area_name}</td>
                    <td class="assigned-date">${formatDate(delivery.assigned_at)}</td>
                    <td class="assigned-date">${formatDate(delivery.completed_at)}</td>
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
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px;">
                    <div>
                        <div style="margin-bottom: 15px;">
                            <strong style="color: #555;">👤 Full Name:</strong><br>
                            <span style="font-size: 18px; color: #333;">${driverData.name}</span>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <strong style="color: #555;">🆔 Driver ID:</strong><br>
                            <span style="font-family: monospace; background: #e9ecef; padding: 4px 8px; border-radius: 4px; color: #007bff;">${driverData.id}</span>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <strong style="color: #555;">📧 Email:</strong><br>
                            <a href="mailto:${driverData.email}" style="color: #007bff; text-decoration: none;">${driverData.email}</a>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <strong style="color: #555;">📱 Phone:</strong><br>
                            <a href="tel:${driverData.phone}" style="color: #28a745; text-decoration: none;">${driverData.phone}</a>
                        </div>
                    </div>
                    <div>
                        <div style="margin-bottom: 15px;">
                            <strong style="color: #555;">🏠 Address:</strong><br>
                            <span style="color: #333;">${driverData.address}</span>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <strong style="color: #555;">🚗 Vehicle Number:</strong><br>
                            <span style="font-family: monospace; background: #e9ecef; padding: 4px 8px; border-radius: 4px; color: #6c757d;">${driverData.vehicle_number || 'Not assigned'}</span>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <strong style="color: #555;">📊 Status:</strong><br>
                            <span style="color: #28a745; font-weight: 600; text-transform: capitalize;">${driverData.status}</span>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <strong style="color: #555;">📦 Total Deliveries:</strong><br>
                            <span style="font-size: 18px; font-weight: 600; color: #007bff;">${driverData.total_deliveries || 0}</span>
                        </div>
                    </div>
                </div>
            `;

            // Update performance stats in settings
            if (driverStats) {
                document.getElementById('settingsTotalAssignments').textContent = driverStats.total_assignments || 0;
                document.getElementById('settingsCompletedDeliveries').textContent = driverStats.completed_deliveries || 0;
                document.getElementById('settingsDriverRating').textContent = parseFloat(driverStats.driver_rating || 0).toFixed(1);
            }
        }

        // Search functionality variables
        let filteredDeliveries = [];
        let isSearchActive = false;

        // Search customers function
        function searchCustomers() {
            const searchTerm = document.getElementById('customerSearch').value.toLowerCase().trim();
            const searchFilter = document.getElementById('searchFilter').value;
            const searchResults = document.getElementById('searchResults');
            
            if (searchTerm === '') {
                // Clear search - show all deliveries
                filteredDeliveries = [];
                isSearchActive = false;
                searchResults.style.display = 'none';
                updateAssignedDeliveriesTable();
                updateFilteredCount(assignedDeliveries.length);
                return;
            }
            
            isSearchActive = true;
            filteredDeliveries = assignedDeliveries.filter(delivery => {
                const searchableFields = {
                    all: [
                        delivery.customer_id?.toString() || '',
                        delivery.customer_name?.toLowerCase() || '',
                        delivery.customer_phone || '',
                        delivery.customer_address?.toLowerCase() || '',
                        delivery.area_name?.toLowerCase() || ''
                    ],
                    name: [delivery.customer_name?.toLowerCase() || ''],
                    phone: [delivery.customer_phone || ''],
                    address: [delivery.customer_address?.toLowerCase() || ''],
                    area: [delivery.area_name?.toLowerCase() || ''],
                    customer_id: [delivery.customer_id?.toString() || '']
                };
                
                const fieldsToSearch = searchableFields[searchFilter] || searchableFields.all;
                return fieldsToSearch.some(field => field.includes(searchTerm));
            });
            
            // Update table with filtered results
            updateAssignedDeliveriesTable();
            updateFilteredCount(filteredDeliveries.length);
            
            // Show search results info
            searchResults.style.display = 'block';
            searchResults.innerHTML = `
                <div style="padding: 10px; background: #e3f2fd; border-radius: 6px; color: #0d47a1;">
                    <i style="margin-right: 8px;">🔍</i>
                    <strong>Search Results:</strong> Found ${filteredDeliveries.length} customers matching "${searchTerm}"
                    ${searchFilter !== 'all' ? ` in ${searchFilter}` : ''}
                </div>
            `;
        }

        // Clear search function
        function clearSearch() {
            document.getElementById('customerSearch').value = '';
            document.getElementById('searchFilter').value = 'all';
            document.getElementById('searchResults').style.display = 'none';
            filteredDeliveries = [];
            isSearchActive = false;
            updateAssignedDeliveriesTable();
            updateFilteredCount(assignedDeliveries.length);
        }

        // Update filtered count
        function updateFilteredCount(count) {
            document.getElementById('filteredCount').textContent = count;
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
            const overlay = document.getElementById('mobileOverlay');
            const menuBtn = document.querySelector('.mobile-menu-btn');
            
            if (sidebar.classList.contains('show')) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        }

        // Open mobile menu
        function openMobileMenu() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('mobileOverlay');
            const menuBtn = document.querySelector('.mobile-menu-btn');
            
            sidebar.classList.add('show');
            overlay.classList.add('show');
            menuBtn.classList.add('active');
            menuBtn.setAttribute('aria-expanded', 'true');
            document.body.style.overflow = 'hidden';
        }

        // Close mobile menu
        function closeMobileMenu() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('mobileOverlay');
            const menuBtn = document.querySelector('.mobile-menu-btn');
            
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
            menuBtn.classList.remove('active');
            menuBtn.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
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
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        function truncateText(text, maxLength) {
            if (!text) return 'N/A';
            return text.length > maxLength ? text.substring(0, maxLength) + '...' : text;
        }

        function showSuccess(message) {
            showToast(message, 'success');
        }

        function showError(message) {
            showToast(message, 'error');
        }

        function showToast(message, type = 'info') {
            // Create toast if it doesn't exist
            let toast = document.getElementById('toast');
            if (!toast) {
                toast = document.createElement('div');
                toast.id = 'toast';
                toast.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    padding: 15px 20px;
                    border-radius: 8px;
                    color: white;
                    font-weight: 600;
                    z-index: 10000;
                    display: none;
                    max-width: 300px;
                `;
                document.body.appendChild(toast);
            }

            // Set message and style based on type
            toast.textContent = message;
            
            const colors = {
                'success': '#28a745',
                'error': '#dc3545',
                'info': '#17a2b8',
                'warning': '#ffc107'
            };
            
            toast.style.backgroundColor = colors[type] || colors['info'];
            toast.style.display = 'block';
            
            // Auto hide after 3 seconds
            setTimeout(() => {
                toast.style.display = 'none';
            }, 3000);
        }

        // Refresh deliveries
        function refreshDeliveries() {
            showToast('Refreshing deliveries...', 'info');
            loadAssignedDeliveries();
            loadDriverStats();
        }

        // Mark all deliveries as completed
        function markAllCompleted() {
            if (assignedDeliveries.length === 0) {
                showToast('No deliveries to complete', 'warning');
                return;
            }

            if (confirm(`Are you sure you want to mark all ${assignedDeliveries.length} deliveries as completed?`)) {
                showToast('Feature coming soon: Bulk completion', 'info');
                // TODO: Implement bulk completion API
            }
        }
    </script>
</body>
</html>
