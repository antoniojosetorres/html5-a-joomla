# Cómo Convertir una Plantilla HTML5 a Joomla!
---
## Preparación
Copiar carpeta `proyecto` dentro de `/templates`.
Renombrar `/templates/proyecto/index.html` como `ìndex.php`.
Crear `/templates/proyecto/index.html` vacío.
Copiar `/templates/beez3/template_preview.png` y `template_thumbnail.png` en `/templates/proyecto`.
Copiar `/templates/beez3/templateDetails.xml` en la carpeta `/templates/proyecto`.

## Fichero `templateDetails.xml`
Editar `/templates/proyecto/templateDetails.xml` y cambiar:
- nombre de la carpeta `proyecto` en `<name>`:
  - `<name>proyecto</name>`  
- fecha de la plantilla en `<creationDate>`:
  -  `<creationDate>Febrero 2018</creationdate>`
- nombre del autor en `<author>`:
  - `<author>Antonio Jose Torres</author>`
- email del autor en `<authorEmail>`:
  - `<authorEmail>antoniojosetorres@gmail.com</authorEmail>`
- web del autor en `<authorUrl>`:
  - `<authorUrl>http://antoniojosetorres.es</authorUrl>`
- datos del copyright en `<copyright>`:
  - `<copyright>Copyright (C) 2018 antoniojosetorres. All rights reserved.</copyright>`
- número de versión en `<version>`:
  - `<version>1.0</version>`
- descripción de la plantilla en `<description>`:
  - `<description>Plantilla para Proyecto</description>`
- carpetas de la plantilla en `<folder>`:
  - `<folder>css</folder> ...`
- ficheros de la plantilla en `<filename>`:
  - `<filename>index.html</filename> ...`
- nombres de posiciones de módulos en `<position>`:
  - `<position>menuprincipal</position>`

## Plamtilla en Joomla!
Entrar en Joomla! mediante `/administrator/index.php`:
- ir a _Extensiones / Gestor de extensiones / Descubrir_ para instalar la plantilla `proyecto`.
- ir a _Extensiones / Gestor de plantillas_ para marcar como predeterminada la plantilla `proyecto`.

## Fichero `index.php`
Editar `/templates/proyecto/index.php`:
- añadir al comienzo una _línea de seguridad_:
  - `<?php defined('_JEXEC') or die; ?>`
- borrar las líneas de `<title>` y `<meta name>`
- subir `<script>` de `jquery.js` delante de `</head>`
- subir `<script>` de `modenizr.js` delante de `</head>`
- añadir `<jdoc:include type=”head” />`
- añadir _variable de ruta de sitio_ antes de `?>`:
  - `$ruta_s=JURI::base();`
- añadir _variable de ruta de plantilla_:
  - `$ruta_p=$ruta_s.”templates/”.$this->template.”/”;`
- añadir `<?php echo $ruta_p;?>` delante de `js` en `<script>`
- añadir `<?php echo $ruta_p;?>` delante de `css` en `<link>`

## Cambiar el logo como Módulo
Entrar en Joomla! mediante `/administrator/index.php`:
- ir a _Extensiones / Gestor de módulos_ para crear un módulo para el logo.
- pulsar botón _Nuevo_ y elegir la opción _HTML personalizado_.
- escribir Título: `Logo`.
- elegir Posición: `logo`.
- insertar la imagen `logo.png` con _JCE Editor_:
  - `<img src=”images/logo.png” alt=”logo”>`
- comprobar la configuración de _JCE Editor_:
  - ir a _Componentes / JCE Editor / Global Configuration_.
  - en _Formatting & Display / Container Element & Enter Key_: `No Container & Paragraph on Enter`
  - en _Cleanup & Output / Validate HTML_: `No`

Editar `/templates/proyecto/index.php`:
- cambiar `<img src=”images/logo.png” alt=”logo”>` por `<jdoc:include type=”modules” name=”logo” style=”none” />`
- cambiar `<a href=”#” class=”logo”>` por `<a href=”<?php echo $ruta_s;?>” class=”logo”>`

Crear carpeta `html` en `/templates/proyecto` para sobrescribir (override) la plantilla.
Copiar `/modules/mod_custom` en `/templates/proyecto/html`.
Borrar `/templates/proyecto/html/mod_custom/mod_custom.php` y `mod_custom.xml`.
Copiar `/templates/proyecto/html/mod_custom/tmpl/default.php` en `/templates/proyecto/html/mod_custom/proyecto.php`.
Borrar la carpeta `/templates/proyecto/html/mod_custom/tmpl`.

