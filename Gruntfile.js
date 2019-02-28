module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    // build css
    sass: {
      loaderBoxes {
          files: {
              'layout/loaders/boxes/index.css': 'layout/src/scss/loaders/boxes.scss',
              'layout/loaders/curves/index.css': 'layout/src/scss/loaders/curves.scss'
          }
      },
      main: {
        files: {
          'layout/<%= pkg.name %>.css': 'layout/src/main.scss'
        }
      }
    },

    // minify css
    cssmin: {
      loaderBoxes {
          files: {
              'layout/loaders/boxes/index.min.css': 'layout/loaders/boxes/index.css',
              'layout/loaders/curves/index.min.css': 'layout/loaders/curves/index.css'
          }
      },
      build: {
        src: 'layout/src/<%= pkg.name %>.css',
        dest: 'layout/<%= pkg.name %>.min.css'
      },
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
                'layout/src/js/angular/app.js'
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
        dev: {
            options: {
                position: 'top',
                banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */',
                linebreak: true
            },
            files: {
                src: [ 'layout/css/<%= pkg.name %>.min.css', 'layout/js/<%= pkg.name %>.min.js', 'layout/js/service-worker.min.js' ]
            }
        }
    },

    // remove mess left by build process
    clean: [
        'layout/loaders/boxes/index.css',
        'layout/loaders/boxes/index.css.map',
        'layout/loaders/curves/index.css',
        'layout/loaders/curves/index.css.map',
        'layout/js/service-worker.js',
        'layout/js/app.js',
        'layout/css/<%= pkg.name %>.css',
        'layout/src/<%= pkg.name %>.css.map',
        '.sass-cache/'
    ],

  });

  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-banner');

  grunt.registerTask('default', ['sass', 'cssmin', 'concat', 'uglify', 'usebanner', 'clean']);

};
