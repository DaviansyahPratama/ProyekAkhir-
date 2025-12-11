<style>
  /* Ensure header doesn't overlap content */
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
    height: 74px;
  }
  
  @media (min-width: 1024px) {
    .pc-header {
      left: 264px;
    }
  }
  
  .pc-container {
    position: relative;
    top: 74px;
    min-height: calc(100vh - 74px);
    margin-top: 0 !important;
  }
  
  @media (min-width: 1024px) {
    .pc-container {
      margin-left: 264px;
    }
  }
  
  @media (max-width: 1023px) {
    .pc-container {
      margin-left: 0;
    }
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

