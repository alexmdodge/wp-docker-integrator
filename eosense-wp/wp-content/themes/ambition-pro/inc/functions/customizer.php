<?php 
/**
 * Ambition Pro Theme Customizer support
 *
 * @package Theme Horse
 * @subpackage Ambition Pro
 * @since Ambition Pro 1.0
 */
?>
<?php
/**
 * Implement Theme Customizer additions and adjustments.
 *
 * @since Ambition Pro 1.0
 *
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
function ambition_textarea_register($wp_customize){
	class Ambition_Customize_Ambition_upgrade extends WP_Customize_Control {
		public function render_content() { ?>
		<div class="theme-info"> 
			<a href="<?php echo esc_url( 'http://themehorse.com/theme-instruction/ambition-pro/' ); ?>" title="<?php esc_attr_e( 'Ambition Pro Theme Instructions', 'ambition' ); ?>" target="_blank">
			<?php _e( 'Theme Instructions', 'ambition' ); ?>
			</a>
			<a href="<?php echo esc_url( 'http://themehorse.com/support-forum/' ); ?>" title="<?php esc_attr_e( 'Support Forum', 'ambition' ); ?>" target="_blank">
			<?php _e( 'Support Forum', 'ambition' ); ?>
			</a>
			<a href="<?php echo esc_url( 'http://themehorse.com/preview/ambition-pro/' ); ?>" title="<?php esc_attr_e( 'Ambition Pro Demo', 'ambition' ); ?>" target="_blank">
			<?php _e( 'View Demo', 'ambition' ); ?>
			</a>
		</div>
		<?php
		}
	}
	class Ambition_Customize_Category_Control extends WP_Customize_Control {
		/**
		* The type of customize control being rendered.
		*/
		public $type = 'multiple-select';
		/**
		* Displays the multiple select on the customize screen.
		*/
		public function render_content() {
		global $ambition_settings, $array_of_default_settings;
		$ambition_settings = wp_parse_args(  get_option( 'ambition_theme_settings', array() ),  ambition_get_option_defaults());
		$categories = get_categories(); ?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<select <?php $this->link(); ?> multiple="multiple" style="height: 100%;">
				<?php
					foreach ( $categories as $category) :?>
						<option value="<?php echo $category->cat_ID; ?>" <?php if ( in_array( $category->cat_ID, $ambition_settings['ambition_categories']) ) { echo 'selected="selected"';}?>><?php echo $category->cat_name; ?></option>
					<?php endforeach; ?>
				?>
				</select>
			</label>
		<?php 
		}
	}

	class Ambition_Revolution_Slider_Control extends WP_Customize_Control {
		public function render_content() { ?>
		 <?php
			if ( is_plugin_active( 'revslider/revslider.php' ) ) {
			?>
			<table class="form-table">
                    <tbody>
                        <?php
                        $slider = new RevSlider();
                        $arrSliders = $slider->getAllSliderAliases();
                                
                        if(empty($arrSliders))
                            echo '<tr><th scope="row"></th><td>'.__( 'No sliders found, Please create a slider. You can create it', 'ambition' ).'  '.'<a href="'.esc_url( home_url() ).'/wp-admin/themes.php?page=revslider">'.__( 'here', 'ambition' ).'</a>'.'</td></tr>';
                        else{
                            ?>
								<label>
									<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
									<select <?php $this->link(); ?> style="height: 100%;">
									<?php
										foreach ( $arrSliders as $slider) :?>
										 <option value="<?php echo esc_attr( $slider ); ?>" <?php selected( 'ambition_revolution_options', $slider ); ?>><?php printf( esc_attr( '%s', 'ambition' ), $slider ); ?></option>
										<?php endforeach; ?>
									</select>
								</label>
                              <?php
                        }
                        ?>
                    </tbody>
                </table>
		<?php 
			}
		}
	}
}
//list of google fonts used in theme options
function ambition_google_fonts() {
	$ambition_google_fonts = array(
		"Abel" => "Abel",
		"Abril Fatface" => "Abril Fatface",
		"Aclonica" => "Aclonica",
		"Acme" => "Acme",
		"Actor" => "Actor",
		"Adamina" => "Adamina",
		"Advent Pro" => "Advent Pro",
		"Aguafina Script" => "Aguafina Script",
		"Aladin" => "Aladin",
		"Aldrich" => "Aldrich",
		"Alegreya" => "Alegreya",
		"Alegreya SC" => "Alegreya SC",
		"Alex Brush" => "Alex Brush",
		"Alfa Slab One" => "Alfa Slab One",
		"Alice" => "Alice",
		"Alike" => "Alike",
		"Alike Angular" => "Alike Angular",
		"Allan" => "Allan",
		"Allerta" => "Allerta",
		"Allerta Stencil" => "Allerta Stencil",
		"Allura" => "Allura",
		"Almendra" => "Almendra",
		"Almendra SC" => "Almendra SC",
		"Amaranth" => "Amaranth",
		"Amatic SC" => "Amatic SC",
		"Amethysta" => "Amethysta",
		"Andada" => "Andada",
		"Andika" => "Andika",
		"Angkor" => "Angkor",
		"Annie Use Your Telescope" => "Annie Use Your Telescope",
		"Anonymous Pro" => "Anonymous Pro",
		"Antic" => "Antic",
		"Antic Didone" => "Antic Didone",
		"Antic Slab" => "Antic Slab",
		"Anton" => "Anton",
		"Arapey" => "Arapey",
		"Arbutus" => "Arbutus",
		"Architects Daughter" => "Architects Daughter",
		"Arimo" => "Arimo",
		"Arizonia" => "Arizonia",
		"Armata" => "Armata",
		"Artifika" => "Artifika",
		"Arvo" => "Arvo",
		"Asap" => "Asap",
		"Asset" => "Asset",
		"Astloch" => "Astloch",
		"Asul" => "Asul",
		"Atomic Age" => "Atomic Age",
		"Aubrey" => "Aubrey",
		"Audiowide" => "Audiowide",
		"Average" => "Average",
		"Averia Gruesa Libre" => "Averia Gruesa Libre",
		"Averia Libre" => "Averia Libre",
		"Averia Sans Libre" => "Averia Sans Libre",
		"Averia Serif Libre" => "Averia Serif Libre",
		"Bad Script" => "Bad Script",
		"Balthazar" => "Balthazar",
		"Bangers" => "Bangers",
		"Basic" => "Basic",
		"Battambang" => "Battambang",
		"Baumans" => "Baumans",
		"Bayon" => "Bayon",
		"Belgrano" => "Belgrano",
		"Belleza" => "Belleza",
		"Bentham" => "Bentham",
		"Berkshire Swash" => "Berkshire Swash",
		"Bevan" => "Bevan",
		"Bigshot One" => "Bigshot One",
		"Bilbo" => "Bilbo",
		"Bilbo Swash Caps" => "Bilbo Swash Caps",
		"Bitter" => "Bitter",
		"Black Ops One" => "Black Ops One",
		"Bokor" => "Bokor",
		"Bonbon" => "Bonbon",
		"Boogaloo" => "Boogaloo",
		"Bowlby One" => "Bowlby One",
		"Bowlby One SC" => "Bowlby One SC",
		"Brawler" => "Brawler",
		"Bree Serif" => "Bree Serif",
		"Bubblegum Sans" => "Bubblegum Sans",
		"Buda" => "Buda",
		"Buenard" => "Buenard",
		"Butcherman" => "Butcherman",
		"Butterfly Kids" => "Butterfly Kids",
		"Cabin" => "Cabin",
		"Cabin Condensed" => "Cabin Condensed",
		"Cabin Sketch" => "Cabin Sketch",
		"Caesar Dressing" => "Caesar Dressing",
		"Cagliostro" => "Cagliostro",
		"Calligraffitti" => "Calligraffitti",
		"Cambo" => "Cambo",
		"Candal" => "Candal",
		"Cantarell" => "Cantarell",
		"Cantata One" => "Cantata One",
		"Cardo" => "Cardo",
		"Carme" => "Carme",
		"Carter One" => "Carter One",
		"Caudex" => "Caudex",
		"Cedarville Cursive" => "Cedarville Cursive",
		"Ceviche One" => "Ceviche One",
		"Changa One" => "Changa One",
		"Chango" => "Chango",
		"Chau Philomene One" => "Chau Philomene One",
		"Chelsea Market" => "Chelsea Market",
		"Chenla" => "Chenla",
		"Cherry Cream Soda" => "Cherry Cream Soda",
		"Chewy" => "Chewy",
		"Chicle" => "Chicle",
		"Chivo" => "Chivo",
		"Coda" => "Coda",
		"Coda Caption" => "Coda Caption",
		"Codystar" => "Codystar",
		"Comfortaa" => "Comfortaa",
		"Coming Soon" => "Coming Soon",
		"Concert One" => "Concert One",
		"Condiment" => "Condiment",
		"Content" => "Content",
		"Contrail One" => "Contrail One",
		"Convergence" => "Convergence",
		"Cookie" => "Cookie",
		"Copse" => "Copse",
		"Corben" => "Corben",
		"Cousine" => "Cousine",
		"Coustard" => "Coustard",
		"Covered By Your Grace" => "Covered By Your Grace",
		"Crafty Girls" => "Crafty Girls",
		"Creepster" => "Creepster",
		"Crete Round" => "Crete Round",
		"Crimson Text" => "Crimson Text",
		"Crushed" => "Crushed",
		"Cuprum" => "Cuprum",
		"Cutive" => "Cutive",
		"Damion" => "Damion",
		"Dancing Script" => "Dancing Script",
		"Dangrek" => "Dangrek",
		"Dawning of a New Day" => "Dawning of a New Day",
		"Days One" => "Days One",
		"Delius" => "Delius",
		"Delius Swash Caps" => "Delius Swash Caps",
		"Delius Unicase" => "Delius Unicase",
		"Della Respira" => "Della Respira",
		"Devonshire" => "Devonshire",
		"Didact Gothic" => "Didact Gothic",
		"Diplomata" => "Diplomata",
		"Diplomata SC" => "Diplomata SC",
		"Doppio One" => "Doppio One",
		"Dorsa" => "Dorsa",
		"Dosis" => "Dosis",
		"Dr Sugiyama" => "Dr Sugiyama",
		"Droid Sans" => "Droid Sans",
		"Droid Sans Mono" => "Droid Sans Mono",
		"Droid Serif" => "Droid Serif",
		"Duru Sans" => "Duru Sans",
		"Dynalight" => "Dynalight",
		"EB Garamond" => "EB Garamond",
		"Eater" => "Eater",
		"Economica" => "Economica",
		"Electrolize" => "Electrolize",
		"Emblema One" => "Emblema One",
		"Emilys Candy" => "Emilys Candy",
		"Engagement" => "Engagement",
		"Enriqueta" => "Enriqueta",
		"Erica One" => "Erica One",
		"Esteban" => "Esteban",
		"Euphoria Script" => "Euphoria Script",
		"Ewert" => "Ewert",
		"Exo" => "Exo",
		"Expletus Sans" => "Expletus Sans",
		"Fanwood Text" => "Fanwood Text",
		"Fascinate" => "Fascinate",
		"Fascinate Inline" => "Fascinate Inline",
		"Federant" => "Federant",
		"Federo" => "Federo",
		"Felipa" => "Felipa",
		"Fjord One" => "Fjord One",
		"Flamenco" => "Flamenco",
		"Flavors" => "Flavors",
		"Fondamento" => "Fondamento",
		"Fontdiner Swanky" => "Fontdiner Swanky",
		"Forum" => "Forum",
		"Francois One" => "Francois One",
		"Fredericka the Great" => "Fredericka the Great",
		"Fredoka One" => "Fredoka One",
		"Freehand" => "Freehand",
		"Fresca" => "Fresca",
		"Frijole" => "Frijole",
		"Fugaz One" => "Fugaz One",
		"GFS Didot" => "GFS Didot",
		"GFS Neohellenic" => "GFS Neohellenic",
		"Galdeano" => "Galdeano",
		"Gentium Basic" => "Gentium Basic",
		"Gentium Book Basic" => "Gentium Book Basic",
		"Geo" => "Geo",
		"Geostar" => "Geostar",
		"Geostar Fill" => "Geostar Fill",
		"Germania One" => "Germania One",
		"Give You Glory" => "Give You Glory",
		"Glass Antiqua" => "Glass Antiqua",
		"Glegoo" => "Glegoo",
		"Gloria Hallelujah" => "Gloria Hallelujah",
		"Goblin One" => "Goblin One",
		"Gochi Hand" => "Gochi Hand",
		"Gorditas" => "Gorditas",
		"Goudy Bookletter 1911" => "Goudy Bookletter 1911",
		"Graduate" => "Graduate",
		"Gravitas One" => "Gravitas One",
		"Great Vibes" => "Great Vibes",
		"Gruppo" => "Gruppo",
		"Gudea" => "Gudea",
		"Habibi" => "Habibi",
		"Hammersmith One" => "Hammersmith One",
		"Handlee" => "Handlee",
		"Hanuman" => "Hanuman",
		"Happy Monkey" => "Happy Monkey",
		"Henny Penny" => "Henny Penny",
		"Herr Von Muellerhoff" => "Herr Von Muellerhoff",
		"Holtwood One SC" => "Holtwood One SC",
		"Homemade Apple" => "Homemade Apple",
		"Homenaje" => "Homenaje",
		"IM Fell DW Pica" => "IM Fell DW Pica",
		"IM Fell DW Pica SC" => "IM Fell DW Pica SC",
		"IM Fell Double Pica" => "IM Fell Double Pica",
		"IM Fell Double Pica SC" => "IM Fell Double Pica SC",
		"IM Fell English" => "IM Fell English",
		"IM Fell English SC" => "IM Fell English SC",
		"IM Fell French Canon" => "IM Fell French Canon",
		"IM Fell French Canon SC" => "IM Fell French Canon SC",
		"IM Fell Great Primer" => "IM Fell Great Primer",
		"IM Fell Great Primer SC" => "IM Fell Great Primer SC",
		"Iceberg" => "Iceberg",
		"Iceland" => "Iceland",
		"Imprima" => "Imprima",
		"Inconsolata" => "Inconsolata",
		"Inder" => "Inder",
		"Indie Flower" => "Indie Flower",
		"Inika" => "Inika",
		"Irish Grover" => "Irish Grover",
		"Istok Web" => "Istok Web",
		"Italiana" => "Italiana",
		"Italianno" => "Italianno",
		"Jim Nightshade" => "Jim Nightshade",
		"Jockey One" => "Jockey One",
		"Jolly Lodger" => "Jolly Lodger",
		"Josefin Sans" => "Josefin Sans",
		"Josefin Slab" => "Josefin Slab",
		"Judson" => "Judson",
		"Julee" => "Julee",
		"Junge" => "Junge",
		"Jura" => "Jura",
		"Just Another Hand" => "Just Another Hand",
		"Just Me Again Down Here" => "Just Me Again Down Here",
		"Kameron" => "Kameron",
		"Karla" => "Karla",
		"Kaushan Script" => "Kaushan Script",
		"Kelly Slab" => "Kelly Slab",
		"Kenia" => "Kenia",
		"Khmer" => "Khmer",
		"Knewave" => "Knewave",
		"Kotta One" => "Kotta One",
		"Koulen" => "Koulen",
		"Kranky" => "Kranky",
		"Kreon" => "Kreon",
		"Kristi" => "Kristi",
		"Krona One" => "Krona One",
		"La Belle Aurore" => "La Belle Aurore",
		"Lancelot" => "Lancelot",
		"Lato" => "Lato",
		"League Script" => "League Script",
		"Leckerli One" => "Leckerli One",
		"Ledger" => "Ledger",
		"Lekton" => "Lekton",
		"Lemon" => "Lemon",
		"Lilita One" => "Lilita One",
		"Limelight" => "Limelight",
		"Linden Hill" => "Linden Hill",
		"Lobster" => "Lobster",
		"Lobster Two" => "Lobster Two",
		"Londrina Outline" => "Londrina Outline",
		"Londrina Shadow" => "Londrina Shadow",
		"Londrina Sketch" => "Londrina Sketch",
		"Londrina Solid" => "Londrina Solid",
		"Lora" => "Lora",
		"Love Ya Like A Sister" => "Love Ya Like A Sister",
		"Loved by the King" => "Loved by the King",
		"Lovers Quarrel" => "Lovers Quarrel",
		"Luckiest Guy" => "Luckiest Guy",
		"Lusitana" => "Lusitana",
		"Lustria" => "Lustria",
		"Macondo" => "Macondo",
		"Macondo Swash Caps" => "Macondo Swash Caps",
		"Magra" => "Magra",
		"Maiden Orange" => "Maiden Orange",
		"Mako" => "Mako",
		"Marck Script" => "Marck Script",
		"Marko One" => "Marko One",
		"Marmelad" => "Marmelad",
		"Marvel" => "Marvel",
		"Mate" => "Mate",
		"Mate SC" => "Mate SC",
		"Maven Pro" => "Maven Pro",
		"Meddon" => "Meddon",
		"MedievalSharp" => "MedievalSharp",
		"Medula One" => "Medula One",
		"Megrim" => "Megrim",
		"Merienda One" => "Merienda One",
		"Merriweather" => "Merriweather",
		"Metal" => "Metal",
		"Metamorphous" => "Metamorphous",
		"Metrophobic" => "Metrophobic",
		"Michroma" => "Michroma",
		"Miltonian" => "Miltonian",
		"Miltonian Tattoo" => "Miltonian Tattoo",
		"Miniver" => "Miniver",
		"Miss Fajardose" => "Miss Fajardose",
		"Modern Antiqua" => "Modern Antiqua",
		"Molengo" => "Molengo",
		"Monofett" => "Monofett",
		"Monoton" => "Monoton",
		"Monsieur La Doulaise" => "Monsieur La Doulaise",
		"Montaga" => "Montaga",
		"Montez" => "Montez",
		"Montserrat" => "Montserrat",
		"Moul" => "Moul",
		"Moulpali" => "Moulpali",
		"Mountains of Christmas" => "Mountains of Christmas",
		"Mr Bedfort" => "Mr Bedfort",
		"Mr Dafoe" => "Mr Dafoe",
		"Mr De Haviland" => "Mr De Haviland",
		"Mrs Saint Delafield" => "Mrs Saint Delafield",
		"Mrs Sheppards" => "Mrs Sheppards",
		"Muli" => "Muli",
		"Mystery Quest" => "Mystery Quest",
		"Neucha" => "Neucha",
		"Neuton" => "Neuton",
		"News Cycle" => "News Cycle",
		"Niconne" => "Niconne",
		"Nixie One" => "Nixie One",
		"Nobile" => "Nobile",
		"Nokora" => "Nokora",
		"Norican" => "Norican",
		"Nosifer" => "Nosifer",
		"Nothing You Could Do" => "Nothing You Could Do",
		"Noticia Text" => "Noticia Text",
		"Nova Cut" => "Nova Cut",
		"Nova Flat" => "Nova Flat",
		"Nova Mono" => "Nova Mono",
		"Nova Oval" => "Nova Oval",
		"Nova Round" => "Nova Round",
		"Nova Script" => "Nova Script",
		"Nova Slim" => "Nova Slim",
		"Nova Square" => "Nova Square",
		"Numans" => "Numans",
		"Nunito" => "Nunito",
		"Odor Mean Chey" => "Odor Mean Chey",
		"Old Standard TT" => "Old Standard TT",
		"Oldenburg" => "Oldenburg",
		"Oleo Script" => "Oleo Script",
		"Open Sans" => "Open Sans",
		"Open Sans Condensed" => "Open Sans Condensed",
		"Orbitron" => "Orbitron",
		"Original Surfer" => "Original Surfer",
		"Oswald" => "Oswald",
		"Over the Rainbow" => "Over the Rainbow",
		"Overlock" => "Overlock",
		"Overlock SC" => "Overlock SC",
		"Ovo" => "Ovo",
		"Oxygen" => "Oxygen",
		"PT Mono" => "PT Mono",
		"PT Sans" => "PT Sans",
		"PT Sans Caption" => "PT Sans Caption",
		"PT Sans Narrow" => "PT Sans Narrow",
		"PT Serif" => "PT Serif",
		"PT Serif Caption" => "PT Serif Caption",
		"Pacifico" => "Pacifico",
		"Parisienne" => "Parisienne",
		"Passero One" => "Passero One",
		"Passion One" => "Passion One",
		"Patrick Hand" => "Patrick Hand",
		"Patua One" => "Patua One",
		"Paytone One" => "Paytone One",
		"Permanent Marker" => "Permanent Marker",
		"Petrona" => "Petrona",
		"Philosopher" => "Philosopher",
		"Piedra" => "Piedra",
		"Pinyon Script" => "Pinyon Script",
		"Plaster" => "Plaster",
		"Play" => "Play",
		"Playball" => "Playball",
		"Playfair Display" => "Playfair Display",
		"Podkova" => "Podkova",
		"Poiret One" => "Poiret One",
		"Poller One" => "Poller One",
		"Poly" => "Poly",
		"Pompiere" => "Pompiere",
		"Pontano Sans" => "Pontano Sans",
		"Port Lligat Sans" => "Port Lligat Sans",
		"Port Lligat Slab" => "Port Lligat Slab",
		"Prata" => "Prata",
		"Preahvihear" => "Preahvihear",
		"Press Start 2P" => "Press Start 2P",
		"Princess Sofia" => "Princess Sofia",
		"Prociono" => "Prociono",
		"Prosto One" => "Prosto One",
		"Puritan" => "Puritan",
		"Quantico" => "Quantico",
		"Quattrocento" => "Quattrocento",
		"Quattrocento Sans" => "Quattrocento Sans",
		"Questrial" => "Questrial",
		"Quicksand" => "Quicksand",
		"Qwigley" => "Qwigley",
		"Radley" => "Radley",
		"Raleway" => "Raleway",
		"Rammetto One" => "Rammetto One",
		"Rancho" => "Rancho",
		"Rationale" => "Rationale",
		"Redressed" => "Redressed",
		"Reenie Beanie" => "Reenie Beanie",
		"Revalia" => "Revalia",
		"Ribeye" => "Ribeye",
		"Ribeye Marrow" => "Ribeye Marrow",
		"Righteous" => "Righteous",
		"Rochester" => "Rochester",
		"Rock Salt" => "Rock Salt",
		"Rokkitt" => "Rokkitt",
		"Ropa Sans" => "Ropa Sans",
		"Rosario" => "Rosario",
		"Rosarivo" => "Rosarivo",
		"Rouge Script" => "Rouge Script",
		"Ruda" => "Ruda",
		"Ruge Boogie" => "Ruge Boogie",
		"Ruluko" => "Ruluko",
		"Ruslan Display" => "Ruslan Display",
		"Russo One" => "Russo One",
		"Ruthie" => "Ruthie",
		"Sail" => "Sail",
		"Salsa" => "Salsa",
		"Sancreek" => "Sancreek",
		"Sansita One" => "Sansita One",
		"Sarina" => "Sarina",
		"Satisfy" => "Satisfy",
		"Schoolbell" => "Schoolbell",
		"Seaweed Script" => "Seaweed Script",
		"Sevillana" => "Sevillana",
		"Shadows Into Light" => "Shadows Into Light",
		"Shadows Into Light Two" => "Shadows Into Light Two",
		"Shanti" => "Shanti",
		"Share" => "Share",
		"Shojumaru" => "Shojumaru",
		"Short Stack" => "Short Stack",
		"Siemreap" => "Siemreap",
		"Sigmar One" => "Sigmar One",
		"Signika" => "Signika",
		"Signika Negative" => "Signika Negative",
		"Simonetta" => "Simonetta",
		"Sirin Stencil" => "Sirin Stencil",
		"Six Caps" => "Six Caps",
		"Slackey" => "Slackey",
		"Smokum" => "Smokum",
		"Smythe" => "Smythe",
		"Sniglet" => "Sniglet",
		"Snippet" => "Snippet",
		"Sofia" => "Sofia",
		"Sonsie One" => "Sonsie One",
		"Sorts Mill Goudy" => "Sorts Mill Goudy",
		"Special Elite" => "Special Elite",
		"Spicy Rice" => "Spicy Rice",
		"Spinnaker" => "Spinnaker",
		"Spirax" => "Spirax",
		"Squada One" => "Squada One",
		"Stardos Stencil" => "Stardos Stencil",
		"Stint Ultra Condensed" => "Stint Ultra Condensed",
		"Stint Ultra Expanded" => "Stint Ultra Expanded",
		"Stoke" => "Stoke",
		"Sue Ellen Francisco" => "Sue Ellen Francisco",
		"Sunshiney" => "Sunshiney",
		"Supermercado One" => "Supermercado One",
		"Suwannaphum" => "Suwannaphum",
		"Swanky and Moo Moo" => "Swanky and Moo Moo",
		"Syncopate" => "Syncopate",
		"Tangerine" => "Tangerine",
		"Taprom" => "Taprom",
		"Telex" => "Telex",
		"Tenor Sans" => "Tenor Sans",
		"The Girl Next Door" => "The Girl Next Door",
		"Tienne" => "Tienne",
		"Tinos" => "Tinos",
		"Titan One" => "Titan One",
		"Trade Winds" => "Trade Winds",
		"Trocchi" => "Trocchi",
		"Trochut" => "Trochut",
		"Trykker" => "Trykker",
		"Tulpen One" => "Tulpen One",
		"Ubuntu" => "Ubuntu",
		"Ubuntu Condensed" => "Ubuntu Condensed",
		"Ubuntu Mono" => "Ubuntu Mono",
		"Ultra" => "Ultra",
		"Uncial Antiqua" => "Uncial Antiqua",
		"UnifrakturCook" => "UnifrakturCook",
		"UnifrakturMaguntia" => "UnifrakturMaguntia",
		"Unkempt" => "Unkempt",
		"Unlock" => "Unlock",
		"Unna" => "Unna",
		"VT323" => "VT323",
		"Varela" => "Varela",
		"Varela Round" => "Varela Round",
		"Vast Shadow" => "Vast Shadow",
		"Vibur" => "Vibur",
		"Vidaloka" => "Vidaloka",
		"Viga" => "Viga",
		"Voces" => "Voces",
		"Volkhov" => "Volkhov",
		"Vollkorn" => "Vollkorn",
		"Voltaire" => "Voltaire",
		"Waiting for the Sunrise" => "Waiting for the Sunrise",
		"Wallpoet" => "Wallpoet",
		"Walter Turncoat" => "Walter Turncoat",
		"Wellfleet" => "Wellfleet",
		"Wire One" => "Wire One",
		"Yanone Kaffeesatz" => "Yanone Kaffeesatz",
		"Yellowtail" => "Yellowtail",
		"Yeseva One" => "Yeseva One",
		"Yesteryear" => "Yesteryear",
		"Zeyada" => "Zeyada",
	);
	return apply_filters( 'ambition_google_fonts', $ambition_google_fonts );
}
/********************Register Panle ******************************************/
function ambition_customize_register($wp_customize){
	$wp_customize->add_panel( 'ambition_theme_options', array(
	'priority'       => 10,
	'capability'     => 'edit_theme_options',
	'title'          => __('Ambition Theme Options', 'ambition')
	));

/********************Ambition Pro Upgrade ******************************************/
	$wp_customize->add_section('ambition_upgrade', array(
		'title'					=> __('Ambition Pro Support', 'ambition'),
		'priority'				=> 1,
	));
	$wp_customize->add_setting( 'ambition_theme_settings[ambition_upgrade]', array(
		'default'				=> false,
		'capability'			=> 'edit_theme_options',
		'sanitize_callback'	=> 'wp_filter_nohtml_kses',
	));
	$wp_customize->add_control(
		new Ambition_Customize_Ambition_upgrade(
		$wp_customize,
		'ambition_upgrade',
			array(
				'label'					=> __('Ambition Upgrade','ambition'),
				'section'				=> 'ambition_upgrade',
				'settings'				=> 'ambition_theme_settings[ambition_upgrade]',
			)
		)
	);
	global $ambition_settings, $array_of_default_settings;
	$ambition_settings = wp_parse_args(  get_option( 'ambition_theme_settings', array() ),  ambition_get_option_defaults());
/********************Site Layout ******************************************/
	$wp_customize->add_section('ambition_design_layout', array(
		'title'					=> __('Site Layout', 'ambition'),
		'priority'				=> 101,
		'panel'					=>'ambition_theme_options'
	));
	$wp_customize->add_setting('ambition_theme_settings[design_layout]', array(
		'default'				=> 'on',
		'sanitize_callback'	=> 'prefix_sanitize_integer',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	));
	$wp_customize->add_control('ambition_design_layout', array(
		'section'				=> 'ambition_design_layout',
		'settings'				=> 'ambition_theme_settings[design_layout]',
		'type'					=> 'radio',
		'checked'				=> 'checked',
		'choices'				=> array(
			'on'					=> __('Wide Layout','ambition'),
			'off'					=> __('Narrow Layout','ambition'),
		),
	));
	$wp_customize->add_setting('ambition_theme_settings[ambition_responsive]', array(
		'default'				=> 'on',
		'sanitize_callback'	=> 'prefix_sanitize_integer',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	));
	$wp_customize->add_control('ambition_responsive', array(
		'section'				=> 'ambition_design_layout',
		'label'					=> __('Responsive Layout', 'ambition'),
		'settings'				=> 'ambition_theme_settings[ambition_responsive]',
		'type'					=> 'radio',
		'checked'				=> 'checked',
		'choices'				=> array(
			'on'					=> __('ON','ambition'),
			'off'					=> __('OFF','ambition'),
		),
	));
/********************Content Layout ******************************************/
	$wp_customize->add_section('ambition_content_layout', array(
		'title'					=> __('Content Layout', 'ambition'),
		'description'			=> __('Make sure that you have not set the layout from specific page','ambition'),
		'priority'				=> 102,
		'panel'					=>'ambition_theme_options'
	));
	$wp_customize->add_setting('ambition_theme_settings[content_layout]', array(
		'default'				=> 'right',
		'sanitize_callback'	=> 'prefix_sanitize_integer',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	));
	$wp_customize->add_control('ambition_content_layout', array(
		'section'				=> 'ambition_content_layout',
		'settings'				=> 'ambition_theme_settings[content_layout]',
		'type'					=> 'radio',
		'checked'				=> 'checked',
		'choices'				=> array(
			'right'				=> __('Right Sidebar','ambition'),
			'left'				=> __('Left Sidebar','ambition'),
			'nosidebar'			=> __('No Sidebar','ambition'),
			'fullwidth'			=> __('No Sidebar Full Width','ambition'),
		),
	));
/********************Site Title Background Image ******************************************/
	$wp_customize->add_section( 'ambition_site_title', array(
		'title'					=> __('Page Title Background Image', 'ambition'),
		'priority'				=> 103,
		'panel'					=>'ambition_theme_options'
	));
	
	$wp_customize->add_setting( 'ambition_theme_settings[site_title_setting]', array(
		'default'				=> 0,
		'sanitize_callback'	=> 'prefix_sanitize_integer',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	));
	$wp_customize->add_control( 'site_title_setting', array(
		'label'					=> __('Check to disable', 'ambition'),
		'section'				=> 'ambition_site_title',
		'settings'				=> 'ambition_theme_settings[site_title_setting]',
		'type'					=> 'checkbox',
	));
	$wp_customize->add_setting( 'ambition_theme_settings[img-upload-site-title]',array(
		'sanitize_callback'	=> 'esc_url_raw',
		'panel'					=>'ambition_theme_options',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	));
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
		$wp_customize,
			'img-upload-site-title',
			array(
			'section'			=> 'ambition_site_title',
			'settings'			=> 'ambition_theme_settings[img-upload-site-title]',
			)
		)
	);
