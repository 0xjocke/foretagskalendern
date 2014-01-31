module.exports = function(grunt) {

    // 1. All configuration goes here 
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        watch: {
            options: {
                livereload: true,
            },
            compass: {
                files: ['sass/**/*.scss'],
                tasks: ['compass:dev']
         },
            js: {
                files: ['public_html/js/**/*.js'],
                tasks: ['uglify']
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
                    require: 'susy',                            
                    sassDir: 'sass',
                    cssDir: 'public_html/css',
                    environment: 'production',
                    outputStyle: 'compressed',
                    relativeAssets: true
                }
            }
        },
        livereload: {
            // Here we watch the files the sass task will compile to
            // These files are sent to the live reload server after sass compiles to them
            options: { livereload: true },
            files: ['views/**/*'],
        }

    });

    // 3. Where we tell Grunt we plan to use this plug-in.
    grunt.loadNpmTasks('grunt-contrib-compass');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
    grunt.registerTask('default', ['watch', 'compass:dev']);

};