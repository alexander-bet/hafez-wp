<?php

/**
 * Get option wrapper
 * @param mixed $name
 * @param mixed $default
 * @return mixed 
 */
function hafez_option($name, $default = false)
{
    echo hafez_get_option($name, $default);
}
function hafez_filtered_option($name, $default = false, $filter = 'the_content')
{
    echo apply_filters($filter, hafez_get_option($name, $default));
}
function hafez_get_option($name, $default = false)
{
    $name = 'hafez_' . $name;
    if (false === $default) {
        $options = hafez_get_options();
        foreach ($options as $option) {
            if (isset($option['id']) && $option['id'] == $name) {
                $default = isset($option['std']) ? $option['std'] : false;
                break;
            }
        }
    }
    return of_get_option($name, $default);
}

/**
 * Echo meta for post
 * @param string $key
 * @param boolean $single
 * @param mixed $post_id 
 */
function hafez_meta($key, $single = true, $post_id = null)
{
    echo hafez_get_meta($key, $single, $post_id);
}
/**
 * Find meta for post
 * @param string $key
 * @param boolean $single
 * @param mixed $post_id 
 */
function hafez_get_meta($key, $single = true, $post_id = null)
{
    if (null === $post_id) {
        $post_id = get_the_ID();
    }
    $key = 'hafez_' . $key;
    return get_post_meta($post_id, $key, $single);
}
/**
 * Apply filters to post meta
 * @param string $key
 * @param string $filter
 * @param mixed $post_id 
 */
function hafez_filtered_meta($key, $filter = 'the_content', $post_id = null)
{
    echo apply_filters($filter, hafez_get_meta($key, true, $post_id));
}

function hafez_page_links()
{
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

    $pagination = array(
        'base'               => '%_%',
        'format'             => '?paged=%#%',
        'total' => $wp_query->max_num_pages,
        'current' => $current,
        'show_all' => false,
        'type' => 'plain',
        'prev_next' => false,
    );

    if ($wp_rewrite->using_permalinks())
        $pagination['base'] = user_trailingslashit(trailingslashit(remove_query_arg('s', get_pagenum_link(1))) . 'page/%#%/', 'paged');

    if (!empty($wp_query->query_vars['s']))
        $pagination['add_args'] = array('s' => get_query_var('s'));

    echo paginate_links($pagination);
}



/**
 * Retreive Google Fonts List.
 * 
 * @return array 
 */