/********************Custom Header ******************************************/
	$wp_customize->add_section('custom_header_setting', array(
		'title'					=> __('Header Options', 'ambition'),
		'priority'				=> 104,
		'panel'					=>'ambition_theme_options'
	));
	$wp_customize->add_setting( 'ambition_theme_settings[search_header_settings]', array(
		'default'				=> 0,
		'sanitize_callback'	=> 'prefix_sanitize_integer',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	));
	$wp_customize->add_control( 'custom_header_setting', array(
		'label'					=> __('Check to disable Search Form from Header', 'ambition'),
		'section'				=> 'custom_header_setting',
		'settings'				=> 'ambition_theme_settings[search_header_settings]',
		'type'					=> 'checkbox',
	));
	$wp_customize->add_setting( 'ambition_theme_settings[img-upload-header-logo]',array(
		'sanitize_callback'	=> 'esc_url_raw',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	));
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
		$wp_customize,
		'img-upload-header-logo',
			array(
				'label'				=> __('Header Logo','ambition'),
				'section'			=> 'custom_header_setting',
				'settings'			=> 'ambition_theme_settings[img-upload-header-logo]'
			)
		)
	);
	$wp_customize->add_setting('ambition_theme_settings[header_settings]', array(
		'default'				=> 'header_text',
		'sanitize_callback'	=> 'prefix_sanitize_integer',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	));
	$wp_customize->add_control('custom_header_display', array(
		'label'					=> __('Display', 'ambition'),
		'section'				=> 'custom_header_setting',
		'settings'				=> 'ambition_theme_settings[header_settings]',
		'type'					=> 'radio',
		'checked'				=> 'checked',
			'choices'			=> array(
			'header_text'		=> __('Header Text Only','ambition'),
			'header_logo'		=> __('Header Logo Only','ambition'),
			'disable_both'		=> __('Disable Both','ambition'),
			),
	));
