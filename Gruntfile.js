module.exports = function(grunt) {
    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        concat: {
            basic: {
                src: ['bower_components/jquery/dist/jquery.slim.js', 'bower_components/bootstrap/js/dist/*.js', 'bower_components/smoothscroll/dist/smoothscroll.js', '_build/js/basic/*.js'],
                dest: 'assets/js/src/basic.js'
            },
            forms: {
                src: ['bower_components/jquery-validation/dist/jquery.validate.js'],
                dest: 'assets/js/src/forms.js'
            }
        },
        uglify: {
            options: {
                banner: '/*! <%= pkg.name %> v<%= pkg.version %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
            },
            basic: {
                src: 'assets/js/src/basic.js',
                dest: 'assets/js/dist/basic.min.js'
            },
            forms: {
                src: ['assets/js/src/forms.js'],
                dest: 'assets/js/dist/forms.min.js'
            },
            all: {
                src: ['assets/js/src/basic.js', 'assets/js/src/forms.js'],
                dest: 'assets/js/dist/all.min.js'
            }
        },
        watch: {
            scripts: {
                files: ['<config:concat.basic.src>', '<config:concat.forms.src>', '<config:concat.quote.src>', '<config:uglify.forms.src>'],
                tasks: ['concat', 'uglify'],
                options: {
                    spawn: false,
                },
            },
        }
    });
    // Load plugins required to run taks.
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-watch');
    // Set default tasks that are executed simply with 'grunt'
    grunt.registerTask('default', ['concat'], ['uglify']);
};
