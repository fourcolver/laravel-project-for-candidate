<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark" style="margin-top: -22px;">
	<!-- BEGIN: Aside Menu -->
	<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " data-menu-vertical="true" data-menu-scrollable="false" data-menu-dropdown-timeout="500">
		<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow m-nav-fixed m_sticky">
			<li class="m-menu__item
			 {{request()->route()->uri() == 'dashboard' ? 'm-menu__item--active': ''}}" aria-haspopup="true" >
				<a  href="{{url('/dashboard')}}" class="m-menu__link ">
					<i class="m-menu__link-icon flaticon-confetti
{{request()->route()->uri() == 'dashboard' ? 'link-icon-active': ''}}"></i>
					<span class="m-menu__link-title">
						<span class="m-menu__link-wrap">
							<span class="m-menu__link-text">
								Daten
							</span>
						</span>
					</span>
				</a>
			</li>
			<li class="m-menu__item
			 {{request()->route()->uri() == 'freelancer/profile' ? 'm-menu__item--active': ''}}" aria-haspopup="true" >
				<a  href="{{url('freelancer/profile')}}" class="m-menu__link ">
					<i class="m-menu__link-icon flaticon-users
{{request()->route()->uri() == 'freelancer/profile' ? 'link-icon-active': ''}}"></i>
					<span class="m-menu__link-title">
						<span class="m-menu__link-wrap">
							<span class="m-menu__link-text">
								Profil
							</span>
						</span>
					</span>
				</a>
			</li>
		</ul>
	</div>
<!-- END: Aside Menu -->
</div>
<!-- END: Left Aside -->