/********************Fav Icon ******************************************/
	$wp_customize->add_section('fav_icon_setting', array(
		'title'					=> __('Favicon', 'ambition'),
		'priority'				=> 105,
		'panel'					=>'ambition_theme_options',
	));
	$wp_customize->add_setting( 'ambition_theme_settings[fav_settings]', array(
		'default'				=> 0,
		'sanitize_callback'	=> 'prefix_sanitize_integer',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	));
		$wp_customize->add_control( 'fav_icon_setting', array(
		'label'					=> __('Check to enable Favicon', 'ambition'),
		'section'				=> 'fav_icon_setting',
		'settings'				=> 'ambition_theme_settings[fav_settings]',
		'type'					=> 'checkbox',
	));
	$wp_customize->add_setting( 'ambition_theme_settings[img-upload-fav-icon]',array(
		'sanitize_callback'	=> 'esc_url_raw',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	));
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
		$wp_customize,
		'img-upload-fav-icon',
			array(
				'section'			=> 'fav_icon_setting',
				'settings'			=> 'ambition_theme_settings[img-upload-fav-icon]',
			)
		)
	);
/********************Web Icon ******************************************/
	$wp_customize->add_section('webclip_icon_setting', array(
		'title'					=> __('Web Clip Icon', 'ambition'),
		'priority'				=> 106,
		'panel'					=>'ambition_theme_options'
	));
	$wp_customize->add_setting( 'ambition_theme_settings[web_settings]', array(
		'default'				=> 0,
		'sanitize_callback'	=> 'prefix_sanitize_integer',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	));
	$wp_customize->add_control( 'webclip_icon_setting', array(
		'label'					=> __('Check to enable Web Clip Icon', 'ambition'),
		'section'				=> 'webclip_icon_setting',
		'settings'				=> 'ambition_theme_settings[web_settings]',
		'type'					=> 'checkbox',
	));
	$wp_customize->add_setting( 'ambition_theme_settings[img-upload-webclip-icon]',array(
		'sanitize_callback'=> 'esc_url_raw',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	));
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
		$wp_customize,
		'img-upload-webclip-icon',
			array(
				'section'			=> 'webclip_icon_setting',
				'settings'			=> 'ambition_theme_settings[img-upload-webclip-icon]'
			)
		)
	);
/********************Custom Css ******************************************/
	$wp_customize->add_section( 'ambition_custom_css', array(
		'title'					=> __('Custom CSS', 'ambition'),
		'description'			=> __('This CSS will overwrite the CSS of style.css file.','ambition'),
		'priority'				=> 107,
		'panel'					=>'ambition_theme_options'
	));
	$wp_customize->add_setting( 'ambition_theme_settings[css_settings]', array(
		'default'				=> '',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options',
		'sanitize_callback'	=> 'wp_filter_nohtml_kses'
	));
	$wp_customize->add_control( 'custom_css', array(
		'section'				=> 'ambition_custom_css',
				'settings'				=> 'ambition_theme_settings[css_settings]',
				'type'					=> 'textarea'
	));