function hafez_get_google_webfonts()
{
    return array(
        'ABeeZee' => 'ABeeZee',
        'Abel' => 'Abel',
        'Abril+Fatface' => 'Abril Fatface',
        'Aclonica' => 'Aclonica',
        'Acme' => 'Acme',
        'Actor' => 'Actor',
        'Adamina' => 'Adamina',
        'Advent+Pro' => 'Advent Pro',
        'Aguafina+Script' => 'Aguafina Script',
        'Akronim' => 'Akronim',
        'Aladin' => 'Aladin',
        'Aldrich' => 'Aldrich',
        'hafezgreya' => 'hafezgreya',
        'hafezgreya+SC' => 'hafezgreya SC',
        'hafezx+Brush' => 'hafezx Brush',
        'Alfa+Slab+One' => 'Alfa Slab One',
        'Alice' => 'Alice',
        'Alike' => 'Alike',
        'Alike+Angular' => 'Alike Angular',
        'Allan' => 'Allan',
        'Allerta' => 'Allerta',
        'Allerta+Stencil' => 'Allerta Stencil',
        'Allura' => 'Allura',
        'Almendra' => 'Almendra',
        'Almendra+Display' => 'Almendra Display',
        'Almendra+SC' => 'Almendra SC',
        'Amarante' => 'Amarante',
        'Amaranth' => 'Amaranth',
        'Amatic+SC' => 'Amatic SC',
        'Amethysta' => 'Amethysta',
        'Anaheim' => 'Anaheim',
        'Andada' => 'Andada',
        'Andika' => 'Andika',
        'Angkor' => 'Angkor',
        'Annie+Use+Your+Telescope' => 'Annie Use Your Telescope',
        'Anonymous+Pro' => 'Anonymous Pro',
        'Antic' => 'Antic',
        'Antic+Didone' => 'Antic Didone',
        'Antic+Slab' => 'Antic Slab',
        'Anton' => 'Anton',
        'Arapey' => 'Arapey',
        'Arbutus' => 'Arbutus',
        'Arbutus+Slab' => 'Arbutus Slab',
        'Architects+Daughter' => 'Architects Daughter',
        'Archivo+Black' => 'Archivo Black',
        'Archivo+Narrow' => 'Archivo Narrow',
        'Arimo' => 'Arimo',
        'Arizonia' => 'Arizonia',
        'Armata' => 'Armata',
        'Artifika' => 'Artifika',
        'Arvo' => 'Arvo',
        'Asap' => 'Asap',
        'Asset' => 'Asset',
        'Astloch' => 'Astloch',
        'Asul' => 'Asul',
        'Atomic+Age' => 'Atomic Age',
        'Aubrey' => 'Aubrey',
        'Audiowide' => 'Audiowide',
        'Autour+One' => 'Autour One',
        'Average' => 'Average',
        'Average+Sans' => 'Average Sans',
        'Averia+Gruesa+Libre' => 'Averia Gruesa Libre',
        'Averia+Libre' => 'Averia Libre',
        'Averia+Sans+Libre' => 'Averia Sans Libre',
        'Averia+Serif+Libre' => 'Averia Serif Libre',
        'Bad+Script' => 'Bad Script',
        'Balthazar' => 'Balthazar',
        'Bangers' => 'Bangers',
        'Basic' => 'Basic',
        'Battambang' => 'Battambang',
        'Baumans' => 'Baumans',
        'Bayon' => 'Bayon',
        'Barlow' => 'Barlow',
        'Belgrano' => 'Belgrano',
        'Belleza' => 'Belleza',
        'BenchNine' => 'BenchNine',
        'Bentham' => 'Bentham',
        'Berkshire+Swash' => 'Berkshire Swash',
        'Bevan' => 'Bevan',
        'Bigelow+Rules' => 'Bigelow Rules',
        'Bigshot+One' => 'Bigshot One',
        'Bilbo' => 'Bilbo',
        'Bilbo+Swash+Caps' => 'Bilbo Swash Caps',
        'Bitter' => 'Bitter',
        'Black+Ops+One' => 'Black Ops One',
        'Bokor' => 'Bokor',
        'Bonbon' => 'Bonbon',
        'Boogaloo' => 'Boogaloo',
        'Bowlby+One' => 'Bowlby One',
        'Bowlby+One+SC' => 'Bowlby One SC',
        'Brawler' => 'Brawler',
        'Bree+Serif' => 'Bree Serif',
        'Bubblegum+Sans' => 'Bubblegum Sans',
        'Bubbler+One' => 'Bubbler One',
        'Buda' => 'Buda',
        'Buenard' => 'Buenard',
        'Butcherman' => 'Butcherman',
        'Butterfly+Kids' => 'Butterfly Kids',
        'Cabin' => 'Cabin',
        'Cabin+Condensed' => 'Cabin Condensed',
        'Cabin+Sketch' => 'Cabin Sketch',
        'Caesar+Dressing' => 'Caesar Dressing',
        'Cagliostro' => 'Cagliostro',
        'Calligraffitti' => 'Calligraffitti',
        'Cambo' => 'Cambo',
        'Candal' => 'Candal',
        'Cantarell' => 'Cantarell',
        'Cantata+One' => 'Cantata One',
        'Cantora+One' => 'Cantora One',
        'Capriola' => 'Capriola',
        'Cardo' => 'Cardo',
        'Carme' => 'Carme',
        'Carrois+Gothic' => 'Carrois Gothic',
        'Carrois+Gothic+SC' => 'Carrois Gothic SC',
        'Carter+One' => 'Carter One',
        'Caudex' => 'Caudex',
        'Cedarville+Cursive' => 'Cedarville Cursive',
        'Ceviche+One' => 'Ceviche One',
        'Changa+One' => 'Changa One',
        'Chango' => 'Chango',
        'Chau+Philomene+One' => 'Chau Philomene One',
        'Chela+One' => 'Chela One',
        'Chelsea+Market' => 'Chelsea Market',
        'Chenla' => 'Chenla',
        'Cherry+Cream+Soda' => 'Cherry Cream Soda',
        'Cherry+Swash' => 'Cherry Swash',
        'Chewy' => 'Chewy',
        'Chicle' => 'Chicle',
        'Chivo' => 'Chivo',
        'Cinzel' => 'Cinzel',
        'Cinzel+Decorative' => 'Cinzel Decorative',
        'Clicker+Script' => 'Clicker Script',
        'Coda' => 'Coda',
        'Coda+Caption' => 'Coda Caption',
        'Codystar' => 'Codystar',
        'Combo' => 'Combo',
        'Comfortaa' => 'Comfortaa',
        'Coming+Soon' => 'Coming Soon',
        'Concert+One' => 'Concert One',
        'Condiment' => 'Condiment',
        'Content' => 'Content',
        'Contrail+One' => 'Contrail One',
        'Convergence' => 'Convergence',
        'Cookie' => 'Cookie',
        'Copse' => 'Copse',
        'Corben' => 'Corben',
        'Cormorant' => 'Cormorant',
        'Cormorant+Garamond' => 'Cormorant Garamond',
        'Courgette' => 'Courgette',
        'Cousine' => 'Cousine',
        'Coustard' => 'Coustard',
        'Covered+By+Your+Grace' => 'Covered By Your Grace',
        'Crafty+Girls' => 'Crafty Girls',
        'Creepster' => 'Creepster',
        'Crete+Round' => 'Crete Round',
        'Crimson+Text' => 'Crimson Text',
        'Croissant+One' => 'Croissant One',
        'Crushed' => 'Crushed',
        'Cuprum' => 'Cuprum',
        'Cutive' => 'Cutive',
        'Cutive+Mono' => 'Cutive Mono',
        'Damion' => 'Damion',
        'Dancing+Script' => 'Dancing Script',
        'Dangrek' => 'Dangrek',
        'Dawning+of+a+New+Day' => 'Dawning of a New Day',
        'Days+One' => 'Days One',
        'Delius' => 'Delius',
        'Delius+Swash+Caps' => 'Delius Swash Caps',
        'Delius+Unicase' => 'Delius Unicase',
        'Della+Respira' => 'Della Respira',
        'Denk+One' => 'Denk One',
        'Devonshire' => 'Devonshire',
        'Didact+Gothic' => 'Didact Gothic',
        'Diplomata' => 'Diplomata',
        'Diplomata+SC' => 'Diplomata SC',
        'Domine' => 'Domine',
        'Donegal+One' => 'Donegal One',
        'Doppio+One' => 'Doppio One',
        'Dorsa' => 'Dorsa',
        'Dosis' => 'Dosis',
        'Dr+Sugiyama' => 'Dr Sugiyama',
        'Droid+Sans' => 'Droid Sans',
        'Droid+Sans+Mono' => 'Droid Sans Mono',
        'Droid+Serif' => 'Droid Serif',
        'Duru+Sans' => 'Duru Sans',
        'Dynalight' => 'Dynalight',
        'EB+Garamond' => 'EB Garamond',
        'Eagle+Lake' => 'Eagle Lake',
        'Eater' => 'Eater',
        'Economica' => 'Economica',
        'Electrolize' => 'Electrolize',
        'Elsie' => 'Elsie',
        'Elsie+Swash+Caps' => 'Elsie Swash Caps',
        'Emblema+One' => 'Emblema One',
        'Emilys+Candy' => 'Emilys Candy',
        'Engagement' => 'Engagement',
        'Englebert' => 'Englebert',
        'Enriqueta' => 'Enriqueta',
        'Erica+One' => 'Erica One',
        'Esteban' => 'Esteban',
        'Euphoria+Script' => 'Euphoria Script',
        'Ewert' => 'Ewert',
        'Exo' => 'Exo',
        'Expletus+Sans' => 'Expletus Sans',
        'Fanwood+Text' => 'Fanwood Text',
        'Fascinate' => 'Fascinate',
        'Fascinate+Inline' => 'Fascinate Inline',
        'Faster+One' => 'Faster One',
        'Fasthand' => 'Fasthand',
        'Federant' => 'Federant',
        'Federo' => 'Federo',
        'Felipa' => 'Felipa',
        'Fenix' => 'Fenix',
        'Finger+Paint' => 'Finger Paint',
        'Fjalla+One' => 'Fjalla One',
        'Fjord+One' => 'Fjord One',
        'Flamenco' => 'Flamenco',
        'Flavors' => 'Flavors',
        'Fondamento' => 'Fondamento',
        'Fontdiner+Swanky' => 'Fontdiner Swanky',
        'Forum' => 'Forum',
        'Francois+One' => 'Francois One',
        'Freckle+Face' => 'Freckle Face',
        'Fredericka+the+Great' => 'Fredericka the Great',
        'Fredoka+One' => 'Fredoka One',
        'Freehand' => 'Freehand',
        'Fresca' => 'Fresca',
        'Frijole' => 'Frijole',
        'Fruktur' => 'Fruktur',
        'Fugaz+One' => 'Fugaz One',
        'GFS+Didot' => 'GFS Didot',
        'GFS+Neohellenic' => 'GFS Neohellenic',
        'Gabriela' => 'Gabriela',
        'Gafata' => 'Gafata',
        'Galdeano' => 'Galdeano',
        'Galindo' => 'Galindo',
        'Gentium+Basic' => 'Gentium Basic',
        'Gentium+Book+Basic' => 'Gentium Book Basic',
        'Geo' => 'Geo',
        'Geostar' => 'Geostar',
        'Geostar+Fill' => 'Geostar Fill',
        'Germania+One' => 'Germania One',
        'Gilda+Display' => 'Gilda Display',
        'Give+You+Glory' => 'Give You Glory',
        'Glass+Antiqua' => 'Glass Antiqua',
        'Glegoo' => 'Glegoo',
        'Gloria+Hallelujah' => 'Gloria Hallelujah',
        'Goblin+One' => 'Goblin One',
        'Gochi+Hand' => 'Gochi Hand',
        'Gorditas' => 'Gorditas',
        'Goudy+Bookletter+1911' => 'Goudy Bookletter 1911',
        'Graduate' => 'Graduate',
        'Grand+Hotel' => 'Grand Hotel',
        'Gravitas+One' => 'Gravitas One',
        'Great+Vibes' => 'Great Vibes',
        'Griffy' => 'Griffy',
        'Gruppo' => 'Gruppo',
        'Gudea' => 'Gudea',
        'Habibi' => 'Habibi',
        'Hammersmith+One' => 'Hammersmith One',
        'Hanhafezi' => 'Hanhafezi',
        'Hanhafezi+Fill' => 'Hanhafezi Fill',
        'Handlee' => 'Handlee',
        'Hanuman' => 'Hanuman',
        'Hind' => 'Hind',
        'Happy+Monkey' => 'Happy Monkey',
        'Headland+One' => 'Headland One',
        'Henny+Penny' => 'Henny Penny',
        'Herr+Von+Muellerhoff' => 'Herr Von Muellerhoff',
        'Holtwood+One+SC' => 'Holtwood One SC',
        'Homemade+Apple' => 'Homemade Apple',
        'Homenaje' => 'Homenaje',
        'IM+Fell+DW+Pica' => 'IM Fell DW Pica',
        'IM+Fell+DW+Pica+SC' => 'IM Fell DW Pica SC',
        'IM+Fell+Double+Pica' => 'IM Fell Double Pica',
        'IM+Fell+Double+Pica+SC' => 'IM Fell Double Pica SC',
        'IM+Fell+English' => 'IM Fell English',
        'IM+Fell+English+SC' => 'IM Fell English SC',
        'IM+Fell+French+Canon' => 'IM Fell French Canon',
        'IM+Fell+French+Canon+SC' => 'IM Fell French Canon SC',
        'IM+Fell+Great+Primer' => 'IM Fell Great Primer',
        'IM+Fell+Great+Primer+SC' => 'IM Fell Great Primer SC',
        'Iceberg' => 'Iceberg',
        'Iceland' => 'Iceland',
        'Imprima' => 'Imprima',
        'Inconsolata' => 'Inconsolata',
        'Inder' => 'Inder',
        'Indie+Flower' => 'Indie Flower',
        'Inika' => 'Inika',
        'Irish+Grover' => 'Irish Grover',
        'Istok+Web' => 'Istok Web',
        'Italiana' => 'Italiana',
        'Italianno' => 'Italianno',
        'Jacques+Francois' => 'Jacques Francois',
        'Jacques+Francois+Shadow' => 'Jacques Francois Shadow',
        'Jim+Nightshade' => 'Jim Nightshade',
        'Jockey+One' => 'Jockey One',
        'Jolly+Lodger' => 'Jolly Lodger',
        'Josefin+Sans' => 'Josefin Sans',
        'Josefin+Slab' => 'Josefin Slab',
        'Jost' => 'Jost',
        'Joti+One' => 'Joti One',
        'Judson' => 'Judson',
        'Julee' => 'Julee',
        'Julius+Sans+One' => 'Julius Sans One',
        'Junge' => 'Junge',
        'Jura' => 'Jura',
        'Just+Another+Hand' => 'Just Another Hand',
        'Just+Me+Again+Down+Here' => 'Just Me Again Down Here',
        'Kameron' => 'Kameron',
        'Karla' => 'Karla',
        'Kaushan+Script' => 'Kaushan Script',
        'Kavoon' => 'Kavoon',
        'Keania+One' => 'Keania One',
        'Kelly+Slab' => 'Kelly Slab',
        'Kenia' => 'Kenia',
        'Khand' => 'Khand',
        'Khmer' => 'Khmer',
        'Kite+One' => 'Kite One',
        'Knewave' => 'Knewave',
        'Kotta+One' => 'Kotta One',
        'Koulen' => 'Koulen',
        'Kranky' => 'Kranky',
        'Kreon' => 'Kreon',
        'Kristi' => 'Kristi',
        'Krona+One' => 'Krona One',
        'La+Belle+Aurore' => 'La Belle Aurore',
        'Lancelot' => 'Lancelot',
        'Lato' => 'Lato',
        'League+Script' => 'League Script',
        'Leckerli+One' => 'Leckerli One',
        'Ledger' => 'Ledger',
        'Lekton' => 'Lekton',
        'Lemon' => 'Lemon',
        'Libre+Baskerville' => 'Libre Baskerville',
        'Life+Savers' => 'Life Savers',
        'Lilita+One' => 'Lilita One',
        'Limelight' => 'Limelight',
        'Linden+Hill' => 'Linden Hill',
        'Lobster' => 'Lobster',
        'Lobster+Two' => 'Lobster Two',
        'Londrina+Outline' => 'Londrina Outline',
        'Londrina+Shadow' => 'Londrina Shadow',
        'Londrina+Sketch' => 'Londrina Sketch',
        'Londrina+Solid' => 'Londrina Solid',
        'Lora' => 'Lora',
        'Love+Ya+Like+A+Sister' => 'Love Ya Like A Sister',
        'Loved+by+the+King' => 'Loved by the King',
        'Lovers+Quarrel' => 'Lovers Quarrel',
        'Luckiest+Guy' => 'Luckiest Guy',
        'Lusitana' => 'Lusitana',
        'Lustria' => 'Lustria',
        'Macondo' => 'Macondo',
        'Macondo+Swash+Caps' => 'Macondo Swash Caps',
        'Magra' => 'Magra',
        'Maiden+Orange' => 'Maiden Orange',
        'Mako' => 'Mako',
        'Marcellus' => 'Marcellus',
        'Marcellus+SC' => 'Marcellus SC',
        'Marck+Script' => 'Marck Script',
        'Margarine' => 'Margarine',
        'Marko+One' => 'Marko One',
        'Marmelad' => 'Marmelad',
        'Marvel' => 'Marvel',
        'Mate' => 'Mate',
        'Mate+SC' => 'Mate SC',
        'Maven+Pro' => 'Maven Pro',
        'McLaren' => 'McLaren',
        'Meddon' => 'Meddon',
        'MedievalSharp' => 'MedievalSharp',
        'Medula+One' => 'Medula One',
        'Megrim' => 'Megrim',
        'Meie+Script' => 'Meie Script',
        'Merienda' => 'Merienda',
        'Merienda+One' => 'Merienda One',
        'Merriweather' => 'Merriweather',
        'Merriweather+Sans' => 'Merriweather Sans',
        'Metal' => 'Metal',
        'Metal+Mania' => 'Metal Mania',
        'Metamorphous' => 'Metamorphous',
        'Metrophobic' => 'Metrophobic',
        'Michroma' => 'Michroma',
        'Milonga' => 'Milonga',
        'Miltonian' => 'Miltonian',
        'Miltonian+Tattoo' => 'Miltonian Tattoo',
        'Miniver' => 'Miniver',
        'Miss+Fajardose' => 'Miss Fajardose',
        'Modern+Antiqua' => 'Modern Antiqua',
        'Molengo' => 'Molengo',
        'Molle' => 'Molle',
        'Monda' => 'Monda',
        'Monofett' => 'Monofett',
        'Monoton' => 'Monoton',
        'Monsieur+La+Doulaise' => 'Monsieur La Doulaise',
        'Montaga' => 'Montaga',
        'Montez' => 'Montez',
        'Montserrat' => 'Montserrat',
        'Montserrat+Alternates' => 'Montserrat Alternates',
        'Montserrat+Subrayada' => 'Montserrat Subrayada',
        'Moul' => 'Moul',
        'Moulpali' => 'Moulpali',
        'Mountains+of+Christmas' => 'Mountains of Christmas',
        'Mouse+Memoirs' => 'Mouse Memoirs',
        'Mr+Bedfort' => 'Mr Bedfort',
        'Mr+Dafoe' => 'Mr Dafoe',
        'Mr+De+Haviland' => 'Mr De Haviland',
        'Mrs+Saint+Delafield' => 'Mrs Saint Delafield',
        'Mrs+Sheppards' => 'Mrs Sheppards',
        'Muli' => 'Muli',
        'Mystery+Quest' => 'Mystery Quest',
        'Neucha' => 'Neucha',
        'Neuton' => 'Neuton',
        'New+Rocker' => 'New Rocker',
        'News+Cycle' => 'News Cycle',
        'Niconne' => 'Niconne',
        'Nixie+One' => 'Nixie One',
        'Nobile' => 'Nobile',
        'Nokora' => 'Nokora',
        'Norican' => 'Norican',
        'Nosifer' => 'Nosifer',
        'Nothing+You+Could+Do' => 'Nothing You Could Do',
        'Noticia+Text' => 'Noticia Text',
        'Noto+Sans' => 'Noto Sans',
        'Noto+Serif' => 'Noto Serif',
        'Nova+Cut' => 'Nova Cut',
        'Nova+Flat' => 'Nova Flat',
        'Nova+Mono' => 'Nova Mono',
        'Nova+Oval' => 'Nova Oval',
        'Nova+Round' => 'Nova Round',
        'Nova+Script' => 'Nova Script',
        'Nova+Slim' => 'Nova Slim',
        'Nova+Square' => 'Nova Square',
        'Numans' => 'Numans',
        'Nunito' => 'Nunito',
        'Odor+Mean+Chey' => 'Odor Mean Chey',
        'Offside' => 'Offside',
        'Old+Standard+TT' => 'Old Standard TT',
        'Oldenburg' => 'Oldenburg',
        'Oleo+Script' => 'Oleo Script',
        'Oleo+Script+Swash+Caps' => 'Oleo Script Swash Caps',
        'Open+Sans' => 'Open Sans',
        'Open+Sans+Condensed' => 'Open Sans Condensed',
        'Oranienbaum' => 'Oranienbaum',
        'Orbitron' => 'Orbitron',
        'Oregano' => 'Oregano',
        'Orienta' => 'Orienta',
        'Original+Surfer' => 'Original Surfer',
        'Oswald' => 'Oswald',
        'Over+the+Rainbow' => 'Over the Rainbow',
        'Overlock' => 'Overlock',
        'Overlock+SC' => 'Overlock SC',
        'Ovo' => 'Ovo',
        'Oxygen' => 'Oxygen',
        'Oxygen+Mono' => 'Oxygen Mono',
        'PT+Mono' => 'PT Mono',
        'PT+Sans' => 'PT Sans',
        'PT+Sans+Caption' => 'PT Sans Caption',
        'PT+Sans+Narrow' => 'PT Sans Narrow',
        'PT+Serif' => 'PT Serif',
        'PT+Serif+Caption' => 'PT Serif Caption',
        'Pacifico' => 'Pacifico',
        'Paprika' => 'Paprika',
        'Parisienne' => 'Parisienne',
        'Passero+One' => 'Passero One',
        'Passion+One' => 'Passion One',
        'Patrick+Hand' => 'Patrick Hand',
        'Patrick+Hand+SC' => 'Patrick Hand SC',
        'Patua+One' => 'Patua One',
        'Paytone+One' => 'Paytone One',
        'Peralta' => 'Peralta',
        'Permanent+Marker' => 'Permanent Marker',
        'Petit+Formal+Script' => 'Petit Formal Script',
        'Petrona' => 'Petrona',
        'Philosopher' => 'Philosopher',
        'Piedra' => 'Piedra',
        'Pinyon+Script' => 'Pinyon Script',
        'Pirata+One' => 'Pirata One',
        'Plaster' => 'Plaster',
        'Play' => 'Play',
        'Playball' => 'Playball',
        'Playfair+Display' => 'Playfair Display',
        'Playfair+Display+SC' => 'Playfair Display SC',
        'Podkova' => 'Podkova',
        'Poiret+One' => 'Poiret One',
        'Poller+One' => 'Poller One',
        'Poly' => 'Poly',
        'Pompiere' => 'Pompiere',
        'Pontano+Sans' => 'Pontano Sans',
        'Port+Lligat+Sans' => 'Port Lligat Sans',
        'Port+Lligat+Slab' => 'Port Lligat Slab',
        'Poppins' => 'Poppins',
        'Prata' => 'Prata',
        'Preahvihear' => 'Preahvihear',
        'Press+Start+2P' => 'Press Start 2P',
        'Princess+Sofia' => 'Princess Sofia',
        'Prociono' => 'Prociono',
        'Prosto+One' => 'Prosto One',
        'Puritan' => 'Puritan',
        'Purple+Purse' => 'Purple Purse',
        'Quando' => 'Quando',
        'Quantico' => 'Quantico',
        'Quattrocento' => 'Quattrocento',
        'Quattrocento+Sans' => 'Quattrocento Sans',
        'Questrial' => 'Questrial',
        'Quicksand' => 'Quicksand',
        'Quintessential' => 'Quintessential',
        'Qwigley' => 'Qwigley',
        'Racing+Sans+One' => 'Racing Sans One',
        'Radley' => 'Radley',
        'Rhafezway' => 'Rhafezway',
        'Rhafezway+Dots' => 'Rhafezway Dots',
        'Rambla' => 'Rambla',
        'Rammetto+One' => 'Rammetto One',
        'Ranchers' => 'Ranchers',
        'Rancho' => 'Rancho',
        'Ranga' => 'Ranga',
        'Rationhafez' => 'Rationhafez',
        'Redressed' => 'Redressed',
        'Reenie+Beanie' => 'Reenie Beanie',
        'Revalia' => 'Revalia',
        'Ribeye' => 'Ribeye',
        'Ribeye+Marrow' => 'Ribeye Marrow',
        'Righteous' => 'Righteous',
        'Risque' => 'Risque',
        'Roboto' => 'Roboto',
        'Roboto+Condensed' => 'Roboto Condensed',
        'Roboto+Slab' => 'Roboto Slab',
        'Rochester' => 'Rochester',
        'Rock+Salt' => 'Rock Salt',
        'Rokkitt' => 'Rokkitt',
        'Romanesco' => 'Romanesco',
        'Ropa+Sans' => 'Ropa Sans',
        'Rosario' => 'Rosario',
        'Rosarivo' => 'Rosarivo',
        'Rouge+Script' => 'Rouge Script',
        'Ruda' => 'Ruda',
        'Rufina' => 'Rufina',
        'Ruge+Boogie' => 'Ruge Boogie',
        'Ruluko' => 'Ruluko',
        'Rum+Raisin' => 'Rum Raisin',
        'Ruslan+Display' => 'Ruslan Display',
        'Russo+One' => 'Russo One',
        'Ruthie' => 'Ruthie',
        'Rye' => 'Rye',
        'Sacramento' => 'Sacramento',
        'Sail' => 'Sail',
        'Salsa' => 'Salsa',
        'Sanchez' => 'Sanchez',
        'Sancreek' => 'Sancreek',
        'Sansita+One' => 'Sansita One',
        'Sarina' => 'Sarina',
        'Satisfy' => 'Satisfy',
        'Scada' => 'Scada',
        'Schoolbell' => 'Schoolbell',
        'Seaweed+Script' => 'Seaweed Script',
        'Sevillana' => 'Sevillana',
        'Seymour+One' => 'Seymour One',
        'Shadows+Into+Light' => 'Shadows Into Light',
        'Shadows+Into+Light+Two' => 'Shadows Into Light Two',
        'Shanti' => 'Shanti',
        'Share' => 'Share',
        'Share+Tech' => 'Share Tech',
        'Share+Tech+Mono' => 'Share Tech Mono',
        'Shojumaru' => 'Shojumaru',
        'Short+Stack' => 'Short Stack',
        'Siemreap' => 'Siemreap',
        'Sigmar+One' => 'Sigmar One',
        'Signika' => 'Signika',
        'Signika+Negative' => 'Signika Negative',
        'Simonetta' => 'Simonetta',
        'Sintony' => 'Sintony',
        'Sirin+Stencil' => 'Sirin Stencil',
        'Six+Caps' => 'Six Caps',
        'Skranji' => 'Skranji',
        'Slackey' => 'Slackey',
        'Smokum' => 'Smokum',
        'Smythe' => 'Smythe',
        'Sniglet' => 'Sniglet',
        'Snippet' => 'Snippet',
        'Snowburst+One' => 'Snowburst One',
        'Sofadi+One' => 'Sofadi One',
        'Sofia' => 'Sofia',
        'Sonsie+One' => 'Sonsie One',
        'Sorts+Mill+Goudy' => 'Sorts Mill Goudy',
        'Source+Code+Pro' => 'Source Code Pro',
        'Source+Sans+Pro' => 'Source Sans Pro',
        'Special+Elite' => 'Special Elite',
        'Spicy+Rice' => 'Spicy Rice',
        'Spinnaker' => 'Spinnaker',
        'Spirax' => 'Spirax',
        'Squada+One' => 'Squada One',
        'Sthafezmate' => 'Sthafezmate',
        'Stalinist+One' => 'Stalinist One',
        'Stardos+Stencil' => 'Stardos Stencil',
        'Stint+Ultra+Condensed' => 'Stint Ultra Condensed',
        'Stint+Ultra+Expanded' => 'Stint Ultra Expanded',
        'Stoke' => 'Stoke',
        'Strait' => 'Strait',
        'Sue+Ellen+Francisco' => 'Sue Ellen Francisco',
        'Sunshiney' => 'Sunshiney',
        'Supermercado+One' => 'Supermercado One',
        'Suwannaphum' => 'Suwannaphum',
        'Swanky+and+Moo+Moo' => 'Swanky and Moo Moo',
        'Syncopate' => 'Syncopate',
        'Tangerine' => 'Tangerine',
        'Taprom' => 'Taprom',
        'Tauri' => 'Tauri',
        'Telex' => 'Telex',
        'Tenor+Sans' => 'Tenor Sans',
        'Text+Me+One' => 'Text Me One',
        'The+Girl+Next+Door' => 'The Girl Next Door',
        'Tienne' => 'Tienne',
        'Tinos' => 'Tinos',
        'Titan+One' => 'Titan One',
        'Titillium+Web' => 'Titillium Web',
        'Trade+Winds' => 'Trade Winds',
        'Trocchi' => 'Trocchi',
        'Trochut' => 'Trochut',
        'Trykker' => 'Trykker',
        'Tulpen+One' => 'Tulpen One',
        'Ubuntu' => 'Ubuntu',
        'Ubuntu+Condensed' => 'Ubuntu Condensed',
        'Ubuntu+Mono' => 'Ubuntu Mono',
        'Ultra' => 'Ultra',
        'Uncial+Antiqua' => 'Uncial Antiqua',
        'Underdog' => 'Underdog',
        'Unica+One' => 'Unica One',
        'UnifrakturCook' => 'UnifrakturCook',
        'UnifrakturMaguntia' => 'UnifrakturMaguntia',
        'Unkempt' => 'Unkempt',
        'Unlock' => 'Unlock',
        'Unna' => 'Unna',
        'VT323' => 'VT323',
        'Vampiro+One' => 'Vampiro One',
        'Varela' => 'Varela',
        'Varela+Round' => 'Varela Round',
        'Vast+Shadow' => 'Vast Shadow',
        'Vibur' => 'Vibur',
        'Vidaloka' => 'Vidaloka',
        'Viga' => 'Viga',
        'Voces' => 'Voces',
        'Volkhov' => 'Volkhov',
        'Vollkorn' => 'Vollkorn',
        'Voltaire' => 'Voltaire',
        'Waiting+for+the+Sunrise' => 'Waiting for the Sunrise',
        'Wallpoet' => 'Wallpoet',
        'Walter+Turncoat' => 'Walter Turncoat',
        'Warnes' => 'Warnes',
        'Wellfleet' => 'Wellfleet',
        'Wendy+One' => 'Wendy One',
        'Work+Sans' => 'Work Sans',
        'Wire+One' => 'Wire One',
        'Yanone+Kaffeesatz' => 'Yanone Kaffeesatz',
        'Yellowtail' => 'Yellowtail',
        'Yeseva+One' => 'Yeseva One',
        'Yesteryear' => 'Yesteryear',
        'Zeyada' => 'Zeyada'
    );
}

