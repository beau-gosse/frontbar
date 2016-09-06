<!-- Frontbar -->
<header class="fbr-navbar">
	<div class="nav-brand"><a href="[[+mgrURL]]" class="icon-modx">[[++site_name]]</a></div>
	<nav class="fbr-primary-nav">
		<a href="#fbr-navigation" class="nav-trigger">
			<span>
				<em aria-hidden="true"></em>
				Menu
			</span>
		</a>
		<ul id="fbr-navigation" class="nav">
			<li class="fbr-nav-item"><a href="[[+updateURL]]" class="fbr-nav-link icon-edit">Edit Document</a></li>
			<li class="fbr-nav-item ui simple poiting dropdown item">
				<a href="[[+createURL]]&amp;class_key=modDocument" class="fbr-nav-link icon-new">New</a>
				<div class="menu">
					<a href="[[+createURL]]&amp;class_key=modDocument" class="item">Document</a>
					<a href="[[+createURL]]&amp;class_key=modWebLink" class="item">Weblink</a>
					<a href="[[+createURL]]&amp;class_key=modSymLink" class="item">Symlink</a>
					<a href="[[+createURL]]&amp;class_key=modStaticResource" class="item">Static Resource</a>
				</div>
			</li>
      [[+showSettings:is=`1`:then=`<li class="fbr-nav-item"><a href="[[+settingsURL]]" class="fbr-nav-link icon-setting">Settings</a></li>`]]
      [[+showProfile:is=`1`:then=`
      <li class="fbr-nav-item ui simple poiting dropdown item">
				<a href="[[+profileURL]]" class="fbr-nav-link edit-user"><img src="[[+gravatar]]" width="32" class="user-image" alt="[[+fullname]]"><span class="username">[[+username]]</span></a>
				<div class="menu">
					<a href="[[+profileURL]]" class="item">Edit Account</a>
					<a href="[[+msgURL]]" class="item">Messages</a>
				</div>
			</li>
      `]]
		</ul>
	</nav>
</header>
<!-- /.Frontbar -->
