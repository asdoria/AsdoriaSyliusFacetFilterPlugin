const Encore = require('@symfony/webpack-encore');
const path = require('path');
const fs = require('fs');

const basePath = path.resolve(__dirname, './');
const assets_path = path.join(basePath, './src/Resources/private');
const output_path = path.join(basePath, './src/Resources/public');
const public_path = 'bundles/asdoriafacet';
const sass_path = path.join(assets_path, './sass');
const js_path = path.join(assets_path, './js');
const isProduction = Encore.isProduction();

Encore
  // empty the outputPath dir cd ../before each build
  .cleanupOutputBeforeBuild()

  // directory where all compiled assets will be stored
  .setOutputPath(output_path)

  .setPublicPath('/' + public_path)
  .setManifestKeyPrefix(public_path)

  .addEntry('admin-facet-filter', [
    path.join(js_path, './admin.js'),
  ])

  // allow sass/scss files to be processed
  .enableSassLoader()
  .enablePostCssLoader()

  // allow legacy applications to use $/jQuery as a global variable
  .autoProvidejQuery()

  .enableSourceMaps(!isProduction)

  .disableSingleRuntimeChunk()

  // create hashed filenames (e.g. app.abc123.css)
  .enableVersioning(isProduction)
  .configureFilenames({
    js: '[name].min.js',
    css: '[name].min.css',
  })
;

config = Encore.getWebpackConfig();

module.exports = config;
