var zlib = require("zlib");
module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    // build css
    sass: {
      loaderBoxes: {
          files: {
              'layout/loaders/boxes/index.css': 'layout/src/scss/loaders/boxes.scss',
              'layout/loaders/curves/index.css': 'layout/src/scss/loaders/curves.scss'
          }
      },
      main: {
        files: {
          'layout/css/main.css': 'layout/src/scss/main.scss'
        }
      }
    },

    // minify css
    cssmin: {
      loaderBoxes: {
          files: {
              'layout/loaders/boxes/index.min.css': 'layout/loaders/boxes/index.css',
              'layout/loaders/curves/index.min.css': 'layout/loaders/curves/index.css',
              'layout/css/main.min.css': 'layout/css/main.css'
          }
      }
    },

    // don't mess with angular code
    ngAnnotate: {
        options: {
            singleQuotes: true
        },
        app: {
            files: {
                'layout/src/js/app-min-safe/bundle.js': ['layout/src/js/app/**/*.js'],
                'layout/src/js/app-min-safe/app.js': ['layout/src/js/app.js'],
            }
        }
    },

    // combine javascript
    concat: {
      serviceWorker: {
          src: [
                'layout/src/js/service-worker/configuration.js',
                'layout/src/js/service-worker/worker.js'
          ],
          dest: 'layout/js/service-worker.js'
      },
      app: {
          src: [
                'layout/src/js/app-min-safe/app.js',
                'layout/src/js/app-min-safe/bundle.js'
          ],
          dest: 'layout/js/app.js'
      }
    },

    // minify javascript
    uglify: {
      options: {
        banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */'
      },
      dist: {
        files: {
          'layout/js/service-worker.min.js': ['<%= concat.serviceWorker.dest %>'],
          'layout/js/app.min.js': ['<%= concat.app.dest %>']
        }
      }
    },

    // force banner use
    usebanner: {
        dist: {
            options: {
                position: 'top',
                banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */',
                linebreak: true
            },
            files: {
                src: [ 'layout/css/main.min.css', 'layout/js/app.min.js', 'layout/js/service-worker.min.js' ]
            }
        }
    },

    // gzip assets in use for smallest possible size
    compress: {
        dist: {
            options: {
                mode: 'gzip',
                level: zlib.constants.Z_BEST_COMPRESSION
            },
            files: {
               'layout/js/app.min.js.gz': ['layout/js/app.min.js'],
               'layout/css/main.min.css.gz': ['layout/css/main.min.css']
            }
        }
    },

    // remove mess left by build process
    clean: [
        'layout/loaders/boxes/index.css',
        'layout/loaders/boxes/index.css.map',
        'layout/loaders/curves/index.css',
        'layout/loaders/curves/index.css.map',
        'layout/css/main.css',
        'layout/css/main.css.map',
        'layout/js/service-worker.js',
        'layout/js/app.js',
        '.sass-cache/',
        'layout/src/js/app-min-safe/'
    ],

  });

  grunt.loadNpmTasks('grunt-ng-annotate');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-compress');
  grunt.loadNpmTasks('grunt-banner');

  grunt.registerTask('default', ['sass', 'cssmin', 'ngAnnotate', 'concat', 'uglify', 'usebanner', 'compress', 'clean']);

};
