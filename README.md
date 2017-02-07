UGR teranga_elgg
====

La app de [Teranga Go!(http://apps.ugr.es/app_teranga.html)](<http://apps.ugr.es/app_teranga.html>) quiere facilitar la movilidad de los migrantes. Por eso, hemos puesto en marcha una red social que pone en contacto a personas que comparten vehículo en los desplazamientos entre sus países de origen y acogida. Teranga Go! es una Plataforma de economía colaborativa para la movilidad entre España y Senegal desarrollada bajo la financiacion del CEI BioTIC de la Universidad de Granada y en colaboración con la empresa granadina Acento comunicación

Este repositorio aloja los plugins desarrollados y adaptados por Rosana Montes, profesora de la Universidad de Granada, que personalizan un Elgg para convertirlo en una comunidad social activa para compartir vehículo.

El mundo se mueve: GO. Y precisa mucha hospitalidad: Teranga. Por eso, nace Teranga GO!

Calendario

  * 16 de octubre, Día Europeo del Coche Compartido
  * 18 de diciembre, Día Internacional del Migrante
  * 24 de mayo, Dia de África

Más información en https://lsi.ugr.es/rosana/software/Teranga.Go


Install instructions
====

1. Download & Install elgg-1.12.x (read more information bellow)
2. Log-in with the admin account
3. Go to the admin/plugins zone. Enable/Disable the plugins as follows. Note that we have start by moving Elgg Developer Tools 1.0 to the top position. Plugins list:
  * Elgg Developer Tools 1.0 	[Enabled]   - Optional
  * Blog 1.8					[Disabled]
  * Bookmarks 1.8				[Disabled]
  * Site-wide Categories 1.8	[Disabled]
  * Custom Index 1.8			[Enabled]
  * User Dashboard 1.8			[Disabled]   - Optional
  * Diagnostics 1.8			[Disabled]
  * Embed 1.8					[Disabled]
  * Site Pages 1.8				[Disabled]
  * File 1.8 					[Disabled]
  * Garbage Collector 1.5 		[Enabled]   - Optional
  * Groups 1.8				[Disabled]
  * HTMLawed 1.8				[Enabled]
  * Invite Friends 1.8 		     [Disabled]   - Optional
  * Likes 1.8 				[Enabled]   - Optional
  * Log Browser 1.8			[Enabled]
  * Log Rotate 1.5  			[Enabled]
  * Members 1.8				[Enabled]
  * Message Board 1.8			[Disabled]
  * Messages 1.8				[Enabled]
  * Notifications 1.7			[Disabled]   - Optional
  * Pages 1.8					[Disabled]
  * Profile 1.8				[Enabled]
  * Reported Content 1.8		[Disabled]   - Optional
  * Search 1.8				[Disabled]   - Optional
  * Tag Cloud 1.0				[Enabled]   - Optional
  * The Wire 1.8				[Disabled]   - Optional
  * TinyMCE 1.8				[Enabled]
  * Twitter API 1.8.15 		     [Disabled]   - Optional
  * User Validation by Email	     [Disabled]   - Optional
  * Web services 1.9  [Enabled]
  * Zaudio 1.8				[Disabled]   - Optional
4. Visit https://elgg.org/plugins to download and enable "at the bottom" the following recomended plugins for Teranga Go! under elgg 1.12.x
  * elgghtml5 (HTML5 1.0)
  * google-fonts (Google Fonts v1.1)
  * fontawesome
  * elggx_userpoints (Elggx Userpoints v1.8.5)
  * language_selector (Language Selector v2.0.1)
6. Clone https://github.com/rosanamontes/Teranga.Go
7. Make simbolic links for the previous plugings in order that they appear as inside the mod/ directory
   cd $SITE
   git clone https://github.com/rosanamontes/teranga.go.git
   cd $SITE/mod
   ln -s ../teranga.go/mod/externalpages externalpages
   ln -s ../teranga.go/mod/mytrips mytrips
   ln -s ../teranga.go/mod/profiles_go profiles_go
   ln -s ../teranga.go/mod/rename_friends rename_friends
   ln -s ../teranga.go/mod/terangapp terangapp
   ln -s ../teranga.go/mod/trip_companions trip_companions
   ln -s ../teranga.go/mod/teranga_idss teranga_idss
8. Enabled current plugins following the next order (that's is, the last is placed at the bottom of the list):
   * Teranga External Pages 1.9 (from externalpages)
   * Teranga Rename Friends 2.0 (from renamefriend)
   * Teranga App Ad 1.2 
   * Teranga Trip Companions 1.8
   * Teranga WebService 1.0 (from Antonio Moles repository)
   * Teranga Buscador Viaje 1.0 (from Antonio Moles repository)
   * Teranga IDSS (Intelligent Decision Support System - Toma de Decision con Valoraciones linguisticas difusas 1.8)
   * Teranga Go! My Trips 1.8
   * Teranga Custom Index 2.0 
   * Teranga Go! Profiles 1.8
   * Teranga Trip Filtering 0.9 (under development)
9. Update your plugin preferences (those set up by you)
10. Publish your trip plannings


Elgg [![Build Status](https://secure.travis-ci.org/Elgg/Elgg.svg?branch=1.12)](https://travis-ci.org/Elgg/Elgg) [![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/Elgg/Elgg/badges/quality-score.png?s=1.12)](https://scrutinizer-ci.com/g/Elgg/Elgg/?branch=1.12) [![Scrutinizer Code Coverage](https://scrutinizer-ci.com/g/Elgg/Elgg/badges/coverage.png?b=1.12)](https://scrutinizer-ci.com/g/Elgg/Elgg/?branch=1.12) [![Read the docs build status](https://readthedocs.org/projects/elgg/badge/?version=1.12)](http://learn.elgg.org/en/1.12/)
====

Elgg is managed by the Elgg Foundation, a nonprofit organization that was
founded to govern, protect, and promote the Elgg open source social network
engine.  The Foundation aims to provide a stable, commercially and
individually independent organization that operates in the best interest of Elgg
as an open source project.

The project site can be found at http://elgg.org/.

The Elgg project was started in 2004 by
   * Ben Werdmuller (<ben@benwerd.com>, <http://benwerd.com>)
   * Dave Tosh (<https://twitter.com/davetosh>).

Elgg is released under the GNU General Public License (GPL) Version 2 and the
Massachusetts Institute of Technology (MIT-X11) License. See LICENSE.txt
in the root of the package you downloaded.

