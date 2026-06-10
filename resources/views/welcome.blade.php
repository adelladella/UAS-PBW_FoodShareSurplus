<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>FoodShare - Distribusi Surplus Makanan</title>
  <meta name="description" content="Platform modern distribusi surplus makanan untuk mengurangi food waste demi aksi sosial kemanusiaan.">
  
  <!-- CSS Frameworks & Bootstrap Icons & Google Fonts -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
  
  <style>
    /* DESIGN SYSTEM & VARIABLES */
    :root {
      --bg: #FAF7EB;
      --bg-warm: #FFFDF6;
      --dark: #382615;
      --dark-muted: #6B523B;
      --accent: #EECB88;
      --accent2: #F47B30;
      --accent-grad: linear-gradient(135deg, #EECB88 0%, #F47B30 100%);
      --accent-grad-hover: linear-gradient(135deg, #F47B30 0%, #D65A18 100%);
      --green: #1E7D5C;
      --green-light: #E0F5EA;
      --honey-soft: rgba(238, 203, 136, 0.12);
      --shadow-soft: 0 10px 30px rgba(56, 38, 21, 0.05);
      --shadow-deep: 0 20px 40px rgba(56, 38, 21, 0.09);
      --radius-sm: 12px;
      --radius-md: 18px;
      --radius-lg: 28px;
      --transition: all 0.35s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    /* GLOBAL STYLES */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background-color: var(--bg);
      background-image: radial-gradient(circle at 10% 20%, rgba(238, 203, 136, 0.1) 0%, transparent 40%),
                        radial-gradient(circle at 90% 80%, rgba(30, 125, 92, 0.05) 0%, transparent 45%);
      color: var(--dark);
      overflow-x: hidden;
      min-height: 100vh;
      -webkit-font-smoothing: antialiased;
      display: flex;
      flex-direction: column;
    }

    /* CUSTOM NAVBAR */
    .custom-navbar {
      background: rgba(250, 247, 235, 0.85);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border-bottom: 1px solid rgba(56, 38, 21, 0.08);
      padding: 14px 40px;
      position: sticky;
      top: 0;
      z-index: 1000;
      transition: var(--transition);
    }
    .brand-logo {
      font-weight: 800;
      font-size: 1.6rem;
      letter-spacing: -0.5px;
      display: flex;
      align-items: center;
      gap: 8px;
      text-decoration: none;
      color: var(--dark);
    }
    .brand-logo span {
      background: var(--accent-grad);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    .tabs-wrapper {
      background: rgba(56, 38, 21, 0.05);
      border-radius: 40px;
      padding: 4px;
      display: flex;
      gap: 2px;
    }
    .tab-trigger {
      border: none;
      background: transparent;
      padding: 10px 22px;
      border-radius: 40px;
      font-weight: 600;
      font-size: 0.9rem;
      color: var(--dark);
      opacity: 0.7;
      transition: var(--transition);
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 6px;
    }
    .tab-trigger:hover {
      opacity: 1;
      background: rgba(238, 203, 136, 0.2);
    }
    .tab-trigger.active {
      background: var(--accent-grad);
      color: #FFFDF6;
      opacity: 1;
      box-shadow: 0 4px 15px rgba(244, 123, 48, 0.25);
    }

    /* CORE PAGES LAYOUT */
    .page-section {
      display: none;
      animation: tabFadeIn 0.5s cubic-bezier(0.25, 0.8, 0.25, 1) forwards;
      min-height: calc(100vh - 280px);
    }
    .page-section.active {
      display: block;
    }
    @keyframes tabFadeIn {
      from {
        opacity: 0;
        transform: translateY(18px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* PREMIUM BUTTONS */
    .btn-honey {
      background: var(--accent-grad);
      color: #FFFDF6;
      border: none;
      border-radius: 30px;
      padding: 12px 28px;
      font-weight: 700;
      font-size: 0.95rem;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      box-shadow: 0 6px 18px rgba(244, 123, 48, 0.2);
      transition: var(--transition);
      cursor: pointer;
      text-decoration: none;
    }
    .btn-honey:hover {
      background: var(--accent-grad-hover);
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(244, 123, 48, 0.35);
      color: #FFFDF6;
    }
    .btn-honey-outline {
      background: transparent;
      border: 2px solid var(--accent);
      color: var(--dark);
      border-radius: 30px;
      padding: 10px 24px;
      font-weight: 600;
      font-size: 0.95rem;
      transition: var(--transition);
      cursor: pointer;
      text-decoration: none;
    }
    .btn-honey-outline:hover {
      background: var(--accent-grad);
      border-color: transparent;
      color: #FFFDF6;
      transform: translateY(-2px);
    }
    .btn-sage {
      background: var(--green);
      color: #FFFDF6;
      border: none;
      border-radius: 30px;
      padding: 10px 24px;
      font-weight: 600;
      font-size: 0.9rem;
      transition: var(--transition);
      cursor: pointer;
    }
    .btn-sage:hover {
      background: #155B42;
      box-shadow: 0 6px 16px rgba(30, 125, 92, 0.25);
      transform: translateY(-1px);
    }
    .btn-danger-custom {
      background: #E74C3C;
      color: #FFFDF6;
      border: none;
      border-radius: 30px;
      padding: 10px 24px;
      font-weight: 600;
      font-size: 0.9rem;
      transition: var(--transition);
      cursor: pointer;
    }
    .btn-danger-custom:hover {
      background: #C0392B;
      box-shadow: 0 6px 16px rgba(231, 76, 60, 0.25);
      transform: translateY(-1px);
    }

    /* PREMIUM CARDS */
    .custom-card {
      background: var(--bg-warm);
      border-radius: var(--radius-md);
      box-shadow: var(--shadow-soft);
      border: 1px solid rgba(56, 38, 21, 0.04);
      padding: 30px;
      transition: var(--transition);
    }
    .custom-card:hover {
      box-shadow: var(--shadow-deep);
      transform: translateY(-5px);
    }

    /* TAB 1: HERO & HOME */
    .hero-container {
      padding: 80px 40px;
      align-items: center;
    }
    .hero-title {
      font-size: 3.4rem;
      font-weight: 800;
      line-height: 1.25;
      color: var(--dark);
      margin-bottom: 20px;
    }
    .hero-sub {
      font-size: 1.15rem;
      line-height: 1.8;
      color: var(--dark-muted);
      margin-bottom: 35px;
    }
    .hero-visual-wrapper {
      position: relative;
      text-align: center;
    }
    .hero-visual {
      max-width: 75%;
      margin: 0 auto;
      display: block;
      border-radius: var(--radius-lg);
      filter: drop-shadow(0 15px 35px rgba(56, 38, 21, 0.12));
      animation: floatGraphic 5s ease-in-out infinite;
    }
    @keyframes floatGraphic {
      0%, 100% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(-15px) rotate(1.5deg); }
    }
    .floating-accent-1 {
      position: absolute;
      width: 120px;
      height: 120px;
      background: radial-gradient(circle, rgba(238, 203, 136, 0.4) 0%, transparent 70%);
      top: -20px;
      right: 10%;
      z-index: -1;
      animation: pulseGlow 4s infinite alternate;
    }
    .floating-accent-2 {
      position: absolute;
      width: 160px;
      height: 160px;
      background: radial-gradient(circle, rgba(244, 123, 48, 0.15) 0%, transparent 70%);
      bottom: -30px;
      left: 10%;
      z-index: -1;
      animation: pulseGlow 5s infinite alternate-reverse;
    }
    @keyframes pulseGlow {
      0% { transform: scale(0.9); opacity: 0.5; }
      100% { transform: scale(1.1); opacity: 1; }
    }

    /* STEP CARDS */
    .steps-section {
      padding: 80px 40px;
      background: var(--bg-warm);
      border-top: 1px solid rgba(56, 38, 21, 0.05);
      border-bottom: 1px solid rgba(56, 38, 21, 0.05);
    }
    .step-box {
      background: #FFFFFF;
      border-radius: var(--radius-md);
      padding: 35px 25px;
      text-align: center;
      border: 1px solid rgba(56, 38, 21, 0.03);
      box-shadow: 0 4px 20px rgba(56, 38, 21, 0.02);
      transition: var(--transition);
      height: 100%;
    }
    .step-box:hover {
      transform: translateY(-8px);
      box-shadow: var(--shadow-deep);
      border-color: rgba(238, 203, 136, 0.3);
    }
    .step-badge {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: var(--accent-grad);
      color: #FFFDF6;
      font-weight: 800;
      font-size: 1.25rem;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      box-shadow: 0 4px 12px rgba(244, 123, 48, 0.2);
    }
    .step-box h4 {
      font-weight: 700;
      font-size: 1.15rem;
      margin-bottom: 10px;
      color: var(--dark);
    }
    .step-box p {
      font-size: 0.9rem;
      color: var(--dark-muted);
      line-height: 1.6;
      margin-bottom: 0;
    }

    /* MINI LIVE STOCK */
    .mini-live-stock {
      padding: 80px 40px;
    }
    .live-stock-item {
      background: #FFFFFF;
      border-radius: var(--radius-sm);
      padding: 22px 26px;
      display: flex;
      align-items: center;
      gap: 20px;
      border: 1px solid rgba(56, 38, 21, 0.04);
      box-shadow: var(--shadow-soft);
      transition: var(--transition);
      height: 100%;
    }
    .live-stock-item:hover {
      transform: translateY(-4px);
      box-shadow: var(--shadow-deep);
      border-color: rgba(30, 125, 92, 0.2);
    }
    .stock-emoji-box {
      font-size: 1.8rem;
      background: var(--honey-soft);
      width: 60px;
      height: 60px;
      border-radius: var(--radius-sm);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--accent2);
    }
    .stock-details h5 {
      font-weight: 700;
      font-size: 1rem;
      margin-bottom: 4px;
    }
    .stock-details p {
      font-size: 0.85rem;
      color: var(--dark-muted);
      margin: 0;
    }
    .badge-status {
      padding: 6px 14px;
      border-radius: 40px;
      font-size: 0.8rem;
      font-weight: 700;
      margin-left: auto;
    }
    .badge-status.available {
      background-color: var(--green-light);
      color: var(--green);
    }

    /* TAB 2: MITRA DONOR DASHBOARD (SIDEBAR + MAIN) */
    .dashboard-container {
      display: flex;
      min-height: calc(100vh - 80px);
    }
    .sidebar {
      width: 300px;
      background: #FFFFFF;
      border-right: 1px solid rgba(56, 38, 21, 0.08);
      padding: 40px 24px;
      display: flex;
      flex-direction: column;
    }
    .sidebar-user {
      text-align: center;
      margin-bottom: 40px;
    }
    .sidebar-avatar {
      width: 90px;
      height: 90px;
      border-radius: 50%;
      background: var(--accent-grad);
      color: #FFFDF6;
      font-size: 2rem;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 16px;
      box-shadow: 0 8px 20px rgba(244, 123, 48, 0.15);
    }
    .sidebar-user h5 {
      font-weight: 700;
      font-size: 1.1rem;
      margin-bottom: 6px;
    }
    .sidebar-user span {
      font-size: 0.8rem;
      color: var(--dark-muted);
      background: var(--honey-soft);
      padding: 4px 12px;
      border-radius: 20px;
      font-weight: 600;
    }
    .sidebar-menu {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 8px;
    }
    .sidebar-item a {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 14px 20px;
      border-radius: var(--radius-sm);
      text-decoration: none;
      color: var(--dark);
      font-weight: 600;
      font-size: 0.95rem;
      opacity: 0.8;
      transition: var(--transition);
    }
    .sidebar-item.active a, .sidebar-item a:hover {
      background: var(--honey-soft);
      color: var(--accent2);
      opacity: 1;
      transform: translateX(4px);
    }
    .dashboard-main {
      flex: 1;
      padding: 50px;
    }
    .dashboard-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 40px;
    }
    .donations-table-wrapper {
      background: #FFFFFF;
      border-radius: var(--radius-md);
      box-shadow: var(--shadow-soft);
      border: 1px solid rgba(56, 38, 21, 0.04);
      overflow: hidden;
    }
    .donations-table {
      width: 100%;
      border-collapse: collapse;
    }
    .donations-table th {
      background: rgba(56, 38, 21, 0.02);
      padding: 18px 24px;
      font-weight: 700;
      font-size: 0.85rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      color: var(--dark-muted);
      border-bottom: 1px solid rgba(56, 38, 21, 0.06);
    }
    .donations-table td {
      padding: 20px 24px;
      border-bottom: 1px solid rgba(56, 38, 21, 0.04);
      font-size: 0.95rem;
    }
    .donations-table tr:last-child td {
      border-bottom: none;
    }
    .category-pill {
      background: rgba(56, 38, 21, 0.05);
      color: var(--dark-muted);
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
    }

    /* TAB 3: KATALOG (LIVE INVENTORY) */
    .catalog-container {
      padding: 60px 40px;
    }
    .catalog-top {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 40px;
    }
    .user-profile-badge {
      display: flex;
      align-items: center;
      gap: 12px;
      background: #FFFFFF;
      padding: 8px 20px 8px 8px;
      border-radius: 40px;
      box-shadow: var(--shadow-soft);
      border: 1px solid rgba(56, 38, 21, 0.04);
    }
    .user-avatar-sm {
      width: 42px;
      height: 42px;
      border-radius: 50%;
      background: var(--green);
      color: #FFFDF6;
      font-weight: 700;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .filter-wrapper {
      display: flex;
      gap: 10px;
      margin-bottom: 40px;
      flex-wrap: wrap;
    }
    .filter-pill {
      border: 1.5px solid rgba(56, 38, 21, 0.1);
      background: #FFFFFF;
      padding: 8px 22px;
      border-radius: 30px;
      font-weight: 600;
      font-size: 0.85rem;
      cursor: pointer;
      transition: var(--transition);
    }
    .filter-pill:hover, .filter-pill.active {
      background: var(--accent-grad);
      border-color: transparent;
      color: #FFFDF6;
      box-shadow: 0 4px 12px rgba(244, 123, 48, 0.2);
    }
    .food-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 30px;
    }
    .food-card {
      background: #FFFFFF;
      border-radius: var(--radius-md);
      overflow: hidden;
      box-shadow: var(--shadow-soft);
      border: 1px solid rgba(56, 38, 21, 0.04);
      transition: var(--transition);
      display: flex;
      flex-direction: column;
    }
    .food-card:hover {
      transform: translateY(-8px);
      box-shadow: var(--shadow-deep);
    }
    .food-card-img {
      height: 180px;
      background: linear-gradient(135deg, #FFF8E8 0%, #FFE8C2 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 3rem;
      position: relative;
      color: var(--accent2);
    }
    .badge-floating {
      position: absolute;
      top: 14px;
      right: 14px;
      background: var(--accent-grad);
      color: #FFFDF6;
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 0.75rem;
      font-weight: 700;
    }
    .food-card-body {
      padding: 24px;
      display: flex;
      flex-direction: column;
      flex: 1;
    }
    .food-card-body h4 {
      font-weight: 700;
      font-size: 1.15rem;
      margin-bottom: 8px;
    }
    .food-location {
      font-size: 0.8rem;
      color: var(--dark-muted);
      margin-bottom: 12px;
      display: flex;
      align-items: center;
      gap: 6px;
    }
    .food-qty {
      font-weight: 700;
      color: var(--green);
      font-size: 0.9rem;
      margin-bottom: 20px;
    }
    .btn-card-claim {
      margin-top: auto;
      width: 100%;
      text-align: center;
      justify-content: center;
    }

    /* TAB 4: CLAIM FORM & TIMELINE */
    .detail-container {
      padding: 60px 40px;
      max-width: 1100px;
      margin: 0 auto;
    }
    .detail-hero {
      background: #FFFFFF;
      border-radius: var(--radius-lg);
      padding: 40px;
      box-shadow: var(--shadow-soft);
      border: 1px solid rgba(56, 38, 21, 0.04);
      display: flex;
      gap: 40px;
      margin-bottom: 40px;
      align-items: center;
    }
    .detail-img-box {
      font-size: 5rem;
      background: linear-gradient(135deg, #FFF8E8 0%, #FFE8C2 100%);
      width: 180px;
      height: 180px;
      border-radius: var(--radius-md);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      color: var(--accent2);
    }
    .detail-info h2 {
      font-weight: 800;
      font-size: 2rem;
      margin-bottom: 8px;
    }
    .detail-origin {
      font-size: 0.9rem;
      color: var(--dark-muted);
      margin-bottom: 16px;
    }
    .detail-pills {
      display: flex;
      gap: 12px;
      margin-bottom: 20px;
    }
    .detail-pill {
      background: var(--honey-soft);
      color: var(--dark);
      padding: 6px 16px;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }
    .detail-description {
      font-size: 0.95rem;
      color: var(--dark-muted);
      line-height: 1.6;
      margin: 0;
    }

    /* CLAIM FORM WARM BACKGROUND (Honey/Caramel vibes) */
    .honey-form-wrapper {
      background: linear-gradient(135deg, #FFF3D6 0%, #FFECC4 100%);
      border-radius: var(--radius-lg);
      padding: 40px;
      box-shadow: var(--shadow-soft);
      border: 1px solid rgba(244, 123, 48, 0.1);
      margin-bottom: 50px;
    }
    .honey-form-wrapper h3 {
      font-weight: 800;
      font-size: 1.4rem;
      margin-bottom: 24px;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .honey-input-group {
      margin-bottom: 20px;
    }
    .honey-input-group label {
      display: block;
      font-weight: 700;
      font-size: 0.9rem;
      margin-bottom: 8px;
      color: var(--dark);
    }
    .honey-input {
      width: 100%;
      background: #FFFFFF;
      border: 2.5px solid rgba(56, 38, 21, 0.08);
      border-radius: var(--radius-sm);
      padding: 12px 18px;
      font-size: 0.95rem;
      font-family: inherit;
      color: var(--dark);
      transition: var(--transition);
    }
    .honey-input:focus {
      outline: none;
      border-color: var(--accent2);
      box-shadow: 0 0 0 4px rgba(244, 123, 48, 0.15);
    }
    .honey-input[readonly] {
      background: rgba(56, 38, 21, 0.04);
      border-color: transparent;
      cursor: not-allowed;
    }

    /* TIMELINE */
    .timeline-title {
      font-weight: 800;
      font-size: 1.4rem;
      margin-bottom: 30px;
    }
    .timeline-wrapper {
      position: relative;
      padding-left: 35px;
    }
    .timeline-wrapper::before {
      content: '';
      position: absolute;
      left: 10px;
      top: 10px;
      bottom: 10px;
      width: 3px;
      background: linear-gradient(180deg, var(--accent) 0%, var(--green) 100%);
      border-radius: 4px;
    }
    .timeline-node {
      position: relative;
      margin-bottom: 40px;
    }
    .timeline-node:last-child {
      margin-bottom: 0;
    }
    .timeline-indicator {
      position: absolute;
      left: -35px;
      top: 4px;
      width: 22px;
      height: 22px;
      border-radius: 50%;
      background: #FFFFFF;
      border: 3.5px solid var(--accent);
      z-index: 2;
      transition: var(--transition);
    }
    .timeline-node.done .timeline-indicator {
      background: var(--green);
      border-color: var(--green);
    }
    .timeline-node.active .timeline-indicator {
      background: #FFFFFF;
      border-color: var(--green);
      animation: pulseGreen 1.5s infinite;
    }
    @keyframes pulseGreen {
      0% { box-shadow: 0 0 0 0 rgba(30, 125, 92, 0.4); }
      70% { box-shadow: 0 0 0 6px rgba(30, 125, 92, 0); }
      100% { box-shadow: 0 0 0 0 rgba(30, 125, 92, 0); }
    }
    .timeline-node-content {
      background: #FFFFFF;
      border-radius: var(--radius-sm);
      padding: 20px 24px;
      box-shadow: var(--shadow-soft);
      border: 1px solid rgba(56, 38, 21, 0.03);
    }
    .timeline-node-content h5 {
      font-weight: 700;
      font-size: 1rem;
      margin-bottom: 6px;
      display: flex;
      justify-content: space-between;
    }
    .timeline-node-content p {
      font-size: 0.88rem;
      color: var(--dark-muted);
      margin: 0;
      line-height: 1.6;
    }
    .timeline-time {
      font-size: 0.75rem;
      color: var(--dark-muted);
      opacity: 0.7;
      font-weight: 500;
    }

    /* E-Commerce Tracker Header */
    .ecommerce-tracker-header {
      background: #FFFFFF;
      border: 1px solid rgba(56, 38, 21, 0.08);
      box-shadow: var(--shadow-soft);
      transition: var(--transition);
    }
    
    /* Map Illustration for E-Commerce Tracking */
    .map-illustration {
      position: relative;
      width: 100%;
      height: 120px;
      background: #FAF8F5;
      border-radius: 14px;
      overflow: hidden;
      margin-top: 20px;
      border: 2px dashed rgba(56, 38, 21, 0.1);
      background-image: radial-gradient(rgba(244, 123, 48, 0.08) 1.5px, transparent 1.5px);
      background-size: 16px 16px;
    }
    .map-road {
      position: absolute;
      top: 50%;
      left: 12%;
      right: 12%;
      height: 6px;
      background: rgba(56, 38, 21, 0.06);
      border-radius: 10px;
      transform: translateY(-50%);
      z-index: 1;
    }
    .map-road-progress {
      position: absolute;
      top: 0;
      left: 0;
      height: 100%;
      background: var(--accent-grad);
      border-radius: 10px;
      z-index: 2;
    }
    .map-marker {
      position: absolute;
      top: 50%;
      transform: translate(-50%, -50%);
      z-index: 3;
      font-size: 1.7rem;
      transition: all 0.5s ease;
      filter: drop-shadow(0 4px 8px rgba(0,0,0,0.12));
    }
    .map-marker.donor {
      left: 12%;
      color: var(--accent2);
    }
    .map-marker.lembaga {
      left: 88%;
      color: var(--green);
    }
    .map-marker.courier {
      color: #1967D2;
      font-size: 1.5rem;
      top: 35%;
      animation: driveCourier 4.5s ease-in-out infinite alternate;
    }
    @keyframes driveCourier {
      0% { left: 16%; transform: scaleX(1); }
      100% { left: 84%; transform: scaleX(-1); }
    }



    /* TAB 6: ADMIN PANEL */
    .admin-container {
      padding: 60px 40px;
    }
    .admin-stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 25px;
      margin-bottom: 40px;
    }
    .stat-box {
      background: #FFFFFF;
      border-radius: var(--radius-md);
      padding: 30px 24px;
      box-shadow: var(--shadow-soft);
      border: 1px solid rgba(56, 38, 21, 0.04);
      text-align: center;
      transition: var(--transition);
    }
    .stat-box:hover {
      box-shadow: var(--shadow-deep);
      transform: translateY(-4px);
    }
    .stat-icon-wrapper {
      width: 56px;
      height: 56px;
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.6rem;
      margin: 0 auto 16px;
    }
    .stat-icon-wrapper.orange { background: #FFF3D6; color: var(--accent2); }
    .stat-icon-wrapper.green { background: var(--green-light); color: var(--green); }
    .stat-icon-wrapper.blue { background: #E8F0FE; color: #1967D2; }
    .stat-icon-wrapper.gold { background: #FEF3D6; color: #E6A817; }
    
    .stat-num-val {
      font-size: 2.2rem;
      font-weight: 800;
      color: var(--dark);
      margin-bottom: 4px;
    }
    .stat-lbl {
      font-size: 0.85rem;
      font-weight: 600;
      color: var(--dark-muted);
    }
    
    /* MODALS & ALERTS */
    .alert-success-honey {
      background-color: var(--green-light);
      border: 1.5px solid rgba(30, 125, 92, 0.2);
      color: var(--green);
      border-radius: var(--radius-sm);
      padding: 16px 24px;
      font-weight: 600;
      margin-bottom: 24px;
      display: none;
      animation: alertSlideIn 0.4s ease;
    }
    @keyframes alertSlideIn {
      from { transform: translateY(-10px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }

    /* ========================================
       BERITA & EDUKASI (NEWS/ARTICLES PUBLIC TAB)
    ======================================== */
    .news-container { padding: 0; }

    /* Headline Banner */
    .news-headline-banner {
      position: relative;
      background: linear-gradient(135deg, #382615 0%, #5A3E26 60%, #7A5933 100%);
      border-radius: 0 0 var(--radius-lg) var(--radius-lg);
      padding: 80px 60px 60px;
      overflow: hidden;
      color: #FFFDF6;
    }
    .news-headline-banner::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: radial-gradient(circle at 80% 20%, rgba(238, 203, 136, 0.15) 0%, transparent 50%),
                  radial-gradient(circle at 20% 80%, rgba(244, 123, 48, 0.1) 0%, transparent 50%);
      pointer-events: none;
    }
    .news-headline-banner .headline-content {
      position: relative; z-index: 2;
      display: grid; grid-template-columns: 1fr 1fr; gap: 50px; align-items: center;
    }
    .headline-tag {
      display: inline-block;
      background: rgba(238, 203, 136, 0.25);
      color: var(--accent);
      padding: 6px 18px; border-radius: 30px;
      font-size: 0.8rem; font-weight: 700;
      letter-spacing: 0.5px; margin-bottom: 20px;
      backdrop-filter: blur(8px);
    }
    .headline-title {
      font-size: 2.6rem; font-weight: 800;
      line-height: 1.3; margin-bottom: 16px;
      text-shadow: 0 2px 16px rgba(0,0,0,0.15);
    }
    .headline-snippet {
      font-size: 1.05rem; line-height: 1.7;
      opacity: 0.8; margin-bottom: 28px;
    }
    .headline-meta {
      display: flex; gap: 20px; align-items: center;
      font-size: 0.85rem; opacity: 0.6;
    }
    .headline-img-wrapper {
      background: linear-gradient(135deg, #FFF8E8 0%, #FFE8C2 100%);
      border-radius: var(--radius-lg);
      height: 320px; display: flex; align-items: center; justify-content: center;
      font-size: 8rem;
      box-shadow: 0 20px 50px rgba(0,0,0,0.2);
      position: relative; overflow: hidden;
    }
    .headline-img-wrapper::after {
      content: '';
      position: absolute; bottom: 0; left: 0; right: 0;
      height: 60%;
      background: linear-gradient(to top, rgba(56, 38, 21, 0.08), transparent);
    }

    /* Article Grid */
    .news-grid-section { padding: 60px; }
    .news-grid-header {
      display: flex; justify-content: space-between;
      align-items: center; margin-bottom: 40px;
    }
    .news-grid-header h2 { font-weight: 800; font-size: 1.8rem; }
    .news-filter-pills {
      display: flex; gap: 8px;
    }
    .news-filter-pill {
      border: 1.5px solid rgba(56, 38, 21, 0.1);
      background: #FFFFFF; padding: 8px 20px;
      border-radius: 30px; font-weight: 600; font-size: 0.85rem;
      cursor: pointer; transition: var(--transition); font-family: inherit;
    }
    .news-filter-pill:hover, .news-filter-pill.active {
      background: var(--accent-grad);
      border-color: transparent; color: #FFFDF6;
      box-shadow: 0 4px 12px rgba(244, 123, 48, 0.2);
    }
    .articles-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 30px;
    }
    .article-card {
      background: #FFFFFF;
      border-radius: var(--radius-md);
      overflow: hidden;
      box-shadow: var(--shadow-soft);
      border: 1px solid rgba(56, 38, 21, 0.04);
      transition: var(--transition);
      display: flex; flex-direction: column;
    }
    .article-card:hover {
      transform: translateY(-8px);
      box-shadow: var(--shadow-deep);
    }
    .article-card-img {
      height: 200px;
      display: flex; align-items: center; justify-content: center;
      font-size: 5rem; position: relative;
      overflow: hidden;
    }
    .article-card-img.img-edu { background: linear-gradient(135deg, #E0F5EA 0%, #C8E6D8 100%); }
    .article-card-img.img-social { background: linear-gradient(135deg, #FFF3D6 0%, #FFE8C2 100%); }
    .article-card-img.img-tips { background: linear-gradient(135deg, #E8F0FE 0%, #D0E2F8 100%); }
    .article-card-img.img-event { background: linear-gradient(135deg, #FDECEA 0%, #F5C6CB 100%); }
    .article-card-img.img-default { background: linear-gradient(135deg, #FFF8E8 0%, #FFE8C2 100%); }

    .article-category-tag {
      position: absolute;
      top: 14px;
      left: 14px;
      padding: 6px 14px;
      border-radius: 20px;
      font-size: 0.72rem;
      font-weight: 800;
      color: #FFFFFF !important;
      background: rgba(255, 255, 255, 0.22) !important;
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.35) !important;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
      letter-spacing: 0.5px;
      text-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
      text-transform: uppercase;
    }
    .tag-edukasi, .tag-sosial, .tag-tips, .tag-event {
      color: #FFFFFF !important;
      background: rgba(255, 255, 255, 0.22) !important;
    }

    .article-card-body {
      padding: 24px; display: flex; flex-direction: column; flex: 1;
    }
    .article-card-body h4 {
      font-weight: 700; font-size: 1.1rem; margin-bottom: 10px;
      color: var(--dark); line-height: 1.4;
      display: -webkit-box; -webkit-line-clamp: 2;
      -webkit-box-orient: vertical; overflow: hidden;
    }
    .article-card-body .article-snippet {
      font-size: 0.88rem; color: var(--dark-muted);
      line-height: 1.6; margin-bottom: 16px; flex: 1;
      display: -webkit-box; -webkit-line-clamp: 3;
      -webkit-box-orient: vertical; overflow: hidden;
    }
    .article-card-footer {
      display: flex; justify-content: space-between;
      align-items: center; margin-top: auto;
    }
    .article-author {
      font-size: 0.8rem; color: var(--dark-muted); font-weight: 600;
      display: flex; align-items: center; gap: 6px;
    }
    .article-author-avatar {
      width: 28px; height: 28px; border-radius: 50%;
      background: var(--accent-grad); color: #fff;
      display: flex; align-items: center; justify-content: center;
      font-size: 0.7rem; font-weight: 700;
    }
    .btn-read-more {
      background: transparent; border: 1.5px solid var(--accent);
      color: var(--accent2); padding: 7px 18px;
      border-radius: 30px; font-size: 0.82rem; font-weight: 700;
      cursor: pointer; transition: var(--transition); font-family: inherit;
    }
    .btn-read-more:hover {
      background: var(--accent-grad);
      color: #FFFDF6; border-color: transparent;
    }

    /* ========================================
       ADMIN ARTICLE MANAGEMENT STYLING
    ======================================== */
    .badge-published {
      background: var(--green-light); color: var(--green);
      padding: 5px 14px; border-radius: 20px;
      font-size: 0.78rem; font-weight: 700;
    }
    .btn-danger-pastel {
      background: #FDECEA; color: #C0392B; border: 1.5px solid #F5C6CB;
      border-radius: 30px; padding: 8px 18px;
      font-weight: 600; font-size: 0.85rem;
      transition: var(--transition); cursor: pointer; font-family: inherit;
    }
    .btn-danger-pastel:hover {
      background: #E74C3C; color: #fff; border-color: #E74C3C;
      transform: translateY(-1px);
    }
    .btn-info-pastel {
      background: #E8F0FE; color: #1967D2; border: 1.5px solid #C4D7F5;
      border-radius: 30px; padding: 8px 18px;
      font-weight: 600; font-size: 0.85rem;
      transition: var(--transition); cursor: pointer; font-family: inherit;
    }
    .btn-info-pastel:hover {
      background: #1967D2; color: #fff; border-color: #1967D2;
      transform: translateY(-1px);
    }
    .btn-edit-pastel {
      background: #FFF3D6; color: #B8860B; border: 1.5px solid #F0D89A;
      border-radius: 30px; padding: 8px 18px;
      font-weight: 600; font-size: 0.85rem;
      transition: var(--transition); cursor: pointer; font-family: inherit;
    }
    .btn-edit-pastel:hover {
      background: #E6A817; color: #fff; border-color: #E6A817;
      transform: translateY(-1px);
    }
    
    /* Responsive tweaks for news */
    @media (max-width: 1200px) {
      .articles-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
      .articles-grid { grid-template-columns: 1fr; }
      .news-headline-banner .headline-content { grid-template-columns: 1fr; gap: 30px; }
      .news-headline-banner { padding: 40px 20px; }
      .news-grid-section { padding: 30px 15px; }
    }

    /* PREMIUM FOOTER */
    .premium-footer {
      background-color: var(--dark);
      background-image: linear-gradient(180deg, #382615 0%, #20140A 100%);
      color: #FAF7EB;
      padding: 80px 40px 40px;
      border-top: 5px solid var(--accent);
      margin-top: auto;
    }
    .footer-logo {
      font-weight: 800;
      font-size: 1.8rem;
      color: #FAF7EB;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 20px;
    }
    .footer-logo span {
      background: var(--accent-grad);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    .footer-desc {
      color: #D2C2B1;
      font-size: 0.95rem;
      line-height: 1.7;
      margin-bottom: 30px;
      max-width: 320px;
    }
    .footer-title {
      font-weight: 700;
      font-size: 1.1rem;
      margin-bottom: 25px;
      color: var(--accent);
      position: relative;
    }
    .footer-links {
      list-style: none;
      padding: 0;
      display: flex;
      flex-direction: column;
      gap: 12px;
    }
    .footer-links a {
      color: #D2C2B1;
      text-decoration: none;
      font-size: 0.95rem;
      transition: var(--transition);
    }
    .footer-links a:hover {
      color: #FFFDF6;
      transform: translateX(4px);
    }
    .footer-socials {
      display: flex;
      gap: 15px;
      margin-top: 15px;
    }
    .footer-social-btn {
      width: 44px;
      height: 44px;
      border-radius: 50%;
      background: rgba(250, 247, 235, 0.08);
      color: #FAF7EB;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
      transition: var(--transition);
      text-decoration: none;
    }
    .footer-social-btn:hover {
      background: var(--accent-grad);
      color: #FFFDF6;
      transform: translateY(-3px);
    }
    .footer-divider {
      border-top: 1px solid rgba(250, 247, 235, 0.1);
      margin: 50px 0 30px;
    }
    .footer-copyright {
      color: #A69584;
      font-size: 0.88rem;
    }

    /* PREMIUM MODAL STYLING */
    .custom-modal-content {
      background-color: var(--bg-warm);
      border: 2px solid var(--accent);
      border-radius: var(--radius-lg);
      padding: 30px;
    }
    .modal-login-pill {
      background: #FFFFFF;
      border: 2px solid rgba(56, 38, 21, 0.08);
      border-radius: var(--radius-sm);
      padding: 12px 20px;
      cursor: pointer;
      transition: var(--transition);
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 12px;
      width: 100%;
      text-align: left;
    }
    .modal-login-pill:hover {
      border-color: var(--accent2);
      transform: translateY(-2px);
      box-shadow: var(--shadow-soft);
    }

    /* PREMIUM FLOATING TOASTS / NOTIFICATIONS */
    .custom-toast-container {
      position: fixed;
      top: 24px;
      right: 24px;
      z-index: 9999;
      display: flex;
      flex-direction: column;
      gap: 12px;
      max-width: 380px;
      width: calc(100% - 48px);
    }
    .custom-toast {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border-radius: var(--radius-sm);
      padding: 16px 20px;
      box-shadow: 0 10px 30px rgba(56, 38, 21, 0.08);
      border: 1px solid rgba(56, 38, 21, 0.08);
      display: flex;
      align-items: flex-start;
      gap: 12px;
      transform: translateX(120%);
      animation: toastSlideIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
      transition: all 0.3s ease;
    }
    .custom-toast.hide {
      animation: toastSlideOut 0.3s ease forwards;
    }
    @keyframes toastSlideIn {
      to { transform: translateX(0); }
    }
    @keyframes toastSlideOut {
      to { transform: translateX(120%); opacity: 0; }
    }
    .toast-icon {
      font-size: 1.4rem;
      line-height: 1;
    }
    .toast-content {
      flex-grow: 1;
    }
    .toast-title {
      font-weight: 700;
      font-size: 0.95rem;
      color: var(--dark);
      margin-bottom: 2px;
    }
    .toast-message {
      font-size: 0.85rem;
      color: var(--dark-muted);
      line-height: 1.4;
    }
    .toast-close {
      background: transparent;
      border: none;
      color: var(--dark-muted);
      opacity: 0.5;
      cursor: pointer;
      padding: 0 4px;
      font-size: 1rem;
      transition: var(--transition);
    }
    .toast-close:hover {
      opacity: 1;
    }

    /* Specific types of toasts */
    .toast-success {
      border-left: 4px solid var(--green);
    }
    .toast-success .toast-icon {
      color: var(--green);
    }
    .toast-error {
      border-left: 4px solid #E74C3C;
    }
    .toast-error .toast-icon {
      color: #E74C3C;
    }
    .toast-warning {
      border-left: 4px solid var(--accent2);
    }
    .toast-warning .toast-icon {
      color: var(--accent2);
    }
    .toast-info {
      border-left: 4px solid #1967D2;
    }
    .toast-info .toast-icon {
      color: #1967D2;
    }

    /* ========================================
       ADMIN MODE FULLSCREEN & SIDEBAR OVERRIDES
    ======================================== */
    body.admin-mode {
      background-color: #FAF9F5;
      background-image: none !important;
      min-height: 100vh;
    }
    body.admin-mode .premium-footer {
      display: none !important;
    }
    #page-admin.page-section {
      min-height: calc(100vh - 72px);
      padding: 0 !important;
    }

    .admin-layout {
      display: flex;
      min-height: calc(100vh - 72px);
      width: 100%;
    }
    .admin-sidebar {
      width: 280px;
      background: linear-gradient(180deg, #241A10 0%, #150F09 100%);
      border-right: 1px solid rgba(56, 38, 21, 0.15);
      color: #FAF7EB;
      display: flex;
      flex-direction: column;
      position: sticky;
      top: 72px;
      height: calc(100vh - 72px);
      z-index: 10;
      flex-shrink: 0;
      transition: var(--transition);
    }
    .admin-sidebar-header {
      padding: 40px 24px 30px;
      text-align: center;
      border-bottom: 1px solid rgba(250, 247, 235, 0.08);
      margin-bottom: 25px;
    }
    .admin-avatar {
      font-size: 3rem;
      margin-bottom: 12px;
      display: inline-block;
      filter: drop-shadow(0 4px 10px rgba(0,0,0,0.3));
    }
    .admin-sidebar-header h5 {
      font-weight: 800;
      font-size: 1.15rem;
      margin-bottom: 6px;
      color: #FAF7EB;
      letter-spacing: -0.2px;
    }
    .admin-sidebar-header span {
      font-size: 0.75rem;
      font-weight: 700;
      color: var(--accent);
      background: rgba(238, 203, 136, 0.12);
      padding: 4px 14px;
      border-radius: 20px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    .admin-sidebar-nav {
      list-style: none;
      padding: 0 16px;
      margin: 0;
      display: flex;
      flex-direction: column;
      gap: 6px;
    }
    .admin-sidebar-nav li {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 14px 20px;
      border-radius: var(--radius-sm);
      font-weight: 600;
      font-size: 0.95rem;
      color: #FAF7EB;
      opacity: 0.75;
      cursor: pointer;
      transition: var(--transition);
    }
    .admin-sidebar-nav li:hover {
      opacity: 1;
      background: rgba(250, 247, 235, 0.08);
      color: var(--accent);
      transform: translateX(4px);
    }
    .admin-sidebar-nav li.active {
      opacity: 1;
      background: var(--accent-grad);
      color: #FFFDF6;
      box-shadow: 0 4px 15px rgba(244, 123, 48, 0.25);
    }
    .admin-sidebar-nav li .nav-icon {
      font-size: 1.2rem;
      display: flex;
      align-items: center;
    }
    .admin-sidebar-nav li .nav-badge {
      margin-left: auto;
      background: #E74C3C;
      color: #FFFDF6;
      padding: 3px 8px;
      font-size: 0.72rem;
      font-weight: 800;
      border-radius: 20px;
      box-shadow: 0 2px 8px rgba(231, 76, 60, 0.3);
    }
    .admin-sidebar-footer {
      margin-top: auto;
      padding: 25px 24px;
      border-top: 1px solid rgba(250, 247, 235, 0.06);
      text-align: center;
    }
    .admin-sidebar-footer p {
      font-size: 0.75rem;
      color: #FAF7EB;
      opacity: 0.45;
      margin: 0;
      line-height: 1.5;
    }
    .admin-main {
      flex: 1;
      padding: 50px;
      background: #FAF9F5;
      overflow-y: auto;
      height: calc(100vh - 72px);
    }
    .admin-sub-page {
      display: none;
      animation: tabFadeIn 0.4s ease forwards;
    }
    .admin-sub-page.active {
      display: block;
    }
    .admin-page-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 40px;
      padding-bottom: 20px;
      border-bottom: 1px solid rgba(56, 38, 21, 0.06);
    }
    .admin-page-header h2 {
      font-weight: 800;
      font-size: 1.8rem;
      margin: 0 0 6px;
      color: var(--dark);
    }
    .admin-page-header p {
      color: var(--dark-muted);
      margin: 0;
      font-size: 0.95rem;
    }

    /* ========================================
       PREMIUM ARTICLE CARD & THUMBNAIL STYLING
    ======================================== */
    .article-thumb-pattern {
      transition: var(--transition);
      background-size: cover;
      background-position: center;
      overflow: hidden;
      width: 100%;
      height: 100%;
    }
    .article-thumb-pattern.theme-edu {
      background: linear-gradient(135deg, #1E7D5C 0%, #4EAA83 100%);
    }
    .article-thumb-pattern.theme-social {
      background: linear-gradient(135deg, #F47B30 0%, #EECB88 100%);
    }
    .article-thumb-pattern.theme-tips {
      background: linear-gradient(135deg, #1967D2 0%, #689FF0 100%);
    }
    .article-thumb-pattern.theme-default {
      background: linear-gradient(135deg, #382615 0%, #7A5933 100%);
    }
    
    .thumb-decor-circle-1 {
      position: absolute;
      width: 140px;
      height: 140px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.08);
      top: -20px;
      right: -20px;
    }
    .thumb-decor-circle-2 {
      position: absolute;
      width: 100px;
      height: 100px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.05);
      bottom: -30px;
      left: -10px;
    }
    
    .thumb-icon-badge {
      width: 76px;
      height: 76px;
      background: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.3);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #FFFFFF;
      font-size: 2.2rem;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
      z-index: 2;
      transition: var(--transition);
    }
    
    .article-card:hover .thumb-icon-badge {
      transform: scale(1.1) rotate(5deg);
      background: rgba(255, 255, 255, 0.3);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
    }
    
    .article-card:hover .article-thumb-pattern {
      filter: brightness(1.05);
    }

    /* REDESIGN BACA SELENGKAPNYA */
    .btn-read-more {
      background: transparent;
      border: 1.5px solid var(--accent);
      color: var(--accent2);
      padding: 8px 22px;
      border-radius: 30px;
      font-size: 0.85rem;
      font-weight: 700;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: var(--transition);
      font-family: inherit;
      position: relative;
      overflow: hidden;
      z-index: 1;
    }
    
    .btn-read-more::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: var(--accent-grad);
      z-index: -1;
      opacity: 0;
      transition: var(--transition);
    }
    
    .btn-read-more:hover {
      color: #FFFDF6;
      border-color: transparent;
      box-shadow: 0 4px 15px rgba(244, 123, 48, 0.25);
      transform: translateY(-2px);
    }
    
    .btn-read-more:hover::before {
      opacity: 1;
    }
    
    .btn-read-more i {
      transition: transform 0.3s ease;
    }
    
    .btn-read-more:hover i {
      transform: translateX(4px);
    }

    /* REGISTRATION PAGE MULTI-ROLE & FULLSCREEN */
    .register-container {
      max-width: 960px;
      margin: 40px auto;
      padding: 0 20px;
    }
    .role-selection-card {
      background: rgba(255, 255, 255, 0.7);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border: 2px solid rgba(56, 38, 21, 0.06);
      border-radius: var(--radius-md);
      padding: 45px 30px;
      text-align: center;
      transition: var(--transition);
      cursor: pointer;
      height: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      position: relative;
      overflow: hidden;
    }
    .role-selection-card::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0; height: 6px;
      opacity: 0;
      transition: var(--transition);
    }
    .role-selection-card.card-donor::before {
      background: var(--accent-grad);
    }
    .role-selection-card.card-lembaga::before {
      background: linear-gradient(135deg, #1E7D5C 0%, #39B086 100%);
    }
    .role-selection-card:hover {
      transform: translateY(-8px);
      box-shadow: var(--shadow-deep);
      border-color: rgba(56, 38, 21, 0.12);
      background: rgba(255, 255, 255, 0.95);
    }
    .role-selection-card:hover::before {
      opacity: 1;
    }
    .role-icon-box {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 3.5rem;
      margin-bottom: 24px;
      transition: var(--transition);
    }
    .card-donor .role-icon-box {
      background: rgba(244, 123, 48, 0.1);
      color: var(--accent2);
    }
    .card-lembaga .role-icon-box {
      background: rgba(30, 125, 92, 0.1);
      color: var(--green);
    }
    .role-selection-card:hover .role-icon-box {
      transform: scale(1.08);
    }
    .card-donor:hover .role-icon-box {
      background: var(--accent-grad);
      color: #FFFDF6;
      box-shadow: 0 6px 20px rgba(244, 123, 48, 0.25);
    }
    .card-lembaga:hover .role-icon-box {
      background: linear-gradient(135deg, #1E7D5C 0%, #39B086 100%);
      color: #FFFDF6;
      box-shadow: 0 6px 20px rgba(30, 125, 92, 0.25);
    }
    .register-form-card {
      background: #FFFDF6;
      border: 1px solid rgba(56, 38, 21, 0.08);
      border-radius: var(--radius-md);
      box-shadow: var(--shadow-soft);
      padding: 45px;
      position: relative;
    }
    .btn-back-role {
      background: transparent;
      border: none;
      color: var(--dark-muted);
      font-weight: 700;
      font-size: 0.9rem;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      margin-bottom: 24px;
      cursor: pointer;
      transition: var(--transition);
    }
    .btn-back-role:hover {
      color: var(--accent2);
      transform: translateX(-3px);
    }
    
    /* HIDE NAVBAR & FOOTER ON REGISTER PAGE */
    body.register-mode .custom-navbar {
      display: none !important;
    }
    body.register-mode .premium-footer {
      display: none !important;
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav class="custom-navbar d-flex justify-content-between align-items-center">
    <a href="#" class="brand-logo" onclick="showTab('landing')">
      <i class="bi bi-box2-heart-fill" style="color: var(--accent2)"></i>
      <span>FoodShare</span>
    </a>
    
    <div class="tabs-wrapper" id="navbarTabs">
      <!-- Dynamic menu items will be rendered by JS based on user role -->
    </div>
    
    <div class="d-flex align-items-center gap-3">
      <!-- Login / Profile Section -->
      <div id="authNavbarSection">
        <button class="btn-honey-outline" data-bs-toggle="modal" data-bs-target="#loginModal">
          <i class="bi bi-box-arrow-in-right"></i> Masuk Akun
        </button>
      </div>
      <button class="btn-honey d-none d-lg-inline-flex" id="navRescueBtn" onclick="handleRescueBtnClick()">
        Selamatkan Makanan <i class="bi bi-box-seam-fill"></i>
      </button>
    </div>
  </nav>

  <!-- TAB 1: LANDING PAGE -->
  <div class="page-section active" id="page-landing">
    <div class="container-fluid max-width-lg">
      
      <!-- Hero Banner -->
      <div class="row hero-container">
        <div class="col-lg-6 pr-lg-5">
          <div style="display:inline-block;background:var(--green-light);color:var(--green);padding:8px 18px;border-radius:40px;font-size:.85rem;font-weight:700;margin-bottom:20px;letter-spacing:0.5px">
            <i class="bi bi-recycle"></i> ZERO FOOD WASTE MOVEMENT
          </div>
          <h1 class="hero-title">Jangan Biarkan Makanan Baik Terbuang Sia-Sia.</h1>
          <p class="hero-sub">Hubungkan surplus makanan berkualitas tinggi dari restoran &amp; bakery premium ke panti asuhan, lembaga sosial, serta komunitas yang membutuhkan. Bersama kita selamatkan hidangan lezat dan kurangi limbah bumi.</p>
          <div class="d-flex gap-3">
            <button class="btn-honey px-5 py-3" onclick="showTab('catalog')">
              Jelajahi Makanan Tersedia <i class="bi bi-arrow-right-short"></i>
            </button>
            <button class="btn-honey-outline px-4" onclick="showTab('donor')">Gabung Jadi Mitra</button>
          </div>
          
          <div class="row mt-5">
            <div class="col-4 border-end">
              <h3 class="fw-extrabold mb-0" style="color:var(--accent2)">247+</h3>
              <small class="text-muted fw-semibold">Porsi Terselamatkan</small>
            </div>
            <div class="col-4 border-end">
              <h3 class="fw-extrabold mb-0" style="color:var(--green)">12</h3>
              <small class="text-muted fw-semibold">Mitra Donor</small>
            </div>
            <div class="col-4">
              <h3 class="fw-extrabold mb-0" style="color:var(--dark)">8</h3>
              <small class="text-muted fw-semibold">Lembaga Terdaftar</small>
            </div>
          </div>
        </div>
        <div class="col-lg-6 hero-visual-wrapper mt-5 mt-lg-0">
          <div class="floating-accent-1"></div>
          <div class="floating-accent-2"></div>
          <img src="{{ asset('hero_food.png') }}" alt="Visual Makanan Bakery Premium" class="hero-visual">
        </div>
      </div>

      <!-- Section Cara Kerja -->
      <div class="steps-section">
        <div class="text-center mb-5">
          <h2 class="fw-bold" style="font-size: 2rem;">Langkah Penyelamatan Makanan <i class="bi bi-flower1" style="color: var(--green)"></i></h2>
          <p class="text-muted">Prosedur berbagi makanan surplus yang mudah dan 100% transparan</p>
        </div>
        <div class="row g-4 max-width-md mx-auto">
          <div class="col-md-3">
            <div class="step-box">
              <div class="step-badge">1</div>
              <h4>Donor Input Data</h4>
              <p>Restoran/bakery memasukkan data makanan layak yang berlebih.</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="step-box">
              <div class="step-badge">2</div>
              <h4>Real-Time Claim</h4>
              <p>Lembaga sosial mengklaim makanan langsung dari sistem katalog.</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="step-box">
              <div class="step-badge">3</div>
              <h4>Distribusi</h4>
              <p>Relawan sigap mengantarkan atau lembaga melakukan pickup langsung.</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="step-box">
              <div class="step-badge">4</div>
              <h4>Limbah Berkurang</h4>
              <p>Makanan lezat terselamatkan dan dinikmati oleh yang berhak.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Live Stock Mini Section -->
      <div class="mini-live-stock">
        <div class="d-flex justify-content-between align-items-center mb-5">
          <div>
            <h2 class="fw-bold m-0" style="font-size: 1.8rem;"><i class="bi bi-box-seam-fill" style="color: var(--accent2)"></i> Live Inventory Makanan</h2>
            <p class="text-muted m-0">Persediaan real-time saat ini dari seluruh mitra donor Balikpapan</p>
          </div>
          <button class="btn-honey-outline" onclick="showTab('catalog')">Lihat Semua</button>
        </div>
        
        <div class="row g-4" id="miniLiveStockGrid">
          <!-- Dynamically populated -->
        </div>
      </div>

    </div>
  </div>

  <!-- TAB 2: MITRA DONOR DASHBOARD -->
  <div class="page-section" id="page-donor">
    <div class="dashboard-container">
      
      <!-- Sidebar -->
      <aside class="sidebar">
        <div class="sidebar-user">
          <div class="sidebar-avatar"><i class="bi bi-shop"></i></div>
          <h5 id="donorSidebarName">Restoran Sederhana</h5>
          <span id="donorSidebarId">donor_id: 2</span>
        </div>
        <ul class="sidebar-menu">
          <li class="sidebar-item active" onclick="switchDonorSubPage('summary', this)"><a href="javascript:void(0)"><i class="bi bi-speedometer2"></i> Ringkasan Data</a></li>
          <li class="sidebar-item" onclick="switchDonorSubPage('food', this)"><a href="javascript:void(0)"><i class="bi bi-egg-fried"></i> Makanan Saya</a></li>
          <li class="sidebar-item" onclick="switchDonorSubPage('log', this)"><a href="javascript:void(0)"><i class="bi bi-clock-history"></i> Riwayat Log</a></li>
          <li class="sidebar-item" onclick="switchDonorSubPage('config', this)"><a href="javascript:void(0)"><i class="bi bi-gear"></i> Konfigurasi Toko</a></li>
        </ul>
      </aside>

      <!-- Main Dashboard Content -->
      <main class="dashboard-main">
        <div class="dashboard-header">
          <div>
            <h2 class="fw-bold m-0" id="donorDashboardTitle">Ringkasan Mitra Donor <i class="bi bi-shop" style="color: var(--accent2)"></i></h2>
            <p class="text-muted">Profil Aktif: <strong id="donorProfileName">Restoran Sederhana Balikpapan</strong></p>
          </div>
          <button class="btn-honey" onclick="openInputDonasiModal()"><i class="bi bi-plus-circle"></i> Bagikan Makanan Surplus</button>
        </div>

        <!-- SUBPAGE 1: RINGKASAN DATA -->
        <div id="donor-subpage-summary" class="donor-subpage">
          <div id="donorNotificationContainer" class="mb-4 d-none"></div>
          <div class="row g-4 mb-5">
            <div class="col-md-4">
              <div class="custom-card text-center">
                <h4 class="fw-extrabold mb-1" id="donorStatTotal" style="color:var(--accent2); font-size:2rem;">0</h4>
                <small class="text-muted">Total Donasi Anda</small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="custom-card text-center">
                <h4 class="fw-extrabold mb-1" id="donorStatActive" style="color:var(--green); font-size:2rem;">0</h4>
                <small class="text-muted">Donasi Sedang Aktif</small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="custom-card text-center">
                <h4 class="fw-extrabold mb-1" id="donorStatHelped" style="color:var(--dark); font-size:2rem;">0</h4>
                <small class="text-muted">Lembaga Terbantu</small>
              </div>
            </div>
          </div>

          <div class="custom-card p-0 overflow-hidden">
            <div class="p-4 border-bottom d-flex justify-content-between align-items-center bg-white">
              <h5 class="fw-bold m-0">Ringkasan Persediaan Makanan Surplus</h5>
              <span class="badge-status available">Aktif</span>
            </div>
            <div class="table-responsive">
              <table class="donations-table">
                <thead>
                  <tr>
                    <th>Nama Hidangan</th>
                    <th>Jumlah/Kuantitas</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Kedaluwarsa</th>
                    <th class="text-center">Tindakan</th>
                  </tr>
                </thead>
                <tbody id="riwayatDonasiBody">
                  <!-- Loaded Dynamically via AJAX -->
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- SUBPAGE 2: MAKANAN SAYA -->
        <div id="donor-subpage-food" class="donor-subpage d-none">
          <div class="custom-card p-0 overflow-hidden">
            <div class="p-4 border-bottom d-flex justify-content-between align-items-center bg-white">
              <h5 class="fw-bold m-0">Kelola Semua Stok Makanan Surplus Anda</h5>
              <span class="badge-status available">Aktif</span>
            </div>
            <div class="table-responsive">
              <table class="donations-table">
                <thead>
                  <tr>
                    <th>Nama Hidangan</th>
                    <th>Jumlah/Kuantitas</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Kedaluwarsa</th>
                    <th class="text-center">Tindakan</th>
                  </tr>
                </thead>
                <tbody id="riwayatDonasiFullBody">
                  <!-- Loaded Dynamically via AJAX -->
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- SUBPAGE 3: RIWAYAT LOG -->
        <div id="donor-subpage-log" class="donor-subpage d-none">
          <div class="custom-card p-0 overflow-hidden">
            <div class="p-4 border-bottom d-flex justify-content-between align-items-center bg-white">
              <h5 class="fw-bold m-0">Daftar Klaim Makanan oleh Lembaga Penerima</h5>
              <span class="badge-status info">Terintegrasi</span>
            </div>
            <div class="table-responsive">
              <table class="donations-table">
                <thead>
                  <tr>
                    <th>ID Klaim</th>
                    <th>Nama Hidangan</th>
                    <th>Lembaga Pengklaim</th>
                    <th>Jumlah Porsi</th>
                    <th>Metode</th>
                    <th>Status</th>
                    <th class="text-center">Tindakan</th>
                  </tr>
                </thead>
                <tbody id="donorClaimsLogBody">
                  <!-- Loaded Dynamically via AJAX -->
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- SUBPAGE 4: KONFIGURASI TOKO -->
        <div id="donor-subpage-config" class="donor-subpage d-none">
          <div class="custom-card p-4">
            <h5 class="fw-bold mb-4">Pengaturan Profil &amp; Konfigurasi Toko</h5>
            <form id="donorConfigForm" onsubmit="saveDonorConfig(event)">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label fw-semibold">Nama Toko/Restoran</label>
                  <input type="text" class="form-control rounded-pill px-3 py-2" id="configDonorNameInput" required style="border: 2px solid rgba(56,38,21,0.08);">
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label fw-semibold">Nomor Telepon Kontak</label>
                  <input type="text" class="form-control rounded-pill px-3 py-2" id="configDonorPhoneInput" required style="border: 2px solid rgba(56,38,21,0.08);">
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold">Alamat Toko (Lokasi Pengambilan)</label>
                <input type="text" class="form-control rounded-pill px-3 py-2" id="configDonorAddressInput" required style="border: 2px solid rgba(56,38,21,0.08);">
              </div>
              <div class="text-end">
                <button type="submit" class="btn-honey px-4 py-2 mt-2">Simpan Perubahan <i class="bi bi-save"></i></button>
              </div>
            </form>
          </div>
        </div>
      </main>
    </div>
  </div>

  <!-- TAB 3: KATALOG (LIVE INVENTORY) -->
  <div class="page-section" id="page-catalog">
    <div class="catalog-container">
      
      <div class="catalog-top">
        <div>
          <h2 class="fw-bold m-0"><i class="bi bi-bag-heart-fill" style="color:var(--accent2)"></i> Live Inventory Makanan</h2>
          <p class="text-muted m-0">Persediaan makanan dari database seeder yang layak konsumsi</p>
        </div>
        <div class="user-profile-badge" id="catalogUserBadge">
          <div class="user-avatar-sm"><i class="bi bi-person-fill"></i></div>
          <div>
            <div class="fw-bold" style="font-size:0.85rem">Tamu (Belum Login)</div>
            <small class="text-muted" style="font-size:0.75rem">Silakan login terlebih dahulu</small>
          </div>
        </div>
      </div>

      <!-- Search & Filters -->
      <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div class="filter-wrapper m-0">
          <button class="filter-pill active" onclick="filterCatalog('semua')">Semua</button>
          <button class="filter-pill" onclick="filterCatalog('makanan_berat')">Makanan Berat</button>
          <button class="filter-pill" onclick="filterCatalog('roti')">Roti &amp; Kue</button>
          <button class="filter-pill" onclick="filterCatalog('snack')">Snack</button>
          <button class="filter-pill" onclick="filterCatalog('minuman')">Minuman</button>
        </div>
        <div class="position-relative" style="max-width: 320px; width: 100%;">
          <i class="bi bi-search position-absolute" style="left: 18px; top: 50%; transform: translateY(-50%); color: var(--dark-muted); z-index: 5;"></i>
          <input type="text" id="catalogSearchInput" class="form-control rounded-pill" placeholder="Cari makanan..." oninput="searchCatalog(this.value)" style="padding-left: 45px; padding-right: 20px; border: 2px solid rgba(56,38,21,0.08); width: 100%;">
        </div>
      </div>

      <!-- Food Grid -->
      <div class="food-grid" id="catalogFoodGrid">
        <!-- Loaded Dynamically via AJAX -->
      </div>

    </div>
  </div>

  <!-- TAB 4: DETAIL CLAIM & DISTRIBUSI TIMELINE -->
  <div class="page-section" id="page-detail">
    <div class="detail-container">
      
      <div class="mb-4">
        <h2><i class="bi bi-geo-alt-fill" style="color:var(--accent2)"></i> Detail Klaim &amp; Distribusi</h2>
        <p class="text-muted">Proses pengisian klaim serta pelacakan real-time dari distribusi</p>
      </div>

      <!-- Lembaga Statistics Dashboard (Glassmorphic & Premium) -->
      <div class="row g-4 mb-4" id="lembagaStatsWrapper">
        <div class="col-md-3">
          <div class="custom-card text-center" style="background: linear-gradient(135deg, rgba(30, 125, 92, 0.05) 0%, rgba(30, 125, 92, 0.12) 100%); border: 1px solid rgba(30, 125, 92, 0.15) !important; padding: 20px;">
            <div class="d-inline-flex p-3 rounded-circle bg-white text-success mb-2 shadow-sm" style="font-size: 1.3rem; width: 45px; height: 45px; align-items:center; justify-content:center;">
              <i class="bi bi-heart-fill"></i>
            </div>
            <h4 class="fw-extrabold mb-1 text-success" id="lembagaStatPortions" style="font-size: 1.6rem;">0</h4>
            <small class="text-muted fw-bold" style="font-size: 0.78rem;">Porsi Diselamatkan</small>
          </div>
        </div>
        <div class="col-md-3">
          <div class="custom-card text-center" style="background: linear-gradient(135deg, rgba(244, 123, 48, 0.05) 0%, rgba(244, 123, 48, 0.12) 100%); border: 1px solid rgba(244, 123, 48, 0.15) !important; padding: 20px;">
            <div class="d-inline-flex p-3 rounded-circle bg-white text-warning mb-2 shadow-sm" style="font-size: 1.3rem; width: 45px; height: 45px; align-items:center; justify-content:center; color: var(--accent2);">
              <i class="bi bi-send-fill"></i>
            </div>
            <h4 class="fw-extrabold mb-1" id="lembagaStatClaims" style="font-size: 1.6rem; color: var(--accent2);">0</h4>
            <small class="text-muted fw-bold" style="font-size: 0.78rem;">Total Pengajuan</small>
          </div>
        </div>
        <div class="col-md-3">
          <div class="custom-card text-center" style="background: linear-gradient(135deg, rgba(25, 103, 210, 0.05) 0%, rgba(25, 103, 210, 0.12) 100%); border: 1px solid rgba(25, 103, 210, 0.15) !important; padding: 20px;">
            <div class="d-inline-flex p-3 rounded-circle bg-white text-primary mb-2 shadow-sm" style="font-size: 1.3rem; width: 45px; height: 45px; align-items:center; justify-content:center;">
              <i class="bi bi-patch-check-fill"></i>
            </div>
            <h4 class="fw-extrabold mb-1 text-primary" id="lembagaStatApproved" style="font-size: 1.6rem;">0</h4>
            <small class="text-muted fw-bold" style="font-size: 0.78rem;">Klaim Disetujui</small>
          </div>
        </div>
        <div class="col-md-3">
          <div class="custom-card text-center" style="background: linear-gradient(135deg, rgba(107, 82, 59, 0.05) 0%, rgba(107, 82, 59, 0.12) 100%); border: 1px solid rgba(107, 82, 59, 0.15) !important; padding: 20px;">
            <div class="d-inline-flex p-3 rounded-circle bg-white text-dark mb-2 shadow-sm" style="font-size: 1.3rem; width: 45px; height: 45px; align-items:center; justify-content:center; color: var(--dark-muted);">
              <i class="bi bi-truck"></i>
            </div>
            <h4 class="fw-extrabold mb-1" id="lembagaStatDelivery" style="font-size: 1.6rem; color: var(--dark-muted);">0</h4>
            <small class="text-muted fw-bold" style="font-size: 0.78rem;">Kirim Kurir</small>
          </div>
        </div>
        
        <!-- Category & Methods breakdown detail -->
        <div class="col-12 mt-2">
          <div class="custom-card bg-white p-4">
            <div class="row">
              <div class="col-md-6 border-end">
                <h6 class="fw-bold mb-3"><i class="bi bi-pie-chart-fill text-success"></i> Kategori Makanan Diselamatkan</h6>
                <div id="lembagaCategoryBars" style="max-height: 180px; overflow-y: auto;">
                  <div class="text-muted small">Belum ada kategori diselamatkan.</div>
                </div>
              </div>
              <div class="col-md-6 ps-md-4">
                <h6 class="fw-bold mb-3"><i class="bi bi-arrow-left-right text-warning"></i> Metode Penyaluran (Porsi)</h6>
                <div class="d-flex justify-content-around align-items-center h-75 gap-3">
                  <div class="text-center p-3 rounded-4 bg-light flex-grow-1" style="border: 1px solid rgba(56,38,21,0.05);">
                    <i class="bi bi-shop fs-4 text-warning"></i>
                    <h5 class="fw-extrabold mt-1 mb-0" id="lembagaStatPickupCount">0</h5>
                    <small class="text-muted fw-bold" style="font-size: 0.75rem;">Ambil Mandiri</small>
                  </div>
                  <div class="text-center p-3 rounded-4 bg-light flex-grow-1" style="border: 1px solid rgba(56,38,21,0.05);">
                    <i class="bi bi-bicycle fs-4 text-success"></i>
                    <h5 class="fw-extrabold mt-1 mb-0" id="lembagaStatDeliveryCount">0</h5>
                    <small class="text-muted fw-bold" style="font-size: 0.75rem;">Kirim Kurir</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Active Claim Selector (If multiple claims exist) -->
      <div class="mb-4 d-none" id="activeClaimSelectorWrapper">
        <label class="form-label fw-bold text-dark"><i class="bi bi-search"></i> Pilih Klaim Aktif Anda:</label>
        <select class="form-select rounded-pill px-4 py-2" id="activeClaimSelector" onchange="renderActiveClaimTimeline(this.value)">
          <!-- Loaded Dynamically -->
        </select>
      </div>

      <!-- Detail Card (Filled dynamically) -->
      <div class="detail-hero" id="claimDetailCard">
        <div class="detail-img-box" id="detailFoodIcon"><i class="bi bi-box-seam-fill"></i></div>
        <div class="detail-info flex-grow-1">
          <span class="badge-status available mb-2 d-inline-block">Tersedia</span>
          <h2 id="detailFoodName">Nasi Box Ayam Goreng</h2>
          <div class="detail-origin" id="detailFoodOrigin"><i class="bi bi-geo-alt-fill"></i> Restoran Sederhana Balikpapan • donor_id: 2</div>
          <div class="detail-pills">
            <span class="detail-pill" id="detailFoodQty"><i class="bi bi-heart-fill" style="color:var(--accent2)"></i> 30 porsi</span>
            <span class="detail-pill" id="detailFoodCategory"><i class="bi bi-folder-fill"></i> makanan_berat</span>
            <span class="detail-pill" id="detailFoodExp"><i class="bi bi-clock-fill"></i> Expired: 4 jam lagi</span>
          </div>
          <p class="detail-description">Surplus hidangan bernutrisi tinggi dari Restoran Sederhana Balikpapan. Bersih, higienis, dan dikemas rapi dalam kemasan ramah lingkungan. Sangat baik untuk langsung dikonsumsi.</p>
        </div>
      </div>

      <!-- Warm/Caramel Claim Form -->
      <div class="honey-form-wrapper" id="claimFormBox">
        <h3 class="fw-bold text-dark"><i class="bi bi-pencil-square" style="color: var(--accent2)"></i> Form Klaim Makanan Instan</h3>
        
        <div id="claimSuccessBox" class="alert-success-honey mb-4">
          <i class="bi bi-check-circle-fill"></i> Sukses! Pengajuan klaim telah dikirim ke sistem. Silakan lacak statusnya pada timeline di bawah.
        </div>

        <form id="instantClaimForm" onsubmit="submitClaimForm(event)">
          <input type="hidden" id="claimFoodIdInput">
          <div class="row">
            <div class="col-md-6 honey-input-group">
              <label>Nama Lembaga Pemohon</label>
              <input type="text" class="honey-input" id="claimLembagaNameInput" value="Panti Asuhan Harapan Bangsa (lembaga_id: 4)" readonly>
            </div>
            <div class="col-md-6 honey-input-group">
              <label>Porsi yang Diambil (Maksimal Stok)</label>
              <input type="number" class="honey-input" id="claimQtyInput" value="15" min="1" max="30" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 honey-input-group">
              <label>Metode Penyaluran</label>
              <select class="honey-input" id="claimMethodSelect">
                <option value="pickup"><i class="bi bi-car-front-fill"></i> Pickup (Ambil Langsung ke Restoran)</option>
                <option value="delivery" selected><i class="bi bi-truck"></i> Delivery (Penyaluran Relawan &amp; Kurir)</option>
              </select>
            </div>
            <div class="col-md-6 honey-input-group">
              <label>Catatan Tambahan untuk Donor &amp; Relawan</label>
              <input type="text" class="honey-input" id="claimNotesInput" placeholder="Contoh: Kami sangat membutuhkan ini untuk makan siang panti asuhan." value="Mohon bantuan relawan untuk mengantarkan ke sekretariat Panti Asuhan Harapan Bangsa.">
            </div>
          </div>
          
          <div class="text-end mt-3">
            <button type="submit" class="btn-honey px-5 py-3">Kirim &amp; Proses Klaim Sekarang <i class="bi bi-send-fill"></i></button>
          </div>
        </form>
      </div>

      <!-- Timeline tracking -->
      <div>
        <h4 class="timeline-title"><i class="bi bi-truck" style="color:var(--green)"></i> Pelacakan Distribusi Real-Time</h4>
        <div class="timeline-wrapper" id="distributionTimeline">
          <!-- Populated dynamically based on claims -->
        </div>
      </div>

    </div>
  </div>

  <!-- TAB: BERITA & EDUKASI (PUBLIC NEWS PORTAL) -->
  <div class="page-section" id="page-news">
    <div class="news-container">
      
      <!-- Headline Banner -->
      <div class="news-headline-banner">
        <div class="headline-content">
          <div>
            <span class="headline-tag"><i class="bi bi-fire text-warning"></i> ARTIKEL TERPOPULER</span>
            <h1 class="headline-title">5 Cara Restoran Mengurangi Food Waste di Kota Balikpapan</h1>
            <p class="headline-snippet">Pelajari strategi nyata yang telah diterapkan oleh mitra donor FoodShare dalam mengurangi limbah makanan hingga 40% setiap bulannya, dari perencanaan porsi hingga kolaborasi dengan lembaga sosial setempat.</p>
            <div class="headline-meta">
              <span><i class="bi bi-person-fill text-warning"></i> Admin FoodShare</span>
              <span><i class="bi bi-calendar-event text-warning"></i> 28 Mei 2026</span>
              <span><i class="bi bi-eye-fill text-primary"></i> 1.2K Pembaca</span>
            </div>
            <button class="btn-honey mt-4" onclick="readArticleFull(1)">Baca Artikel Utama →</button>
          </div>
          <div class="headline-img-wrapper">📰</div>
        </div>
      </div>

      <!-- Articles Grid Section -->
      <div class="news-grid-section">
        <div class="news-grid-header">
          <div>
            <h2><i class="bi bi-journal-richtext text-success"></i> Semua Artikel & Berita</h2>
            <p class="text-muted m-0">Informasi terkini seputar gerakan hemat makanan dan kegiatan sosial</p>
          </div>
          <div class="news-filter-pills">
            <button class="news-filter-pill active" onclick="filterNews('semua', this)">Semua</button>
            <button class="news-filter-pill" onclick="filterNews('edukasi', this)">Edukasi</button>
            <button class="news-filter-pill" onclick="filterNews('sosial', this)">Kegiatan Sosial</button>
            <button class="news-filter-pill" onclick="filterNews('tips', this)">Tips Mitra</button>
          </div>
        </div>

        <div class="articles-grid" id="publicArticlesGrid">
          <!-- Dynamically populated via AJAX API -->
        </div>
      </div>
    </div>
  </div>

  <!-- TAB: DETAIL BACA ARTIKEL (MOBILE-FRIENDLY MANDIRI) -->
  <div class="page-section" id="page-read-article" style="background-color: #FFFDF6;">
    <div class="container py-5" style="max-width: 800px; padding-left: 20px; padding-right: 20px;">
      
      <!-- Back Button -->
      <div class="mb-5">
        <button class="btn-honey-outline rounded-pill px-4 py-2.5 d-flex align-items-center gap-2 fw-bold" onclick="showTab('news')" style="border-width: 2px;">
          <i class="bi bi-chevron-left"></i> Kembali ke Berita &amp; Edukasi
        </button>
      </div>

      <!-- Article Header Cover -->
      <div id="fullArticleCover" class="mb-5 position-relative" style="width: 100%; height: 380px; border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-deep);">
        <!-- Loaded Dynamically -->
      </div>

      <!-- Article Info row -->
      <div class="d-flex align-items-center gap-4 mb-4 flex-wrap pb-3 border-bottom text-muted" style="font-size: 0.9rem; font-weight: 600;">
        <span class="badge text-white" id="fullArticleCategory" style="font-size: 0.82rem; padding: 6px 16px; border-radius: 30px; font-weight: 700;">EDUKASI</span>
        <span id="fullArticleDate" class="d-flex align-items-center gap-2"><i class="bi bi-calendar-event"></i> 28 Mei 2026</span>
        <span id="fullArticleAuthor" class="d-flex align-items-center gap-2"><i class="bi bi-person-fill text-warning"></i> Admin</span>
        <span id="fullArticleViews" class="d-flex align-items-center gap-2 ms-md-auto text-primary"><i class="bi bi-eye-fill"></i> 0 Dibaca</span>
      </div>

      <!-- Article Title -->
      <h1 class="fw-extrabold text-dark mb-5" id="fullArticleTitle" style="font-size: 2.6rem; line-height: 1.25; font-family: 'Plus Jakarta Sans', sans-serif; letter-spacing: -0.5px;">Judul Artikel</h1>

      <!-- Article Content Body -->
      <div class="full-article-content text-dark" id="fullArticleContent" style="text-align: justify; font-size: 1.15rem; line-height: 1.85; white-space: pre-line; letter-spacing: -0.1px; color: #2C1F15;">
        Konten artikel lengkap akan dimuat di sini...
      </div>

      <!-- Article Actions (Share & CTA) -->
      <div class="mt-5 pt-4 border-top">
        <div class="row align-items-center g-4">
          <!-- Share Widget -->
          <div class="col-md-6 text-center text-md-start">
            <h6 class="fw-bold text-dark mb-3"><i class="bi bi-share-fill text-warning"></i> Bagikan Artikel Ini:</h6>
            <div class="d-flex gap-2 justify-content-center justify-content-md-start">
              <a href="#" onclick="showCustomToast('Fitur Berbagi', 'Tautan artikel berhasil disalin ke papan klip!', 'success'); return false;" class="footer-social-btn" style="width: 38px; height: 38px; background: rgba(56,38,21,0.06); color: var(--dark); display: inline-flex; align-items: center; justify-content: center; border-radius: 50%;"><i class="bi bi-link-45deg"></i></a>
              <a href="#" onclick="showCustomToast('Fitur Berbagi', 'Membuka WhatsApp...', 'info'); return false;" class="footer-social-btn" style="width: 38px; height: 38px; background: #25D366; color: white; display: inline-flex; align-items: center; justify-content: center; border-radius: 50%;"><i class="bi bi-whatsapp"></i></a>
              <a href="#" onclick="showCustomToast('Fitur Berbagi', 'Membuka Telegram...', 'info'); return false;" class="footer-social-btn" style="width: 38px; height: 38px; background: #0088cc; color: white; display: inline-flex; align-items: center; justify-content: center; border-radius: 50%;"><i class="bi bi-telegram"></i></a>
              <a href="#" onclick="showCustomToast('Fitur Berbagi', 'Membuka Facebook...', 'info'); return false;" class="footer-social-btn" style="width: 38px; height: 38px; background: #3b5998; color: white; display: inline-flex; align-items: center; justify-content: center; border-radius: 50%;"><i class="bi bi-facebook"></i></a>
            </div>
          </div>
          
          <!-- Quick stats -->
          <div class="col-md-6 text-center text-md-end text-muted fw-semibold" style="font-size: 0.88rem;">
            <div class="d-inline-flex align-items-center gap-2 bg-light px-3 py-2 rounded-pill border">
              <i class="bi bi-shield-heart-fill text-danger"></i> Didukung oleh gerakan <strong>Zero Waste Balikpapan</strong>
            </div>
          </div>
        </div>
      </div>

      <!-- Action Call-To-Action Card -->
      <div class="custom-card mt-5 p-4 position-relative overflow-hidden" style="background: linear-gradient(135deg, #FFF3D6 0%, #FFECC4 100%); border: 1.5px dashed var(--accent);">
        <div class="position-absolute" style="top: -20px; right: -20px; font-size: 8rem; opacity: 0.05; color: var(--dark);"><i class="bi bi-gift-fill"></i></div>
        <div class="row align-items-center">
          <div class="col-lg-8 mb-3 mb-lg-0 text-center text-lg-start">
            <h5 class="fw-extrabold text-dark mb-1"><i class="bi bi-box2-heart-fill text-warning"></i> Ingin Berkontribusi Lebih Nyata?</h5>
            <p class="text-muted mb-0" style="font-size: 0.92rem;">Daftarkan restoran, bakery, atau katering Anda hari ini untuk menjadi bagian dari aksi sosial penyelamatan surplus makanan layak konsumsi.</p>
          </div>
          <div class="col-lg-4 text-center text-lg-end">
            <button class="btn-honey px-4 py-2.5 shadow-sm" onclick="showTab('donor')">Gabung Mitra <i class="bi bi-arrow-right-short"></i></button>
          </div>
        </div>
      </div>
      
    </div>
  </div>



  <!-- TAB: DEDICATED REGISTRATION PAGE (NON-MODAL LUAS) -->
  <div class="page-section" id="page-register">
    <div class="container-fluid max-width-lg py-5">
      <div class="register-container">
        <!-- Exit button since navbar is hidden -->
        <div class="mb-4 text-start">
          <button class="btn-back-role" onclick="showTab('landing')" style="margin-bottom:0;"><i class="bi bi-chevron-left"></i> Kembali ke Beranda</button>
        </div>
        
        <!-- Header Page -->
        <div class="text-center mb-5">
          <span class="badge" style="background:var(--green-light); color:var(--green); font-size:0.85rem; padding:8px 18px; border-radius:40px; font-weight:700; letter-spacing:0.5px;"><i class="bi bi-person-plus-fill"></i> JOIN THE MOVEMENT</span>
          <h1 class="fw-extrabold text-dark mt-3 mb-2" style="font-size: 2.4rem;">Pendaftaran Akun Baru FoodShare</h1>
          <p class="text-muted" style="max-width: 600px; margin: 0 auto; font-size: 0.95rem;">Daftarkan organisasi Anda untuk memulai aksi sosial penyelamatan surplus makanan layak konsumsi di Balikpapan.</p>
        </div>

        <!-- 1. ROLE SELECTION STEP -->
        <div id="registerRoleSelection" class="row g-4 justify-content-center">
          <div class="col-md-6 col-lg-5">
            <div class="role-selection-card card-donor" onclick="selectRegisterRole('donor')">
              <div class="role-icon-box"><i class="bi bi-shop"></i></div>
              <h3 class="fw-extrabold text-dark mb-3">Mitra Donor</h3>
              <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.6;">
                Dikhususkan bagi pemilik Restaurant, Bakery, Cafe, Katering, Toko Pangan, atau Hotel yang ingin mendonasikan kelebihan surplus makanan layak konsumsi mereka secara aman.
              </p>
              <button class="btn-honey px-4 py-2.5 rounded-pill mt-4">Daftar Jadi Donor &rarr;</button>
            </div>
          </div>

          <div class="col-md-6 col-lg-5">
            <div class="role-selection-card card-lembaga" onclick="selectRegisterRole('lembaga')">
              <div class="role-icon-box"><i class="bi bi-building"></i></div>
              <h3 class="fw-extrabold text-dark mb-3">Lembaga Sosial</h3>
              <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.6;">
                Dikhususkan bagi Yayasan Resmi, Panti Asuhan, Pondok Pesantren, atau Komunitas Kemanusiaan tepercaya yang membutuhkan pasokan surplus makanan untuk disalurkan.
              </p>
              <button class="btn-sage px-4 py-2.5 rounded-pill mt-4" style="border-radius: 30px;">Daftar Jadi Penerima &rarr;</button>
            </div>
          </div>
        </div>

        <!-- 2. DYNAMIC REGISTRATION FORM -->
        <div id="registerFormCard" class="register-form-card d-none">
          <button class="btn-back-role" onclick="showRegisterRoleSelection()"><i class="bi bi-arrow-left"></i> Kembali Pilih Peran</button>
          
          <div class="border-bottom pb-3 mb-4">
            <h3 class="fw-extrabold text-dark mb-1" id="regFormTitle">Pendaftaran</h3>
            <p class="text-muted mb-0" id="regFormSubtitle" style="font-size: 0.9rem;"></p>
          </div>

          <form onsubmit="submitRegistrationRequestNew(event)">
            <input type="hidden" id="regInputRole" value="lembaga">
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-dark" style="font-size:0.88rem;" id="regOrgNameLabel">Nama Usaha / Organisasi</label>
                <input type="text" class="form-control rounded-pill px-4" id="regOrgNameNew" placeholder="Nama Resmi Usaha/Yayasan..." required style="border: 2px solid rgba(56,38,21,0.08); height: 48px;">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-dark" style="font-size:0.88rem;">Nama Penanggung Jawab / Kontak Person</label>
                <input type="text" class="form-control rounded-pill px-4" id="regContactNew" placeholder="Contoh: Budi Santoso..." required style="border: 2px solid rgba(56,38,21,0.08); height: 48px;">
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-dark" style="font-size:0.88rem;">Email Kontak Pribadi (Notifikasi Akun)</label>
                <input type="email" class="form-control rounded-pill px-4" id="regEmailNew" placeholder="Contoh: pengurus@organisasi.org..." required style="border: 2px solid rgba(56,38,21,0.08); height: 48px;">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-dark" style="font-size:0.88rem;">Nomor WhatsApp / HP Aktif</label>
                <input type="tel" class="form-control rounded-pill px-4" id="regPhoneNew" placeholder="Contoh: 081234567890..." required style="border: 2px solid rgba(56,38,21,0.08); height: 48px;">
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label fw-bold text-dark" style="font-size:0.88rem;">Link Google Maps Pin Koordinat (Lokasi Fisik Asli)</label>
              <input type="url" class="form-control rounded-pill px-4" id="regMapsLinkNew" placeholder="Contoh: https://maps.app.goo.gl/..." required style="border: 2px solid rgba(56,38,21,0.08); height: 48px;">
              <small class="text-muted ps-2 d-block mt-1" style="font-size: 0.78rem;" id="regMapsHint">*Wajib diisi dengan tautan maps yang valid untuk memverifikasi keaslian alamat fisik.</small>
            </div>

            <div class="mb-4">
              <label class="form-label fw-bold text-dark" style="font-size:0.88rem;">Alamat Lengkap Usaha / Organisasi</label>
              <textarea class="form-control px-4 py-3" id="regAddressNew" rows="3" placeholder="Tulis alamat fisik lengkap organisasi Anda..." required style="border: 2px solid rgba(56,38,21,0.08); border-radius: 16px; resize: none;"></textarea>
            </div>

            <!-- Verification Info Warning Card -->
            <div class="p-3 mb-4 rounded-3 d-flex gap-3 align-items-center bg-white" style="border: 1px solid rgba(56, 38, 21, 0.08); background-image: linear-gradient(135deg, rgba(238,203,136,0.05) 0%, rgba(244,123,48,0.05) 100%);">
              <div style="font-size: 2rem; color: var(--accent2);"><i class="bi bi-info-circle-fill"></i></div>
              <div style="font-size: 0.85rem; line-height: 1.5; color: var(--dark-muted);">
                <strong>Alur Verifikasi Keaslian Fisik:</strong> Tim Administrator kami wajib memverifikasi keaslian titik koordinat Google Maps dan alamat fisik Anda. Setelah terverifikasi asli, detail akun login resmi dengan email berakhiran <strong>@foodshare.id</strong> dan password aman akan langsung dikirimkan ke email kontak Anda di atas.
              </div>
            </div>
            
            <button type="submit" class="btn-honey w-100 py-3 mt-2 fw-bold" style="font-size: 1.05rem;" id="btnSubmitRegNew">Kirim Permohonan Pendaftaran <i class="bi bi-send-fill"></i></button>
          </form>
        </div>

        <!-- 3. PREMIUM SUCCESS SCREEN -->
        <div id="registerSuccessScreen" class="register-form-card text-center py-5 px-4 d-none">
          <div class="mb-4" style="font-size: 5rem; color: var(--green); filter: drop-shadow(0 4px 15px rgba(30, 125, 92, 0.2));">
            <i class="bi bi-check-circle-fill"></i>
          </div>
          <h2 class="fw-extrabold text-dark mb-3">Permohonan Registrasi Sukses Dikirim!</h2>
          <p class="text-muted mx-auto mb-4" style="max-width: 650px; font-size: 1rem; line-height: 1.7;">
            Terima kasih! Permohonan pendaftaran akun baru Anda sebagai <strong id="successRoleLabel" class="text-uppercase" style="color: var(--accent2);">Lembaga</strong> untuk <strong id="successOrgLabel">Organisasi</strong> telah masuk antrean sistem verifikasi manual kami.
          </p>

          <div class="row justify-content-center mb-5">
            <div class="col-md-8">
              <div class="p-4 rounded-4 bg-white text-start shadow-sm border" style="border-radius: var(--radius-sm);">
                <h6 class="fw-bold text-dark mb-3"><i class="bi bi-compass-fill text-warning me-2"></i> Langkah Selanjutnya:</h6>
                <ul class="text-muted ps-3 mb-0" style="font-size: 0.88rem; line-height: 1.8;">
                  <li><strong>Tinjauan Admin:</strong> Admin FoodShare HQ akan meninjau validitas alamat fisik dan koordinat Google Maps yang Anda lampirkan.</li>
                  <li><strong>Kontak via Email:</strong> Jika terbukti valid dan layak, kami akan men-generate email akun resmi baru (berakhiran <code>@foodshare.id</code>) beserta password aman.</li>
                  <li><strong>Notifikasi Kredensial:</strong> Rincian akun login tersebut akan dikirimkan langsung ke email kontak Anda: <strong id="successEmailLabel" class="text-dark"></strong>.</li>
                </ul>
              </div>
            </div>
          </div>

          <div class="d-flex gap-3 justify-content-center">
            <button class="btn-honey px-5 py-3 rounded-pill" onclick="showTab('landing')">Kembali ke Beranda <i class="bi bi-house-door-fill"></i></button>
            <button class="btn-honey-outline px-4 py-3 rounded-pill" onclick="showTab('news')">Baca Berita &amp; Edukasi <i class="bi bi-newspaper"></i></button>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- TAB 6: ADMIN PANEL -->
  <div class="page-section" id="page-admin">
    <div class="admin-layout">

      <!-- SIDEBAR -->
      <aside class="admin-sidebar">
        <div class="admin-sidebar-header">
          <div class="admin-avatar text-warning"><i class="bi bi-shield-fill-check"></i></div>
          <h5>Administrator</h5>
          <span>Super Admin</span>
        </div>

        <ul class="admin-sidebar-nav">
          <li class="active" onclick="showAdminSubTab('overview', this)">
            <span class="nav-icon"><i class="bi bi-bar-chart-fill"></i></span>
            Overview & Validasi
            <span class="nav-badge" id="sidebarPendingBadge">0</span>
          </li>
          <li onclick="showAdminSubTab('berita', this)">
            <span class="nav-icon"><i class="bi bi-newspaper"></i></span>
            Manajemen Berita
          </li>
          <li onclick="showAdminSubTab('pengguna', this)">
            <span class="nav-icon"><i class="bi bi-people-fill"></i></span>
            Kelola Pengguna
          </li>
          <li onclick="showAdminSubTab('registrasi', this)">
            <span class="nav-icon"><i class="bi bi-person-plus-fill"></i></span>
            Verifikasi Registrasi
            <span class="nav-badge" id="sidebarRegRequestsBadge" style="background:#F47B30; display:none;">0</span>
          </li>
          <li onclick="showAdminSubTab('logs', this)">
            <span class="nav-icon"><i class="bi bi-terminal-fill"></i></span>
            Log &amp; Debugging
          </li>
        </ul>

        <div class="admin-sidebar-footer px-3 w-100">
          <button class="btn btn-danger w-100 py-2 mb-3 d-flex align-items-center justify-content-center gap-2 shadow-sm fw-bold" onclick="executeLogout()" style="border-radius: 30px; font-size: 0.85rem; border: none; background: #e74c3c;">
            <i class="bi bi-box-arrow-right"></i> Keluar Sesi
          </button>
          <p>FoodShare Admin v1.0<br>© 2026 Balikpapan</p>
        </div>
      </aside>

      <!-- MAIN CONTENT -->
      <main class="admin-main">

        <!-- SUB-TAB 1: OVERVIEW & VALIDASI -->
        <div class="admin-sub-page active" id="adminSubOverview">
          <div class="admin-page-header">
            <div>
              <h2><i class="bi bi-bar-chart-fill text-warning me-2"></i> Overview &amp; Validasi Klaim</h2>
              <p>Pusat kendali statistik dan validasi pengajuan klaim makanan</p>
            </div>
            <div class="user-profile-badge">
              <div class="user-avatar-sm" style="background-color: var(--accent2);"><i class="bi bi-person-badge-fill"></i></div>
              <div>
                <div class="fw-bold" style="font-size:0.85rem">Administrator</div>
                <small class="text-muted" style="font-size:0.75rem">Level: Super Admin</small>
              </div>
            </div>
          </div>

          <!-- Stats Grid -->
          <div class="admin-stats-grid">
            <div class="stat-box" onclick="openAdminDetail('porsi')" style="cursor:pointer;">
              <div class="stat-icon-wrapper orange"><i class="bi bi-heart-pulse-fill"></i></div>
              <div class="stat-num-val" id="adminStatPorsi">247</div>
              <div class="stat-lbl">Total Porsi Diselamatkan</div>
            </div>
            <div class="stat-box" onclick="openAdminDetail('donor')" style="cursor:pointer;">
              <div class="stat-icon-wrapper green"><i class="bi bi-people-fill"></i></div>
              <div class="stat-num-val" id="adminStatDonor">12</div>
              <div class="stat-lbl">Mitra Donor Aktif</div>
            </div>
            <div class="stat-box" onclick="openAdminDetail('lembaga')" style="cursor:pointer;">
              <div class="stat-icon-wrapper blue"><i class="bi bi-building-fill"></i></div>
              <div class="stat-num-val" id="adminStatLembaga">8</div>
              <div class="stat-lbl">Lembaga Terdaftar</div>
            </div>
            <div class="stat-box" onclick="openAdminDetail('pending')" style="cursor:pointer;">
              <div class="stat-icon-wrapper gold"><i class="bi bi-hourglass-top"></i></div>
              <div class="stat-num-val" id="adminStatPending">3</div>
              <div class="stat-lbl">Klaim Pending</div>
            </div>
          </div>

          <!-- Validation Table & Activity Log Row -->
          <div class="row g-4 mt-2">
            <div class="col-12">
              <div class="custom-card p-0 overflow-hidden">
                <div class="p-4 border-bottom d-flex justify-content-between align-items-center bg-white">
                  <h5 class="fw-bold m-0"><i class="bi bi-shield-check" style="color:var(--accent2)"></i> Validasi Pengajuan Klaim Database</h5>
                  <span class="badge-pending-honey" id="validationPendingBadge">0 Menunggu Validasi</span>
                </div>
                <div class="table-responsive">
                  <table class="donations-table text-start" style="width:100%;">
                    <thead>
                      <tr>
                        <th>ID Klaim</th>
                        <th>Makanan / Sumber</th>
                        <th>Pemohon Klaim</th>
                        <th>Jumlah Porsi</th>
                        <th>Status</th>
                        <th class="text-center">Aksi / Tindakan</th>
                      </tr>
                    </thead>
                    <tbody id="adminValidationTable">
                      <!-- Loaded Dynamically via AJAX -->
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col-12">
              <div class="custom-card p-0 overflow-hidden bg-white">
                <div class="p-4 border-bottom d-flex justify-content-between align-items-center bg-white">
                  <h5 class="fw-bold m-0"><i class="bi bi-activity" style="color:var(--green)"></i> Log Aktivitas Platform</h5>
                  <span class="badge-status available">Aktif</span>
                </div>
                <div class="p-4 bg-white" style="max-height: 400px; overflow-y: auto;">
                  <ul class="list-unstyled mb-0" id="adminActivityLogList">
                    <!-- Dynamically populated via AJAX -->
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- SUB-TAB 2: MANAJEMEN CRUD BERITA -->
        <div class="admin-sub-page" id="adminSubBerita">
          <div class="admin-page-header">
            <div>
              <h2><i class="bi bi-newspaper text-warning me-2"></i> Manajemen Berita &amp; Artikel</h2>
              <p>Kelola seluruh konten berita, edukasi, dan informasi kegiatan sosial</p>
            </div>
            <button class="btn-honey" onclick="openArticleModal('create')"><i class="bi bi-pencil-square"></i> Tulis Artikel Baru</button>
          </div>

          <!-- Article Admin Table -->
          <div class="custom-card p-0 overflow-hidden">
            <div class="p-4 border-bottom d-flex justify-content-between align-items-center bg-white">
              <h5><i class="bi bi-file-earmark-text-fill text-warning me-2"></i> Daftar Artikel Terpublikasi</h5>
              <span class="badge-published" id="totalArticleBadge">0 Artikel Aktif</span>
            </div>
            <div class="table-responsive">
              <table class="donations-table text-start" style="width:100%;">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Judul Artikel</th>
                    <th>Kategori</th>
                    <th>Penulis</th>
                    <th>Dibaca</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th class="text-center">Aksi / Tindakan</th>
                  </tr>
                </thead>
                <tbody id="adminArticleBody">
                  <!-- Loaded Dynamically via AJAX -->
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- SUB-TAB 3: KELOLA PENGGUNA -->
        <div class="admin-sub-page" id="adminSubPengguna">
          <div class="admin-page-header">
            <div>
              <h2><i class="bi bi-people-fill text-warning me-2"></i> Kelola Pengguna &amp; Akun Terdaftar</h2>
              <p>Monitoring seluruh akun mitra donor dan lembaga sosial yang terdaftar dalam sistem</p>
            </div>
          </div>

          <!-- Donor Accounts -->
          <div class="custom-card p-0 overflow-hidden mb-4">
            <div class="p-4 border-bottom d-flex justify-content-between align-items-center bg-white">
              <h5><i class="bi bi-shop text-warning me-2"></i> Akun Mitra Donor</h5>
              <span class="badge-status" style="background:#FFF3D6; color:#F47B30;" id="adminDonorCountBadge">0 Akun Terdaftar</span>
            </div>
            <div class="table-responsive">
              <table class="donations-table text-start" style="width:100%;">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nama Usaha</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Total Donasi</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody id="adminUsersDonorBody">
                  <!-- Loaded Dynamically via AJAX -->
                </tbody>
              </table>
            </div>
          </div>

          <!-- Lembaga Accounts -->
          <div class="custom-card p-0 overflow-hidden">
            <div class="p-4 border-bottom d-flex justify-content-between align-items-center bg-white">
              <h5><i class="bi bi-building text-warning me-2"></i> Akun Lembaga Sosial / Penerima</h5>
              <span class="badge-status" style="background:#E8F0FE; color:#1967D2;" id="adminLembagaCountBadge">0 Akun Terdaftar</span>
            </div>
            <div class="table-responsive">
              <table class="donations-table text-start" style="width:100%;">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nama Lembaga</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Total Diterima</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody id="adminUsersLembagaBody">
                  <!-- Loaded Dynamically via AJAX -->
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- SUB-TAB 4: VERIFIKASI REGISTRASI -->
        <div class="admin-sub-page" id="adminSubRegistrasi">
          <div class="admin-page-header">
            <div>
              <h2><i class="bi bi-person-check-fill text-warning me-2"></i> Verifikasi Permohonan Registrasi Lembaga</h2>
              <p>Validasi detail yayasan, panti asuhan, dan koordinat Google Maps untuk mencegah akun fiktif</p>
            </div>
          </div>

          <!-- Registration Requests Table -->
          <div class="custom-card p-0 overflow-hidden">
            <div class="p-4 border-bottom d-flex justify-content-between align-items-center bg-white">
              <h5><i class="bi bi-hourglass-split text-warning me-2"></i> Permohonan Pendaftaran Pending</h5>
              <span class="badge-pending-honey" id="adminRegRequestsBadge">0 Menunggu Ulasan</span>
            </div>
            <div class="table-responsive">
              <table class="donations-table text-start" style="width:100%;">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Lembaga / Yayasan</th>
                    <th>Kontak Person</th>
                    <th>Alamat &amp; Koordinat Google Maps</th>
                    <th>Kontak Email &amp; Telp</th>
                    <th class="text-center">Aksi / Tindakan</th>
                  </tr>
                </thead>
                <tbody id="adminRegRequestsBody">
                  <!-- Loaded Dynamically via AJAX -->
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- SUB-TAB 5: LOG & DEBUGGING -->
        <div class="admin-sub-page" id="adminSubLogs">
          <div class="admin-page-header d-flex justify-content-between align-items-center flex-wrap g-3">
            <div>
              <h2><i class="bi bi-terminal-fill text-warning me-2"></i> Log Sistem &amp; Debugging</h2>
              <p class="text-muted mb-0" style="font-size:0.9rem">Melihat catatan kesalahan (errors) dari berkas laravel.log secara langsung.</p>
            </div>
            <div class="d-flex gap-2">
              <button class="btn btn-warning d-flex align-items-center gap-2 px-4 py-2.5 fw-bold text-white shadow-sm" onclick="clearLaravelLog()" style="border-radius: 30px; font-size: 0.85rem; border: none; background: #e74c3c; transition: all 0.3s ease;">
                <i class="bi bi-trash3-fill"></i> Bersihkan Log
              </button>
              <button class="btn btn-success d-flex align-items-center gap-2 px-4 py-2.5 fw-bold text-white shadow-sm" onclick="loadSystemLogs()" style="border-radius: 30px; font-size: 0.85rem; border: none; background: var(--green); transition: all 0.3s ease;">
                <i class="bi bi-arrow-clockwise"></i> Segarkan Log
              </button>
            </div>
          </div>

          <!-- LOG VIEW PANEL -->
          <div class="custom-card p-4 mt-4 text-light font-monospace bg-dark" style="border-radius: 12px; border: 1px solid rgba(255,255,255,0.08); box-shadow: 0 10px 30px rgba(0,0,0,0.35);">
            <div id="systemLogsContent" style="font-family: 'JetBrains Mono', 'Courier New', monospace; font-size: 0.82rem; white-space: pre-wrap; line-height: 1.6; max-height: 550px; overflow-y: auto; color: #E5E9F0; text-align: left; direction: ltr;">
              Memuat catatan log sistem...
            </div>
          </div>
        </div>

      </main>
    </div>
  </div>

  <!-- PREMIUM FOOTER -->
  <footer class="premium-footer">
    <div class="container-fluid max-width-lg">
      <div class="row g-5">
        <div class="col-lg-4 col-md-6">
          <a href="#" class="footer-logo">
            <i class="bi bi-box2-heart-fill" style="color: var(--accent2)"></i>
            <span>FoodShare</span>
          </a>
          <p class="footer-desc">Platform zero-waste dan distribusi surplus makanan berkualitas dari restoran premium di Balikpapan dan sekitarnya untuk aksi kemanusiaan.</p>
          <div class="footer-socials">
            <a href="#" class="footer-social-btn"><i class="bi bi-instagram"></i></a>
            <a href="#" class="footer-social-btn"><i class="bi bi-facebook"></i></a>
            <a href="#" class="footer-social-btn"><i class="bi bi-github"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
          <h5 class="footer-title">Aksi Penyelamatan</h5>
          <ul class="footer-links">
            <li><a href="#" onclick="showTab('landing')">Beranda</a></li>
            <li><a href="#" onclick="showTab('catalog')">Katalog Makanan</a></li>
            <li><a href="#" onclick="showTab('donor')">Daftar Mitra Donor</a></li>
            <li><a href="#" onclick="showTab('detail')">Klaim &amp; Tracking</a></li>
            <li><a href="#" onclick="showTab('news')">Berita &amp; Edukasi</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-6">
          <h5 class="footer-title">Kontak &amp; Dukungan</h5>
          <ul class="footer-links" style="color: #D2C2B1; font-size: 0.95rem; line-height: 1.6;">
            <li><i class="bi bi-geo-alt-fill text-warning"></i> Jl. Sudirman No.12, Balikpapan</li>
            <li><i class="bi bi-telephone-fill text-warning"></i> +62 812-0000-0001</li>
            <li><i class="bi bi-envelope-fill text-warning"></i> support@foodshare.id</li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-6">
          <h5 class="footer-title">Gerakan Kami</h5>
          <div style="background: rgba(250, 247, 235, 0.05); padding: 20px; border-radius: var(--radius-sm); border: 1.5px dashed var(--accent)">
            <p style="font-size: 0.85rem; color: #D2C2B1; font-style: italic; margin: 0; line-height: 1.6;">"Menyelamatkan makanan hari ini adalah investasi untuk kelestarian bumi esok hari."</p>
          </div>
        </div>
      </div>
      
      <div class="footer-divider"></div>
      
      <div class="row align-items-center">
        <div class="col-12 text-center text-md-start">
          <p class="footer-copyright m-0">© 2026 FoodShare.</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- ARTICLE WRITE / EDIT MODAL -->
  <div class="modal fade" id="modalArticleForm" tabindex="-1" aria-labelledby="articleFormTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content custom-modal-content" style="border: none;">
        <div class="modal-header border-0 p-4 pb-0 justify-content-between">
          <h4 class="modal-title fw-bold" id="articleFormTitle"><i class="bi bi-pencil-square" style="color:var(--accent2)"></i> Tulis Artikel Baru</h4>
          <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4 pt-3">
          <form id="articleForm" onsubmit="submitArticleForm(event)">
            <div class="mb-3">
              <label class="form-label fw-bold text-dark" style="font-size:0.88rem">Judul Artikel</label>
              <input type="text" class="form-control rounded-pill px-4 py-2" id="articleTitle" placeholder="Masukkan judul artikel..." required style="border: 2px solid rgba(56,38,21,0.08);">
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-dark" style="font-size:0.88rem">Kategori</label>
                <select class="form-select rounded-pill px-4 py-2" id="articleCategory" required style="border: 2px solid rgba(56,38,21,0.08);">
                  <option value="">Pilih Kategori</option>
                  <option value="edukasi">Edukasi</option>
                  <option value="sosial">Kegiatan Sosial</option>
                  <option value="tips">Tips Mitra</option>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-dark" style="font-size:0.88rem">Penulis</label>
                <input type="text" class="form-control rounded-pill px-4 py-2" id="articleAuthor" value="Admin" readonly style="border: 2px solid rgba(56,38,21,0.08); background: rgba(56,38,21,0.04);">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label fw-bold text-dark" style="font-size:0.88rem">Konten Utama / Isi Berita</label>
              <textarea class="form-control px-4 py-3" id="articleContent" rows="6" placeholder="Tulis isi artikel di sini..." required style="border: 2px solid rgba(56,38,21,0.08); border-radius:16px; resize:vertical;"></textarea>
            </div>
            <input type="hidden" id="articleEditId" value="">
            
            <div class="text-end mt-4">
              <button type="button" class="btn-honey-outline px-4 py-2 me-2 rounded-pill" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn-honey px-5 py-2 rounded-pill"><span id="articleSubmitText">Terbitkan</span> <i class="bi bi-send-fill"></i></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- ARTICLE PREVIEW MODAL -->
  <div class="modal fade" id="modalArticlePreview" tabindex="-1" aria-labelledby="previewTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content custom-modal-content" style="border: none;">
        <div class="modal-header border-0 p-4 pb-0 justify-content-between">
          <h4 class="modal-title fw-bold"><i class="bi bi-eye-fill" style="color:var(--green)"></i> Pratinjau Artikel</h4>
          <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <div class="preview-article-img mb-4" id="previewImg" style="width:100%; height:250px; border-radius:18px; background:linear-gradient(135deg, #FFF8E8 0%, #FFE8C2 100%); display:flex; align-items:center; justify-content:center; font-size:6rem;">📰</div>
          <div class="d-flex gap-3 align-items-center mb-3 flex-wrap">
            <span class="badge" id="previewCategory" style="background:var(--green); font-size:0.8rem; padding:6px 14px; border-radius:20px;">Edukasi</span>
            <span class="text-muted" id="previewDate" style="font-size:0.88rem"><i class="bi bi-calendar-event"></i> 28 Mei 2026</span>
            <span class="text-muted" id="previewAuthor" style="font-size:0.88rem"><i class="bi bi-person"></i> Admin</span>
          </div>
          <h2 class="fw-extrabold text-dark mb-3" id="previewTitle" style="font-size:1.6rem; line-height:1.4;">Judul Artikel</h2>
          <div class="preview-article-content text-dark" id="previewContent" style="text-align: justify; font-size:1rem; line-height:1.8; white-space:pre-line; max-height:400px; overflow-y:auto; padding-right:10px;">
            Konten artikel akan ditampilkan di sini...
          </div>
        </div>
        <div class="modal-footer border-0 p-4 pt-0">
          <button type="button" class="btn-honey px-4 py-2 rounded-pill" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <!-- PICKUP DEADLINE MODAL -->
  <div class="modal fade" id="pickupDeadlineModal" tabindex="-1" aria-labelledby="pickupDeadlineModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content custom-modal-content" style="border: none;">
        <div class="modal-header border-0 p-4 pb-0 justify-content-between">
          <h4 class="modal-title fw-bold text-dark" id="pickupDeadlineModalLabel"><i class="bi bi-clock-fill text-warning"></i> Tentukan Batas Pengambilan</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <p class="text-muted" style="font-size: 0.92rem;">Lembaga mengajukan klaim dengan metode <strong>Ambil Mandiri (Pickup)</strong>. Silakan tentukan batas waktu untuk mereka mengambil donasi makanan surplus ini.</p>
          <div class="mb-3">
            <label class="form-label fw-bold text-dark" style="font-size:0.88rem;">Pilih / Tulis Batas Waktu Pengambilan</label>
            <select class="form-select rounded-pill px-4 py-2.5 mb-2" id="pickupDeadlineSelect" onchange="toggleCustomDeadline(this.value)" style="border: 2px solid rgba(56,38,21,0.08); height: 48px;">
              <option value="1 jam dari sekarang">1 Jam dari sekarang</option>
              <option value="2 jam dari sekarang" selected>2 Jam dari sekarang</option>
              <option value="3 jam dari sekarang">3 Jam dari sekarang</option>
              <option value="Sebelum toko tutup (Pukul 21:00 WITA)">Sebelum toko tutup (Pukul 21:00 WITA)</option>
              <option value="custom">Tulis Kustom...</option>
            </select>
            <input type="text" class="form-control rounded-pill px-4 py-2.5 d-none mt-2" id="pickupDeadlineCustomInput" placeholder="Misal: Hari ini pukul 19:30 WITA" style="border: 2px solid rgba(56,38,21,0.08); height: 48px;">
          </div>
          <div class="text-end mt-4">
            <button type="button" class="btn-honey-outline px-4 py-2 me-2 rounded-pill" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn-honey px-5 py-2 rounded-pill" onclick="submitPickupApproval()">Setujui &amp; Kirim <i class="bi bi-send-fill"></i></button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- AUTHENTICATION LOGIN MODAL -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content custom-modal-content">
        <div class="modal-header border-0 p-0 mb-4 justify-content-between">
          <h4 class="modal-title fw-bold" id="loginModalLabel"><i class="bi bi-key-fill"></i> Masuk ke Akun FoodShare</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body p-0">
          <div class="mb-4">
            <p class="text-muted" style="font-size:0.92rem">Masukkan alamat email dan kata sandi Anda untuk mengakses dashboard FoodShare.</p>
          </div>

          <form onsubmit="executeManualLogin(event)">
            <div class="mb-3">
              <label class="form-label fw-bold text-dark" style="font-size:0.88rem">Alamat Email</label>
              <input type="email" class="form-control rounded-pill px-4" id="manualEmailInput" placeholder="Contoh: nama@organisasi.id" required style="border: 2px solid rgba(56,38,21,0.08);">
            </div>
            <div class="mb-3">
              <label class="form-label fw-bold text-dark" style="font-size:0.88rem">Kata Sandi</label>
              <div class="position-relative">
                <input type="password" class="form-control rounded-pill ps-4 pe-5" id="manualPassInput" placeholder="Masukkan sandi..." required style="border: 2px solid rgba(56,38,21,0.08);">
                <button type="button" class="position-absolute end-0 top-50 translate-middle-y border-0 bg-transparent pe-4 text-muted" id="togglePasswordBtn" onclick="togglePasswordVisibility()" style="z-index: 10;">
                  <i class="bi bi-eye" id="passwordEyeIcon" style="font-size: 1.2rem; cursor: pointer;"></i>
                </button>
              </div>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mb-3 px-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="rememberMeCheckbox" style="cursor: pointer;">
                <label class="form-check-label text-muted" for="rememberMeCheckbox" style="font-size: 0.85rem; cursor: pointer;">Ingat Saya</label>
              </div>
              <a href="#" onclick="showCustomToast('Fitur Demo', 'Silakan hubungi administrator jika Anda lupa kata sandi.', 'info'); return false;" class="text-decoration-none" style="font-size: 0.85rem; color: var(--accent2); font-weight: 600;">Lupa Sandi?</a>
            </div>
            
            <button type="submit" class="btn-honey w-100 py-3 mt-2 mb-3">Masuk Sekarang <i class="bi bi-box-arrow-in-right"></i></button>
            <div class="text-center">
              <span class="text-muted" style="font-size: 0.88rem;">Belum memiliki akun lembaga? </span>
              <a href="#" onclick="showTab('register'); bootstrap.Modal.getInstance(document.getElementById('loginModal')).hide();" class="text-decoration-none fw-bold" style="font-size: 0.88rem; color: var(--accent2);">Daftar Lembaga Sekarang &rarr;</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL FOR DISPLAYING GENERATED CREDENTIALS & SIMULATED GMAIL -->
  <div class="modal fade" id="modalApproveRegistration" tabindex="-1" aria-labelledby="approveRegTitle" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content custom-modal-content" style="border: 2px solid var(--green);">
        <div class="modal-header border-0 p-4 pb-0 justify-content-between">
          <h4 class="modal-title fw-bold text-success" id="approveRegTitle"><i class="bi bi-patch-check-fill"></i> Pendaftaran Disetujui!</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="loadAdminPanel()"></button>
        </div>
        
        <div class="modal-body p-4 pt-3">
          <p class="text-muted" style="font-size: 0.92rem;" id="credentialsDesc">
            Akun resmi untuk <strong><span id="credentialsOrgName"></span></strong> berhasil dibuat dan didaftarkan ke sistem FoodShare. Berikut kredensial login resminya:
          </p>
          
          <!-- Kredensial Box -->
          <div class="p-4 mb-4 rounded-3 border" style="background: rgba(30, 125, 92, 0.05); border-color: rgba(30, 125, 92, 0.2) !important;">
            <div class="mb-3">
              <label class="form-label fw-bold text-muted mb-1" style="font-size: 0.8rem;">EMAIL RESMI FOODSHARE (LOGIN)</label>
              <div class="d-flex align-items-center gap-3">
                <input type="text" class="form-control bg-white fw-bold py-2.5 rounded-pill px-4 text-success border shadow-sm" id="credentialsEmail" readonly style="font-size:1.05rem; border: 2px solid rgba(30,125,92,0.15) !important;">
                <button class="btn btn-sage px-3 py-2.5 rounded-circle shadow-sm" onclick="copyToClipboard('credentialsEmail')" title="Salin Email"><i class="bi bi-copy"></i></button>
              </div>
            </div>
            <div class="mb-0">
              <label class="form-label fw-bold text-muted mb-1" style="font-size: 0.8rem;">KATA SANDI DEFAULT</label>
              <div class="d-flex align-items-center gap-3">
                <input type="text" class="form-control bg-white fw-bold py-2.5 rounded-pill px-4 text-success border shadow-sm" id="credentialsPassword" readonly style="font-size:1.05rem; border: 2px solid rgba(30,125,92,0.15) !important;">
                <button class="btn btn-sage px-3 py-2.5 rounded-circle shadow-sm" onclick="copyToClipboard('credentialsPassword')" title="Salin Sandi"><i class="bi bi-copy"></i></button>
              </div>
            </div>
          </div>

          <!-- Simulated Gmail Notif Section -->
          <div id="simulatedGmailSection">
            <h5 class="fw-bold mb-3 d-flex align-items-center gap-2 text-dark" style="font-size: 1.05rem;">
              <i class="bi bi-envelope-at-fill text-danger"></i> Kirim Notifikasi via Gmail
            </h5>
            <p class="text-muted" style="font-size: 0.88rem;" id="simulatedEmailDesc">
              Kirim email pemberitahuan resmi yang berisi detail akun dan instruksi login di atas ke email kontak pengurus: <strong><span id="credentialsContactEmail" class="text-dark"></span></strong>.
            </p>
            <button class="btn btn-danger px-4 py-2.5 rounded-pill shadow-sm fw-bold d-inline-flex align-items-center gap-2" id="btnSendGmailSimulation" onclick="triggerGmailSimulation()">
              <i class="bi bi-google"></i> Hubungkan ke Gmail &amp; Kirim Kredensial
            </button>
            
            <!-- Email Template Box (Hidden initially, shown after click) -->
            <div id="simulatedEmailBox" class="mt-4 border rounded-3 p-4 bg-white d-none shadow-sm" style="animation: tabFadeIn 0.5s ease;">
              <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                <div>
                  <small class="text-muted d-block">Dari: <strong>FoodShare HQ &lt;noreply@foodshare.id&gt;</strong></small>
                  <small class="text-muted d-block">Kepada: <strong><span id="simulatedEmailTo"></span></strong></small>
                </div>
                <span class="badge bg-danger rounded-pill px-3 py-1.5 text-uppercase fw-extrabold" style="font-size:0.7rem;"><i class="bi bi-send-fill me-1"></i> SENT VIA GMAIL</span>
              </div>
              <h5 class="fw-extrabold mb-3 text-dark" id="simulatedEmailSubject" style="font-size:1.05rem;">Subjek: 🎁 Selamat! Akun Lembaga FoodShare Anda Telah Aktif</h5>
              <div style="font-size:0.9rem; color:#444; line-height: 1.6;">
                <p>Halo Pengurus <strong><span id="simulatedEmailOrg"></span></strong>,</p>
                <p id="simulatedEmailBodyP1">Kami memiliki kabar baik! Tim verifikasi FoodShare telah meninjau alamat fisik dan lokasi Google Maps lembaga Anda. Lokasi panti asuhan/yayasan Anda telah dinyatakan <strong>100% valid dan terdaftar secara resmi</strong>.</p>
                <p id="simulatedEmailBodyP2">Untuk mulai berpartisipasi mengklaim makanan surplus berkualitas tinggi dari donatur restoran premium di Balikpapan, silakan gunakan kredensial masuk berikut ini:</p>
                <div class="p-3 bg-light rounded border mb-3">
                  <strong>Email Resmi:</strong> <span class="text-success font-monospace" id="simulatedEmailUser"></span><br>
                  <strong>Kata Sandi:</strong> <span class="text-success font-monospace" id="simulatedEmailPass"></span>
                </div>
                <p>Mohon segera ubah kata sandi default Anda setelah berhasil masuk demi alasan keamanan akun.</p>
                <p>Salam hangat,<br><strong>Tim Zero Waste FoodShare</strong></p>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer border-0 p-4 pt-0 text-end">
          <button type="button" class="btn-honey px-5 py-2.5 rounded-pill shadow-sm" data-bs-dismiss="modal" onclick="loadAdminPanel()">Selesai &amp; Reload Panel <i class="bi bi-arrow-right-short"></i></button>
        </div>
      </div>
    </div>
  </div>

  <!-- BOOTSTRAP BUNDLE JS (Includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- JAVASCRIPT & INTERACTION -->
  <script>
    // State management for user authentication (persisted via localStorage)
    let currentUser = JSON.parse(localStorage.getItem('foodshare_auth')) || {
      isLoggedIn: false,
      name: '',
      email: '',
      role: 'guest', // guest, donor, lembaga, admin
      id: null
    };

    // Initialize application layout & navigation based on active user
    document.addEventListener('DOMContentLoaded', () => {
      renderNavbarTabs();
      updateAuthUI();
      loadCatalog();
      
      // Start at Admin Panel if logged-in user is admin, else Landing Page
      if (currentUser.isLoggedIn && currentUser.role === 'admin') {
        showTab('admin');
      } else {
        showTab('landing');
      }
    });

    // Toggle password field visibility
    function togglePasswordVisibility() {
      const passInput = document.getElementById('manualPassInput');
      const eyeIcon = document.getElementById('passwordEyeIcon');
      if (passInput.type === 'password') {
        passInput.type = 'text';
        eyeIcon.classList.remove('bi-eye');
        eyeIcon.classList.add('bi-eye-slash');
      } else {
        passInput.type = 'password';
        eyeIcon.classList.remove('bi-eye-slash');
        eyeIcon.classList.add('bi-eye');
      }
    }

    // Show modern floating custom Toast Notifications
    function showCustomToast(title, message, type = 'info') {
      let container = document.getElementById('customToastContainer');
      if (!container) {
        container = document.createElement('div');
        container.id = 'customToastContainer';
        container.className = 'custom-toast-container';
        document.body.appendChild(container);
      }
      
      let iconClass = 'bi-info-circle-fill';
      if (type === 'success') iconClass = 'bi-check-circle-fill';
      if (type === 'error') iconClass = 'bi-exclamation-triangle-fill';
      if (type === 'warning') iconClass = 'bi-exclamation-circle-fill';
      
      const toast = document.createElement('div');
      toast.className = `custom-toast toast-${type}`;
      toast.innerHTML = `
        <span class="toast-icon"><i class="bi ${iconClass}"></i></span>
        <div class="toast-content">
          <div class="toast-title">${title}</div>
          <div class="toast-message">${message}</div>
        </div>
        <button class="toast-close" onclick="this.closest('.custom-toast').classList.add('hide'); setTimeout(() => this.closest('.custom-toast').remove(), 300);"><i class="bi bi-x"></i></button>
      `;
      
      container.appendChild(toast);
      
      setTimeout(() => {
        if (toast.parentNode) {
          toast.classList.add('hide');
          setTimeout(() => {
            if (toast.parentNode) toast.remove();
          }, 300);
        }
      }, 4000);
    }

    // Show beautiful Bootstrap-based Custom Confirm Modal
    function showCustomConfirm(title, message, iconClass = 'bi-question-circle-fill', iconColor = 'var(--accent2)') {
      return new Promise((resolve) => {
        const modalEl = document.getElementById('customConfirmModal');
        document.getElementById('confirmTitle').innerText = title;
        document.getElementById('confirmMessage').innerText = message;
        
        const confirmIcon = document.getElementById('confirmIcon');
        confirmIcon.innerHTML = `<i class="bi ${iconClass}"></i>`;
        confirmIcon.style.color = iconColor;
        
        const modal = new bootstrap.Modal(modalEl);
        
        const okBtn = document.getElementById('confirmOkBtn');
        const cancelBtn = document.getElementById('confirmCancelBtn');
        
        // Clone button to clear previous listeners completely
        const newOkBtn = okBtn.cloneNode(true);
        okBtn.parentNode.replaceChild(newOkBtn, okBtn);
        
        newOkBtn.addEventListener('click', () => {
          modal.hide();
          resolve(true);
        });
        
        modalEl.addEventListener('hidden.bs.modal', function handler() {
          modalEl.removeEventListener('hidden.bs.modal', handler);
          resolve(false);
        }, { once: true });
        
        modal.show();
      });
    }

    // Helper for CSRF Header
    function getHeaders() {
      const csrfMeta = document.querySelector('meta[name="csrf-token"]');
      const token = csrfMeta ? csrfMeta.getAttribute('content') : '';
      return {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': token
      };
    }

    // Render Navigation tabs dynamically based on currently logged in user's role
    function renderNavbarTabs() {
      const tabsWrapper = document.getElementById('navbarTabs');
      let tabsHtml = '';

      // Standard menu visible to all
      tabsHtml += `<button class="tab-trigger" id="tabBtn-landing" onclick="showTab('landing')"><i class="bi bi-house-door"></i> Beranda</button>`;

      // Conditional menu items based on role
      if (currentUser.role === 'donor') {
        tabsHtml += `<button class="tab-trigger" id="tabBtn-donor" onclick="showTab('donor')"><i class="bi bi-shop"></i> Mitra Donor</button>`;
      } else if (currentUser.role === 'lembaga') {
        tabsHtml += `<button class="tab-trigger" id="tabBtn-catalog" onclick="showTab('catalog')"><i class="bi bi-bag-heart"></i> Katalog</button>`;
        tabsHtml += `<button class="tab-trigger" id="tabBtn-detail" onclick="showTab('detail')"><i class="bi bi-geo-alt"></i> Klaim &amp; Tracking</button>`;
      } else if (currentUser.role === 'admin') {
        tabsHtml += `<button class="tab-trigger" id="tabBtn-admin" onclick="showTab('admin')"><i class="bi bi-shield-lock"></i> Admin Panel</button>`;
      } else {
        // Guest mode - can browse catalog (read-only)
        tabsHtml += `<button class="tab-trigger" id="tabBtn-catalog" onclick="showTab('catalog')"><i class="bi bi-bag-heart"></i> Katalog</button>`;
      }

      // Berita & Edukasi visible to all
      tabsHtml += `<button class="tab-trigger" id="tabBtn-news" onclick="showTab('news')"><i class="bi bi-newspaper"></i> Berita &amp; Edukasi</button>`;



      tabsWrapper.innerHTML = tabsHtml;
    }

    // Update login status and profile widget in Navbar & pages
    function updateAuthUI() {
      const authSection = document.getElementById('authNavbarSection');
      const catalogUserBadge = document.getElementById('catalogUserBadge');
      const claimLembagaInput = document.getElementById('claimLembagaNameInput');
      const navRescueBtn = document.getElementById('navRescueBtn');

      if (currentUser.isLoggedIn) {
        // Logged In navbar view
        let roleBadgeColor = 'var(--accent2)';
        let roleLabel = 'MITRA';
        if (currentUser.role === 'admin') { roleBadgeColor = '#1967D2'; roleLabel = 'ADMIN'; }
        if (currentUser.role === 'lembaga') { roleBadgeColor = 'var(--green)'; roleLabel = 'LEMBAGA'; }

        authSection.innerHTML = `
          <div class="dropdown">
            <button class="btn-honey-outline dropdown-toggle px-4 d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle text-warning"></i> ${currentUser.name.split(' ')[0]}
            </button>
            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-3" style="border-radius:var(--radius-md); background: var(--bg-warm);">
              <li class="px-3 py-2 border-bottom mb-2">
                <div class="fw-bold text-dark">${currentUser.name}</div>
                <small class="text-muted">${currentUser.email}</small>
                <div class="mt-2"><span class="badge" style="background:${roleBadgeColor}; font-size:0.7rem">${roleLabel}</span></div>
              </li>
              <li>
                <button class="dropdown-item rounded-pill px-3 py-2 text-danger fw-bold d-flex align-items-center gap-2" onclick="executeLogout()">
                  <i class="bi bi-box-arrow-right"></i> Keluar Akun
                </button>
              </li>
            </ul>
          </div>
        `;

        // Update catalog recipient badge dynamically
        if (catalogUserBadge) {
          catalogUserBadge.innerHTML = `
            <div class="user-avatar-sm" style="background-color: ${currentUser.role === 'lembaga' ? 'var(--green)' : 'var(--accent2)'}">
              <i class="bi bi-person-check-fill"></i>
            </div>
            <div>
              <div class="fw-bold" style="font-size:0.85rem">${currentUser.name}</div>
              <small class="text-muted" style="font-size:0.75rem">${currentUser.role.toUpperCase()}_ID: ${currentUser.id}</small>
            </div>
          `;
        }

        // Fill Claim form institute name
        if (claimLembagaInput) {
          claimLembagaInput.value = `${currentUser.name} (lembaga_id: ${currentUser.id})`;
        }

        // Hide/Show special quick rescue button using Bootstrap display classes
        if (currentUser.role === 'lembaga') {
          navRescueBtn.classList.remove('d-none');
          navRescueBtn.classList.add('d-lg-inline-flex');
        } else {
          navRescueBtn.classList.add('d-none');
          navRescueBtn.classList.remove('d-lg-inline-flex');
        }

      } else {
        // Guest mode navbar view
        authSection.innerHTML = `
          <button class="btn-honey-outline" data-bs-toggle="modal" data-bs-target="#loginModal">
            <i class="bi bi-box-arrow-in-right"></i> Masuk Akun
          </button>
        `;

        if (catalogUserBadge) {
          catalogUserBadge.innerHTML = `
            <div class="user-avatar-sm"><i class="bi bi-person-fill"></i></div>
            <div>
              <div class="fw-bold" style="font-size:0.85rem">Tamu (Belum Login)</div>
              <small class="text-muted" style="font-size:0.75rem">Silakan login terlebih dahulu</small>
            </div>
          `;
        }

        // Show rescue button for guest users too, using Bootstrap display classes, so they can be guided to login
        navRescueBtn.classList.remove('d-none');
        navRescueBtn.classList.add('d-lg-inline-flex');
      }
    }

    // Execute Login via email/password inputs (DB Verified!)
    function executeManualLogin(event) {
      event.preventDefault();
      const email = document.getElementById('manualEmailInput').value.trim();
      const password = document.getElementById('manualPassInput').value.trim();

      fetch('/api/login', {
        method: 'POST',
        headers: getHeaders(),
        body: JSON.stringify({ email: email, password: password })
      })
      .then(async res => {
        if (!res.ok) {
          let errMsg = 'Email atau kata sandi salah. Silakan periksa kembali kredensial Anda.';
          try {
            const errData = await res.json();
            if (errData.message) errMsg = errData.message;
          } catch (e) {
            // keep default
          }
          throw new Error(errMsg);
        }
        return res.json();
      })
      .then(res => {
        const u = res.user;
        currentUser = {
          isLoggedIn: true,
          name: u.name,
          email: u.email,
          role: u.role,
          id: u.id
        };
        localStorage.setItem('foodshare_auth', JSON.stringify(currentUser));
        
        // Close Modal
        const modalElement = document.getElementById('loginModal');
        const modal = bootstrap.Modal.getInstance(modalElement);
        if (modal) modal.hide();

        renderNavbarTabs();
        updateAuthUI();
        loadCatalog();
        
        showCustomToast('Selamat Datang', `Selamat datang kembali, ${u.name}! Login berhasil.`, 'success');
        
        if (u.role === 'admin') showTab('admin');
        else if (u.role === 'donor') showTab('donor');
        else if (u.role === 'lembaga') showTab('catalog');
        else showTab('landing');
      })
      .catch(err => {
        showCustomToast('Gagal Login', err.message, 'error');
      });
    }

    // Log user out and reset views
    async function executeLogout() {
      const confirmLogout = await showCustomConfirm(
        'Keluar Akun', 
        'Apakah Anda yakin ingin keluar dari akun FoodShare?', 
        'bi-box-arrow-right', 
        '#E74C3C'
      );
      if (confirmLogout) {
        currentUser = {
          isLoggedIn: false,
          name: '',
          email: '',
          role: 'guest',
          id: null
        };
        localStorage.removeItem('foodshare_auth');
        
        renderNavbarTabs();
        updateAuthUI();
        loadCatalog();
        
        showCustomToast('Keluar Sukses', 'Anda telah berhasil keluar dari sistem.', 'info');
        showTab('landing');
      }
    }

    // Handle Rescue Button Click in Navbar
    function handleRescueBtnClick() {
      if (!currentUser.isLoggedIn) {
        showCustomToast('Masuk Akun', 'Silakan masuk ke akun Anda terlebih dahulu untuk mulai menyelamatkan makanan.', 'warning');
        const modalElement = document.getElementById('loginModal');
        const modal = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
        modal.show();
      } else if (currentUser.role === 'lembaga') {
        showTab('catalog');
      } else {
        showCustomToast('Akses Terbatas', 'Hanya akun Lembaga Penerima yang dapat menyelamatkan makanan.', 'warning');
      }
    }

    // Tab Swapping with dynamic DB Loader
    function showTab(tabId) {
      // Role & Login Protections
      if (tabId === 'donor') {
        if (!currentUser.isLoggedIn) {
          showCustomToast('Masuk Akun', 'Silakan masuk ke akun Anda terlebih dahulu.', 'warning');
          const modalElement = document.getElementById('loginModal');
          const modal = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
          modal.show();
          return;
        } else if (currentUser.role !== 'donor') {
          showCustomToast('Akses Terbatas', 'Akun Anda terdaftar sebagai ' + (currentUser.role === 'lembaga' ? 'Lembaga Penerima' : 'Admin') + '. Silakan keluar sesi terlebih dahulu jika ingin masuk sebagai Mitra Donor.', 'warning');
          return;
        }
      }

      if (tabId === 'detail') {
        if (!currentUser.isLoggedIn) {
          showCustomToast('Masuk Akun', 'Silakan masuk ke akun Anda terlebih dahulu.', 'warning');
          const modalElement = document.getElementById('loginModal');
          const modal = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
          modal.show();
          return;
        } else if (currentUser.role !== 'lembaga') {
          showCustomToast('Akses Terbatas', 'Hanya Lembaga Penerima yang dapat mengakses menu Klaim & Pelacakan.', 'warning');
          return;
        }
      }

      if (tabId === 'admin') {
        if (!currentUser.isLoggedIn) {
          showCustomToast('Masuk Akun', 'Akses dibatasi untuk Administrator.', 'warning');
          const modalElement = document.getElementById('loginModal');
          const modal = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
          modal.show();
          return;
        } else if (currentUser.role !== 'admin') {
          showCustomToast('Akses Terbatas', 'Hanya akun Administrator yang dapat mengakses panel kontrol.', 'warning');
          return;
        }
      }

      // Toggle admin-mode body class
      if (tabId === 'admin') {
        document.body.classList.add('admin-mode');
      } else {
        document.body.classList.remove('admin-mode');
      }

      // Toggle register-mode body class
      if (tabId === 'register') {
        document.body.classList.add('register-mode');
      } else {
        document.body.classList.remove('register-mode');
      }

      // Remove active class from pages & triggers
      document.querySelectorAll('.page-section').forEach(page => {
        page.classList.remove('active');
      });
      document.querySelectorAll('.tab-trigger').forEach(trigger => {
        trigger.classList.remove('active');
      });

      // Show requested tab
      const targetPage = document.getElementById('page-' + tabId);
      if (targetPage) {
        targetPage.classList.add('active');
      }

      // Handle active class in navbar triggers dynamically
      const activeBtn = document.getElementById('tabBtn-' + tabId);
      if (activeBtn) {
        activeBtn.classList.add('active');
      }

      // Load specific DB context for views
      if (tabId === 'catalog') {
        loadCatalog();
      } else if (tabId === 'donor' && currentUser.role === 'donor') {
        loadDonorDashboard();
      } else if (tabId === 'detail' && currentUser.role === 'lembaga') {
        loadClaimsTimeline();
      } else if (tabId === 'admin' && currentUser.role === 'admin') {
        loadAdminPanel();
      } else if (tabId === 'landing') {
        loadLandingStock();
      } else if (tabId === 'news') {
        loadArticles();
      } else if (tabId === 'register') {
        showRegisterRoleSelection();
      }

      // Smooth scroll to top
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    }

    // REAL CRUD: Get Available Food Items (Katalog & Landing)
    function loadCatalog() {
      fetch('/api/available-food')
      .then(res => res.json())
      .then(data => {
        const grid = document.getElementById('catalogFoodGrid');
        let html = '';
        
        if (data.length === 0) {
          grid.innerHTML = `
            <div class="col-12 text-center py-5">
              <i class="bi bi-inbox-fill text-muted" style="font-size:3rem;"></i>
              <h5 class="text-muted mt-3">Belum ada persediaan makanan surplus saat ini.</h5>
            </div>
          `;
          return;
        }

        data.forEach(item => {
          let icon = 'bi-box-seam-fill';
          if (item.category === 'roti') icon = 'bi-cookie';
          if (item.category === 'minuman') icon = 'bi-cup-straw';
          if (item.category === 'snack') icon = 'bi-cake2';

          const dateDiff = Math.max(1, Math.round((new Date(item.expired_at) - new Date()) / 3600000));

          html += `
            <div class="food-card" data-category="${item.category}">
              <div class="food-card-img"><i class="bi ${icon}"></i><span class="badge-floating">Tersedia</span></div>
              <div class="food-card-body">
                <h4>${item.food_name}</h4>
                <div class="food-location"><i class="bi bi-geo-alt-fill"></i> ${item.donor_org || item.donor_name}</div>
                <div class="food-qty">${item.quantity} ${item.unit}</div>
                <button class="btn-honey btn-card-claim" onclick="initiateClaim(${item.id}, '${item.food_name}', '${item.donor_org || item.donor_name}', ${item.quantity}, '${item.category}', '${icon}', '${dateDiff}')">
                  Klaim Makanan <i class="bi bi-box-arrow-in-up-right"></i>
                </button>
              </div>
            </div>
          `;
        });
        grid.innerHTML = html;
      });
    }

    // Load Mini Stock for Landing page
    function loadLandingStock() {
      fetch('/api/available-food')
      .then(res => res.json())
      .then(data => {
        const grid = document.getElementById('miniLiveStockGrid');
        let html = '';
        
        // Take maximum of 3 items
        const items = data.slice(0, 3);
        
        if (items.length === 0) {
          grid.innerHTML = `<div class="col-12 text-center py-3 text-muted fw-semibold">Tidak ada data persediaan saat ini.</div>`;
          return;
        }

        items.forEach(item => {
          let icon = 'bi-box-seam';
          if (item.category === 'roti') icon = 'bi-cookie';
          if (item.category === 'minuman') icon = 'bi-cup-straw';
          if (item.category === 'snack') icon = 'bi-cake2';

          html += `
            <div class="col-lg-4 col-md-6">
              <div class="live-stock-item">
                <div class="stock-emoji-box"><i class="bi ${icon}"></i></div>
                <div class="stock-details">
                  <h5>${item.food_name}</h5>
                  <p>${item.donor_org || item.donor_name} • ${item.quantity} ${item.unit}</p>
                </div>
                <span class="badge-status available">Tersedia</span>
              </div>
            </div>
          `;
        });
        grid.innerHTML = html;
      });
    }

    // Interactive subpage routing for Mitra Donor sidebar
    function switchDonorSubPage(subpageName, element) {
      // Hide all subpages
      document.querySelectorAll('.donor-subpage').forEach(page => {
        page.classList.add('d-none');
      });
      // Show targeted subpage
      document.getElementById('donor-subpage-' + subpageName).classList.remove('d-none');
      
      // Update active class on sidebar items
      document.querySelectorAll('#page-donor .sidebar-menu .sidebar-item').forEach(item => {
        item.classList.remove('active');
      });
      if (element) {
        element.classList.add('active');
      }

      // Update Dashboard header title accordingly
      const title = document.getElementById('donorDashboardTitle');
      if (subpageName === 'summary') {
        title.innerHTML = 'Ringkasan Mitra Donor <i class="bi bi-shop" style="color: var(--accent2)"></i>';
      } else if (subpageName === 'food') {
        title.innerHTML = 'Kelola Makanan Saya <i class="bi bi-egg-fried" style="color: var(--accent2)"></i>';
      } else if (subpageName === 'log') {
        title.innerHTML = 'Riwayat Log Klaim <i class="bi bi-clock-history" style="color: var(--accent2)"></i>';
      } else if (subpageName === 'config') {
        title.innerHTML = 'Konfigurasi Toko <i class="bi bi-gear" style="color: var(--accent2)"></i>';
      }
    }

    // REAL CRUD: Donor Dashboard surplus food list (Read, Update, Delete)
    function loadDonorDashboard() {
      // Sync names
      document.getElementById('donorSidebarName').innerText = currentUser.name;
      document.getElementById('donorProfileName').innerText = currentUser.name + ' Balikpapan';
      document.getElementById('donorSidebarId').innerText = `donor_id: ${currentUser.id}`;

      // Pre-fill profile configuration form
      document.getElementById('configDonorNameInput').value = currentUser.name;
      document.getElementById('configDonorPhoneInput').value = currentUser.phone || '0812-3456-7890';
      document.getElementById('configDonorAddressInput').value = currentUser.address || 'Jl. Jenderal Sudirman No. 12, Balikpapan';

      // Fetch live donor stats
      fetch(`/api/users/${currentUser.id}/stats`)
      .then(res => res.json())
      .then(stats => {
        document.getElementById('donorStatTotal').innerText = stats.total_items;
        document.getElementById('donorStatActive').innerText = stats.total_portions - stats.claimed_portions;
        document.getElementById('donorStatHelped').innerText = stats.helped_count;
      })
      .catch(err => console.error('Failed to load donor stats', err));

      fetch(`/api/donor-food/${currentUser.id}`)
      .then(res => res.json())
      .then(data => {
        // Render Summary table (latest 3 items)
        renderDonationsTable(data.slice(0, 3), 'riwayatDonasiBody');
        // Render Full stok table
        renderDonationsTable(data, 'riwayatDonasiFullBody');
      });

      // Render Claims Log specifically for this donor's food
      fetch('/api/admin/pending-claims')
      .then(res => res.json())
      .then(claims => {
        // Filter claims belonging to this donor's restaurant/organization
        const filtered = claims.filter(c => c.donor_name === currentUser.name || c.donor_name.includes(currentUser.name));
        const body = document.getElementById('donorClaimsLogBody');
        let html = '';
        
        // Render notification container
        const pendingClaims = filtered.filter(c => c.status === 'pending');
        const notifContainer = document.getElementById('donorNotificationContainer');
        if (pendingClaims.length > 0) {
          const hasPickup = pendingClaims.some(c => c.pickup_method === 'pickup');
          const pickupCount = pendingClaims.filter(c => c.pickup_method === 'pickup').length;
          
          let alertMsg = `Ada <strong class="text-danger">${pendingClaims.length}</strong> permintaan klaim baru dari lembaga penerima yang menunggu persetujuan Anda.`;
          if (hasPickup) {
            alertMsg += ` (Termasuk <strong style="color: var(--accent2);">${pickupCount} klaim Ambil Mandiri</strong> yang memerlukan penentuan batas waktu).`;
          }

          notifContainer.innerHTML = `
            <div class="custom-card border-0 shadow-sm p-4 rounded-4" style="background: rgba(244, 123, 48, 0.08); border-left: 5px solid var(--accent2) !important;">
              <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle p-3 d-flex align-items-center justify-content-center" style="background: var(--accent2); color: white; width: 50px; height: 50px;">
                  <i class="bi bi-bell-fill fs-4 animate-bounce"></i>
                </div>
                <div class="flex-grow-1">
                  <h6 class="fw-bold m-0" style="color: var(--dark);">Permintaan Klaim Masuk!</h6>
                  <p class="m-0 text-muted" style="font-size: 0.9rem;">${alertMsg}</p>
                </div>
                <button class="btn-honey-outline rounded-pill px-4 py-2" onclick="switchDonorSubPage('log', document.querySelector('.sidebar-item[onclick*=\\'log\\']'))">
                  Lihat &amp; Setujui
                </button>
              </div>
            </div>
          `;
          notifContainer.classList.remove('d-none');
        } else {
          notifContainer.classList.add('d-none');
        }

        if (filtered.length === 0) {
          body.innerHTML = `<tr><td colspan="7" class="text-center py-4 text-muted">Belum ada riwayat klaim makanan surplus Anda.</td></tr>`;
          return;
        }
        filtered.forEach(claim => {
          let statusBadge = `<span class="badge-status" style="background:#FFF3D6; color:#E6A817;">PENDING</span>`;
          let actionHtml = '';

          if (claim.status === 'approved') {
            statusBadge = `<span class="badge-status available">APPROVED</span>`;
            actionHtml = `<span class="fw-bold text-success" style="font-size: 0.9rem;"><i class="bi bi-check-circle-fill"></i> Disetujui</span>`;
          } else if (claim.status === 'rejected') {
            statusBadge = `<span class="badge-status" style="background:#FCE4D6; color:#C55A11;">REJECTED</span>`;
            actionHtml = `<span class="fw-bold text-danger" style="font-size: 0.9rem;"><i class="bi bi-x-circle-fill"></i> Ditolak</span>`;
          } else if (claim.status === 'pending') {
            actionHtml = `
              <div class="d-flex gap-2 justify-content-center">
                <button class="btn-sage btn-sm px-3 rounded-pill py-1 d-flex align-items-center gap-1" onclick="processDonorVerify(${claim.id}, 'approved', '${claim.pickup_method}')"><i class="bi bi-check-lg"></i> Setuju</button>
                <button class="btn-danger-custom btn-sm px-3 rounded-pill py-1 d-flex align-items-center gap-1" onclick="processDonorVerify(${claim.id}, 'rejected', '${claim.pickup_method}')"><i class="bi bi-x-lg"></i> Tolak</button>
              </div>
            `;
          }

          let methodBadge = '';
          if (claim.pickup_method === 'pickup') {
            methodBadge = `<span class="badge" style="background: #E8F0FE; color: #1967D2; font-weight: 700; border-radius: 20px; padding: 4px 12px; font-size: 0.78rem;"><i class="bi bi-person-fill"></i> AMBIL MANDIRI</span>`;
          } else {
            methodBadge = `<span class="badge" style="background: #E6F4EA; color: #137333; font-weight: 700; border-radius: 20px; padding: 4px 12px; font-size: 0.78rem;"><i class="bi bi-truck"></i> KIRIM KURIR</span>`;
          }

          html += `
            <tr>
              <td>#KL-00${claim.id}</td>
              <td><strong>${claim.food_name}</strong></td>
              <td><strong>${claim.lembaga_name}</strong></td>
              <td>${claim.claimed_quantity} Porsi</td>
              <td>${methodBadge}</td>
              <td>${statusBadge}</td>
              <td class="text-center">${actionHtml}</td>
            </tr>
          `;
        });
        body.innerHTML = html;
      });
    }

    // Donor verify claims AJAX wrapper using Custom UI Confirmation Modal & Pickup deadline support
    let pendingVerifyClaimId = null;
    
    function toggleCustomDeadline(val) {
      const customInput = document.getElementById('pickupDeadlineCustomInput');
      if (val === 'custom') {
        customInput.classList.remove('d-none');
        customInput.focus();
      } else {
        customInput.classList.add('d-none');
      }
    }
    
    function submitPickupApproval() {
      const selectVal = document.getElementById('pickupDeadlineSelect').value;
      const customVal = document.getElementById('pickupDeadlineCustomInput').value.trim();
      let deadline = selectVal;
      if (selectVal === 'custom') {
        deadline = customVal || '2 jam dari sekarang';
      }
      
      const modalElement = document.getElementById('pickupDeadlineModal');
      const modal = bootstrap.Modal.getInstance(modalElement);
      if (modal) modal.hide();
      
      executeVerifyClaimRequest(pendingVerifyClaimId, 'approved', deadline);
    }

    function processDonorVerify(claimId, status, pickupMethod) {
      if (status === 'approved' && pickupMethod === 'pickup') {
        pendingVerifyClaimId = claimId;
        // Reset modal fields
        document.getElementById('pickupDeadlineSelect').value = '2 jam dari sekarang';
        document.getElementById('pickupDeadlineCustomInput').value = '';
        document.getElementById('pickupDeadlineCustomInput').classList.add('d-none');
        
        const modalElement = document.getElementById('pickupDeadlineModal');
        const modal = new bootstrap.Modal(modalElement);
        modal.show();
        return;
      }

      const verb = status === 'approved' ? 'menyetujui' : 'menolak';
      const title = status === 'approved' ? 'Setujui Klaim Makanan' : 'Tolak Klaim Makanan';
      const msg = `Apakah Anda yakin ingin ${verb} permohonan klaim makanan surplus ini?`;
      const icon = status === 'approved' ? 'bi-check-circle-fill' : 'bi-x-circle-fill';
      const color = status === 'approved' ? 'var(--green)' : '#E74C3C';

      showCustomConfirm(title, msg, icon, color).then(confirmed => {
        if (!confirmed) return;
        executeVerifyClaimRequest(claimId, status);
      });
    }

    function executeVerifyClaimRequest(claimId, status, deadline = null) {
      fetch(`/api/admin/claims/${claimId}/verify`, {
        method: 'POST',
        headers: getHeaders(),
        body: JSON.stringify({ status: status, pickup_deadline: deadline })
      })
      .then(res => {
        return res.json().then(data => {
          if (!res.ok) {
            throw new Error(data.message || 'Gagal memproses verifikasi klaim.');
          }
          return data;
        });
      })
      .then(data => {
        showCustomToast('Klaim Diproses', `Klaim berhasil di-${status === 'approved' ? 'setujui' : 'tolak'}.`, 'success');
        loadDonorDashboard();
      })
      .catch(err => {
        showCustomToast('Gagal Proses', err.message, 'error');
      });
    }

    function renderDonationsTable(items, tbodyId) {
      const body = document.getElementById(tbodyId);
      let html = '';
      if (items.length === 0) {
        body.innerHTML = `<tr><td colspan="6" class="text-center py-4 text-muted">Belum ada makanan surplus yang didaftarkan.</td></tr>`;
        return;
      }
      items.forEach(item => {
        let statusBadge = `<span class="badge-status available">Tersedia</span>`;
        if (item.status === 'claimed') {
          statusBadge = `<span class="badge-status" style="background:#E8F0FE; color:#1967D2;">Klaim Selesai</span>`;
        }
        const expDate = new Date(item.expired_at);
        const hrsLeft = Math.max(1, Math.round((expDate - new Date()) / 3600000));
        let icon = 'bi-box-seam-fill';
        if (item.category === 'roti') icon = 'bi-cookie';
        if (item.category === 'minuman') icon = 'bi-cup-straw';
        if (item.category === 'snack') icon = 'bi-cake2';

        html += `
          <tr>
            <td><strong><i class="bi ${icon} text-warning"></i> ${item.food_name}</strong></td>
            <td>${item.quantity} ${item.unit}</td>
            <td><span class="category-pill">${item.category}</span></td>
            <td>${statusBadge}</td>
            <td><i class="bi bi-clock"></i> ${hrsLeft} Jam Lagi</td>
            <td class="text-center">
              <button class="btn btn-sm btn-danger-custom py-2 px-3" onclick="deleteFoodItem(${item.id})">
                <i class="bi bi-trash-fill"></i> Hapus
              </button>
            </td>
          </tr>
        `;
      });
      body.innerHTML = html;
    }

    // REAL CRUD: Donor Dashboard (Delete surplus food item)
    async function deleteFoodItem(id) {
      const confirmDelete = await showCustomConfirm(
        'Hapus Donasi Makanan', 
        'Apakah Anda yakin ingin menarik/menghapus donasi makanan surplus ini dari katalog database?', 
        'bi-trash-fill', 
        '#E74C3C'
      );
      if (confirmDelete) {
        fetch(`/api/food-items/${id}`, {
          method: 'DELETE',
          headers: getHeaders()
        })
        .then(res => res.json())
        .then(res => {
          showCustomToast('Donasi Dihapus', 'Donasi makanan surplus berhasil dihapus dari database.', 'success');
          loadDonorDashboard();
          loadCatalog();
        });
      }
    }

    // Open Modal for Food Donation Input (Replaces Prompt browser)
    function openInputDonasiModal() {
      document.getElementById('inputDonasiForm').reset();
      const modalElement = document.getElementById('inputDonasiModal');
      const modal = new bootstrap.Modal(modalElement);
      modal.show();
    }

    // Submit Donasi Makanan surplus dari form modal
    function submitDonorFood(event) {
      event.preventDefault();
      
      const foodName = document.getElementById('donorFoodNameInput').value;
      const qty = document.getElementById('donorFoodQtyInput').value;
      const unit = document.getElementById('donorFoodUnitInput').value;
      const category = document.getElementById('donorFoodCategorySelect').value;
      const expHours = document.getElementById('donorFoodExpInput').value;
      const description = document.getElementById('donorFoodDescriptionInput').value;

      fetch('/api/food-items', {
        method: 'POST',
        headers: getHeaders(),
        body: JSON.stringify({
          donor_id: currentUser.id,
          food_name: foodName,
          category: category,
          quantity: parseInt(qty),
          unit: unit,
          description: description,
          expired_hours: parseInt(expHours),
          pickup_address: currentUser.address || 'Balikpapan'
        })
      })
      .then(res => {
        return res.json().then(data => {
          if (!res.ok) {
            throw new Error(data.message || 'Gagal mendaftarkan makanan surplus ke database.');
          }
          return data;
        });
      })
      .then(data => {
        // Hide Bootstrap modal
        const modalElement = document.getElementById('inputDonasiModal');
        const modal = bootstrap.Modal.getInstance(modalElement);
        if (modal) modal.hide();

        loadDonorDashboard();
        loadCatalog();

        showCustomToast('Donasi Berhasil', 'Makanan surplus Anda telah terdaftar dan siap untuk didistribusikan.', 'success');
      })
      .catch(err => {
        showCustomToast('Gagal Donasi', err.message, 'error');
      });
    }

    // Save Donor Shop Configurations
    function saveDonorConfig(event) {
      event.preventDefault();
      const shopName = document.getElementById('configDonorNameInput').value;
      const phone = document.getElementById('configDonorPhoneInput').value;
      const address = document.getElementById('configDonorAddressInput').value;

      // Update local currentUser state
      currentUser.name = shopName;
      currentUser.phone = phone;
      currentUser.address = address;
      
      // Update sidebar visual immediately
      document.getElementById('donorSidebarName').innerText = shopName;
      document.getElementById('donorProfileName').innerText = shopName + ' Balikpapan';
      
      // Save to localStorage
      localStorage.setItem('foodshare_auth', JSON.stringify(currentUser));

      showCustomToast('Konfigurasi Disimpan', 'Konfigurasi toko dan detail profil berhasil diperbarui.', 'success');
    }

    // Initiate Claim: Click on catalog card, fill detail section, swap page
    function initiateClaim(id, name, origin, qtyAvailable, category, iconClass, hrsLeft) {
      if (!currentUser.isLoggedIn) {
        showCustomToast('Akses Terbatas', 'Silakan masuk (login) terlebih dahulu untuk dapat mengajukan klaim makanan surplus.', 'warning');
        const modalElement = document.getElementById('loginModal');
        const modal = new bootstrap.Modal(modalElement);
        modal.show();
        return;
      }

      if (currentUser.role !== 'lembaga') {
        showCustomToast('Peran Tidak Sesuai', 'Hanya akun ber-peran Lembaga Penerima (lembaga_id) yang diperbolehkan mengajukan klaim.', 'warning');
        return;
      }

      // Cek batas klaim harian (maksimal 2 kali per hari)
      const today = new Date();
      const startOfToday = new Date(today.getFullYear(), today.getMonth(), today.getDate()).getTime();
      const endOfToday = startOfToday + 24 * 60 * 60 * 1000;
      const todayClaimsCount = claimsCache.filter(c => {
        const claimTime = new Date(c.claimed_at).getTime();
        return claimTime >= startOfToday && claimTime < endOfToday && c.status !== 'rejected';
      }).length;

      if (todayClaimsCount >= 2) {
        showCustomToast('Batas Harian Tercapai', 'Lembaga Anda telah mencapai batas maksimal 2 kali klaim hari ini.', 'warning');
        return;
      }

      // Explicitly show the claim form box and hide the active claim timeline/selector
      document.getElementById('claimFormBox').classList.remove('d-none');
      document.getElementById('claimDetailCard').classList.remove('d-none');
      document.getElementById('activeClaimSelectorWrapper').classList.add('d-none');
      document.getElementById('distributionTimeline').innerHTML = `
        <div class="text-center py-4 text-muted">
          <i class="bi bi-send-check" style="font-size:2rem; color:var(--accent2)"></i>
          <p class="mt-2">Silakan isi formulir klaim di atas untuk mengajukan stok surplus ini.</p>
        </div>
      `;

      document.getElementById('claimFoodIdInput').value = id;
      document.getElementById('detailFoodIcon').innerHTML = `<i class="bi ${iconClass}"></i>`;
      document.getElementById('detailFoodName').innerText = name;
      document.getElementById('detailFoodOrigin').innerHTML = `<i class="bi bi-geo-alt-fill"></i> ${origin}`;
      document.getElementById('detailFoodQty').innerHTML = `<i class="bi bi-heart-fill" style="color:var(--accent2)"></i> ${qtyAvailable} Porsi`;
      document.getElementById('detailFoodCategory').innerHTML = `<i class="bi bi-folder-fill"></i> ${category}`;
      document.getElementById('detailFoodExp').innerHTML = `<i class="bi bi-clock-fill"></i> Expired: ${hrsLeft} jam lagi`;
      
      // Update form max qty input
      const claimQtyInput = document.getElementById('claimQtyInput');
      claimQtyInput.max = qtyAvailable;
      claimQtyInput.value = Math.min(15, qtyAvailable);
      
      // Hide claim alert if active
      document.getElementById('claimSuccessBox').style.display = 'none';

      // Switch to detail page
      showTab('detail');
    }

    // REAL CRUD: Submit Claim Form (Lembaga - Create)
    function submitClaimForm(event) {
      event.preventDefault();
      
      // Cek batas klaim harian (maksimal 2 kali per hari)
      const today = new Date();
      const startOfToday = new Date(today.getFullYear(), today.getMonth(), today.getDate()).getTime();
      const endOfToday = startOfToday + 24 * 60 * 60 * 1000;
      const todayClaimsCount = claimsCache.filter(c => {
        const claimTime = new Date(c.claimed_at).getTime();
        return claimTime >= startOfToday && claimTime < endOfToday && c.status !== 'rejected';
      }).length;

      if (todayClaimsCount >= 2) {
        showCustomToast('Batas Harian Tercapai', 'Lembaga Anda telah mencapai batas maksimal 2 kali klaim hari ini.', 'warning');
        return;
      }
      
      const foodId = document.getElementById('claimFoodIdInput').value;
      const qty = document.getElementById('claimQtyInput').value;
      const method = document.getElementById('claimMethodSelect').value;
      const notes = document.getElementById('claimNotesInput').value;

      const executeSubmit = () => {
        fetch('/api/claims', {
          method: 'POST',
          headers: getHeaders(),
          body: JSON.stringify({
            food_item_id: foodId,
            lembaga_id: currentUser.id,
            claimed_quantity: parseInt(qty),
            pickup_method: method,
            notes: notes
          })
        })
        .then(res => {
          return res.json().then(data => {
            if (!res.ok) {
              throw new Error(data.message || 'Gagal mengajukan klaim stok surplus database.');
            }
            return data;
          });
        })
        .then(res => {
          // Show success alert
          const successBox = document.getElementById('claimSuccessBox');
          successBox.style.display = 'block';
          successBox.scrollIntoView({ behavior: 'smooth', block: 'center' });

          // Reload data
          loadCatalog();
          loadClaimsTimeline(res.claim_id);
          showCustomToast('Klaim Berhasil', 'Pengajuan klaim makanan surplus Anda berhasil dikirim untuk divalidasi admin.', 'success');
        })
        .catch(err => {
          showCustomToast('Gagal Klaim', err.message, 'error');
        });
      };

      if (todayClaimsCount === 1) {
        showCustomConfirm(
          'Konfirmasi Klaim Kedua',
          'Lembaga Anda hanya diperbolehkan melakukan maksimal 2 kali klaim per hari. Anda telah melakukan 1 klaim hari ini. Apakah Anda yakin ingin mengajukan klaim kedua Anda?',
          'bi-exclamation-triangle-fill',
          'var(--accent2)'
        ).then(confirmed => {
          if (confirmed) {
            executeSubmit();
          }
        });
      } else {
        executeSubmit();
      }
    }

    // REAL CRUD: Get claims for Tracking Timeline (Lembaga - Read)
    let claimsCache = [];
    function loadClaimsTimeline(selectedId = null) {
      // Load institution stats summary
      loadLembagaStats();

      const selector = document.getElementById('activeClaimSelector');
      const currentSelected = selectedId || (selector ? selector.value : null);

      fetch(`/api/claims/${currentUser.id}`)
      .then(res => res.json())
      .then(data => {
        claimsCache = data;
        const selectorWrapper = document.getElementById('activeClaimSelectorWrapper');
        const activeSelector = document.getElementById('activeClaimSelector');

        if (data.length === 0) {
          selectorWrapper.classList.add('d-none');
          document.getElementById('distributionTimeline').innerHTML = `
            <div class="text-center py-4 text-muted">
              <i class="bi bi-truck-flatbed" style="font-size:2.5rem;"></i>
              <p class="mt-2">Belum ada riwayat klaim aktif dari lembaga Anda.</p>
            </div>
          `;
          return;
        }

        // Show selector if multiple claims
        selectorWrapper.classList.remove('d-none');
        let options = '';
        data.forEach((claim, index) => {
          options += `<option value="${claim.id}">Klaim #${claim.id} - ${claim.food_name} (${claim.claimed_quantity} Porsi) - Status: ${claim.status.toUpperCase()}</option>`;
        });
        activeSelector.innerHTML = options;

        // Restore active claim or fallback to first
        let activeClaimId = currentSelected;
        const exists = data.some(c => c.id == activeClaimId);
        if (!activeClaimId || !exists) {
          activeClaimId = data[0].id;
        }
        activeSelector.value = activeClaimId;
        renderActiveClaimTimeline(activeClaimId);
      })
      .catch(err => {
        showCustomToast('Gagal Memuat Timeline', 'Terjadi kesalahan saat memuat data pelacakan.', 'error');
      });
    }

    // Helper function for E-Commerce Distance/Duration Estimator
    function getDistanceAndDuration(addr1, addr2) {
      if (!addr1 || !addr2) return { distance: '4.8 km', duration: '18 menit' };
      const clean1 = addr1.toLowerCase();
      const clean2 = addr2.toLowerCase();
      
      const isSamarinda1 = clean1.includes('samarinda');
      const isSamarinda2 = clean2.includes('samarinda');
      
      // If one is Balikpapan and one is Samarinda (cross city)
      if (isSamarinda1 !== isSamarinda2) {
        return { distance: '112 km', duration: '2 jam 15 menit', crossCity: true };
      }
      
      // Calculate a consistent hash from address strings
      let hash = 0;
      for (let i = 0; i < addr1.length; i++) hash += addr1.charCodeAt(i);
      for (let i = 0; i < addr2.length; i++) hash += addr2.charCodeAt(i);
      
      const dist = ((hash % 75) / 10) + 1.5; // 1.5 km to 8.9 km
      const dur = Math.round(dist * 3.5 + 4); // 9 to 35 mins
      
      return { distance: `${dist.toFixed(1)} km`, duration: `${dur} menit`, crossCity: false };
    }

    // Draw active claim timeline nodes with E-Commerce design
    function renderActiveClaimTimeline(claimId) {
      const claim = claimsCache.find(c => c.id == claimId);
      if (!claim) return;

      // Sync Claim Detail view card with this claim
      document.getElementById('claimDetailCard').classList.remove('d-none');
      document.getElementById('claimFormBox').classList.add('d-none'); // Hide input form when tracking existing claim

      let categoryIcon = 'bi-box-seam-fill';
      if (claim.category === 'roti') categoryIcon = 'bi-cookie';
      if (claim.category === 'minuman') categoryIcon = 'bi-cup-straw';
      if (claim.category === 'snack') categoryIcon = 'bi-cake2';

      document.getElementById('detailFoodIcon').innerHTML = `<i class="bi ${categoryIcon}"></i>`;
      document.getElementById('detailFoodName').innerText = claim.food_name;
      document.getElementById('detailFoodOrigin').innerHTML = `<i class="bi bi-geo-alt-fill"></i> ${claim.donor_name}`;
      document.getElementById('detailFoodQty').innerHTML = `<i class="bi bi-heart-fill" style="color:var(--accent2)"></i> ${claim.claimed_quantity} Porsi`;
      document.getElementById('detailFoodCategory').innerHTML = `<i class="bi bi-folder-fill"></i> ${claim.category}`;
      document.getElementById('detailFoodExp').innerHTML = `<i class="bi bi-clock-fill"></i> Diajukan: ${new Date(claim.claimed_at).toLocaleTimeString('id-ID')} WITA`;

      // Render timeline nodes based on DB status
      const timeline = document.getElementById('distributionTimeline');
      
      const step1Class = 'done';
      const step2Class = 'done';
      let step3Class = claim.status === 'pending' ? 'active' : 'done';
      let step4Class = claim.status === 'approved' ? 'active' : (claim.status === 'rejected' ? '' : '');
      
      if (claim.dist_status === 'delivered' || claim.dist_status === 'distributed') {
        step3Class = 'done';
        step4Class = 'done';
      }

      let statusBadge = `<span class="badge-status" style="background:#FFF3D6; color:#E6A817;">Pending Approval</span>`;
      if (claim.status === 'approved') {
        statusBadge = `<span class="badge-status available">Disetujui Admin</span>`;
      } else if (claim.status === 'rejected') {
        statusBadge = `<span class="badge-status" style="background:#FCE4D6; color:#C55A11;">Ditolak Admin</span>`;
      }

      let step4Title = 'Status Penyelamatan Makanan';
      let step4Body = '';
      let limitHtml = '';
      let actionBtnHtml = '';

      // Determine progress percent
      let progressPercent = 0;
      if (claim.status === 'pending') {
        progressPercent = 25;
      } else if (claim.status === 'approved') {
        if (claim.dist_status === 'distributed') {
          progressPercent = 100;
        } else if (claim.dist_status === 'delivered') {
          progressPercent = 75;
        } else {
          progressPercent = 50;
        }
      } else if (claim.status === 'rejected') {
        progressPercent = 100;
      }

      // 1. E-Commerce Style Header
      const trackerHeaderHtml = `
        <div class="ecommerce-tracker-header p-4 bg-white border rounded-4 mb-4 shadow-sm">
          <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <div>
              <span class="text-muted fw-semibold" style="font-size: 0.78rem;">KODE KLAIM</span>
              <h5 class="fw-extrabold m-0 text-dark">#KL-00${claim.id}</h5>
            </div>
            <div class="text-md-end">
              <span class="text-muted fw-semibold" style="font-size: 0.78rem;">METODE PENYALURAN</span>
              <h6 class="fw-bold m-0 text-uppercase d-flex align-items-center gap-1 text-success" style="color: ${claim.pickup_method === 'pickup' ? 'var(--accent2)' : 'var(--green)'} !important; font-size: 0.95rem;">
                <i class="bi ${claim.pickup_method === 'pickup' ? 'bi-person-fill' : 'bi-truck'}"></i> ${claim.pickup_method === 'pickup' ? 'Ambil Mandiri' : 'Kirim Kurir'}
              </h6>
            </div>
          </div>
          <div class="progress mb-2" style="height: 8px; border-radius: 10px; background: rgba(56,38,21,0.06);">
            <div class="progress-bar" role="progressbar" style="width: ${progressPercent}%; background: ${claim.status === 'rejected' ? '#E74C3C' : 'var(--accent-grad)'};" aria-valuenow="${progressPercent}" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="d-flex justify-content-between text-muted mt-2 fw-bold" style="font-size: 0.8rem;">
            <span class="${step1Class === 'done' ? 'text-success' : ''}">Diajukan</span>
            <span class="${step3Class === 'done' ? 'text-success' : ''}">${claim.pickup_method === 'pickup' ? 'Disetujui Mitra' : 'Diverifikasi'}</span>
            <span class="${step4Class === 'done' ? 'text-success' : ''}">${claim.pickup_method === 'pickup' ? 'Siap Diambil' : 'Dalam Pengiriman'}</span>
            <span class="${claim.dist_status === 'distributed' ? 'text-success' : ''}">Selesai</span>
          </div>
        </div>
      `;

      if (claim.status === 'approved') {
        if (claim.dist_status === 'distributed') {
          step4Title = '🎉 Penyaluran Surplus Selesai';
          step4Body = `
            <div class="card border-0 rounded-4 shadow-sm p-4 mt-3 text-center" style="background: linear-gradient(135deg, rgba(30, 125, 92, 0.05) 0%, rgba(30, 125, 92, 0.12) 100%); border: 1px solid rgba(30, 125, 92, 0.15) !important;">
              <div class="rounded-circle p-3 d-inline-flex align-items-center justify-content-center mb-3" style="background: var(--green); color: white; width: 60px; height: 60px; box-shadow: 0 8px 20px rgba(30, 125, 92, 0.3);">
                <i class="bi bi-patch-check-fill fs-3"></i>
              </div>
              <h6 class="fw-bold mb-1" style="color: var(--green); font-size: 1.1rem;">Distribusi Makanan Selesai!</h6>
              <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.5;">
                Makanan surplus <strong>${claim.food_name}</strong> telah sukses disalurkan kepada penerima manfaat di lokasi tujuan. Anda telah menyelamatkan <strong>${claim.claimed_quantity} porsi</strong> makanan dan berkontribusi nyata mengurangi food waste! Terima kasih atas aksi sosial kemanusiaan lembaga Anda.
              </p>
            </div>
          `;
        } else if (claim.dist_status === 'delivered') {
          step4Title = claim.pickup_method === 'pickup' ? '🛍️ Makanan Telah Diambil' : '📦 Makanan Diterima Lembaga';
          
          actionBtnHtml = `
            <button class="btn-honey px-5 py-2.5 mt-2 rounded-pill d-inline-flex align-items-center gap-2 border-0 shadow" style="background: var(--accent-grad);" onclick="markClaimDistributed(${claim.id})">
              <i class="bi bi-gift-fill"></i>
              Tandai Selesai Disalurkan
            </button>
          `;

          step4Body = `
            <div class="card border-0 rounded-4 shadow-sm p-4 mt-3" style="background: linear-gradient(135deg, rgba(25, 103, 210, 0.05) 0%, rgba(25, 103, 210, 0.12) 100%); border: 1px solid rgba(25, 103, 210, 0.15) !important;">
              <div class="d-flex align-items-center gap-3 mb-3">
                <div class="rounded-circle p-3 d-flex align-items-center justify-content-center" style="background: #1967D2; color: white; width: 50px; height: 50px; box-shadow: 0 6px 15px rgba(25, 103, 210, 0.25);">
                  <i class="bi bi-box-seam-fill fs-4"></i>
                </div>
                <div class="flex-grow-1">
                  <h6 class="fw-bold m-0" style="color: #1967D2;">${claim.pickup_method === 'pickup' ? 'Makanan Telah Diambil' : 'Makanan Diterima Dari Kurir'}</h6>
                  <p class="m-0 text-muted" style="font-size: 0.88rem; line-height: 1.4;">${claim.pickup_method === 'pickup' ? 'Makanan sukses diambil mandiri oleh perwakilan lembaga Anda.' : 'Sukses diterima dari relawan kurir.'} Silakan salurkan makanan kepada warga/penerima manfaat.</p>
                </div>
              </div>
              
              <!-- Map Illustration (Completed) -->
              <div class="map-illustration">
                <div class="map-road"><div class="map-road-progress" style="width: 100%;"></div></div>
                <div class="map-marker donor"><i class="bi bi-shop"></i></div>
                <div class="map-marker lembaga"><i class="bi bi-building-fill-heart"></i></div>
                <div class="map-marker courier" style="left: 88%; animation: none; transform: none; color: var(--green);"><i class="bi bi-check-circle-fill"></i></div>
              </div>

              <div class="border-top mt-3 pt-3 text-center">
                <p class="text-muted mb-2" style="font-size: 0.85rem;"><i class="bi bi-info-circle-fill text-primary"></i> Klik tombol di bawah setelah seluruh makanan selesai disalurkan ke lokasi target:</p>
                ${actionBtnHtml}
              </div>
            </div>
          `;
        } else {
          // In delivery or ready for pickup
          if (claim.pickup_method === 'pickup') {
            step4Title = '🛍️ Makanan Siap Diambil Mandiri';
            
            actionBtnHtml = `
              <button class="btn-sage mt-2 d-inline-flex align-items-center gap-2 border-0 shadow" onclick="markClaimDelivered(${claim.id})">
                <i class="bi bi-check-circle-fill"></i>
                Tandai Telah Diambil Mandiri
              </button>
            `;

            step4Body = `
              <div class="card border-0 rounded-4 shadow-sm p-4 mt-3" style="background: linear-gradient(135deg, rgba(244, 123, 48, 0.04) 0%, rgba(244, 123, 48, 0.08) 100%); border: 1px solid rgba(244, 123, 48, 0.1) !important;">
                <div class="d-flex align-items-center gap-3 mb-3">
                  <div class="rounded-circle p-3 d-flex align-items-center justify-content-center" style="background: var(--accent2); color: white; width: 50px; height: 50px; box-shadow: 0 6px 15px rgba(244, 123, 48, 0.25);">
                    <i class="bi bi-shop fs-4"></i>
                  </div>
                  <div class="flex-grow-1">
                    <h6 class="fw-bold m-0" style="color: var(--accent2);">Ambil Donasi di Lokasi Mitra</h6>
                    <p class="m-0 text-muted" style="font-size: 0.88rem; line-height: 1.4;">Pendonor: <strong>${claim.donor_name}</strong></p>
                  </div>
                </div>
                
                <div class="mb-3">
                  <span class="text-muted fw-bold d-block mb-1" style="font-size: 0.75rem;"><i class="bi bi-geo-alt-fill text-danger"></i> ALAMAT PENGAMBILAN</span>
                  <div class="p-3 bg-white rounded-3 border" style="font-size: 0.88rem; font-weight: 500; color: var(--dark);">
                    ${claim.donor_address || 'Alamat pendonor'}
                  </div>
                </div>

                <!-- Pickup Deadline Details -->
                <div class="d-flex align-items-center gap-2 p-3 rounded-4 border-0 mb-3" style="background: rgba(244, 123, 48, 0.08); color: var(--accent2); font-size: 0.88rem; line-height: 1.4; border-left: 4px solid var(--accent2) !important;">
                  <i class="bi bi-clock-history fs-5" style="color: var(--accent2);"></i>
                  <div>
                    <strong>Batas Waktu Pengambilan:</strong> <span class="text-danger fw-extrabold">${claim.dist_notes || 'Silakan ambil sebelum kedaluwarsa.'}</span>
                  </div>
                </div>

                <!-- Map Illustration (Self Pickup Walk) -->
                <div class="map-illustration">
                  <div class="map-road"><div class="map-road-progress" style="width: 50%;"></div></div>
                  <div class="map-marker donor"><i class="bi bi-shop"></i></div>
                  <div class="map-marker lembaga"><i class="bi bi-building-fill-heart"></i></div>
                  <div class="map-marker courier" style="animation: driveCourier 4.5s ease-in-out infinite alternate;"><i class="bi bi-person-walking text-primary"></i></div>
                </div>

                <div class="border-top mt-3 pt-3 text-center">
                  <p class="text-muted mb-2" style="font-size: 0.85rem;"><i class="bi bi-info-circle-fill text-warning"></i> Konfirmasi jika perwakilan lembaga Anda sudah mengambil makanan dari lokasi donor:</p>
                  ${actionBtnHtml}
                </div>
              </div>
            `;
          } else {
            // Courier Delivery
            const est = getDistanceAndDuration(claim.donor_address, claim.lembaga_address);
            step4Title = '🛵 Kurir Sedang Mengirim Makanan';
            
            actionBtnHtml = `
              <button class="btn-sage mt-2 d-inline-flex align-items-center gap-2 border-0 shadow" onclick="markClaimDelivered(${claim.id})">
                <i class="bi bi-check-circle-fill"></i>
                Tandai Pesanan Telah Diterima
              </button>
            `;

            step4Body = `
              <div class="card border-0 rounded-4 shadow-sm p-4 mt-3" style="background: linear-gradient(135deg, rgba(244, 123, 48, 0.04) 0%, rgba(244, 123, 48, 0.08) 100%); border: 1px solid rgba(244, 123, 48, 0.1) !important;">
                <div class="d-flex align-items-center gap-3 mb-3">
                  <div class="rounded-circle p-3 d-flex align-items-center justify-content-center animate-pulse" style="background: var(--accent2); color: white; width: 50px; height: 50px; box-shadow: 0 6px 15px rgba(244, 123, 48, 0.25);">
                    <i class="bi bi-truck fs-4 animate-bounce"></i>
                  </div>
                  <div class="flex-grow-1">
                    <h6 class="fw-bold m-0" style="color: var(--accent2);">Kurir Sedang Berjalan...</h6>
                    <p class="m-0 text-muted" style="font-size: 0.88rem; line-height: 1.4;">Relawan <strong>${claim.volunteer_name || 'Budi Santoso'}</strong> (<i class="bi bi-telephone-fill text-warning"></i> ${claim.volunteer_phone || '081299887766'}) sedang membawakan makanan surplus.</p>
                  </div>
                </div>

                <!-- Estimasi Jarak & Waktu -->
                <div class="row g-2 mb-3 text-center">
                  <div class="col-6">
                    <div class="p-2.5 bg-white rounded-3 border">
                      <span class="text-muted d-block" style="font-size: 0.72rem;">JARAK PENGANTARAN</span>
                      <strong style="color: var(--accent2); font-size: 1.05rem;"><i class="bi bi-compass"></i> ${est.distance}</strong>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="p-2.5 bg-white rounded-3 border">
                      <span class="text-muted d-block" style="font-size: 0.72rem;">ESTIMASI TIBA</span>
                      <strong style="color: var(--green); font-size: 1.05rem;"><i class="bi bi-clock"></i> ${est.duration}</strong>
                    </div>
                  </div>
                </div>

                <!-- Map Illustration (Courier Drive) -->
                <div class="map-illustration">
                  <div class="map-road"><div class="map-road-progress" style="width: 65%;"></div></div>
                  <div class="map-marker donor"><i class="bi bi-shop"></i></div>
                  <div class="map-marker lembaga"><i class="bi bi-building-fill-heart"></i></div>
                  <div class="map-marker courier" style="animation: driveCourier 3s ease-in-out infinite alternate;"><i class="bi bi-bicycle"></i></div>
                </div>

                <div class="border-top mt-3 pt-3 text-center">
                  <p class="text-muted mb-2" style="font-size: 0.85rem;"><i class="bi bi-info-circle-fill text-warning"></i> Konfirmasi jika Anda sudah mendapatkan makanan dari kurir:</p>
                  ${actionBtnHtml}
                </div>
              </div>
            `;
          }
        }
      } else {
        step4Body = `
          <p class="m-0 text-muted" style="font-size: 0.9rem;">
            Metode: <strong>${claim.pickup_method.toUpperCase()}</strong> • Status: <strong>${claim.status.toUpperCase()}</strong>
          </p>
          <p class="text-muted mt-2" style="font-size: 0.9rem;">Catatan: <em>"${claim.dist_notes || 'Menunggu verifikasi admin untuk diproses.'}"</em></p>
        `;
      }

      let timelineHtml = `
        <!-- E-Commerce style tracking bar -->
        ${trackerHeaderHtml}
        
        <!-- Node 1 -->
        <div class="timeline-node ${step1Class}">
          <div class="timeline-indicator"></div>
          <div class="timeline-node-content">
            <h5>Makanan Surplus Terdaftar <span class="timeline-time">${new Date(claim.created_at).toLocaleTimeString('id-ID')} WITA</span></h5>
            <p>Donatur memasukkan item surplus ${claim.food_name} ke database.</p>
          </div>
        </div>

        <!-- Node 2 -->
        <div class="timeline-node ${step2Class}">
          <div class="timeline-indicator"></div>
          <div class="timeline-node-content">
            <h5>Makanan Diklaim oleh Lembaga <span class="timeline-time">${new Date(claim.claimed_at).toLocaleTimeString('id-ID')} WITA</span></h5>
            <p>Anda telah mengajukan klaim sebanyak <strong>${claim.claimed_quantity} porsi</strong>.</p>
          </div>
        </div>

        <!-- Node 3 -->
        <div class="timeline-node ${step3Class}">
          <div class="timeline-indicator"></div>
          <div class="timeline-node-content">
            <h5>Menunggu Validasi &amp; Persetujuan</h5>
            <p>Status Saat Ini: ${statusBadge} — Verifikasi database dari platform HQ.</p>
          </div>
        </div>

        <!-- Node 4 -->
        <div class="timeline-node ${step4Class}">
          <div class="timeline-indicator"></div>
          <div class="timeline-node-content">
            <h5>${step4Title}</h5>
            ${step4Body}
          </div>
        </div>
      `;
      timeline.innerHTML = timelineHtml;
    }

    // COMPLETE CLAIM RECEIVED helper using Custom UI Modal
    function markClaimDelivered(claimId) {
      showCustomConfirm(
        'Konfirmasi Terima Pesanan',
        'Apakah Anda yakin makanan surplus ini sudah sukses diterima oleh lembaga Anda dari kurir?',
        'bi-check-circle-fill',
        'var(--green)'
      ).then(confirmed => {
        if (!confirmed) return;

        fetch(`/api/claims/${claimId}/delivered`, {
          method: 'POST',
          headers: getHeaders()
        })
        .then(res => {
          return res.json().then(data => {
            if (!res.ok) {
              throw new Error(data.message || 'Gagal menandai pesanan diterima.');
            }
            return data;
          });
        })
        .then(data => {
          showCustomToast('Pesanan Diterima', 'Terima kasih! Pesanan telah ditandai sukses diterima.', 'success');
          loadCatalog();
          loadClaimsTimeline(claimId);
        })
        .catch(err => {
          showCustomToast('Gagal Konfirmasi', err.message, 'error');
        });
      });
    }

    // COMPLETE CLAIM DISTRIBUTED helper using Custom UI Modal
    function markClaimDistributed(claimId) {
      showCustomConfirm(
        'Konfirmasi Selesai Disalurkan',
        'Apakah Anda yakin makanan surplus ini sudah selesai disalurkan ke lokasi tujuan / penerima manfaat?',
        'bi-gift-fill',
        'var(--accent2)'
      ).then(confirmed => {
        if (!confirmed) return;

        fetch(`/api/claims/${claimId}/distributed`, {
          method: 'POST',
          headers: getHeaders()
        })
        .then(res => {
          return res.json().then(data => {
            if (!res.ok) {
              throw new Error(data.message || 'Gagal menandai penyaluran selesai.');
            }
            return data;
          });
        })
        .then(data => {
          showCustomToast('Penyaluran Selesai', 'Luar biasa! Penyaluran makanan surplus telah ditandai sukses selesai.', 'success');
          loadCatalog();
          loadClaimsTimeline(claimId);
        })
        .catch(err => {
          showCustomToast('Gagal Konfirmasi', err.message, 'error');
        });
      });
    }

    // REAL CRUD: Admin Panel Stats & Verification Table (Read, Update)
    function loadAdminPanel() {
      // 1. Stats
      fetch('/api/admin/stats')
      .then(res => res.json())
      .then(stats => {
        document.getElementById('adminStatPorsi').innerText = stats.total_saved;
        document.getElementById('adminStatDonor').innerText = stats.active_donors;
        document.getElementById('adminStatLembaga').innerText = stats.lembaga_count;
        document.getElementById('adminStatPending').innerText = stats.pending_claims;
        document.getElementById('validationPendingBadge').innerText = `${stats.pending_claims} Menunggu Validasi`;
      });

      // 2. Table
      fetch('/api/admin/pending-claims')
      .then(res => res.json())
      .then(claims => {
        const tableBody = document.getElementById('adminValidationTable');
        let html = '';

        if (claims.length === 0) {
          tableBody.innerHTML = `<tr><td colspan="6" class="text-center py-4 text-muted">Tidak ada pengajuan klaim pending saat ini.</td></tr>`;
          return;
        }

        claims.forEach(claim => {
          let statusBadge = `<span class="badge-status" style="background:#FFF3D6; color:#E6A817;">Pending</span>`;
          let actionButtons = `
            <div class="d-flex gap-2 justify-content-center">
              <button class="btn-sage" onclick="processAdminVerify(${claim.id}, 'approved')"><i class="bi bi-check-lg"></i> Setujui</button>
              <button class="btn-danger-custom" onclick="processAdminVerify(${claim.id}, 'rejected')"><i class="bi bi-x-lg"></i> Tolak</button>
            </div>
          `;

          if (claim.status === 'approved') {
            statusBadge = `<span class="badge-status available">APPROVED</span>`;
            actionButtons = `<span class="fw-bold" style="color:var(--green)">APPROVED</span>`;
          } else if (claim.status === 'rejected') {
            statusBadge = `<span class="badge-status" style="background:#FCE4D6; color:#C55A11;">REJECTED</span>`;
            actionButtons = `<span class="fw-bold" style="color:#C55A11">REJECTED</span>`;
          }

          html += `
            <tr style="${claim.status !== 'pending' ? 'opacity:0.7;' : ''}">
              <td>#KL-00${claim.id}</td>
              <td>
                <strong>${claim.food_name}</strong><br>
                <small class="text-muted">${claim.donor_name}</small>
              </td>
              <td>
                <strong>${claim.lembaga_name}</strong><br>
                <small class="text-muted">lembaga_id: ${claim.lembaga_id}</small>
              </td>
              <td>${claim.claimed_quantity} Porsi</td>
              <td>${statusBadge}</td>
              <td class="text-center">${actionButtons}</td>
            </tr>
          `;
        });
        tableBody.innerHTML = html;
      });

      // 3. Real-time activity log
      loadAdminActivities();

      // 4. Admin news panel articles list
      loadAdminArticles();

      // 5. Admin users list
      loadAdminUsers();

      // 6. Registration requests list
      loadAdminRegistrationRequests();
    }

    // Load admin activities dynamically
    function loadAdminActivities() {
      fetch('/api/admin/activities')
      .then(res => res.json())
      .then(activities => {
        const list = document.getElementById('adminActivityLogList');
        let html = '';
        if (activities.length === 0) {
          list.innerHTML = `<li class="text-muted text-center py-4">Belum ada aktivitas platform tercatat.</li>`;
          return;
        }
        activities.forEach(act => {
          let badgeColor = 'var(--accent2)';
          let icon = 'bi-plus-circle';
          if (act.activity_type === 'claim_added') { badgeColor = 'var(--green)'; icon = 'bi-cart-plus'; }
          if (act.activity_type === 'claim_verified') { badgeColor = '#1967D2'; icon = 'bi-patch-check'; }
          
          const timeStr = new Date(act.created_at).toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit'});
          
          html += `
            <li class="mb-3 d-flex align-items-start gap-3 border-bottom pb-2">
              <div class="rounded-circle p-2 d-flex align-items-center justify-content-center text-white" style="background: ${badgeColor}; font-size: 0.9rem; flex-shrink: 0; width: 32px; height: 32px;">
                <i class="bi ${icon}"></i>
              </div>
              <div style="flex:1;">
                <div class="fw-bold" style="font-size: 0.85rem; color: var(--dark);">${act.actor_name}</div>
                <div style="font-size: 0.8rem; color: var(--dark); opacity: 0.8;">${act.description}</div>
                <small class="text-muted" style="font-size: 0.7rem;">Pukul ${timeStr}</small>
              </div>
            </li>
          `;
        });
        list.innerHTML = html;
      });
    }

    // Open detailed report modal overlay from Super Admin cards
    function openAdminDetail(type) {
      if (type === 'porsi') {
        const modalElement = document.getElementById('detailPorsiModal');
        const modal = new bootstrap.Modal(modalElement);
        modal.show();
        
        const body = document.getElementById('detailPorsiTableBody');
        body.innerHTML = `<tr><td colspan="6" class="text-center py-3"><div class="spinner-border text-warning spinner-border-sm" role="status"></div> Loading...</td></tr>`;
        
        fetch('/api/admin/rescued-details')
        .then(res => res.json())
        .then(data => {
          let html = '';
          if (data.length === 0) {
            body.innerHTML = `<tr><td colspan="6" class="text-center py-3 text-muted">Belum ada porsi donasi diselamatkan.</td></tr>`;
            return;
          }
          data.forEach(item => {
            const dateStr = item.approved_at ? new Date(item.approved_at).toLocaleDateString('id-ID', {day: 'numeric', month: 'short', year: 'numeric'}) : '-';
            html += `
              <tr>
                <td>#KL-00${item.id}</td>
                <td><strong>${item.food_name}</strong></td>
                <td>${item.claimed_quantity} ${item.unit}</td>
                <td>${item.donor_name}</td>
                <td>${item.lembaga_name}</td>
                <td>${dateStr}</td>
              </tr>
            `;
          });
          body.innerHTML = html;
        });
      } else if (type === 'donor') {
        const modalElement = document.getElementById('detailDonorModal');
        const modal = new bootstrap.Modal(modalElement);
        modal.show();
        
        const body = document.getElementById('detailDonorTableBody');
        body.innerHTML = `<tr><td colspan="5" class="text-center py-3"><div class="spinner-border text-warning spinner-border-sm" role="status"></div> Loading...</td></tr>`;
        
        fetch('/api/admin/active-donors')
        .then(res => res.json())
        .then(data => {
          let html = '';
          if (data.length === 0) {
            body.innerHTML = `<tr><td colspan="5" class="text-center py-3 text-muted">Belum ada mitra donor aktif.</td></tr>`;
            return;
          }
          data.forEach(item => {
            html += `
              <tr>
                <td>donor_id: ${item.id}</td>
                <td><strong>${item.organization_name || item.name}</strong></td>
                <td>${item.email}</td>
                <td>${item.phone || '-'}</td>
                <td>${item.address || '-'}</td>
              </tr>
            `;
          });
          body.innerHTML = html;
        });
      } else if (type === 'lembaga') {
        const modalElement = document.getElementById('detailLembagaModal');
        const modal = new bootstrap.Modal(modalElement);
        modal.show();
        
        const body = document.getElementById('detailLembagaTableBody');
        body.innerHTML = `<tr><td colspan="5" class="text-center py-3"><div class="spinner-border text-warning spinner-border-sm" role="status"></div> Loading...</td></tr>`;
        
        fetch('/api/admin/active-lembaga')
        .then(res => res.json())
        .then(data => {
          let html = '';
          if (data.length === 0) {
            body.innerHTML = `<tr><td colspan="5" class="text-center py-3 text-muted">Belum ada lembaga terdaftar.</td></tr>`;
            return;
          }
          data.forEach(item => {
            html += `
              <tr>
                <td>lembaga_id: ${item.id}</td>
                <td><strong>${item.organization_name || item.name}</strong></td>
                <td>${item.email}</td>
                <td>${item.phone || '-'}</td>
                <td>${item.address || '-'}</td>
              </tr>
            `;
          });
          body.innerHTML = html;
        });
      } else if (type === 'pending') {
        // Scroll to validation table
        document.getElementById('adminValidationTable').scrollIntoView({ behavior: 'smooth', block: 'center' });
        showCustomToast('Klaim Pending', 'Menampilkan daftar validasi klaim yang menunggu persetujuan.', 'info');
      }
    }

    // REAL CRUD: Verify claim in Admin Panel (Update status)
    async function processAdminVerify(id, status) {
      const isApproved = status === 'approved';
      const actionTitle = isApproved ? 'Setujui Klaim' : 'Tolak Klaim';
      const actionText = isApproved ? 'menyetujui' : 'menolak';
      const icon = isApproved ? 'bi-check-circle-fill' : 'bi-x-circle-fill';
      const color = isApproved ? 'var(--green)' : '#E74C3C';

      const confirmVerify = await showCustomConfirm(
        actionTitle,
        `Apakah Anda yakin ingin ${actionText} pengajuan klaim #${id}?`,
        icon,
        color
      );

      if (confirmVerify) {
        fetch(`/api/admin/claims/${id}/verify`, {
          method: 'POST',
          headers: getHeaders(),
          body: JSON.stringify({ status: status })
        })
        .then(res => res.json())
        .then(res => {
          showCustomToast('Verifikasi Sukses', `Klaim #${id} sukses diverifikasi sebagai ${status.toUpperCase()}.`, 'success');
          loadAdminPanel();
        });
      }
    }



    // Filter Catalog
    function filterCatalog(category) {
      // Handle active button class
      const filterPills = document.querySelectorAll('.filter-pill');
      filterPills.forEach(pill => pill.classList.remove('active'));
      
      // Target correct trigger button
      const clickedBtn = Array.from(filterPills).find(p => p.innerText.toLowerCase().includes(category.replace('_', ' ').toLowerCase()) || (category === 'semua' && p.innerText === 'Semua'));
      if(clickedBtn) {
        clickedBtn.classList.add('active');
      }

      const searchQuery = document.getElementById('catalogSearchInput') ? document.getElementById('catalogSearchInput').value.toLowerCase() : '';

      // Hide/Show items in grid
      const cards = document.querySelectorAll('#catalogFoodGrid .food-card');
      cards.forEach(card => {
        const itemCat = card.getAttribute('data-category');
        const itemName = card.querySelector('h4').innerText.toLowerCase();

        const matchesCategory = (category === 'semua' || itemCat === category);
        const matchesSearch = itemName.includes(searchQuery);

        if (matchesCategory && matchesSearch) {
          card.style.display = 'flex';
        } else {
          card.style.display = 'none';
        }
      });
    }

    // Search Catalog
    function searchCatalog(query) {
      const q = query.toLowerCase();
      const cards = document.querySelectorAll('#catalogFoodGrid .food-card');
      
      // Get the currently active category filter
      const activePill = document.querySelector('.filter-pill.active');
      let activeCategory = 'semua';
      if (activePill) {
        const pillText = activePill.innerText.toLowerCase();
        if (pillText.includes('berat')) activeCategory = 'makanan_berat';
        else if (pillText.includes('roti') || pillText.includes('kue')) activeCategory = 'roti';
        else if (pillText.includes('snack')) activeCategory = 'snack';
        else if (pillText.includes('minuman')) activeCategory = 'minuman';
      }

      cards.forEach(card => {
        const itemCat = card.getAttribute('data-category');
        const itemName = card.querySelector('h4').innerText.toLowerCase();
        
        const matchesCategory = (activeCategory === 'semua' || itemCat === activeCategory);
        const matchesSearch = itemName.includes(q);

        if (matchesCategory && matchesSearch) {
          card.style.display = 'flex';
        } else {
          card.style.display = 'none';
        }
      });
    }

    // ==========================================
    // PORTAL BERITA & MANAJEMEN ARTIKEL AJAX
    // ==========================================

    // Helper to generate dynamic premium background pattern with Bootstrap Icons or image
    function getArticleThumbnailHtml(category, imagePath) {
      if (imagePath) {
        return `<img src="${imagePath}" class="w-100 h-100 object-fit-cover" style="transition: var(--transition);" alt="Article thumbnail">`;
      }
      
      let icon = 'bi-newspaper';
      let themeClass = 'theme-default';
      
      if (category === 'edukasi') {
        icon = 'bi-book-half';
        themeClass = 'theme-edu';
      } else if (category === 'sosial') {
        icon = 'bi-heart-fill';
        themeClass = 'theme-social';
      } else if (category === 'tips') {
        icon = 'bi-lightbulb-fill';
        themeClass = 'theme-tips';
      }
      
      return `
        <div class="article-thumb-pattern ${themeClass} d-flex align-items-center justify-content-center position-relative">
          <div class="thumb-decor-circle-1"></div>
          <div class="thumb-decor-circle-2"></div>
          <div class="thumb-icon-badge">
            <i class="bi ${icon}"></i>
          </div>
        </div>
      `;
    }

    // Full mobile-friendly page reading for articles
    function readArticleFull(articleId) {
      // Swaps layout view to full page reader
      showTab('read-article');
      
      const cover = document.getElementById('fullArticleCover');
      const title = document.getElementById('fullArticleTitle');
      const cat = document.getElementById('fullArticleCategory');
      const dateElem = document.getElementById('fullArticleDate');
      const author = document.getElementById('fullArticleAuthor');
      const views = document.getElementById('fullArticleViews');
      const content = document.getElementById('fullArticleContent');

      content.innerHTML = `<div class="text-center py-5 text-muted"><div class="spinner-border text-warning spinner-border-sm" role="status"></div> Sedang memuat artikel...</div>`;

      fetch(`/api/articles/${articleId}`)
      .then(res => {
        if (!res.ok) throw new Error('Artikel tidak ditemukan.');
        return res.json();
      })
      .then(art => {
        // Sync cover image or dynamic premium pattern
        if (art.image_path) {
          cover.innerHTML = `<img src="${art.image_path}" class="w-100 h-100 object-fit-cover">`;
        } else {
          let themeClass = 'theme-default';
          let icon = 'bi-newspaper';
          if (art.category === 'edukasi') { themeClass = 'theme-edu'; icon = 'bi-book-half'; }
          else if (art.category === 'sosial') { themeClass = 'theme-social'; icon = 'bi-heart-fill'; }
          else if (art.category === 'tips') { themeClass = 'theme-tips'; icon = 'bi-lightbulb-fill'; }
          
          cover.innerHTML = `
            <div class="article-thumb-pattern ${themeClass} w-100 h-100 d-flex align-items-center justify-content-center position-relative" style="height: 350px !important;">
              <div class="thumb-decor-circle-1" style="width: 250px; height: 250px;"></div>
              <div class="thumb-decor-circle-2" style="width: 200px; height: 200px;"></div>
              <div class="thumb-icon-badge" style="width: 120px; height: 120px; font-size: 3.5rem;">
                <i class="bi ${icon}"></i>
              </div>
            </div>
          `;
        }

        title.innerText = art.title;
        cat.innerText = art.category.toUpperCase();
        
        if (art.category === 'edukasi') cat.style.backgroundColor = 'var(--green)';
        else if (art.category === 'sosial') cat.style.backgroundColor = 'var(--accent2)';
        else cat.style.backgroundColor = 'var(--dark-muted)';

        const dateStr = new Date(art.created_at || art.updated_at).toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'});
        dateElem.innerHTML = `<i class="bi bi-calendar-event"></i> ${dateStr}`;
        author.innerHTML = `<i class="bi bi-person-fill text-warning"></i> ${art.author || 'Admin'}`;
        
        const currentViews = (art.views || 0) + 1;
        views.innerHTML = `<i class="bi bi-eye-fill text-primary"></i> ${currentViews} Dibaca`;
        content.innerText = art.content;

        // Reload lists silently to update counters
        loadArticles();
      })
      .catch(err => {
        showCustomToast('Gagal Memuat Artikel', err.message, 'error');
        showTab('news');
      });
    }

    // 1. Fetch public articles and render dynamic cards
    function loadArticles(category = 'semua') {
      let url = '/api/articles';
      if (category !== 'semua') {
        url += `?category=${category}`;
      }
      
      fetch(url)
      .then(res => res.json())
      .then(data => {
        const grid = document.getElementById('publicArticlesGrid');
        let gridHtml = '';
        
        if (data.length === 0) {
          grid.innerHTML = `
            <div class="col-12 text-center py-5 text-muted">
              <i class="bi bi-journal-x" style="font-size:3rem; color:var(--dark-muted)"></i>
              <h5 class="mt-3">Belum ada artikel dalam kategori ini.</h5>
            </div>
          `;
          return;
        }
        
        // Populate the dynamic headline banner with first article if category is 'semua'
        if (category === 'semua' && data.length > 0) {
          const first = data[0];
          const headlineTitle = document.querySelector('.news-headline-banner .headline-title');
          const headlineSnippet = document.querySelector('.news-headline-banner .headline-snippet');
          const headlineMeta = document.querySelector('.news-headline-banner .headline-meta');
          const headlineImg = document.querySelector('.news-headline-banner .headline-img-wrapper');
          const headlineBtn = document.querySelector('.news-headline-banner button');
          
          if (headlineTitle) headlineTitle.innerText = first.title;
          if (headlineSnippet) headlineSnippet.innerText = first.snippet || (first.content.substring(0, 150) + '...');
          if (headlineMeta) {
            const dateStr = new Date(first.created_at || first.updated_at).toLocaleDateString('id-ID', {day: 'numeric', month: 'short', year: 'numeric'});
            const viewCount = first.views || 0;
            headlineMeta.innerHTML = `
              <span><i class="bi bi-person-fill text-warning"></i> ${first.author || 'Admin'}</span>
              <span><i class="bi bi-calendar-event text-warning"></i> ${dateStr}</span>
              <span><i class="bi bi-eye-fill text-primary"></i> ${viewCount} Pembaca</span>
            `;
          }
          if (headlineImg) {
            const imgPath = first.image_path ? first.image_path : "{{ asset('featured_article_default.png') }}";
            headlineImg.innerHTML = `<img src="${imgPath}" class="w-100 h-100 object-fit-cover" style="transition: var(--transition);" alt="Featured Article cover">`;
          }
          if (headlineBtn) {
            headlineBtn.setAttribute('onclick', `readArticleFull(${first.id})`);
            headlineBtn.innerText = 'Baca Artikel Utama →';
          }
        }
        
        // Populate articles in the 3-column grid
        data.forEach(art => {
          const dateStr = new Date(art.created_at || art.updated_at).toLocaleDateString('id-ID', {day: 'numeric', month: 'short', year: 'numeric'});
          const snippet = art.snippet || (art.content.substring(0, 100) + '...');
          const thumbHtml = getArticleThumbnailHtml(art.category, art.image_path);
          
          let tagClass = 'tag-default';
          if (art.category === 'edukasi') tagClass = 'tag-edukasi';
          else if (art.category === 'sosial') tagClass = 'tag-sosial';
          else if (art.category === 'tips') tagClass = 'tag-tips';

          gridHtml += `
            <div class="article-card">
              <div class="article-card-img" style="height: 200px; position: relative; overflow: hidden;">
                ${thumbHtml}
                <span class="article-category-tag ${tagClass}">${art.category.toUpperCase()}</span>
              </div>
              <div class="article-card-body" style="padding: 24px; display: flex; flex-direction: column; flex: 1;">
                <div class="d-flex align-items-center justify-content-between mb-2">
                  <span class="text-muted fw-semibold" style="font-size: 0.8rem;"><i class="bi bi-calendar-event"></i> ${dateStr}</span>
                  <span class="text-muted fw-semibold" style="font-size: 0.8rem;"><i class="bi bi-eye-fill text-primary"></i> ${art.views || 0}</span>
                </div>
                <h4 class="article-card-title fw-bold" style="font-size: 1.15rem; color: var(--dark); line-height: 1.4; margin-bottom: 10px;">${art.title}</h4>
                <p class="article-card-snippet text-muted" style="font-size: 0.88rem; line-height: 1.6; margin-bottom: 20px;">${snippet}</p>
                <div class="d-flex align-items-center justify-content-between mt-auto pt-3 border-top">
                  <div class="article-author">
                    <div class="article-author-avatar" style="width: 28px; height: 28px; border-radius: 50%; background: var(--accent-grad); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 700;">
                      ${art.author ? art.author.charAt(0).toUpperCase() : 'A'}
                    </div>
                    <span style="font-size: 0.8rem; font-weight: 600; color: var(--dark-muted);">${art.author || 'Admin'}</span>
                  </div>
                  <button class="btn-read-more" onclick="readArticleFull(${art.id})">Baca <i class="bi bi-arrow-right"></i></button>
                </div>
              </div>
            </div>
          `;
        });
        grid.innerHTML = gridHtml;
      })
      .catch(err => {
        showCustomToast('Gagal Memuat Berita', 'Terjadi kesalahan saat memuat daftar artikel.', 'error');
      });
    }

    // 2. Filter news by category pill on public portal
    function filterNews(category, clickedBtn) {
      const pills = document.querySelectorAll('.news-filter-pills .news-filter-pill');
      pills.forEach(pill => pill.classList.remove('active'));
      
      if (clickedBtn) {
        clickedBtn.classList.add('active');
      }
      
      loadArticles(category);
    }

    // 3. Switch admin sub-tabs (Overview, Manajemen Berita, Kelola Pengguna)
    function showAdminSubTab(subpageName, clickedLi) {
      // Hide all sub pages
      document.querySelectorAll('.admin-sub-page').forEach(page => {
        page.classList.remove('active');
      });
      
      // Show targeted sub page
      const targetId = 'adminSub' + subpageName.charAt(0).toUpperCase() + subpageName.slice(1);
      const target = document.getElementById(targetId);
      if (target) {
        target.classList.add('active');
      }
      
      // Update sidebar active status
      document.querySelectorAll('.admin-sidebar-nav li').forEach(li => {
        li.classList.remove('active');
      });
      
      if (clickedLi) {
        clickedLi.classList.add('active');
      }
      
      // Load specific sub-tab context
      if (subpageName === 'berita') {
        loadAdminArticles();
      } else if (subpageName === 'pengguna') {
        loadAdminUsers();
      } else if (subpageName === 'overview') {
        loadAdminPanel();
      } else if (subpageName === 'registrasi') {
        loadAdminRegistrationRequests();
      } else if (subpageName === 'logs') {
        loadSystemLogs();
      }
    }

    // 4. Fetch and render all articles in Admin Panel Table
    function loadAdminArticles() {
      fetch('/api/articles')
      .then(res => res.json())
      .then(data => {
        const tableBody = document.getElementById('adminArticleBody');
        const badge = document.getElementById('totalArticleBadge');
        
        if (badge) badge.innerText = `${data.length} Artikel Aktif`;
        
        let html = '';
        if (data.length === 0) {
          tableBody.innerHTML = `<tr><td colspan="8" class="text-center py-4 text-muted">Belum ada artikel terpublikasi.</td></tr>`;
          return;
        }
        
        data.forEach((art, idx) => {
          const dateStr = new Date(art.created_at || art.updated_at).toLocaleDateString('id-ID', {day: 'numeric', month: 'short', year: 'numeric'});
          html += `
            <tr>
              <td>${idx + 1}</td>
              <td>
                <strong>${art.title}</strong>
              </td>
              <td><span class="category-pill">${art.category.toUpperCase()}</span></td>
              <td>${art.author || 'Admin'}</td>
              <td class="fw-bold text-primary"><i class="bi bi-eye-fill"></i> ${art.views || 0}</td>
              <td>${dateStr}</td>
              <td><span class="badge-status available">Published</span></td>
              <td class="text-center">
                <div class="d-flex gap-2 justify-content-center">
                  <button class="btn btn-sm btn-outline-primary" style="border-radius:20px; font-weight:600; padding:6px 14px;" onclick="previewArticle(${art.id})"><i class="bi bi-eye"></i> Lihat</button>
                  <button class="btn btn-sm btn-honey-outline py-2 px-3" style="font-weight:600; font-size:0.85rem;" onclick="openArticleModal('edit', ${art.id})"><i class="bi bi-pencil-square"></i> Edit</button>
                  <button class="btn btn-sm btn-danger-custom py-2 px-3" style="font-weight:600; font-size:0.85rem;" onclick="deleteArticle(${art.id})"><i class="bi bi-trash"></i> Hapus</button>
                </div>
              </td>
            </tr>
          `;
        });
        tableBody.innerHTML = html;
      })
      .catch(err => {
        showCustomToast('Gagal Memuat Artikel', 'Terjadi kesalahan saat mengambil data dari database.', 'error');
      });
    }

    // 5. Open Tulis / Edit Article Form Modal
    function openArticleModal(mode, articleId = null) {
      const form = document.getElementById('articleForm');
      if (form) form.reset();
      
      const titleElem = document.getElementById('articleFormTitle');
      const submitTextElem = document.getElementById('articleSubmitText');
      const editIdElem = document.getElementById('articleEditId');
      
      if (mode === 'create') {
        if (titleElem) titleElem.innerHTML = `<i class="bi bi-pencil-square" style="color:var(--accent2)"></i> Tulis Artikel Baru`;
        if (submitTextElem) submitTextElem.innerText = 'Terbitkan';
        if (editIdElem) editIdElem.value = '';
        
        const modal = new bootstrap.Modal(document.getElementById('modalArticleForm'));
        modal.show();
      } else if (mode === 'edit' && articleId) {
        showCustomConfirm(
          'Edit Artikel',
          'Apakah Anda yakin ingin mengedit artikel ini?',
          'bi-pencil-square',
          'var(--accent2)'
        ).then(confirmEdit => {
          if (!confirmEdit) return;
          
          if (titleElem) titleElem.innerHTML = `<i class="bi bi-pencil-square" style="color:var(--accent2)"></i> Edit Artikel`;
          if (submitTextElem) submitTextElem.innerText = 'Simpan Perubahan';
          if (editIdElem) editIdElem.value = articleId;
          
          fetch(`/api/articles/${articleId}`)
          .then(res => {
            if (!res.ok) throw new Error('Artikel tidak ditemukan.');
            return res.json();
          })
          .then(art => {
            document.getElementById('articleTitle').value = art.title;
            document.getElementById('articleCategory').value = art.category;
            document.getElementById('articleContent').value = art.content;
            
            const modal = new bootstrap.Modal(document.getElementById('modalArticleForm'));
            modal.show();
          })
          .catch(err => {
            showCustomToast('Gagal Mengambil Artikel', err.message, 'error');
          });
        });
      }
    }

    // 6. Submit Article Form (AJAX POST/PUT)
    function submitArticleForm(event) {
      event.preventDefault();
      
      const id = document.getElementById('articleEditId').value;
      const isEdit = id && id.trim() !== '';
      
      const confirmTitle = isEdit ? 'Simpan Perubahan' : 'Terbitkan Artikel';
      const confirmMsg = isEdit ? 'Apakah Anda yakin ingin menyimpan perubahan pada artikel ini?' : 'Apakah Anda yakin ingin menerbitkan artikel baru ini?';
      const confirmIcon = isEdit ? 'bi-check-circle-fill' : 'bi-send-fill';
      const confirmColor = isEdit ? 'var(--green)' : 'var(--accent2)';
      
      showCustomConfirm(confirmTitle, confirmMsg, confirmIcon, confirmColor).then(confirmed => {
        if (!confirmed) return;
        
        const title = document.getElementById('articleTitle').value;
        const category = document.getElementById('articleCategory').value;
        const content = document.getElementById('articleContent').value;
        const author = document.getElementById('articleAuthor').value || 'Admin';
        
        const url = isEdit ? `/api/articles/${id}` : '/api/articles';
        const method = isEdit ? 'PUT' : 'POST';
        
        const payload = {
          title: title,
          category: category,
          content: content,
          author: author
        };
        
        fetch(url, {
          method: method,
          headers: getHeaders(),
          body: JSON.stringify(payload)
        })
        .then(res => {
          if (!res.ok) throw new Error('Gagal menyimpan artikel.');
          return res.json();
        })
        .then(res => {
          // Hide modal
          const modalElem = document.getElementById('modalArticleForm');
          const modal = bootstrap.Modal.getInstance(modalElem);
          if (modal) modal.hide();
          
          // Reload listings
          loadAdminArticles();
          if (document.getElementById('page-news').classList.contains('active')) {
            loadArticles();
          }
          
          const msg = isEdit ? 'Artikel berhasil diperbarui.' : 'Artikel baru berhasil diterbitkan.';
          showCustomToast('Sukses', msg, 'success');
        })
        .catch(err => {
          showCustomToast('Gagal Menyimpan', err.message, 'error');
        });
      });
    }

    // 7. Preview Article inside Modal
    function previewArticle(articleId) {
      fetch(`/api/articles/${articleId}`)
      .then(res => {
        if (!res.ok) throw new Error('Artikel tidak ditemukan.');
        return res.json();
      })
      .then(art => {
        const titleElem = document.getElementById('previewTitle');
        const catElem = document.getElementById('previewCategory');
        const dateElem = document.getElementById('previewDate');
        const authorElem = document.getElementById('previewAuthor');
        const contentElem = document.getElementById('previewContent');
        const imgElem = document.getElementById('previewImg');
        
        const dateStr = new Date(art.created_at || art.updated_at).toLocaleDateString('id-ID', {day: 'numeric', month: 'short', year: 'numeric'});
        
        if (titleElem) titleElem.innerText = art.title;
        if (catElem) {
          catElem.innerText = art.category.toUpperCase();
          if (art.category === 'edukasi') catElem.style.backgroundColor = 'var(--green)';
          else if (art.category === 'sosial') catElem.style.backgroundColor = 'var(--accent2)';
          else catElem.style.backgroundColor = 'var(--dark-muted)';
        }
        if (dateElem) dateElem.innerHTML = `<i class="bi bi-calendar-event"></i> ${dateStr}`;
        if (authorElem) authorElem.innerHTML = `<i class="bi bi-person"></i> ${art.author || 'Admin'}`;
        if (contentElem) contentElem.innerText = art.content;
        if (imgElem) {
          if (art.image_path) {
            imgElem.innerHTML = `<img src="${art.image_path}" class="w-100 h-100 object-fit-cover" style="border-radius:18px;">`;
            imgElem.style.fontSize = 'inherit';
          } else {
            let icon = 'bi-newspaper';
            if (art.category === 'edukasi') icon = 'bi-book-half';
            else if (art.category === 'sosial') icon = 'bi-heart-fill';
            else if (art.category === 'tips') icon = 'bi-lightbulb-fill';
            imgElem.innerHTML = `<i class="bi ${icon}"></i>`;
            imgElem.style.fontSize = '6rem';
          }
        }
        
        const modal = new bootstrap.Modal(document.getElementById('modalArticlePreview'));
        modal.show();
      })
      .catch(err => {
        showCustomToast('Gagal Memuat Pratinjau', err.message, 'error');
      });
    }

    // 8. Delete Article with Custom Confirm Promise
    async function deleteArticle(articleId) {
      const confirmed = await showCustomConfirm(
        'Hapus Artikel',
        'Apakah Anda yakin ingin menghapus artikel ini secara permanen dari database?',
        'bi-trash-fill',
        '#E74C3C'
      );
      
      if (confirmed) {
        fetch(`/api/articles/${articleId}`, {
          method: 'DELETE',
          headers: getHeaders()
        })
        .then(res => {
          if (!res.ok) throw new Error('Gagal menghapus artikel.');
          return res.json();
        })
        .then(res => {
          showCustomToast('Artikel Dihapus', 'Artikel berhasil dihapus dari database.', 'success');
          loadAdminArticles();
          if (document.getElementById('page-news').classList.contains('active')) {
            loadArticles();
          }
        })
        .catch(err => {
          showCustomToast('Gagal Menghapus', err.message, 'error');
        });
      }
    }

    // 9. Load and render users list in Kelola Pengguna
    function loadAdminUsers() {
      // Load Donors list
      fetch('/api/admin/active-donors')
      .then(res => res.json())
      .then(data => {
        const tableBody = document.getElementById('adminUsersDonorBody');
        const badge = document.getElementById('adminDonorCountBadge');
        
        if (badge) badge.innerText = `${data.length} Akun Terdaftar`;
        
        let html = '';
        if (data.length === 0) {
          tableBody.innerHTML = `<tr><td colspan="7" class="text-center py-4 text-muted">Belum ada akun mitra donor terdaftar.</td></tr>`;
          return;
        }
        
        data.forEach(item => {
          html += `
            <tr>
              <td>donor_id: ${item.id}</td>
              <td><strong>${item.organization_name || item.name}</strong></td>
              <td>${item.email}</td>
              <td>${item.address || '-'}</td>
              <td class="fw-bold text-success">${item.total_shared || 0} Porsi</td>
              <td><span class="badge-status available">Aktif</span></td>
              <td class="text-center">
                <button class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1.5 fw-bold" onclick="showUserStatsModal(${item.id})">
                  <i class="bi bi-bar-chart-line-fill"></i> Statistik
                </button>
              </td>
            </tr>
          `;
        });
        tableBody.innerHTML = html;
      })
      .catch(err => {
        showCustomToast('Gagal Memuat Mitra Donor', 'Terjadi kesalahan saat mengambil data donor.', 'error');
      });

      // Load Lembaga list
      fetch('/api/admin/active-lembaga')
      .then(res => res.json())
      .then(data => {
        const tableBody = document.getElementById('adminUsersLembagaBody');
        const badge = document.getElementById('adminLembagaCountBadge');
        
        if (badge) badge.innerText = `${data.length} Akun Terdaftar`;
        
        let html = '';
        if (data.length === 0) {
          tableBody.innerHTML = `<tr><td colspan="7" class="text-center py-4 text-muted">Belum ada akun lembaga terdaftar.</td></tr>`;
          return;
        }
        
        data.forEach(item => {
          html += `
            <tr>
              <td>lembaga_id: ${item.id}</td>
              <td><strong>${item.organization_name || item.name}</strong></td>
              <td>${item.email}</td>
              <td>${item.address || '-'}</td>
              <td class="fw-bold text-primary">${item.total_claims || 0} Porsi</td>
              <td><span class="badge-status available">Aktif</span></td>
              <td class="text-center">
                <button class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1.5 fw-bold" onclick="showUserStatsModal(${item.id})">
                  <i class="bi bi-bar-chart-line-fill"></i> Statistik
                </button>
              </td>
            </tr>
          `;
        });
        tableBody.innerHTML = html;
      })
      .catch(err => {
        showCustomToast('Gagal Memuat Lembaga', 'Terjadi kesalahan saat mengambil data lembaga.', 'error');
      });
    }

    // Show stats report modal for Admin
    function showUserStatsModal(userId) {
      fetch(`/api/users/${userId}/stats`)
      .then(res => {
        if (!res.ok) throw new Error('Gagal mengambil data statistik pengguna.');
        return res.json();
      })
      .then(data => {
        document.getElementById('modalUserOrgName').innerText = data.user.organization_name || data.user.name;
        document.getElementById('modalUserEmail').innerText = data.user.email;
        
        const roleIcon = document.getElementById('modalUserRoleIcon');
        const roleBadge = document.getElementById('modalUserRoleBadge');
        
        if (data.role === 'donor') {
          roleIcon.innerHTML = '<i class="bi bi-shop"></i>';
          roleIcon.style.background = 'var(--accent-grad)';
          roleBadge.innerText = 'MITRA DONOR';
          roleBadge.style.background = 'var(--accent2)';
          
          document.getElementById('modalStatsGrid').innerHTML = `
            <div class="col-md-4">
              <div class="p-3 rounded-4 bg-light border text-center">
                <h4 class="fw-extrabold m-0 text-success">${data.total_portions}</h4>
                <small class="text-muted fw-bold">Porsi Didonasikan</small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="p-3 rounded-4 bg-light border text-center">
                <h4 class="fw-extrabold m-0 text-primary">${data.claimed_portions}</h4>
                <small class="text-muted fw-bold">Porsi Sukses Diklaim</small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="p-3 rounded-4 bg-light border text-center">
                <h4 class="fw-extrabold m-0 text-warning">${data.helped_count}</h4>
                <small class="text-muted fw-bold">Lembaga Terbantu</small>
              </div>
            </div>
          `;
          
          let categoryHtml = '';
          if (data.categories && data.categories.length > 0) {
            data.categories.forEach(cat => {
              const label = cat.category === 'makanan_berat' ? 'Makanan Berat' : (cat.category === 'roti' ? 'Roti & Kue' : (cat.category === 'snack' ? 'Snack' : (cat.category === 'minuman' ? 'Minuman' : cat.category.toUpperCase())));
              const percent = data.total_portions > 0 ? Math.round((cat.total / data.total_portions) * 100) : 0;
              categoryHtml += `
                <div class="mb-3">
                  <div class="d-flex justify-content-between text-muted small mb-1 fw-bold">
                    <span>${label}</span>
                    <span>${cat.total} Porsi (${percent}%)</span>
                  </div>
                  <div class="progress" style="height: 8px; border-radius: 10px;">
                    <div class="progress-bar" role="progressbar" style="width: ${percent}%; background: var(--accent2);" aria-valuenow="${percent}" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              `;
            });
          } else {
            categoryHtml = '<div class="text-muted small py-2">Belum ada donasi makanan surplus.</div>';
          }
          document.getElementById('modalCategoryList').innerHTML = categoryHtml;
          
          document.getElementById('modalDistributionPrefContent').innerHTML = `
            <div class="p-3 rounded-4 bg-light h-100" style="border: 1px solid rgba(56,38,21,0.05); min-height: 110px;">
              <div class="mb-3">
                <strong class="small text-muted d-block mb-1">TOTAL ITEM MAKANAN</strong>
                <span class="fw-extrabold text-dark" style="font-size: 1.1rem;">${data.total_items} Jenis Surplus</span>
              </div>
              <div class="mb-0">
                <strong class="small text-muted d-block mb-1">SUCCESS RATE PENYELAMATAN</strong>
                <span class="fw-extrabold text-success" style="font-size: 1.1rem;">
                  ${data.total_portions > 0 ? Math.round((data.claimed_portions / data.total_portions) * 100) : 0}% Makanan Terselamatkan
                </span>
              </div>
            </div>
          `;
          
          document.getElementById('modalHistoryHeader').innerHTML = `
            <tr>
              <th class="px-3 py-2">Nama Hidangan</th>
              <th class="px-3 py-2">Kuantitas</th>
              <th class="px-3 py-2">Kategori</th>
              <th class="px-3 py-2">Status</th>
              <th class="px-3 py-2">Terdaftar</th>
            </tr>
          `;
          
          let historyHtml = '';
          if (data.recent_donations && data.recent_donations.length > 0) {
            data.recent_donations.forEach(item => {
              const statusBadge = item.status === 'available' 
                ? '<span class="badge bg-success-subtle text-success border px-2 py-1" style="font-size:0.75rem; border-radius:12px;">Tersedia</span>'
                : '<span class="badge bg-primary-subtle text-primary border px-2 py-1" style="font-size:0.75rem; border-radius:12px;">Klaim Selesai</span>';
              const dateStr = new Date(item.created_at).toLocaleDateString('id-ID', {day: 'numeric', month: 'short'});
              historyHtml += `
                <tr>
                  <td class="px-3 py-2.5"><strong>${item.food_name}</strong></td>
                  <td class="px-3 py-2.5">${item.quantity} ${item.unit}</td>
                  <td class="px-3 py-2.5 text-capitalize">${item.category.replace('_', ' ')}</td>
                  <td class="px-3 py-2.5">${statusBadge}</td>
                  <td class="px-3 py-2.5 small text-muted">${dateStr}</td>
                </tr>
              `;
            });
          } else {
            historyHtml = '<tr><td colspan="5" class="text-center py-4 text-muted">Belum ada riwayat donasi.</td></tr>';
          }
          document.getElementById('modalHistoryBody').innerHTML = historyHtml;
          
        } else {
          roleIcon.innerHTML = '<i class="bi bi-building"></i>';
          roleIcon.style.background = 'linear-gradient(135deg, #1E7D5C 0%, #39B086 100%)';
          roleBadge.innerText = 'LEMBAGA SOSIAL';
          roleBadge.style.background = 'var(--green)';
          
          document.getElementById('modalStatsGrid').innerHTML = `
            <div class="col-md-4">
              <div class="p-3 rounded-4 bg-light border text-center">
                <h4 class="fw-extrabold m-0 text-success">${data.approved_portions}</h4>
                <small class="text-muted fw-bold">Porsi Diselamatkan</small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="p-3 rounded-4 bg-light border text-center">
                <h4 class="fw-extrabold m-0 text-primary">${data.total_claims}</h4>
                <small class="text-muted fw-bold">Total Klaim Diajukan</small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="p-3 rounded-4 bg-light border text-center">
                <h4 class="fw-extrabold m-0 text-warning">
                  ${data.total_claims > 0 ? Math.round((data.approved_count / data.total_claims) * 100) : 0}%
                </h4>
                <small class="text-muted fw-bold">Tingkat Persetujuan</small>
              </div>
            </div>
          `;
          
          let categoryHtml = '';
          if (data.categories && data.categories.length > 0) {
            data.categories.forEach(cat => {
              const label = cat.category === 'makanan_berat' ? 'Makanan Berat' : (cat.category === 'roti' ? 'Roti & Kue' : (cat.category === 'snack' ? 'Snack' : (cat.category === 'minuman' ? 'Minuman' : cat.category.toUpperCase())));
              const percent = data.total_portions > 0 ? Math.round((cat.total / data.total_portions) * 100) : 0;
              categoryHtml += `
                <div class="mb-3">
                  <div class="d-flex justify-content-between text-muted small mb-1 fw-bold">
                    <span>${label}</span>
                    <span>${cat.total} Porsi (${percent}%)</span>
                  </div>
                  <div class="progress" style="height: 8px; border-radius: 10px;">
                    <div class="progress-bar" role="progressbar" style="width: ${percent}%; background: var(--green);" aria-valuenow="${percent}" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              `;
            });
          } else {
            categoryHtml = '<div class="text-muted small py-2">Belum ada makanan diselamatkan.</div>';
          }
          document.getElementById('modalCategoryList').innerHTML = categoryHtml;
          
          const delivery = data.pickup_methods.find(m => m.pickup_method === 'delivery');
          const pickup = data.pickup_methods.find(m => m.pickup_method === 'pickup');
          const delCount = delivery ? delivery.count : 0;
          const pickCount = pickup ? pickup.count : 0;
          
          document.getElementById('modalDistributionPrefContent').innerHTML = `
            <div class="d-flex justify-content-around align-items-center h-100 gap-3" style="min-height: 110px;">
              <div class="text-center p-3 rounded-4 bg-light flex-grow-1" style="border: 1px solid rgba(56,38,21,0.05);">
                <i class="bi bi-shop fs-4 text-warning"></i>
                <h5 class="fw-extrabold mt-1 mb-0">${pickCount}</h5>
                <small class="text-muted fw-bold" style="font-size:0.75rem;">Ambil Mandiri</small>
              </div>
              <div class="text-center p-3 rounded-4 bg-light flex-grow-1" style="border: 1px solid rgba(56,38,21,0.05);">
                <i class="bi bi-bicycle fs-4 text-success"></i>
                <h5 class="fw-extrabold mt-1 mb-0">${delCount}</h5>
                <small class="text-muted fw-bold" style="font-size:0.75rem;">Kirim Kurir</small>
              </div>
            </div>
          `;
          
          document.getElementById('modalHistoryHeader').innerHTML = `
            <tr>
              <th class="px-3 py-2">ID Klaim</th>
              <th class="px-3 py-2">Nama Hidangan</th>
              <th class="px-3 py-2">Jumlah</th>
              <th class="px-3 py-2">Status</th>
              <th class="px-3 py-2">Tanggal</th>
            </tr>
          `;
          
          let historyHtml = '';
          if (data.recent_claims && data.recent_claims.length > 0) {
            data.recent_claims.forEach(claim => {
              let statusBadge = '';
              if (claim.status === 'approved') {
                statusBadge = '<span class="badge bg-success-subtle text-success border px-2 py-1" style="font-size:0.75rem; border-radius:12px;">Disetujui</span>';
              } else if (claim.status === 'pending') {
                statusBadge = '<span class="badge bg-warning-subtle text-warning border px-2 py-1" style="font-size:0.75rem; border-radius:12px;">Pending</span>';
              } else {
                statusBadge = '<span class="badge bg-danger-subtle text-danger border px-2 py-1" style="font-size:0.75rem; border-radius:12px;">Ditolak</span>';
              }
              const dateStr = new Date(claim.claimed_at).toLocaleDateString('id-ID', {day: 'numeric', month: 'short'});
              historyHtml += `
                <tr>
                  <td class="px-3 py-2.5">#KL-00${claim.id}</td>
                  <td class="px-3 py-2.5"><strong>${claim.food_name}</strong></td>
                  <td class="px-3 py-2.5">${claim.claimed_quantity} ${claim.unit}</td>
                  <td class="px-3 py-2.5">${statusBadge}</td>
                  <td class="px-3 py-2.5 small text-muted">${dateStr}</td>
                </tr>
              `;
            });
          } else {
            historyHtml = '<tr><td colspan="5" class="text-center py-4 text-muted">Belum ada riwayat klaim.</td></tr>';
          }
          document.getElementById('modalHistoryBody').innerHTML = historyHtml;
        }
        
        const modal = new bootstrap.Modal(document.getElementById('adminUserStatsModal'));
        modal.show();
      })
      .catch(err => {
        showCustomToast('Gagal Memuat Laporan', err.message, 'error');
      });
    }

    // Load Lembaga Stats on detail tab
    function loadLembagaStats() {
      if (!currentUser.isLoggedIn || currentUser.role !== 'lembaga') return;
      
      fetch(`/api/users/${currentUser.id}/stats`)
      .then(res => res.json())
      .then(stats => {
        document.getElementById('lembagaStatPortions').innerText = stats.approved_portions;
        document.getElementById('lembagaStatClaims').innerText = stats.total_claims;
        document.getElementById('lembagaStatApproved').innerText = stats.approved_count;
        document.getElementById('lembagaStatDelivery').innerText = stats.delivery_count;
        
        document.getElementById('lembagaStatPickupCount').innerText = stats.pickup_count;
        document.getElementById('lembagaStatDeliveryCount').innerText = stats.delivery_count;
        
        let categoryHtml = '';
        if (stats.categories && stats.categories.length > 0) {
          stats.categories.forEach(cat => {
            const label = cat.category === 'makanan_berat' ? 'Makanan Berat' : (cat.category === 'roti' ? 'Roti & Kue' : (cat.category === 'snack' ? 'Snack' : (cat.category === 'minuman' ? 'Minuman' : cat.category.toUpperCase())));
            const percent = stats.total_portions > 0 ? Math.round((cat.total / stats.total_portions) * 100) : 0;
            categoryHtml += `
              <div class="mb-3">
                <div class="d-flex justify-content-between text-muted small mb-1 fw-bold">
                  <span>${label}</span>
                  <span>${cat.total} Porsi (${percent}%)</span>
                </div>
                <div class="progress" style="height: 8px; border-radius: 10px;">
                  <div class="progress-bar" role="progressbar" style="width: ${percent}%; background: var(--green);" aria-valuenow="${percent}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            `;
          });
        } else {
          categoryHtml = '<div class="text-muted small py-2">Belum ada makanan diselamatkan.</div>';
        }
        document.getElementById('lembagaCategoryBars').innerHTML = categoryHtml;
      })
      .catch(err => {
        console.error('Failed to load institution stats', err);
      });
    }

    // 10. Open Registration Page and Close Login Modal
    function openRegisterPageFromLogin() {
      const loginModalEl = document.getElementById('loginModal');
      const loginModal = bootstrap.Modal.getInstance(loginModalEl) || new bootstrap.Modal(loginModalEl);
      if (loginModal) loginModal.hide();
      
      showTab('register');
    }

    // Interactive role selectors for registration
    function selectRegisterRole(role) {
      document.getElementById('regInputRole').value = role;
      
      const formCard = document.getElementById('registerFormCard');
      const selectionDiv = document.getElementById('registerRoleSelection');
      const successScreen = document.getElementById('registerSuccessScreen');
      
      // Update form texts based on chosen role
      const title = document.getElementById('regFormTitle');
      const subtitle = document.getElementById('regFormSubtitle');
      const orgLabel = document.getElementById('regOrgNameLabel');
      const orgNameInput = document.getElementById('regOrgNameNew');
      const addressInput = document.getElementById('regAddressNew');
      const mapsHint = document.getElementById('regMapsHint');
      const submitBtn = document.getElementById('btnSubmitRegNew');

      if (role === 'donor') {
        title.innerHTML = '<i class="bi bi-shop text-warning me-2"></i> Pendaftaran Mitra Donor Baru';
        subtitle.innerText = 'Daftarkan bisnis kuliner Anda untuk menyalurkan surplus makanan higienis secara tertata.';
        orgLabel.innerText = 'Nama Toko / Restoran / Usaha Donor';
        orgNameInput.placeholder = 'Contoh: Restoran Minang Prima, Bakery Lezat...';
        addressInput.placeholder = 'Tulis alamat lengkap outlet, dapur, atau usaha donor Anda...';
        mapsHint.innerHTML = '*Wajib diisi dengan koordinat Google Maps untuk mempermudah relawan kurir menjemput surplus donasi.';
        submitBtn.innerHTML = 'Kirim Permohonan Mitra Donor <i class="bi bi-send-fill"></i>';
        submitBtn.className = 'btn-honey w-100 py-3 mt-2 fw-bold';
      } else {
        title.innerHTML = '<i class="bi bi-building text-success me-2"></i> Pendaftaran Lembaga Sosial Baru';
        subtitle.innerText = 'Daftarkan yayasan, panti asuhan, atau pondok pesantren penerima manfaat surplus pangan.';
        orgLabel.innerText = 'Nama Yayasan / Panti Asuhan';
        orgNameInput.placeholder = 'Contoh: Panti Asuhan Kasih Ibu, Yayasan Peduli Sesama...';
        addressInput.placeholder = 'Tulis alamat fisik panti asuhan atau kantor yayasan Anda...';
        mapsHint.innerHTML = '*Wajib diisi dengan koordinat Google Maps pin lokasi asli yayasan untuk peninjauan admin.';
        submitBtn.innerHTML = 'Kirim Permohonan Lembaga Sosial <i class="bi bi-send-fill"></i>';
        submitBtn.className = 'btn-sage w-100 py-3 mt-2 fw-bold';
        submitBtn.style.borderRadius = '30px';
      }

      selectionDiv.classList.add('d-none');
      successScreen.classList.add('d-none');
      formCard.classList.remove('d-none');

      // Scroll form card into view
      formCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    function showRegisterRoleSelection() {
      document.getElementById('registerFormCard').classList.add('d-none');
      document.getElementById('registerSuccessScreen').classList.add('d-none');
      document.getElementById('registerRoleSelection').classList.remove('d-none');
    }

    // Submit dynamic registration requests (AJAX POST)
    function submitRegistrationRequestNew(event) {
      event.preventDefault();
      
      const role = document.getElementById('regInputRole').value;
      const orgName = document.getElementById('regOrgNameNew').value.trim();
      const contact = document.getElementById('regContactNew').value.trim();
      const email = document.getElementById('regEmailNew').value.trim();
      const phone = document.getElementById('regPhoneNew').value.trim();
      const mapsLink = document.getElementById('regMapsLinkNew').value.trim();
      const address = document.getElementById('regAddressNew').value.trim();
      
      if (!mapsLink.startsWith('http://') && !mapsLink.startsWith('https://')) {
        showCustomToast('Link Maps Tidak Valid', 'Mohon sertakan protokol http:// atau https:// untuk tautan Google Maps.', 'error');
        return;
      }

      const submitBtn = document.getElementById('btnSubmitRegNew');
      const originalText = submitBtn.innerHTML;
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Mengirim data permohonan...';

      fetch('/api/register-request', {
        method: 'POST',
        headers: getHeaders(),
        body: JSON.stringify({
          organization_name: orgName,
          contact_person: contact,
          email: email,
          phone: phone,
          address: address,
          google_maps_link: mapsLink,
          role: role
        })
      })
      .then(res => {
        if (!res.ok) throw new Error('Gagal mengirimkan permohonan pendaftaran.');
        return res.json();
      })
      .then(data => {
        // Reset inputs
        document.getElementById('regOrgNameNew').value = '';
        document.getElementById('regContactNew').value = '';
        document.getElementById('regEmailNew').value = '';
        document.getElementById('regPhoneNew').value = '';
        document.getElementById('regMapsLinkNew').value = '';
        document.getElementById('regAddressNew').value = '';
        
        // Load details to success screen
        document.getElementById('successRoleLabel').innerText = role === 'donor' ? 'MITRA DONOR' : 'LEMBAGA SOSIAL';
        document.getElementById('successOrgLabel').innerText = orgName;
        document.getElementById('successEmailLabel').innerText = email;
        
        // Toggle pages
        document.getElementById('registerFormCard').classList.add('d-none');
        document.getElementById('registerSuccessScreen').classList.remove('d-none');
        
        showCustomToast('Registrasi Terkirim', 'Permohonan pendaftaran berhasil dikirim! Silakan tunggu verifikasi admin.', 'success');
      })
      .catch(err => {
        showCustomToast('Gagal Mendaftar', err.message, 'error');
      })
      .finally(() => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
      });
    }

    // 12. Fetch and render all pending registration requests (Admin)
    function loadAdminRegistrationRequests() {
      fetch('/api/admin/registration-requests')
      .then(res => res.json())
      .then(requests => {
        // Update pending count badges
        const badge = document.getElementById('adminRegRequestsBadge');
        const sidebarBadge = document.getElementById('sidebarRegRequestsBadge');
        
        if (badge) badge.innerText = `${requests.length} Menunggu Ulasan`;
        if (sidebarBadge) {
          if (requests.length > 0) {
            sidebarBadge.innerText = requests.length;
            sidebarBadge.style.display = 'inline-block';
          } else {
            sidebarBadge.style.display = 'none';
          }
        }
        
        const body = document.getElementById('adminRegRequestsBody');
        if (!body) return;
        
        let html = '';
        if (requests.length === 0) {
          body.innerHTML = `<tr><td colspan="6" class="text-center py-4 text-muted">Tidak ada permohonan pendaftaran pending saat ini.</td></tr>`;
          return;
        }
        
        requests.forEach((req, index) => {
          let roleBadge = req.role === 'donor' 
            ? `<span class="badge text-white" style="background:var(--accent2); font-size:0.72rem; border-radius:12px; padding:4px 10px;"><i class="bi bi-shop"></i> DONOR</span>`
            : `<span class="badge text-white" style="background:var(--green); font-size:0.72rem; border-radius:12px; padding:4px 10px;"><i class="bi bi-building"></i> LEMBAGA</span>`;
          
          html += `
            <tr>
              <td>${index + 1}</td>
              <td>
                <div class="d-flex gap-2 align-items-center mb-1 flex-wrap">
                  <strong>${req.organization_name}</strong>
                  ${roleBadge}
                </div>
                <span class="badge" style="background:#FFF3D6; color:#E6A817; font-size:0.7rem; border-radius:10px; padding:3px 8px;">PENDING REVIEW</span>
              </td>
              <td>${req.contact_person}</td>
              <td>
                <p class="m-0 text-muted" style="font-size:0.85rem; max-width:250px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">${req.address}</p>
                <a href="${req.google_maps_link}" target="_blank" class="btn btn-sm btn-outline-success py-1.5 px-3 mt-2 fw-semibold" style="font-size: 0.78rem; border-radius: 20px;">
                  <i class="bi bi-geo-alt-fill"></i> Buka Google Maps Pin &rarr;
                </a>
              </td>
              <td>
                <strong>Email Kontak:</strong> ${req.email}<br>
                <strong>Telepon:</strong> ${req.phone}
              </td>
              <td class="text-center">
                <div class="d-flex gap-2 justify-content-center">
                  <button class="btn btn-sm btn-sage py-2 px-3 fw-bold shadow-sm" onclick="processApproveRegistration(${req.id})"><i class="bi bi-patch-check-fill"></i> Setujui &amp; Buat Akun</button>
                  <button class="btn btn-sm btn-danger-custom py-2 px-3 fw-bold shadow-sm" onclick="processRejectRegistration(${req.id})"><i class="bi bi-x-circle"></i> Tolak</button>
                </div>
              </td>
            </tr>
          `;
        });
        body.innerHTML = html;
      })
      .catch(err => {
        showCustomToast('Gagal Memuat Registrasi', 'Terjadi kesalahan saat mengambil permohonan pending.', 'error');
      });
    }

    // 13. Load system debugging logs from API
    function loadSystemLogs() {
      const container = document.getElementById('systemLogsContent');
      if (!container) return;
      
      container.innerHTML = `<span class="text-warning"><i class="bi bi-arrow-repeat spin"></i> Menghubungi server, membaca berkas laravel.log...</span>`;
      
      fetch('/api/admin/logs')
      .then(res => res.json())
      .then(data => {
        if (data.logs) {
          // Highlight timestamps, ERROR, WARNING, and INFO
          let formattedLogs = data.logs
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\]/g, '<span class="text-info">$&</span>')
            .replace(/local\.ERROR/g, '<span class="text-danger fw-bold">$&</span>')
            .replace(/local\.WARNING/g, '<span class="text-warning fw-bold">$&</span>')
            .replace(/local\.INFO/g, '<span class="text-success fw-bold">$&</span>')
            .replace(/Stack trace:/g, '<span class="text-secondary">$&</span>');
            
          container.innerHTML = formattedLogs;
        } else {
          container.innerHTML = '<span class="text-muted">Tidak ada catatan log saat ini.</span>';
        }
      })
      .catch(err => {
        container.innerHTML = '<span class="text-danger">Gagal mengambil catatan log dari server. Pastikan koneksi server menyala.</span>';
        showCustomToast('Gagal Memuat Log', 'Gagal memuat log sistem dari API.', 'error');
      });
    }

    // 14. Clear system logs
    async function clearLaravelLog() {
      const confirmed = await showCustomConfirm(
        'Bersihkan Log Sistem',
        'Apakah Anda yakin ingin menghapus seluruh isi file laravel.log? Tindakan ini tidak dapat dibatalkan.',
        'bi-trash3-fill',
        '#e74c3c'
      );
      
      if (!confirmed) return;
      
      fetch('/api/admin/logs/clear', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'Content-Type': 'application/json'
        }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          showCustomToast('Log Dibersihkan', 'Isi berkas log laravel.log telah sukses dikosongkan.', 'success');
          loadSystemLogs();
        } else {
          showCustomToast('Gagal Membersihkan Log', 'Respon server tidak valid.', 'error');
        }
      })
      .catch(err => {
        showCustomToast('Gagal Membersihkan Log', 'Koneksi ke server terputus.', 'error');
      });
    }

    // 15. Approve registration: generate credentials and open simulated email modal
    async function processApproveRegistration(id) {
      const confirmed = await showCustomConfirm(
        'Setujui Pendaftaran',
        'Apakah Anda yakin ingin menyetujui pendaftaran ini dan men-generate kredensial email resmi @foodshare.id?',
        'bi-patch-check-fill',
        'var(--green)'
      );
      
      if (!confirmed) return;
      
      fetch(`/api/admin/registration-requests/${id}/approve`, {
        method: 'POST',
        headers: getHeaders()
      })
      .then(res => {
        if (!res.ok) throw new Error('Gagal menyetujui pendaftaran.');
        return res.json();
      })
      .then(res => {
        // Display credentials in credentials modal
        document.getElementById('credentialsOrgName').innerText = res.organization_name;
        document.getElementById('credentialsEmail').value = res.generated_email;
        document.getElementById('credentialsPassword').value = res.generated_password;
        document.getElementById('credentialsContactEmail').innerText = res.contact_email;
        
        // Setup role-specific texts in the modal
        const isDonor = res.role === 'donor';
        const titleEl = document.getElementById('approveRegTitle');
        const descEl = document.getElementById('credentialsDesc');
        const simDescEl = document.getElementById('simulatedEmailDesc');
        const simSubjectEl = document.getElementById('simulatedEmailSubject');
        const simBodyP1 = document.getElementById('simulatedEmailBodyP1');
        const simBodyP2 = document.getElementById('simulatedEmailBodyP2');
        
        if (isDonor) {
          titleEl.innerHTML = '<i class="bi bi-patch-check-fill"></i> Pendaftaran Mitra Donor Disetujui!';
          descEl.innerHTML = `Akun resmi mitra donor untuk <strong>${res.organization_name}</strong> berhasil dibuat dan didaftarkan ke sistem FoodShare. Berikut kredensial login resminya:`;
          simDescEl.innerHTML = `Kirim email pemberitahuan resmi yang berisi detail akun dan instruksi login di atas ke email kontak pengurus mitra donor: <strong><span id="credentialsContactEmail" class="text-dark">${res.contact_email}</span></strong>.`;
          simSubjectEl.innerText = 'Subjek: 🎁 Selamat! Akun Mitra Donor FoodShare Anda Telah Aktif';
          simBodyP1.innerHTML = `Kami memiliki kabar baik! Tim verifikasi FoodShare telah meninjau alamat fisik dan lokasi Google Maps usaha kuliner Anda. Lokasi outlet/usaha Anda telah dinyatakan <strong>100% valid dan terdaftar secara resmi</strong>.`;
          simBodyP2.innerHTML = `Untuk mulai berpartisipasi menyalurkan surplus makanan berkualitas tinggi ke panti asuhan, lembaga sosial, dan komunitas yang membutuhkan di Balikpapan, silakan gunakan kredensial masuk berikut ini:`;
        } else {
          titleEl.innerHTML = '<i class="bi bi-patch-check-fill"></i> Pendaftaran Lembaga Sosial Disetujui!';
          descEl.innerHTML = `Akun resmi lembaga sosial untuk <strong>${res.organization_name}</strong> berhasil dibuat dan didaftarkan ke sistem FoodShare. Berikut kredensial login resminya:`;
          simDescEl.innerHTML = `Kirim email pemberitahuan resmi yang berisi detail akun dan instruksi login di atas ke email kontak pengurus lembaga: <strong><span id="credentialsContactEmail" class="text-dark">${res.contact_email}</span></strong>.`;
          simSubjectEl.innerText = 'Subjek: 🎁 Selamat! Akun Lembaga FoodShare Anda Telah Aktif';
          simBodyP1.innerHTML = `Kami memiliki kabar baik! Tim verifikasi FoodShare telah meninjau alamat fisik dan lokasi Google Maps lembaga Anda. Lokasi panti asuhan/yayasan Anda telah dinyatakan <strong>100% valid dan terdaftar secara resmi</strong>.`;
          simBodyP2.innerHTML = `Untuk mulai berpartisipasi mengklaim makanan surplus berkualitas tinggi dari donatur restoran premium di Balikpapan, silakan gunakan kredensial masuk berikut ini:`;
        }
        
        // Setup simulated Gmail values
        document.getElementById('simulatedEmailTo').innerText = `${res.contact_person} <${res.contact_email}>`;
        document.getElementById('simulatedEmailOrg').innerText = res.organization_name;
        document.getElementById('simulatedEmailUser').innerText = res.generated_email;
        document.getElementById('simulatedEmailPass').innerText = res.generated_password;
        
        // Reset simulated email state
        document.getElementById('simulatedEmailBox').classList.add('d-none');
        const sendBtn = document.getElementById('btnSendGmailSimulation');
        sendBtn.disabled = false;
        sendBtn.innerHTML = '<i class="bi bi-google"></i> Hubungkan ke Gmail &amp; Kirim Kredensial';
        sendBtn.style.background = '#dc3545';
        
        // Open credentials modal
        const modal = new bootstrap.Modal(document.getElementById('modalApproveRegistration'));
        modal.show();
        
        showCustomToast('Persetujuan Sukses', 'Permohonan disetujui! Kredensial akun resmi berhasil dibuat.', 'success');
      })
      .catch(err => {
        showCustomToast('Gagal Memproses', err.message, 'error');
      });
    }

    // 14. Reject registration permohonan
    async function processRejectRegistration(id) {
      const confirmed = await showCustomConfirm(
        'Tolak Pendaftaran',
        'Apakah Anda yakin ingin menolak permohonan pendaftaran ini?',
        'bi-x-circle-fill',
        '#E74C3C'
      );
      
      if (!confirmed) return;
      
      fetch(`/api/admin/registration-requests/${id}/reject`, {
        method: 'POST',
        headers: getHeaders()
      })
      .then(res => {
        if (!res.ok) throw new Error('Gagal menolak pendaftaran.');
        return res.json();
      })
      .then(res => {
        showCustomToast('Pendaftaran Ditolak', 'Permohonan pendaftaran berhasil ditolak.', 'info');
        loadAdminPanel();
      })
      .catch(err => {
        showCustomToast('Gagal Menolak', err.message, 'error');
      });
    }

    // Helper: Copy string to clipboard
    function copyToClipboard(inputId) {
      const copyText = document.getElementById(inputId);
      copyText.select();
      copyText.setSelectionRange(0, 99999);
      navigator.clipboard.writeText(copyText.value);
      
      showCustomToast('Salin Sukses', 'Kredensial berhasil disalin ke clipboard Anda.', 'success');
    }

    // Helper: Trigger simulated Gmail loading screen and message
    function triggerGmailSimulation() {
      const sendBtn = document.getElementById('btnSendGmailSimulation');
      sendBtn.disabled = true;
      sendBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menghubungkan ke SMTP Google Mail...';
      
      setTimeout(() => {
        sendBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Mengirim Email Kredensial Resmi via secure TLS...';
        
        setTimeout(() => {
          sendBtn.innerHTML = '<i class="bi bi-check-all"></i> Email Berhasil Terkirim via secure SMTP!';
          sendBtn.style.background = 'var(--green)';
          
          document.getElementById('simulatedEmailBox').classList.remove('d-none');
          showCustomToast('Notifikasi Gmail', 'Email berisi kredensial login resmi telah terkirim via Google SMTP!', 'success');
        }, 1200);
      }, 1000);
    }

  </script>
  <!-- INPUT DONASI MODAL (Mitra Donor CRUD Create) -->
  <div class="modal fade" id="inputDonasiModal" tabindex="-1" aria-labelledby="inputDonasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content custom-modal-content" style="border-radius: var(--radius); border: none;">
        <div class="modal-header border-0 p-4 pb-0 justify-content-between">
          <h4 class="modal-title fw-bold" id="inputDonasiModalLabel"><i class="bi bi-plus-circle-fill" style="color:var(--accent2)"></i> Bagikan Makanan Surplus</h4>
          <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body p-4 pt-3">
          <form id="inputDonasiForm" onsubmit="submitDonorFood(event)">
            <div class="mb-3">
              <label class="form-label fw-bold text-dark" style="font-size:0.88rem">Nama Hidangan Surplus</label>
              <input type="text" class="form-control rounded-pill px-3 py-2" id="donorFoodNameInput" placeholder="Contoh: Roti Tawar Gandum, Nasi Kotak..." required style="border: 2px solid rgba(56,38,21,0.08);">
            </div>
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-dark" style="font-size:0.88rem">Jumlah Kuantitas</label>
                <input type="number" class="form-control rounded-pill px-3 py-2" id="donorFoodQtyInput" min="1" placeholder="25" required style="border: 2px solid rgba(56,38,21,0.08);">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-dark" style="font-size:0.88rem">Satuan Porsi</label>
                <select class="form-select rounded-pill px-3 py-2" id="donorFoodUnitInput" style="border: 2px solid rgba(56,38,21,0.08);">
                  <option value="porsi" selected>porsi</option>
                  <option value="pcs">pcs</option>
                  <option value="kotak">kotak</option>
                  <option value="bungkus">bungkus</option>
                  <option value="buah">buah</option>
                </select>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-dark" style="font-size:0.88rem">Kategori Hidangan</label>
                <select class="form-select rounded-pill px-3 py-2" id="donorFoodCategorySelect" style="border: 2px solid rgba(56,38,21,0.08);">
                  <option value="makanan_berat" selected>Makanan Berat</option>
                  <option value="roti">Roti &amp; Kue</option>
                  <option value="snack">Snack</option>
                  <option value="minuman">Minuman</option>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-dark" style="font-size:0.88rem">Kedaluwarsa (Jam)</label>
                <input type="number" class="form-control rounded-pill px-3 py-2" id="donorFoodExpInput" value="4" min="1" required style="border: 2px solid rgba(56,38,21,0.08);">
              </div>
            </div>
            
            <div class="mb-3">
              <label class="form-label fw-bold text-dark" style="font-size:0.88rem">Catatan / Deskripsi Tambahan</label>
              <textarea class="form-control px-3 py-2" id="donorFoodDescriptionInput" rows="2" placeholder="Contoh: Sangat baik dikonsumsi langsung, disimpan dalam wadah higienis." style="border: 2px solid rgba(56,38,21,0.08); border-radius: 12px;"></textarea>
            </div>
            
            <div class="text-end mt-4">
              <button type="button" class="btn-honey-outline px-4 py-2 me-2 rounded-pill" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn-honey px-5 py-2 rounded-pill">Bagikan Makanan <i class="bi bi-send-fill"></i></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- ADMIN DETIL PORSI MODAL -->
  <div class="modal fade" id="detailPorsiModal" tabindex="-1" aria-labelledby="detailPorsiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content custom-modal-content" style="border-radius: var(--radius); border: none;">
        <div class="modal-header border-0 p-4 pb-0 justify-content-between">
          <h4 class="modal-title fw-bold" id="detailPorsiModalLabel"><i class="bi bi-heart-pulse-fill" style="color:var(--accent2)"></i> Rincian Porsi Diselamatkan</h4>
          <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4 pt-3">
          <div class="table-responsive">
            <table class="table donations-table">
              <thead>
                <tr>
                  <th>ID Klaim</th>
                  <th>Nama Hidangan</th>
                  <th>Kuantitas</th>
                  <th>Mitra Donor</th>
                  <th>Lembaga Penerima</th>
                  <th>Tanggal</th>
                </tr>
              </thead>
              <tbody id="detailPorsiTableBody">
                <!-- Loaded Dynamically via AJAX -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ADMIN DETIL DONOR MODAL -->
  <div class="modal fade" id="detailDonorModal" tabindex="-1" aria-labelledby="detailDonorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content custom-modal-content" style="border-radius: var(--radius); border: none;">
        <div class="modal-header border-0 p-4 pb-0 justify-content-between">
          <h4 class="modal-title fw-bold" id="detailDonorModalLabel"><i class="bi bi-shop" style="color:var(--green)"></i> Daftar Mitra Donor Terdaftar</h4>
          <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4 pt-3">
          <div class="table-responsive">
            <table class="table donations-table">
              <thead>
                <tr>
                  <th>ID Donor</th>
                  <th>Nama Organisasi / Toko</th>
                  <th>Email</th>
                  <th>Telepon</th>
                  <th>Alamat Toko</th>
                </tr>
              </thead>
              <tbody id="detailDonorTableBody">
                <!-- Loaded Dynamically via AJAX -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ADMIN DETIL LEMBAGA MODAL -->
  <div class="modal fade" id="detailLembagaModal" tabindex="-1" aria-labelledby="detailLembagaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content custom-modal-content" style="border-radius: var(--radius); border: none;">
        <div class="modal-header border-0 p-4 pb-0 justify-content-between">
          <h4 class="modal-title fw-bold" id="detailLembagaModalLabel"><i class="bi bi-building" style="color:#1967D2"></i> Daftar Lembaga Terdaftar</h4>
          <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4 pt-3">
          <div class="table-responsive">
            <table class="table donations-table">
              <thead>
                <tr>
                  <th>ID Lembaga</th>
                  <th>Nama Lembaga Sosial</th>
                  <th>Email</th>
                  <th>Telepon</th>
                  <th>Alamat Kantor</th>
                </tr>
              </thead>
              <tbody id="detailLembagaTableBody">
                <!-- Loaded Dynamically via AJAX -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- CUSTOM CONFIRM MODAL -->
  <div class="modal fade" id="customConfirmModal" tabindex="-1" aria-hidden="true" style="z-index: 1060;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
      <div class="modal-content custom-modal-content text-center py-4 px-3">
        <div class="modal-body p-0">
          <div class="mb-3" style="font-size: 3.2rem; color: var(--accent2);" id="confirmIcon">
            <i class="bi bi-question-circle-fill"></i>
          </div>
          <h5 class="fw-bold mb-2 text-dark" id="confirmTitle">Konfirmasi</h5>
          <p class="text-muted px-2" style="font-size: 0.9rem;" id="confirmMessage">Apakah Anda yakin ingin melanjutkan tindakan ini?</p>
          <div class="d-flex gap-3 justify-content-center mt-4">
            <button type="button" class="btn-honey-outline px-4" id="confirmCancelBtn" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn-honey px-4" id="confirmOkBtn">Ya, Lanjutkan</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ADMIN USER DETIL STATS & REPORT MODAL -->
  <div class="modal fade" id="adminUserStatsModal" tabindex="-1" aria-labelledby="adminUserStatsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content custom-modal-content" style="border-radius: var(--radius-md); border: none;">
        <div class="modal-header border-0 p-4 pb-0 justify-content-between">
          <h4 class="modal-title fw-bold text-dark" id="adminUserStatsModalLabel"><i class="bi bi-bar-chart-line-fill text-warning"></i> Laporan Aktivitas &amp; Statistik Akun</h4>
          <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4 pt-3 text-start">
          <!-- User Profile Brief -->
          <div class="d-flex align-items-center gap-3 p-3 rounded-4 mb-4" style="background: rgba(56, 38, 21, 0.04); border: 1px solid rgba(56, 38, 21, 0.05);">
            <div id="modalUserRoleIcon" class="rounded-circle d-flex align-items-center justify-content-center text-white" style="width: 55px; height: 55px; font-size: 1.8rem; background: var(--accent-grad);">
              <i class="bi bi-shop"></i>
            </div>
            <div>
              <h5 class="fw-extrabold m-0 text-dark" id="modalUserOrgName">Nama Organisasi</h5>
              <span class="badge mt-1" id="modalUserRoleBadge" style="background: var(--accent2); font-size: 0.72rem;">DONOR</span>
              <small class="text-muted ms-2" id="modalUserEmail">email@organisasi.id</small>
            </div>
          </div>
          
          <!-- Key Metrics Grid -->
          <div class="row g-3 mb-4" id="modalStatsGrid">
            <!-- Filled dynamically based on role -->
          </div>
          
          <!-- Breakdown Section -->
          <div class="row g-3 mb-4">
            <div class="col-md-6 border-end" id="modalCategoryBreakdownCol">
              <h6 class="fw-bold mb-3"><i class="bi bi-pie-chart-fill text-success"></i> Rincian Kategori Makanan</h6>
              <div id="modalCategoryList">
                <!-- Filled dynamically -->
              </div>
            </div>
            <div class="col-md-6 ps-md-4" id="modalDistributionPrefCol">
              <h6 class="fw-bold mb-3"><i class="bi bi-truck text-warning"></i> Preferensi Penyaluran</h6>
              <div id="modalDistributionPrefContent" class="h-100">
                <!-- Filled dynamically -->
              </div>
            </div>
          </div>
          
          <!-- Recent History Table -->
          <div>
            <h6 class="fw-bold mb-3"><i class="bi bi-clock-history text-primary"></i> Riwayat Transaksi Terakhir (5 Data)</h6>
            <div class="table-responsive border rounded-3 overflow-hidden bg-light">
              <table class="donations-table m-0" style="width: 100%;">
                <thead id="modalHistoryHeader">
                  <!-- Filled dynamically -->
                </thead>
                <tbody id="modalHistoryBody">
                  <!-- Filled dynamically -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer border-0 p-4 pt-0">
          <button type="button" class="btn-honey px-5 py-2.5 rounded-pill shadow-sm" data-bs-dismiss="modal">Tutup Laporan</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
