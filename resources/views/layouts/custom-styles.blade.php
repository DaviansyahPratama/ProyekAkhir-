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
    padding-top: 1.25rem;
    padding-left: 2.5rem;
    padding-right: 2.5rem;
  }

  @media (max-width: 639px) {
    .pc-content {
      padding: 15px;
    }
  }
</style>

