<div class="mission frontPost row">
	<div class="title">Mission/Vision/Goals</div>
	<?php
	$mission = get_posts( array( 'category' => get_cat_ID( 'Mission/Vision/Goals' ), 'numberposts' => - 1 ) );

	foreach ( $mission as $m ) : setup_postdata( $m );
		$missionContent = apply_filters( 'the_content', $m->post_content );
		echo '<div class="content">' . $missionContent . '</div>';
	endforeach;
	?>

</div>
<div class="registerNow row">
	<div class="title row">Register</div>
	<div class="content row">
		<?php
		$registerNow = get_posts( array( 'category' => get_cat_ID( 'RegisterSlice' ), 'numberposts' => - 1 ) );

		foreach ( $registerNow as $r ) : setup_postdata( $r );
			$registerContent = apply_filters( 'the_content', $r->post_content );
			echo '<span class="col-xs-12 col-md-7 col-lg-8 row">' . $registerContent . '</span>';
		endforeach;
		?>
		<a class="register col-xs-12 col-md-5 col-lg-4 pull-right" href="<?php global $eventUrl;
		echo $eventUrl; ?>"
		   target="_blank">
			register now
			<span class="col-xs-1 col-sm-2 pull-right">&#8594;</span>
		</a>
	</div>
</div>
<div class="projects frontPost row">
	<div class="title">Project proposes</div>
	<div class="projectsList container row">
		<div class="row col-xs-12 col-sm-8 col-md-9">
			<?php
			$projects          = get_posts( array( 'category' => get_cat_ID( 'Projects' ), 'numberposts' => - 1 ) );
			$validRandomNumber = 1;
			foreach ( $projects as $p ) : setup_postdata( $p );
				$projectTitle = apply_filters( 'the_title', $p->post_title );
				//$projectBackground = get_the_post_thumbnail($p->ID, 'projects_big');
				$projectBackground = get_the_post_thumbnail( $p->ID, array( 190, 285 ) );
				if ( $projectBackground == '' ) {
					$projectBackground = '<img src="' . get_template_directory_uri() . '/images/projects/projectblank_0' . $validRandomNumber ++ . '.png" />';
				}

				$projectBlock = '<a class="project col-xs-12 col-md-3" href="' . get_permalink( $p->ID ) . '">';
				$projectBlock .= '<div class="projectTitle"><span>' . $projectTitle . '<span></div>';
				$projectBlock .= '<div class="projectImg">' . $projectBackground . '</div>';
				$projectBlock .= '</a>';

				if ( $validRandomNumber > 3 ) {
					$validRandomNumber = 1;
				}

				echo $projectBlock;
			endforeach;
			$projectBlankLimit = 3;

			for ( $i = count( $projects ); $i < $projectBlankLimit; ) {
				?>
				<a class="project col-xs-12 col-md-3" href="#space-for-your-project" onclick="javascript:return false;">
					<div class="projectTitle">
						<span>Space for your project</span>
					</div>
					<div class="projectImg"><img
							src="<?php echo get_template_directory_uri() . '/images/projects/projectblank_0' . ++ $i . '.png' ?>"/>
					</div>
				</a>
			<?php
			}
			?>

			<a class="project addNew col-xs-12 col-md-3" href="./add-your-projects">
				<div class="projectTitle">
					<span>Add Your Project</span>

					<div class="arrow">&#8594;</div>
				</div>
			</a>
		</div>
	</div>
</div>
<div class="mentors frontPost row">
	<div class="title">Mentors</div>
	<div class="mentorsList container row">
		<?php
		$mentors = get_posts( array( 'category' => get_cat_ID( 'Mentors' ), 'numberposts' => - 1 ) );

		foreach ( $mentors as $m ) : setup_postdata( $m );
			$mentorsName      = apply_filters( 'the_title', $m->post_title );
			$mentorBackground = get_the_post_thumbnail( $m->ID, 'thumbnail' );
			if ( empty( $mentorBackground ) ) {
				$mentorBackground = '<img src="' . get_template_directory_uri() . '/images/mentors/blank.png" />';
			}

			$projectBlock = '<a class="mentor col-xs-12 col-md-3" href="./mentors#' . $m->post_name . '">';
			$projectBlock .= '<div class="mentorTitle"><span>' . $mentorsName . '<span></div>';
			$projectBlock .= '<div class="mentorImg">' . $mentorBackground . '</div>';
			$projectBlock .= '</a>';

			echo $projectBlock;
		endforeach;
		?>
		<a class="mentor addNew col-xs-12 col-md-3" href="/mentors">
			<div class="mentorTitle">
				<span>More to be announced</span>

				<div class="arrow">&#8594;</div>
			</div>
			<div class="mentorImg"></div>
		</a>
	</div>
</div>
<div class="jury frontPost row">
	<div class="title">Jury</div>
	<div class="juryList container row">
		<?php
		$jury = get_posts( array( 'category' => get_cat_ID( 'Jury' ), 'numberposts' => - 1 ) );

		foreach ( $jury as $j ) : setup_postdata( $j );
			$juryName = apply_filters( 'the_title', $j->post_title );
			//$juryInformation = apply_filters('the_content', $j->post_content);
			$juryInformation = strip_tags( apply_filters( 'the_content', $j->post_content ), '<p><span><a><b><strong><br><img>' );
			$juryBackground  = get_the_post_thumbnail( $j->ID, 'thumbnail' );
			if ( empty( $juryBackground ) ) {
				$juryBackground = '<img src="' . get_template_directory_uri() . '/images/mentors/blank.png" />';
			}

			$projectBlock = '<div class="member col-xs-12">';
			$projectBlock .= '<div class="juryTitle"><span>' . $juryName . '<span></div>';
			$projectBlock .= '<div class="juryImg">' . $juryBackground . '</div>';
			$projectBlock .= '<div class="juryInformation">' . $juryInformation . '</div>';
			$projectBlock .= '</div>';

			echo $projectBlock;
		endforeach;
		?>
	</div>