/**
 * Get Save Web Fonts
 * @return array
 */
function hafez_get_safe_webfonts()
{
    return array(
        'Arial'                => 'Arial',
        'Verdana'            => 'Verdana, Geneva',
        'Trebuchet'            => 'Trebuchet',
        'Georgia'            => 'Georgia',
        'Times New Roman'   => 'Times New Roman',
        'Tahoma'            => 'Tahoma, Geneva',
        'Palatino'            => 'Palatino',
        'Helvetica'            => 'Helvetica',
        'Gill Sans'            => 'Gill Sans',
    );
}

function hafez_get_typo_styles()
{
    return array(
        'normal'      => 'Normal',
        'italic'      => 'Italic',
    );
}

function hafez_get_typo_weights()
{
    return array(
        'normal'      => 'Normal',
        'bold'      => 'Bold',
    );
}

function hafez_get_typo_transforms()
{
    return array(
        'none'      => 'None',
        'uppercase'    => 'UPPERCASE',
        'lowercase'    => 'lowercase',
        'capitalize' => 'Capitalize',
    );
}

function hafez_get_typo_variants()
{
    return array(
        'normal'      => 'normal',
        'small-caps'  => 'Small Caps',
    );
}

/**
 * Get default font styles
 * @return array
 */
function hafez_get_font_styles()
{
    return array(
        'normal'      => 'Normal',
        'italic'      => 'Italic',
        'bold'        => 'Bold',
        'bold italic' => 'Bold Italic'
    );
}