/********************Home Page Blog Category Setting ******************************************/
	$wp_customize->add_section(
		'ambition_category_section', array(
		'title' 						=> __('Home Page Blog Category Setting','ambition'),
		'description'				=> __('Only posts that belong to the categories selected here will be displayed on the front page. ( You may select multiple categories by holding down the CTRL key. ) ','ambition'),
		'priority'					=> 109,
		'panel'					=>'ambition_theme_options'
	));
	$wp_customize->add_setting( 'ambition_theme_settings[ambition_categories]', array(
		'default'					=>array(),
		'sanitize_callback'		=> 'prefix_sanitize_integer',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control(
		new Ambition_Customize_Category_Control(
		$wp_customize,
			'ambition_categories',
			array(
			'label'					=> __('Front page posts categories','ambition'),
			'section'				=> 'ambition_category_section',
			'settings'				=> 'ambition_theme_settings[ambition_categories]',
			'type'					=> 'multiple-select',
			)
		)
	);
	$wp_customize->add_setting( 'ambition_theme_settings[disable_setting]', array(
		'default'					=> 0,
		'sanitize_callback'		=> 'prefix_sanitize_integer',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control( 'disable_setting', array(
		'label'						=> __('Check to Default Settings ( Uncheck to show effect on front page )', 'ambition'),
		'section'					=> 'ambition_category_section',
		'settings'					=> 'ambition_theme_settings[disable_setting]',
		'type'						=> 'checkbox',
	));
/********************Featured content layout setting and control ******************************************/
	$wp_customize->add_section( 'featured_content', array(
		'title'						=> __( 'Featured Content', 'ambition' ),
		'description'				=> sprintf( __( 'Use a <a href="%1$s">tag</a> to feature your posts. If no posts match the tag, <a href="%2$s">sticky posts</a> will be displayed instead.', 'ambition' ),
	esc_url( add_query_arg( 'tag', _x( 'featured', 'featured content default tag slug', 'ambition' ), admin_url( 'edit.php' ) ) ),
	admin_url( 'edit.php?show_sticky=1' )
	),
		'priority'					=> 140,
		'active_callback'			=> 'is_front_page',
			'panel'					=>'ambition_theme_options'
	) );
	$wp_customize->add_section( 'ambition_featured_content_setting', array(
		'title'					=> __('Featured Content Setting', 'ambition'),
		'priority'				=> 141,
		'panel'					=>'ambition_theme_options'
	));
	$wp_customize->add_setting( 'ambition_theme_settings[disable_slider]', array(
		'default'					=> 0,
		'sanitize_callback'		=> 'prefix_sanitize_integer',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control( 'ambition_disable_slider', array(
		'priority'					=>5,
		'label'						=> __('Check to disable Slider', 'ambition'),
		'section'					=> 'ambition_featured_content_setting',
		'settings'					=> 'ambition_theme_settings[disable_slider]',
		'type'						=> 'checkbox',
	));
	$wp_customize->add_setting('ambition_theme_settings[ambition_secondary_text]', array(
		'default'					=>'',
		'sanitize_callback'		=> 'sanitize_text_field',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_secondary_text', array(
		'priority'					=>9,
		'label'						=> __('Slider Secondary Button Text', 'ambition'),
		'section'					=> 'featured_content',
		'settings'					=> 'ambition_theme_settings[ambition_secondary_text]',
		'type'						=> 'text',
	));
	$wp_customize->add_setting('ambition_theme_settings[ambition_secondary_url]', array(
		'default'					=>'',
		'sanitize_callback'		=> 'esc_url_raw',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_secondary_url', array(
		'priority'					=>10,
		'label'						=> __('Slider Secondary Url', 'ambition'),
		'section'					=> 'featured_content',
		'settings'					=> 'ambition_theme_settings[ambition_secondary_url]',
		'type'						=> 'text',
	));
	$wp_customize->add_setting('ambition_theme_settings[ambition_slider_content]', array(
		'default'					=> 'on',
		'sanitize_callback'		=> 'prefix_sanitize_integer',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_slider_content', array(
		'label'						=> __('Slider Content', 'ambition'),
		'section'					=> 'ambition_featured_content_setting',
		'settings'					=> 'ambition_theme_settings[ambition_slider_content]',
		'type'						=> 'radio',
		'checked'					=> 'checked',
		'choices'					=> array(
			'on'						=> __('ON','ambition'),
			'off'						=> __('OFF','ambition'),
		),
	));
	$wp_customize->add_setting('ambition_theme_settings[ambition_transition_effect]', array(
		'default'					=> 'fade',
		'sanitize_callback'		=> 'ambition_sanitize_effect',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_transition_effect', array(
		'label'						=> __('Transition Effect', 'ambition'),
		'section'					=> 'ambition_featured_content_setting',
		'settings'					=> 'ambition_theme_settings[ambition_transition_effect]',
		'type'						=> 'select',
		'choices'					=> array(
			'fade'					=> __('Fade','ambition'),
			'wipe'					=> __('Wipe','ambition'),
			'scrollUp'				=> __('Scroll Up','ambition' ),
			'scrollDown'			=> __('Scroll Down','ambition' ),
			'scrollLeft'			=> __('Scroll Left','ambition' ),
			'scrollRight'			=> __('Scroll Right','ambition' ),
			'blindX'					=> __('Blind X','ambition' ),
			'blindY'					=> __('Blind Y','ambition' ),
			'blindZ'					=> __('Blind Z','ambition' ),
			'cover'					=> __('Cover','ambition' ),
			'shuffle'				=> __('Shuffle','ambition' ),
		),
	));
	$wp_customize->add_setting('ambition_theme_settings[ambition_transition_delay]', array(
		'default'					=> '4',
		'sanitize_callback'		=> 'ambition_sanitize_delay_transition',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_transition_delay', array(
		'label'						=> __('Transition Delay', 'ambition'),
		'section'					=> 'ambition_featured_content_setting',
		'settings'					=> 'ambition_theme_settings[ambition_transition_delay]',
		'type'						=> 'text',
	) );
	$wp_customize->add_setting('ambition_theme_settings[ambition_transition_duration]', array(
		'default'					=> '1',
		'sanitize_callback'		=> 'ambition_sanitize_delay_transition',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_transition_duration', array(
		'label'						=> __('Transition Duration', 'ambition'),
		'section'					=> 'ambition_featured_content_setting',
		'settings'					=> 'ambition_theme_settings[ambition_transition_duration]',
		'type'						=> 'text',
	) );
	$wp_customize->add_setting('ambition_theme_settings[ambition_slider_type]', array(
		'default'					=> 'defaults',
		'sanitize_callback'		=> 'prefix_sanitize_integer',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_slider_type', array(
		'priority'					=> 4,
		'label'						=> __('Slider Type', 'ambition'),
		'description'				=> __('If you select Page/Post Slider, Image Slider OR Revolution Slider below please refresh the page manually to have the individual settings.','ambition'),
		'section'					=> 'ambition_featured_content_setting',
		'settings'					=> 'ambition_theme_settings[ambition_slider_type]',
		'type'						=> 'radio',
		'checked'					=> 'checked',
		'choices'					=> array(
			'defaults'				=> __('Default Slider','ambition'),
			'page'					=> __('Page/Post Slider','ambition'),
			'image'					=> __('Image Slider','ambition'),
			'revolution'			=> __('Revolution Slider','ambition'),
		),
	));
	$wp_customize->add_setting('ambition_theme_settings[ambition_slider_status]', array(
		'default'					=> 'homepage',
		'sanitize_callback'		=> 'prefix_sanitize_integer',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_slider_status', array(
		'label'						=> __('Slider Status', 'ambition'),
		'priority'					=> 6,
		'description'				=>__('Note: The below mentioned options are only effective with the Featured Post/Page Slider, Default Slider and Featured Image Slider and not with the Revolution Slider', 'ambition'),
		'section'					=> 'ambition_featured_content_setting',
		'settings'					=> 'ambition_theme_settings[ambition_slider_status]',
		'type'						=> 'radio',
		'checked'					=> 'checked',
		'choices'					=> array(
			'homepage'				=> __('Home Page','ambition'),
			'allpage'					=> __('Enable on all Page','ambition')
		),
	));
	$wp_customize->add_setting('ambition_theme_settings[ambition_slider_textposition]', array(
		'default'					=> 'middle',
		'sanitize_callback'		=> 'prefix_sanitize_integer',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_slider_textposition', array(
		'label'						=> __('Featured Text Position', 'ambition'),
		'section'					=> 'ambition_featured_content_setting',
		'type'						=> 'radio',
		'settings'					=> 'ambition_theme_settings[ambition_slider_textposition]',
		'checked'					=> 'checked',
		'choices'					=> array(
			'left'					=> __('Left Align','ambition'),
			'middle'					=> __('Middle Align','ambition'),
			'right'					=> __('Right Align','ambition')
		),
	));
	$wp_customize->add_setting('ambition_theme_settings[ambition_slide_no]', array(
		'default'					=> '4',
		'sanitize_callback'		=> 'ambition_sanitize_delay_transition',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_slide_no', array(
		'label'						=> __('No of Slides', 'ambition'),
		'section'					=> 'ambition_featured_content_setting',
		'settings'					=> 'ambition_theme_settings[ambition_slide_no]',
		'type'						=> 'text',
	) );

	if ( is_plugin_active( 'revslider/revslider.php' ) && $ambition_settings['ambition_slider_type'] == 'revolution' ) {
/******************** Revolution Slider Options *********************************************/
	$wp_customize->add_section( 'ambition_revolution_options', array(
		'title' 						=> __('Revolution','ambition'),
		'priority'					=> 150,
		'panel'					=>'ambition_theme_options'
	));
	$wp_customize->add_setting('ambition_theme_settings[ambition_revolution_options]', array(
		'default'					=> '',
		'sanitize_callback'		=> 'esc_attr',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control(
		new Ambition_Revolution_Slider_Control(
		$wp_customize,
		'ambition_revolution_options',
			array(
				'label'				=> __('Revolution Slider','ambition'),
				'section'			=> 'ambition_revolution_options',
				'settings'			=> 'ambition_theme_settings[ambition_revolution_options]'
			)
		)
	);
	$wp_customize->add_setting('ambition_theme_settings[ambition_display_homepage]', array(
		'default'					=>0,
		'sanitize_callback'		=>'prefix_sanitize_integer',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control( 'ambition_display_homepage', array(
		'priority'					=>20,
		'label'						=> __('Check to Display in Home Page', 'ambition'),
		'section'					=> 'ambition_revolution_options',
		'settings'					=> 'ambition_theme_settings[ambition_display_homepage]',
		'type'						=> 'checkbox',
	));
	$wp_customize->add_setting('ambition_theme_settings[ambition_revolution_pageid]', array(
		'default'					=> '',
		'sanitize_callback'		=> 'esc_attr',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_revolution_pageid', array(
		'priority'					=>30,
		'label'						=> __('Enter Pages ID', 'ambition'),
		'description'				=> __('Example: 2,10 Enter the ID of pages in which you want to display this slider on ','ambition'),
		'section'					=> 'ambition_revolution_options',
		'type'						=> 'text',
		'settings'					=> 'ambition_theme_settings[ambition_revolution_pageid]'
	) );
	}
	if ( $ambition_settings['ambition_slider_type'] == 'page' ) {
		/******************** Page Post Options *********************************************/
		$wp_customize->add_section( 'ambition_page_post_options', array(
			'title' 						=> __('Page/Post Slider','ambition'),
			'priority'					=> 153,
			'panel'					=>'ambition_theme_options'
		));
		$wp_customize->add_setting('ambition_theme_settings[exclude_slider_post]', array(
			'default'					=>0,
			'sanitize_callback'		=>'prefix_sanitize_integer',
			'type' 						=> 'option',
			'capability' 				=> 'manage_options'
		));
		$wp_customize->add_control( 'exclude_slider_post', array(
			'priority'					=>20,
			'label'						=> __('Exclude Slider Post', 'ambition'),
			'section'					=> 'ambition_page_post_options',
			'settings'					=> 'ambition_theme_settings[exclude_slider_post]',
			'type'						=> 'checkbox',
		));
		// featured post/page
		for ( $i=1; $i <= $ambition_settings['ambition_slide_no'] ; $i++ ) {
			$wp_customize->add_setting('ambition_theme_settings[featured_post_page_slider_'. $i .']', array(
				'default'					=>'',
				'sanitize_callback'		=>'prefix_sanitize_integer',
				'type' 						=> 'option',
				'capability' 				=> 'manage_options'
			));
			$wp_customize->add_control( 'featured_post_page_slider_'. $i .'', array(
				'priority'					=> 25 . $i,
				'label'						=> __(' Featured Slider Post/Page #', 'ambition') . ' ' . $i ,
				'section'					=> 'ambition_page_post_options',
				'settings'					=> 'ambition_theme_settings[featured_post_page_slider_'. $i .']',
				'type'						=> 'text',
			));
		}
	}
	if ( $ambition_settings['ambition_slider_type'] == 'image' ) {
		/******************** Image Slider Options *********************************************/
		$wp_customize->add_section( 'ambition_image_options', array(
			'title' 						=> __('Image Slider','ambition'),
			'priority'					=> 154,
			'panel'					=>'ambition_theme_options'
		));
		// featured post/page
		for ( $i=1; $i <= $ambition_settings['ambition_slide_no'] ; $i++ ) {
			$wp_customize->add_setting('ambition_theme_settings[featured_image_slider_'. $i .']', array(
				'default'					=>'',
				'sanitize_callback'		=>'esc_url_raw',
				'type' 						=> 'option',
				'capability' 				=> 'manage_options'
			));
			$wp_customize->add_control(
				new WP_Customize_Image_Control(
				$wp_customize,
					'featured_image_slider_'. $i,
					array(
					'priority'					=> 25 . $i,
					'label'				=> ' Image Slider #' . $i,
					'section'			=> 'ambition_image_options',
					'settings'			=> 'ambition_theme_settings[featured_image_slider_'. $i .']',
					)
				)
			);
			$wp_customize->add_setting('ambition_theme_settings[redirect_link'. $i .']', array(
				'default'					=>'',
				'sanitize_callback'		=>'esc_url_raw',
				'type' 						=> 'option',
				'capability' 				=> 'manage_options'
			));
			$wp_customize->add_control( 'redirect_link'. $i .'', array(
				'priority'					=> 25 . $i,
				'label'						=> __(' Redirect Link #', 'ambition') . ' ' . $i ,
				'section'					=> 'ambition_image_options',
				'settings'					=> 'ambition_theme_settings[redirect_link'. $i .']',
				'type'						=> 'text',
			));
			$wp_customize->add_setting('ambition_theme_settings[link_text'. $i .']', array(
				'default'					=>'',
				'sanitize_callback'		=>'sanitize_text_field',
				'type' 						=> 'option',
				'capability' 				=> 'manage_options'
			));
			$wp_customize->add_control( 'link_text'. $i .'', array(
				'priority'					=> 25 . $i,
				'label'						=> __(' Link Text #', 'ambition') . ' ' . $i ,
				'section'					=> 'ambition_image_options',
				'settings'					=> 'ambition_theme_settings[link_text'. $i .']',
				'type'						=> 'text',
			));
			$wp_customize->add_setting('ambition_theme_settings[image_title'. $i .']', array(
				'default'					=>'',
				'sanitize_callback'		=>'sanitize_text_field',
				'type' 						=> 'option',
				'capability' 				=> 'manage_options'
			));
			$wp_customize->add_control( 'image_title'. $i .'', array(
				'priority'					=> 25 . $i,
				'label'						=> __(' Image Title #', 'ambition') . ' ' . $i ,
				'section'					=> 'ambition_image_options',
				'settings'					=> 'ambition_theme_settings[image_title'. $i .']',
				'type'						=> 'text',
			));
			$wp_customize->add_setting('ambition_theme_settings[image_description'. $i .']', array(
				'default'					=>'',
				'sanitize_callback'		=>'esc_textarea',
				'type' 						=> 'option',
				'capability' 				=> 'manage_options'
			));
			$wp_customize->add_control( 'image_description'. $i .'', array(
				'priority'					=> 25 . $i,
				'label'						=> __(' Description #', 'ambition') . ' ' . $i ,
				'section'					=> 'ambition_image_options',
				'settings'					=> 'ambition_theme_settings[image_description'. $i .']',
				'type'						=> 'textarea',
			));
		}
	}

/******************** Excerpt Options *********************************************/
	$wp_customize->add_section( 'ambition_excerpt_section', array(
		'title' 						=> __('Excerpt Options','ambition'),
		'priority'					=> 155,
		'panel'						=>'ambition_theme_options'
	));
	$wp_customize->add_setting('ambition_theme_settings[ambition_excerpt_length]', array(
		'default'					=> '50',
		'sanitize_callback'		=> 'ambition_sanatize_excerpt_length',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_excerpt_length', array(
		'label'						=> __('Excerpt Length', 'ambition'),
		'section'					=> 'ambition_excerpt_section',
		'type'						=> 'text',
		'settings'					=> 'ambition_theme_settings[ambition_excerpt_length]'
	) );
	$wp_customize->add_setting('ambition_theme_settings[ambition_excerpt_text]', array(
		'default'					=> 'Read more',
		'sanitize_callback'		=> 'sanitize_text_field',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_excerpt_text', array(
		'label'						=> __('Post Excerpt More Text', 'ambition'),
		'section'					=> 'ambition_excerpt_section',
		'type'						=> 'text',
		'settings'					=>'ambition_theme_settings[ambition_excerpt_text]'
	) );
/******************** Footer Options *********************************************/
	$wp_customize->add_section( 'ambition_footer_panel', array(
		'title' 						=> __('Edit Footer','ambition'),
		'priority'					=> 160,
		'panel'					=>'ambition_theme_options'
	));
	$wp_customize->add_setting('ambition_theme_settings[ambition_fott_edit]', array(
		'default'					=> 'Copyright &copy;'.ambition_the_year().' ' .ambition_site_link().' | '.ambition_themehorse_link().' | ' .ambition_wp_link(),
		'sanitize_callback'		=> 'footer_edit',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_fott_edit', array(
		'section'					=> 'ambition_footer_panel',
		'type'						=> 'textarea',
		'settings'					=> 'ambition_theme_settings[ambition_fott_edit]'
	) );
/********************Contact Info Bar ******************************************/
	$wp_customize->add_section('ambition_contact_info_bar',array(
		'title'						=>__('Contact Info Bar', 'ambition'),
		'priority'					=>170,
		'panel'					=>'ambition_theme_options'
	));
	$wp_customize->add_setting('ambition_theme_settings[contact_info_bar_top]', array(
		'default'					=>0,
		'sanitize_callback'		=>'prefix_sanitize_integer',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control( 'contact_info_bar_top', array(
		'priority'					=>10,
		'label'						=> __('Check to disable Top Infobar', 'ambition'),
		'section'					=> 'ambition_contact_info_bar',
		'settings'					=> 'ambition_theme_settings[contact_info_bar_top]',
		'type'						=> 'checkbox',
	));
	$wp_customize->add_setting('ambition_theme_settings[contact_info_bar_buttom]', array(
		'default'					=>0,
		'sanitize_callback'		=>'prefix_sanitize_integer',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control( 'contact_info_bar_buttom', array(
		'priority'					=>20,
		'label'						=> __('Check to disable Buttom Infobar', 'ambition'),
		'section'					=> 'ambition_contact_info_bar',
		'settings'					=> 'ambition_theme_settings[contact_info_bar_buttom]',
		'type'						=> 'checkbox',
	));
	$wp_customize->add_setting('ambition_theme_settings[ambition_phone_no]', array(
		'default'					=>'',
		'sanitize_callback'		=> 'prefix_sanitize_phone',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('contact_info_bar', array(
		'priority'					=>30,
		'label'						=> __('Enter Phone Number Only', 'ambition'),
		'section'					=> 'ambition_contact_info_bar',
		'settings'					=> 'ambition_theme_settings[ambition_phone_no]',
		'type'						=> 'text',
	));
	$wp_customize->add_setting('ambition_theme_settings[ambition_email_id]', array(
		'default'					=>'',
		'sanitize_callback'		=> 'sanitize_email',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_email_id', array(
		'priority'					=>40,
		'label'						=> __('Email Id Only', 'ambition'),
		'section'					=> 'ambition_contact_info_bar',
		'settings'					=> 'ambition_theme_settings[ambition_email_id]',
		'type'						=> 'text',
	));
	$wp_customize->add_setting('ambition_theme_settings[ambition_location]', array(
		'default'					=>'',
		'sanitize_callback'		=> 'sanitize_text_field',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_location', array(
		'priority'					=>50,
		'label'						=> __('Location Only', 'ambition'),
		'section'					=> 'ambition_contact_info_bar',
		'settings'					=> 'ambition_theme_settings[ambition_location]',
		'type'						=> 'text',
	));
	$wp_customize->add_setting('ambition_theme_settings[ambition_location_url]', array(
		'default'					=>'',
		'sanitize_callback'		=> 'esc_url_raw',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_location_url', array(
		'priority'					=>60,
		'label'						=> __('Location Url Only', 'ambition'),
		'section'					=> 'ambition_contact_info_bar',
		'settings'					=> 'ambition_theme_settings[ambition_location_url]',
		'type'						=> 'text',
	));
	$wp_customize->add_setting('ambition_theme_settings[ambition_skype]', array(
		'default'					=>'',
		'sanitize_callback'		=> 'sanitize_text_field',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_skype', array(
		'priority'					=>70,
		'label'						=> __('Skype Id Only', 'ambition'),
		'section'					=> 'ambition_contact_info_bar',
		'settings'					=> 'ambition_theme_settings[ambition_skype]',
		'type'						=> 'text',
	));
	
/********************* Color Skin **********************************************/
	$wp_customize->add_section( 'ambition_color_options', array(
		'title' 						=> __('Color Skin','ambition'),
		'priority'					=> 200,
		'panel'					=>'ambition_theme_options'
	));
	$color_scheme = ambition_get_color_scheme();
	// Add color scheme setting and control.
	$wp_customize->add_setting( 'color_scheme', array(
		'default'           => 'lightgreen',
		'sanitize_callback' => 'ambition_sanitize_color_scheme',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );

	$wp_customize->add_control( 'color_scheme', array(
		'label'    => __( 'Color Skin', 'ambition' ),
		'section'  => 'ambition_color_options',
		'type'     => 'select',
		'choices'  => ambition_get_color_scheme_choices(),
		'priority' => 1,
	) );

	$wp_customize->add_setting( 'ambition_links_color', array(
		'default'				=> $color_scheme[3],
		'sanitize_callback'	=> 'sanitize_hex_color',
		'transport'				=> 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ambition_links_color', array(
		'label'       => __( 'Links', 'ambition' ),
		'section'     => 'ambition_color_options',
	) ) );

	$wp_customize->add_setting( 'ambition_navigation_color', array(
		'default'           => $color_scheme[3],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ambition_navigation_color', array(
		'label'       => __( 'Navigation', 'ambition' ),
		'section'     => 'ambition_color_options',
	) ) );

	$wp_customize->add_setting( 'ambition_buttons', array(
		'default'           => $color_scheme[3],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ambition_buttons', array(
		'label'       => __( 'Buttons and Custom Tag Cloud Widget', 'ambition' ),
		'section'     => 'ambition_color_options',
	) ) );

	$wp_customize->add_setting( 'ambition_promotionalbar', array(
		'default'           => $color_scheme[3],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ambition_promotionalbar', array(
		'label'       => __( 'Promotional Bar/ Page Title', 'ambition' ),
		'section'     => 'ambition_color_options',
	) ) );

	/********************* background color options **********************************************/
	$wp_customize->add_section( 'ambition_background_color_options', array(
		'title' 						=> __('Background Color','ambition'),
		'priority'					=> 210,
		'panel'					=>'ambition_theme_options'
	));
	$wp_customize->add_setting( 'top_contact_infobar_background', array(
		'default'           => '#f2f2f2',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_contact_infobar_background', array(
		'label'       => __( 'Top Contact Info Bar', 'ambition' ),
		'section'     => 'ambition_background_color_options',
	) ) );

	$wp_customize->add_setting( 'site_title_logo_background', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_title_logo_background', array(
		'label'       => __( 'Site Title/ Logo', 'ambition' ),
		'section'     => 'ambition_background_color_options',
	) ) );

	$wp_customize->add_setting( 'site_title_navigation_background', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_title_navigation_background', array(
		'label'       => __( 'Navigation Dropdown ', 'ambition' ),
		'section'     => 'ambition_background_color_options',
	) ) );

	$wp_customize->add_setting( 'main_content_background', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_content_background', array(
		'label'       => __( 'Main Content', 'ambition' ),
		'section'     => 'ambition_background_color_options',
	) ) );
	$wp_customize->add_setting( 'featured_pg_background', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'featured_pg_background', array(
		'label'       => __( ' Widget Featured Page', 'ambition' ),
		'section'     => 'ambition_background_color_options',
	) ) );

	$wp_customize->add_setting( 'widgets_featured_recent_work_background', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'widgets_featured_recent_work_background', array(
		'label'       => __( 'Widget Featured Recent Work', 'ambition' ),
		'section'     => 'ambition_background_color_options',
	) ) );

	$wp_customize->add_setting( 'services_background', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'services_background', array(
		'label'       => __( 'Widget Services', 'ambition' ),
		'section'     => 'ambition_background_color_options',
	) ) );

	$wp_customize->add_setting( 'testimonial_background', array(
		'default'           => '#f2f2f2',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'testimonial_background', array(
		'label'       => __( 'Widget Testimonial', 'ambition' ),
		'section'     => 'ambition_background_color_options',
	) ) );

	$wp_customize->add_setting( 'wid_clien_pro_background', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wid_clien_pro_background', array(
		'label'       => __( 'Widget Featured Clients/ Products', 'ambition' ),
		'section'     => 'ambition_background_color_options',
	) ) );

	$wp_customize->add_setting( 'footer_widget_section_background', array(
		'default'           => '#262626',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_widget_section_background', array(
		'label'       => __( 'Footer Widget Section', 'ambition' ),
		'section'     => 'ambition_background_color_options',
	) ) );
	$wp_customize->add_setting( 'bottom_contact_infobar_background', array(
		'default'           => '#202020',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bottom_contact_infobar_background', array(
		'label'       => __( 'Bottom Contact Info Bar', 'ambition' ),
		'section'     => 'ambition_background_color_options',
	) ) );
		$wp_customize->add_setting( 'site_info_background', array(
		'default'           => '#1a1a1a',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_info_background', array(
		'label'       => __( 'Site Info', 'ambition' ),
		'section'     => 'ambition_background_color_options',
	) ) );
	$wp_customize->add_setting( 'blockquote_sticky_background', array(
		'default'           => '#f2f2f2',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'blockquote_sticky_background', array(
		'label'       => __( 'Blockquote and Sticky Post', 'ambition' ),
		'section'     => 'ambition_background_color_options',
	) ) );
	$wp_customize->add_setting( 'form_input_textfield_background', array(
		'default'           => '#f9f9f9',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'form_input_textfield_background', array(
		'label'       => __( 'Form Input/ Textarea Fields', 'ambition' ),
		'section'     => 'ambition_background_color_options',
	) ) );
	/******************** Typography Options *********************************************/
	// Font Family
	$wp_customize->add_section( 'ambition_font_family', array(
		'title' 						=> __('Font Family','ambition'),
		'priority'					=> 300,
		'panel'						=>'ambition_theme_options'
	));
	$wp_customize->add_setting('ambition_theme_settings[ambition_fontfamily_content]', array(
		'default'					=> 'Lato',
		'sanitize_callback'		=> 'prefix_sanatize_fontfamily',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_fontfamily_content', array( /* Content */
		'label'						=> __( 'Content', 'ambition' ),
		'section'					=> 'ambition_font_family',
		'type'						=> 'select',
		'priority'					=> 310,
		'settings'					=> 'ambition_theme_settings[ambition_fontfamily_content]',
		'choices'					=> ambition_google_fonts()
	) );
	$wp_customize->add_setting('ambition_theme_settings[ambition_fontfamily_navigation]', array(
		'default'					=> 'Lato',
		'sanitize_callback'		=> 'prefix_sanatize_fontfamily',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_fontfamily_navigation', array( /* Navigation */
		'label'						=> __( 'Navigation', 'ambition' ),
		'section'					=> 'ambition_font_family',
		'type'						=> 'select',
		'priority'					=> 20,
		'settings'					=> 'ambition_theme_settings[ambition_fontfamily_navigation]',
		'choices'					=> ambition_google_fonts()
	) );
	$wp_customize->add_setting('ambition_theme_settings[ambition_fontfamily_titles_heading]', array(
		'default'					=> 'Lato',
		'sanitize_callback'		=> 'prefix_sanatize_fontfamily',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_fontfamily_titles_heading', array( /* All Headings/ Titles */
		'label'						=> __( 'All Headings/ Titles', 'ambition' ),
		'section'					=> 'ambition_font_family',
		'type'						=> 'select',
		'priority'					=> 30,
		'settings'					=> 'ambition_theme_settings[ambition_fontfamily_titles_heading]',
		'choices'					=> ambition_google_fonts()
	) );
	//Font size
	$wp_customize->add_section( 'ambition_fontsize', array(
		'title' 						=> __('Font Size','ambition'),
		'priority'					=> 320,
		'panel'						=>'ambition_theme_options',
	));
	$wp_customize->add_setting('ambition_theme_settings[ambition_content_size]', array(
		'default'					=> '16',
		'sanitize_callback'		=> 'prefix_sanatize_integer',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_content_size', array( /* Content */
		'label'						=> __( 'Content', 'ambition' ),
		'section'					=> 'ambition_fontsize',
		'type'						=> 'select',
		'priority'					=> 10,
		'settings'					=> 'ambition_theme_settings[ambition_content_size]',
		'choices'				=> array(
			'14'					=> __('14 px','ambition'),
			'15'					=> __('15 px','ambition'),
			'16'					=> __('16 px','ambition'),
			'17'					=> __('17 px','ambition'),
			'18'					=> __('18 px','ambition'),
		),
	) );
	$wp_customize->add_setting('ambition_theme_settings[ambition_button_size]', array(
		'default'					=> '16',
		'sanitize_callback'		=> 'prefix_sanatize_integer',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_button_size', array( /* Buttons */
		'label'						=> __( 'Buttons', 'ambition' ),
		'section'					=> 'ambition_fontsize',
		'type'						=> 'select',
		'settings'					=> 'ambition_theme_settings[ambition_button_size]',
		'priority'					=> 20,
		'choices'				=> array(
			'14'					=> __('14 px','ambition'),
			'15'					=> __('15 px','ambition'),
			'16'					=> __('16 px','ambition'),
			'17'					=> __('17 px','ambition'),
			'18'					=> __('18 px','ambition'),
		),
	) );
	$wp_customize->add_setting('ambition_theme_settings[ambition_topinfobar_size]', array(
		'default'					=> '14',
		'sanitize_callback'		=> 'prefix_sanatize_integer',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_topinfobar_size', array( /* Top Info Bar */
		'label'						=> __( 'Top Info Bar', 'ambition' ),
		'section'					=> 'ambition_fontsize',
		'type'						=> 'select',
		'settings'					=> 'ambition_theme_settings[ambition_topinfobar_size]',
		'priority'					=> 30,
		'choices'				=> array(
			'12'					=> __('12 px','ambition'),
			'13'					=> __('13 px','ambition'),
			'14'					=> __('14 px','ambition'),
			'15'					=> __('15 px','ambition'),
			'16'					=> __('16 px','ambition'),
		),
	) );
	$wp_customize->add_setting('ambition_theme_settings[ambition_sitetitle_size]', array(
		'default'					=> '25',
		'sanitize_callback'		=> 'prefix_sanatize_integer',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_sitetitle_size', array( /* Site Title */
		'label'						=> __( 'Site Title', 'ambition' ),
		'section'					=> 'ambition_fontsize',
		'type'						=> 'select',
		'settings'					=> 'ambition_theme_settings[ambition_sitetitle_size]',
		'priority'					=> 40,
		'choices'				=> array(
			'23'					=> __('23 px','ambition'),
			'25'					=> __('25 px','ambition'),
			'27'					=> __('27 px','ambition'),
			'29'					=> __('29 px','ambition'),
			'31'					=> __('31 px','ambition'),
		),
	) );
	$wp_customize->add_setting('ambition_theme_settings[ambition_navigation_size]', array(
		'default'					=> '13',
		'sanitize_callback'		=> 'prefix_sanatize_integer',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_navigation_size', array( /* Navigation */
		'label'						=> __( 'Navigation', 'ambition' ),
		'section'					=> 'ambition_fontsize',
		'type'						=> 'select',
		'settings'					=> 'ambition_theme_settings[ambition_navigation_size]',
		'priority'					=> 50,
		'choices'				=> array(
			'12'					=> __('12 px','ambition'),
			'13'					=> __('13 px','ambition'),
			'14'					=> __('14 px','ambition'),
			'15'					=> __('15 px','ambition'),
			'16'					=> __('16 px','ambition'),
		),
	) );
	$wp_customize->add_setting('ambition_theme_settings[ambition_featured_slidertitle_size]', array(
		'default'					=> '60',
		'sanitize_callback'		=> 'prefix_sanatize_integer',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_featured_slidertitle_size', array( /* Featured Slider Title */
		'label'						=> __( 'Featured Slider Title', 'ambition' ),
		'section'					=> 'ambition_fontsize',
		'type'						=> 'select',
		'settings'					=> 'ambition_theme_settings[ambition_featured_slidertitle_size]',
		'priority'					=> 60,
		'choices'				=> array(
			'52'					=> __('52 px','ambition'),
			'54'					=> __('54 px','ambition'),
			'56'					=> __('56 px','ambition'),
			'58'					=> __('58 px','ambition'),
			'60'					=> __('60 px','ambition'),
		),
	) );
	$wp_customize->add_setting('ambition_theme_settings[ambition_slider_content_fontsize]', array(
		'default'					=> '20',
		'sanitize_callback'		=> 'prefix_sanatize_integer',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_slider_content_fontsize', array( /* Featured Slider Content */
		'label'						=> __( 'Featured Slider Content', 'ambition' ),
		'section'					=> 'ambition_fontsize',
		'type'						=> 'select',
		'settings'					=> 'ambition_theme_settings[ambition_slider_content_fontsize]',
		'priority'					=> 70,
		'choices'				=> array(
			'18'					=> __('18 px','ambition'),
			'20'					=> __('20 px','ambition'),
			'22'					=> __('22 px','ambition'),
			'24'					=> __('24 px','ambition'),
			'26'					=> __('26 px','ambition'),
		),
	) );
	$wp_customize->add_setting('ambition_theme_settings[ambition_featured_slider_button_size]', array(
		'default'					=> '16',
		'sanitize_callback'		=> 'prefix_sanatize_integer',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_featured_slider_button_size', array( /* Featured Slider Button */
		'label'						=> __( 'Featured Slider Button', 'ambition' ),
		'section'					=> 'ambition_fontsize',
		'type'						=> 'select',
		'settings'					=> 'ambition_theme_settings[ambition_featured_slider_button_size]',
		'priority'					=> 80,
		'choices'				=> array(
			'15'					=> __('15 px','ambition'),
			'16'					=> __('16 px','ambition'),
			'17'					=> __('17 px','ambition'),
			'18'					=> __('18 px','ambition'),
			'19'					=> __('19 px','ambition'),
		),
	) );
	$wp_customize->add_setting('ambition_theme_settings[ambition_alltitle_size]', array(
		'default'					=> '30',
		'sanitize_callback'		=> 'prefix_sanatize_integer',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_alltitle_size', array( /* Business/ Our Team/ Testimonial/ Service Template Widget Titles, Post Title */
		'label'						=> __( 'Business/ Our Team/ Testimonial/ Service Template Widget Titles, Post Title', 'ambition' ),
		'section'					=> 'ambition_fontsize',
		'type'						=> 'select',
		'priority'					=> 90,
		'settings'					=> 'ambition_theme_settings[ambition_alltitle_size]',
		'choices'				=> array(
			'28'					=> __('28 px','ambition'),
			'30'					=> __('30 px','ambition'),
			'32'					=> __('32 px','ambition'),
			'34'					=> __('34 px','ambition'),
			'36'					=> __('36 px','ambition'),
		),
	) );
	$wp_customize->add_setting('ambition_theme_settings[ambition_widget_sec_content_size]', array(
		'default'					=> '20',
		'sanitize_callback'		=> 'prefix_sanatize_integer',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_widget_sec_content_size', array( /* Featured Page Widget Secondary Content */
		'label'						=> __( 'Featured Page Widget Secondary Content', 'ambition' ),
		'section'					=> 'ambition_fontsize',
		'type'						=> 'select',
		'priority'					=> 100,
		'settings'					=> 'ambition_theme_settings[ambition_widget_sec_content_size]',
		'choices'				=> array(
			'18'					=> __('18 px','ambition'),
			'20'					=> __('20 px','ambition'),
			'22'					=> __('22 px','ambition'),
			'24'					=> __('24 px','ambition'),
			'26'					=> __('26 px','ambition'),
		),
	) );
	$wp_customize->add_setting('ambition_theme_settings[ambition_ser_recent_head_titles_size]', array(
		'default'					=> '25',
		'sanitize_callback'		=> 'prefix_sanatize_integer',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_ser_recent_head_titles_size', array( /* Services Item/ Featured Recent Work Item/ Our Team Name/ Table Heading Titles */
		'label'						=> __( 'Services Item/ Featured Recent Work Item/ Our Team Name/ Table Heading Titles', 'ambition' ),
		'section'					=> 'ambition_fontsize',
		'type'						=> 'select',
		'settings'					=> 'ambition_theme_settings[ambition_ser_recent_head_titles_size]',
		'priority'					=> 110,
		'choices'				=> array(
			'21'					=> __('21 px','ambition'),
			'23'					=> __('23 px','ambition'),
			'25'					=> __('25 px','ambition'),
			'27'					=> __('27 px','ambition'),
			'29'					=> __('29 px','ambition'),
		),
	) );
	$wp_customize->add_setting('ambition_theme_settings[ambition_pagetitle_size]', array(
		'default'					=> '30',
		'sanitize_callback'		=> 'prefix_sanatize_integer',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_pagetitle_size', array( /* Page Title */ 
		'label'						=> __( 'Page Title', 'ambition' ),
		'section'					=> 'ambition_fontsize',
		'type'						=> 'select',
		'priority'					=> 120,
		'settings'					=> 'ambition_theme_settings[ambition_pagetitle_size]',
		'choices'				=> array(
			'28'					=> __('28 px','ambition'),
			'30'					=> __('30 px','ambition'),
			'32'					=> __('32 px','ambition'),
			'34'					=> __('34 px','ambition'),
			'36'					=> __('36 px','ambition'),
		),
	) );
	$wp_customize->add_setting('ambition_theme_settings[ambition_breadcrumbs_size]', array(
		'default'					=> '14',
		'sanitize_callback'		=> 'prefix_sanatize_integer',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_breadcrumbs_size', array( /* Breadcrumb */
		'label'						=> __( 'Breadcrumb', 'ambition' ),
		'section'					=> 'ambition_fontsize',
		'type'						=> 'select',
		'settings'					=>'ambition_theme_settings[ambition_breadcrumbs_size]',
		'priority'					=> 130,
		'choices'				=> array(
			'12'					=> __('12 px','ambition'),
			'14'					=> __('14 px','ambition'),
			'16'					=> __('16 px','ambition'),
			'18'					=> __('18 px','ambition'),
			'20'					=> __('20 px','ambition'),
		),
	) );
	$wp_customize->add_setting('ambition_theme_settings[ambition_widgettitle_size]', array(
		'default'					=> '16',
		'sanitize_callback'		=> 'prefix_sanatize_integer',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_widgettitle_size', array( /* Sidebar/Colophon Widget Title */
		'label'						=> __( 'Sidebar/Colophon Widget Title', 'ambition' ),
		'section'					=> 'ambition_fontsize',
		'type'						=> 'select',
		'settings'					=> 'ambition_theme_settings[ambition_widgettitle_size]',
		'priority'					=> 140,
		'choices'				=> array(
			'14'					=> __('14 px','ambition'),
			'16'					=> __('16 px','ambition'),
			'18'					=> __('18 px','ambition'),
			'20'					=> __('20 px','ambition'),
			'22'					=> __('22 px','ambition'),
		),
	) );
	$wp_customize->add_setting('ambition_theme_settings[ambition_footer_content_size]', array(
		'default'					=> '16',
		'sanitize_callback'		=> 'prefix_sanatize_integer',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_footer_content_size', array( /* Footer Content */
		'label'						=> __( 'Footer Content', 'ambition' ),
		'section'					=> 'ambition_fontsize',
		'type'						=> 'select',
		'settings'					=> 'ambition_theme_settings[ambition_footer_content_size]',
		'priority'					=> 150,
		'choices'				=> array(
			'14'					=> __('14 px','ambition'),
			'15'					=> __('15 px','ambition'),
			'16'					=> __('16 px','ambition'),
			'17'					=> __('17 px','ambition'),
			'18'					=> __('18 px','ambition'),
		),
	) );
	$wp_customize->add_setting('ambition_theme_settings[ambition_bottom_infobar_size]', array(
		'default'					=> '14',
		'sanitize_callback'		=> 'prefix_sanatize_integer',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_bottom_infobar_size', array( /*Bottom Info Bar */
		'label'						=> __( 'Footer Content', 'ambition' ),
		'section'					=> 'ambition_fontsize',
		'type'						=> 'select',
		'settings'					=> 'ambition_theme_settings[ambition_bottom_infobar_size]',
		'priority'					=> 160,
		'choices'				=> array(
			'14'					=> __('14 px','ambition'),
			'15'					=> __('15 px','ambition'),
			'16'					=> __('16 px','ambition'),
			'17'					=> __('17 px','ambition'),
			'18'					=> __('18 px','ambition'),
		),
	) );
	$wp_customize->add_setting('ambition_theme_settings[ambition_site_info_size]', array(
		'default'					=> '14',
		'sanitize_callback'		=> 'prefix_sanatize_integer',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('ambition_site_info_size', array( /* Site Info */
		'label'						=> __( 'Site Info', 'ambition' ),
		'section'					=> 'ambition_fontsize',
		'type'						=> 'select',
		'settings'					=> 'ambition_theme_settings[ambition_site_info_size]',
		'priority'					=> 170,
		'choices'				=> array(
			'13'					=> __('13 px','ambition'),
			'14'					=> __('14 px','ambition'),
			'15'					=> __('15 px','ambition'),
			'16'					=> __('16 px','ambition'),
			'17'					=> __('17 px','ambition'),
		),
	) );
/********************* Font Color Options **********************************************/
	$wp_customize->add_section( 'ambition_font_color_options', array(
		'title' 						=> __('Font Color','ambition'),
		'priority'					=> 330,
		'panel'					=>'ambition_theme_options'
	));
	$wp_customize->add_setting( 'font_color_content', array(
		'default'           => '#666666',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'font_color_content', array(
		'label'=> __('Font Color Options', 'ambition'),
		'label'       => __( 'Content', 'ambition' ),
		'section'     => 'ambition_font_color_options',
	) ) );

	$wp_customize->add_setting( 'font_color_top_infobar', array(
		'default'           => '#888888',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'font_color_top_infobar', array(
		'label'       => __( 'Top Info Bar', 'ambition' ),
		'section'     => 'ambition_font_color_options',
	) ) );

	$wp_customize->add_setting( 'font_color_sitetitle', array(
		'default'           => '#666666',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'font_color_sitetitle', array(
		'label'       => __( 'Site Title', 'ambition' ),
		'section'     => 'ambition_font_color_options',
	) ) );
	$wp_customize->add_setting( 'font_color_navigation', array(
		'default'           => '#666666',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'font_color_navigation', array(
		'label'       => __( 'Navigation', 'ambition' ),
		'section'     => 'ambition_font_color_options',
	) ) );

	$wp_customize->add_setting( 'font_color_pagetitle_breadcrumbs', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'font_color_pagetitle_breadcrumbs', array(
		'label'       => __( 'Page Title and Breadcrumb', 'ambition' ),
		'section'     => 'ambition_font_color_options',
	) ) );

	$wp_customize->add_setting( 'font_color_slidertitle_content_button', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'font_color_slidertitle_content_button', array(
		'label'       => __( 'Featured Slider Title/ Content', 'ambition' ),
		'section'     => 'ambition_font_color_options',
	) ) );
	$wp_customize->add_setting( 'font_color_headings_titles', array(
		'default'           => '#333333',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'font_color_headings_titles', array(
		'label'       => __( 'All Headings/ Titles', 'ambition' ),
		'section'     => 'ambition_font_color_options',
	) ) );
	$wp_customize->add_setting( 'font_color_sidebar_widget_titles', array(
		'default'           => '#333333',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'font_color_sidebar_widget_titles', array(
		'label'       => __( 'Sidebar Widget Titles', 'ambition' ),
		'section'     => 'ambition_font_color_options',
	) ) );
		$wp_customize->add_setting( 'font_color_pormotionalbar', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'font_color_pormotionalbar', array(
		'label'       => __( 'Promotional Bar', 'ambition' ),
		'section'     => 'ambition_font_color_options',
	) ) );
	$wp_customize->add_setting( 'font_color_sidebar_content', array(
		'default'           => '#666666',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'font_color_sidebar_content', array(
		'label'       => __( ' Sidebar Content', 'ambition' ),
		'section'     => 'ambition_font_color_options',
	) ) );
	$wp_customize->add_setting( 'font_color_footer_widget_titles', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'font_color_footer_widget_titles', array(
		'label'       => __( 'Footer Widget Titles', 'ambition' ),
		'section'     => 'ambition_font_color_options',
	) ) );
	$wp_customize->add_setting( 'font_color_footer_content', array(
		'default'           => '#888888',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'font_color_footer_content', array(
		'label'       => __( 'Footer Content', 'ambition' ),
		'section'     => 'ambition_font_color_options',
	) ) );
	$wp_customize->add_setting( 'font_color_footer_infobar', array(
		'default'           => '#888888',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'font_color_footer_infobar', array(
		'label'       => __( 'Footer Info Bar', 'ambition' ),
		'section'     => 'ambition_font_color_options',
	) ) );
	$wp_customize->add_setting( 'font_color_site_info', array(
		'default'           => '#666666',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'font_color_site_info', array(
		'label'       => __( 'Site Info', 'ambition' ),
		'section'     => 'ambition_font_color_options',
	) ) );
	$wp_customize->add_setting( 'font_color_siteinfo_links', array(
		'default'           => '#888888',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'font_color_siteinfo_links', array(
		'label'       => __( 'Site Info Links', 'ambition' ),
		'section'     => 'ambition_font_color_options',
	) ) );
	
}
add_action( 'customize_register', 'ambition_customize_register', 11 );
/**
 * Register color schemes for Ambition.
 *
 * Can be filtered with {@see 'ambition_color_schemes'}.
 *
 * The order of colors in a colors array:
 * @since Ambition 1.0
 *
 * @return array An associative array of color scheme options.
 */
