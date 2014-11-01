<?php

function websitefuse_country_blocker_install(){
	//if(!get_option('websitefuse_country_blocker_installed',0)){
		add_option( 'websitefuse_country_blocker_installed', 'yes' );

		global $wpdb;
		global $webbsitefuse_country_blocker_db_version;

	

	$sql = "CREATE TABLE IF NOT EXISTS `websitefuse_country` (
  `country_short` varchar(10) NOT NULL,
  `country` varchar(60) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=armscii8;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );


	$wpdb->query("INSERT INTO `websitefuse_country` (`country_short`, `country`, `id`) VALUES
('AF', 'Afghanistan', 1),
('AX', 'Aland Islands', 2),
('AL', 'Albania', 3),
('DZ', 'Algeria', 4),
('AS', 'American Samoa', 5),
('AD', 'Andorra', 6),
('AO', 'Angola', 7),
('AI', 'Anguilla', 8),
('AQ', 'Antarctica', 9),
('AG', 'Antigua and Barbuda', 10),
('AR', 'Argentina', 11),
('AM', 'Armenia', 12),
('AW', 'Aruba', 13),
('AP', 'Asia/Pacific Region', 14),
('AU', 'Australia', 15),
('AT', 'Austria', 16),
('AZ', 'Azerbaijan', 17),
('BS', 'Bahamas', 18),
('BH', 'Bahrain', 19),
('BD', 'Bangladesh', 20),
('BB', 'Barbados', 21),
('BY', 'Belarus', 22),
('BE', 'Belgium', 23),
('BZ', 'Belize', 24),
('BJ', 'Benin', 25),
('BM', 'Bermuda', 26),
('BT', 'Bhutan', 27),
('BO', 'Bolivia', 28),
('BQ', 'Bonaire? Saint Eustatius and S', 29),
('BA', 'Bosnia and Herzegovina', 30),
('BW', 'Botswana', 31),
('BR', 'Brazil', 32),
('IO', 'British Indian Ocean Territory', 33),
('BN', 'Brunei Darussalam', 34),
('BG', 'Bulgaria', 35),
('BF', 'Burkina Faso', 36),
('BI', 'Burundi', 37),
('KH', 'Cambodia', 38),
('CM', 'Cameroon', 39),
('CA', 'Canada', 40),
('CV', 'Cape Verde', 41),
('KY', 'Cayman Islands', 42),
('CF', 'Central African Republic', 43),
('TD', 'Chad', 44),
('CL', 'Chile', 45),
('CN', 'China', 46),
('CC', 'Cocos ?Keeling? Islands', 47),
('CO', 'Colombia', 48),
('KM', 'Comoros', 49),
('CG', 'Congo', 50),
('CD', 'Congo? The Democratic Republic', 51),
('CK', 'Cook Islands', 52),
('CR', 'Costa Rica', 53),
('CI', 'Cote D?Ivoire', 54),
('HR', 'Croatia', 55),
('CU', 'Cuba', 56),
('CW', 'Curacao', 57),
('CY', 'Cyprus', 58),
('CZ', 'Czech Republic', 59),
('DK', 'Denmark', 60),
('DJ', 'Djibouti', 61),
('DM', 'Dominica', 62),
('DO', 'Dominican Republic', 63),
('EC', 'Ecuador', 64),
('EG', 'Egypt', 65),
('SV', 'El Salvador', 66),
('GQ', 'Equatorial Guinea', 67),
('ER', 'Eritrea', 68),
('EE', 'Estonia', 69),
('ET', 'Ethiopia', 70),
('EU', 'Europe', 71),
('FK', 'Falkland Islands ?Malvinas?', 72),
('FO', 'Faroe Islands', 73),
('FJ', 'Fiji', 74),
('FI', 'Finland', 75),
('FR', 'France', 76),
('GF', 'French Guiana', 77),
('PF', 'French Polynesia', 78),
('TF', 'French Southern Territories', 79),
('GA', 'Gabon', 80),
('GM', 'Gambia', 81),
('GE', 'Georgia', 82),
('DE', 'Germany', 83),
('GH', 'Ghana', 84),
('GI', 'Gibraltar', 85),
('GR', 'Greece', 86),
('GL', 'Greenland', 87),
('GD', 'Grenada', 88),
('GP', 'Guadeloupe', 89),
('GU', 'Guam', 90),
('GT', 'Guatemala', 91),
('GG', 'Guernsey', 92),
('GN', 'Guinea', 93),
('GW', 'Guinea?Bissau', 94),
('GY', 'Guyana', 95),
('HT', 'Haiti', 96),
('VA', 'Holy See ?Vatican City State?', 97),
('HN', 'Honduras', 98),
('HK', 'Hong Kong', 99),
('HU', 'Hungary', 100),
('IS', 'Iceland', 101),
('IN', 'India', 102),
('ID', 'Indonesia', 103),
('IR', 'Iran? Islamic Republic of', 104),
('IQ', 'Iraq', 105),
('IE', 'Ireland', 106),
('IM', 'Isle of Man', 107),
('IL', 'Israel', 108),
('IT', 'Italy', 109),
('JM', 'Jamaica', 110),
('JP', 'Japan', 111),
('JE', 'Jersey', 112),
('JO', 'Jordan', 113),
('KZ', 'Kazakhstan', 114),
('KE', 'Kenya', 115),
('KI', 'Kiribati', 116),
('KP', 'Korea? Democratic People?s Rep', 117),
('KR', 'Korea? Republic of', 118),
('KW', 'Kuwait', 119),
('KG', 'Kyrgyzstan', 120),
('LA', 'Lao People?s Democratic Republ', 121),
('LV', 'Latvia', 122),
('LB', 'Lebanon', 123),
('LS', 'Lesotho', 124),
('LR', 'Liberia', 125),
('LY', 'Libya', 126),
('LI', 'Liechtenstein', 127),
('LT', 'Lithuania', 128),
('LU', 'Luxembourg', 129),
('MO', 'Macau', 130),
('MK', 'Macedonia', 131),
('MG', 'Madagascar', 132),
('MW', 'Malawi', 133),
('MY', 'Malaysia', 134),
('MV', 'Maldives', 135),
('ML', 'Mali', 136),
('MT', 'Malta', 137),
('MH', 'Marshall Islands', 138),
('MQ', 'Martinique', 139),
('MR', 'Mauritania', 140),
('MU', 'Mauritius', 141),
('YT', 'Mayotte', 142),
('MX', 'Mexico', 143),
('FM', 'Micronesia? Federated States o', 144),
('MD', 'Moldova? Republic of', 145),
('MC', 'Monaco', 146),
('MN', 'Mongolia', 147),
('ME', 'Montenegro', 148),
('MS', 'Montserrat', 149),
('MA', 'Morocco', 150),
('MZ', 'Mozambique', 151),
('MM', 'Myanmar', 152),
('NA', 'Namibia', 153),
('NR', 'Nauru', 154),
('NP', 'Nepal', 155),
('NL', 'Netherlands', 156),
('NC', 'New Caledonia', 157),
('NZ', 'New Zealand', 158),
('NI', 'Nicaragua', 159),
('NE', 'Niger', 160),
('NG', 'Nigeria', 161),
('NU', 'Niue', 162),
('NF', 'Norfolk Island', 163),
('MP', 'Northern Mariana Islands', 164),
('NO', 'Norway', 165),
('OM', 'Oman', 166),
('PK', 'Pakistan', 167),
('PW', 'Palau', 168),
('PS', 'Palestinian Territory', 169),
('PA', 'Panama', 170),
('PG', 'Papua New Guinea', 171),
('PY', 'Paraguay', 172),
('PE', 'Peru', 173),
('PH', 'Philippines', 174),
('PN', 'Pitcairn Islands', 175),
('PL', 'Poland', 176),
('PT', 'Portugal', 177),
('PR', 'Puerto Rico', 178),
('QA', 'Qatar', 179),
('RE', 'Reunion', 180),
('RO', 'Romania', 181),
('RU', 'Russian Federation', 182),
('RW', 'Rwanda', 183),
('BL', 'Saint Barthelemy', 184),
('SH', 'Saint Helena', 185),
('KN', 'Saint Kitts and Nevis', 186),
('LC', 'Saint Lucia', 187),
('MF', 'Saint Martin', 188),
('PM', 'Saint Pierre and Miquelon', 189),
('VC', 'Saint Vincent and the Grenadin', 190),
('WS', 'Samoa', 191),
('SM', 'San Marino', 192),
('ST', 'Sao Tome and Principe', 193),
('A2', 'Satellite Provider', 194),
('SA', 'Saudi Arabia', 195),
('SN', 'Senegal', 196),
('RS', 'Serbia', 197),
('SC', 'Seychelles', 198),
('SL', 'Sierra Leone', 199),
('SG', 'Singapore', 200),
('SX', 'Sint Maarten ?Dutch part?', 201),
('SK', 'Slovakia', 202),
('SI', 'Slovenia', 203),
('SB', 'Solomon Islands', 204),
('SO', 'Somalia', 205),
('ZA', 'South Africa', 206),
('GS', 'South Georgia and the South Sa', 207),
('SS', 'South Sudan', 208),
('ES', 'Spain', 209),
('LK', 'Sri Lanka', 210),
('SD', 'Sudan', 211),
('SR', 'Suriname', 212),
('SJ', 'Svalbard and Jan Mayen', 213),
('SZ', 'Swaziland', 214),
('SE', 'Sweden', 215),
('CH', 'Switzerland', 216),
('SY', 'Syrian Arab Republic', 217),
('TW', 'Taiwan', 218),
('TJ', 'Tajikistan', 219),
('TZ', 'Tanzania? United Republic of', 220),
('TH', 'Thailand', 221),
('TL', 'Timor?Leste', 222),
('TG', 'Togo', 223),
('TK', 'Tokelau', 224),
('TO', 'Tonga', 225),
('TT', 'Trinidad and Tobago', 226),
('TN', 'Tunisia', 227),
('TR', 'Turkey', 228),
('TM', 'Turkmenistan', 229),
('TC', 'Turks and Caicos Islands', 230),
('TV', 'Tuvalu', 231),
('UG', 'Uganda', 232),
('UA', 'Ukraine', 233),
('AE', 'United Arab Emirates', 234),
('GB', 'United Kingdom', 235),
('US', 'United States', 236),
('UM', 'United States Minor Outlying I', 237),
('UY', 'Uruguay', 238),
('UZ', 'Uzbekistan', 239),
('VU', 'Vanuatu', 240),
('VE', 'Venezuela', 241),
('VN', 'Vietnam', 242),
('VG', 'Virgin Islands? British', 243),
('VI', 'Virgin Islands? U?S?', 244),
('WF', 'Wallis and Futuna', 245),
('YE', 'Yemen', 246),
('ZM', 'Zambia', 247),
('ZW', 'Zimbabwe', 248);");







	$sql = "CREATE TABLE IF NOT EXISTS `websitefuse_ipv4` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_num` bigint(20) NOT NULL,
  `allow` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
)";

dbDelta( $sql );

}


















///////Uninstall plugin cleanup

	function websitefuse_country_blocker_uninstall(){
	global $wpdb;

	delete_option('websitefuse_block_country');
	$sql = "DROP TABLE IF EXISTS websitefuse_country;";
	$e = $wpdb->query($sql);

	$sql = "DROP TABLE IF EXISTS websitefuse_ipv4;";
	$e = $wpdb->query($sql);
}
?>