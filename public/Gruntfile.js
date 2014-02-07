module.exports = function(grunt) {

    // 1. All configuration goes here 
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        watch: {
            compass: {
                files: ['sass/**/*.scss'],
                tasks: ['compass:dev']
            },
            js: {
                files: ['js/*.js'],
                tasks: ['concat:all']
            }
        },
        compass: {
            dev: {
                options: {
                    sassDir: 'sass',
                    cssDir: 'views/pdf/css'
                }
            },
            prod: {
                options: {
                    sassDir: 'sass',
                    cssDir: 'views/pdf/css',
                    environment: 'production',
                    outputStyle: 'compressed'
                }
            }
        },
        concat: {
            all: {
                src: ['js/header.js',
                    'js/Foretagskalendern.js',
                    'js/Validator.js',
                    'js/eventchecker.js',
                    'js/footer.js'],
                dest: 'js/build/public.js'    //output
            }
        },
        uglify:{
            prod: {
                files: {'js/build/public.js': 'js/build/public.js'}    //output
            }
        }
    });

    // 3. Where we tell Grunt we plan to use this plug-in.
    grunt.loadNpmTasks('grunt-contrib-compass');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');

    // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
    grunt.registerTask('default', ['watch']);
    grunt.registerTask('prod', ['compass:prod','uglify:prod']);

};