function ambition_get_color_schemes() {
	return apply_filters( 'ambition_color_schemes', array(
		'darkcyan' => array(
			'label'  => __( 'Dark Cyan', 'ambition' ),
			'colors' => array(
				'#35ACA8',
				'#35ACA8',
				'#35ACA8',
				'#35ACA8',
			),
		),
		'lightgreen'    => array(
			'label'  => __( 'Light Green', 'ambition' ),
			'colors' => array(
				'#89a352',
				'#89a452',
				'#89a452',
				'#89a452',
			),
		),
		'yellow'  => array(
			'label'  => __( 'Yellow', 'ambition' ),
			'colors' => array(
				'#FCC71F',
				'#FCC71F',
				'#FCC71F',
				'#FCC71F',
				
			),
		),
		'pink'    => array(
			'label'  => __( 'Pink', 'ambition' ),
			'colors' => array(
				'#F52E5D',
				'#F52E5D',
				'#F52E5D',
				'#F52E5D',
			),
		),
		'brown'  => array(
			'label'  => __( 'Brown', 'ambition' ),
			'colors' => array(
				'#9C6B33',
				'#9C6B33',
				'#9C6B33',
				'#9C6B33',
			),
		),
		'maroon'   => array(
			'label'  => __( 'Maroon', 'ambition' ),
			'colors' => array(
				'#CC3F48',
				'#CC3F48',
				'#CC3F48',
				'#CC3F48',
			),
		),
		'blue'   => array(
			'label'  => __( 'Blue', 'ambition' ),
			'colors' => array(
				'#3AB0DB',
				'#3AB0DB',
				'#3AB0DB',
				'#3AB0DB',
			),
		),
		'purple'   => array(
			'label'  => __( 'Purple', 'ambition' ),
			'colors' => array(
				'#9651CC',
				'#9651CC',
				'#9651CC',
				'#9651CC',
			),
		),
		'aquamarine'   => array(
			'label'  => __( 'Aquamarine', 'ambition' ),
			'colors' => array(
				'#63C6AE',
				'#63C6AE',
				'#63C6AE',
				'#63C6AE',
			),
		),
		'orange'   => array(
			'label'  => __( 'Orange', 'ambition' ),
			'colors' => array(
				'#E96E4D',
				'#E96E4D',
				'#E96E4D',
				'#E96E4D',

			),
		),
		'maroon'   => array(
			'label'  => __( 'Light Red', 'ambition' ),
			'colors' => array(
				'#F77565',
				'#F77565',
				'#F77565',
				'#F77565',
			),
		),
	) );
}

