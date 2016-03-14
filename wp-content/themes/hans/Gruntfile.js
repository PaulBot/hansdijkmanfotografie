module.exports = function (grunt) {

	// Time how long tasks take. Can help when optimizing assets times
   require('time-grunt')(grunt);

   // Load grunt tasks automatically
   require('load-grunt-tasks')(grunt);

   	grunt.initConfig({

   	 	pkg: grunt.file.readJSON('package.json'),

   	 	 // Empties assets folder to start fresh
	     clean: {
	        assets: {
	            files: [{
	               	dot: true,
	               	src: [
	               		'.tmp/',
	               		'assets/*'
	               	]
	            }]
	        }  
	    },

	    jshint: {
         	options: {
            	jshintrc: '.jshintrc',
            	reporter: require('jshint-stylish')
        	},
	        all: [
	            'Gruntfile.js',
	            'scripts/{,*/}*.js'
	        ]
      	},

   	 	compass: {
	        options: {
	            sassDir: 'dev/styles',
	            cssDir: '.tmp/styles',
	            imagesDir: 'dev/img',
	            javascriptsDir: 'dev/scripts',
	            fontsDir: 'styles/fonts',
	            generatedImagesDir: 'assets/images',
	            importPath: 'bower_components',
	            httpImagesPath: '../images',
	            httpGeneratedImagesPath: 'assets/images',
	            httpFontsPath: 'fonts',
	            relativeAssets: false,
	            assetCacheBuster: false
	        },
	        dist: {
	            options: {
	               generatedImagesDir: 'assets/images'
	            }
	        },
	        server: {
	            options: {
	               debugInfo: false
	            }
	        }
      	},


      	postcss: {
  		  	options: {
  		    	map: true,
  		    	processors: [
  		      		require('autoprefixer')({browsers: ['> 1%', 'ie 8', 'ie 9', 'last 2 versions', 'Firefox ESR', 'Opera 12.1']})
  		    	]
  		  	},
  		  	dist: {
  		    	files: [{
                 		expand: true,
                 		cwd: '.tmp/styles/',
                 		src: '{,*/}*.css',
                 		dest: '.tmp/styles/'
              	}]
  		  	}
  		},

      	bower_concat: {
         	all: {
            	dest: '.tmp/scripts/vendor.js',
              cssDest: '.tmp/styles/bower.css',
            	bowerOptions: {
               		relative: false
            	},
            	exclude: [
	               'jquery',
	               'modernizr',
                 'font-awesome'
	            ]
         	}
      	},

        concat: {
            options: {
                separator: ';'
            },
            build: {
                src: ['.tmp/scripts/vendor.js', '.tmp/scripts/*.js'],
                 dest: 'assets/scripts/scripts.js'
            },
            serve:{
                src: [
                  'dev/scripts/*.js', 
                  '!dev/scripts/admin_scripts.js', 
                  '!dev/scripts/jMosaic.js',
                  '!dev/scripts/custom-scrollbar.js'
                  ],
                dest: 'assets/scripts/main.js'
            }
        },

      	imagemin: {
         	dist: {
            	files: [{
               		expand: true,
               		cwd: 'dev/img',
               		src: '{,*/}*.{gif,jpeg,jpg,png}',
               		dest: 'assets/images'
            	}]
         	}
      	},

      	svgmin: {
         	options: {
            	full: true,
        		plugins: [
           			{cleanupIDs: false},                  // don't remove  ids
	               	{removeViewBox: false},               // don't remove the viewbox atribute from the SVG
	               	{removeUselessStrokeAndFill: false},  // don't remove Useless Strokes and Fills
	               	{removeEmptyAttrs: false}             // don't remove Empty Attributes from the SVG
        		]
         	},
         	dist: {
	            files: [{
	               	expand: true,
	               	cwd: 'dev/img',
	               	src: '{,*/}*.svg',
	               	dest: 'assets/images'
	            }]
	        }
	    },

     	copy:{
     		serve:{
     			files: [{
         			expand: true,
         			cwd: 'dev/images',
                   	dest: 'assets/images',
                   	src: '*'
         		     },{
                    expand: true,
                    cwd: '.',
                    flatten: true,
                    src: 'bower_components/font-awesome/fonts/*',
                    dest: 'assets/fonts/'
                },{
                    expand: true,
                    flatten:true,
                    src: 'dev/fonts/*',
                    dest: 'assets/fonts'
                },{
                    expand: true,
                    flatten:true,
                    src: '.tmp/styles/main.css',
                    dest: 'assets/styles/'
                },{
                    expand: true,
                    flatten:true,
                    src: '.tmp/styles/fonts.css',
                    dest: 'assets/styles'
                },{
                    expand: true,
                    flatten:true,
                    src: ['dev/scripts/jMosaic.js', 'dev/scripts/custom-scrollbar.js'],
                    dest: 'assets/scripts'
                },{
                    expand: true,
                    flatten:true,
                    src: '.tmp/scripts/*.js',
                    dest: 'assets/scripts'
                }]
     		 }, 
             build: {
                files: [{
                    expand: true,
                    cwd: 'dev/scripts',
                    dest: '.tmp/scripts',
                    src: '{,*/}*.js'
                },{
                    expand: true,
                    cwd: 'dev/images',
                    dest: 'assets/images',
                    src: '*'
                },{
                    expand: true,
                    cwd: '.',
                    flatten: true,
                    src: 'bower_components/font-awesome/fonts/*',
                    dest: 'assets/fonts/'
                },{
                    expand: true,
                    flatten:true,
                    cwd: '.',
                    src: 'dev/fonts/*',
                    dest: 'assets/fonts'
                }]
             }
      	},

        modernizr: {
            dist: {
                dest: 'assets/scripts/modernizr.js',
                files: {
                    src: [
                        'assets/scripts/{,*/}*.js',
                        'assets/styles/{,*/}*.css'
                    ]
                },
                extra: {
                   "shiv" : false,
                   "printshiv" : false,
                   "load" : false,
                   "mq" : true,
                   "cssclasses" : true
               },

                // Based on default settings on http://modernizr.com/download/
                extensibility: {
                   "addtest" : false,
                   "prefixed" : true,
                   "teststyles" : true,
                   "testprops" : true,
                   "testallprops" : true,
                   "hasevents" : true,
                   "prefixes" : true,
                   "domprefixes" : true,
                   "cssclassprefix": ""
                },
                uglify: true
            }
        },


      	watch: {
         	bower: {
            	files: ['bower.json'],
            	tasks: ['bower_concat']
         	},
         	images: {
            	files: ['dev/images/{,*/}*'],
            	tasks: ['imagemin'],
            	options: {
               		livereload: true
            	}
         	},
         	js: {
            	files: ['dev/scripts/{,*/}*.js'],
            	tasks: ['jshint', 'copy:serve', 'concat'],
            	options: {
               		livereload: true
            	}
         	},
         	compass: {
            	files: ['dev/styles/{,*/}*.{scss,sass}'],
            	tasks: ['compass', 'postcss', 'copy:serve'],
            	options: {
               		livereload: true
            	}
         	},
         	livereload: {
            	options: {
               		livereload: true
            	},
	            files: [
	               '{,*/}*.html',
	           		'{,*/}*.js',
	               '{,*/}*.php',
	               'images/{,*/}*'
	            ]
         	}
      	},

      	cssmin: {
         	build: {
           		files: {
               		'assets/styles/main.css': [
                  		'.tmp/styles/{,*/}*.css',
                  		'!.tmp/styles/admin.css',
                      '!.tmp/styles/vendor.css',
                      '!.tmp/styles/bower.css'
               		],
               		'assets/styles/admin.css': [
                  		'.tmp/styles/admin.css'
               		],
                  'assets/styles/vendor.css': [
                      '.tmp/styles/bower.css',
                      '.tmp/styles/vendor.css'
                  ]
           		}	
         	}, 
          serve: {
            files :{
              'assets/styles/vendor.css':[
                '.tmp/styles/{,*/}*',
                '!.tmp/styles/admin_styles.css',
                '!.tmp/styles/main.css'
              ]
            }
          }
      	},


      	uglify: {
         	dist: {
            	files: {
               		'assets/scripts/scripts.js': [
                  		'.tmp/scripts/vendor.js',
                  		'.tmp/scripts/*.js',
                        '!.tmp/scripts/admin.js'
               		],
               		'assets/scripts/admin.js': [
	                  	'.tmp/scripts/admin.js'
               	]
            	}
         	}
      	}

   	});


   	grunt.registerTask('serve', [
   		'clean:assets',
   		'jshint',
   	   	'compass',
        'imagemin',
        'svgmin',
   	   	'bower_concat',
        'concat:serve',
   	   	'postcss',
   	   	'copy:serve',
        'cssmin:serve',
        'modernizr',
   	   	'watch'
   	]);

   	grunt.registerTask('default', [
   		'clean:assets',
   		'jshint',
   	   	'compass',
        'imagemin',
        'svgmin',
   	   	'bower_concat',
        'concat:build',
   	   	'postcss',
        'copy:build',
   	   	'cssmin:build',
        'modernizr',
   	   	'uglify'
   	]);
};