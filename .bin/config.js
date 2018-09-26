const prompt = require('prompt');
const replace = require('replace-in-file');
const path = require('path');
const { snakeCase } = require('lodash');
const { blue } = require('chalk');

Object.assign(prompt, {
  colors: false,
  message: null,
});

/**
 * @see https://github.com/flatiron/prompt#valid-property-settings
 * @type {Object}
 */
const schema = {
  properties: {
    packageName: {
      description: blue("Gimme the Project name =>"),
      type: 'string',
      pattern: /^[a-zA-Z0-9_ ]*$/,
      default: 'Luuptek WP-Base',
      message: 'Error, you must use alpha-numeric (a-z, 0-9) name',
      required: true
    },
    // TODO: Dis =>
    // framework: {
    //   description: blue("Select which CSS-framework to use: \n 1) Bootstrap \n 2) Foundation \n 3) None \n"),
    //   pattern: /^[123]+$/,
    //   default: '1',
    //   message: 'You must select atleast one option',
    //   required: true
    // },
  }
};

prompt.start();

prompt.get(schema, function (err, result) {

  const replaceOptions = {
    files: [
      path.resolve(__dirname, '../**/*.php'),
      path.resolve(__dirname, '../style.css'),
    ],
    from: [/Luuptek WP-Base/g, /luuptek_wp_base/g],
    to: [result.packageName, snakeCase(result.packageName)],
  };

  replace(replaceOptions)
    .then(changedFiles => {
      console.log('Added project-information to %s files', changedFiles.length);
    })
    .catch(error => {
      console.error('Dafug, here\'s the error:', error);
    });
});