</div>
<div class="organizers frontPost row">
	<div class="title">Organizers & Partners</div>
	<div class="content container">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">Organizer</div>
				<a href="http://www.ilw.org.pl/en/" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/instytut_lech_walesa.png"
					     alt="Lech Wałęsa Institute Foundation"/>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">Co-Organizers</div>
				<a href="http://www.ecs.gda.pl/" target="_blank">
					<img
						src="<?php echo get_template_directory_uri(); ?>/images/organizers/europejskie_centrum_solidarnosci.png"
						alt="Europejskie Centrum Solidarności"/>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">&nbsp;</div>
				<a href="http://epf.org.pl/eng" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/fundacja_epf.png"
					     alt="ePaństwo Fundation"/>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">&nbsp;</div>
				<a href="http://te-st.ru/" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/teplitsa.png"
					     alt="Teplitsa of Social Technologies"/>
				</a>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">Sponsors</div>
				<a href="https://www.f-secure.com/en/" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/f-secure.png"
					     alt="F-Secure"/>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">&nbsp;</div>
				<a href="https://www.lhsystems.com/" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/lufthansa_systems.png"
					     alt="Lufthansa Systems"/>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">&nbsp;</div>
				<a href="http://www.strefa.gda.pl/en" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/pomorska.png"
					     alt="Pomorska Specjalna Strefa Ekonomiczna"/>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">&nbsp;</div>
				<a href="https://www.google.com/culturalinstitute/" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/google_cultural_institute.png"
					     alt="Google Cultural Institute"/>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">&nbsp;</div>
				<a href="http://www.tigerpower.pl/" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/tiger.png"
					     alt="Tiger Energy Drink"/>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">&nbsp;</div>
				<a href="http://www.gpnt.pl/en.html" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/gdansk_science_technology_park.png"
					     alt="Gdansk Science & Technology Park"/>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">&nbsp;</div>
				<a href="http://helion.pl" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/helion.png"
					     alt="Helion"/>
				</a>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">Patronage</div>
				<a href="https://mac.gov.pl/en/" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/mac.png"
					     alt="Ministerstwo Administracji i Cyfryzacji"/>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">&nbsp;</div>
				<a href="http://www.gdansk.pl/en/" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/gdansk.png"
					     alt="Gdańsk - City of Freedom"/>
				</a>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">Supporting projects</div>
				<a href="http://www.ilw.org.pl/en/about-us/programme/67-gene-of-freedom" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/gene_of_freedom.png"
					     alt="Gene for Freedom"/>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">&nbsp;</div>
				<a href="http://epf.org.pl/kodujdlapolski/eng" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/code_for_poland.png"
					     alt="Code for Poland"/>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">&nbsp;</div>
				<a href="http://openparl2014.org/" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/glow.png"
					     alt="Global Legislative Openness Week"/>
				</a>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">Partners</div>
				<a href="https://www.technologie.org.pl/" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/technologie.png"
					     alt="Technologie.org.pl"/>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">&nbsp;</div>
				<a href="http://www.techsoupeurope.org/" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/techsoup.png"
					     alt="Techsoup Europe"/>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">&nbsp;</div>
				<a href="http://itwiz.pl/" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/itwiz.png"
					     alt="ITwiz"/>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">&nbsp;</div>
				<a href="http://www.komputerswiat.pl/" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/komputerswiat.png"
					     alt="Komputer Świat"/>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">&nbsp;</div>
				<a href="http://www.linux-magazine.pl/" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/linux_magazine.png"
					     alt="Komputer Świat"/>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">&nbsp;</div>
				<a href="http://crossweb.pl/" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/crossweb.png"
					     alt="CrossWeb.pl"/>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">&nbsp;</div>
				<a href="http://di.com.pl/" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/dziennik_internatow.png"
					     alt="Dziennik Internatów"/>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">&nbsp;</div>
				<a href="http://webmastah.pl/" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/webmastah.png"
					     alt="webMASTAH"/>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">&nbsp;</div>
				<a href="http://liberte.pl/" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/liberte.png"
					     alt="Liberté!"/>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">&nbsp;</div>
				<a href="http://inkubatorstarter.pl/" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/starter.png"
					     alt="Starter"/>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">&nbsp;</div>
				<a href="http://wspolna.org/" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/fundacja_wspolna_europa.png"
					     alt="Fundacja Wspólna Europa"/>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">&nbsp;</div>
				<a href="http://eastbook.eu/" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/eastbook.png"
					     alt="Eastbook.eu"/>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">&nbsp;</div>
				<a href="http://www.aegee.gdansk.pl/" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/aegee_gdansk.png"
					     alt="Europejskie Forum Studentów AEGEE-Gdansk"/>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">&nbsp;</div>
				<a href="http://www.RecruitCoders.com" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/recruitcoders.png"
					     alt="RecruitCoders.com"/>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">&nbsp;</div>
				<a href="https://www.facebook.com/ideone" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/ideone.png"
					     alt="Ideone"/>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="subtitle">&nbsp;</div>
				<a href="http://contest.pl/" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/organizers/contest.png"
					     alt="Contest.pl – konkursy dla uczniów i studentów"/>
				</a>
			</div>
		</div>
	</div>
</div>