if ( ! function_exists( 'ambition_get_color_scheme' ) ) :
/**
 * Get the current Ambition color scheme.
 *
 * @since Ambition 1.0
 *
 * @return array An associative array of either the current or default color scheme hex values.
 */
function ambition_get_color_scheme() {
	$color_scheme_option = get_option( 'color_scheme', 'lightgreen' );
	$color_schemes       = ambition_get_color_schemes();

	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		return $color_schemes[ $color_scheme_option ]['colors'];
	}

	return $color_schemes['lightgreen']['colors'];
}
endif; // ambition_get_color_scheme

if ( ! function_exists( 'ambition_get_color_scheme_choices' ) ) :
/**
 * Returns an array of color scheme choices registered for Ambition.
 *
 * @since Ambition 1.0
 *
 * @return array Array of color schemes.
 */
function ambition_get_color_scheme_choices() {
	$color_schemes                = ambition_get_color_schemes();
	$color_scheme_control_options = array();

	foreach ( $color_schemes as $color_scheme => $value ) {
		$color_scheme_control_options[ $color_scheme ] = $value['label'];
	}

	return $color_scheme_control_options;
}
endif; // ambition_get_color_scheme_choices

if ( ! function_exists( 'ambition_sanitize_color_scheme' ) ) :
/**
 * Sanitization callback for color schemes.
 *
 * @since Ambition 1.0
 *
 * @param string $value Color scheme name value.
 * @return string Color scheme name.
 */
