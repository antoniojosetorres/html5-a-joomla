# Cómo Convertir una Plantilla HTML5 a Joomla!

### Preparación:
- copiar carpeta `restaurante` dentro de `/templates`.
- renombrar `/templates/restaurante/index.html` como `ìndex.php`.
- crear `/templates/restaurante/index.html` vacío.
- copiar `/templates/beez3/template_preview.png` y `template_thumbnail.png` en `/templates/restaurante`.
- copiar `/templates/beez3/templateDetails.xml` en la carpeta `/templates/restaurante`.

### Editar Fichero `/templates/restaurante/templateDetails.xml`:
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
- cambiar en el bloque `<files>..</files>` las carpetas de la plantilla:
  ````xml
  <folder>css</folder>
  <folder>fonts</folder>
  <folder>images</folder>
  <folder>js</folder>
  ````
- cambiar en el bloque `<files>..</files>` los ficheros de la plantilla:  
  ````xml
  <filename>index.html</filename>
  <filename>index.php</filename>
  <filename>templateDetails.xml</filename>
  <filename>template_preview.png</filename>
  <filename>template_thumbnail.png</filename>
  <filename>favicon.ico</filename>
  ````
- cambiar en el bloque `<positions>..</positions>` los nombres de las posiciones de los módulos:
  ````xml
  <position>buscar</position>
  <position>menuprincipal</position>
  <position>presentacion</position>
  <position>lateral</position>
  ````

### Cambiar Plantilla en Joomla! (`/administrator/index.php`):
- ir a _Extensiones / Gestor de extensiones / Descubrir_ para instalar la plantilla `restaurante`.
- ir a _Extensiones / Gestor de plantillas_ para marcar como predeterminada la plantilla `restaurante`.

### Editar Fichero `/templates/restaurante/index.php`:
- añadir al comienzo una _línea de seguridad_:
  ````php
  <?php defined('_JEXEC') or die; ?>
  ````
- borrar `<title>Restaurante Maestro</title>` (será generada por Joomla!).
- borrar `<meta name="description" content="">` (será generada por Joomla!).
- poner `<script src="js/jquery-2.1.1.min.js"></script>` delante de `</head>`.
- poner `<script src="js/modernizr-2.6.2-respond-1.1.0.min.js"></script>` delante de `</head>`.
- añadir `<jdoc:include type="head" />` entre `<script>` y `<link>`.
- añadir _variable de ruta de sitio_ `$ruta_s` delante de `?>`:
  ````php
  $ruta_s=JURI::base();
  ````
- añadir _variable de ruta de plantilla_ `$ruta_p`:
  ````php
  $ruta_p=$ruta_s."templates/".$this->template."/";
  ````
- añadir `<?php echo $ruta_p;?>` delante de `js` en `<script>`.
- añadir `<?php echo $ruta_p;?>` delante de `css` en `<link>`.
---
## Cambiar Logo en Joomla! (`/administrator/index.php`) como *Módulo*:
- ir a _Extensiones / Gestor de módulos_ para crear un módulo para el logo.
- pulsar botón _Nuevo_ y elegir la opción _HTML personalizado_.
  - escribir Título: `Logo`.
  - elegir Posición: `logo`.
  - insertar la imagen `logo.png` con _JCE Editor_:
    ````html
    <img src="images/logo.png" alt="logo">
    ````
- comprobar la configuración de _JCE Editor_:
  - ir a _Componentes / JCE Editor / Global Configuration_.
  - en _Formatting & Display / Container Element & Enter Key_: `No Container & Paragraph on Enter`.
  - en _Cleanup & Output / Validate HTML_: `No`.

### Editar Fichero `/templates/restaurante/index.php`:
- cambiar:
  ````php
  <a href="#" class="logo">
  <!-- por -->
  <a href="<?php echo $ruta_s; ?>" class="logo">
  ````
- cambiar:
  ````php
  <img src="images/logo.png" alt="logo">
  <!-- por -->
  <jdoc:include type="modules" name="logo" style="none" />
  ````

### Duplicar Módulo *mod_custom* para Sobreescribirlo (Override):
- crear carpeta `html` en `/templates/restaurante`.
- copiar `/modules/mod_custom` en `/templates/restaurante/html`.
- borrar `/templates/restaurante/html/mod_custom/mod_custom.php` y `mod_custom.xml`.
- copiar `/templates/restaurante/html/mod_custom/tmpl/default.php` en `/templates/restaurante/html/mod_custom/restaurante.php`.
- borrar la carpeta `/templates/restaurante/html/mod_custom/tmpl`.

