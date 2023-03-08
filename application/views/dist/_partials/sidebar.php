<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="#">i-RS</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="#">rsud</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Transaction</li>
      <!-- <li class="<?php echo $this->uri->segment(1) == 'Dashboard' ? 'active' : ''; ?>">
        <a href="<?= site_url('Dashboard') ?>" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
      </li> -->

      <li class="<?php echo $this->uri->segment(1) == 'Poli' ? 'active' : ''; ?>">
        <a href="<?= site_url('Poli') ?>" class="nav-link"><i class="fas fa-fire"></i><span>Poli</span></a>
      </li>
      <li class="<?php echo $this->uri->segment(1) == 'Artikel' ? 'active' : ''; ?>">
        <a href="<?= site_url('Artikel') ?>" class="nav-link"><i class="fas fa-sitemap"></i><span>Artikel</span></a>
      </li>
      <li class="<?php echo $this->uri->segment(1) == 'Kategori' ? 'active' : ''; ?>">
        <a href="<?= site_url('Kategori') ?>" class="nav-link"><i class="fas fa-sitemap"></i><span>Kategori</span></a>
      </li>

      <!-- Admin Only -->
      <?php if ($this->fungsi->user_login()->level == 1) { ?>
        <li class="menu-header">Setting</li>
        <li class="dropdown <?php echo $this->uri->segment(1) == 'User' || $this->uri->segment(2) == 'index_0' ? 'active' : ''; ?>">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>User</span></a>
          <ul class="dropdown-menu">
            <li class="<?php echo $this->uri->segment(1) == 'User' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>User">User Data</a></li>
          </ul>
        </li>
      <?php } ?>
    </ul>

    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
      <a href="<?= site_url('Auth/logout') ?>" class="btn btn-primary btn-lg btn-block btn-icon-split">
        <i class="fas fa-rocket"></i> Logout
      </a>
    </div>
  </aside>
</div>