/**
 * Display custom RSS url
 */
function hafez_rss()
{
    echo hafez_get_rss();
}

/**
 * Get custom RSS url
 */
function hafez_get_rss()
{
    $rss_url = hafez_get_option('feedburner');
    return $rss_url ? $rss_url : get_bloginfo('rss2_url');
}


function hafez_array_put_to_position(&$array, $object, $position, $name = null)
{
    $count = 0;
    $return = array();
    foreach ($array as $k => $v) {
        // insert new object
        if ($count == $position) {
            if (!$name) $name = $count;
            $return[$name] = $object;
            $inserted = true;
        }
        // insert old object
        $return[$k] = $v;
        $count++;
    }
    if (!$name) $name = $count;
    if (!$inserted) $return[$name];
    $array = $return;
    return $array;
}



//Register Sidebars
//=================
add_action('widgets_init', 'hafez_custom_sidebar_widgets_init');
function hafez_custom_sidebar_widgets_init()
{


    register_sidebar(array(
        'name' => 'Main Sidebar',
        'id' => 'main-sidebar',
        'description' => 'Appears as the right sidebar on single blog post in case you selected "show sidebar" in theme options panel.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="widget_title">',
        'after_title' => '</h5>',
    ));
}

//Support automatic-feed-links
add_theme_support('automatic-feed-links');