### Editar Fichero `/templates/restaurante/html/mod_custom/restaurante.php`:
- borrar `<div>` y `</div>` dejando `<?php echo $module->content;?>` para no insertar `<div class="custom">` en los módulos _HTML personalizado_.

### Elegir Módulo *mod_custom* Personalizado (override) en Joomla! (`/administrator/index.php`):
- ir a _Extensiones / Gestor de módulos_.
- hacer click en el módulo _Logo_.
- ir a _Avanzado / Presentación alternativa_.
- elegir _---Desde plantilla--- / restaurante_.
---
## Cambiar Logo como *Parámetro de Plantilla*:
### Editar Fichero `/templates/restaurante/templateDetails.xml`:
- crear `<fieldset>` con el parámetro `opciones` y el campo `logo`:
    `<fieldset name="opciones" label="Opciones de Plantilla">`
      `<field name="logo" type="media" label="Logo" description="Inserta tu logo" />`
    `</fieldset>`

### Editar Fichero `/templates/restaurante/index.php`:
- añadir _variable de aplicación_ `$app` después de la variable `$ruta_p`: `$app=JFactory::getApplication();`.
- añadir _variable de parámetros_ `$params`: `$params=$app->getParams();`.
- añadir _variable de logo_ `$logo`: `$logo=$this->params->get('logo');`.
- cambiar `<a href="#" class="logo">` por `<a href="<?php echo $ruta_s;?>" class="logo">`.
- cambiar `<img src="images/logo.png" alt="logo">` por `<img src="<?php echo $logo;>" alt="logo">`.
---
## Cambiar Número de Teléfono como *Parámetro de Plantilla*:
### Editar Fichero `/templates/restaurante/templateDetails.xml`:
- añadir `<field>` con el campo `telefono` en `<fieldset name="opciones">`: `<field name="telefono" type="tel" label="Teléfono" default="658 621 946" description="Inserta tu número de teléfono" />`

### Editar Fichero `/templates/restaurante/index.php`:
- añadir _variable de telefono_ `$telefono`: `$telefono=$this->params->get('telefono');`
- cambiar `<a href="tel:666 123 456" class="telefono">` por `<a href="tel:<?php echo $telefono;?>" class="telefono">`

### Editar Fichero `/templates/restaurante/templateDetails.xml` para Agrupar Opciones de Plantilla en Backend:
- añadir `<field>` con el campo `sep1` en `<fieldset name="opciones">`: `<field name="sep1" type="spacer" label="Opciones de Encabezado" />`
---
## Cambiar Caja de Búsqueda en Joomla! (`/administrator/index.php`) como *Módulo*:
- ir a _Extensiones / Gestor de módulos_ para crear un módulo para la caja de búsqueda.
- pulsar botón _Nuevo_ y elegir la opción _Buscar_.
- escribir Título: `Caja de busqueda`.
- elegir Posición: `buscar`.
- escribir texto del campo: `Buscar...`.

### Editar Fichero `/templates/restaurante/index.php`:
- cambiar `<form action="index.html"><input type="text" name="buscar" placeholder="Buscar…"></form>` por `<jdoc:include type="modules" name="buscar" style="none" />`

### Duplicar Módulo *mod_search* para Sobreescribirlo (Override):
- copiar `/modules/mod_search en /templates/restaurante/html`.
- borrar `/templates/restaurante/html/mod_search/mod_search.php`, `mod_search.xml` y `helper.php`.
- copiar `/templates/restaurante/html/mod_search/tmpl/default.php` en `/templates/restaurante/html/mod_search`.
- renombrar `/templates/restaurante/html/mod_search` como `restaurante.php`.
- borrar la carpeta `/templates/restaurante/html/mod_search/tmpl`.

### Editar Fichero `/templates/restaurante/html/mod_search/restaurante.php`:
- borrar `<div>` y `</div>` dejando `<form...>` para no insertar `<div class="search">` en los módulos _Buscar_.
- borrar `<label>` y `</label>` dejando `<form...>` para que no aparezca la palabra _Buscar_ delante de la caja de búsqueda.

### Elegir Módulo *mod_search* Personalizado (override) en Joomla! (`/administrator/index.php`):
- ir a _Extensiones / Gestor de módulos_.
- hacer click en el módulo _Caja de busqueda_.
- ir a _Avanzado / Presentación alternativa_.
- elegir _---Desde plantilla--- / restaurante_.
---
## Cambiar Direcciones de Enlaces a Redes Sociales como *Parámetros de Plantilla*:
### Editar Fichero `/templates/restaurante/templateDetails.xml`:
- añadir `<field>` con el campo `sep2` en `<fieldset name="opciones">`: `<field name="sep2" type="spacer" label="Opciones de Redes Sociales" />`
- añadir `<field>` con el campo `google` en `<fieldset name="opciones">`: `<field name="google" type="url" label="Google+" default="https://plus.google.com" description="Inserta tu dirección de Google+" />`
- añadir `<field>` con el campo `twitter` en `<fieldset name="opciones">`: `<field name="twitter" type="url" label="Twitter" default="https://twitter.com" description="Inserta tu dirección de Twitter" />`
- añadir `<field>` con el campo `facebook` en `<fieldset name="opciones">`: `<field name="facebook" type="url" label="Facebook" default="https://www.facebook.com" description="Inserta tu dirección de Facebook" />`

