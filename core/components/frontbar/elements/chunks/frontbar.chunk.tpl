  <!-- Frontbar -->
  <nav class="fbr-navbar navbar is-dark is-fixed-[[+position]]" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">

      <a class="navbar-item" href="[[+manager_url]]">
        <span class="fbr-icon"><i class="fab fa-modx"></i></span> [[++site_name]]
      </a>

      <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"
        data-target="frontbar">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>

    <div id="frontbar" class="navbar-menu">
      <div class="navbar-end">
        <a href="[[+update_url]]" class="navbar-item">
          <span class="fbr-icon"><i class="fas fa-pen"></i></span> Edit Ducument
				</a>
				
        <div class="navbar-item has-dropdown [[+dropdown-direction]] is-hoverable">
          <a href="[[+create_url]]&amp;class_key=modDocument" class="navbar-link is-arrowless">
            <span class="fbr-icon"><i class="fas fa-plus"></i></span> New
          </a>

          <div class="navbar-dropdown">
            <a href="[[+create_url]]&amp;class_key=modDocument" class="navbar-item">
              Document
            </a>
            <a href="[[+create_url]]&amp;class_key=modWebLink" class="navbar-item">
              Weblink
            </a>
            <a href="[[+create_url]]&amp;class_key=modSymlink" class="navbar-item">
              Symlink
            </a>            
            <a href="[[+create_url]]&amp;class_key=modStaticResource" class="navbar-item">
              Static Resource
            </a>
          </div>
        </div>

        [[+showTemplate:is=`1`:then=`
          <a href="[[+template_url]]" class="navbar-item">
            <span class="fbr-icon"><i class="fas fa-columns"></i></span> Edit Template
          </a>
        `]]       

        [[+showSettings:is=`1`:then=`
          <a href="[[+settings_url]]" class="navbar-item">
            <span class="fbr-icon"><i class="fas fa-cog"></i></span> Settings
          </a>        
        `]]        

        [[+showProfile:is=`1`:then=`
          <div class="navbar-item has-dropdown [[+dropdown-direction]] is-hoverable">
            <a href="[[+profile_url]]" class="navbar-link is-arrowless user-menu">              
              <img src="[[+gravatar]]" width="32" class="user-image" alt="[[+fullname]]"><span class="username">[[+fullname]]</span>
            </a>
            <div class="navbar-dropdown is-right">
              <a href="[[+profile_url]]" class="navbar-item">
                Edit Account
              </a>
              <a href="[[+message_url]]" class="navbar-item">
                Messages
              </a>
              <a href="[[+logout_url]]" class="navbar-item">
                Logout
              </a>              
            </div>
          </div>        
        `]]
      </div>
    </div>
  </nav>
  <!-- /.Frontbar -->