function ambition_sanitize_color_scheme( $value ) {
	$color_schemes = ambition_get_color_scheme_choices();

	if ( ! array_key_exists( $value, $color_schemes ) ) {
		$value = 'lightgreen';
	}

	return $value;
}
endif; // ambition_sanitize_color_scheme

/**
 * Enqueues front-end CSS for color scheme.
 *
 * @since Ambition 1.0
 *
 * @see wp_add_inline_style()
 */
function ambition_color_scheme_css() {
	$color_scheme_option = get_option( 'color_scheme', 'lightgreen' );

	// Don't do anything if the lightgreen color scheme is selected.
	if ( 'lightgreen' === $color_scheme_option ) {
		return;
	}

	$color_scheme = ambition_get_color_scheme();

	$colors = array(
		'ambition_links_color'     	=> $color_scheme[3],
		'ambition_navigation_color'   => $color_scheme[3],
		'ambition_buttons'            => $color_scheme[3],
		'ambition_promotionalbar'    	=> $color_scheme[3],
		//background color options
		'top_contact_infobar_background'         	=> '#f2f2f2',
		'site_title_logo_background'           	=> '#ffffff',
		'site_title_navigation_background'        => '#ffffff',
		'main_content_background'         			=> '#ffffff',
		'featured_pg_background'         			=> '#ffffff',
		'widgets_featured_recent_work_background' => '#ffffff',
		'services_background'           				=> '#ffffff',
		'testimonial_background'         			=> '#f2f2f2',
		'wid_clien_pro_background'						=> '#ffffff',
		'footer_widget_section_background'        => '#262626',
		'bottom_contact_infobar_background'       => '#202020',
		'site_info_background'         				=> '#1a1a1a',
		'blockquote_sticky_background'          	=> '#f2f2f2',
		'form_input_textfield_background'         => '#f9f9f9',
		//font color options
		'font_color_content'         					=> '#666666',
		'font_color_top_infobar'        		 		=> '#888888',
		'font_color_sitetitle'         				=> '#666666',
		'font_color_navigation'         				=> '#666666',
		'font_color_pagetitle_breadcrumbs'        => '#ffffff',
		'font_color_slidertitle_content_button'   => '#ffffff',
		'font_color_headings_titles'         		=> '#333333',
		'font_color_sidebar_widget_titles'        => '#333333',
		'font_color_pormotionalbar'         		=> '#ffffff',
		'font_color_sidebar_content'         		=> '#666666',
		'font_color_footer_widget_titles'         => '#ffffff',
		'font_color_footer_content'         		=> '#888888',
		'font_color_footer_infobar'         		=> '#888888',
		'font_color_site_info'         				=> '#666666',
		'font_color_siteinfo_links'        			=> '#888888',

	);

	$color_scheme_css = ambition_get_color_scheme_css( $colors );

	wp_add_inline_style( 'ambition-style', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'ambition_color_scheme_css' );
/**
 * Binds JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 *
 * @since Ambition 1.0
 */
function ambition_customize_control_js() {
	wp_enqueue_script( 'color-scheme-control', get_template_directory_uri() . '/js/color-scheme-control.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20141216', true );
	wp_localize_script( 'color-scheme-control', 'colorScheme', ambition_get_color_schemes() );
}
add_action( 'customize_controls_enqueue_scripts', 'ambition_customize_control_js' );

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Ambition 1.0
 */
function ambition_customize_preview_js() {
	wp_enqueue_script( 'ambition-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20141216', true );
}
add_action( 'customize_preview_init', 'ambition_customize_preview_js' );

/**
 * Returns CSS for the color schemes.
 *
 * @since Ambition 1.0
 *
 * @param array $colors Color scheme colors.
 * @return string Color scheme CSS.
 */
function ambition_get_color_scheme_css( $colors ) {
	$colors = wp_parse_args( $colors, array(
		'ambition_links_color'     					=> 'lightgreen',
		'ambition_navigation_color'   				=> 'lightgreen',
		'ambition_buttons'            				=> 'lightgreen',
		'ambition_promotionalbar'     				=> 'lightgreen',
		//background color options
		'top_contact_infobar_background'         	=> '#f2f2f2',
		'site_title_logo_background'           	=> '#ffffff',
		'site_title_navigation_background'        => '#ffffff',
		'main_content_background'         			=> '#ffffff',
		'featured_pg_background'         			=> '#ffffff',
		'widgets_featured_recent_work_background' => '#ffffff',
		'services_background'           				=> '#ffffff',
		'testimonial_background'         			=> '#f2f2f2',
		'wid_clien_pro_background'						=> '#ffffff',
		'footer_widget_section_background'        => '#262626',
		'bottom_contact_infobar_background'       => '#202020',
		'site_info_background'         				=> '#1a1a1a',
		'blockquote_sticky_background'          	=> '#f2f2f2',
		'form_input_textfield_background'         => '#f9f9f9',
		//font color options
		'font_color_content'         					=> '#666666',
		'font_color_top_infobar'        		 		=> '#888888',
		'font_color_sitetitle'         				=> '#666666',
		'font_color_navigation'         				=> '#666666',
		'font_color_pagetitle_breadcrumbs'        => '#ffffff',
		'font_color_slidertitle_content_button'   => '#ffffff',
		'font_color_headings_titles'         		=> '#333333',
		'font_color_sidebar_widget_titles'        => '#333333',
		'font_color_pormotionalbar'         		=> '#ffffff',
		'font_color_sidebar_content'         		=> '#666666',
		'font_color_footer_widget_titles'         => '#ffffff',
		'font_color_footer_content'         		=> '#888888',
		'font_color_footer_infobar'         		=> '#888888',
		'font_color_site_info'         				=> '#666666',
		'font_color_siteinfo_links'        			=> '#888888',
	) );

	$css = <<<CSS
	/* Color Scheme */
	/* links */
	::selection {
		background-color: {$colors['ambition_links_color']};
		color: #fff;
	}
	::-moz-selection {
		background-color: {$colors['ambition_links_color']};
		color: #fff;
	}
	a,
	#site-title a:hover,
	#site-title a:focus,
	#site-title a:active,
	.info-bar ul li a:hover,
	.info-bar .info ul li:before,
	#main ul a:hover,
	#main ol a:hover,
	#main .gal-filter li.active a,
	.entry-title a:hover,
	.entry-title a:focus,
	.entry-title a:active,
	.entry-meta a:hover,
	.entry-meta .cat-links a:hover,
	.custom-gallery-title a:hover,
	.widget ul li a:hover,
	.widget-title a:hover,
	.widget_tag_cloud a:hover,
	.widget_service .service-title a:hover,
	#colophon .widget ul li a:hover,
	.site-info .copyright a:hover,
	.woocommerce-page #main ul a,
	.woocommerce-page #main ol a,
	.woocommerce-page #main ul a:hover,
	.woocommerce-page #main ol a:hover,
	.woocommerce-page .star-rating,
	.woocommerce-page .star-rating:before{
		color:{$colors['ambition_links_color']};
	}
	/* Navigation */
	.main-navigation a:hover,
	.main-navigation ul li.current-menu-item a,
	.main-navigation ul li.current_page_ancestor a,
	.main-navigation ul li.current-menu-ancestor a,
	.main-navigation ul li.current_page_item a,
	.main-navigation ul li:hover > a,
	.main-navigation ul li ul li a:hover,
	.main-navigation ul li ul li:hover > a,
	.main-navigation ul li.current-menu-item ul li a:hover {
		color: {$colors['ambition_navigation_color']};
	}
	/* Buttons and Custom Tag Cloud Widget */
	.search-toggle:hover,
	.hgroup-right .active,
	.featured-text .active:hover {
		color: {$colors['ambition_buttons']};
	}
	input[type="reset"],
	input[type="button"],
	input[type="submit"],
	.widget_custom-tagcloud a:hover,
	.back-to-top a:hover,
	#bbpress-forums button,
	#wp_page_numbers ul li a:hover,
	#wp_page_numbers ul li.active_page a,
	.wp-pagenavi .current,
	.wp-pagenavi a:hover,
	ul.default-wp-page li a:hover,
	.pagination a:hover span,
	.pagination span,
	.call-to-action:hover,
	.featured-text .active,
	.woocommerce-page #respond input#submit,
	.woocommerce-page a.button,
	.woocommerce-page button.button,
	.woocommerce-page input.button,
	.woocommerce-page #respond input#submit.alt,
	.woocommerce-page a.button.alt,
	.woocommerce-page button.button.alt,
	.woocommerce-page input.button.alt,
	.woocommerce-page span.onsale,
	.woocommerce-page .widget_price_filter .ui-slider .ui-slider-range,
	.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle  {
		background-color: {$colors['ambition_buttons']};
	}
	blockquote,
	.widget_custom-tagcloud a:hover,
	#wp_page_numbers ul li a:hover,
	#wp_page_numbers ul li.active_page a,
	.wp-pagenavi .current,
	.wp-pagenavi a:hover,
	ul.default-wp-page li a:hover,
	.pagination a:hover span,
	.pagination span,
	.call-to-action:hover,
	.widget_promotional_bar .call-to-action:hover, 
	.featured-text .active {
		border-color: {$colors['ambition_links_color']};
	}
	/* Promotional Bar/ Page Title */
	.promotional_bar_content,
	.page-title-wrap {
		background-color:{$colors['ambition_promotionalbar']};
	}

	/* Background Color Options */

	/* Top Contact Info Bar */
	.info-bar {
	background-color: {$colors['top_contact_infobar_background']};
	}
	/* Site Title/ Logo */
	.hgroup-wrap {
	background-color: {$colors['site_title_logo_background']};
	}
	@media only screen and (max-width: 767px) {
		#site-navigation ul li ul {
			background-color: {$colors['site_title_logo_background']};
		}
	}

	/* Navigation Dropdown */
	.main-navigation ul li ul { 
		background-color: {$colors['site_title_navigation_background']};
	}

	/* Main Content */
	#content {
		background-color: {$colors['main_content_background']};
	}

	/* Widget Featured Page */
	.widget_featured_page {
		background-color: {$colors['featured_pg_background']};
	}

	/* Widget Featured Recent Work */
	.widget_recent_work {
		background-color: {$colors['widgets_featured_recent_work_background']};
	}

	/* Widget Services */
	.widget_service {
		background-color: {$colors['services_background']};
	}

	/* Widget Testimonial */
	.widget_testimonial,
	.testimonials-template .widget_testimonial {
		background-color: {$colors['testimonial_background']};
	}

	/* Widget Featured Clients/ Products */
	.widget_ourclients {
		background-color: {$colors['wid_clien_pro_background']};
	}

	/* Footer Widget Section */
	#colophon .widget-wrap {
		background-color: {$colors['footer_widget_section_background']};
	}

	/* Bottom Contact Info Bar */
	#colophon .info-bar {
		background-color: {$colors['bottom_contact_infobar_background']};
	}

	/* Site Info */
	.site-info {
		background-color: {$colors['site_info_background']};
	}

	/* Blockquote and Sticky Post */
	pre,
	code,
	kbd,
	blockquote,
	#main .sticky {
		background-color: {$colors['blockquote_sticky_background']};
	}

	/* Form Input/ Textarea Fields */
	input[type="text"],
	input[type="email"],
	input[type="search"],
	input[type="password"],
	textarea {
		background-color: {$colors['form_input_textfield_background']};
	}

	/* Font Color Options */
	/* Content */
	body,
	input,
	textarea,
	#site-description,
	#main ul a,
	#main ol a,
	#wp_page_numbers ul li.page_info,
	#wp_page_numbers ul li a,
	.wp-pagenavi .pages,
	.wp-pagenavi a,
	ul.default-wp-page li a,
	.pagination,
	.pagination a span,
	.entry-meta,
	.entry-meta a {
		color: {$colors['font_color_content']};
	}
	#wp_page_numbers ul li a,
	.wp-pagenavi a,
	ul.default-wp-page li a,
	.pagination a span {
		border-color:{$colors['font_color_content']};
	}

	/* Top Info Bar */
	.info-bar,
	.info-bar .info ul li a {
		color: {$colors['font_color_top_infobar']};
	}

	/* Site Title */
	#site-title a,
	.menu-toggle {
		color: {$colors['font_color_sitetitle']};
	}

	/* Navigation */
	.main-navigation a,
	.main-navigation ul li ul li a,
	.main-navigation ul li.current-menu-item ul li a,
	.main-navigation ul li ul li.current-menu-item a,
	.main-navigation ul li.current_page_ancestor ul li a,
	.main-navigation ul li.current-menu-ancestor ul li a,
	.main-navigation ul li.current_page_item ul li a {
		color: {$colors['font_color_navigation']};
	}

	/* Page Title and Breadcrumb */
	.page-title,
	.breadcrumb,
	.breadcrumb a,
	.breadcrumb a:hover {
		color:{$colors['font_color_pagetitle_breadcrumbs']};
	}

	/* Featured Slider Title/ Content */
	.featured-text .featured-title a,
	.featured-text .featured-content {
		color: {$colors['font_color_slidertitle_content_button']};
	}

	/* All Headings/ Titles */
	#main .widget_service .service-title a,
	#main .widget-title,
	#main .widget-title a,
	.entry-title,
	.entry-title a,
	.entry-meta .cat-links,
	.entry-meta .cat-links a,
	.tag-links,
	.tag-links:before,
	.tag-links a,
	th {
		color: {$colors['font_color_headings_titles']};
	}

	/* Sidebar Widget Titles */
	.widget-title,
	.widget-title a {
		color:{$colors['font_color_sidebar_widget_titles']};
	}

	/* Promotional Bar */
	.widget_promotional_bar .promotional_bar_content,
	#main .widget_promotional_bar .widget-title ,
	.widget_promotional_bar .call-to-action,
	.widget_promotional_bar .call-to-action:hover {
		color: {$colors['font_color_pormotionalbar']};
	}
	.widget_promotional_bar .call-to-action {
		border-color: {$colors['font_color_pormotionalbar']};
	}

	/* Sidebar Content */
	#secondary,
	#secondary .widget ul li a,
	.widget_search input.s,
	.widget_custom-tagcloud a {
		color: {$colors['font_color_sidebar_content']};
	}
	.widget_custom-tagcloud a {
		border-color: #666; 
	}

	/* Footer Widget Titles */
	#colophon .widget-title {
		color: {$colors['font_color_footer_widget_titles']};
	}

	/* Footer Content */
	#colophon .widget-wrap,
	#colophon .widget ul li a {
		color: {$colors['font_color_footer_content']};
	}

	/* Footer Info Bar */
	#colophon .info-bar .info ul li a {
		color: {$colors['font_color_footer_infobar']};
	}

	/* Site Info */
	.site-info {
		color: {$colors['font_color_site_info']};
	}

	/* Site Info Links */
	.site-info .copyright a {
		color: {$colors['font_color_siteinfo_links']};
	}