### Editar Fichero `/templates/restaurante/index.php`:
- añadir _variable para google_ `$google`: `$google=$this->params->get('google');`
- añadir _variable para twitter_ `$twitter`: `$twitter=$this->params->get('twitter');`
- añadir _variable para facebook_ `$facebook`: `$facebook=$this->params->get('facebook');`
- cambiar `<a href="#" class="fa fa-google-plus">` por `<a href="<?php echo $google;?>" class="fa fa-google-plus">`
- cambiar `<a href="#" class="fa fa-twitter">` por `<a href="<?php echo $twitter;?>" class="fa fa-twitter">`
- cambiar `<a href="#" class="fa fa-facebook">` por `<a href="<?php echo $telefono;?>" class="fa fa-facebook">`
---
## Cambiar Menú Principal en Joomla! (`/administrator/index.php`) como *Módulo*:
- ir a _Contenido / Gestor de categorias / Añadir nueva categoría_ y crear una categoría `Nosotros`.
- ir a _Artículos_ y crear tantos artículos nuevos en esa categoría como opciones del menú: `Nosotros`, `Menu`, `Galeria`, `Pedidos Online`, `Contactanos` y `Blog`.
- ir a _Menús / Main Menu_ y crear tantos elementos de menú del tipo `Artículos > Mostrar un solo artículo` como opciones del menú: `Nosotros`, `Menu`, `Galeria`, `Pedidos Online`, `Contactanos` y `Blog`.
- ir a _Extensiones / Gestor de módulos_ y editar el módulo `Main Menu`.
  - escribir Título: `Menu Principal`.
  - elegir Posición: `menuprincipal`.

### Editar Fichero `/templates/restaurante/index.php`:
- cambiar el bloque `<ul>...</ul>` por `<jdoc:include type="modules" name="menuprincipal" style="none" />`.

### Editar Fichero `/templates/restaurante/css/estilos.css`:
- cambiar la línea `nav.menu-principal ul li a:hover` por `nav.menu-principal ul li a:hover, nav.menu-principal ul li:active a` para que cambie de color la opción de menú seleccionada.
---
### Cambiar Sección Bienvenido como *Parámetro de Plantilla*:
### Editar Fichero `/templates/restaurante/templateDetails.xml`:
- añadir `<field>` con el campo `sep3` en `<fieldset name="opciones">`: `<field name="sep3" type="spacer" label="Opciones de Bienvenido" />`.
- añadir `<field>` con el campo `bienvenido` en `<fieldset name="opciones">`: `<field name="bienvenido" type="editor" label="Contenido de Bienvenido" filter="safehtml" />`.

### Editar Fichero `/templates/restaurante/index.php`:
- por:
````php
<h2>BIENVENIDO AL RESTAURANTE MAESTRO</h2>
<p>TE INVITAMOS A CONOCER MÁS DE NOSOTROS</p>
<div class="bloque-bienvenidos">
<figure><a href="#"> <img src="images/horario-atencion.png" alt="HORARIOS DE ATENCIÓN" />
<h3>HORARIOS DE ATENCIÓN</h3>
</a> <figcaption>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod, sit corrupti aperiam illo nam esse ratione, possimus sint dolores numquam libero architecto voluptates quae quam dolor incidunt veniam accusantium id.</figcaption></figure>
<figure><a href="#"> <img src="images/nuestra-carta.png" alt="NUESTRA CARTA" />
<h3>NUESTRA CARTA</h3>
</a> <figcaption>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod, sit corrupti aperiam illo nam esse ratione, possimus sint dolores numquam libero architecto voluptates quae quam dolor incidunt veniam accusantium id.</figcaption></figure>
<figure><a href="#"> <img src="images/nuestros-locales.png" alt="NUESTROS LOCALES" />
<h3>NUESTROS LOCALES</h3>
</a> <figcaption>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod, sit corrupti aperiam illo nam esse ratione, possimus sint dolores numquam libero architecto voluptates quae quam dolor incidunt veniam accusantium id. </figcaption></figure>
</div>
````