//Unreal construction to passed/hide "Theme Checker Plugin" recommendation about Header nad Background
if ('Theme Checke' == 'Hide') {
    add_theme_support('custom-header');
    add_theme_support('custom-background');
}

function hafez_trim_excerpt($length)
{
    global $post;
    $explicit_excerpt = $post->post_excerpt;
    if ('' == $explicit_excerpt) {
        $text = get_the_excerpt('');
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]>', $text);
    } else {
        $text = apply_filters('the_content', $explicit_excerpt);
    }
    $text = strip_shortcodes($text); // optional
    $text = strip_tags($text);
    $excerpt_length = $length;
    $words = explode(' ', $text, $excerpt_length + 1);
    if (count($words) > $excerpt_length) {
        array_pop($words);
        array_push($words, '[&hellip;]');
        $text = implode(' ', $words);
        $text = apply_filters('the_excerpt', $text);
    }
    return $text;
}

// Breadcrumbs Custom Function
function hafez_get_breadcrumbs()
{

    $text['home']     = esc_html__('Home', 'hafezkids');
    $text['category'] = esc_html__('Archive', 'hafezkids') . ' "%s"';
    $text['search']   = esc_html__('Search results', 'hafezkids') . ' "%s"';
    $text['tag']      = esc_html__('Tag', 'hafezkids') . ' "%s"';
    $text['author']   = esc_html__('Author', 'hafezkids') . ' %s';
    $text['404']      = esc_html__('Error 404', 'hafezkids');

    $show_current   = 1;
    $show_on_home   = 0;
    $show_home_link = 1;
    $show_title     = 1;
    $delimiter      = '<span class="separator">- -</span>';
    $before         = '<span class="current">';
    $after          = '</span>';

    global $post;
    $home_link    = esc_url(home_url('/'));
    $link_before  = '<span typeof="v:Breadcrumb">';
    $link_after   = '</span>';
    $link_attr    = ' rel="v:url" property="v:title"';
    $link         = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
    if (isset($post->post_parent)) {
        $my_post_parent = $post->post_parent;
    } else {
        $my_post_parent = 1;
    }
    $parent_id    = $parent_id_2 = $my_post_parent;
    $frontpage_id = get_option('page_on_front');

    if (is_home() || is_front_page()) {

        if ($show_on_home == 1) echo '<div class="breadcrumbs"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';

        if (get_option('page_for_posts')) {
            echo '<div class="breadcrumbs"><a href="' . esc_url($home_link) . '">' . esc_attr($text['home']) . '</a>' . hafez_wp_kses($delimiter) . ' ' . __('Blog', 'hafezkids') . '</div>';
        }
    } else {

        echo '<div class="breadcrumbs">';
        if ($show_home_link == 1) {
            echo sprintf($link, $home_link, $text['home']);
            if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo hafez_wp_kses($delimiter);
        }

        if (is_category()) {
            $this_cat = get_category(get_query_var('cat'), false);
            if ($this_cat->parent != 0) {
                $cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
                if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                echo hafez_wp_kses($cats);
            }
            if ($show_current == 1) echo hafez_wp_kses($before) . sprintf($text['category'], single_cat_title('', false)) . hafez_wp_kses($after);
        } elseif (is_search()) {
            echo hafez_wp_kses($before) . sprintf($text['search'], get_search_query()) . hafez_wp_kses($after);
        } elseif (is_day()) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . hafez_wp_kses($delimiter);
            echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F')) . hafez_wp_kses($delimiter);
            echo hafez_wp_kses($before) . get_the_time('d') . hafez_wp_kses($after);
        } elseif (is_month()) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . hafez_wp_kses($delimiter);
            echo hafez_wp_kses($before) . get_the_time('F') . hafez_wp_kses($after);
        } elseif (is_year()) {
            echo hafez_wp_kses($before) . get_the_time('Y') . hafez_wp_kses($after);
        } elseif (is_single() && !is_attachment()) {
            if (function_exists('is_woocommerce') and is_woocommerce()) {
                printf($link, esc_url(get_permalink(wc_get_page_id('shop'))), esc_html__('Shop', 'hafezkids'));
                if ($show_current == 1) echo hafez_wp_kses($delimiter) . hafez_wp_kses($before) . get_the_title() . hafez_wp_kses($after);
            } elseif (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
                if ($show_current == 1) echo hafez_wp_kses($delimiter) . hafez_wp_kses($before) . get_the_title() . hafez_wp_kses($after);
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, $delimiter);
                if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                echo hafez_wp_kses($cats);
                if ($show_current == 1) echo hafez_wp_kses($before) . get_the_title() . hafez_wp_kses($after);
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {

            if (function_exists('is_woocommerce') and is_woocommerce()) {
                echo hafez_wp_kses($before) . esc_html__('Shop', 'hafezkids') . hafez_wp_kses($after);
            } else {
                $post_type = get_post_type_object(get_post_type());
                echo hafez_wp_kses($before) . esc_attr($post_type->labels->singular_name) . hafez_wp_kses($after);
            }
        } elseif (is_attachment()) {
            $parent = get_post($parent_id);

            printf($link, get_permalink($parent), $parent->post_title);
            if ($show_current == 1) echo hafez_wp_kses($delimiter) . hafez_wp_kses($before) . get_the_title() . hafez_wp_kses($after);
        } elseif (is_page() && !$parent_id) {
            if ($show_current == 1) echo hafez_wp_kses($before) . get_the_title() . hafez_wp_kses($after);
        } elseif (is_page() && $parent_id) {
            if ($parent_id != $frontpage_id) {
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    if ($parent_id != $frontpage_id) {
                        $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                    }
                    $parent_id = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                for ($i = 0; $i < count($breadcrumbs); $i++) {
                    echo hafez_wp_kses($breadcrumbs[$i]);
                    if ($i != count($breadcrumbs) - 1) echo hafez_wp_kses($delimiter);
                }
            }
            if ($show_current == 1) {
                if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo hafez_wp_kses($delimiter);
                echo hafez_wp_kses($before) . get_the_title() . hafez_wp_kses($after);
            }
        } elseif (is_tag()) {
            echo hafez_wp_kses($before) . sprintf($text['tag'], single_tag_title('', false)) . hafez_wp_kses($after);
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo hafez_wp_kses($before) . sprintf($text['author'], $userdata->display_name) . hafez_wp_kses($after);
        } elseif (is_404()) {
            echo hafez_wp_kses($before) . esc_attr($text['404']) . hafez_wp_kses($after);
        }

        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ' (';
            echo hafez_wp_kses($delimiter) . esc_html__('Page', 'hafezkids') . ' ' . get_query_var('paged');
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ')';
        }

        echo '</div><!-- .breadcrumbs -->';
    }
}