CSS;
	return $css;
}

/**
 * Output an Underscore template for generating CSS for the color scheme.
 *
 * The template generates the css dynamically for instant display in the Customizer
 * preview.
 *
 * @since Ambition 1.0
 */
function ambition_color_scheme_css_template() {
	$colors = array(
		'ambition_links_color'     => '{{ data.ambition_links_color }}',
		'ambition_navigation_color'        => '{{ data.ambition_navigation_color }}',
		'ambition_buttons'                   => '{{ data.ambition_buttons }}',
		'ambition_promotionalbar'         => '{{ data.ambition_promotionalbar }}',
		/* Background Color Options */
		'top_contact_infobar_background'                => '{{ data.top_contact_infobar_background }}',
		'site_title_logo_background'                => '{{ data.site_title_logo_background }}',
		'site_title_navigation_background'                => '{{ data.site_title_navigation_background }}',
		'main_content_background'                => '{{ data.main_content_background }}',
		'featured_pg_background'                => '{{ data.featured_pg_background }}',
		'widgets_featured_recent_work_background'                => '{{ data.widgets_featured_recent_work_background }}',
		'services_background'                => '{{ data.services_background }}',
		'testimonial_background'                => '{{ data.testimonial_background }}',
		'wid_clien_pro_background'                => '{{ data.wid_clien_pro_background }}',
		'footer_widget_section_background'                => '{{ data.footer_widget_section_background }}',
		'bottom_contact_infobar_background'                => '{{ data.bottom_contact_infobar_background }}',
		'site_info_background'                => '{{ data.site_info_background }}',
		'blockquote_sticky_background'                => '{{ data.blockquote_sticky_background }}',
		'form_input_textfield_background'                => '{{ data.form_input_textfield_background }}',
		//font color options
		'font_color_content'         					=> '{{ data.font_color_content }}',
		'font_color_top_infobar'        		 		=> '{{ data.font_color_top_infobar }}',
		'font_color_sitetitle'         				=> '{{ data.font_color_sitetitle }}',
		'font_color_navigation'         				=> '{{ data.font_color_navigation }}',
		'font_color_pagetitle_breadcrumbs'        => '{{ data.font_color_pagetitle_breadcrumbs }}',
		'font_color_slidertitle_content_button'   => '{{ data.font_color_slidertitle_content_button }}',
		'font_color_headings_titles'         		=> '{{ data.font_color_headings_titles }}',
		'font_color_sidebar_widget_titles'        => '{{ data.font_color_sidebar_widget_titles }}',
		'font_color_pormotionalbar'         		=> '{{ data.font_color_pormotionalbar }}',
		'font_color_sidebar_content'         		=> '{{ data.font_color_sidebar_content }}',
		'font_color_footer_widget_titles'         => '{{ data.font_color_footer_widget_titles }}',
		'font_color_footer_content'         		=> '{{ data.font_color_footer_content }}',
		'font_color_footer_infobar'         		=> '{{ data.font_color_footer_infobar }}',
		'font_color_site_info'         				=> '{{ data.font_color_site_info }}',
		'font_color_siteinfo_links'        			=> '{{ data.font_color_siteinfo_links }}',
	);
	?>
	<script type="text/html" id="tmpl-ambition-color-scheme">
		<?php echo ambition_get_color_scheme_css( $colors ); ?>
	</script>
	<?php
}
add_action( 'customize_controls_print_footer_scripts', 'ambition_color_scheme_css_template' );

/********************Sanitize the values ******************************************/
function prefix_sanitize_integer( $input ) {
	return $input;
}
function ambition_sanitize_effect( $input ) {
	if ( ! in_array( $input, array( 'fade', 'wipe', 'scrollUp', 'scrollDown', 'scrollLeft', 'scrollRight', 'blindX', 'blindY', 'blindZ', 'cover', 'shuffle' ) ) ) {
		$input = 'fade';
	}
	return $input;
}
function prefix_sanatize_integer( $input ) {
	if ( ! in_array( $input, array( '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41','42','43','44','45','46','47','48','49','50' ) ) ) {
		$input = 'default';
	}
	return $input;
}
function prefix_sanatize_fontfamily( $input ) {
	if ( ! in_array( $input, ambition_google_fonts() ) ) {
		$input = ambition_google_fonts();
	}
	return $input;
}
function ambition_sanitize_delay_transition( $input ) {
	if(is_numeric($input)){
	return $input;
	}
}
function ambition_sanatize_excerpt_length( $input ) {
	if(is_numeric($input)){
	return $input;
	}
}
function customize_styles_ambition_upgrade( $input ) { ?>
	<style type="text/css">
		#customize-theme-controls #accordion-section-ambition_upgrade .accordion-section-title:after {
			color: #fff;
		}
		#customize-theme-controls #accordion-section-ambition_upgrade .accordion-section-title {
			background-color: rgba(113, 176, 47, 0.9);
			color: #fff;
		}
		#customize-theme-controls #accordion-section-ambition_upgrade .accordion-section-title:hover {
			background-color: rgba(113, 176, 47, 1);
		}
		#customize-theme-controls #accordion-section-ambition_upgrade .theme-info a {
			padding: 10px 8px;
			display: block;
			border-bottom: 1px solid #eee;
			color: #555;
		}
		#customize-theme-controls #accordion-section-ambition_upgrade .theme-info a:hover {
			color: #222;
			background-color: #f5f5f5;
		}
	</style>
<?php }
function prefix_sanitize_phone( $input ) {
	$input =  preg_replace("/[^() 0-9+-]/", '', $input);
	return $input;
}
function footer_edit( $input ) {
	$input =  stripslashes( wp_filter_post_kses( addslashes ($input)));
	return $input;
}
add_action('customize_register', 'ambition_textarea_register');
add_action('customize_register', 'ambition_customize_register');
add_action( 'customize_controls_print_styles', 'customize_styles_ambition_upgrade');
?>
