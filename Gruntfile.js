module.exports = function(grunt) {
    'use strict';

    require('time-grunt')(grunt);

    grunt.initConfig({
        phpFiles: ['*.php', 'inc/*.php', 'partials/*.php'],

        jshint: {
            options: {
                jshintrc: '.jshintrc',
            },
            all: [
                'Gruntfile.js',
                'js/src/main.js',
            ]
        },

        jsvalidate: {
            check: {
                files: {
                    src: '<%= jshint.all %>'
                }
            }
        },

        jsonlint: {
            check: {
                src: [
                    '*.json'
                ],
                options: {
                    format: true,
                    indent: 2,
                }
            }
        },
        phpcs: {
            application: {
                src: '<%= phpFiles %>'
            },
            options: {
                bin: 'vendor/bin/phpcs',
                standard: 'PSR2'
            }
        },

        phplint: {
            options: {
            },
            all: '<%= phpFiles %>'
        },

        phpmd: {
            application: {
                dir: './'
            },
            options: {
                reportFormat: 'text',
                rulesets: 'codesize,unusedcode,naming,cleancode,controversial,design',
                bin: 'vendor/bin/phpmd',
                exclude: '.git,bower_components,css,js,node_modules,vendor',
                suffixes: 'php'
            }
        }

    });

    require('load-grunt-tasks')(grunt);

    grunt.registerTask('test', ['jsvalidate', 'jshint', 'jsonlint']);
    grunt.registerTask('check-php', ['phplint', 'phpcs', 'phpmd']);

};