Editar `/templates/proyecto/html/mod_custom/proyecto.php`:
- borrar `<div>` y `</div>` dejando `<?php echo $module->content;?>` para no insertar `<div class=”custom”>` en los módulos _HTML personalizado_.

Entrar en Joomla! mediante `/administrator/index.php`:
- ir a _Extensiones / Gestor de módulos_.
- hacer click en el módulo _Logo_.
- ir a _Avanzado / Presentación alternativa_.
- elegir _---Desde plantilla--- / proyecto_.

## Cambiar el logo como Parámetro de Plantilla
Editar `/templates/proyecto/templateDetails.xml`:
- crear `<fieldset>` con el parámetro `opciones` y el campo `logo`:
  `<fieldset name=”opciones” label=”Opciones de Plantilla”>`
  `<field name=”logo” type=”media” label=”Logo” description=”Inserta tu logo” />`
  `</fieldset>`

Editar `/templates/proyecto/index.php`:
- añadir _variable de aplicación_ después de la variable `$ruta_p`: `$app=JFactory::getApplication();`
- añadir _variable de parámetros_: `$params=$app->getParams();`
- añadir _variable de logo_: `$logo=$this->params->get('logo')`;
- cambiar `<img src=”images/logo.png” alt=”logo”>` por
`<img src=”<?php echo $logo;>” alt=”logo”>`
- cambiar `<a href=”#” class=”logo”>` por
`<a href=”<?php echo $ruta_s;?>” class=”logo”>`

## Cambiar el número de teléfono como Parámetro de Plantilla
Editar `/templates/proyecto/templateDetails.xml`:
- añadir `<field>` con el campo `telefono` en `<fieldset name=”opciones”>`: `<field name=”telefono” type=”tel” label=”Teléfono” default=”658 621 946” description=”Inserta tu número de teléfono” />`

Editar `/templates/proyecto/index.php`:
- añadir _variable de telefono_: `$telefono=$this->params->get('telefono');`
- cambiar `<a href=”tel:658 621 946” class=”telefono”>` por
`<a href=”tel:<?php echo $telefono;?>” class=”telefono”>`

## Agrupar Opciones en Backend de Plantilla
Editar `/templates/proyecto/templateDetails.xml`:
- añadir `<field>` con el campo `sep1` en `<fieldset name=”opciones”>`: `<field name=”sep1” type=”spacer” label=”Opciones de Encabezado” />`

## Cambiar la caja de búsqueda como Módulo
Entrar en Joomla! mediante `/administrator/index.php`:
- ir a _Extensiones / Gestor de módulos_ para crear un módulo para la caja de búsqueda.
- pulsar botón _Nuevo_ y elegir la opción _Buscar_.
- escribir Título: `Caja de busqueda`.
- elegir Posición: `buscar`.
- escribir texto del campo: `Buscar...`.

Editar `/templates/proyecto/index.php`:
- cambiar `<form action=”index.html”><input type=”text” name=”buscar” placeholder=”Buscar…”></form>` por `<jdoc:include type=”modules” name=”buscar” style=”none” />`

Copiar `/modules/mod_search en /templates/proyecto/html`.
Borrar `/templates/proyecto/html/mod_search/mod_search.php`, `mod_search.xml` y `helper.php`.
Copiar `/templates/proyecto/html/mod_search/tmpl/default.php` en `/templates/proyecto/html/mod_search`.
Borrar la carpeta `/templates/proyecto/html/mod_search/tmpl` .

Editar `/templates/proyecto/html/mod_search/default.php`:
- borrar `<div>` y `</div>` dejando `<form...>` para no insertar `<div class=”search”>` en los módulos _Buscar_.
- borrar `<label>` y `</label>` dejando `<form...>` para que no aparezca la palabra _Buscar_ delante de la caja de búsqueda.

Entrar en Joomla! mediante `/administrator/index.php`:
- ir a _Extensiones / Gestor de módulos_.
- hacer click en el módulo _Caja de busqueda_.
- ir a _Avanzado / Presentación alternativa_.
- elegir _---Desde plantilla--- / proyecto_.
