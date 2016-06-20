<?php

if ( ! function_exists( 'themovation_so_wb_glyphicons' ) ) :
// Adding glyphicons to the icon field
function themovation_so_wb_glyphicons( $icon_families ) {
	$icon_families['glyphicons'] = array(
		'name' => __( 'Glyphicons Regular', 'themovation-widgets' ),
		'style_uri' => plugin_dir_url(__FILE__) . '../assets/glyphicons/style.css',
		'icons' => array(
			'glass' =>'&#xe001;',
			'leaf' =>'&#xe002;',
			'dog' =>'&#xe003;',
			'user' =>'&#xe004;',
			'girl' =>'&#xe005;',
			'car' =>'&#xe006;',
			'user-add' =>'&#xe007;',
			'user-remove' =>'&#xe008;',
			'film' =>'&#xe009;',
			'magic' =>'&#xe010;',
			'envelope' =>'&#xe011;',
			'camera' =>'&#xe012;',
			'heart' =>'&#xe013;',
			'beach-umbrella' =>'&#xe014;',
			'train' =>'&#xe015;',
			'print' =>'&#xe016;',
			'bin' =>'&#xe017;',
			'music' =>'&#xe018;',
			'music-alt' =>'&#xe019;',
			'heart-empty' =>'&#xe020;',
			'home' =>'&#xe021;',
			'snowflake' =>'&#xe022;',
			'fire' =>'&#xe023;',
			'magnet' =>'&#xe024;',
			'parents' =>'&#xe025;',
			'binoculars' =>'&#xe026;',
			'road' =>'&#xe027;',
			'search' =>'&#xe028;',
			'cars' =>'&#xe029;',
			'notes-2' =>'&#xe030;',
			'pencil' =>'&#xe031;',
			'bus' =>'&#xe032;',
			'wifi-alt' =>'&#xe033;',
			'luggage' =>'&#xe034;',
			'old-man' =>'&#xe035;',
			'woman' =>'&#xe036;',
			'file' =>'&#xe037;',
			'coins' =>'&#xe038;',
			'plane' =>'&#xe039;',
			'notes' =>'&#xe040;',
			'stats' =>'&#xe041;',
			'charts' =>'&#xe042;',
			'pie-chart' =>'&#xe043;',
			'group' =>'&#xe044;',
			'keys' =>'&#xe045;',
			'calendar' =>'&#xe046;',
			'router' =>'&#xe047;',
			'camera-small' =>'&#xe048;',
			'star-empty' =>'&#xe049;',
			'star' =>'&#xe050;',
			'link' =>'&#xe051;',
			'eye-open' =>'&#xe052;',
			'eye-close' =>'&#xe053;',
			'alarm' =>'&#xe054;',
			'clock' =>'&#xe055;',
			'stopwatch' =>'&#xe056;',
			'projector' =>'&#xe057;',
			'history' =>'&#xe058;',
			'truck' =>'&#xe059;',
			'cargo' =>'&#xe060;',
			'compass' =>'&#xe061;',
			'keynote' =>'&#xe062;',
			'paperclip' =>'&#xe063;',
			'power' =>'&#xe064;',
			'lightbulb' =>'&#xe065;',
			'tag' =>'&#xe066;',
			'tags' =>'&#xe067;',
			'cleaning' =>'&#xe068;',
			'ruler' =>'&#xe069;',
			'gift' =>'&#xe070;',
			'umbrella' =>'&#xe071;',
			'book' =>'&#xe072;',
			'bookmark' =>'&#xe073;',
			'wifi' =>'&#xe074;',
			'cup' =>'&#xe075;',
			'stroller' =>'&#xe076;',
			'headphones' =>'&#xe077;',
			'headset' =>'&#xe078;',
			'warning-sign' =>'&#xe079;',
			'signal' =>'&#xe080;',
			'retweet' =>'&#xe081;',
			'refresh' =>'&#xe082;',
			'roundabout' =>'&#xe083;',
			'random' =>'&#xe084;',
			'heat' =>'&#xe085;',
			'repeat' =>'&#xe086;',
			'display' =>'&#xe087;',
			'log-book' =>'&#xe088;',
			'address-book' =>'&#xe089;',
			'building' =>'&#xe090;',
			'eyedropper' =>'&#xe091;',
			'adjust' =>'&#xe092;',
			'tint' =>'&#xe093;',
			'crop' =>'&#xe094;',
			'vector-path-square' =>'&#xe095;',
			'vector-path-circle' =>'&#xe096;',
			'vector-path-polygon' =>'&#xe097;',
			'vector-path-line' =>'&#xe098;',
			'vector-path-curve' =>'&#xe099;',
			'vector-path-all' =>'&#xe100;',
			'font' =>'&#xe101;',
			'italic' =>'&#xe102;',
			'bold' =>'&#xe103;',
			'text-underline' =>'&#xe104;',
			'text-strike' =>'&#xe105;',
			'text-height' =>'&#xe106;',
			'text-width' =>'&#xe107;',
			'text-resize' =>'&#xe108;',
			'left-indent' =>'&#xe109;',
			'right-indent' =>'&#xe110;',
			'align-left' =>'&#xe111;',
			'align-center' =>'&#xe112;',
			'align-right' =>'&#xe113;',
			'justify' =>'&#xe114;',
			'list' =>'&#xe115;',
			'text-smaller' =>'&#xe116;',
			'text-bigger' =>'&#xe117;',
			'embed' =>'&#xe118;',
			'embed-close' =>'&#xe119;',
			'table' =>'&#xe120;',
			'message-full' =>'&#xe121;',
			'message-empty' =>'&#xe122;',
			'message-in' =>'&#xe123;',
			'message-out' =>'&#xe124;',
			'message-plus' =>'&#xe125;',
			'message-minus' =>'&#xe126;',
			'message-ban' =>'&#xe127;',
			'message-flag' =>'&#xe128;',
			'message-lock' =>'&#xe129;',
			'message-new' =>'&#xe130;',
			'inbox' =>'&#xe131;',
			'inbox-plus' =>'&#xe132;',
			'inbox-minus' =>'&#xe133;',
			'inbox-lock' =>'&#xe134;',
			'inbox-in' =>'&#xe135;',
			'inbox-out' =>'&#xe136;',
			'cogwheel' =>'&#xe137;',
			'cogwheels' =>'&#xe138;',
			'picture' =>'&#xe139;',
			'adjust-alt' =>'&#xe140;',
			'database-lock' =>'&#xe141;',
			'database-plus' =>'&#xe142;',
			'database-minus' =>'&#xe143;',
			'database-ban' =>'&#xe144;',
			'folder-open' =>'&#xe145;',
			'folder-plus' =>'&#xe146;',
			'folder-minus' =>'&#xe147;',
			'folder-lock' =>'&#xe148;',
			'folder-flag' =>'&#xe149;',
			'folder-new' =>'&#xe150;',
			'edit' =>'&#xe151;',
			'new-window' =>'&#xe152;',
			'check' =>'&#xe153;',
			'unchecked' =>'&#xe154;',
			'more-windows' =>'&#xe155;',
			'show-big-thumbnails' =>'&#xe156;',
			'show-thumbnails' =>'&#xe157;',
			'show-thumbnails-with-lines' =>'&#xe158;',
			'show-lines' =>'&#xe159;',
			'playlist' =>'&#xe160;',
			'imac' =>'&#xe161;',
			'macbook' =>'&#xe162;',
			'ipad' =>'&#xe163;',
			'iphone' =>'&#xe164;',
			'iphone-transfer' =>'&#xe165;',
			'iphone-exchange' =>'&#xe166;',
			'ipod' =>'&#xe167;',
			'ipod-shuffle' =>'&#xe168;',
			'ear-plugs' =>'&#xe169;',
			'record' =>'&#xe170;',
			'step-backward' =>'&#xe171;',
			'fast-backward' =>'&#xe172;',
			'rewind' =>'&#xe173;',
			'play' =>'&#xe174;',
			'pause' =>'&#xe175;',
			'stop' =>'&#xe176;',
			'forward' =>'&#xe177;',
			'fast-forward' =>'&#xe178;',
			'step-forward' =>'&#xe179;',
			'eject' =>'&#xe180;',
			'facetime-video' =>'&#xe181;',
			'download-alt' =>'&#xe182;',
			'mute' =>'&#xe183;',
			'volume-down' =>'&#xe184;',
			'volume-up' =>'&#xe185;',
			'screenshot' =>'&#xe186;',
			'move' =>'&#xe187;',
			'more' =>'&#xe188;',
			'brightness-reduce' =>'&#xe189;',
			'brightness-increase' =>'&#xe190;',
			'plus-sign' =>'&#xe191;',
			'minus-sign' =>'&#xe192;',
			'remove-sign' =>'&#xe193;',
			'ok-sign' =>'&#xe194;',
			'question-sign' =>'&#xe195;',
			'info-sign' =>'&#xe196;',
			'exclamation-sign' =>'&#xe197;',
			'remove-circle' =>'&#xe198;',
			'ok-circle' =>'&#xe199;',
			'ban-circle' =>'&#xe200;',
			'download' =>'&#xe201;',
			'upload' =>'&#xe202;',
			'shopping-cart' =>'&#xe203;',
			'lock' =>'&#xe204;',
			'unlock' =>'&#xe205;',
			'electricity' =>'&#xe206;',
			'ok' =>'&#xe207;',
			'remove' =>'&#xe208;',
			'cart-in' =>'&#xe209;',
			'cart-out' =>'&#xe210;',
			'arrow-left' =>'&#xe211;',
			'arrow-right' =>'&#xe212;',
			'arrow-down' =>'&#xe213;',
			'arrow-up' =>'&#xe214;',
			'resize-small' =>'&#xe215;',
			'resize-full' =>'&#xe216;',
			'circle-arrow-left' =>'&#xe217;',
			'circle-arrow-right' =>'&#xe218;',
			'circle-arrow-top' =>'&#xe219;',
			'circle-arrow-down' =>'&#xe220;',
			'play-button' =>'&#xe221;',
			'unshare' =>'&#xe222;',
			'share' =>'&#xe223;',
			'chevron-right' =>'&#xe224;',
			'chevron-left' =>'&#xe225;',
			'bluetooth' =>'&#xe226;',
			'euro' =>'&#xe227;',
			'usd' =>'&#xe228;',
			'gbp' =>'&#xe229;',
			'retweet-2' =>'&#xe230;',
			'moon' =>'&#xe231;',
			'sun' =>'&#xe232;',
			'cloud' =>'&#xe233;',
			'direction' =>'&#xe234;',
			'brush' =>'&#xe235;',
			'pen' =>'&#xe236;',
			'zoom-in' =>'&#xe237;',
			'zoom-out' =>'&#xe238;',
			'pin' =>'&#xe239;',
			'albums' =>'&#xe240;',
			'rotation-lock' =>'&#xe241;',
			'flash' =>'&#xe242;',
			'map-marker' =>'&#xe243;',
			'anchor' =>'&#xe244;',
			'conversation' =>'&#xe245;',
			'chat' =>'&#xe246;',
			'note-empty' =>'&#xe247;',
			'note' =>'&#xe248;',
			'asterisk' =>'&#xe249;',
			'divide' =>'&#xe250;',
			'snorkel-diving' =>'&#xe251;',
			'scuba-diving' =>'&#xe252;',
			'oxygen-bottle' =>'&#xe253;',
			'fins' =>'&#xe254;',
			'fishes' =>'&#xe255;',
			'boat' =>'&#xe256;',
			'delete' =>'&#xe257;',
			'sheriffs-star' =>'&#xe258;',
			'qrcode' =>'&#xe259;',
			'barcode' =>'&#xe260;',
			'pool' =>'&#xe261;',
			'buoy' =>'&#xe262;',
			'spade' =>'&#xe263;',
			'bank' =>'&#xe264;',
			'vcard' =>'&#xe265;',
			'electrical-plug' =>'&#xe266;',
			'flag' =>'&#xe267;',
			'credit-card' =>'&#xe268;',
			'keyboard-wireless' =>'&#xe269;',
			'keyboard-wired' =>'&#xe270;',
			'shield' =>'&#xe271;',
			'ring' =>'&#xe272;',
			'cake' =>'&#xe273;',
			'drink' =>'&#xe274;',
			'beer' =>'&#xe275;',
			'fast-food' =>'&#xe276;',
			'cutlery' =>'&#xe277;',
			'pizza' =>'&#xe278;',
			'birthday-cake' =>'&#xe279;',
			'tablet' =>'&#xe280;',
			'settings' =>'&#xe281;',
			'bullets' =>'&#xe282;',
			'cardio' =>'&#xe283;',
			't-shirt' =>'&#xe284;',
			'pants' =>'&#xe285;',
			'sweater' =>'&#xe286;',
			'fabric' =>'&#xe287;',
			'leather' =>'&#xe288;',
			'scissors' =>'&#xe289;',
			'bomb' =>'&#xe290;',
			'skull' =>'&#xe291;',
			'celebration' =>'&#xe292;',
			'tea-kettle' =>'&#xe293;',
			'french-press' =>'&#xe294;',
			'coffee-cup' =>'&#xe295;',
			'pot' =>'&#xe296;',
			'grater' =>'&#xe297;',
			'kettle' =>'&#xe298;',
			'hospital' =>'&#xe299;',
			'hospital-h' =>'&#xe300;',
			'microphone' =>'&#xe301;',
			'webcam' =>'&#xe302;',
			'temple-christianity-church' =>'&#xe303;',
			'temple-islam' =>'&#xe304;',
			'temple-hindu' =>'&#xe305;',
			'temple-buddhist' =>'&#xe306;',
			'bicycle' =>'&#xe307;',
			'life-preserver' =>'&#xe308;',
			'share-alt' =>'&#xe309;',
			'comments' =>'&#xe310;',
			'flower' =>'&#xe311;',
			'baseball' =>'&#xe312;',
			'rugby' =>'&#xe313;',
			'ax' =>'&#xe314;',
			'table-tennis' =>'&#xe315;',
			'bowling' =>'&#xe316;',
			'tree-conifer' =>'&#xe317;',
			'tree-deciduous' =>'&#xe318;',
			'more-items' =>'&#xe319;',
			'sort' =>'&#xe320;',
			'filter' =>'&#xe321;',
			'gamepad' =>'&#xe322;',
			'playing-dices' =>'&#xe323;',
			'calculator' =>'&#xe324;',
			'tie' =>'&#xe325;',
			'wallet' =>'&#xe326;',
			'piano' =>'&#xe327;',
			'sampler' =>'&#xe328;',
			'podium' =>'&#xe329;',
			'soccer-ball' =>'&#xe330;',
			'blog' =>'&#xe331;',
			'dashboard' =>'&#xe332;',
			'certificate' =>'&#xe333;',
			'bell' =>'&#xe334;',
			'candle' =>'&#xe335;',
			'pushpin' =>'&#xe336;',
			'iphone-shake' =>'&#xe337;',
			'pin-flag' =>'&#xe338;',
			'turtle' =>'&#xe339;',
			'rabbit' =>'&#xe340;',
			'globe' =>'&#xe341;',
			'briefcase' =>'&#xe342;',
			'hdd' =>'&#xe343;',
			'thumbs-up' =>'&#xe344;',
			'thumbs-down' =>'&#xe345;',
			'hand-right' =>'&#xe346;',
			'hand-left' =>'&#xe347;',
			'hand-up' =>'&#xe348;',
			'hand-down' =>'&#xe349;',
			'fullscreen' =>'&#xe350;',
			'shopping-bag' =>'&#xe351;',
			'book-open' =>'&#xe352;',
			'nameplate' =>'&#xe353;',
			'nameplate-alt' =>'&#xe354;',
			'vases' =>'&#xe355;',
			'bullhorn' =>'&#xe356;',
			'dumbbell' =>'&#xe357;',
			'suitcase' =>'&#xe358;',
			'file-import' =>'&#xe359;',
			'file-export' =>'&#xe360;',
			'bug' =>'&#xe361;',
			'crown' =>'&#xe362;',
			'smoking' =>'&#xe363;',
			'cloud-upload' =>'&#xe364;',
			'cloud-download' =>'&#xe365;',
			'restart' =>'&#xe366;',
			'security-camera' =>'&#xe367;',
			'expand' =>'&#xe368;',
			'collapse' =>'&#xe369;',
			'collapse-top' =>'&#xe370;',
			'globe-af' =>'&#xe371;',
			'global' =>'&#xe372;',
			'spray' =>'&#xe373;',
			'nails' =>'&#xe374;',
			'claw-hammer' =>'&#xe375;',
			'classic-hammer' =>'&#xe376;',
			'hand-saw' =>'&#xe377;',
			'riflescope' =>'&#xe378;',
			'electrical-socket-eu' =>'&#xe379;',
			'electrical-socket-us' =>'&#xe380;',
			'message-forward' =>'&#xe381;',
			'coat-hanger' =>'&#xe382;',
			'dress' =>'&#xe383;',
			'bathrobe' =>'&#xe384;',
			'shirt' =>'&#xe385;',
			'underwear' =>'&#xe386;',
			'log-in' =>'&#xe387;',
			'log-out' =>'&#xe388;',
			'exit' =>'&#xe389;',
			'new-window-alt' =>'&#xe390;',
			'video-sd' =>'&#xe391;',
			'video-hd' =>'&#xe392;',
			'subtitles' =>'&#xe393;',
			'sound-stereo' =>'&#xe394;',
			'sound-dolby' =>'&#xe395;',
			'sound-5-1' =>'&#xe396;',
			'sound-6-1' =>'&#xe397;',
			'sound-7-1' =>'&#xe398;',
			'copyright-mark' =>'&#xe399;',
			'registration-mark' =>'&#xe400;',
			'radar' =>'&#xe401;',
			'skateboard' =>'&#xe402;',
			'golf-course' =>'&#xe403;',
			'sorting' =>'&#xe404;',
			'sort-by-alphabet' =>'&#xe405;',
			'sort-by-alphabet-alt' =>'&#xe406;',
			'sort-by-order' =>'&#xe407;',
			'sort-by-order-alt' =>'&#xe408;',
			'sort-by-attributes' =>'&#xe409;',
			'sort-by-attributes-alt' =>'&#xe410;',
			'compressed' =>'&#xe411;',
			'package' =>'&#xe412;',
			'cloud-plus' =>'&#xe413;',
			'cloud-minus' =>'&#xe414;',
			'disk-save' =>'&#xe415;',
			'disk-open' =>'&#xe416;',
			'disk-saved' =>'&#xe417;',
			'disk-remove' =>'&#xe418;',
			'disk-import' =>'&#xe419;',
			'disk-export' =>'&#xe420;',
			'tower' =>'&#xe421;',
			'send' =>'&#xe422;',
			'git-branch' =>'&#xe423;',
			'git-create' =>'&#xe424;',
			'git-private' =>'&#xe425;',
			'git-delete' =>'&#xe426;',
			'git-merge' =>'&#xe427;',
			'git-pull-request' =>'&#xe428;',
			'git-compare' =>'&#xe429;',
			'git-commit' =>'&#xe430;',
			'construction-cone' =>'&#xe431;',
			'shoe-steps' =>'&#xe432;',
			'plus' =>'&#xe433;',
			'minus' =>'&#xe434;',
			'redo' =>'&#xe435;',
			'undo' =>'&#xe436;',
			'golf' =>'&#xe437;',
			'hockey' =>'&#xe438;',
			'pipe' =>'&#xe439;',
			'wrench' =>'&#xe440;',
			'folder-closed' =>'&#xe441;',
			'phone-alt' =>'&#xe442;',
			'earphone' =>'&#xe443;',
			'floppy-disk' =>'&#xe444;',
			'floppy-saved' =>'&#xe445;',
			'floppy-remove' =>'&#xe446;',
			'floppy-save' =>'&#xe447;',
			'floppy-open' =>'&#xe448;',
			'translate' =>'&#xe449;',
			'fax' =>'&#xe450;',
			'factory' =>'&#xe451;',
			'shop-window' =>'&#xe452;',
			'shop' =>'&#xe453;',
			'kiosk' =>'&#xe454;',
			'kiosk-wheels' =>'&#xe455;',
			'kiosk-light' =>'&#xe456;',
			'kiosk-food' =>'&#xe457;',
			'transfer' =>'&#xe458;',
			'money' =>'&#xe459;',
			'header' =>'&#xe460;',
			'blacksmith' =>'&#xe461;',
			'saw-blade' =>'&#xe462;',
			'basketball' =>'&#xe463;',
			'server' =>'&#xe464;',
			'server-plus' =>'&#xe465;',
			'server-minus' =>'&#xe466;',
			'server-ban' =>'&#xe467;',
			'server-flag' =>'&#xe468;',
			'server-lock' =>'&#xe469;',
			'server-new' =>'&#xe470;',
			'charging-station' =>'&#xe471;',
			'gas-station' =>'&#xe472;',
			'target' =>'&#xe473;',
			'bed' =>'&#xe474;',
			'mosquito' =>'&#xe475;',
			'dining-set' =>'&#xe476;',
			'plate-of-food' =>'&#xe477;',
			'hygiene-kit' =>'&#xe478;',
			'blackboard' =>'&#xe479;',
			'marriage' =>'&#xe480;',
			'bucket' =>'&#xe481;',
			'none-color-swatch' =>'&#xe482;',
			'bring-forward' =>'&#xe483;',
			'bring-to-front' =>'&#xe484;',
			'send-backward' =>'&#xe485;',
			'send-to-back' =>'&#xe486;',
			'fit-frame-to-image' =>'&#xe487;',
			'fit-image-to-frame' =>'&#xe488;',
			'multiple-displays' =>'&#xe489;',
			'handshake' =>'&#xe490;',
			'child' =>'&#xe491;',
			'baby-formula' =>'&#xe492;',
			'medicine' =>'&#xe493;',
			'atv-vehicle' =>'&#xe494;',
			'motorcycle' =>'&#xe495;',
			'bed-alt' =>'&#xe496;',
			'tent' =>'&#xe497;',
			'glasses' =>'&#xe498;',
			'sunglasses' =>'&#xe499;',
			'family' =>'&#xe500;',
			'education' =>'&#xe501;',
			'shoes' =>'&#xe502;',
			'map' =>'&#xe503;',
			'cd' =>'&#xe504;',
			'alert' =>'&#xe505;',
			'piggy-bank' =>'&#xe506;',
			'star-half' =>'&#xe507;',
			'cluster' =>'&#xe508;',
			'flowchart' =>'&#xe509;',
			'commodities' =>'&#xe510;',
			'duplicate' =>'&#xe511;',
			'copy' =>'&#xe512;',
			'paste' =>'&#xe513;',
			'bath-bathtub' =>'&#xe514;',
			'bath-shower' =>'&#xe515;',
			'shower' =>'&#xe516;',
			'menu-hamburger' =>'&#xe517;',
			'option-vertical' =>'&#xe518;',
			'option-horizontal' =>'&#xe519;',
			'currency-conversion' =>'&#xe520;',
			'user-ban' =>'&#xe521;',
			'user-lock' =>'&#xe522;',
			'user-flag' =>'&#xe523;',
			'user-asterisk' =>'&#xe524;',
			'user-alert' =>'&#xe525;',
			'user-key' =>'&#xe526;',
			'user-conversation' =>'&#xe527;',
			'database' =>'&#xe528;',
			'database-search' =>'&#xe529;',
			'list-alt' =>'&#xe530;',
			'hazard-sign' =>'&#xe531;',
			'hazard' =>'&#xe532;',
			'stop-sign' =>'&#xe533;',
			'lab' =>'&#xe534;',
			'lab-alt' =>'&#xe535;',
			'ice-cream' =>'&#xe536;',
			'ice-lolly' =>'&#xe537;',
			'ice-lolly-tasted' =>'&#xe538;',
			'invoice' =>'&#xe539;',
			'cart-tick' =>'&#xe540;',
			'hourglass' =>'&#xe541;',
			'cat' =>'&#xe542;',
			'lamp' =>'&#xe543;',
			'scale-classic' =>'&#xe544;',
			'eye-plus' =>'&#xe545;',
			'eye-minus' =>'&#xe546;',
			'quote' =>'&#xe547;',
			'bitcoin' =>'&#xe548;',
			'yen' =>'&#xe549;',
			'ruble' =>'&#xe550;',
			'erase' =>'&#xe551;',
			'podcast' =>'&#xe552;',
			'firework' =>'&#xe553;',
			'scale' =>'&#xe554;',
			'king' =>'&#xe555;',
			'queen' =>'&#xe556;',
			'pawn' =>'&#xe557;',
			'bishop' =>'&#xe558;',
			'knight' =>'&#xe559;',
			'mic-mute' =>'&#xe560;',
			'voicemail' =>'&#xe561;',
			'paragraph-alt' =>'&#xe562;',
			'person-walking' =>'&#xe563;',
			'person-wheelchair' =>'&#xe564;',
			'underground' =>'&#xe565;',
			'car-hov' =>'&#xe566;',
			'car-rental' =>'&#xe567;',
			'transport' =>'&#xe568;',
			'taxi' =>'&#xe569;',
			'ice-cream-no' =>'&#xe570;',
			'uk-rat-u' =>'&#xe571;',
			'uk-rat-pg' =>'&#xe572;',
			'uk-rat-12a' =>'&#xe573;',
			'uk-rat-12' =>'&#xe574;',
			'uk-rat-15' =>'&#xe575;',
			'uk-rat-18' =>'&#xe576;',
			'uk-rat-r18' =>'&#xe577;',
			'tv' =>'&#xe578;',
			'sms' =>'&#xe579;',
			'mms' =>'&#xe580;',
			'us-rat-g' =>'&#xe581;',
			'us-rat-pg' =>'&#xe582;',
			'us-rat-pg-13' =>'&#xe583;',
			'us-rat-restricted' =>'&#xe584;',
			'us-rat-no-one-17' =>'&#xe585;',
			'equalizer' =>'&#xe586;',
			'speakers' =>'&#xe587;',
			'remote-control' =>'&#xe588;',
			'remote-control-tv' =>'&#xe589;',
			'shredder' =>'&#xe590;',
			'folder-heart' =>'&#xe591;',
			'person-running' =>'&#xe592;',
			'person' =>'&#xe593;',
			'voice' =>'&#xe594;',
			'stethoscope' =>'&#xe595;',
			'paired' =>'&#xe596;',
			'activity' =>'&#xe597;',
			'watch' =>'&#xe598;',
			'scissors-alt' =>'&#xe599;',
			'car-wheel' =>'&#xe600;',
			'chevron-up' =>'&#xe601;',
			'chevron-down' =>'&#xe602;',
			'superscript' =>'&#xe603;',
			'subscript' =>'&#xe604;',
			'text-size' =>'&#xe605;',
			'text-color' =>'&#xe606;',
			'text-background' =>'&#xe607;',
			'modal-window' =>'&#xe608;',
			'newspaper' =>'&#xe609;',
			'tractor' =>'&#xe610;',
			'camping' =>'&#xe611;',
			'camping-benches' =>'&#xe612;',
			'forest' =>'&#xe613;',
			'park' =>'&#xe614;',
			'field' =>'&#xe615;',
			'mountains' =>'&#xe616;',
			'fees-payments' =>'&#xe617;',
			'small-payments' =>'&#xe618;',
			'mixed-buildings' =>'&#xe619;',
			'industrial-zone' =>'&#xe620;',
			'visitor-tag' =>'&#xe621;',
			'businessman' =>'&#xe622;',
			'meditation' =>'&#xe623;',
			'bath' =>'&#xe624;',
			'donate' =>'&#xe625;',
			'sauna' =>'&#xe626;',
			'bedroom-nightstand' =>'&#xe627;',
			'bedroom-lamp' =>'&#xe628;',
			'doctor' =>'&#xe629;',
			'engineering-networks' =>'&#xe630;',
			'washing-machine' =>'&#xe631;',
			'dryer' =>'&#xe632;',
			'dishwasher' =>'&#xe633;',
			'luggage-group' =>'&#xe634;',
			'teenager' =>'&#xe635;',
			'person-stick' =>'&#xe636;',
			'person-stick-old' =>'&#xe637;',
			'traveler' =>'&#xe638;',
			'veteran' =>'&#xe639;',
			'group-chat' =>'&#xe640;',
			'elections' =>'&#xe641;',
			'law-justice' =>'&#xe642;',
			'judiciary' =>'&#xe643;',
			'house-fire' =>'&#xe644;',
			'firefighters' =>'&#xe645;',
			'police' =>'&#xe646;',
			'ambulance' =>'&#xe647;',
			'light-beacon' =>'&#xe648;',
			'important-day' =>'&#xe649;',
			'bike-park' =>'&#xe650;',
			'object-align-top' =>'&#xe651;',
			'object-align-bottom' =>'&#xe652;',
			'object-align-horizontal' =>'&#xe653;',
			'object-align-left' =>'&#xe654;',
			'object-align-vertical' =>'&#xe655;',
			'object-align-right' =>'&#xe656;',
			'reflect-y' =>'&#xe657;',
			'reflect-x' =>'&#xe658;',
			'tick' =>'&#xe659;',
			'lawnmower' =>'&#xe660;',
			'call-redirect' =>'&#xe661;',
			'call-ip' =>'&#xe662;',
			'call-record' =>'&#xe663;',
			'call-ringtone' =>'&#xe664;',
			'call-traffic' =>'&#xe665;',
			'call-hold' =>'&#xe666;',
			'call-incoming' =>'&#xe667;',
			'call-outgoing' =>'&#xe668;',
			'call-video' =>'&#xe669;',
			'call-missed' =>'&#xe670;',
			'theater' =>'&#xe671;',
			'heartbeat' =>'&#xe672;',
			'kettlebell' =>'&#xe673;',
			'fireplace' =>'&#xe674;',
			'street-lights' =>'&#xe675;',
			'pedestrian' =>'&#xe676;',
			'flood' =>'&#xe677;',
			'open-water' =>'&#xe678;',
			'for-sale' =>'&#xe679;',
			'dustbin' =>'&#xe680;',
			'door' =>'&#xe681;',
			'camp-fire' =>'&#xe682;',
			'fleur-de-lis' =>'&#xe683;',
			'temperature-settings' =>'&#xe684;',
			'article' =>'&#xe685;',
			'sunbath' =>'&#xe686;',
			'balanced-diet' =>'&#xe687;',
			'ticket' =>'&#xe688;',
			'parking-ticket' =>'&#xe689;',
			'parking-meter' =>'&#xe690;',
			'laptop' =>'&#xe691;',
			'tree-structure' =>'&#xe692;',
			'weather-warning' =>'&#xe693;',
			'temperature-low' =>'&#xe694;',
			'temperature-high' =>'&#xe695;',
			'temperature-low-warning' =>'&#xe696;',
			'temperature-high-warning' =>'&#xe697;',
			'hurricane' =>'&#xe698;',
			'storm' =>'&#xe699;',
			'sorted-waste' =>'&#xe700;',
			'ear' =>'&#xe701;',
			'ear-deaf' =>'&#xe702;',
			'file-plus' =>'&#xe703;',
			'file-minus' =>'&#xe704;',
			'file-lock' =>'&#xe705;',
			'file-cloud' =>'&#xe706;',
			'file-cloud-download' =>'&#xe707;',
			'file-cloud-upload' =>'&#xe708;',
			'paragraph' =>'&#xe709;',
			'list-numbered' =>'&#xe710;',
			'donate-heart' =>'&#xe711;',
			'government' =>'&#xe712;',
			'maze' =>'&#xe713;',
			'chronicle' =>'&#xe714;',
			'user-structure' =>'&#xe715;',
			'recycle' =>'&#xe716;',
			'gas' =>'&#xe717;',
			'waste-pipe' =>'&#xe718;',
			'water-pipe' =>'&#xe719;',
			'parking' =>'&#xe720;',
			'closed' =>'&#xe721;',
			'mouse' =>'&#xe722;',
			'mouse-double-click' =>'&#xe723;',
			'mouse-left-click' =>'&#xe724;',
			'mouse-right-click' =>'&#xe725;',
			'mouse-middle-click' =>'&#xe726;',
			'mouse-scroll' =>'&#xe727;',
			'resize-vertical' =>'&#xe728;',
			'resize-horizontal' =>'&#xe729;',
			'temperature' =>'&#xe730;',
			'puzzle' =>'&#xe731;',
			'puzzle-2' =>'&#xe732;',
			'puzzle-3' =>'&#xe733;',
			'nearby-square' =>'&#xe734;',
			'nearby-circle' =>'&#xe735;',
			'rotate-right' =>'&#xe736;',
			'rotate-left' =>'&#xe737;',
			'pictures' =>'&#xe738;',
			'photo-album' =>'&#xe739;',
			'cadastral-map' =>'&#xe740;',
			'fingerprint-scan' =>'&#xe741;',
			'fingerprint' =>'&#xe742;',
			'fingerprint-lock' =>'&#xe743;',
			'fingerprint-ok' =>'&#xe744;',
			'fingerprint-remove' =>'&#xe745;',
			'fingerprint-reload' =>'&#xe746;',
			'pending-notifications' =>'&#xe747;',
			'synchronization' =>'&#xe748;',
			'synchronization-ban' =>'&#xe749;',
			'hash' =>'&#xe750;',
			'gender-male' =>'&#xe751;',
			'gender-female' =>'&#xe752;',
			'gender-virgin-female' =>'&#xe753;',
			'gender-intersex' =>'&#xe754;',
			'gender-transgender' =>'&#xe755;',
			'gender-ori-lesbian' =>'&#xe756;',
			'gender-ori-gay' =>'&#xe757;',
			'gender-ori-hetero' =>'&#xe758;',
			'gender-other' =>'&#xe759;',
			'gender-unknown' =>'&#xe760;',
			'scanner' =>'&#xe761;',
			'multifunction-printer' =>'&#xe762;',
			'lasso' =>'&#xe763;',
			'view-360' =>'&#xe764;',
			'battery-charging' =>'&#xe765;',
			'battery-full' =>'&#xe766;',
			'battery-75' =>'&#xe767;',
			'battery-50' =>'&#xe768;',
			'battery-25' =>'&#xe769;',
			'battery-10' =>'&#xe770;',
			'satellite' =>'&#xe771;',
			'satellite-dish' =>'&#xe772;',
			'satellite-dish-alt' =>'&#xe773;',
			'auction' =>'&#xe774;',
			'directions' =>'&#xe775;',
			'race' =>'&#xe776;',
			'robot' =>'&#xe777;',
			'ruler-alt' =>'&#xe778;',
			'cube-empty' =>'&#xe779;',
			'cube-black' =>'&#xe780;',
			'move-square' =>'&#xe781;',
			'drop' =>'&#xe782;',
			'vr-headset' =>'&#xe783;',
			'vr-charging' =>'&#xe784;',
			'vr-low-battery' =>'&#xe785;',
			'vr-paired' =>'&#xe786;',
			'vr-settings' =>'&#xe787;',
			'vr-maintenance' =>'&#xe788;',
			'filter-remove' =>'&#xe789;',
			'filter-applied' =>'&#xe790;',
			'one-day' =>'&#xe791;',
			'user-vr' =>'&#xe792;',
			'user-vr-add' =>'&#xe793;',
			'user-vr-remove' =>'&#xe794;',
			'dice-1' =>'&#xe795;',
			'dice-2' =>'&#xe796;',
			'dice-3' =>'&#xe797;',
			'dice-4' =>'&#xe798;',
			'dice-5' =>'&#xe799;',
			'dice-6' =>'&#xe800;',
		),
	);

	$icon_families['glyphsocial'] = array(
		'name' => __( 'Glyphicons Social', 'themovation-widgets' ),
		'style_uri' => plugin_dir_url(__FILE__) . '../assets/glyphsocial/style.css',
		'icons' => array(
			'pinterest' => '&#xe001',
			'dropbox' => '&#xe002',
			'google-plus' => '&#xe003',
			'jolicloud' => '&#xe004',
			'yahoo' => '&#xe005',
			'blogger' => '&#xe006',
			'picasa' => '&#xe007',
			'amazon' => '&#xe008',
			'tumblr' => '&#xe009',
			'wordpress' => '&#xe010',
			'instapaper' => '&#xe011',
			'evernote' => '&#xe012',
			'xing' => '&#xe013',
			'e-mail-envelope' => '&#xe014',
			'dribbble' => '&#xe015',
			'deviantart' => '&#xe016',
			'read-it-later' => '&#xe017',
			'linked-in' => '&#xe018',
			'gmail' => '&#xe019',
			'pinboard' => '&#xe020',
			'behance' => '&#xe021',
			'github' => '&#xe022',
			'youtube' => '&#xe023',
			'open-id' => '&#xe024',
			'foursquare' => '&#xe025',
			'quora' => '&#xe026',
			'badoo' => '&#xe027',
			'spotify' => '&#xe028',
			'stumbleupon' => '&#xe029',
			'readability' => '&#xe030',
			'facebook' => '&#xe031',
			'twitter' => '&#xe032',
			'instagram' => '&#xe033',
			'posterous-spaces' => '&#xe034',
			'vimeo' => '&#xe035',
			'flickr' => '&#xe036',
			'last-fm' => '&#xe037',
			'rss' => '&#xe038',
			'skype' => '&#xe039',
			'e-mail' => '&#xe040',
			'vine' => '&#xe041',
			'myspace' => '&#xe042',
			'goodreads' => '&#xe043',
			'apple' => '&#xe044',
			'windows' => '&#xe045',
			'yelp' => '&#xe046',
			'playstation' => '&#xe047',
			'xbox' => '&#xe048',
			'android' => '&#xe049',
			'ios' => '&#xe050',
			'wikipedia' => '&#xe051',
			'pocket' => '&#xe052',
			'steam' => '&#xe053',
			'soundcloud' => '&#xe054',
			'slideshare' => '&#xe055',
			'netflix' => '&#xe056',
			'paypal' => '&#xe057',
			'google-drive' => '&#xe058',
			'linux-foundation' => '&#xe059',
			'ebay' => '&#xe060',
			'bitbucket' => '&#xe061',
			'whatsapp' => '&#xe062',
			'buffer' => '&#xe063',
			'medium' => '&#xe064',
			'stackoverflow' => '&#xe065',
			'linux' => '&#xe066',
			'vk' => '&#xe067',
			'snapchat' => '&#xe068',
			'etsy' => '&#xe069',
			'stackexchange' => '&#xe070'
		),
	);

	return $icon_families;
}
endif;
add_filter( 'siteorigin_widgets_icon_families', 'themovation_so_wb_glyphicons' );
