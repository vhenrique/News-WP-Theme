<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1,width=device-width">
	<title><?php wp_title('&laquo;', true, 'right'); bloginfo('name'); ?></title>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link href="https://fonts.googleapis.com/css?family=Raleway:400,300,700" rel="stylesheet" type="text/css">
	<link href='https://fonts.googleapis.com/css?family=Signika+Negative:400,300,600,700' rel='stylesheet' type='text/css'>

	<?php
	wp_head(); 

	// Visitors counter on single pages
	newVisit();
	global $redux_options, $themePrefix;
	if( ! empty( $redux_options[$themePrefix.'favicon_url'] ) ){
		echo '<link href="'.$redux_options[$themePrefix.'favicon_url']['url'].'" rel="shortcut icon" type="image/x-icon" />';
	} ?>
</head>
<body <?php body_class(); ?>>
	<div id="main-wrapper" class="homepage">
		<header id="navigation">
			<div class="navbar" role="banner">
				<?php 

				// Image brand
				if( ! empty( $redux_options[$themePrefix.'logo_url'] ) && strlen( $redux_options[$themePrefix . 'logo_url']['url'] ) !=  0 ){
					echo '<a class="secondary-logo" href="'.get_home_url().'">';
						echo '<img class="img-responsive" src="'.$redux_options[$themePrefix.'logo_url']['url'].'" title="'.get_bloginfo( 'name' ).'" alt="'.get_bloginfo( 'description' ).'" />';
					echo '</a>';
				} 
				else{
					echo '<a class="secondary-logo" href="'.get_home_url().'">';
						echo '<h1>' . get_bloginfo( 'name' ) . '</h1>';
					echo '</a>';
				}  ?>
				<div class="topbar">
					<div class="container">
						<div id="topbar" class="navbar-header">
							<?php 

							// Image logo / brand at absolute header
							if(  ! empty( $redux_options[$themePrefix . 'logo_url'] )  && strlen( $redux_options[$themePrefix . 'logo_url']['url'] ) !=  0 ){
								echo '<a class="navbar-brand" href="' . get_home_url() . '">';
									echo '<img class="main-logo img-responsive" src="' . $redux_options[$themePrefix . 'logo_url']['url'] . '" title="' . get_bloginfo( 'name' ) . '" alt="' . get_bloginfo( 'description' ) . '" />';
								echo '</a>';
							} else{
								echo '<h1 class="col-md-3"><a href="' . get_home_url() . '">' . get_bloginfo( 'name' ) . '</a></h1>';
							} ?>							
							<div id="topbar-right">
								<?php 

								// If the switch on theme options will true, show the date
								if( $redux_options[$themePrefix . 'showDate'] ){
									echo '<div id="date-time">';
										echo date( 'd' ) . ' de ' . date( 'F' ) . ', ' . date( 'Y' );
									echo '</div>';
								}

								if( $redux_options[$themePrefix . 'showWeather'] ){
									echo '<div id="weather"></div>';
								}
								?>
							</div>
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div> 
					</div> 
				</div> 
				<div id="menubar">
					<div class="container">
						<nav id="mainmenu" class="navbar-left collapse navbar-collapse">
							<ul class="nav navbar-nav">
								<li class="environment dropdown mega-dropdown">
									<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Eventos</a>
									<div class="dropdown-menu mega-menu">
										<div class="container">
											<div class="row">
												<div class="col-sm-3">
													<h2>Eventos por região</h2>
													<?php 
														$blogIDs = get_blog_list( 0, 'all' );
														echo '<ul>';
														foreach( $blogIDs as $blogID ){

															// Alternate blog by blog
													    	switch_to_blog( $blogID['blog_id'] ); 

															echo '<li><a href="' . get_site_url( $blogID['blog_id'] ) . '">' . get_blog_details( $blogID )->blogname . '</a></li>';

															// Return to current site
															switch_to_blog( get_current_blog_id() ); 
														}
														echo '</ul>';
													?>
												</div>

												<?php 
												foreach( $blogIDs as $blogID ){

													// Alternate blog by blog
												    switch_to_blog( $blogID['blog_id'] ); 

												    // Get events from every single blog
												    $events = get_posts( array(
												    		'post_type'			=> 'eventos',
												    		'posts_per_page'	=> '3'
												    	) 
												    );

												    if( ! empty( $events ) ){
												    	foreach( $events as $event ){
															echo '<div class="col-sm-3">';
																echo '<h2>' . get_blog_details( $blogID )->blogname . '</h2>';
																echo '<div class="entry-thumbnail">';
																	echo '<a href="' . get_permalink( $event->ID ) . '">';
																		echo get_the_post_thumbnail( $event->ID, $themePrefix . 'postList', array(
																				'class'		=> 'img-responsive',
																				'title'		=> $event->post_title
																			) 
																		);
																		echo '<hr>';
																		echo $event->post_title;
																		echo '<p>' . $event->post_excerpt . '</p>';
																	echo '</a>';
																echo '</div>';
															echo '</div>';
												    	}
												    }

												    // Return to current site
													switch_to_blog( get_current_blog_id() );
												}
												?>
											</div>
										</div>
									</div>
								</li>

								<li class="environment dropdown mega-dropdown">
									<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Notícias</a>
									<div class="dropdown-menu mega-menu">
										<div class="container">
											<div class="row">
												<div class="col-sm-3">
													<h2>Notícias por região</h2>
													<?php 
														$blogIDs = get_blog_list( 0, 'all' );
														echo '<ul>';
														foreach( $blogIDs as $blogID ){

															// Alternate blog by blog
													    	switch_to_blog( $blogID['blog_id'] ); 

															echo '<li><a href="' . get_site_url( $blogID['blog_id'] ) . '/noticias/">' . get_blog_details( $blogID )->blogname . '</a></li>';

															// Return to current site
															switch_to_blog( 1 ); 
														}
														echo '</ul>';
													?>
												</div>

												<?php 
												foreach( $blogIDs as $blogID ){

													// Alternate blog by blog
												    switch_to_blog( $blogID['blog_id'] ); 

												    // Get events from every single blog
												    $events = get_posts( array(
												    		'post_type'			=> 'noticias',
												    		'posts_per_page'	=> '3'
												    	) 
												    );

												    if( ! empty( $events ) ){
												    	foreach( $events as $event ){
															echo '<div class="col-sm-3">';
																echo '<h2>' . get_blog_details( $blogID )->blogname . '</h2>';
																echo '<div class="entry-thumbnail">';
																	echo '<a href="' . get_permalink( $event->ID ) . '">';
																		echo get_the_post_thumbnail( $event->ID, $themePrefix . 'postList', array(
																				'class'		=> 'img-responsive',
																				'title'		=> $event->post_title
																			) 
																		);
																		echo '<hr>';
																		echo $event->post_title;
																		echo '<p>' . $event->post_excerpt . '</p>';
																	echo '</a>';
																echo '</div>';
															echo '</div>';
												    	}
												    }

												    // Return to current site
													switch_to_blog( get_current_blog_id() );
												}
												?>
											</div>
										</div>
									</div>
								</li>

								<li class="environment dropdown mega-dropdown">
									<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Revista</a>
									<div class="dropdown-menu mega-menu">
										<div class="container">
											<div class="row">
												<div class="col-sm-3">
													<?php echo '<a href="' . get_post_type_archive_link( 'revista' ) . '"><h2>Todas as edições</h2></a>'; ?>
												</div>
												<?php 

											    $magazines = get_posts( array(
											    		'post_type'			=> 'revista',
											    		'posts_per_page'	=> '4'
											    	) 
											    );

											    if( ! empty( $magazines ) ){
											    	foreach( $magazines as $magazine ){
														echo '<div class="col-sm-3">';
															echo '<div class="entry-thumbnail">';
																echo '<a href="' . get_permalink( $magazine->ID ) . '">';
																	echo get_the_post_thumbnail( $magazine->ID, $themePrefix . 'magazineList', array(
																			'class'		=> 'img-responsive',
																			'title'		=> $magazine->post_title
																		) 
																	);
																	echo '<hr>';
																	echo '<h2>' . $magazine->post_title . '</h2>';
																	echo '<p>' . $magazine->post_excerpt . '</p>';
																echo '</a>';
															echo '</div>';
														echo '</div>';
											    	}
											    }
												?>
											</div>
										</div>
									</div>
								</li>

								<?php
								echo '<li>';
									echo '<a href="' . get_permalink( 3 ) . '">Contato</a>';
								echo '</li>';
								?>
							</ul>
						</nav>

						<div class="searchNlogin">
							<ul>
								<li class="search-icon"><i class="fa fa-search"></i></li>
							</ul>
							<div class="search">
								<form action="<?php echo get_home_url(); ?>" method="GET">
									<?php echo '<input type="text" class="search-form" name="s" placeholder="Buscar em '.get_bloginfo( 'name' ).'" required />'; ?>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>