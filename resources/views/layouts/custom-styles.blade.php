<style>
  /* Layout helpers to keep header/sidebar aligned, including collapse */
  :root {
    --sidebar-width: 264px;
    --header-height: 74px;
  }

  body {
    overflow-x: hidden;
    padding-top: 0 !important;
  }

  .pc-header {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1025;
    height: var(--header-height);
    transition: left 0.2s ease;
  }

  @media (min-width: 1024px) {
    .pc-header {
      left: var(--sidebar-width);
    }
  }

  .pc-container {
    position: relative;
    top: var(--header-height);
    min-height: calc(100vh - var(--header-height));
    margin-top: 0 !important;
    transition: margin-left 0.2s ease;
  }

  @media (min-width: 1024px) {
    .pc-container {
      margin-left: var(--sidebar-width);
    }
  }

  @media (max-width: 1023px) {
    .pc-container {
      margin-left: 0;
    }
  }

  /* When sidebar is collapsed/hidden (class applied on .pc-sidebar) */
  .pc-sidebar.pc-sidebar-hide ~ .pc-header,
  .pc-sidebar.pc-sidebar-hide ~ .pc-container,
  .pc-sidebar.pc-sidebar-collapse ~ .pc-header,
  .pc-sidebar.pc-sidebar-collapse ~ .pc-container,
  .pc-sidebar.mob-sidebar-active ~ .pc-header,
  .pc-sidebar.mob-sidebar-active ~ .pc-container {
    left: 0;
    margin-left: 0;
  }

  .pc-content {
    padding-top: 1.5rem;
    padding-left: 2.25rem;
    padding-right: 2.25rem;
  }

  @media (max-width: 639px) {
    .pc-content {
      padding: 1.25rem;
    }
  }

  /* ---------------------------------------------
   * Sidebar (Admin & Staff) - hover/active, spacing
   * --------------------------------------------- */
  .pc-sidebar .navbar-content {
    padding-top: 0.5rem;
    padding-bottom: 1rem;
  }

  .pc-sidebar .m-header {
    border-bottom: 1px solid rgba(148, 163, 184, 0.2);
  }

  .pc-sidebar .pc-navbar {
    gap: 0.125rem;
  }

  .pc-sidebar .pc-item.pc-caption label {
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: #9ca3af;
    padding: 0.75rem 1.25rem 0.25rem;
  }

  .pc-sidebar .pc-link {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.55rem 1.35rem;
    border-radius: 999px;
    margin: 0 0.75rem 0.25rem;
    font-size: 0.9rem;
    color: #e5e7eb;
    transition: background-color 0.18s ease, color 0.18s ease, box-shadow 0.18s ease,
      transform 0.18s ease;
  }

  .pc-sidebar .pc-link .pc-micon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 1.9rem;
    height: 1.9rem;
    border-radius: 999px;
    background: rgba(15, 23, 42, 0.35);
  }

  .pc-sidebar .pc-link .pc-micon i,
  .pc-sidebar .pc-link .pc-micon svg {
    width: 1.1rem;
    height: 1.1rem;
  }

  .pc-sidebar .pc-item.active > .pc-link,
  .pc-sidebar .pc-link.pc-trigger {
    background: linear-gradient(
      135deg,
      rgba(119, 77, 211, 0.18),
      rgba(119, 77, 211, 0.32)
    );
    color: #ffffff;
    box-shadow: 0 10px 18px rgba(15, 23, 42, 0.35);
    transform: translateY(-1px);
  }

  .pc-sidebar .pc-link:hover {
    background: rgba(148, 163, 184, 0.2);
    color: #ffffff;
  }

  .pc-sidebar .pc-link:active {
    transform: translateY(0);
    box-shadow: none;
  }

  /* ---------------------------------------------
   * Card & dashboard spacing
   * --------------------------------------------- */
  .card {
    border-radius: 1rem;
    border: 1px solid rgba(148, 163, 184, 0.18);
    box-shadow:
      0 14px 28px rgba(15, 23, 42, 0.08),
      0 10px 10px rgba(15, 23, 42, 0.04);
  }

  .card-header {
    padding: 0.9rem 1.25rem;
  }

  .card-body {
    padding: 1.1rem 1.25rem 1.25rem;
  }

  .pc-container .grid {
    row-gap: 1.35rem;
  }

  /* Statistic cards */
  .card-stat {
    background: radial-gradient(circle at top left, rgba(119, 77, 211, 0.12), transparent);
  }

  .card-stat h3 {
    font-weight: 500;
    letter-spacing: 0.02em;
  }

  /* ---------------------------------------------
   * Tables (Admin monitoring / list)
   * --------------------------------------------- */
  .table {
    border-collapse: separate;
    border-spacing: 0 0.35rem;
  }

  .table > :not(caption) > * > * {
    border-bottom-width: 0;
    box-shadow: none;
  }

  .table thead tr {
    background: rgba(15, 23, 42, 0.02);
  }

  .table thead th {
    border-bottom: 1px solid rgba(148, 163, 184, 0.35);
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: #6b7280;
    font-weight: 600;
  }

  .table tbody tr {
    background-color: #ffffff;
    box-shadow: 0 10px 18px rgba(15, 23, 42, 0.03);
    transition: transform 0.18s ease, box-shadow 0.18s ease, background-color 0.18s ease;
  }

  .table tbody tr:hover {
    background-color: rgba(249, 250, 251, 0.9);
    transform: translateY(-1px);
    box-shadow: 0 14px 24px rgba(15, 23, 42, 0.06);
  }

  .table tbody td {
    vertical-align: middle;
    border-top: none;
    padding-top: 0.75rem;
    padding-bottom: 0.75rem;
  }

  /* Pagination wrapper */
  .pc-content .pagination {
    gap: 0.25rem;
  }

  .pc-content .pagination .page-link {
    border-radius: 999px !important;
    border: 1px solid rgba(148, 163, 184, 0.4);
    padding: 0.35rem 0.8rem;
    font-size: 0.85rem;
  }

  .pc-content .pagination .page-item.active .page-link {
    background: linear-gradient(
      135deg,
      rgba(119, 77, 211, 0.95),
      rgba(119, 77, 211, 0.8)
    );
    border-color: transparent;
    color: #ffffff;
    box-shadow: 0 10px 18px rgba(119, 77, 211, 0.35);
  }

  /* ---------------------------------------------
   * Progress bars & badges (status/progress)
   * --------------------------------------------- */
  .progress {
    background-color: rgba(148, 163, 184, 0.25);
    border-radius: 999px;
    overflow: hidden;
  }

  .progress-bar {
    border-radius: 999px;
  }

  .badge {
    border-radius: 999px;
    padding: 0.25rem 0.6rem;
    font-weight: 500;
    font-size: 0.75rem;
  }

  /* ---------------------------------------------
   * Buttons (consistent across roles)
   * --------------------------------------------- */
  .btn {
    border-radius: 999px;
    font-size: 0.9rem;
    padding: 0.4rem 0.9rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.25rem;
  }

  .btn-primary,
  .btn-outline-primary:hover {
    box-shadow: 0 10px 18px rgba(119, 77, 211, 0.35);
  }

  .btn-outline-primary {
    border-width: 1px;
  }

  .btn-lg,
  .btn-group-lg > .btn {
    padding: 0.65rem 1.4rem;
    font-size: 0.95rem;
  }

  /* Upload / primary actions emphasis (Staff) */
  .btn-upload-strong {
    padding-inline: 1.35rem;
    padding-block: 0.55rem;
    font-weight: 600;
  }

  /* ---------------------------------------------
   * Empty state & loading state
   * --------------------------------------------- */
  .empty-state {
    padding: 2.25rem 1.75rem;
    border-radius: 1rem;
    border: 1px dashed rgba(148, 163, 184, 0.5);
    background: rgba(248, 250, 252, 0.9);
    text-align: center;
  }

  .empty-state-icon {
    width: 2.75rem;
    height: 2.75rem;
    border-radius: 999px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 0.75rem;
    background: linear-gradient(
      135deg,
      rgba(119, 77, 211, 0.12),
      rgba(119, 77, 211, 0.25)
    );
    color: #4f46e5;
  }

  .empty-state-title {
    font-weight: 600;
    margin-bottom: 0.25rem;
    color: #1e293b;
  }

  .empty-state-text {
    font-size: 0.9rem;
    color: #6b7280;
  }

  .skeleton {
    position: relative;
    overflow: hidden;
    background-color: rgba(148, 163, 184, 0.3);
    border-radius: 0.75rem;
  }

  .skeleton::after {
    content: "";
    position: absolute;
    inset: 0;
    transform: translateX(-100%);
    background: linear-gradient(
      90deg,
      transparent,
      rgba(255, 255, 255, 0.55),
      transparent
    );
    animation: skeleton-loading 1.2s ease-in-out infinite;
  }

  @keyframes skeleton-loading {
    100% {
      transform: translateX(100%);
    }
  }

  /* ---------------------------------------------
   * Alerts & notifications
   * --------------------------------------------- */
  .alert {
    border-radius: 0.9rem;
    padding-block: 0.7rem;
    padding-inline: 0.9rem 0.75rem;
    border-width: 1px;
  }

  .alert-success {
    border-color: rgba(34, 197, 94, 0.2);
    background: rgba(22, 163, 74, 0.06);
  }

  .alert-info {
    border-color: rgba(59, 130, 246, 0.2);
    background: rgba(59, 130, 246, 0.06);
  }

  .alert-warning {
    border-color: rgba(234, 179, 8, 0.2);
    background: rgba(234, 179, 8, 0.06);
  }

  .alert-danger {
    border-color: rgba(239, 68, 68, 0.2);
    background: rgba(239, 68, 68, 0.06);
  }
</style>