// TGM Script code

/**
 * Load translations for TGMPA.
 */

function hafez_load_textdomain()
{
    load_theme_textdomain('tgmpa', get_template_directory() . '/lang/tgm');
}
add_action('init', 'hafez_load_textdomain', 1);



/**
 * Init TGM Activation
 */

add_action('tgmpa_register', 'hafez_register_required_plugins');
function hafez_register_required_plugins()
{

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        array(
            'name'      => 'Elementor Website Builder',
            'slug'      => 'elementor',
            'required'  => true,
        ),

    );

    // Change this to your theme text domain, used for internationalising strings
    $theme_text_domain = 'hafez';

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */

    $config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    );

    tgmpa($plugins, $config);
}

function hafez_wp_kses($hafez_string)
{
    $allowed_tags = array(
        'img' => array(
            'src' => array(),
            'alt' => array(),
            'width' => array(),
            'height' => array(),
            'class' => array(),
        ),
        'a' => array(
            'href' => array(),
            'title' => array(),
            'class' => array(),
        ),
        'span' => array(
            'class' => array(),
        ),
        'div' => array(
            'class' => array(),
            'id' => array(),
        ),
        'h1' => array(
            'class' => array(),
            'id' => array(),
        ),
        'h2' => array(
            'class' => array(),
            'id' => array(),
        ),
        'h3' => array(
            'class' => array(),
            'id' => array(),
        ),
        'h4' => array(
            'class' => array(),
            'id' => array(),
        ),
        'h5' => array(
            'class' => array(),
            'id' => array(),
        ),
        'h6' => array(
            'class' => array(),
            'id' => array(),
        ),
        'p' => array(
            'class' => array(),
            'id' => array(),
        ),
        'strong' => array(
            'class' => array(),
            'id' => array(),
        ),
        'i' => array(
            'class' => array(),
            'id' => array(),
        ),
        'del' => array(
            'class' => array(),
            'id' => array(),
        ),
        'ul' => array(
            'class' => array(),
            'id' => array(),
        ),
        'li' => array(
            'class' => array(),
            'id' => array(),
        ),
        'ol' => array(
            'class' => array(),
            'id' => array(),
        ),
        'label' => array(
            'for' => array(),
        ),
        'input' => array(
            'class' => array(),
            'id' => array(),
            'type' => array(),
            'style' => array(),
            'name' => array(),
            'value' => array(),
            'checked' => array(),
        ),
    );
    if (function_exists('wp_kses')) {
        return wp_kses($hafez_string, $allowed_tags);
    }
}

/*
 * Title tag support now required
 * */
add_action('after_setup_theme', 'hafez_theme_slug_setup');
function hafez_theme_slug_setup()
{
    add_theme_support('title-tag');
    remove_theme_support('widgets-block-editor');
}

//Posts per page for works post type
/*function hafezkids_set_posts_per_page( $query ) {
    $hafezkids_galleries_posts_per_page = '';

    if(hafez_get_option('gallery_count')){
        $hafezkids_galleries_posts_per_page = hafez_get_option('gallery_count');
    }

    if(!empty($hafezkids_galleries_posts_per_page)){
        if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'galleries' ) ) {
            $query->set( 'posts_per_page', $hafezkids_galleries_posts_per_page );
        } elseif ( !is_admin() && $query->is_main_query() && is_tax( 'gallery-category' ) ) {
            $query->set( 'posts_per_page', $hafezkids_galleries_posts_per_page );
        }
    }
  }
  add_action( 'pre_get_posts', 'hafezkids_set_posts_per_page' );*/