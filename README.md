# CÓMO CAMBIAR UNA PLANTILLA: DE HTML5 A JOOMLA!
> por antoniojosetorres
<a name="inicio"></a>
- **[Cómo Cambiar el Logo como Módulo](#logo-mod)**
- **[Cómo Cambiar el Logo como Parámetro de Plantilla](#logo-par)**
- **[Cómo Cambiar el Número de Teléfono como Parámetro de Plantilla](#telefono-par)**
- **[Cómo Cambiar la Caja de Búsqueda como Módulo](#buscar-mod)**
- **[Cómo Cambiar las Direcciones de las Redes Sociales como Parámetros de Plantilla](#rrss-par)**
- **[Cómo Cambiar el Menú Principal como Módulo](#menu-mod)**
- **[Cómo Cambiar la Presentación como Módulo](#presentacion-mod)**
- **[Cómo Cambiar la Sección Bienvenido como Parámetro de Plantilla](#bienvenido-par)**
- **[Cómo Cambiar el Contenido Principal como Módulo](#contenido-mod)**
- **[Cómo Cambiar el Mapa como Módulo](#mapa-mod)**
- **[Cómo Cambiar el Pie de Página como Parámetro de Plantilla](#pie-par)**
- **[Cómo Usar la Sección Bienvenido solo en la Página Inicial](#pagina-inicial)**
<a name="preparacion"></a>
## Preparación Inicial:
- copiar la carpeta `restaurante` dentro de la carpeta `/templates`.
- renombrar el fichero `/templates/restaurante/index.html` como `ìndex.php`.
- crear el fichero vacío `/templates/restaurante/index.html`.
- copiar las imágenes `/templates/beez3/template_preview.png` y `template_thumbnail.png` en la carpeta `/templates/restaurante`.
- copiar el fichero `/templates/beez3/templateDetails.xml` en la carpeta `/templates/restaurante`.
### Editar el Fichero `/templates/restaurante/templateDetails.xml`:
- cambiar en el bloque `<extension>..</extension>`:
  ````xml
  <!-- nombre de la carpeta -->
  <name>restaurante</name>
  <!-- fecha de la plantilla -->
  <creationDate>Marzo 2018</creationDate>
  <!-- nombre del autor -->
  <author>Antonio Jose Torres</author>
  <!-- email del autor -->
  <authorEmail>antoniojosetorres @ gmail.com</authorEmail>
  <!-- web del autor -->
  <authorUrl>http:// antoniojosetorres.es</authorUrl>
  <!-- datos del copyright -->
  <copyright>2018 antoniojosetorres</copyright>
  <!-- número de versión -->
  <version>1.0</version>
  <!-- descripción de la plantilla -->
  <description>Plantilla para Restaurante</description>
  ````
- cambiar las carpetas de la plantilla en el bloque `<files>..</files>`:
  ````xml
  <folder>css</folder>
  <folder>fonts</folder>
  <folder>images</folder>
  <folder>js</folder>
  ````
- cambiar los ficheros de la plantilla en el bloque `<files>..</files>`:  
  ````xml
  <filename>index.html</filename>
  <filename>index.php</filename>
  <filename>templateDetails.xml</filename>
  <filename>template_preview.png</filename>
  <filename>template_thumbnail.png</filename>
  <filename>favicon.ico</filename>
  ````
- cambiar los nombres de las posiciones de los módulos en el bloque `<positions>..</positions>`:
  ````xml
  <position>logo</position>
  <position>buscar</position>
  <position>menuprincipal</position>
  <position>presentacion</position>
  <position>lateral</position>
  ````
### Cambiar la Plantilla en Joomla! (`/administrator/index.php`):
- ir a _Extensiones > Gestor de extensiones > Descubrir_ e instalar la plantilla `restaurante`.
- ir a _Extensiones > Gestor de plantillas_ y marcar la plantilla `restaurante` como _predeterminada_.
### Editar el Fichero `/templates/restaurante/index.php`:
- añadir _línea de seguridad_ al comienzo del fichero:
  ````php
  <?php defined('_JEXEC') or die; ?>
  ````
- borrar `<title>Restaurante Maestro</title>` (será generada por Joomla!).
- borrar `<meta name="description" content="">` (será generada por Joomla!).
- mover `<script src="js/jquery.min.js"></script>` delante de `</head>`.
- mover `<script src="js/modernizr.min.js"></script>` delante de `</head>`.
- añadir `<jdoc:include type="head" />` entre `</script>` y `<link>`.
- añadir _variable de ruta de sitio_ `$ruta_s` delante de `?>`:
  ````php
  $ruta_s=JURI::base();
  ````
- añadir _variable de ruta de plantilla_ `$ruta_p`:
  ````php
  $ruta_p=$ruta_s."templates/".$this->template."/";
  ````
- cambiar:
  ````php
  <script src="js/jquery.min.js"></script>
  <script src="js/modernizr.min.js"></script>
  ````
  - por:
    ````php
    <script src="<?php echo $ruta_p; ?>js/jquery.min.js"></script>
    <script src="<?php echo $ruta_p; ?>js/modernizr.min.js"></script>
    ````
- cambiar:
  ````php
  <link rel="stylesheet" href="css/normalize.min.css">
  <link rel="stylesheet" href="css/estilos.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  ````
  - por:
    ````php
    <link rel="stylesheet" href="<?php echo $ruta_p; ?>css/normalize.min.css">
    <link rel="stylesheet" href="<?php echo $ruta_p; ?>css/estilos.css">
    <link rel="stylesheet" href="<?php echo $ruta_p; ?>css/font-awesome.min.css">
    ````
---
<a name="logo-mod"></a>
## Cómo Cambiar el Logo en Joomla! (`/administrator/index.php`) como *Módulo*:
- ir a _Extensiones > Gestor de módulos_ y crear un módulo nuevo de tipo _HTML personalizado_:
  - escribir _Título_: `Logo`.
  - elegir _Posición_: `logo`.
  - añadir la imagen `logo.png`:
    ````html
    <img src="images/logo.png" alt="logo">
    ````
- ir a _Componentes > JCE Editor > Global Configuration_ y comprobar la configuración de _JCE Editor_:
  - en _Cleanup & Output > Validate HTML_, elegir: `No`.
  - en _Formatting & Display > Container Element & Enter Key_, elegir: `No Container & Paragraph on Enter`.
### Editar el Fichero `/templates/restaurante/index.php`:
- cambiar:
  ````php
  <a href="#" class="logo">
  ````
  - por:
    ````php
    <a href="<?php echo $ruta_s; ?>" class="logo">
    ````
- cambiar:
  ````php
  <img src="images/logo.png" alt="logo">
  ````
  - por:
    ````php
    <jdoc:include type="modules" name="logo" style="none" />
    ````
### Duplicar el Módulo *mod_custom* para Sobreescribirlo (Override):
- crear carpeta `html` en `/templates/restaurante`.
- copiar `/modules/mod_custom` en `/templates/restaurante/html`.
- borrar `/templates/restaurante/html/mod_custom/mod_custom.php` y `mod_custom.xml`.
- copiar `/templates/restaurante/html/mod_custom/tmpl/default.php` en `/templates/restaurante/html/mod_custom/restaurante.php`.
- borrar la carpeta `/templates/restaurante/html/mod_custom/tmpl`.
### Editar el Fichero `/templates/restaurante/html/mod_custom/restaurante.php`:
- borrar `<div>` y `</div>` dejando `<?php echo $module->content; ?>` para no insertar `<div class="custom">` en los módulos _HTML personalizado_.
### Elegir el Módulo *mod_custom* Personalizado (override) en Joomla! (`/administrator/index.php`):
- ir a _Extensiones > Gestor de módulos_ y hacer click en el módulo _Logo_:
  - en _Avanzado > Presentación alternativa_, elegir: _---Desde plantilla--- > restaurante_.
---
<a name="logo-par"></a>[ir a Inicio](#inicio)
## Cómo Cambiar el Logo como *Parámetro de Plantilla*:
### Editar el Fichero `/templates/restaurante/templateDetails.xml`:
- crear `<fieldset>` con el parámetro `opciones` y el campo `logo:
  ````xml
  <fieldset name="opciones" label="Opciones de Plantilla">
    <field name="logo" type="media" label="Logo" description="Inserta tu logo" />  
  </fieldset>
  ````
### Editar el Fichero `/templates/restaurante/index.php`:
- añadir _variable de aplicación_ `$app` después de la variable `$ruta_p`:
  ````php
  $app=JFactory::getApplication();
  ````
- añadir _variable de parámetros_ `$params`:
  ````php
  $params=$app->getParams();
  ````
- añadir _variable de logo_ `$logo`:
  ````php
  $logo=$this->params->get('logo');
  ````
- cambiar:
  ````php
  <a href="#" class="logo">
  ````
  - por:
    ````php
    <a href="<?php echo $ruta_s; ?>" class="logo">
    ````
- cambiar:
  ````php
  <img src="images/logo.png" alt="logo">
  ````
  - por:
    ````php
    <img src="<?php echo $logo; ?>" alt="logo">
    ````
---
<a name="telefono-par"></a>[ir a Inicio](#inicio)
## Cómo Cambiar el Número de Teléfono como *Parámetro de Plantilla*:
### Editar el Fichero `/templates/restaurante/templateDetails.xml`:
- añadir `<field>` con el campo `telefono`:
  ````xml
  <field name="telefono" type="tel" label="Teléfono" default="666 123 456" description="Inserta tu número de teléfono" />
  ````
### Editar el Fichero `/templates/restaurante/index.php`:
- añadir _variable de telefono_ `$telefono`:
  ````php
  $telefono=$this->params->get('telefono');
  ````
- cambiar:
  ````php
  <a href="tel:666 123 456" class="telefono">
  ````
  - por:
    ````php
    <a href="tel:<?php echo $telefono; ?>" class="telefono">
    ````
### Editar el Fichero `/templates/restaurante/templateDetails.xml`:
- añadir `<field>` con el campo `sep1` para agrupar las opciones de plantilla en el backend de Joomla!:
  ````xml
  <field name="sep1" type="spacer" label="> Opciones de Encabezado" />
  ````
---
<a name="buscar-mod"></a>[ir a Inicio](#inicio)
## Cómo Cambiar la Caja de Búsqueda en Joomla! (`/administrator/index.php`) como *Módulo*:
- ir a _Extensiones > Gestor de módulos_ y crear un módulo nuevo de tipo _Buscar_:
  - escribir _Título_: `Caja de busqueda`.
  - elegir _Posición_: `buscar`.
  - escribir _Texto del campo_: `Buscar...`.
### Editar el Fichero `/templates/restaurante/index.php`:
- cambiar:
  ````php
  <form action="index.html">
    <input type="text" name="buscar" placeholder="Buscar…">
  </form>
  ````
  - por:
    ````php
    <jdoc:include type="modules" name="buscar" style="none" />
    ````
### Duplicar el Módulo *mod_search* para Sobreescribirlo (Override):
- copiar `/modules/mod_search en /templates/restaurante/html`.
- borrar `/templates/restaurante/html/mod_search/mod_search.php`, `mod_search.xml` y `helper.php`.
- copiar `/templates/restaurante/html/mod_search/tmpl/default.php` en `/templates/restaurante/html/mod_search`.
- renombrar `/templates/restaurante/html/mod_search` como `restaurante.php`.
- borrar la carpeta `/templates/restaurante/html/mod_search/tmpl`.
### Editar el Fichero `/templates/restaurante/html/mod_search/restaurante.php`:
- borrar `<div>` y `</div>` dejando `<form...>` para no insertar `<div class="search">` en los módulos _Buscar_.
- borrar `<label>` y `</label>` dejando `<form...>` para que no aparezca la palabra _Buscar_ delante de la caja de búsqueda.
### Elegir el Módulo *mod_search* Personalizado (override) en Joomla! (`/administrator/index.php`):
- ir a _Extensiones > Gestor de módulos_ y hacer click en el módulo _Caja de busqueda_:
  - en _Avanzado > Presentación alternativa_, elegir: _---Desde plantilla--- > restaurante_.
---
<a name="rrss-par"></a>[ir a Inicio](#inicio)
## Cómo Cambiar las Direcciones de Redes Sociales como *Parámetros de Plantilla*:
### Editar el Fichero `/templates/restaurante/templateDetails.xml`:
- añadir `<field>` con el campo `sep2`:
  ````xml
  <field name="sep2" type="spacer" label="> Opciones de Redes Sociales" />
  ````
- añadir `<field>` con el campo `google`:
  ````xml
  <field name="google" type="url" label="Google+" default="https://plus.google.com"
  description="Inserta tu dirección de Google+" />
  ````
- añadir `<field>` con el campo `twitter`:
  ````xml
  <field name="twitter" type="url" label="Twitter" default="https://twitter.com"
  description="Inserta tu dirección de Twitter" />
  ````
- añadir `<field>` con el campo `facebook`:
  ````xml
  <field name="facebook" type="url" label="Facebook" default="https://www.facebook.com"
  description="Inserta tu dirección de Facebook" />
  ````
### Editar el Fichero `/templates/restaurante/index.php`:
- añadir _variable para google_ `$google`, _variable para twitter_ `$twitter` y _variable para facebook_ `facebook`:
  ````php
  $google=$this->params->get('google');
  $twitter=$this->params->get('twitter');
  $facebook=$this->params->get('facebook');
  ````
- cambiar:
  ````php
  <a href="#" class="fa fa-google-plus">
  <a href="#" class="fa fa-twitter">
  <a href="#" class="fa fa-facebook">
  ````
  - por:
    ````php
    <a href="<?php echo $google; ?>" class="fa fa-google-plus">
    <a href="<?php echo $twitter; ?>" class="fa fa-twitter">
    <a href="<?php echo $telefono; ?>" class="fa fa-facebook">    
    ````
---
<a name="menu-mod"></a>[ir a Inicio](#inicio)
## Cómo Cambiar el Menú Principal en Joomla! (`/administrator/index.php`) como *Módulo*:
- ir a _Contenido > Gestor de categorias > Añadir nueva categoría_ y crear una nueva categoría `Nosotros`.
- ir a _Artículos_ y crear tantos artículos nuevos en esa categoría como opciones del menú: `Nosotros`, `Menu`, `Galeria`, `Pedidos Online`, `Contactanos` y `Blog`.
- ir a _Menús > Main Menu_ y crear tantos elementos de menú del tipo `Artículos > Mostrar un solo artículo` como opciones del menú: `Nosotros`, `Menu`, `Galeria`, `Pedidos Online`, `Contactanos` y `Blog`.
- ir a _Extensiones > Gestor de módulos_ y editar el módulo `Main Menu`:
  - escribir _Título_: `Menu Principal`.
  - elegir _Posición_: `menuprincipal`.
### Editar el Fichero `/templates/restaurante/index.php`:
- cambiar:
  ````php
  <ul>
    <li><a href="#">Inicio</a></li>
    <li><a href="#">Nosotros</a></li>
    <li><a href="#">Menú</a></li>
    <li><a href="#">Galería</a></li>
    <li><a href="#">Pedidos Online</a></li>
    <li><a href="#">Contáctanos</a></li>
    <li><a href="#">Blog</a></li>
  </ul>
  ````
  - por:
    ````php
    <jdoc:include type="modules" name="menuprincipal" style="none" />
    ````
### Editar el Fichero `/templates/restaurante/css/estilos.css`:
- cambiar para modificar el color de la opción de menú seleccionada:
  ````css
  nav.menu-principal ul li a:hover {
  ````
  - por:
    ````css
    nav.menu-principal ul li a:hover, nav.menu-principal ul li:active a {
    ````
---
<a name="presentacion-mod"></a>[ir a Inicio](#inicio)
## Cambiar la Presentación como *Módulo*:
> Nota: haciendo uso de un módulo externo de pago llamado **Layer Slider**.
### Editar el Fichero `/templates/restaurante/index.php`:
- cambiar el contenido de `<div class="contenedor">...</div>` de `<section class="presentacion">...</section>`:
  ````php
  <div class="texto-presentacion">
    <h1>EL PLACER DE COMER</h1>
    <h2>VEN  A DISFRUTAR DE LOS MEJORES PLATOS NACIONALES</h2>
    <a href="#" class="boton-principal">VER NUESTROS PLATOS</a>
  </div>
  <div class="images-presentacion">
    <img alt='Hamburguesa' data-src='<515:images/hamburguesa-chica.png,<770:images/hamburguesa-mediana.png,>771:images/hamburguesa.png' />
  </div>
  ````
  - por:
    ````php
    <jdoc:include type="modules" name="presentacion" style="none" />
    ````
---
<a name="bienvenido-par"></a>[ir a Inicio](#inicio)
## Cómo Cambiar la Sección Bienvenido como *Parámetro de Plantilla*:
### Editar el Fichero `/templates/restaurante/templateDetails.xml`:
- añadir `<field>` con el campo `sep3`:
  ````xml
  <field name="sep3" type="spacer" label="> Opciones de Bienvenido" />
  ````
- añadir `<field>` con el campo `bienvenido`:
  ````xml
  <field name="bienvenido" type="editor" label="Contenido de Bienvenido" filter="safehtml" />
  ````
### Entrar en Joomla! (`/administrator/index.php`):
- ir a _Extensiones > Gestor de plantillas_ y hacer click en el estilo _Restaurante_.
- ir a _Opciones de Plantilla > Contenido de Bienvenido_ y añadir el contenido de `<div class="contenedor">...</div>` de `<section class="bienvenidos">...</section>`:
  ````php
  <h2>BIENVENIDO AL RESTAURANTE MAESTRO</h2>
  <p>TE INVITAMOS A CONOCER MÁS DE NOSOTROS</p>
  <div class="bloque-bienvenidos">
    <figure>
      <a href="#">
        <img src="images/horario-atencion.png" alt="HORARIOS DE ATENCIÓN" />
        <h3>HORARIOS DE ATENCIÓN</h3>
      </a>
      <figcaption>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod, sit corrupti aperiam illo nam esse ratione, possimus sint dolores numquam libero architecto voluptates quae quam dolor incidunt veniam accusantium id.</figcaption>
    </figure>
    <figure>
      <a href="#">
        <img src="images/nuestra-carta.png" alt="NUESTRA CARTA" />
        <h3>NUESTRA CARTA</h3>
      </a>
      <figcaption>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod, sit corrupti aperiam illo nam esse ratione, possimus sint dolores numquam libero architecto voluptates quae quam dolor incidunt veniam accusantium id.</figcaption>
    </figure>
    <figure>
      <a href="#">
        <img src="images/nuestros-locales.png" alt="NUESTROS LOCALES" />
        <h3>NUESTROS LOCALES</h3>
      </a>
      <figcaption>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod, sit corrupti aperiam illo nam esse ratione, possimus sint dolores numquam libero architecto voluptates quae quam dolor incidunt veniam accusantium id. </figcaption>
    </figure>
  </div>
  ````
### Editar el Fichero `/templates/restaurante/index.php`:
- añadir _variable bienvenido_ `$bienvenido`:
  ````php
  $bienvenido=$this->params->get('bienvenido');
  ````
- cambiar:
  ````php
  <h2>BIENVENIDO AL RESTAURANTE MAESTRO</h2>
  <p>TE INVITAMOS A CONOCER MÁS DE NOSOTROS</p>
  <div class="bloque-bienvenidos">
    <figure>
      <a href="#">
        <img src="images/horario-atencion.png" alt="HORARIOS DE ATENCIÓN" />
        <h3>HORARIOS DE ATENCIÓN</h3>
      </a>
      <figcaption>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod, sit corrupti aperiam illo nam esse ratione, possimus sint dolores numquam libero architecto voluptates quae quam dolor incidunt veniam accusantium id.</figcaption>
    </figure>
    <figure>
      <a href="#">
        <img src="images/nuestra-carta.png" alt="NUESTRA CARTA" />
        <h3>NUESTRA CARTA</h3>
      </a>
      <figcaption>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod, sit corrupti aperiam illo nam esse ratione, possimus sint dolores numquam libero architecto voluptates quae quam dolor incidunt veniam accusantium id.</figcaption>
    </figure>
    <figure>
      <a href="#">
        <img src="images/nuestros-locales.png" alt="NUESTROS LOCALES" />
        <h3>NUESTROS LOCALES</h3>
      </a>
      <figcaption>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod, sit corrupti aperiam illo nam esse ratione, possimus sint dolores numquam libero architecto voluptates quae quam dolor incidunt veniam accusantium id. </figcaption>
    </figure>
  </div>
  ````
  - por:
    ````php
    <jdoc:include type="modules" name="bienvenido" style="none" />
    ````
---
<a name="contenido-mod"></a>[ir a Inicio](#inicio)
## Cambiar el Contenido Principal como *Módulo*:
### Entrar en Joomla! `(/administrator/index.php)`:
- ir a _Contenido > Gestor de artículos > Añadir nuevo artículo_ y crear un artículo nuevo `Pagina Inicial`.
- añadir el contenido de `<article class="quienes-somos">..</article>`:
  ````php
  <h2>BIENVENIDOS A SU RESTAURANTE</h2>
  <img src="images/quienes-somos.jpg" alt="¿QUIENES SOMOS?">
  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi voluptatem incidunt libero non voluptas maiores repellendus, placeat ut ratione! Provident odit perspiciatis maiores eaque soluta quae, beatae ex iusto at ratione! Provident odit perspiciatis maiores eaque soluta quae, beatae ex iusto <br> <a href="#">VER MÁS</a>
  </p>
  ````
- editar el enlace `VER MÁS` desde _JCE Editor_ para que apunte al elemento del _Menú Principal_ `Nosotros`:
  - en _Link_, elegir: _Menu > Main Menu > Nosotros_.
  - en _Advanced > Classes_, escribir: `ver-mas`.
- ir a _Menús > Main Menu_ y hacer click en el elemento `Home`:
  - cambiar _Título_: `Inicio`.
  - elegir _Tipo de elemento del menú_: `Mostrar un solo artículo`.
  - elegir _Seleccionar artículo_: `Pagina Inicial`.
  - en _Opciones_, elegir _Mostrar/Ocultar_, _Sí/No_ según el diseño. Para cambiar de manera global para todos los artículos, ir a _Sistema > Configuración global > Artículos_.
  - en _Visualización de la página > Mostrar el encabezado de la página_, elegir: `No`.
### Editar el Fichero `/templates/restaurante/index.php`:
- cambiar el contenido de `<article class="quienes-somos">...</article>`:
  ````php
  <h2>BIENVENIDOS A SU RESTAURANTE</h2>
  <img src="images/quienes-somos.jpg" alt="¿QUIENES SOMOS?">
  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi voluptatem incidunt libero non voluptas maiores repellendus, placeat ut ratione! Provident odit perspiciatis maiores eaque soluta quae, beatae ex iusto at ratione! Provident odit perspiciatis maiores eaque soluta quae, beatae ex iusto <br> <a href="#">VER MÁS</a>
  </p>
  ````
  - por:
    ````php
    <jdoc:include type="message" />
    <jdoc:include type="component" />
    ````
### Editar el Fichero `/templates/restaurante/css/estilos.css`:
- añadir en el contenido `main article h2 {..}` para poner todos los títulos de los artículos en mayúsculas:
  ````css
  text-transform: uppercase;
  ````
---
<a name="mapa-mod"></a>[ir a Inicio](#inicio)
## Cambiar el Mapa como *Módulo*:
> Nota: haciendo uso de un módulo externo llamado **Phoca Maps**.
### Editar el Fichero `/templates/restaurante/index.php`:
- cambiar el contenido de `<article class="aqui-estamos">...</article>`:
  ````php
  <h2>AQUÍ ESTAMOS</h2>
  <iframe src="https://www.google.com/maps/embed?..." width="100%" height="308" style="border:0"></iframe> 
  ````
  - por:
    ````php
    <jdoc:include type="modules" name="lateral" style="html5" />
    ````
> Nota: usar el estilo `html5` para que se ajuste mejor el mapa al diseño.
---
<a name="pie-par"></a>[ir a Inicio](#inicio)
## Cómo Cambiar el Pie de Página como *Parámetros de Plantilla*:
### Editar el Fichero `/templates/restaurante/templateDetails.xml`:
- añadir `<field>` con el campo `sep4`:
  ````xml
  <field name="sep4" type="spacer" label="> Opciones de Pie de Página" />
  ````
- añadir `<field>` con el campo `piepagina`:
  ````xml
  <field name="piepagina" type="text" label="Pie de Página" description="Inserta tu pie de página" />
  ````
### Editar el Fichero `/templates/restaurante/index.php`:
- añadir _variable de piepagina_ `$piepagina`:
  ````php
  $piepagina=$this->params->get('piepagina');
  ````
- cambiar:
  ````php
  <small> Copyright © 2014 Restaurante Maestro </small>
  ````
  - por:
    ````php
    <small><?php echo $piepagina; ?></small>
    ````
---
<a name="pagina-inicial"></a>[ir a Inicio](#inicio)
## Cómo Usar la Sección Bienvenido solo en la Página Inicial:
### Editar el Fichero `/templates/restaurante/index.php`:
- añadir _variable de menu_ `menu` y _variable de pagina inicial_ `inicio`:
  ````php
  $menu=&JSite::getMenu();
  $inicio=$menu->getActive()==$menu->getDefault();
  ````
- añadir delante de `<section class="bienvenidos">` para comprobar que el menú activo es el menú inicial:
  ````php
  <?php if($inicio) { ?>
  ````
- añadir detrás de `</section>`:
  ````php
  <?php } ?>
  ````
