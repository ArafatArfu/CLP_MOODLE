<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <button class="sidebar-close" id="sidebarClose" aria-label="Close sidebar">
        <i class="fas fa-times"></i>
    </button>
    
    <?php $current = basename($_SERVER['PHP_SELF']); ?>
    
    <div class="sidebar-header">
        <a href="<?php echo CLP_ADMIN_URL; ?>/dashboard.php" class="sidebar-brand">
            <img src="/theme/clp/assets/images/logo/clp-logo-2022-4.png" alt="CLP Logo" class="sidebar-logo">
            <span class="sidebar-title">CLP Admin</span>
        </a>
    </div>
    
    <div class="sidebar-body">
        <nav class="sidebar-nav">
            <ul class="nav-list">
                <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">
                    <a href="<?php echo CLP_ADMIN_URL; ?>/dashboard.php" class="nav-link">
                        <i class="fas fa-th-large"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
            </ul>
        </nav>
        
        <div class="sidebar-section">About Us</div>
        
        <nav class="sidebar-nav">
            <ul class="nav-list">
            <li class="nav-item has-dropdown <?php 
                echo in_array($current, ['history.php', 'impact.php', 'mission.php', 'partners.php', 'team.php', 'faq.php', 'mission_sections.php', 'mission_bullets.php', 'impact_sections.php', 'impact_bullets.php', 'presentations.php', 'page_settings.php']) ? 'active' : ''; 
            ?>">
                    <a href="javascript:void(0)" class="nav-link dropdown-toggle">
                        <i class="fas fa-info-circle"></i>
                        <span>Content</span>
                        <i class="fas fa-chevron-down dropdown-arrow"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="<?php echo $current == 'history.php' ? 'active' : ''; ?>">
                            <a href="<?php echo CLP_ADMIN_URL; ?>/history.php" class="dropdown-link">
                                <i class="fas fa-history"></i> History
                            </a>
                        </li>
                        <li class="has-dropdown <?php echo in_array($current, ['mission.php', 'mission_sections.php', 'mission_bullets.php']) ? 'active' : ''; ?>">
                            <a href="javascript:void(0)" class="dropdown-toggle submenu-toggle">
                                <span><i class="fas fa-bullseye"></i> Mission</span>
                                <i class="fas fa-chevron-down dropdown-arrow"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="<?php echo $current == 'mission.php' ? 'active' : ''; ?>">
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/mission.php" class="dropdown-link">All Sections</a>
                                </li>
                                <li class="<?php echo $current == 'mission_sections.php' ? 'active' : ''; ?>">
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/mission_sections.php" class="dropdown-link">Manage Sections</a>
                                </li>
                                <li class="<?php echo $current == 'mission_bullets.php' ? 'active' : ''; ?>">
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/mission_bullets.php" class="dropdown-link">What We Do Bullets</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-dropdown <?php echo in_array($current, ['impact.php', 'impact_sections.php', 'impact_bullets.php']) ? 'active' : ''; ?>">
                            <a href="javascript:void(0)" class="dropdown-toggle submenu-toggle">
                                <span><i class="fas fa-chart-line"></i> Impact</span>
                                <i class="fas fa-chevron-down dropdown-arrow"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="<?php echo $current == 'impact.php' ? 'active' : ''; ?>">
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/impact.php" class="dropdown-link">All Sections</a>
                                </li>
                                <li class="<?php echo $current == 'impact_sections.php' ? 'active' : ''; ?>">
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/impact_sections.php" class="dropdown-link">Manage Sections</a>
                                </li>
                                <li class="<?php echo $current == 'impact_bullets.php' ? 'active' : ''; ?>">
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/impact_bullets.php" class="dropdown-link">Growth Bullets</a>
                                </li>
                            </ul>
                        </li>
                        <li class="<?php echo $current == 'partners.php' ? 'active' : ''; ?>">
                            <a href="<?php echo CLP_ADMIN_URL; ?>/partners.php" class="dropdown-link">
                                <i class="fas fa-handshake"></i> Partners
                            </a>
                        </li>
                        <li class="<?php echo $current == 'team.php' ? 'active' : ''; ?>">
                            <a href="<?php echo CLP_ADMIN_URL; ?>/team.php" class="dropdown-link">
                                <i class="fas fa-users"></i> Team Members
                            </a>
                        </li>
                        <li class="<?php echo $current == 'faq.php' ? 'active' : ''; ?>">
                            <a href="<?php echo CLP_ADMIN_URL; ?>/faq.php" class="dropdown-link">
                                <i class="fas fa-question-circle"></i> FAQ
                            </a>
                        </li>
                        <li class="<?php echo in_array($current, ['news_coverage.php', 'news_coverage_form.php', 'news_coverage_video_form.php']) ? 'active' : ''; ?>">
                            <a href="<?php echo CLP_ADMIN_URL; ?>/news_coverage.php" class="dropdown-link">
                                <i class="fas fa-newspaper"></i> News Coverage
                            </a>
                        </li>
                        <li class="<?php echo in_array($current, ['blog.php', 'blog_form.php']) ? 'active' : ''; ?>">
                            <a href="<?php echo CLP_ADMIN_URL; ?>/blog.php" class="dropdown-link">
                                <i class="fas fa-newspaper"></i> Blog Posts
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        
        <div class="sidebar-section">Our Work</div>
        
        <nav class="sidebar-nav">
            <ul class="nav-list">
                <li class="nav-item <?php echo in_array($current, ['ourwork.php', 'ourwork_form.php']) ? 'active' : ''; ?>">
                    <a href="<?php echo CLP_ADMIN_URL; ?>/ourwork.php" class="nav-link">
                        <i class="fas fa-newspaper"></i>
                        <span>Our Work Pages</span>
                    </a>
                </li>
                <li class="nav-item has-dropdown <?php echo in_array($current, ['clc.php', 'clc_form.php', 'clc_view.php', 'clc_upload.php']) ? 'active' : ''; ?>">
                    <a href="javascript:void(0)" class="nav-link dropdown-toggle">
                        <i class="fas fa-laptop-code"></i>
                        <span>Computer Literacy Center (CLC)</span>
                        <i class="fas fa-chevron-down dropdown-arrow"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="<?php echo $current == 'clc.php' ? 'active' : ''; ?>">
                            <a href="<?php echo CLP_ADMIN_URL; ?>/clc.php" class="dropdown-link">
                                <i class="fas fa-list"></i> All Participants
                            </a>
                        </li>
                        <li class="<?php echo $current == 'clc_form.php' ? 'active' : ''; ?>">
                            <a href="<?php echo CLP_ADMIN_URL; ?>/clc_form.php" class="dropdown-link">
                                <i class="fas fa-plus-circle"></i> Add Participant
                            </a>
                        </li>
                        <li class="<?php echo $current == 'clc_upload.php' ? 'active' : ''; ?>">
                            <a href="<?php echo CLP_ADMIN_URL; ?>/clc_upload.php" class="dropdown-link">
                                <i class="fas fa-file-excel"></i> Upload Excel
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        
        <div class="sidebar-section">Center Management</div>
        
        <nav class="sidebar-nav">
            <ul class="nav-list">
                <li class="nav-item <?php echo in_array($current, ['centers.php', 'centers_form.php', 'centers_view.php']) ? 'active' : ''; ?>">
                    <a href="<?php echo CLP_ADMIN_URL; ?>/centers.php" class="nav-link">
                        <i class="fas fa-building"></i>
                        <span>School Information</span>
                    </a>
                </li>
            </ul>
        </nav>
        
        <div class="sidebar-section">School Details</div>
        
        <nav class="sidebar-nav">
            <ul class="nav-list">
                <li class="nav-item <?php echo in_array($current, ['centers.php', 'centers_form.php', 'centers_view.php']) ? 'active' : ''; ?>">
                    <a href="<?php echo CLP_ADMIN_URL; ?>/centers.php" class="nav-link">
                        <i class="fas fa-list"></i>
                        <span>All School Details</span>
                    </a>
                </li>
            </ul>
        </nav>
        
        <div class="sidebar-section">Reports</div>
        
        <nav class="sidebar-nav">
            <ul class="nav-list">
                <li class="nav-item <?php echo in_array($current, ['eos-reports.php', 'eos-reports_form.php']) ? 'active' : ''; ?>">
                    <a href="<?php echo CLP_ADMIN_URL; ?>/eos-reports.php" class="nav-link">
                        <i class="fas fa-file-alt"></i>
                        <span>EOS Evaluation Reports</span>
                    </a>
                </li>
            </ul>
        </nav>
        
        <div class="sidebar-section">Reports</div>
        
        <nav class="sidebar-nav">
            <ul class="nav-list">
                <li class="nav-item <?php echo in_array($current, ['evaluation-reports.php', 'evaluation-reports_form.php']) ? 'active' : ''; ?>">
                    <a href="<?php echo CLP_ADMIN_URL; ?>/evaluation-reports.php" class="nav-link">
                        <i class="fas fa-file-signature"></i>
                        <span>Evaluation Reports</span>
                    </a>
                </li>
                <li class="nav-item <?php echo in_array($current, ['eos-reports.php', 'eos-reports_form.php']) ? 'active' : ''; ?>">
                    <a href="<?php echo CLP_ADMIN_URL; ?>/eos-reports.php" class="nav-link">
                        <i class="fas fa-file-alt"></i>
                        <span>EOS Evaluation Reports</span>
                    </a>
                </li>
                <li class="nav-item <?php echo in_array($current, ['magazines_admin.php', 'magazines_form.php']) ? 'active' : ''; ?>">
                    <a href="<?php echo CLP_ADMIN_URL; ?>/magazines_admin.php" class="nav-link">
                        <i class="fas fa-book"></i>
                        <span>Magazines</span>
                    </a>
                </li>
            </ul>
        </nav>
        
        <div class="sidebar-section">Settings</div>
        
        <nav class="sidebar-nav">
            <ul class="nav-list">
                <li class="nav-item <?php echo $current == 'page_settings.php' ? 'active' : ''; ?>">
                    <a href="<?php echo CLP_ADMIN_URL; ?>/page_settings.php" class="nav-link">
                        <i class="fas fa-cog"></i>
                        <span>Page Settings</span>
                    </a>
                </li>
                <li class="nav-item <?php echo in_array($current, ['footer.php', 'footer_form.php']) ? 'active' : ''; ?>">
                    <a href="<?php echo CLP_ADMIN_URL; ?>/footer.php" class="nav-link">
                        <i class="fas fa-shoe-prints"></i>
                        <span>Footer Management</span>
                    </a>
                </li>
                <li class="nav-item <?php echo $current == 'presentations.php' ? 'active' : ''; ?>">
                    <a href="<?php echo CLP_ADMIN_URL; ?>/presentations.php" class="nav-link">
                        <i class="fas fa-file-pdf"></i>
                        <span>Presentations</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    
    <div class="sidebar-footer">
        <a href="/" target="_blank" class="view-site-btn">
            <i class="fas fa-external-link-alt"></i> View Website
        </a>
    </div>
</aside>
