var fs = require('fs');

/**
 * This file exports the content of your website, as a bunch of concatenated
 * Markdown files. By doing this explicitly, you can control the order
 * of content without any level of abstraction.
 *
 * Using the brfs module, fs.readFileSync calls in this file are translated
 * into strings of those files' content before the file is delivered to a
 * browser: the content is read ahead-of-time and included in bundle.js.
 */
module.exports =
  '# Introducción\n' +
  fs.readFileSync('./content/introduccion.md', 'utf8') + '\n' +
  '# Camas\n' +
  fs.readFileSync('./content/camas.md', 'utf8') + '\n' + 
  '# Habitaciones\n' +
  fs.readFileSync('./content/habitaciones.md', 'utf8') + '\n' +
  '# Salas\n' +
  fs.readFileSync('./content/salas.md', 'utf8') + '\n' +
  '# Sincronización\n' +
  fs.readFileSync('./content/sincronizacion.md', 'utf8') + '\n';
