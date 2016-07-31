module.exports = function(grunt) {
    'use strict';

    require('time-grunt')(grunt);

    grunt.initConfig({
        phpFiles: ['*.php', 'inc/*.php', 'partials/*.php'],

        sass: {
            dev: {
                options: {
                    style: 'expanded'
                },
                files: {
                    'css/main.min.css': ['css/src/main.scss']
                }
            },
            dist: {
                options: {
                    style: 'compressed',
                    noCache: true
                },
                files: '<%= sass.dev.files %>'
            },
        },

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

        browserify: {
            dev: {
                options: {
                    debug: true,
                },
                files: {
                    'js/main.js': ['js/src/main.js']
                }
            },
            dist: {
                options: {
                    debug: false
                },
                files: '<%= browserify.dev.files %>'
            }
        },

        uglify: {
            dev: {
                options: {
                    mangle: false,
                    beautify: true,
                    compress: false,
                    preserveComments: 'all',
                    sourceMap: true
                },
                files: {
                    'js/main.min.js': ['js/main.js']
                }
            },
            dist: {
                options: {
                    sourceMap: true
                },
                files: '<%= uglify.dev.files %>'
            },
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
        },

        watch: {
            js: {
                files: ['js/src/main.js'],
                tasks: ['check-js', 'browserify:dev', 'uglify:dev'],
                options: {
                    livereload: true
                }
            },
            sass: {
                files: ['css/src/*.scss'],
                tasks: ['sass:dev'],
                options: {
                    livereload: true,
                },
            },
            json: {
                files: ['*.json'],
                tasks: ['jsonlint']
            },
        }

    });

    require('load-grunt-tasks')(grunt);

    grunt.registerTask('dist', ['sass:dist', 'check-js', 'browserify:dist', 'uglify:dist']);
    grunt.registerTask('dev', ['sass:dev', 'check-js', 'browserify:dev', 'uglify:dev']);
    grunt.registerTask('check-php', ['phplint', 'phpcs', 'phpmd']);
    grunt.registerTask('check-js', ['jsvalidate', 'jshint']);
    grunt.registerTask('default', ['dev', 'watch']);

};
